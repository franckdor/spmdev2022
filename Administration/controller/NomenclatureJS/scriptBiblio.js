"use strict";
let requeteBiblio;
requeteB(callbackBiblio);
let requeteText;

let select = document.getElementById("bibliographie");
let textarea = document.getElementById("biblio");


select.addEventListener("change", listener)

function listener() {
    var option = select.options[select.selectedIndex].value;
    textarea.innerText=option;
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

function requeteT(callback, reference) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteText&reference=" + encodeURI(reference);
    if (requeteText && requeteText.readyState !== XMLHttpRequest.DONE) {
        requeteText.abort();
    }
    requeteText = new XMLHttpRequest();
    requeteText.open("GET", url, true);
    requeteText.addEventListener("load",  function () {
        callback(requeteText);
    });
    requeteText.send(null);
}

function callbackText(req) {
    let tab = JSON.parse(req.response);
}


function callbackBiblio(req) {
  var options = [];
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab['biblio'].length; i++) {
      var title = [];
        title.push(tab['biblio'][i].reference);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
            value: tab['biblio'][i].titre,
        }); 
  }

  let ref = document.getElementById("bibliographie");
    ref.addEventListener("change", requeteT(callbackText, ref.value));

  new TomSelect('#bibliographie',{
    maxItems: 1,
	maxOptions: 6000,
	valueField: 'value',
	labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    options: options,
    persist: false,
    create: true
  });

}