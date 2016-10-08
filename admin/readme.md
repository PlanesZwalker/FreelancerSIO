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

##Pour installer les composants du framework (Silex) 
=> Ouvrez votre dossier local et dans le dossier admin vous lancez la commande    php composer.phar update
