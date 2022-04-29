let log = document.getElementById("log");

let url = "index.php?controller=nomenclature_espece&action=autocompleteBiblio";
let url2 = "index.php?controller=nomenclature_espece&action=autocompleteText&reference=";

async function getFetchData() {
	await fetch(url).then(response => response.json())
	.then(value => value.biblio.forEach(element => {
		log.insertAdjacentHTML('beforeend', `<p>${element.reference}</p>`)
	}))
	.then(value => console.log(value.biblio))
	.catch(error => console.log(error))
}

const but = document.getElementById("btn");
btn.addEventListener("click", getFetchData);




/*
async function getAllRef(url) {
	console.log("Initialisation de la promesse sur les références");
	return new Promise(function (resolve, reject) {
		var xhr = new XMLHttpRequest();
		xhr.open('get', url, true);
		xhr.onload = function () {
			var status = xhr.status;
			if (status == 200) {
				resolve(xhr.response);
				console.log("Je fais un truc");
			} else {
				reject(status);
			}
		};
		xhr.send();
	});
}

async function loader() {
	console.log("je suis la fonction loader");
	let request = await getAllRef(url);
	console.log(request.status);
	console.log(request.response);
}*/

