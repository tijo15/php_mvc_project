<?php
require __DIR__.'/config_with_app.php'; 

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

$di->set('form', '\Mos\HTMLForm\CForm');

$di->set('CommentController', function() use ($di) {
    $controller = new Anax\Comments\CommentController();
    $controller->setDI($di);
    return $controller;
});

$di->set('QuestionController', function() use ($di) {
    $controller = new Anax\Questions\QuestionController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    //$db->setVerbose(true);
    return $db;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});
$di->set('TagsController', function() use ($di) {
    $controller = new \Anax\Questions\TagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('LoginController', function() use ($di) {
    $controller = new \Anax\Users\LoginController();
    $controller->setDI($di);
    return $controller;
});


// USER CONTROLLER
$app->router->add('users', function() use ($app) {

     $app->theme->setTitle("Användare");

        $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'list',
     
    ]);
 
});


$app->router->add('activeUsers', function() use ($app) {

     $app->theme->setTitle("Aktiva användare");

        $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'active',
     
    ]);
 
});

// Questions CONTROLLER
$app->router->add('questions', function() use ($app) {

     $app->theme->setTitle("Frågor");


    //    $app->dispatcher->forward([
    //     'controller' => 'users',
    //     'action'     => 'login',
     
    // ]);

       $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'view',
        //Sends the parameter with the page key
        'params'     => ['questions'],
    ]);

     $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'add',
        'params'     => ['questions'],
    ]);

    //   $app->views->add('question/questionButtons', [
    //     'pagekey' => 'questions',
    // ]);

   });

// Tags CONTROLLER
$app->router->add('tags', function() use ($app) {

     $app->theme->setTitle("Taggar");

       $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'view',
        'params'     => ['questions'],
    ]);

   });


// About CONTROLLER
$app->router->add('about', function() use ($app) {

     $app->theme->setTitle("Om oss");
    
     $content = $app->fileContent->get('about.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

     $byline = $app->fileContent->get('byline.md');
     $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

     $app->views->add('me/about', [
        'content' => $content,
        'byline' => $byline,
    ]);

   });

// HOME CONTROLLER
$app->router->add('hem', function() use ($app) {

     $app->theme->setTitle("Hem");
     $content = $app->fileContent->get('me.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
   	 $app->views->add('me/hem', [
        'content' => $content,
    ]);

// Question SECTION
    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'view',
        'params'     => ['hem'],
    ]);

});


 // SOURCE CONTROLLER
$app->router->add('source', function() use ($app) {
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
 
});



 
$app->router->handle();
$app->theme->render();