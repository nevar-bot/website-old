const switchButton = document.querySelector('.switch-button input[type="checkbox"]');

switchButton.addEventListener("change", () => {
    if(switchButton.checked){
        console.log("Darkmode ausgewählt");
        document.body.classList.add('dark-mode');
    }else{
        console.log("Lightmode ausgewählt");
        document.body.classList.remove('dark-mode');
    }
})