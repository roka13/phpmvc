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

$app->router->add('kmom03', function() use ($app) {
    $app->theme->setTitle("Kursmoment 3");
    $content = $app->fileContent->get('kmom03.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
 	include __DIR__.'/page-with-commentsme.php';
});


$app->router->add('theme', function() use ($app) {
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');
    $app->theme->setTitle("Tema"); 
	$app->theme->addStylesheet('css/anax-grid/svalbard.less'); 
//$app->theme->addStylesheet('css/anax-grid/wrapper.css');
	$main = $app->fileContent->get('me.md'); 
    $main = $app->textFilter->doFilter($main, 'shortcode, markdown'); 
	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

	
	$sidebar = $app->fileContent->get('camera.html'); 

    $app->views ->addString('Isberg', 'flash')
            ->addString('Valross ', 'featured-1')
            ->addString('Glaciär', 'featured-2')
			->addString('Isbjörn', 'featured-3')
			->addString($sidebar, 'sidebar')
			->add('theme/me', [ 
						'main' => $main, 
						'byline' => $byline, 
												])
				->addString('Polarräv', 'triptych-1')
               ->addString('Knölval', 'triptych-2')
               ->addString('Isbjörn', 'triptych-3');
             
  
	
});


$app->router->add('typography', function() use ($app) { 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');

$app->theme->addStylesheet('css/anax-grid/wrapper.css');
   
      $app->theme->setTitle("Typografi Demo");
	  
    $content = $app->fileContent->get('typography.html'); 

	$app->views ->addString($content, 'main')
				->addString($content, 'sidebar');
		   
  });

$app->router->add('regioner', function() use ($app) {
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');
	
$app->theme->addStylesheet('css/anax-grid/regions_demo.css');
$app->theme->addStylesheet('css/anax-grid/wrapper.css');

    $app->theme->setTitle("Regioner Demo");
	
    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');
 
});

$app->router->add('awesome', function() use ($app) {
$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');
$app->theme->addStylesheet('css/anax-grid/wrapper.css');
    $app->theme->setTitle("Awesome Demo");
	
	 $main = $app->fileContent->get('links.html');
 	$flash = $app->fileContent->get('camera.html'); 
	$sidebar = $app->fileContent->get('spinner.html'); 
	
    $app->views->addString($flash, 'flash')
               ->addString($main, 'main')
               ->addString($sidebar, 'sidebar');
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