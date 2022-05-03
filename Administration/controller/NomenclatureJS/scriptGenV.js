let requeteGenV;

requeteGENVALID(callbackGENVALID);

function callbackGENVALID(req) {
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


    new TomSelect("#select-genre-valide", {
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




function requeteGENVALID(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteGenVALID";// + encodeURIComponent(stringAut);
    if (requeteGenV && requeteGenV.readyState !== XMLHttpRequest.DONE) {
        requeteGenV.abort();
    }
    requeteGenV = new XMLHttpRequest();
    requeteGenV.open("GET", url, true);
    requeteGenV.addEventListener("load", function () {
        callback(requeteGenV);
    });
    requeteGenV.send(null);
}

