<?php
require __DIR__.'/config_with_app.php'; 

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
//$app->url->setUrlType(\Anax\Url\CUrl::URL_APPEND);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');


$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Min bästa hemsida"); 
	
	$content = $app->fileContent->get('me.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
	 $app->views->add('me/me', [ 
        'content' => $content, 
        'byline' => $byline, 
	   ]); 
	
});

$app->router->add('redovisning', function() use ($app) {
 
    $app->theme->setTitle("Redovisning");
 
    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
 
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
 
  
  // The route for extra. 
$app->router->add('extra', function() use ($app) { 
  
     $app->theme->setTitle("Extrauppgifter"); 

     $content = $app->fileContent->get('extra.md'); 
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
     
    $byline  = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 
     
    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
   
  });
  
   // routes for the dice-game
  include __DIR__.'/dice_meapp.php';
  
  $app->router->add('dice', function() use ($app) {

    $app->theme->setTitle("Kasta Tärning");

});

  
 



$app->router->handle();
$app->theme->render();