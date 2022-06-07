"use strict";
let requeteBiblio;
requeteB(callbackBiblio);

let hiddenBiblio = document.getElementById("code_biblio");


let selectBiblio = document.getElementById("bibliographie");
let textareab = document.getElementById("biblio");
setTimeout(() => {
    textareab.focus();
}, 2000);


selectBiblio.addEventListener("change", listener)

function listener() {
    var option = selectBiblio.options[selectBiblio.selectedIndex].value;
    textareab.innerText=option;
    textareab.focus();
    hiddenBiblio.value = selectBiblio.tomselect.options[selectBiblio.tomselect.items].attr;
    console.log(hiddenBiblio.value);
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

        title.push(tab[i].reference);
        attr.push(tab[i].code_bibliographie);
        value.push(tab[i].auteur + " - " +  tab[i].annee + " - " + tab[i].titre + " - " + tab[i].source);
        options.push({
            id: i+'-'+title.join(''),
            title: title.join(''),
            value: value.join(''),
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
    create: true,
    hideSelected: true,
  });

}

let textarea = document.getElementById("biblio");
        textarea.addEventListener('focus', autoResize, false);
      
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }