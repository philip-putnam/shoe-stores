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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use($app) {

        return $app['twig']->render('main.html.twig', array('stores' => Store::getAll()));
    });

    //Add a store from root route and main.html.twig form
    $app->post('/add-store', function() use($app) {
        $new_store = new Store(
            filter_var($_POST['store_name'], FILTER_SANITIZE_MAGIC_QUOTES),
            filter_var($_POST['store_address'], FILTER_SANITIZE_MAGIC_QUOTES),
            $_POST['store_phone']);
        $new_store->save();
        return $app->redirect('/');
    });

    //Delete a specific store from root route and main.html.twig form
    $app->delete('/delete-store', function() use($app) {
        $store = Store::find($_POST['store_id']);
        $store->delete();
        return $app->redirect('/');
    });


    return $app;
?>
