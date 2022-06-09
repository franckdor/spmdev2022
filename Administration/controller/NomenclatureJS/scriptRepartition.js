let requeteFill;
let requeteCount;


requete(callbackSearch);
requeteCountry(callbackCountry);

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


function requeteCountry(callback) {
    let url = "index.php?controller=repartition&action=selectCountry";
    if (requeteCount && requeteCount.readyState !== XMLHttpRequest.DONE) {
        requeteCount.abort();
    }
    requeteCount = new XMLHttpRequest();
    requeteCount.open("GET", url, true);
    requeteCount.addEventListener("load", function () {
      callback(requeteCount);
    });
    requeteCount.send(null);
}

function callbackCountry(req) {
    let tab = JSON.parse(req.response);

    console.log(tab)

    var options = [];
    for(var i=0; i<tab.length; i++) {
        var titleCountry = [];
        var value = [];

        titleCountry.push(tab[i].pays);
        value.push(tab[i].zone_biogeo);

        options.push({
            id: i+'-'+titleCountry.join(''),
            title: titleCountry.join(''),
            value: titleCountry + " - " +value.join(''),
        });
        
    }

    new TomSelect('#search-country',{
        maxItems: 1,
        maxOptions: 1000,
        valueField: 'value',
        labelField: 'title',
        searchField: ['title'],
        sortField: 'title',
        hideSelected: true,
        options: options,
        create: false,
      });

}

let selectSpecies = document.getElementById("search-species");
let selectCountry = document.getElementById("search-country");
let textSpe = document.getElementById("species");
let textCount = document.getElementById("country");
textSpe.addEventListener('focus', autoResize, false);
textCount.addEventListener('focus', autoResize, false);

selectSpecies.addEventListener("change", textSpeFill);
selectCountry.addEventListener("change", textCountFill);

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


function textSpeFill() {
    var option = selectSpecies.options[selectSpecies.selectedIndex].value;
    textSpe.innerText = option;
    textSpe.focus();
}

function textCountFill() {
    var option = selectCountry.options[selectCountry.selectedIndex].value;
    console.log(option);
    textCount.innerText = option;
    textCount.focus();
}

function autoResize() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
}
const buttonSpecies = document.getElementById("buttonSpecies"); 
buttonSpecies.addEventListener("click", () => {
    window.open("index.php?action=read&controller=nomenclature_espece&id_nomenclature_espece="+selectSpecies.tomselect.options[selectSpecies.tomselect.items].attr,'popUpWindow','height=600,width=800,left=10,top=10,,scrollbars=no,menubar=no');
    return false;
});

