function requete(callback, requete, controller, action) {
    let url = "index.php?controller="+controller+"&action="+action;
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


function requeteValue(callback, requete, controller, action, value) {
    let url = "index.php?controller="+controller+"&action="+action+"&code=" + encodeURI(value);
    if (requete && requete.readyState !== XMLHttpRequest.DONE) {
        requete.abort();
    }
    requete = new XMLHttpRequest();
    requete.open("GET", url, true);
    requete.addEventListener("load",  function () {
        console.log(requete)
        callback(requete);
    });
    requete.send(null);
}


function complete(tab, tabBiblio) {
    let genusItem = tab[0];
    let speciesItem = tab[1];
    let audItem = tab[2];
    let statItem = tab[3];
    let VspeciesItem = tab[4] + " - " + tab[5];
    let biblioItem = {
      "item" : tabBiblio[0],
      "infos" : tabBiblio[1] + " - " + tabBiblio[2] + " - " + tabBiblio[3] + " - " + tabBiblio[4],
    };
    
    
  
    var speciesOption = document.createElement("option");
    var genusOption = document.createElement("option");
    var audOption = document.createElement("option");
    var VspeciesOption = document.createElement("option");
    var statOption = document.createElement("option");
  
  
    genusOption.setAttribute("title", genusItem);
    speciesOption.setAttribute("title", speciesItem);
    audOption.setAttribute("title", audItem);
    VspeciesOption.setAttribute("title", VspeciesItem);
    statOption.setAttribute("title", statItem);
  
  
    var speciesNode = document.createTextNode(speciesItem);
    var genusNode = document.createTextNode(genusItem);
    var audNode = document.createTextNode(audItem);
    var VspeciesNode = document.createTextNode(VspeciesItem);
    var statNode = document.createTextNode(statItem);
  
  
  
    genusOption.appendChild(genusNode);
    speciesOption.appendChild(speciesNode);
    audOption.appendChild(audNode);
    VspeciesOption.appendChild(VspeciesNode);
    statOption.appendChild(statNode);
  
  
    select_genus.addOption(genusOption);
    select_genus.addItem(genusItem);
    select_spe.addOption(speciesOption);
    select_spe.addItem(speciesItem);
    select_aut.addOption(audOption);
    select_aut.addItem(audItem);
    select_VSpe.addOption(VspeciesOption);
    select_VSpe.addItem(VspeciesItem);
    select_status.addOption(statOption);
    select_status.addItem(statItem);
    selBiblio.addItem(biblioItem.infos);
  
    }

    function completeGen(tab, tabBiblio) {
    
    genusItem = tab[0];
    tribeItem = tab[1];
    subFItem = tab[2];
    statItem = tab[3];
    let biblioItem = {
        "item" : tabBiblio[0],
        "infos" : tabBiblio[1] + " - " + tabBiblio[2] + " - " + tabBiblio[3] + " - " + tabBiblio[4],
      };

    var tribeOption = document.createElement("option");
    var genusOption = document.createElement("option");
    var subFOption = document.createElement("option");
    var statOption = document.createElement("option");

    genusOption.setAttribute("title", genusItem);
    tribeOption.setAttribute("title", tribeItem);
    subFOption.setAttribute("title", subFItem);
    statOption.setAttribute("title", statItem);

    var tribeNode = document.createTextNode(tribeItem);
    var genusNode = document.createTextNode(genusItem);
    var subFNode = document.createTextNode(subFItem);
    var statNode = document.createTextNode(statItem);

    genusOption.appendChild(genusNode);
    tribeOption.appendChild(tribeNode);
    subFOption.appendChild(subFNode);
    statOption.appendChild(statNode)


    genus.addOption(genusOption);
    genus.addItem(genusItem);
    tribe.addOption(tribeOption);
    tribe.addItem(tribeItem);
    sub_fam.addOption(subFOption);
    sub_fam.addItem(subFItem);
    select_status.addOption(statOption);
    select_status.addItem(statItem);
    selBiblio.addItem(biblioItem.value);
    }
