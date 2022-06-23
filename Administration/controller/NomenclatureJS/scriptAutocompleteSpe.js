
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
  create: false,
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
  create: false,
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
  create: false,

});

var search_species = new TomSelect('#search-species',{
  maxItems: 1,
  maxOptions: 200,
  valueField: 'title',
  labelField: 'title',
  searchField: ['title'],
  sortField: 'title',
  hideSelected: true,
  create: false,

});

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
      window.open("index.php?action=read&controller=nomenclature_espece&id=" + encodeURIComponent(tab[i].id),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
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
      var idE = [];
      var idB = [];
      var biblio = [];

      titleRG.push(tab[i].spe.genre + " - " + tab[i].spe.espece + " - " + tab[i].spe.auteur_date + " - " + tab[i].spe.statut + " - " + tab[i].spe.espece_valide + " - " + tab[i].spe.genre_valide);
      titleRS.push(tab[i].spe.espece + " - " + tab[i].spe.genre + " - " + tab[i].spe.auteur_date + " - " + tab[i].spe.statut + " - " + tab[i].spe.espece_valide + " - " + tab[i].spe.genre_valide);
      idE.push(tab[i].spe.id);
      idB.push(tab[i].biblio.code_bibliographie);
      biblio.push(tab[i].biblio.reference + " - " + tab[i].biblio.auteur + " - " +  tab[i].biblio.annee + " - " + tab[i].biblio.titre + " - " + tab[i].biblio.source);

      searchSpe.push({
        id: i+'-'+titleRS.join(''),
        title: titleRS.join(''),
        idE: idE.join(''),
        idB: idB.join(''),
        biblio: biblio.join(''),
    });


      searchGen.push({
          id: i+'-'+titleRG.join(''),
          title: titleRG.join(''),
          idE: idE.join(''),
          idB: idB.join(''),
          biblio: biblio.join(''),
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

function clear() {
  select_genus.clear();
  select_spe.clear();
  select_VSpe.clear();
  select_status.clear();
  select_aut.clear();
  selBiblio.clear();
}


function fillerGenus() {
  clear();
  
  if (search_genus.options[search_genus.items] !== undefined ) {
  var optionSpe = searchGen.options[searchGen.selectedIndex].value;
  var optionBiblio = search_genus.options[search_genus.items].biblio;

  let tabBiblio = optionBiblio.split(" - ");
  let tabFill = optionSpe.split(" - ");

    setTimeout(complete(tabFill, tabBiblio), 550);
  } 

}

function fillerSpecies() {
  clear();

  if (search_species.options[search_species.items] !== undefined) {
    var option = searchSpe.options[searchSpe.selectedIndex].value;
    var optionBiblio = search_species.options[search_species.items].biblio;

    let tabBiblio = optionBiblio.split(" - ");
    let tabFill = option.split(" - ");
    setTimeout(complete(tabFill, tabBiblio), 550);
  }
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
  

