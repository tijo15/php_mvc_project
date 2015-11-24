<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential settings.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();


$di->setShared('flashMessages', function() use ($di){
    $flashMessages = new \Anax\FlashMessage\FlashController($di);
    return $flashMessages;
}); 


$app = new \Anax\Kernel\CAnax($di);


// Test Route
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Testing flash");
    $app->theme->addStylesheet('css/flash.css');    
    $app->flashMessages->addMessage('Godkänt!', 'success');
    $app->flashMessages->addMessage('Information', 'info');
    $app->flashMessages->addMessage('Varning!', 'warning');
    $app->flashMessages->addMessage('Error', 'error');
    $app->flashMessages->addMessage('Test', 'Test');

    $app->views->add('flash/flash', [ 
        'content' => $app->flashMessages->getFlashMessages(),
        ]); 
 
});


// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();
// Render the page
$app->theme->render();