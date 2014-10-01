<?php 
/**
 * This is a Anax frontcontroller.
 *This file is included in index.php as one views
 * It comes from the original file dice_app.php
 */

// Add extra assets
$app->theme->addStylesheet('css/dice.css');

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