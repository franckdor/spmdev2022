"use strict";
var divp = document.getElementById('p');

let requeteGEND;
let requeteESPE;
let requeteAute;
let requeteEspV;
let requeteFill;
let requeteOtherSpecies;




let tableau = [];

//Using TomSelect API for better searching settings
var select_genus = new TomSelect('#select-genre',{
  maxItems: 1,
  maxOptions: 200,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,
  create: true
});

var select_spe = new TomSelect('#select-espece',{
  maxItems: 1,
  maxOptions: 6000,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,
  create: true
});

var select_aut = new TomSelect("#select-authd", {
  maxItems:1,
  maxOptions: null,
  valueField: 'title',
  labelField: 'title',
  sortField: 'title',
  searchField: ['title'],
  hideSelected: true,
  create: true,
});

var select_VSpe = new TomSelect("#select-espece-valide", {
  maxItems:1,
  maxOptions: null,
  valueField: 'title',
  labelField: 'title',
  sortField: 'title',
  searchField: ['title'],
  create: false,
});

var search_genus = new TomSelect('#search-genus',{
  maxItems: 1,
  maxOptions: 200,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,
  create: true
});

var search_species = new TomSelect('#search-species',{
  maxItems: 1,
  maxOptions: 200,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,
  create: true
});

requeteESP(callback_ESP);
requeteGEN(callback_GEN);
requeteAut(callbackAut);
requeteESPVALID(callbackESPVALID);
requete(callbackSearch);

function requete(callback) {
  let url = "index.php?controller=nomenclature_espece&action=filler";
  if (requeteFill && requeteFill.readyState !== XMLHttpRequest.DONE) {
    requeteFill.abort();
  }
  requeteFill = new XMLHttpRequest();
  requeteFill.open("GET", url, true);
  requeteFill.addEventListener("load", function () {
    callback(requeteFill);
  });
  requeteFill.send(null);
}

function requeteOtherSpe() {
  
  let url = "index.php?controller=nomenclature_espece&action=OtherSpecies&other=" + encodeURIComponent(select_VSpe.items[0]);
  if (requeteOtherSpecies && requeteOtherSpecies.readyState !== XMLHttpRequest.DONE) {
    requeteOtherSpecies.abort();
  }
  requeteOtherSpecies = new XMLHttpRequest();
  requeteOtherSpecies.open("GET", url, true);
  requeteOtherSpecies.addEventListener("load", function () {
    callbackOS(requeteOtherSpecies);
  });
  requeteOtherSpecies.send(null);
  
}

var other_species = document.getElementById("button");
other_species.addEventListener("click", requeteOtherSpe);


function callbackOS(req) {
  videdivp();
  let tab = JSON.parse(req.response);
  for(let i=0; i<tab.length; i++) {
    var p = document.createElement("p");
    p.innerText = tab[i].espece + " -- " + tab[i].genre + " -- " + tab[i].auteur_date + " -- " + tab[i].statut + "\n";
    divp.appendChild(p);
  }
}

function videdivp() {
  divp.innerHTML="";
}

function callbackSearch(req) {
  var searchGen = [];
  var searchSpe = [];
  
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab.length; i++) {
      var titleRG = [];
      var titleRS = [];

      titleRG.push(tab[i].genre + " - " + tab[i].espece + " - " + tab[i].auteur_date + " - " + tab[i].statut + " - " + tab[i].espece_valide + " - " + tab[i].genre_valide);
      titleRS.push(tab[i].espece + " - " + tab[i].genre + " - " + tab[i].auteur_date + " - " + tab[i].statut + " - " + tab[i].espece_valide + " - " + tab[i].genre_valide);


      searchSpe.push({
        id: i+'-'+titleRS.join(''),
        title: titleRS.join(''),
    });


      searchGen.push({
          id: i+'-'+titleRG.join(''),
          title: titleRG.join(''),

      });

      search_genus.addOption(searchGen);
      search_species.addOption(searchSpe);

      tableau[i] = tab[i];
  }

}

//Getting data from DB via action autocomplete in CONTROLLER
function requeteGEN(callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteGen";
  if (requeteGEND && requeteGEND.readyState !== XMLHttpRequest.DONE) {
    requeteGEND.abort();
  }
  requeteGEND = new XMLHttpRequest();
  requeteGEND.open("GET", url, true);
  requeteGEND.addEventListener("load", function () {
      callback(requeteGEND);
  });
  requeteGEND.send(null);
}

//Called function to fulfill the options
function callback_GEN(req) {
  var options = [];
  let tab = JSON.parse(req.response);

  for (var i=0; i<tab.length; i++) {
    var title = [];
    title.push(tab[i].nom_genre);
    options.push({
        id: i+'-'+title.join(''),
        title: title.join(''),
    });
    
  }

  select_genus.addOption(options);
}





