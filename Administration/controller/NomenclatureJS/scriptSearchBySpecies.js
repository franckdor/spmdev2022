let requeteFill;

requete(callbackSearch);

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


function callbackSearch(req) {
    var searchSpe = [];
    
    let tab = JSON.parse(req.response);
    console.log(tab);
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