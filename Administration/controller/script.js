const auto = document.getElementById("autocompletion");
const espece = document.getElementById('espece');
let timeout; 

videEspece();

espece.addEventListener("input", () => {
    if (espece.value.length > 2) {
      if (!timeout) {
        clearTimeout();
      }
      timeout = setTimeout(function () {
      maRequeteAJAX(espece.value);
    }, 200);
  }
});
  

function afficheEspece(tableau) {
    videEspece();
    for (let i=0; i<tableau.length; i++) {
        var p = document.createElement("p");
        p.innerHTML = tableau[i];
        auto.appendChild(p);
    }
    if(tableau.length > 0) auto.style.borderWidth = "1px";
}
  
function videEspece() {
    auto.innerHTML = "";
    auto.style.boderWidth = "0px 0px 0px 0px";
}

let requete;
function requeteAJAX(stringEspece, callback) {
    let url = "index.php?controller=nomenclature_espece&action=requete&espece=" + encodeURIComponent(stringEspece);
    console.log(url);
    if (requete && requete.readyState !== XMLHttpRequest.DONE) {
      requete.abort();
    }
    requete = new XMLHttpRequest();
    requete.open("GET", url, true);
    requete.addEventListener("load", function () {
        callback(requete);
    });
    requete.send(null);
}

function callback_1(req) {
    console.log(req.responseText);
}

function callback_4(req) {
    let tab = JSON.parse(JSON.stringify(req));
    let tab2 = [];
    tab.forEach(element => {
      tab2.push(element.name);
    });
    afficheEspece(tab2);
}

function maRequeteAJAX(stringEspece) {
    requeteAJAX(stringEspece, callback_4);
}