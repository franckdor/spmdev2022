"use strict";
let requeteBiblio;
requete(callbackBiblio, requeteBiblio, "nomenclature_espece", "autocompleteBiblio");

var selBiblio = new TomSelect('#bibliographie',{
    maxItems: 1,
	maxOptions: 6000,
	valueField: 'value',
	labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    persist: false,
    create: true,
    hideSelected: true,
  });

let selectBiblio = document.getElementById("bibliographie");
let textareab = document.getElementById("biblio");
setTimeout(() => {
    textareab.focus();
}, 2000);


selectBiblio.addEventListener("change", () => {
    setTimeout(listener, 200);
});

function listener() {
    var option = selBiblio.options[selBiblio.items].value;
    textareab.innerText=option;
    textareab.focus();
    if (document.getElementById("code_biblio") !== null) {
        let hiddenBiblio = document.getElementById("code_biblio");
        hiddenBiblio.value = selBiblio.options[selBiblio.items].attr;
    }
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
            id: title.join(''),
            title: title.join(''),
            value: value.join(''),
            attr: attr.join(''),
        }); 
        
  }

  selBiblio.addOption(options);


  

}

let textarea = document.getElementById("biblio");
        textarea.addEventListener('focus', autoResize, false);
      
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }