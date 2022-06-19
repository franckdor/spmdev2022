"use strict";
let requeteBiblio;
let requeteSpecies;
let requeteRepart;
let requeteHostP;

requete(callbackBiblio, requeteBiblio, "nomenclature_espece", "autocompleteBiblio")


var selectBiblio = document.getElementById("selectBiblio");
var author = document.getElementById("searchAuthor");
var title = document.getElementById("textTitle");
var source = document.getElementById("textSource");
var id = document.getElementById("id_biblio");
var year = document.getElementById("date");

selectBiblio.addEventListener("change", listener);

function listener() {
    document.getElementById("id").innerHTML = "";
    var option = selectBiblio.options[selectBiblio.selectedIndex];
    const tab = option.value.split(" - ");
    author.value = tab[0];
    title.value = tab[2];
    source.value = tab[3];
    id.value = selectBiblio.tomselect.options[selectBiblio.tomselect.items].attr;
    var button = document.createElement("button");
    document.getElementById("id").appendChild(button);
    button.type = "button";
    button.innerText = ">>>";
    button.addEventListener("click", () => {
        window.open("index.php?action=read&controller=bibliographie&code_bibliographie=" + encodeURIComponent(id.value),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
      });
    year.value = selectBiblio.tomselect.options[selectBiblio.tomselect.items].year;
    //requeteSpe(callbackSpecies);
    requeteValue(callbackSpecies, requeteSpecies, "nomenclature_espece", "searchSpeciesCode", id.value)
    //requeteRepartition(callbackRepart);
    requeteValue(callbackRepart, requeteRepart, "bibliographie", "searchRepart", id.value)
    //requeteHP(callbackHP);
    //requeteValue(callbackHP, requeteHostP, "bibliographie", "searchHostPlant", id.value);
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


function callbackSpecies(req) {
    let tab = JSON.parse(req.response);
    var specy = document.getElementById("specy");
    var synonyms = document.getElementById("synonyms");

    specy.innerHTML = "";
    synonyms.innerHTML = "";

    if (tab.length===0) {
        return;
    }

    let labelSpecy = document.createElement("label");
            labelSpecy.htmlFor = "specy";
            labelSpecy.innerText = "Espèce";
            specy.appendChild(labelSpecy);

    
    for (var i=0; i<tab.length; i++) {
        
        if (tab[i].statut === "Valid name") {

            
            
            let p = document.createElement("p");
            p.innerText = tab[i].genre + " - " + tab[i].espece;
            specy.appendChild(p);
        } else {
            if (tab[i].statut === "Valid nomenclatural act") {
                
            } else {
            

            let p = document.createElement("p");

            p.innerText = tab[i].genre + " - " + tab[i].espece; + " (synonym)"
            synonyms.appendChild(p);
            }
        }
    }


  
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


function callbackHP(req) {
    let tab = JSON.parse(req.response);
    var HP = document.getElementById("plants");

    HP.innerHTML = "";

    if (tab.length===0) {
        return;
    }

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