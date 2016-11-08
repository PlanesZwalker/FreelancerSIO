Pour parametrer l'application Silex
====================================
## Lancer la commande composer update à la racine du dossier admin
pour télécharger toutes les dépendances du projet

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

