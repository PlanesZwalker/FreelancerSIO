Pour parametrer l'application Silex
====================================
## Lancer la commande composer update à la racine du dossier admin
pour télécharger toutes les dépendances du projet

##  Créer un dossier config dans app 

##  Créer un fichier prod.php et un fichier dev.php dans le dossier admin/app/config 
avec la configuration vers votre base :
## COPIER CE CODE ET METTEZ LES ACCES A VOS BASES DEDANS (dbname, user et password) 
$app['db.options'] = array(
    'driver' => 'pdo_mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => ' ',
    'user' => ' ',
    'password' => ' ',

);

