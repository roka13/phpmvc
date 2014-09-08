<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu structure
    'items' => [

        // This is a menu item
        'Hem'  => [
            'text'  => 'Hem',   
           'url'   => '',  
            'title' => 'Min sida'
        ],
 
        // This is a menu item
        'Redovisning'  => [
            'text'  => 'Redovisning',   
           'url'   => 'redovisning',   
            'title' => 'Här skriver vi redovisningen',

            // Here we add the submenu, with some menu items, as part of a existing menu item
       /*     'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'item 1'  => [
                        'text'  => 'kmom01',   
                      'url'   => 'kmom01',  
                        'title' => 'kmom01'
                    ],

                    // This is a menu item of the submenu
                    'item 2'  => [
                        'text'  => 'kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'kmom02'
                    ],
                ],
            ], */
        ],
 
        // This is a menu item
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Källkod'
        ],
		
		// This is a menu item with submenus. 

        'extra'  => [ 
            'text'  => 'Extrauppgifter',    
            'url'   => 'extra',    
            'title' => 'Extrauppgifter', 

            // Here we add the submenu, with some menu items, as part of a existing menu item 
            'submenu' => [ 

				'items' => [ 
		
		 // This is a submenu item
					'dice' => [
					'text'  =>'Tärningspel', 
					'url'   =>'dice',  
					'title' => 'Tärning'
					],
					
		/*// This is a submenu item 
                    'dicegame'  => [ 
                        'text'  => 'Kasta tärning',    
                        'url'   => 'dicegame',   
                        'title' => 'Kasta tärning' 
                    ], 	*/		
				],
			],
		],
		
		
		
    ],
	
		
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
