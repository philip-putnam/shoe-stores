<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Brand.php';
    require_once __DIR__.'/../src/Store.php';

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use($app) {

        return $app['twig']->render('main.html.twig', array('stores' => Store::getAll()));
    });

    //Add a store from root route and main.html.twig form
    $app->post('/add-store', function() use($app) {
        $new_store = new Store($_POST['store_name'], $_POST['store_address'], $_POST['store_phone']);
        $new_store->save();
        return $app->redirect('/');
    });


    return $app;
?>
