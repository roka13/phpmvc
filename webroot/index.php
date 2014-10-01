<?php
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 

require __DIR__.'/config_with_app.php'; 

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
// Create services and inject into the app. 

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

//Create specific services for this app
$di->set('CommentsController', function() use ($di) {
    $controller = new Anax\Comments\CommentsController();
    $controller->setDI($di);
    return $controller;
	
});

//Route for Homepage
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
// includes comments
	include __DIR__.'/page-with-commentsme.php';

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
 	include __DIR__.'/page-with-commentsme.php';
});

$app->router->add('kmom01', function() use ($app) {
    $app->theme->setTitle("Kursmoment 1");
    $content = $app->fileContent->get('kmom01.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
 	include __DIR__.'/page-with-commentsme.php';
});

$app->router->add('kmom02', function() use ($app) {
    $app->theme->setTitle("Kursmoment 2");
    $content = $app->fileContent->get('kmom02.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
 	include __DIR__.'/page-with-commentsme.php';
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
	include __DIR__.'/page-with-commentsme.php';
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

	include __DIR__.'/page-with-commentsme.php'; // skapa funktion för anrop med rätt url
  });
  
   // routes for the dice-game
include __DIR__.'/dice_meapp.php';


   // routes for the page with comment
   // Home route
$app->router->add('comment', function() use ($app) {
$app->theme->setTitle("Min gästbok");
 $app->views->add('comment/index');
include __DIR__.'/page-with-commentsme.php';
});
 

$app->router->handle();
$app->theme->render();