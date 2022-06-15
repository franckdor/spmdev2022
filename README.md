# Bienvenue sur le projet SpiderMitesWeb !

Ajout d'une interface administrateur au site [SpiderMitesWeb](https://www1.montpellier.inra.fr/CBGP/spmweb/),
impliquant l'ajout de données et la gestion des utilisateurs.


## Langages utilisés ?

+ HTML5, CSS3
+ JavaScript, AJAX
+ PHP, PgSQL ( avec tables relationnelles )


## Problématique

faire migrer une base de données Access sur un système Unix-PostgreSQL déjà existant.
développer en PhP, une partie d'administration permettant d’interroger et d’insérer des tuples dans la base de données. La base de données est relative à la systématique, plantes hôtes et distribution des acariens Tetranychidae, ravageurs de plantes.

Le site SpiderMitesWeb permet à des chercheurs du monde entier ou des professionnels de la protection des végétaux, travaillant sur les acariens ravageurs de plantes, d’obtenir des informations sur ces organismes.


## Exemple d'implémentation

Partie existante : <br/>
![Formulaire insertion de genre sous Access](https://user-images.githubusercontent.com/78204251/173914866-3e53e9d3-a6e4-429b-9b48-2408e7e5d4a3.png)




Partie implémentée sur le site : <br>


![Espece ajout](https://user-images.githubusercontent.com/78204251/173915234-069cf615-8120-44c3-bfd4-6e44950f6680.png)

![Formulaire insertion de genre sous PostgreSQL](https://user-images.githubusercontent.com/78204251/173914890-49abcb0f-0fb6-4ec7-be83-d52026dfde8f.png)


Le patron de conception utilisé est le MVC. 
J'utilise l'API ![TomSelect](https://tom-select.js.org/) pour créer des listes de recherches.
L'utilisation d'Ajax permet de réaliser des requêtes vers le serveur pour l'autocomplétion des champs du formulaire. <br/>
Le travail est toujours en cours...







