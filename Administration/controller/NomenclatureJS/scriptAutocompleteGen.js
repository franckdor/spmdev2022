let requeteGen;

requete(callback);

function callback(req) {
    var genre = [];
    var tribu = [];

    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var titleGen = [];
        var titleTrib = [];
        titleGen.push(tab[i].genre);
        titleTrib.push(tab[i].tribu);
        genre.push({
            id: i+'-'+titleGen.join(''),
            title: titleGen.join(''),
        });
        tribu.push({
            id: i+'-'+titleTrib.join(''),
            title: titleTrib.join(''),
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