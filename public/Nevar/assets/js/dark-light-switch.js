const switchButton = document.querySelector('.switch-button input[type="checkbox"]');
window.addEventListener("DOMContentLoaded", () => {
    if(getCookie("colortheme")){
        if(getCookie("colortheme") === "dark"){
            switchButton.checked = true;
            document.body.classList.add('dark-mode');
        }else{
            switchButton.checked = false;
            document.body.classList.remove('dark-mode');
        }
    }else{
        document.body.classList.remove('dark-mode');
    }
})
switchButton.addEventListener("change", () => {
    if(switchButton.checked){
        if(getCookie("cookieConsent") === "true"){
            setCookie("colortheme", "dark", 365);
        }
        document.body.classList.add('dark-mode');
        refreshCSS();
    }else{
        if(getCookie("cookieConsent") === "true") {
            setCookie("colortheme", "light", 365);
        }
        document.body.classList.remove('dark-mode');
        refreshCSS();
    }
});

function getCookie(name){
    const nameEQ = name + "=";
    const cookies = document.cookie.split(";");
    for(let i = 0; i < cookies.length; i++){
        let cookie = cookies[i];
        while(cookie.charAt(0) === " "){
            cookie = cookie.substring(1, cookie.length);
        }
        if(cookie.indexOf(nameEQ) === 0){
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}
function setCookie(name, value, days){
    let expires = "";
    if(days){
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/; SameSite=None; Secure";
}

function refreshCSS() {
    var links = document.getElementsByTagName('link');
    for (var i = 0; i < links.length; i++) {
        var link = links[i];
        if (link.rel === 'stylesheet') {
            link.href = link.href + '?refresh=' + Date.now();
        }
    }
}