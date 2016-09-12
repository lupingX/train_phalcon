<?php
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as Session;
try {
// Register an autoloader

//define a public path and APP _PATH
define('_PUBLIC','/public');

define('APP_PATH', realpath('..') . '/');	
$loader = new Loader();
$loader->registerDirs([
'../app/controllers/',
'../app/models/'
])->register();
// Create a DI
$di = new FactoryDefault();

// Setup the database service
$di->set('db', function () {
return new DbAdapter([
"host" => "localhost",
"username" => "root",
"password" => "",
"dbname" => "shopcz"
]);
});


//preparing parameters:
$di->set('dispatcher', function () {
// Create an EventsManager
$eventsManager = new EventsManager();
// Attach a listener
$eventsManager->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher) {
$keyParams = array();
$params = $dispatcher->getParams();
// Explode each parameter as key,value pairs
foreach ($params as $number => $value) {
$parts = explode(':', $value);
$keyParams[$parts[0]] = $parts[1];
}
// Override parameters
$dispatcher->setParams($keyParams);
});
$dispatcher = new MvcDispatcher();
$dispatcher->setEventsManager($eventsManager);
return $dispatcher;
});


//start session
$di->setShared('session', function () {
$session = new Session();
$session->start();
return $session;
});



// Setup the view component
$di->set('view', function () {
$view = new View();
$view->setViewsDir('../app/views/');
return $view;
});
// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () {
$url = new UrlProvider();
$url->setBaseUri('/train_phalcon/');
return $url;
});
$application = new Application($di);
// Handle the request
$response = $application->handle();
$response->send();
} catch (\Exception $e) {
echo "Exception: ", $e->getMessage();
}

