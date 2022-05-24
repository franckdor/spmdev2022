"use strict";
let requeteBiblio;

requeteB(callbackBiblio);


var selectBiblio = document.getElementById("selectBiblio");
var author = document.getElementById("searchAuthor");
var title = document.getElementById("textTitle");
var source = document.getElementById("textSource");

selectBiblio.addEventListener("change", listener);

function listener() {
    var option = selectBiblio.options[selectBiblio.selectedIndex];
    const tab = option.value.split(" - ");
    author.value = tab[0];
    title.value = tab[2];
    source.value = tab[3];
}

function callbackBiblio(req) {
    var options = [];
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var title = [];
        var attr = [];
        var value = [];
  
          title.push(tab[i].reference + " - " + tab[i].titre);
          attr.push(tab[i].code_bibliographie);
          value.push(tab[i].auteur + " - " +  tab[i].annee + " - " + tab[i].titre + " - " + tab[i].source);
          options.push({
              id: i+'-'+title.join(''),
              title: title.join(''),
              value: value.join(''),
              attr: attr.join(''),
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
