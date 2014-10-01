<?php

namespace Anax\Comments;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;



    /**
     * Edit an old comment.
     *
     * @param array $comment with all details.
     * 
     * @return void
     */
    public function edit($comment)
    {
        $comments = $this->session->get('comments', []);
        $comments[] = $comment;
        $this->session->set('comments', $comments);
    }

 /** 
     * Find comment at IDs 
     *  
     * @param int $id of the comment 
     * @return comment 
     */ 
    public function find($page)  
    { 
        $comments = $this->session->get('comments', [$page]); 
        return $comments[$page]; 
    } 


    /**
     * Find and delete comments.
     *
     * @return array with all comments.
     */
    public function delete($id)
    {  
		$comments = $this->session->get('comments', []); 
	//dump($comments[$id]);
        unset($comments[$id]); 
        $this->session->set('comments', $comments); 
    }
	/** 
     * Saves a comment 
     * $param $comment to be saved. 
     * $param int $id the id of the comment to be saved
     */ 
    public function save($comment,$id) { 
	//dump($comment);
        $comments = $this->session->get('comments', []); 
        $comments[$id] = $comment; 
        $this->session->set('comments', $comments); 
    } 
}