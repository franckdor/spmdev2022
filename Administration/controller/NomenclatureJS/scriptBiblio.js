"use strict";
let requeteBiblio;
requeteB(callbackBiblio);

let selectBiblio = document.getElementById("bibliographie");
let textarea = document.getElementById("biblio");


selectBiblio.addEventListener("change", listener)

function listener() {
    var option = selectBiblio.options[selectBiblio.selectedIndex].value;
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


function callbackBiblio(req) {
  var options = [];
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab['biblio'].length; i++) {
      var title = [];
      var attr = [];
        title.push(tab['biblio'][i].reference);
        attr.push(tab['biblio'][i].code_bibliographie);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
            value: tab['biblio'][i].titre,
            attr: attr.join(''),
        }); 
  }


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