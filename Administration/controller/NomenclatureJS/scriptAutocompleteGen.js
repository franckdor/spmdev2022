let requeteGen;
let requeteF;

requete(callback);
requeteFam(callbackF);

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


    var genus = new TomSelect("#select-genre", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: genre,
    });

    var tribe = new TomSelect("#select-tribu", {
        maxItems:1,
        maxOptions: null,
        items: ['Bryobiini'],
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: tribu,
    });

    var sub_fam = new TomSelect("#select-sous-famille", {
        maxItems:1,
        maxOptions: null,
        items: ['Bryobiinae'],
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: sous_famille,
    });
    sub_fam.addItem()


    var select = new TomSelect("#select", {
        maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: recherche,
    });

    console.log(select);
    select.addItem("ALED");
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

function requeteFam(callback) {
    let url = "index.php?controller=nomenclature_genre&action=autocompleteF";
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

function callbackF(req) {
    let tab = JSON.parse(req.response);
    let family = [];
    
    for(let i=0; i<tab.length; i++) {

        var titleFam = [];

        titleFam.push(tab[i].famille);

        family.push({
            id: i+'-'+titleFam.join(''),
            title: titleFam.join(''),
        });
    }

    new TomSelect("#select-family", {
    maxItems:1,
        maxOptions: null,
        items: ['Tetranychidae'],
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        options: family
});
}
/*
var select = document.getElementById("select");
console.log(select);
select.addEventListener("change", filler);

var genusT = document.getElementById("genus");
console.log(genusT.childNodes);





function filler() {
    var option = select.options[select.selectedIndex].value;
    tabFill = option.split(" - ");
    console.log(tabFill);
    var genus = document.getElementById("select-genre");
    console.log(genus.options[genus.selectedIndex].value);
    genus.lastElementChild.innerHTML = tabFill[0];
    console.log(genus.lastElementChild.innerHTML);
    console.log(div);
}
*/
var div = document.getElementsByClassName("item");
console.log(div);
