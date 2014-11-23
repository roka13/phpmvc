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
           'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'kmom01'  => [
                        'text'  => 'Kmom01',   
                        'url'   => 'kmom01',  
                        'title' => 'kmom01'
                    ],

                    // This is a menu item of the submenu
                    'kmom02'  => [
                        'text'  => 'Kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'kmom02'
                    ],
					// This is a menu item of the submenu
                    'kmom03'  => [
                        'text'  => 'Kmom03',   
                        'url'   => 'kmom03',  
                        'title' => 'kmom03'
                    ],
					// This is a menu item of the submenu
                    'kmom04'  => [
                        'text'  => 'Kmom04',   
                        'url'   => 'kmom04',  
                        'title' => 'Kmom04'
                    ],
					// This is a menu item of the submenu
                    'kmom05'  => [
                        'text'  => 'Kmom05',   
                        'url'   => 'kmom05',  
                        'title' => 'Kmom05'
                    ],
					
                ],
            ], 
        ],
		
		 // This is a menu item
        'Tema'  => [
            'text'  => 'Tema-sidorna',   
            'url'   => 'theme',  
            'title' => 'Tema-Sidorna',
			
			// Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

					'items' => [	
			
					// This is a menu item of the submenu
                     // This is a menu item
					'regioner' => [
						'text'  =>'Regioner Demo', 
						'url'   =>'regioner',  
						'title' => 'Regioner'
					], 
		
					'typography' => [
						'text'  =>'Typografi Demo', 
						'url'   =>'typography',  
						'title' => 'Typografi'
					], 
					
					'awesome' => [
						'text'  =>'Awesome Demo', 
						'url'   =>'awesome',  
						'title' => 'Awesome'
					], 
				],	
			],	
		],
		
		'users' => [
			'text' => 'Användare', 
            'url'   =>'Users/list',  
            'title' => 'Användare',
			
			'submenu' => [ 

				'items' => [ 
		
				// This is a submenu item
					'setup' => [
						'text'  =>'Återställning/skapa ny Användartabell', 
						'url'   =>'users/setup',  
						'title' => 'Ny databas'
					],
					
				// This is a submenu item 
                    'list'  => [ 
                        'text'  => 'Lista alla',    
                        'url'   => 'users/list',   
                        'title' => 'Lista alla' 
                    ],
					// This is a submenu item 
                    'listactive'  => [ 
                        'text'  => 'Lista Aktiva',    
                        'url'   => 'users/active',   
                        'title' => 'Lista Aktiva Användare' 
                    ],
					
					// This is a submenu item 
                    'listinaktiv'  => [ 
                        'text'  => 'Lista Inaktiva ',    
                        'url'   => 'Users/inactive',   
                        'title' => 'Lista inaktiva Användare' 
                    ],
					
					// This is a submenu item 
                    'listsoftdelete'  => [ 
                        'text'  => 'Papperskorgen',    
                        'url'   => 'Users/softdeleted',   
                        'title' => 'Lista Papperskorg' 
                    ],			
				],			
			],
        ],

	'dbtabell' => [
			'text' => 'Datatabeller', 
            'url'   =>'Dbtables/select',  
            'title' => 'Tabeller',  
			
			'submenu' => [ 

				'items' => [ 
			
				
				// This is a submenu item 
                    'add'  => [ 
                        'text'  => 'Lägg till Tabell',    
                        'url'   => 'Dbtables/empty',   
                        'title' => 'Lägg till tabell' 
                    ],	

				],	
				
			],
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
					
		// This is a submenu item 
                    'comment'  => [ 
                        'text'  => 'Kommentarer',    
                        'url'   => 'comment',   
                        'title' => 'Övningex kmom02' 
                    ],
					
			
			
		  // This is a submenu item
        'test1'  => [
            'text'  => 'Försök med Cform',   
           'url'   => 'test1',  
            'title' => 'Tester',
			],
			    // Here we add the submenu, with some menu items, as part of a existing menu item 
            
		
		 // This is a submenu item
					'form1' => [
					'text'  =>'FormControl', 
					'url'   =>'form1',  
					'title' => 'FormControl'
					],
		
				
			// This is a submenu item
					'form2' => [
					'text'  =>'FormSmallControl', 
					'url'   =>'form2',  
					'title' => 'FormSmallControl'
					],
			/*		
			// This is a submenu item
					'testsqlite' => [
					'text'  =>'Test av SQLite', 
					'url'   =>'testsqlite',  
					'title' => 'Test av SQLIte'
					],
				*/	
		/*
				// This is a submenu item
					'testmysql' => [
					'text'  =>'Test av MySql', 
					'url'   =>'testmysql',  
					'title' => 'Test av MySql'
					],			
			*/
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