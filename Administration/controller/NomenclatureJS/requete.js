function requete(callback, requete, controller, action) {
    let url = "index.php?controller="+controller+"&action="+action;
    if (requete && requete.readyState !== XMLHttpRequest.DONE) {
        requete.abort();
    }
    requete = new XMLHttpRequest();
    requete.open("GET", url, true);
    requete.addEventListener("load", function () {
        callback(requete);
    });
    requete.send(null);
}


function requeteValue(callback, requete, controller, action, value) {
    let url = "index.php?controller="+controller+"&action="+action+"&code=" + encodeURI(value);
    if (requete && requete.readyState !== XMLHttpRequest.DONE) {
        requete.abort();
    }
    requete = new XMLHttpRequest();
    requete.open("GET", url, true);
    requete.addEventListener("load",  function () {
        callback(requete);
    });
    requete.send(null);
}
