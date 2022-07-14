// Hover du bouton reserver normal
// document.getElementById('button_reserver_off').onmouseover = function () {
//     this.style.display = "none";
//     document.getElementById('button_reserver_on').style.display = "block";
// }
// document.getElementById('button_reserver_on').onmouseout = function () {
//     document.getElementById('button_reserver_off').style.display = "block";
//     document.getElementById('button_reserver_on').style.display = "none";
// }

// Hover du bouton reserver destroy
document.getElementById('button_reserver_off').onmouseover = function () {
    this.style.display = "none";
    document.getElementById('button_reserver_on').style.display = "block";
}
document.getElementById('button_reserver_on').onmouseout = function () {
    document.getElementById('button_reserver_off').style.display = "block";
    document.getElementById('button_reserver_on').style.display = "none";
}

