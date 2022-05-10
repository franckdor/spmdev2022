let requeteFill;
let requeteRef;

var search_species = new TomSelect('#search-species',{
    maxItems: 1,
    maxOptions: 200,
    valueField: 'title',
    labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    hideSelected: true,
    create: false
  });
/*
  var search_ref = new TomSelect('#search-ref',{
    maxItems: 1,
    maxOptions: 200,
    valueField: 'title',
    labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    hideSelected: true,
    create: false
  });
*/
requete(callbackSearch);
requeteReference(callbackReference);

function requete(callback) {
  let url = "index.php?controller=nomenclature_espece&action=all";
  if (requeteFill && requeteFill.readyState !== XMLHttpRequest.DONE) {
    requeteFill.abort();
  }
  requeteFill = new XMLHttpRequest();
  requeteFill.open("GET", url, true);
  requeteFill.addEventListener("load", function () {
    console.log(requeteFill);
    callback(requeteFill);
  });
  requeteFill.send(null);
}

function requeteReference(callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteBiblio";
  if (requeteRef && requeteRef.readyState !== XMLHttpRequest.DONE) {
    requeteRef.abort();
  }
  requeteRef = new XMLHttpRequest();
  requeteRef.open("GET", url, true);
  requeteRef.addEventListener("load", function () {
    console.log(requeteRef);
    callback(requeteRef);
  });
  requeteRef.send(null);
}

function callbackSearch(req) {
    var searchSpe = [];
    
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var titleRS = [];

        titleRS.push(tab[i].espece + " - " + tab[i].genre + " - " + tab[i].auteur_date + " - " + tab[i].statut);
  
        searchSpe.push({
          id: i+'-'+titleRS.join(''),
          title: titleRS.join(''),
      });

        search_species.addOption(searchSpe);
    }
  
}

function callbackReference(req) {
  var searchRef = [];
  
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab.length; i++) {
      var titleRF = [];

      titleRF.push(tab[i]);

      searchRef.push({
        id: i+'-'+titleRF.join(''),
        title: titleRF.join(''),
    });

      search_ref.addOption(searchRef);
  }

}