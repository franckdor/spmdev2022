const autoESP = document.getElementById("autocompletionESP");
const autoGEN = document.getElementById("autocompletionGEN");
const espece = document.getElementById('espece');
const genre = document.getElementById('genre');
let timeout; 

videESP();
videGEN();

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

genre.addEventListener("input", () => {
  if (genre.value.length > 1) {
    if (!timeout) {
      clearTimeout();
    }
    timeout = setTimeout(function () {
    maRequeteGEN(genre.value);
  }, 200);
}
});

autoESP.addEventListener("click", function(e)  {
  videESP();
  espece.value = e.target.innerText;
});

autoGEN.addEventListener("click", function(e)  {
  videGEN();
  genre.value = e.target.innerText;
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

function afficheGEN(tableau) {
  videGEN();
  for (let i=0; i<tableau.length; i++) {
      var p = document.createElement("p");
      p.innerHTML = tableau[i];
      autoGEN.appendChild(p);
  }
  if(tableau.length > 0) autoESP.style.borderWidth = "1px";
}

function videGEN() {
  autoGEN.innerHTML = "";
  autoGEN.style.boderWidth = "0px 0px 0px 0px";
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

let requeteGEND;
function requeteGEN(stringGender, callback) {
  let url = "index.php?controller=nomenclature_espece&action=autocompleteGen&genre=" + encodeURIComponent(stringGender);
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

function callback_1(req) {
    console.log(req.response);
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

function callback_GEN(req) {
    let tab = JSON.parse(req.response);
    console.log(req);
    let tab2 = [];
    tab.forEach(element => {
      tab2.push(element.nom_genre);
    });
    console.log(tab2);
    afficheGEN(tab2);
}

function maRequeteGEN(stringGender) {
  requeteGEN(stringGender, callback_GEN);
}

function maRequeteESP(stringEspece) {
  requeteESP(stringEspece, callback_ESP);
}