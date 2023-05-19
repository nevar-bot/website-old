<?php
namespace App\Controller;
use App\Config\Config;
use PHPMailer\PHPMailer\SMTP;

class ContactController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Contact");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Kontakt");
        //$this->view->setVariable("contactSuccess", 1);
        //$this->view->setVariable("contactError", 1);
        $this->view->render("contact");
    }

    public function requested(array $params){
        // Überprüfen, ob es sich um eine POST-Anfrage handelt, andernfalls umleiten
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->redirect("/contact-us");
        }

        // Validierung von Google reCAPTCHA
        $recaptchaResponse = $_POST['recaptcha_response'];
        $secretKey = Config::RECAPTCHA_SECRET;

        // Senden einer POST-Anfrage an die reCAPTCHA-API zur Überprüfung
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse"));

        if (!$response->success){
            // Wenn die reCAPTCHA-Überprüfung fehlschlägt, Fehler anzeigen und das Kontaktformular erneut rendern
            $this->view->setVariable("contactError", 1);
            $this->view->render("contact");
            return;
        }

        // reCAPTCHA ist gültig, E-Mail-Versand vorbereiten
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
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
        $mail->Host = Config::MAIL_HOST;
        $mail->Username = Config::MAIL_USER;
        $mail->Password = Config::MAIL_PASS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $mail->setFrom('noreply@nevar.eu', 'Nevar | Noreply');

        // Bestätigungsmail an den Benutzer senden
        $mail->addAddress($_POST["email"], $_POST["name"]);
        $mail->Subject = 'Vielen Dank für Ihre Kontaktaufnahme';
        $userConfirmationTemplate = '
        <html>
            <head>
                <title>Ihre Anfrage ist eingegangen</title>
                <style>
                    body {
                      font-family: Arial, sans-serif;
                      font-size: 14px;
                      line-height: 1.6;
                    }
                    .container {
                      max-width: 600px;
                      margin: 0 auto;
                      padding: 20px;
                      background-color: #f9f9f9;
                      border: 1px solid #ddd;
                    }
                    h1 {
                      color: #333;
                      font-size: 24px;
                      margin-bottom: 20px;
                    }
                    strong {
                      font-weight: bold;
                    }
                    ul {
                      margin-left: 20px;
                    }
                    .footer {
                      margin-top: 40px;
                      border-top: 1px solid #ddd;
                      padding-top: 20px;
                      color: #777;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                  <h1>Ihre Anfrage ist eingegangen</h1>
                  <p>Hallo {{ name }},</p>
                  <p>Vielen Dank für Ihre Nachricht über unser Kontaktformular. Wir haben Ihre Anfrage erhalten und werden uns in Kürze bei Ihnen melden.</p>
                  <p>Nachfolgend finden Sie eine Zusammenfassung Ihrer Anfrage:</p>
                  <ul>
                    <li><strong>Name:</strong> {{ name }}</li>
                    <li><strong>E-Mail:</strong> {{ email }}</li>
                    <li><strong>Nachricht:</strong> {{ message }}</li>
                  </ul>
                  <p>Wir bemühen uns, Ihnen so schnell wie möglich zu antworten. Bitte haben Sie jedoch Verständnis dafür, dass es je nach Anfrage zu Verzögerungen kommen kann.</p>
                  <p>Wir sind bestrebt, Ihnen innerhalb von zwei Werktagen eine Rückmeldung zu geben.</p>
                  <p>Wir freuen uns darauf, Ihnen weiterhelfen zu können.</p>
                  <br>
                  <p>Mit freundlichen Grüßen,</p>
                  <p>Ihr Nevar-Team</p>
                </div>
                <div class="footer">
                  Hierbei handelt es sich um eine automatisch generierte E-Mail. Bitte antworten Sie nicht auf diese E-Mail, da Ihre Antwort nicht gelesen werden kann.
                </div>
            </body>
        </html>';
        $userConfirmationTemplate = str_replace(
            [ '{{ name }}', '{{ email }}', '{{ message }}' ],
            [ $_POST['name'], $_POST['email'], nl2br($_POST['message']) ],
            $userConfirmationTemplate
        );
        $mail->Body = $userConfirmationTemplate;

        if ($mail->send()) {
            // Wenn die E-Mail erfolgreich gesendet wurde, Erfolgsmeldung anzeigen und das Kontaktformular erneut rendern
            $this->view->setVariable("contactSuccess", 1);
            $this->view->setVariable("title", "Nevar · Kontakt");
            $this->view->render("contact");

            // E-Mail an Nevar-Mitarbeiter senden
            $mail->addAddress(Config::STAFF_MAIL, "Nevar-Staff");
            $staffTemplate = '
            <html>
                <head>
                    <title>Neue Anfrage erhalten</title>
                    <style>
                        body {
                          font-family: Arial, sans-serif;
                        }
                
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            background-color: #f9f9f9;
                        }
                        
                        h1 {
                            color: #333;
                            text-align: center;
                        }
                        
                        p {
                            color: #555;
                            line-height: 1.5;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Neue Anfrage erhalten</h1>
                        <p>Folgende Anfrage wurde von einem Nutzer gesendet:</p>
                        <p><strong>Name:</strong> {{ name }}</p>
                        <p><strong>E-Mail:</strong> {{ email }}</p>
                        <p><strong>Nachricht:</strong> {{ message }}</p>
                    </div>
                </body>
            </html>';
            $staffTemplate = str_replace(
                [ '{{ name }}', '{{ email }}', '{{ message }}' ],
                [ $_POST['name'], $_POST['email'], nl2br($_POST['message']) ],
                $staffTemplate
            );
            $mail->Subject = 'Anfrage über Kontaktformular';
            $mail->Body = $staffTemplate;
            $mail->send();
        } else {
            // Bei einem Fehler beim E-Mail-Versand, Fehler anzeigen und das Kontaktformular erneut rendern
            $this->view->setVariable("contactError", 1);
            $this->view->setVariable("title", "Nevar · Kontakt");
            $this->view->render("contact");
        }
    }

}