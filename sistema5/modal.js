// JavaScript Document
var ventanaPopup = null;
function showPopWin(url, title, width, height, returnFunc) {
    if (window.showModalDialog) { // Si estamos en Internet Explorer
        var args = "dialogWidth:" + width + "px;dialogHeight:" + height + "px";
        window.showModalDialog(url, "_blank", args);
    } else { // Si estamos en cualquier otro navegador
        var args = "width=" + width + ",height=" + height;
        ventanaPopup = window.open(url, "_blank", args);
    }
}

function controlPopup() {
    if (ventanaPopup == null) {
        return;
    } else if (!ventanaPopup.closed) {
        ventanaPopup.focus();
    }
}
window.onfocus = controlPopup;