let requeteSearchGen;
let requeteSearchSpe;

function requeteFam(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteF";
    if (requeteF && requeteF.readyState !== XMLHttpRequest.DONE) {
        requeteF.abort();
    }
    requeteF = new XMLHttpRequest();
    requeteF.open("GET", url, true);
    requeteF.addEventListener("load", function () {
        callbackF(requeteF);
    });
    requeteF.send(null);
}