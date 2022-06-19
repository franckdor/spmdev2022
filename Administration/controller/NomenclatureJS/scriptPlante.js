let requeteFill;
let requetePlant;
let requeteSpe

const buttonPlants = document.getElementById("buttonPlants");
const buttonRef = document.getElementById("buttonRef");
const buttonSpecies = document.getElementById("buttonSpecies");

requete(callbackPlant, requetePlant, "plants", "searchPlant");
requete(callbackSearch, requeteSpe, "plants", "autocompleteEsp");

let selectSpecies = document.getElementById("search-species");
let textSpe = document.getElementById("species");
textSpe.addEventListener('focus', autoResize, false);

let selectPlants = document.getElementById("search-plants");
let textPlant = document.getElementById("plant");
textPlant.addEventListener('focus', autoResize, false);

selectSpecies.addEventListener("change", textSpeFill);
selectPlants.addEventListener("change", textPlantFill);

var id_plante = document.getElementById("id_plant");



  buttonRef.addEventListener("click", () => {
    window.open("index.php?action=read&controller=bibliographie&id="+encodeURIComponent(selectBiblio.tomselect.options[selectBiblio.tomselect.items].attr),'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
    return false;
  });


buttonSpecies.addEventListener("click", () => {
  window.open("index.php?action=read&controller=nomenclature_espece&id_nomenclature_espece="+selectSpecies.tomselect.options[selectSpecies.tomselect.items].attr,'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
  return false;
});

function textSpeFill() {
  var option = selectSpecies.options[selectSpecies.selectedIndex].value;
  textSpe.innerText = option;
  textSpe.focus();
}

function textPlantFill() {
  var option = selectPlants.tomselect.options[selectPlants.tomselect.items].value;
  textPlant.innerText = option;
  id_plante.value = selectPlants.tomselect.options[selectPlants.tomselect.items].attr;
  textPlant.focus();
}
/*
buttonPlants.addEventListener("click", () => {
  window.open("index.php?action=update&controller=plants",'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
  return false;
});
*/




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
      maxOptions: 14000,
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
      value.push(tab[i].scientific_name + " - " + tab[i].family);
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

      
function autoResize() {
  this.style.height = 'auto';
  this.style.height = this.scrollHeight + 'px';
}