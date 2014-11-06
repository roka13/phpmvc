<?php
/**
 * This is a complement Anax pagecontroller.
 *
 */
    $app->dispatcher->forward([
        'controller' => 'comments',
        'action'     => 'view',
	    ]);

    $app->views->add('comments/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
		'page'		=> null,
    ]);