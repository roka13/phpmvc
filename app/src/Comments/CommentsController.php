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
     * Add a comment.
     *with a specific page adress
     * @return void
	*/
	public function addAction()
		{
			$isPosted = $this->request->getPost('doCreate');
        
			if (!$isPosted) {
				$this->response->redirect($this->request->getPost('redirect'));
			}

        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
			'page'     =>$this->request->getPost('page'),
			];

        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $comments->add($comment);

        $this->response->redirect($this->request->getPost('page'));
    }
	
	
   
    /**
     * Remove a specific comment.
     *
     * @return void
     */
    public function removeAction($id=null)
    {
		if (!isset($id)) { 
            die("Missing id"); 
			} 
		
		$comments = new CommentsSession();
		$comments->setDI($this->di);
		$url = $this->request->getPost('redirect'); 
		$id = $this->request->getPost('id');
		$comments->delete($id); 
		$this->response->redirect($this->request->getPost('redirect')); 
    }      

	/**
     * Edit a specific comment.
     *
     * @return void
     */	
	 public function editAction($id=null) 
    { 
	     if(!isset($id)) { 
			die("Missing id"); 
        } 
		$comments = new CommentsSession(); 
        $comments->setDI($this->di); 
		$url = $this->request->getPost('page');
		$id = $this->request->getPost('id');
		
		$comment = $comments->find($id); 
         
        $this->theme->setTitle('Redigera Kommentar'); 
         
        $this->views->add('comment/edit',  [ 
            'mail'      => $comment['mail'], 
            'web'       => $comment['web'], 
            'name'      => $comment['name'], 
            'content'   => $comment['content'], 
           'id'   		=> $id, 
            'page'       => $comment['page'],
		]);  
    }   
	
	/**
     * Save a specific comment.
     *
     * @return void
     */
	public function saveAction($id) { 
		if(!isset($id)) { 
            die("Missing id"); 
			}
		$comment = [ 
            'content'   => $this->request->getPost('content'), 
            'name'      => $this->request->getPost('name'), 
            'web'       => $this->request->getPost('web'), 
            'mail'      => $this->request->getPost('mail'), 
            'timestamp' => time(), 
            'ip'        => $this->request->getServer('REMOTE_ADDR'), 
			'page'  => $this->request->getPost('page'),
			]; 

        $comments = new CommentsSession(); 
        $comments->setDI($this->di); 
		$comments->save($comment,$id); 
		 
		$this->response->redirect($this->request->getPost('redirect')); 
    }     
}