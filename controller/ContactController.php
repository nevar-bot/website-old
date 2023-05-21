<?php
namespace App\Controller;
use App\Config\Config;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Contact");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Kontakt");
        $this->view->setVariable("sitekey", Config::FRIENDLY_CAPTCHA_SITEKEY);
        $this->view->render("contact");
    }

    public function requested(array $params): void {
        // Nur POST requests zulassen, alles andere redirecten
        if ($_SERVER["REQUEST_METHOD"] !== "POST") $this->redirect("/contact-us");

        // Captcha serverseitig validieren, Request an Friendlycaptcha API senden
        $url = 'https://api.friendlycaptcha.com/api/v1/siteverify';

        $context = stream_context_create(array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode(array(
                    'solution' => $_POST["frc-captcha-solution"],
                    'secret' => Config::FRIENDLY_CAPTCHA_SECRET
                ))
            )
        ));

        $response = json_decode(file_get_contents($url, false, $context));

        if(!$response->success) {
            // Captcha ist abgelaufen oder ungültig, Anfrage blocken und Fehler anzeigen
            $this->view->setVariable("title", "Nevar · Kontakt");
            $this->view->setVariable("captchaError", 1);
            $this->view->setVariable("sitekey", Config::FRIENDLY_CAPTCHA_SITEKEY);
            $this->view->render("contact");
            return;
        }

        // Nutzer ist kein Bot, E-Mailversand vorbereiten
        $mail = new PHPMailer();
        $mail->isSMTP();

        // SMTP-Konfiguration
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Host Einstellungen
        $mail->Host = Config::MAIL_HOST;
        $mail->Username = Config::MAIL_USER;
        $mail->Password = Config::MAIL_PASS;
        $mail->Port = Config::MAIL_PORT;

        $mail->CharSet = 'UTF-8';
        $mail->isHTML();

        // Absender der E-Mail
        $mail->setFrom(Config::MAIL_USER, 'Nevar 〢 Noreply');

        // Bestätigungsmail an den Benutzer senden
        $mail->addAddress($_POST["email"], $_POST["name"]);
        $mail->Subject = 'Vielen Dank für Ihre Kontaktaufnahme';
        $userConfirmationTemplate = str_replace(
            [ "{{ name }}", "{{ email }}", "{{ message }}" ],
            [ $_POST['name'], $_POST['email'], nl2br($_POST['message']) ],
            file_get_contents("public/Nevar/forms/contact/mail_templates/user_confirmation.html")
        );
        $mail->Body = $userConfirmationTemplate;

        if ($mail->send()) {
            // Bestätigungs-E-Mail wurde gesendet, Kontaktformular neu rendern mit Bestätigung
            $this->view->setVariable("title", "Nevar · Kontakt");
            $this->view->setVariable("sitekey", Config::FRIENDLY_CAPTCHA_SITEKEY);
            $this->view->setVariable("contactSuccess", 1);
            $this->view->render("contact");

            // E-Mail an Nevar-Staffs senden
            $mail->clearAddresses();
            $mail->addAddress(Config::STAFF_MAIL, "Nevar 〢 Kontakt");

            $mail->Subject = 'Anfrage über Kontaktformular';
            $staffTemplate = str_replace(
                [ "{{ name }}", "{{ email }}", "{{ message }}" ],
                [ $_POST['name'], $_POST['email'], nl2br($_POST['message']) ],
                file_get_contents("public/Nevar/forms/contact/mail_templates/staff_notification.html")
            );
            $mail->Body = $staffTemplate;
            $mail->send();
        } else {
            // E-Mail wurde nicht gesendet, Kontaktformular neu rendern mit Fehler
            $this->view->setVariable("title", "Nevar · Kontakt");
            $this->view->setVariable("contactError", 1);
            $this->view->setVariable("sitekey", Config::FRIENDLY_CAPTCHA_SITEKEY);

            $this->view->render("contact");
        }
    }
}