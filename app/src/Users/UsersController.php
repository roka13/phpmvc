<?php
namespace Anax\Users;
 
/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

/**
 * Initialize the controller.
 *
 * @return void
 */
public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
}		
	
	
/**
 * List all users.
 *
 * @return void
 */
public function listAction()
{
    $all = $this->users->findAll();
 
    $this->theme->setTitle("List all users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Användardatabas",
    ]);
}


/**
 * List user with id.
 *
 * @param int $id of user to display
 *
 * @return void
 */
public function idAction($id = null)
{
    $user = $this->users->find($id);
 
    $this->theme->setTitle("View user with id");
    $this->views->add('users/view', [
        'user' => $user,
		'title' => "Användare",
    ]);
}
 
 /**
 * Add new user.
 *
 * @param string $acronym of user to add.
 *
 * @return void
 */
 public function addAction() {
 	 $this->UsersController->initialize();
	session_start();
	

    $form = $this->form->create([], [

	'acronym' => [
            'type'        => 'text',
            'required'    => true,
			'label'       => 'Alias',
            'validation'  => ['not_empty'],
        ],
	
        'name' => [
            'type'        => 'text',
            'label'       => 'Namn:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
			'label'       => 'Epost-adress',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        
        'submit' => [
            'type'      => 'submit',
			'value' => 'Spara',
		    'callback'  => function ($form) {
			
			$now = date('Y-m-d ');
			
			$this->users->save([
					'acronym'     => $form->Value('acronym'), 
					'email'   	  => $form->Value('email'), 
					'name'        => $form->Value('name'), 
					'password'     => password_hash($form->Value('acronym'), PASSWORD_DEFAULT), 
					'created'     => $now, 
					'active'     => $now, 
					'status'      => 'aktiv',
				]);
			    return true;
            }],
        
		'reset' => [
				'type'      => 'reset',
				'value' => 'Ångra texten',
				'callback'  => function($form) {
			  
				$form->saveInSession = false;
				$url = $this->di->request->getCurrentUrl();
			$this->response->redirect($url);
				// $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
					return false;
			}],
	
    ]);

        $status = $form->check(); 
        if ($status === true) { 
		    $url = $this->url->create('users/id/' . $this->users->id); 
            $this->response->redirect($url); 
         }
		else if ($status === false) { 
         $form->AddOutput("<h3>Kontrollera data</h2>", 'gw');
			$url = $this->di->request->getCurrentUrl();
			$this->response->redirect($url);
        } 
		
		$url = $this->url->create('users/list');
		$this->theme->setTitle("Ny användare");
		$cont = $form->getHTML();
	$link="<form action='$url' method='get'><button>Lista Alla användare</button></form>";
	$content = $cont . $link;
		$this->views->add('me/page', [
		'title' => "Lägg till en ny användare",
		'content' => $content
		
		]);
}

    /**  
    * Update user.  
    *  
    * @param integer $id of user to update.  
    *  
    * @return void 
    */  
    public function updateAction($id = null)  
    {  
        $form = $this->form; 

        $user = $this->users->find($id); 

        $form = $form->create([], [ 
            'acronym' => [ 
                'type'        => 'text', 
                'label'       => 'Acronym', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'value' => $user->acronym, 
            ], 
            'name' => [ 
                'type'        => 'text', 
                'label'       => 'Name', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'value' => $user->name, 
            ], 
            'email' => [ 
                'type'        => 'text', 
                'required'    => true, 
                'validation'  => ['not_empty', 'email_adress'], 
                'value' => $user->email, 
            ], 
            'submit' => [ 
                'type'      => 'submit', 
                'callback'  => function($form) use ($user) { 

              	$now = date('Y-m-d ');

                    $this->users->save([ 
                        'id'        => $user->id, 
                        'acronym'     => $form->Value('acronym'), 
                        'email'     => $form->Value('email'), 
                        'name'         => $form->Value('name'), 
                        'updated'     => $now, 
                        'active'     => $now, 
						'status'     => 'aktiv',
                    ]); 

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
            $url = $this->url->create('users/id/' . $user->id); 
            $this->response->redirect($url); 
         
        } else if ($status === false) { 
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit; 
        } 

        $this->theme->setTitle("Redigera användare"); 
        $this->views->add('me/page', [ 
            'title' => "Redigera användare", 
            'content' => $form->getHTML() 
        ]); 
    }  

 /**
 * Delete user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function deleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
//	$user = $this->users->find($id);
  $res = $this->users->delete($id);

//     $user->save();
 
    $url = $this->url->create('users/list/' );
    $this->response->redirect($url);
}

/**
 * Delete (soft) user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function softDeleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
 
	$now = date('Y-m-d ');
 
    $user = $this->users->find($id);
	$user->active = null;
	$user->softdeleted = $now;
	$user -> status = 'papperskorg';
	$user->save();
    $url = $this->url->create('users/id/' . $id);
    $this->response->redirect($url);
}



/**
 * Unactivate user.
 * @author Roka13
 * @param integer $id of user to deactivate.
 *
 * @return void
 */
public function unactivateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
	
	$now = date('Y-m-d ');

	$user = $this->users->find($id);
	$user->active = null;
	$user -> status = 'inaktiv';
	$user->save();
 
    $url = $this->url->create('users/id/' . $id);
    $this->response->redirect($url);
}
/**
 * SoftUndelete user.
 * @author Roka13
 * @param integer $id of user to unactivate.
 *
 * @return void
 */
public function softundeleteAction($id = null)
{
	if (!isset($id)) {
        die("Missing id");
    }
	
		$now = date('Y-m-d ');

    $user = $this->users->find($id);
	$user->active = $now;
	$user->softdeleted = null;
	$user->status= 'inaktiv';
	$user->save();
 
    $url = $this->url->create('users/id/' . $id);
    $this->response->redirect($url);
}




/**
 * Activate user.
 * @author Roka13
 * @param integer $id of user to activate.
 *
 * @return void
 */
public function activateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
	
 $now = date('D j M Y');

    $user = $this->users->find($id);
	$user->active = $now;
	$user->softdeleted = NULL;
	$user->status= 'aktiv';
	$user->save();
 
    $url = $this->url->create('users/id/' . $id);
    $this->response->redirect($url);
}

/**
 * List all softdeleted  users.
 * @author Roka 13
 * @return void
 */
public function inactiveAction()
{
    $all = $this->users->query()
   	     ->where('status ="inaktiv"')
   	     ->execute();
 
    $this->theme->setTitle("Inactive  Users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Inaktiva och användare i papperskorgen",
    ]);
}

/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function activeAction()
{
    $all = $this->users->query()
        ->where('status = "aktiv"')
        ->execute();
 
    $this->theme->setTitle("Active Users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Aktiva användare",
    ]);
}

