
const autoGEN = document.getElementById("autocompletionGEN");

const genre = document.getElementById('genre');
let timeout; 


videGEN();

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


autoGEN.addEventListener("click", function(e)  {
  videGEN();
  genre.value = e.target.innerText;
});
  

function afficheGEN(tableau) {
  videGEN();
  for (let i=0; i<tableau.length; i++) {
      var p = document.createElement("p");
      p.innerHTML = tableau[i];
      autoGEN.appendChild(p);
  }
  if(tableau.length > 0) autoGEN.style.borderWidth = "1px";
}

function videGEN() {
  autoGEN.innerHTML = "";
  autoGEN.style.boderWidth = "0px 0px 0px 0px";
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




