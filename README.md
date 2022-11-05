<p align="center">
  <img src="/assets/php_mysql_logo.png" />
</p>

# PHP/MYSQL Project *(English)*

## Objective
To develop a Full stack web application using an Apache server, a MySQL database and using PHP as the main programming language.<br/> 

For this project I wanted to learn about PHP and MySQL databases to produce a full stack web application. The basis for this project comes from the OpenClassrooms course [Design your website with PHP and MySQL](https://openclassrooms.com/en/courses/918836-concevez-votre-site-web-avec-php-et-mysql) *(in french)*. I used as a starting point...</br> 
As the course does not explain everything, I found myself completing the functionality the be able to actually send an attachment as well as form validation, for example, which are not coverded in the course.</br>
The site is not very inspiring (yet another recipe website, why is Openclassrooms obsessed with recipe websites?) and the css styling is simple, but the idea behind this project was to discover new programming languages and not to produce a production ready application.
## Features
- [x] Create an account page 
- [x] Log in page 
- [x] Recipes viewing page
- [x] Create a recipe page 
- [x] Read a recipe page
- [x] Update a recipe page 
- [x] Delete a recipe page
- [x] Contact Us page  
- [x] Form validation : valid input/password strength checking, existing user check etc...
- [x] File Uploading & sending

## Skills
- [x] Setting up the relevant front-end environment
- [x] Developing a web dynamic application using PHP
- [x] Developing web application using MySQL database
- [x] Managing site events with PHP


# Installation *(English)*

## Prerequisites

- [MAMP](https://www.mamp.info/en/downloads/older-versions/)  Version 4.2.0
- [Visual Studio Code](https://code.visualstudio.com/) or another IDE of your choice


## Installing and running the project


- Download and Install MAMP :<br/>

Once downloaded, install it. There are afew options. If you are offered to install MAMP Pro, say no, because it is a paid program and you won't need it. MAMP alone is enough.<br/>

Clone this repository onto your computer and put it in<br/>

- [x] C:MAMP/htdocs under Windows 
- [x] /Applications/MAMP/htdocs under Mac.<br/>

Note: If you decide to keep the project elsewhere, don't forget to change the server document root: <br/>
To do this: Once you've started MAMP, click on MAMP > preferences > Webserver & change document root to the relevant folder<br/>

Start MAMP which starts Apache and MySQL (you may have to click on "Start Servers"). You should see the little green LEDs at the top right of the window. This may take a little while for these programs to start.<br/>

If a window appears telling you that the firewall is blocking Apache or MySQL, click on "Allow Access" (it is normal).<br/>

Click on MAMP > preferences > PHP & change the Standard version to 7.3.7<br/>


- Install Database

When MAMP has successfully launched Apache and MySQL, click on the "Open WebStart Page" button in the middle, which allows you to open the MAMP home page in your browser.<br/>

Click Tools > phpMyAdmin : This will open a new window, giving you access to the MYSQL database. You can import the database file `creation_base.sql` you will find in the folder `SQL` to setup the database for this project.


- Run the Api:

If you've done everything correctly, then when you click on `My Website` on the MAMP home page in your browser the project should open.</br>

Enjoy

<p align="center">
  <img src="/assets/php_mysql_logo.png" />
</p>

# Projet PHP/MYSQL *(français)*

## Objectif
Développer une application Web Full stack en utilisant un serveur Apache, une base de données MySQL et en utilisant PHP comme langage de programmation principal.<br/>

Pour ce projet, je voulais en savoir plus sur les bases de données PHP et MySQL afin de produire une application Web complète. La base de ce projet provient du cours OpenClassrooms [Concevez votre site web avec PHP et MySQL](https://openclassrooms.com/en/courses/918836-concevez-votre-site-web-avec-php-et-mysql) *(en français)*. J'ai utilisé comme point de départ...</br>
Comme le cours n'explique pas tout, je me suis retrouvé à compléter la fonctionnalité pour pouvoir réellement envoyer une pièce jointe ainsi que la validation de formulaire, par exemple, qui ne sont pas abordés dans le cours.</br>
Le site n'est pas très inspirant (encore un autre site de recettes, pourquoi Openclassrooms est-il obsédé par les sites de recettes ?) et le style css est simple, mais l'idée derrière ce projet était de découvrir de nouveaux langages de programmation et non de produire une application prête à la production.
## Fonctionnalités
- [x] Créer une page de compte
- [x] Page de connexion
- [x] Page de visualisation des recettes
- [x] Créer une page de recette
- [x] Lire une page de recette
- [x] Mettre à jour une page de recette
- [x] Supprimer une page de recette
- [x] Page Contactez-nous
- [x] Validation du formulaire : vérification de la force des entrées/mots de passe valides, vérification des utilisateurs existants, etc.
- [x] Téléchargement et envoi de fichiers

## Compétences
- [x] Mise en place de l'environnement frontal pertinent
- [x] Développement d'une application web dynamique en PHP
- [x] Développement d'une application Web à l'aide de la base de données MySQL
- [x] Gestion des événements du site avec PHP


# Installation *(français)*

## Conditions préalables

- [MAMP](https://www.mamp.info/en/downloads/older-versions/) Version 4.2.0
- [Code Visual Studio](https://code.visualstudio.com/) ou un autre IDE de votre choix


## Installer et exécuter le projet


- Téléchargez et installez MAMP :<br/>

Une fois téléchargé, installez-le. Il y a quelques options. Si on vous propose d'installer MAMP Pro, dites non, car c'est un programme payant et vous n'en aurez pas besoin. MAMP seul suffit.<br/>

Clonez ce référentiel sur votre ordinateur et placez-le dans<br/>

- [x] C:MAMP/htdocs sous Windows 
- [x] /Applications/MAMP/htdocs sous Mac.<br/>

Remarque : Si vous décidez de conserver le projet ailleurs, n'oubliez pas de modifier la racine du document serveur : <br/>
Pour ce faire : une fois que vous avez démarré MAMP, cliquez sur MAMP > Préférences > Serveur Web et modifiez la racine du document dans le dossier approprié<br/>

Démarrez MAMP qui démarre Apache et MySQL (vous devrez peut-être cliquer sur "Démarrer les serveurs"). Vous devriez voir les petites LED vertes en haut à droite de la fenêtre. Le démarrage de ces programmes peut prendre un certain temps.<br/>

Si une fenêtre apparaît vous indiquant que le pare-feu bloque Apache ou MySQL, cliquez sur "Autoriser l'accès" (c'est normal).<br/>

Cliquez sur MAMP > Préférences > PHP et changez la version Standard en 7.3.7<br/>


- Installer la base de données

Lorsque MAMP a lancé avec succès Apache et MySQL, cliquez sur le bouton "Ouvrir la page de démarrage Web" au milieu, ce qui vous permet d'ouvrir la page d'accueil de MAMP dans votre navigateur.<br/>
Cliquez sur Outils > phpMyAdmin : Cela ouvrira une nouvelle fenêtre, vous donnant accès à la base de données MYSQL. Vous pouvez importer le fichier de base de données `creation_base.sql` que vous trouverez dans le dossier `SQL` pour configurer la base de données pour ce projet.


- Exécutez l'API :

Si vous avez tout fait correctement, lorsque vous cliquez sur "Mon site Web" sur la page d'accueil MAMP de votre navigateur, le projet devrait s'ouvrir.</br>



