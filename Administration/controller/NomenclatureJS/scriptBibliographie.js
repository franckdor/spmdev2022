"use strict";
let requeteBiblio;
let requeteSpecies;
let requeteRepart;
let requeteHostP;

requeteB(callbackBiblio);


var selectBiblio = document.getElementById("selectBiblio");
var author = document.getElementById("searchAuthor");
var title = document.getElementById("textTitle");
var source = document.getElementById("textSource");
var id = document.getElementById("id_biblio");
var year = document.getElementById("date");

selectBiblio.addEventListener("change", listener);

function listener() {
    var option = selectBiblio.options[selectBiblio.selectedIndex];
    const tab = option.value.split(" - ");
    author.value = tab[0];
    title.value = tab[2];
    source.value = tab[3];
    id.value = selectBiblio.tomselect.options[selectBiblio.tomselect.items].attr;
    year.value = selectBiblio.tomselect.options[selectBiblio.tomselect.items].year;
    requeteSpe(callbackSpecies);
    requeteRepartition(callbackRepart);
    requeteHP(callbackHP);
}

function requeteB(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteBiblio";
    if (requeteBiblio && requeteBiblio.readyState !== XMLHttpRequest.DONE) {
        requeteBiblio.abort();
    }
    requeteBiblio = new XMLHttpRequest();
    requeteBiblio.open("GET", url, true);
    requeteBiblio.addEventListener("load",  function () {
        callback(requeteBiblio);
    });
    requeteBiblio.send(null);
}

function callbackBiblio(req) {
    var options = [];
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var title = [];
        var attr = [];
        var value = [];
        var year = [];
  
          title.push(tab[i].reference + " - " + tab[i].titre);
          attr.push(tab[i].code_bibliographie);
          year.push(tab[i].annee);
          value.push(tab[i].auteur + " - " +  tab[i].annee + " - " + tab[i].titre + " - " + tab[i].source);
          options.push({
              id: i+'-'+title.join(''),
              title: title.join(''),
              value: value.join(''),
              attr: attr.join(''),
              year: year.join(''),
          }); 
    }
  
  
    new TomSelect('#selectBiblio',{
      maxItems: 1,
      maxOptions: 6000,
      valueField: 'value',
      labelField: 'title',
      searchField: ['title'],
      sortField: 'title',
      options: options,
      persist: false,
      create: true,
      hideSelected: true,
    });
  
}

//FIND ALL SPECIES THAT HAVE SAME CODE_BIBLIO FROM NOMENCLATURE_SPECIES
function requeteSpe(callback) {
    let url = "index.php?controller=nomenclature_espece&action=searchSpeciesCode&code=" + encodeURI(id.value);
    if (requeteSpecies && requeteSpecies.readyState !== XMLHttpRequest.DONE) {
        requeteSpecies.abort();
    }
    requeteSpecies = new XMLHttpRequest();
    requeteSpecies.open("GET", url, true);
    requeteSpecies.addEventListener("load",  function () {
        callback(requeteSpecies);
    });
    requeteSpecies.send(null);
}

function callbackSpecies(req) {
    let tab = JSON.parse(req.response);
    var specy = document.getElementById("specy");
    var synonyms = document.getElementById("synonyms");

    specy.innerHTML = "";
    synonyms.innerHTML = "";

    let labelSpecy = document.createElement("label");
            labelSpecy.htmlFor = "specy";
            labelSpecy.innerText = "Espèce";
            specy.appendChild(labelSpecy);

    let labelSyno = document.createElement("label");
            labelSyno.htmlFor = "specy";
            labelSyno.innerText = "Synonyme";
            synonyms.appendChild(labelSyno);

    

    for (var i=0; i<tab.length; i++) {
        
        if (tab[i].statut === "Valid name") {
            
            let p = document.createElement("p");
            p.innerText = tab[i].genre + " - " + tab[i].espece;
            specy.appendChild(p);
        } else {
            let p = document.createElement("p");

            p.innerText = tab[i].genre + " - " + tab[i].espece;
            synonyms.appendChild(p);
        }
    }


  
}

//FIND REPARTITION FROM A CODE BIBLIO
function requeteRepartition(callback) {
    let url = "index.php?controller=bibliographie&action=searchRepart&code=" + encodeURI(id.value);
    if (requeteRepart && requeteRepart.readyState !== XMLHttpRequest.DONE) {
        requeteRepart.abort();
    }
    requeteRepart = new XMLHttpRequest();
    requeteRepart.open("GET", url, true);
    requeteRepart.addEventListener("load",  function () {
        console.log(requeteRepart);
        callback(requeteRepart);
    });
    requeteRepart.send(null);
}

function callbackRepart(req) {
    let tab = JSON.parse(req.response);
    var repartition = document.getElementById("repartition");

    repartition.innerHTML = "";

    let labelRepart = document.createElement("label");
            labelRepart.htmlFor = "repartition";
            labelRepart.innerText = "Repartition";
            repartition.appendChild(labelRepart);

    for(let i=0; i<tab.length; i++) {
        var p = document.createElement("p");
        p.innerText = tab[i].genre + " " + tab[i].espece + " | " + tab[i].pays + " - " + tab[i].zone;
        repartition.appendChild(p);
    }

}

function requeteHP(callback) {
    let url = "index.php?controller=bibliographie&action=searchHostPlant&code=" + encodeURI(id.value);
    if (requeteHostP && requeteHostP.readyState !== XMLHttpRequest.DONE) {
        requeteHostP.abort();
    }
    requeteHostP = new XMLHttpRequest();
    requeteHostP.open("GET", url, true);
    requeteHostP.addEventListener("load",  function () {
        console.log(requeteHostP);
        callback(requeteHostP);
    });
    requeteHostP.send(null);
}

function callbackHP(req) {
    let tab = JSON.parse(req.response);
    var HP = document.getElementById("plants");

    HP.innerHTML = "";

    let labelHP = document.createElement("label");
    labelHP.htmlFor = "plants";
    labelHP.innerText = "Host Plant";
    HP.appendChild(labelHP);

    for(let i=0; i<tab.length; i++) {
        var p = document.createElement("p");
        p.innerText = tab[i].genre + " " + tab[i].espece + " | " + tab[i].specy_plant + " - " + tab[i].genus_plant;
        repartition.appendChild(p);
    }


  
}