<?php 
/**
 * This is a Anax frontcontroller.
 *This file is included in index.php as one views
 * It comes fro m the original file dice_app.php
 */

// Get environment & autoloader.
//require __DIR__.'/config_with_app.php'; 

// Add extra assets
$app->theme->addStylesheet('css/dice.css');

/*
// Home route
$app->router->add('', function() use ($app) {

    $app->views->add('welcome/index');
    $app->theme->setTitle("Welcome to Anax");
});
*/

// Route to show welcome to dice
$app->router->add('dice', function() use ($app) {

    $app->views->add('dice/index');
    $app->theme->setTitle("Kasta tärning");

});


// Route to roll dice and show results
$app->router->add('dice/roll', function() use ($app) {

    // Check how many rolls to do
    $roll = $app->request->getGet('roll', 1);
    $app->validate->check($roll, ['int', 'range' => [1, 100]])
        or die("Roll out of bounds");

    // Make roll and prepare reply
    $dice = new \Mos\Dice\CDice();
    $dice->roll($roll);

    $app->views->add('dice/index', [
        'roll'      => $dice->getNumOfRolls(),
        'results'   => $dice->getResults(),
        'total'     => $dice->getTotal(),
    ]);

    $app->theme->setTitle("Kastade tärning");

});


// Check for matching routes and dispatch to controller/handler of route
//$app->router->handle();

// Render the page
//$app->theme->render();
