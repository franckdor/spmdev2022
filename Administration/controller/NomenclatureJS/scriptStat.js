const statut = document.getElementById('statut');
let requeteStat;

var select_status = new TomSelect("#statut", {
  maxItems:1,
  maxOptions: null,
  valueField: 'title',
  labelField: 'title',
  sortField: 'title',
  searchField: ['title'],
  create: false,
  hideSelected: true,
});


requeteSta(callback_STA);

//Request to the server
function requeteSta(callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteSTAT";
  if (requeteStat && requeteStat.readyState !== XMLHttpRequest.DONE) {
    requeteStat.abort();
  }
  requeteStat = new XMLHttpRequest();
  requeteStat.open("GET", url, true);
  requeteStat.addEventListener("load", function () {
      callback(requeteStat);//Callback = server response
  });
  requeteStat.send(null);
}

//Definition of callback function
function callback_STA(req) {
    let tab = JSON.parse(req.response);
    
    var status = [];

    for(let i=0; i<tab.length; i++) {

      var titleStat = [];

        titleStat.push(tab[i]);

        status.push({
            id: i+'-'+titleStat.join(''),
            title: titleStat.join(''),
        });
    }

    select_status.addOption(status);
    select_status.addItem(status);

}





