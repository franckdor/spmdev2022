let requeteGen;
let requeteF;
let requeteT;

var genus = new TomSelect("#select-genre", {
    maxItems:1,
    maxOptions: null,
    valueField: 'title',
    labelField: 'title',
    sortField: 'title',
    searchField: ['title'],
    create: true,
    hideSelected: true,
});

var tribe = new TomSelect("#select-tribu", {
    maxItems:1,
    maxOptions: null,
    valueField: 'title',
    labelField: 'title',
    sortField: 'title',
    searchField: ['title'],
    create: false,
    hideSelected: true,
});

var sub_fam = new TomSelect("#select-sous-famille", {
    maxItems:1,
    maxOptions: null,
    valueField: 'title',
    labelField: 'title',
    sortField: 'title',
    searchField: ['title'],
    create: false,
    hideSelected: true,
});


var select = new TomSelect("#select", {
    maxItems:1,
    maxOptions: null,
    valueField: 'title',
    labelField: 'title',
    sortField: 'title',
    searchField: ['title'],
    create: false,
    hideSelected: true,
});

var familyS = new TomSelect("#select-family", {
    maxItems:1,
        maxOptions: null,
        valueField: 'title',
        labelField: 'title',
        sortField: 'title',
        searchField: ['title'],
        create: false,
        hideSelected: true,
});



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

        //genus.addOption(genre);

        tribe.addOption(tribu);

        sub_fam.addOption(sous_famille);


        select.addOption(recherche);
    }

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
        callback(requeteF);
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

    familyS.addOption(family);
    familyS.addItem(['Tetranychidae']);
    
}

function requeteTribe(callback) {
    let url = "index.php?controller=nomenclature_genre&action=selectTribe";
    if (requeteT && requeteT.readyState !== XMLHttpRequest.DONE) {
        requeteT.abort();
    }
    requeteT = new XMLHttpRequest();
    requeteT.open("GET", url, true);
    requeteT.addEventListener("load", function () {
        callback(requeteT);
    });
    requeteT.send(null);
}

var selection = document.getElementById("select");
selection.addEventListener("change", filler);



function filler() {
    var option = selection.options[selection.selectedIndex].value;
    tabFill = option.split(" - ");
    console.log(tabFill);
    genusItem = tabFill[0];
    tribeItem = tabFill[1];
    subFItem = tabFill[2];

    var tribeOption = document.createElement("option");
    var genusOption = document.createElement("option");
    var subFOption = document.createElement("option");

    genusOption.setAttribute("title", genusItem);
    tribeOption.setAttribute("title", tribeItem);
    subFOption.setAttribute("title", subFItem);

    var tribeNode = document.createTextNode(tribeItem);
    var genusNode = document.createTextNode(genusItem);
    var subFNode = document.createTextNode(subFItem);

    genusOption.appendChild(genusNode);
    tribeOption.appendChild(tribeNode);
    subFOption.appendChild(subFNode);


    genus.addOption(genusOption);
    genus.addItem(genusItem);
    tribe.addOption(tribeOption);
    tribe.addItem(tribeItem);
    sub_fam.addOption(subFOption);
    sub_fam.addItem(subFItem);
}



