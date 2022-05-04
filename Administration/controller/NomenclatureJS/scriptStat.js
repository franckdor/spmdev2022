const statut = document.getElementById('statut');
let requeteStat;


maRequeteSTAT();



  
//displays in <SELECT> differents status
function afficheStat(tableau) {
  for (let i=0; i<tableau.length; i++) {
      var o = document.createElement("option");
      o.innerHTML = tableau[i];
      statut.appendChild(o);
  }
  if(tableau.length > 0) o.style.borderWidth = "1px";
}


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

function callback_1(req) {
    console.log(req.response);
}

//Definition of callback function
function callback_STA(req) {
    let tab = JSON.parse(req.response);
    let tab2 = [];
    tab.forEach(element => {
      tab2.push(element);
    });
    afficheStat(tab2);
}


function maRequeteSTAT() {
  requeteSta(callback_STA);
}




