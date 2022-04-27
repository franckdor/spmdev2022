let requeteESPE;
let requeteESPEV;
requeteESP(callback_ESP);


function requeteESP(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteEsp";
    if (requeteESPE && requeteESPE.readyState !== XMLHttpRequest.DONE) {
      requeteESPE.abort();
    }
    requeteESPE = new XMLHttpRequest();
    requeteESPE.open("GET", url, true);
    requeteESPE.addEventListener("load", function () {
        callback(requeteESPE);
    });
    requeteESPE.send(null);
}

function requeteESPV(callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteEspV";
  if (requeteESPEV && requeteESPEV.readyState !== XMLHttpRequest.DONE) {
    requeteESPEV.abort();
  }
  requeteESPEV = new XMLHttpRequest();
  requeteESPEV.open("GET", url, true);
  requeteESPEV.addEventListener("load", function () {
      callback(requeteESPEV);
  });
  requeteESPEV.send(null);
}





function callback_ESP(req) {
  var options = [];
  let tab = JSON.parse(req.response);
  for (var i=0; i<tab.length; i++) {
      var title = [];
      title.push(tab[i].nom_espece);
      options.push({
          id: i+'-'+title.join(''),
          title: title.join(''),
      });
  }

  new TomSelect('#select-espece',{
    maxItems: 1,
	  maxOptions: 6000,
	  valueField: 'title',
	  labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    options: options,
    persist: false,
    create: true
  });

}






