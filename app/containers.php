<?php 

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$container = new \Slim\Container($configuration);
$cont = new \Slim\Container($configuration);
$app = new \Slim\App($cont);
$container = $app->getContainer();


$container['notFoundHandler'] = function ($container) {
    return function ($req, $res) use ($container) {
        return $res->withRedirect($container->router->pathFor('home'));
    };
};

$container['config'] = function ($c)
{
	return new \Noodlehaus\Config('config/app.php');
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->config->get('db'));
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['auth'] = function () {
    return new App\Auth\Auth;
};

use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator;

$container['translator'] = function ($c)
{
	// Register the trukish translator 'tr'
	$translator = new Translator(new FileLoader(new Filesystem(), __DIR__ . '/lang'), 'tr');
    // setLocal for new location 
    $translator->setLocale('tr');
    return $translator;
};

$container['view'] = function ($c)
{
	$view = new \Slim\Views\Twig('resources/views');

	$view->addExtension(new \Slim\Views\TwigExtension(
		$c['router'],
		$c['config']->get('url')
	));

	$view->getEnvironment()->addGlobal("auth",[
		"user" => $c->auth->user(),
		"check" => $c->auth->check(),
		]);
	
	// add translator functions to Twig
    $view->addExtension(new \Dkesberg\Slim\Twig\Extension\TranslationExtension($c->translator));
	return $view;
};

$container['db'] = function ($c) use ($capsule)
{
	return $capsule;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};


require 'controllersContainer.php';
