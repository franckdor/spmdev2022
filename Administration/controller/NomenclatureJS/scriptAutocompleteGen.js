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



requete(callbackGenus, requeteGen, "nomenclature_genre", "autocomplete");
requete(callbackF, requeteF, "nomenclature_genre", "autocompleteF");
requete(callbackTribe, requeteT, "nomenclature_genre", "selectTribe");


function callbackGenus(req) {
    
    var sous_famille = [];
    var recherche = [];
    

    let tab = JSON.parse(req.response);

    for (var i=0; i<tab.length; i++) {
        var titleGen = [];
        var titleSF = [];
        var titleR = [];
        var idGen = [];
        var biblio = [];
        var idB = [];
        titleGen.push(tab[i].gen.genre);
        idGen.push(tab[i].gen.id);
        titleSF.push(tab[i].gen.sous_famille);
        titleR.push(tab[i].gen.genre + " - " + tab[i].gen.tribu + " - " + tab[i].gen.sous_famille + " - " + tab[i].gen.statut);
        if (tab[i].biblio !== undefined) {
            biblio.push(tab[i].biblio.reference + " - " + tab[i].biblio.auteur + " - " +  tab[i].biblio.annee + " - " + tab[i].biblio.titre + " - " + tab[i].biblio.source);
            idB.push(tab[i].biblio.code_bibliographie);
        }

        sous_famille.push({
            id: i+'-'+titleSF.join(''),
            title: titleSF.join(''),
        });

        recherche.push({
            id: i+'-'+titleR.join(''),
            title: titleR.join(''),
            idGen: idGen.join(''),
            idB: idB.join(''),
            biblio: biblio.join(''),
        });

        
        sub_fam.addOption(sous_famille);


        select.addOption(recherche);
        
    }

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
    if (tribe.options[tribe.items] !== undefined) {
        hiddenId.value = tribe.options[tribe.items].idTrib;
    }
}

var buttGenus = document.getElementById("infos_genus");

buttGenus.addEventListener("click", () => {
    window.open("index.php?action=read&controller=nomenclature_genre&id=" + encodeURIComponent(select.options[select.items].idGen),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
})

function clear() {
    genus.clear();
    tribe.clear();
    select_status.clear();
    sub_fam.clear();
    selBiblio.clear();
}

function filler() {
    clear();

    if (select.options[select.items] !== undefined) {
        var optionGen = select.options[select.items].title;
        var optionBiblio = select.options[select.items].biblio;

        let tabBiblio = optionBiblio.split(" - ");
        let tabFill = optionGen.split(" - ");
        setTimeout(completeGen(tabFill, tabBiblio), 550);
    }
  
}



