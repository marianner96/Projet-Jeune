# Projet Jeune 6.4

## Installation

Pour installer le projet, il suffit mettre le contenu de ce dossier là où vous voulez qu'il soit dans votre site web. 
Normalement l'url de base du projet est reconnue automatiquement mais vous pouvez la configurer dans ```application/config/config.php```.  
Pour ce qui est de la base de donnée, la configuration pour MySQL et SQLite est déjà faite mais d'autre drivers peuvent être utlisés au 
besoin, cf la documentation de [CodeIngiter](https://codeigniter.com/).

**Note** Ce projet fonctionne en grande partie sur webetu : seul les mails et la connexion via Twitter sont indisponnibles. Si vous voulez lancer le site en serveur local effectuez la commande 
```php -S localhost:8080``` à la racine du projet. Vous pourrez ensuite y accéder en vous connectant à ```http://localhost:8080```.

**Note 2** En cas de warning de la part des fonctions SQL, veuillez passer l'environnement de ```development``` à ```testing``` dans le fichier ```index.php``` à la racine du projet : 

```php
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'testing');
```

### Base de données

Pour configurer la base de données avec MySQL, modifiez dans le fichier ```application/config/database.php```, les champs ```database```, ```password```, ```username``` et ```hostname``` à cet endroit :
```php
$db['mysql'] = array(
	'dsn'	=> '',
	'hostname' => '',
	'username' => '',
	'password' => '',
	'database' => '',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

Pour créer la base de données, importer le fichier ```db.sql``` dans votre interface d'administration MySQL.  
**Attention :** Ce fichier n'est pas compatible avec SQLite !!

Un compte fictif sera créer pour vous permettre de vous connecter la première fois : 
 - Email : rogerdu64@gmai.com
 - Mot de passe  : roger64

Ce compte dispose des droits d'administration.

Notez aussi que des savoir-être vont aussi etre créés. Vous pourrez à tout moment les supprimer dans l'interface d'administration.

### Connexion avec twitter :bird:

Pour supporter la connexion avec twitter, renseigner vos clés d'API twitter dans le fichier ```application/config/twitter.php```.  
(Pour le bien du projet ces champs sont déjà configurés avec les clés d'API d'un compte d'un membre du groupe)

### Dépendances 

Les extensions php suivantes sont nécessaires pour faire fonctionner le site :
 - ext-curl (pour la connexion Twitter)
 - sqlite3 (si vous choisissez d'utiliser SQLite pour votre base de données)
 - mysql (si vous choississez d'utiliser MySQL pour votre base de données)

Une version de php supérieure à la 5.5 est nécessaire pour la connexion avec twitter.
 
## Architecture 
 
 Ce projet est construit selon le model [MCV](http://baptiste-wicht.developpez.com/tutoriels/conception/mvc/)
 
  - ```application/controlers/``` contient les controlleurs 
    - La plupart de ces controlleurs hérite d'un controlleur plus général ```J64_Controller``` situé dans ```application/core/```
  - ```application/models``` contient les models
  - ```application/views``` contient les vues, la plupart de ses sous-dossiers et fichiers ont un nom explicite sauf 
    - ```application/views/form``` Vue de la connexion / inscription
      - ```application/views/form/jeune.php``` : Inscription
      - ```application/views/form/myform.php``` : Connexion
    - ```application/view/PartieJeune/formulaire.php``` : Création d'une référence
  - ```application/libraries/``` Bibliothèques utilisées par l'application
    - ```application/libraries/LinkGenerator.php``` Généraiton des liens pour les références / listes d'engagements
    - ```application/libraries/PasswordHash.php``` Bibliothèque de compatibilité pour php 5.4 : implémentation de fonctionnalités pour remplacer les fonction ```password_hash``` et ```password_verify``` rajouter avec php 5.5
  - ```application/third_party``` «Grosses bibliothèques» telles que TwitterOauth et HTML2PDF
  - ```static/``` ensemble des fichiers statiques du site tels que les fichiers de style CSS et les fichiers de scripts JavaScript ou encore les images
    - ```static/semantic``` [Semantic UI](http://semantic-ui.com/) (style et animations côté client)
  - ```docs/``` Documentation de l'ensemble des fonctions et classe PHP créés pour le projet