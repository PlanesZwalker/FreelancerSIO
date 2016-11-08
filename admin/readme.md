Pour parametrer l'application Silex
====================================
## Lancer la commande composer update à la racine du dossier admin
pour télécharger toutes les dépendances du projet

##  Créer un dossier config dans app 

##  Créer un fichier prod.php dans le dossier admin/app/config 
avec la configuration vers votre base :
## COPIER CE CODE DEDANS ET METTEZ LES ACCES A VOS BASES DEDANS (dbname, user et password) 
<?php
$app['db.options'] = array(
    'driver' => 'pdo_mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => ' ',
    'user' => ' ',
    'password' => ' ',

);

 ## Crééer un fichier dev.php dans le dossier admin/app/config 
 ## COPIER CE CODE DEDANS
<?php
require __DIR__.'/prod.php';

//activation du mode debug, pour développeur
$app['debug'] = true;

