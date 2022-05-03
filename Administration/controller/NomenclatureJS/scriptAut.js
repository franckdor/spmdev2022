let requeteAute;

requeteAut(callbackAut);

function callbackAut(req) {
    var options = [];
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var title = [];
        if (tab[i].auteur_date.charAt(0)=='(') {
            tab[i].auteur_date = tab[i].auteur_date.substring(1, tab[i].auteur_date.length-1);
        } 
        title.push(tab[i].auteur_date);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
        });
    }


    new TomSelect("#select-authd", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: options,
    });
}




function requeteAut(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteAut";// + encodeURIComponent(stringAut);
    if (requeteAute && requeteAute.readyState !== XMLHttpRequest.DONE) {
      requeteAute.abort();
    }
    requeteAute = new XMLHttpRequest();
    requeteAute.open("GET", url, true);
    requeteAute.addEventListener("load", function () {
        callback(requeteAute);
    });
    requeteAute.send(null);
}

