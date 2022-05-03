let requeteGen;

requete(callback);

function callback(req) {
    var genre = [];
    var tribu = [];
    var sous_famille = [];
    var recherche = [];

    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var titleGen = [];
        var titleTrib = [];
        var titleSF = [];
        var titleR = [];

        titleGen.push(tab[i].genre);
        titleTrib.push(tab[i].tribu);
        titleSF.push(tab[i].sous_famille);
        titleR.push(tab[i].genre + " - " + tab[i].tribu + " - " + tab[i].sous_famille + " - " + tab[i].statut);

        genre.push({
            id: i+'-'+titleGen.join(''),
            title: titleGen.join(''),
        });

        tribu.push({
            id: i+'-'+titleTrib.join(''),
            title: titleTrib.join(''),
        });

        sous_famille.push({
            id: i+'-'+titleSF.join(''),
            title: titleSF.join(''),
        });

        recherche.push({
            id: i+'-'+titleR.join(''),
            title: titleR.join(''),
        });


    }


    


    new TomSelect("#select-genre", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: genre,
    });

    new TomSelect("#select-tribu", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: tribu,
    });

    new TomSelect("#select-sous-famille", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: sous_famille,
    });

    new TomSelect("#select", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: recherche,
    });
}




function requete(callback) {
    let url = "index.php?controller=nomenclature_genre&action=autocomplete";
    if (requeteGen && requeteGen.readyState !== XMLHttpRequest.DONE) {
        requeteGen.abort();
    }
    requeteGen = new XMLHttpRequest();
    requeteGen.open("GET", url, true);
    requeteGen.addEventListener("load", function () {
        callback(requeteGen);
    });
    requeteGen.send(null);
}