/**
 * List all deleted users.
 *
 * @return void
 */

 public function softdeletedAction()
{
    $all = $this->users->query()
        ->where('status= "papperskorg"')
        ->execute();
 
    $this->theme->setTitle("Users that are deleted");

    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Borttagna användare",
    ]);
}


public function setupAction(){
	$this->theme->setTitle("Nollställning av databas");
	$this->db->dropTableIfExists('user')->execute();
//	$this->UsersController->initialize();

	$this->db->createTable(
	'user',
	[
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'softdeleted' => ['datetime'],
            'active' => ['datetime'],
            'status'=>['varchar(20)'],
        ]
        )->execute();

//Lägg till användare
	 $this->db->insert(
        'user',
        ['acronym','email','name','password','created','active','status']
        );
                   
 
	$now = date('Y-m-d');
	
	$this->db->execute([
	'admin',
        'admin@roka.se',
        'Administrator',
        password_hash('admin', PASSWORD_DEFAULT),
        $now,
        $now,
	"aktiv"
	]);

	$this->db->execute([
	'Jonte',
        'jonte@roka.se',
        'John/Jane Doe',
        password_hash('jonte', PASSWORD_DEFAULT),
        $now,
        $now,
	'aktiv'
	]);


 
	$all = $this->users->findAll();
	$this->views->add('users/list-all', [
        'users' => $all,
       'title' =>'Databasen är nollställd',
          ]);
   
          
          
 }
}
