<?php

namespace Anax\Comments;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsController  implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

/**
 * Initialize the controller.
 *
 * @return void  
 */
public function initialize()
{
    $this->comments = new \Anax\Comments\Comments();
    $this->comments->setDI($this->di);
}

/**
     * View all comments.
     *
     * @return void
     */
    public function viewAction()
    {
	$this->CommentsController->initialize();
        $all = $this->comments->findAll();
        $this->views->add('comments/comments', [
            'comments' => $all,
        ]);
    }

 /**
 * Add new comment.
 *
 * @params posted texts in comment/form
 *
 * @return void 
 */
 public function addAction() {

			$now = date('Y-m-d ');
			
			$this->comments->save([
			'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => $now,
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
			'page'     =>$this->request->getPost('page'),
				]);
				
        $this->response->redirect($this->request->getPost('page'));
}

	
/**
 * Remove comment.
 *
 * @param integer $id of comment to remove.
 *
 * @return void
 */
public function removeAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
  $res = $this->comments->delete($id);
 $this->response->redirect($this->request->getPost('redirect'));
}


 /**  
   * Edit and Update comments  
   *  
   * @param integer $id of comment to update.  
   *  Uses Cform for the form
   * @return void 
   */  
   public function editAction($id = null)  
   {  
		session_start();
        $form = $this->form; 
        $comments = $this->comments->find($id); 

        $form = $form->create([], [ 
            'textarea' => [ 
                'type'        => 'text', 
                'label'       => 'Kommentar', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'value' => $comments->content, 
            ], 
            'name' => [ 
                'type'        => 'text', 
                'label'       => 'Namn', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
                'value' => $comments->name, 
            ], 
			
			'url' => [ 
                'type'        => 'url', 
				 'label'       => 'Hemsida', 
                 'value' => $comments->web, 
			     'validation'  => ['pass'],
				  
            ], 
			
            'email' => [ 
                'type'        => 'email', 
				 'label'       => 'Email', 
			     'value' => $comments->mail, 
				  'validation'  => ['pass'],
            ], 
			
            'submit' => [ 
                'type'      => 'submit', 
				'value' => 'Ändra',
                'callback'  => function($form) use ($comments) { 

              	$now = date('Y-m-d ');

                    $this->comments->save([ 
                        'id'        => $comments->id, 
                        'content'     => $form->Value('textarea'), 
                        'mail'     => $form->Value('email'), 
                        'name'         => $form->Value('name'), 
                        'web'     =>  $form->Value('url'),
                       'timestamp' => $now,
                    ]); 

                    return true; 
                } 
            ], 

        ]); 

        // Check the status of the form 
        $status = $form->check(); 

        if ($status === true) { 
            $url = $this->url->create( $comments->page); 
            $this->response->redirect($url); 
			session_unset(); 
         
        } else if ($status === false) { 
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit; 
        } 
		$rubrik = "<p>Kommentar till idNr " . $comments->id . " på sidan " .$comments-> page . "</p>" ;
		$content = $rubrik . $form->getHTML();	
        $this->theme->setTitle("Redigera Kommentar"); 
        $this->views->add('me/page', [ 
            'title' => 'Redigera Kommentar',
            'content' =>$content, 
        ]); 
    }  

/**
 * Setup table for Commets.
 *
 * Also used for resetting to an empty table
 *
 * @return void
 */
public function setupAction(){

    $this->db->dropTableIfExists('comments')->execute();
	$this->CommentsController->initialize();

	$this->db->createTable(
        'comments',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'content'  => ['varchar(200)', 'not null'],
            'mail' 	   => ['varchar(80)'],
            'name'     => ['varchar(80)'],
            'web'      => ['varchar(255)'],
       		'timestamp'=>['datetime'],
			'ip'	   =>['url'],
			'page'     =>['varchar(255)'],
        ]
    )->execute();
	  $this->response->redirect($this->request->getPost('page'));
 }

//end of file	
}