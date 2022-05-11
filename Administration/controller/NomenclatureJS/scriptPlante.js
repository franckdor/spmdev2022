let requeteFill;
let requetePlant;


requetePlants(callbackPlant);
requete(callbackSearch);
let selectSpecies = document.getElementById("search-species");
let textSpe = document.getElementById("species");

selectSpecies.addEventListener("change", textSpeFill);


function textSpeFill() {
  var option = selectSpecies.options[selectSpecies.selectedIndex].value;
  textSpe.innerText = option;
}


function requete(callback) {
  let url = "index.php?controller=nomenclature_espece&action=all";
  if (requeteFill && requeteFill.readyState !== XMLHttpRequest.DONE) {
    requeteFill.abort();
  }
  requeteFill = new XMLHttpRequest();
  requeteFill.open("GET", url, true);
  requeteFill.addEventListener("load", function () {

    callback(requeteFill);
  });
  requeteFill.send(null);
}

function requetePlants(callback) {
  let url = "index.php?controller=plants&action=searchPlant";
  if (requetePlant && requetePlant.readyState !== XMLHttpRequest.DONE) {
    requetePlant.abort();
  }
  requetePlant = new XMLHttpRequest();
  requetePlant.open("GET", url, true);
  requetePlant.addEventListener("load", function () {
    console.log(requetePlant);
    callback(requetePlant);
  });
  requetePlant.send(null);
}



function callbackSearch(req) {
    var searchSpe = [];
    
    let tab = JSON.parse(req.response);
    for (var i=0; i<tab.length; i++) {
        var titleRS = [];
        var value = [];

        titleRS.push(tab[i].espece + " - " + tab[i].genre + " - " + tab[i].auteur_date + " - " + tab[i].statut);
        value.push(tab[i].genre + " " + tab[i].espece + " " + tab[i].auteur_date + "\n " + tab[i].statut);

        searchSpe.push({
          id: i+'-'+titleRS.join(''),
          title: titleRS.join(''),
          value: value.join(''),
      });

    }
  
    new TomSelect('#search-species',{
      maxItems: 1,
      maxOptions: 800,
      valueField: 'value',
      labelField: 'title',
      searchField: ['title'],
      sortField: 'title',
      hideSelected: true,
      create: false,
      options: searchSpe,
    });
}

function callbackPlant(req) {
  var searchPlant = [];
  
  let tab = JSON.parse(req.response);
  console.log(tab);
  for (var i=0; i<tab.length; i++) {
      var titleP = [];
      //var value = [];

      titleP.push(tab[i].species + " - " + tab[i].genus);
      //value.push(tab[i].genre + " " + tab[i].espece + " " + tab[i].auteur_date + "\n " + tab[i].statut);

      searchPlant.push({
        id: i+'-'+titleP.join(''),
        title: titleP.join(''),
        //value: value.join(''),
    });

  }

  new TomSelect('#search-plants',{
    maxItems: 1,
    maxOptions: 800,
    valueField: 'title',
    labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    hideSelected: true,
    create: false,
    options: searchPlant,
  });
}
