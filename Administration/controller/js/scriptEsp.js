const espece = document.getElementById('espece');
const autoESP = document.getElementById("autocompletionESP");

/*
videESP();

espece.addEventListener("input", () => {
    if (espece.value.length > 1) {
      if (!timeout) {
        clearTimeout();
      }
      timeout = setTimeout(function () {
      maRequeteESP(espece.value);
    }, 200);
  }
});

autoESP.addEventListener("click", function(e)  {
    videESP();
    espece.value = e.target.innerText;
});

function afficheESP(tableau) {
    videESP();
    for (let i=0; i<tableau.length; i++) {
        var p = document.createElement("p");
        p.innerHTML = tableau[i];
        autoESP.appendChild(p);
    }
    if(tableau.length > 0) autoESP.style.borderWidth = "1px";
}
  
function videESP() {
    autoESP.innerHTML = "";
    autoESP.style.boderWidth = "0px 0px 0px 0px";
}

let requeteESPE;
function requeteESP(stringEspece, callback) {
    let url = "index.php?controller=nomenclature_espece&action=autocompleteEsp&espece=" + encodeURIComponent(stringEspece);
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

function callback_ESP(req) {
    let tab = JSON.parse(req.response);
    let tab2 = [];
    tab.forEach(element => {
      tab2.push(element.nom_espece);
    });
    console.log(tab2);
    afficheESP(tab2);
}

function maRequeteESP(stringEspece) {
    requeteESP(stringEspece, callback_ESP);
}
*/
var control = new TomSelect('#espece',{
	persist: false,
	createOnBlur: true,
	create: true
});



new TomSelect("#genre",{
	persist: false,
	createOnBlur: true,
	create: true
});