function requeteESP(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteEsp";
    if (requeteESPE && requeteESPE.readyState !== XMLHttpRequest.DONE) {
      requeteESPE.abort();
    }
    requeteESPE = new XMLHttpRequest();
    requeteESPE.open("GET", url, true);
    requeteESPE.addEventListener("load", function () {
        callback(requeteESPE);
    });
    requeteESPE.send(null);
}



function callback_ESP(req) {
  var options = [];
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab.length; i++) {
      var title = [];
      title.push(tab[i].nom_espece);
      options.push({
          id: i+'-'+title.join(''),
          title: title.join(''),
      });
  }
  select_spe.addOption(options);
}



function callbackAut(req) {
    var options = [];
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var title = [];
        /*
        if (tab[i].auteur_date.charAt(0)=='(') {
            tab[i].auteur_date = tab[i].auteur_date.substring(1, tab[i].auteur_date.length-1);
        } 
        */
        title.push(tab[i].auteur_date);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
        });
    }

    select_aut.addOption(options);

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
  
//displays in <SELECT> differents status
function afficheStat(tableau) {
  for (let i=0; i<tableau.length; i++) {
      var o = document.createElement("option");
      o.innerHTML = tableau[i];
      statut.appendChild(o);
  }
  if(tableau.length > 0) o.style.borderWidth = "1px";
}





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

    select_VSpe.addOption(options);

}


function requeteESPVALID(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteEspVALID";// + encodeURIComponent(stringAut);
    if (requeteEspV && requeteEspV.readyState !== XMLHttpRequest.DONE) {
        requeteEspV.abort();
    }
    requeteEspV = new XMLHttpRequest();
    requeteEspV.open("GET", url, true);
    requeteEspV.addEventListener("load", function () {
        callback(requeteEspV);
    });
    requeteEspV.send(null);
}



var searchGen = document.getElementById("search-genus");
searchGen.addEventListener("change", fillerGenus);

var searchSpe = document.getElementById("search-species");
searchSpe.addEventListener("change", fillerSpecies);


function fillerGenus() {
  search_species.clear();
  var option = searchGen.options[searchGen.selectedIndex].value;
  let tabFill = option.split(" - ");
  
  let genusItem = tabFill[0];
  let speciesItem = tabFill[1];
  let audItem = tabFill[2];
  let VspeciesItem = tabFill[4] + " - " + tabFill[5];


  var speciesOption = document.createElement("option");
  var genusOption = document.createElement("option");
  var audOption = document.createElement("option");
  var VspeciesOption = document.createElement("option");

  genusOption.setAttribute("title", genusItem);
  speciesOption.setAttribute("title", speciesItem);
  audOption.setAttribute("title", audItem);
  VspeciesOption.setAttribute("title", VspeciesItem);

  var speciesNode = document.createTextNode(speciesItem);
  var genusNode = document.createTextNode(genusItem);
  var audNode = document.createTextNode(audItem);
  var VspeciesNode = document.createTextNode(VspeciesItem);

  genusOption.appendChild(genusNode);
  speciesOption.appendChild(speciesNode);
  audOption.appendChild(audNode);
  VspeciesOption.appendChild(VspeciesNode);


  select_genus.addOption(genusOption);
  select_genus.addItem(genusItem);
  select_spe.addOption(speciesOption);
  select_spe.addItem(speciesItem);
  select_aut.addOption(audOption);
  select_aut.addItem(audItem);
  select_VSpe.addOption(VspeciesOption);
  select_VSpe.addItem(VspeciesItem);
}

function fillerSpecies() {
  search_genus.clear();
  var option = searchSpe.options[searchSpe.selectedIndex].value;
  let tabFill = option.split(" - ");
  let genusItem = tabFill[0];
  let speciesItem = tabFill[1];
  let audItem = tabFill[2];
  let VspeciesItem = tabFill[4] + " - " + tabFill[5];


  var speciesOption = document.createElement("option");
  var genusOption = document.createElement("option");
  var audOption = document.createElement("option");
  var VspeciesOption = document.createElement("option");

  genusOption.setAttribute("title", genusItem);
  speciesOption.setAttribute("title", speciesItem);
  audOption.setAttribute("title", audItem);
  VspeciesOption.setAttribute("title", VspeciesItem);

  var speciesNode = document.createTextNode(speciesItem);
  var genusNode = document.createTextNode(genusItem);
  var audNode = document.createTextNode(audItem);
  var VspeciesNode = document.createTextNode(VspeciesItem);

  genusOption.appendChild(genusNode);
  speciesOption.appendChild(speciesNode);
  audOption.appendChild(audNode);
  VspeciesOption.appendChild(VspeciesNode);


  select_genus.addOption(genusOption);
  select_genus.addItem(genusItem);
  select_spe.addOption(speciesOption);
  select_spe.addItem(speciesItem);
  select_aut.addOption(audOption);
  select_aut.addItem(audItem);
  select_VSpe.addOption(VspeciesOption);
  select_VSpe.addItem(VspeciesItem);
}
  
