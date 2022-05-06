let requeteBiblio;
requeteB(callbackBiblio);
var select = document.createElement("SELECT");
select.setAttribute("id", "mySelect");
document.body.appendChild(select);

var selection = new TomSelect('#mySelect', {
	maxItems:1,
    maxOptions: null,
	valueField: 'value',
	labelField: 'title',
    searchField: ['title'],
	hideSelected: true,
});


function createSelect() {  
	var items = ["Foo","Bar","Zoo"];
	for(var i = 0;i<1;i++) {
	  var item = items[i];
	  var newOption = document.createElement("option");
	  newOption.setAttribute("value", item);
	  newOption.setAttribute("title", item);
	  var textNode = document.createTextNode(item);
	  newOption.appendChild(textNode);
	  selection.addOption(newOption);
	  selection.addItem(item);
	}
}

function requeteB(callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteBiblio";
    if (requeteBiblio && requeteBiblio.readyState !== XMLHttpRequest.DONE) {
        requeteBiblio.abort();
    }
    requeteBiblio = new XMLHttpRequest();
    requeteBiblio.open("GET", url, true);
    requeteBiblio.addEventListener("load",  function () {
		console.log(requeteBiblio);
        callback(requeteBiblio);
    });
    requeteBiblio.send(null);
}

function callbackBiblio(req) {
	var options = [];
	let tab = JSON.parse(req.response);
	for (var i=0; i<tab['biblio'].length; i++) {
		var title = [];
		  title.push(tab['biblio'][i].reference);
		  options.push({
			  id: i+'-'+title.join(''),
			  title: title.join(''),
			  value: tab['biblio'][i].titre,
		  }); 
	}
    selection.addOption(options);
  }