// Hover des bouton reserver
document.getElementById('button_reserver_off').onmouseover = function () {
    this.style.display = "none";
    document.getElementById('button_reserver_on').style.display = "block";
}
document.getElementById('button_reserver_on').onmouseout = function () {
    document.getElementById('button_reserver_off').style.display = "block";
    document.getElementById('button_reserver_on').style.display = "none";
}



//API FACEBOOK
// const FB = 'https://www.facebook.com/events'
// FB.api(
//     "/1221698608641889",
//     function (response) {
//         if (response && !response.error) {
//             console.log('success')/* handle the result */
//         }
//     }
// );
