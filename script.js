var settingsmenu = document.querySelector(".settings-menu");
var whiteBtn = document.getElementById("white-btn");

function settingsMenuToggle(){
    settingsmenu.classList.toggle("settings-menu-height");

}
whiteBtn.onclick = function(){
    whiteBtn.classList.toggle("white-btn-on");
    document.body.classList.toggle("white-theme");
}