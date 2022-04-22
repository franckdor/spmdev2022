const aut = document.getElementById('authd');

let tab = getAllData();
function getAllData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?controller=nomenclature_espece&action=autocompleteAut', true);
    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            tab = response;
            console.log(tab);
        }
    };
    xhr.send();
}


var control = new TomSelect(aut, {
    persist: false,
	createOnBlur: true,
	create: true
});