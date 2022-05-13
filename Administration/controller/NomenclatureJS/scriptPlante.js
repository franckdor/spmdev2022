let requeteFill;
let requetePlant;
const buttonPlants = document.getElementById("buttonPlants");
const buttonRef = document.getElementById("buttonRef");
const buttonSpecies = document.getElementById("buttonSpecies");

requetePlants(callbackPlant);
requete(callbackSearch);

let selectSpecies = document.getElementById("search-species");
let textSpe = document.getElementById("species");

let selectPlants = document.getElementById("search-plants");
let textPlant = document.getElementById("plant");

selectSpecies.addEventListener("change", textSpeFill);
selectPlants.addEventListener("change", textPlantFill);

buttonPlants.addEventListener("click", () => {
  window.open("index.php?action=update&controller=plants",'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
  return false;
});

buttonRef.addEventListener("click", () => {
  window.open("index.php?action=update&controller=plants",'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
  return false;
});

buttonSpecies.addEventListener("click", () => {
  window.open("index.php?action=read&controller=nomenclature_espece&id_nomenclature_espece="+selectSpecies.tomselect.options[selectSpecies.tomselect.items].attr,'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
  return false;
});

function textSpeFill() {
  var option = selectSpecies.options[selectSpecies.selectedIndex].value;
  textSpe.innerText = option;
}

function textPlantFill() {
  var option = selectPlants.tomselect.options[selectPlants.tomselect.items].value;
  textPlant.innerText = option;
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
        var attr = [];

        titleRS.push(tab[i].espece + " - " + tab[i].genre + " - " + tab[i].auteur_date + " - " + tab[i].statut);
        value.push(tab[i].genre + " - " + tab[i].espece + " - " + tab[i].auteur_date + " - " + tab[i].statut);
        attr.push(tab[i].id);

        searchSpe.push({
          id: i+'-'+titleRS.join(''),
          title: titleRS.join(''),
          value: value.join(''),
          attr: attr.join(''),
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
  for (var i=0; i<tab.length; i++) {
      var titleP = [];
      var value = [];
      var attr = [];
      

      titleP.push(tab[i].species + " - " + tab[i].genus);
      value.push(tab[i].species + " - " + tab[i].genus);
      attr.push(tab[i].id);


      searchPlant.push({
        id: i+'-'+titleP.join(''),
        title: titleP.join(''),
        value: value.join(''),
        attr: attr.join(''),
    });
  }

  new TomSelect('#search-plants',{
    maxItems: 1,
    maxOptions: 20000,
    valueField: 'value',
    labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    hideSelected: true,
    create: false,
    options: searchPlant,
  });

}
