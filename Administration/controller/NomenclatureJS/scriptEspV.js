let requeteEspV;

requeteESPVALID(callbackESPVALID);

function callbackESPVALID(req) {
    var options = [];
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var title = [];
        title.push(tab[i]);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
        });
    }


    new TomSelect("#select-espece-valide", {
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




function requeteESPVALID(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteEspVALID";// + encodeURIComponent(stringAut);
    if (requeteEspV && requeteEspV.readyState !== XMLHttpRequest.DONE) {
        requeteEspV.abort();
    }
    requeteEspV = new XMLHttpRequest();
    requeteEspV.open("GET", url, true);
    requeteEspV.addEventListener("load", function () {
        console.log(requeteEspV);
        callback(requeteEspV);
    });
    requeteEspV.send(null);
}

