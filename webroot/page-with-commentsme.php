<?php
/**
 * This is a complement Anax pagecontroller.
 *
 */
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
	    ]);

    $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
		'page'		=> null,
    ]);