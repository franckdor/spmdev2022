let requeteGEND;

requeteGEN(callback_GEN);

//Getting data from DB via action autocomplete in CONTROLLER
function requeteGEN(callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteGen";
  if (requeteGEND && requeteGEND.readyState !== XMLHttpRequest.DONE) {
    requeteGEND.abort();
  }
  requeteGEND = new XMLHttpRequest();
  requeteGEND.open("GET", url, true);
  requeteGEND.addEventListener("load", function () {
      callback(requeteGEND);
  });
  requeteGEND.send(null);
}

//Called function to fulfill the options
function callback_GEN(req) {
  var options = [];
  let tab = JSON.parse(req.response);

  for (var i=0; i<tab.length; i++) {
    var title = [];
    title.push(tab[i].nom_genre);
    options.push({
        id: i+'-'+title.join(''),
        title: title.join(''),
    });
    
  }
//Using TomSelect API for better searching settings
  new TomSelect('#select-genre',{
    maxItems: 1,
	  maxOptions: 200,
	  valueField: 'title',
	  labelField: 'title',
    searchField: ['title'],
    sortField: 'title',
    options: options,
    persist: false,
    create: true
  });


}



