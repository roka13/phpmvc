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
$app = new \Anax\MVC\CApplicationBasic($di);
// Create services and inject into the app. 

//Create specific services for this app
$di->set('CommentsController', function() use ($di) {
    $controller = new Anax\Comments\CommentsController();
    $controller->setDI($di);
    return $controller;	
});

//Create specific services for this app
 $di->set('FormController', function() use ($di) {
    $controller = new Anax\HTMLForm\FormController();
    $controller->setDI($di);
    return $controller;	
});

 $di->set('FormSmallController', function() use ($di) {
    $controller = new Anax\HTMLForm\FormSmallController();
    $controller->setDI($di);
    return $controller;	
});


$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('DbtablesController', function() use ($di) {
    $controll = new \Roka\Dbtables\DbtablesController();
    $controll->setDI($di);
    return $controll;
});



$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
  // $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
	 $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
    $db->connect();
    return $db;
});

$di->setShared('form', '\Mos\HTMLForm\CForm');
/*$app->router->add('select', function() use ($app) {
    //  $app->theme->setTitle("FormController");  
	  $app->DbtablesController->indexAction();
	//    $app->views->add('dbtables/main', [
    //   'content' =>$form,
});
*/

$app->router->add('testsqlite', function() use ($app) {
 $app->theme->setTitle("TestSQLite"); 

    $app->db->dropTableIfExists('user')->execute();
 
    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();
	
$app->db->insert(
        'user',
        ['acronym', 'email', 'name', 'password', 'created', 'active']
    );
 
    $now = date(DATE_RFC2822);
 
    $app->db->execute([
        'admin',
        'admin@dbwebb.se',
        'Administrator',
        password_hash('admin', PASSWORD_DEFAULT),
        $now,
        $now
    ]);
 
    $app->db->execute([
        'doe',
        'doe@dbwebb.se',
        'John/Jane Doe',
        password_hash('doe', PASSWORD_DEFAULT),
        $now,
        $now
    ]);	
	
});




$app->router->add('form1', function() use ($app) {
    //  $app->theme->setTitle("FormController");  
	  $app->FormController->indexAction();
	//   $form = $app->FormController->indexAction();
   // $app->views->add('me/page', [
   //     'content' =>$form,
   // ]);
	
});

$app->router->add('form2', function() use ($app) {
    //  $app->theme->setTitle("FormControllerSmall");  
	$app->FormSmallController->indexAction();
	 //  $form = $app->FormSmallController->indexAction();
  /*  $app->views->add('me/page', [
        'content' =>$form,
    ]);
*/	
});



//$app = new \Anax\MVC\CApplicationBasic($di);
// Test form route
$app->router->add('test1', function () use ($app) {
     $app->session();
	 
			
    $form = $app->form->create([], [
        'name' => [
            'type'        => 'text',
            'label'       => 'Kontaktperson:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
			'label'       => 'Epost-adress',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'phone' => [
            'type'        => 'text',
            'required'    => true,
			'label'       => 'Telefon-nummer',
            'validation'  => ['not_empty', 'numeric'],
        ],
        'submit' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
                $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
                $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
                $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
                $form->saveInSession = true;
                return true;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);

	
    $callbackSuccess = function ($form) use ($app) {
        // What to do if the form was submitted?
        $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $app->redirectTo();
    };

    $callbackFail = function ($form) use ($app) {
            // What to do when form could not be processed?
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
            $app->redirectTo();
    };


    // Check the status of the form
    $form->check($callbackSuccess, $callbackFail);


    $app->theme->setTitle("Test med Cform");
    $app->views->add('me/page', [
        'title' => "Försök med CForm",
        'content' => $form->getHTML()
    ]);

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

$app->router->add('kmom04', function() use ($app) {
    $app->theme->setTitle("Kursmoment 4");
    $content = $app->fileContent->get('kmom04.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
 	$byline = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
 	include __DIR__.'/page-with-commentsme.php';
});

$app->router->add('kmom05', function() use ($app) {
    $app->theme->setTitle("Kursmoment 5");
    $content = $app->fileContent->get('kmom05.md');
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