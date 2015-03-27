<?php
        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/Store.php";
        require_once __DIR__."/../src/Brand.php";

        $DB = new PDO('pgsql:host=localhost;dbname=shoes');

        $app = new Silex\Application();
        $app ['debug'] = true;

        $app->register(new Silex\Provider\TwigServiceProvider, array(
            'twig.path'=>__DIR__."/../views"
        ));

        use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

        $app->get('/', function() use($app) {
            return $app['twig']->render("Home.html.twig");
        });

        $app->get('/stores', function () use ($app) {
            return $app['twig']->render("stores.html.twig", array ('stores' => Store::getAll()));
        });

        $app->post('/stores', function() use ($app) {
            $new_store = new Store($_POST['new_store']);
            $new_store->save();
            return $app['twig']->render("stores.html.twig", array ('stores' => Store::getAll()));
        });

        $app->post('/stores/delete', function() use ($app) {
            Store::deleteAll();
            return $app['twig']->render("stores.html.twig", array ('stores' => Store::getAll()));
        });

        $app->get('/stores/{id}', function($id) use ($app) {
            $store = Store::find($id);
            return $app['twig']->render("store.html.twig", array ('store' => $store));
        });







        return $app;



 ?>
