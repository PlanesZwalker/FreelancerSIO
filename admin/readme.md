##Créer un fichier index à la racine afin de créer la redirection vers  " Le_nom_du_dossier_sur_le_serveur"/web/index.php

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