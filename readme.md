Pour parametrer l'application
==============================

## Lancer la commande composer update à la racine du projet 
## Lancer la commande composer update à la racine du dossier admin
( pour télécharger toutes les dépendances du projet)

## CONFIGUGRER L ACCES A LA BASE DE DONNEES:
dans le fichier parameters.yml
ou directement en ligne de commande au moment de l'update


##POUR LE BACK-OFFICE /ADMIN SILEX
##Créer un fichier prod.php dans le dossier app/config avec la configuration vers votre base de  (dbname, user et password)

$app['db.options'] = array(
    'driver' => 'pdo_mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => ' ',
    'user' => ' ',
    'password' => ' ',

);
##LIRE LE README DANS /ADMIN

