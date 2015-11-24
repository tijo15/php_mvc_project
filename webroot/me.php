<?php
require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

$app->router->add('hem', function() use ($app) {

     $app->theme->setTitle("Hem");
     $content = $app->fileContent->get('me.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

   	 $app->views->add('me/hem', [
        'content' => $content,
    ]);
});
 
$app->router->add('redovisning', function() use ($app) {
 
    $app->theme->setTitle("Redovisningar");
    $app->views->add('me/redovisning');
 
});
 
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