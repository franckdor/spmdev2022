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

});

var search_species = new TomSelect('#search-species',{
  maxItems: 1,
  maxOptions: 200,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,

});

requete(callback_ESP, requeteESPE, "nomenclature_espece", "autocompleteEsp");
requete(callback_GEN, requeteGEND, "nomenclature_espece", "autocompleteGen");
requete(callbackAut, requeteAute , "nomenclature_espece", "autocompleteAut");
requete(callbackESPVALID, requeteEspV, "nomenclature_espece" , "autocompleteEspVALID");
requete(callbackSearch, requeteFill, "nomenclature_espece", "filler");







function callbackOS(req) {
  videdivp();
  let tab = JSON.parse(req.response);
  for(let i=0; i<tab.length; i++) {
    var button = document.createElement("button");
    button.innerText = "> > >";
    button.type = "button";
    button.addEventListener("click", () => {
      window.open("index.php?action=update&controller=nomenclature_espece&id=" + encodeURIComponent(tab[i].id),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
    });
    var p = document.createElement("p");
    p.innerText = tab[i].espece + " -- " + tab[i].genre + " -- " + tab[i].auteur_date + " -- " + tab[i].statut + "\n";
    p.appendChild(button);
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
      var idEsp = []

      titleRG.push(tab[i].genre + " - " + tab[i].espece + " - " + tab[i].auteur_date + " - " + tab[i].statut + " - " + tab[i].espece_valide + " - " + tab[i].genre_valide);
      titleRS.push(tab[i].espece + " - " + tab[i].genre + " - " + tab[i].auteur_date + " - " + tab[i].statut + " - " + tab[i].espece_valide + " - " + tab[i].genre_valide);
      idEsp.push(tab[i].id);

      searchSpe.push({
        id: i+'-'+titleRS.join(''),
        title: titleRS.join(''),
        idEsp: idEsp.join(''),
    });


      searchGen.push({
          id: i+'-'+titleRG.join(''),
          title: titleRG.join(''),
          idEsp: idEsp.join(''),
      });

      search_genus.addOption(searchGen);
      search_species.addOption(searchSpe);

      tableau[i] = tab[i];
  }

}


//Called function to fulfill the options
function callback_GEN(req) {
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

  select_genus.addOption(options);
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
  let statItem = tabFill[3];
  let VspeciesItem = tabFill[4] + " - " + tabFill[5];


  var speciesOption = document.createElement("option");
  var genusOption = document.createElement("option");
  var audOption = document.createElement("option");
  var VspeciesOption = document.createElement("option");
  var statOption = document.createElement("option");

  genusOption.setAttribute("title", genusItem);
  speciesOption.setAttribute("title", speciesItem);
  audOption.setAttribute("title", audItem);
  VspeciesOption.setAttribute("title", VspeciesItem);
  statOption.setAttribute("title", statItem);

  var speciesNode = document.createTextNode(speciesItem);
  var genusNode = document.createTextNode(genusItem);
  var audNode = document.createTextNode(audItem);
  var VspeciesNode = document.createTextNode(VspeciesItem);
  var statNode = document.createTextNode(statItem);

  genusOption.appendChild(genusNode);
  speciesOption.appendChild(speciesNode);
  audOption.appendChild(audNode);
  VspeciesOption.appendChild(VspeciesNode);
  statOption.appendChild(statNode);


  select_genus.addOption(genusOption);
  select_genus.addItem(genusItem);
  select_spe.addOption(speciesOption);
  select_spe.addItem(speciesItem);
  select_aut.addOption(audOption);
  select_aut.addItem(audItem);
  select_VSpe.addOption(VspeciesOption);
  select_VSpe.addItem(VspeciesItem);
  select_status.addOption(statOption);
  select_status.addItem(statItem);
}

function fillerSpecies() {
  search_genus.clear();
  var option = searchSpe.options[searchSpe.selectedIndex].value;
  let tabFill = option.split(" - ");
  let genusItem = tabFill[0];
  let speciesItem = tabFill[1];
  let audItem = tabFill[2];
  let statItem = tabFill[3];
  let VspeciesItem = tabFill[4] + " - " + tabFill[5];


  var speciesOption = document.createElement("option");
  var genusOption = document.createElement("option");
  var audOption = document.createElement("option");
  var VspeciesOption = document.createElement("option");
  var statOption = document.createElement("option");

  genusOption.setAttribute("title", genusItem);
  speciesOption.setAttribute("title", speciesItem);
  audOption.setAttribute("title", audItem);
  VspeciesOption.setAttribute("title", VspeciesItem);
  statOption.setAttribute("title", statItem);

  var speciesNode = document.createTextNode(speciesItem);
  var genusNode = document.createTextNode(genusItem);
  var audNode = document.createTextNode(audItem);
  var VspeciesNode = document.createTextNode(VspeciesItem);
  var statNode = document.createTextNode(statItem);

  genusOption.appendChild(genusNode);
  speciesOption.appendChild(speciesNode);
  audOption.appendChild(audNode);
  VspeciesOption.appendChild(VspeciesNode);
  statOption.appendChild(statNode);

  select_genus.addOption(genusOption);
  select_genus.addItem(genusItem);
  select_spe.addOption(speciesOption);
  select_spe.addItem(speciesItem);
  select_aut.addOption(audOption);
  select_aut.addItem(audItem);
  select_VSpe.addOption(VspeciesOption);
  select_VSpe.addItem(VspeciesItem);
  select_status.addOption(statOption);
  select_status.addItem(statItem);
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
  

