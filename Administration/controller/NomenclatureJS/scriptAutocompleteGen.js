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
requeteTribe(callbackTribe);


function callback(req) {
    
    var sous_famille = [];
    var recherche = [];
    

    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var titleGen = [];
        var titleSF = [];
        var titleR = [];
        var idGen = [];
        titleGen.push(tab[i].genre);
        idGen.push(tab[i].id);
        titleSF.push(tab[i].sous_famille);
        titleR.push(tab[i].genre + " - " + tab[i].tribu + " - " + tab[i].sous_famille + " - " + tab[i].statut);
        

        

        sous_famille.push({
            id: i+'-'+titleSF.join(''),
            title: titleSF.join(''),
        });

        recherche.push({
            id: i+'-'+titleR.join(''),
            title: titleR.join(''),
            idGen: idGen.join(''),
        });

        //genus.addOption(genre);

        
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


function callbackTribe(req) {
    var tribu = [];

    let tab = JSON.parse(req.response);

    for(let i=0; i<tab.length; i++) {
        var titleTrib = [];
        var idTrib = [];

        titleTrib.push(tab[i].nom_classification);
        idTrib.push(tab[i].id_classification); 

        tribu.push({
            id: i+'-'+titleTrib.join(''),
            title: titleTrib.join(''),
            idTrib: idTrib.join(''),
        });

        tribe.addOption(tribu);
    }

} 

var selection = document.getElementById("select");
selection.addEventListener("change", filler);

var tribeSelect = document.getElementById("select-tribu");
tribeSelect.addEventListener("change", hiddenFunc);

function hiddenFunc() {
    var hiddenId = document.getElementById('tribeID');
    hiddenId.value = tribe.options[tribe.items].idTrib;
}

var buttGenus = document.getElementById("infos_genus");

buttGenus.addEventListener("click", () => {
    window.open("index.php?action=update&controller=nomenclature_genre&id=" + encodeURIComponent(select.options[select.items].idGen),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
})


function filler() {
    var option = selection.options[selection.selectedIndex].value;
    tabFill = option.split(" - ");
    genusItem = tabFill[0];
    tribeItem = tabFill[1];
    subFItem = tabFill[2];
    statItem = tabFill[3];

    var tribeOption = document.createElement("option");
    var genusOption = document.createElement("option");
    var subFOption = document.createElement("option");
    var statOption = document.createElement("option");

    genusOption.setAttribute("title", genusItem);
    tribeOption.setAttribute("title", tribeItem);
    subFOption.setAttribute("title", subFItem);
    statOption.setAttribute("title", statItem);

    var tribeNode = document.createTextNode(tribeItem);
    var genusNode = document.createTextNode(genusItem);
    var subFNode = document.createTextNode(subFItem);
    var statNode = document.createTextNode(statItem);

    genusOption.appendChild(genusNode);
    tribeOption.appendChild(tribeNode);
    subFOption.appendChild(subFNode);
    statOption.appendChild(statNode)


    genus.addOption(genusOption);
    genus.addItem(genusItem);
    tribe.addOption(tribeOption);
    tribe.addItem(tribeItem);
    sub_fam.addOption(subFOption);
    sub_fam.addItem(subFItem);
    select_status.addOption(statOption);
    select_status.addItem(statItem);
}



