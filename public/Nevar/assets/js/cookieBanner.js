document.addEventListener("DOMContentLoaded", () => {
    const cookieBanner = document.getElementById("cookie-banner");
    const cookieBannerAcceptButton = document.getElementById("accept-cookies");

    cookieBannerAcceptButton.addEventListener("click", () => {
        setCookie("cookieConsent", "true", 365);
        cookieBanner.style.display = "none";
    });

    function setCookie(name, value, days){
        let expires = "";
        if(days){
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function getCookie(name){
        const nameEQ = name + "=";
        const cookies = document.cookie.split(";");
        for(const element of cookies) {
            let cookie = element;
            while(cookie.charAt(0) === " "){
                cookie = cookie.substring(1, cookie.length);
            }
            if(cookie.indexOf(nameEQ) === 0){
                return cookie.substring(nameEQ.length, cookie.length);
            }
        }
        return null;
    }

    const cookieConsent = getCookie("cookieConsent");
    if(cookieConsent !== "true"){
        cookieBanner.style.display = "block";
    }
})