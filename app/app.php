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

    $app['debug'] = true;

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

    //Store-specific route
    $app->get('/store/{id}', function($id) use($app) {
        return $app['twig']->render('store.html.twig', array('store' => Store::find($id), 'brands' => Brand::getAll()));
    });

    //Add shoe brand to a specific store
    $app->post('/store/add-brand/{id}', function($id) use($app) {
        $store = Store::find($id);
        $store_brands = $store->getBrands();
        $new_brand_name = strtolower($_POST['brand_name']);
        $duplicate = false;
        foreach ($store_brands as $brand)
        {
            $name = strtolower($brand->getName());
            if ($new_brand_name == $name)
            {
                $duplicate = true;
            }
        }
        if (!$duplicate)
        {
            $new_brand = new Brand($_POST['brand_name']);
            $new_brand->save();
            $new_brand->addStore($id);
        }
        return $app->redirect('/store/' . $id);
    });

    //Remove a brand from a store, but do not delete the brand from the database
    $app->delete('/store/{id}/remove-brand', function($id) use($app) {
        $store = Store::find($id);
        $store->removeBrand($_POST['brand_id']);
        return $app->redirect('/store/' . $id);
    });

    return $app;
?>
