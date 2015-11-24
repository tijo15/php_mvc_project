<?php

namespace Anax\Comments;
 
/**
 * A controller for users and admin related events.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
 

   /** 
     * Initialize the controller. 
     * 
     * @return void 
     */ 
    public function initialize() 
    { 
        $this->comments = new \Anax\Comments\Comment(); 
        $this->comments->setDI($this->di); 
    } 
    
   
 /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction($pagekey)
    {
        $all = $this->comments->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

        $this->views->add('comment/comments', [
            'comments' => $all,
            'pagekey'  => $pagekey,
        ]);
    }

/**
     * Add a comment.
     *
     * @param string $pagekey with pagekey to page
     *
     * @return void
     */
    public function addAction($pagekey = null)
    {
        $ip = $this->request->getServer('REMOTE_ADDR');

        $form = new \Anax\HTMLForm\CFormAddComment($pagekey, $ip);
        $form->setDI($this->di);
        $form->check();

        $this->di->views->add('default/page', [
        'title' => "Lägg till en kommentar",
        'content' => $form->getHTML()
        ]);
    }

/**
    * Show form to edit comment
    *
    * @param int $id with comment id
    *
    * @return void
    */
    public function editViewAction($id = null)
    {

        if (!isset($id)) {
            die("Missing id");
        }

        $comment = $this->comments->find($id);

        $content = $comment->content;
        $name = $comment->name;
        $web = $comment->web;
        $email = $comment->email;
        $pagekey = $comment->pagekey;

        $form = new \Anax\HTMLForm\CFormUpdateComment($id, $content, $name, $web, $email, $pagekey);
        $form->setDI($this->di);
        $status = $form->check();

        $this->di->theme->setTitle("Redigera kommentar");
        $this->di->views->add('default/page', [
            'title' => "Redigera kommentar",
            'content' => $form->getHTML()
        ]);
    }



    //  /**
    // * Delete a comment
    // *
    // * @param int $id with comment id
    // * @param string $pagekey with pagekey to page
    // *
    // * @return void
    // */
    // public function deleteAction($id, $pagekey)
    // {
    //     $isPosted = $this->request->getPost('doRemoveOne');

    //     if (!$isPosted) {
    //         $this->response->redirect($this->request->getPost('redirect'));
    //     }

    //     $comments = new \Phpmvc\Comment\CommentsInSession();
    //     $comments->setDI($this->di);

    //     $comments->deleteOne($id, $pagekey);

    //     $this->response->redirect($this->request->getPost('redirect'));


    // }

    /**
     * Remove all comments.
     *
     * @param string $pagekey with pagekey to page
     *
     * @return void
     */
    public function removeAllAction($pagekey)
    {
        $comments = $this->comments->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

        foreach ($comments as $comment) {
            $this->comments->delete($comment->getProperties()['id']);
        }

        $url = $pagekey == 'comments' ? $this->url->create('comments') : $this->url->create('hem');
        $this->response->redirect($url);
    }


   /**
     * Restore/setup user database and setup two example users.
     *
     *
     * @return void
     */
    public function restoreCommentsAction($pagekey = null)
    {
        
        $this->db->dropTableIfExists('comment')->execute();

        $this->db->createTable(
            'comment',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content' => ['text'],
                'name' => ['varchar(80)'],
                'email' => ['varchar(80)'],
                'web' => ['varchar(80)'],
                'timestamp' => ['datetime'],
                'ip' => ['text'],
                'gravatar' => ['varchar(80)'],
                'pagekey' => ['varchar(20)']
            ]
        )->execute();

        $this->db->insert(
            'comment',
             ['content', 'name', 'email', 'web', 'timestamp', 'ip', 'gravatar', 'pagekey']
        );

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'testar comments',
            'Testgubbe',
            'admin@dbwebb.se',
            'www.testing.com',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
            'hem'
            
        ]);

        $this->db->execute([
            'testar comments från commentssidan',
            'Testgubbe 2',
            'admian@dbwebb.se',
            'www.testing2.com',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
            'comments'
        ]);
        // $url = $this->Value('pagekey') == 'comments' ? 'comments' : 'hem'; 
        // $this->redirectTo($url); 
    $url = $pagekey == 'comments' ? $this->url->create('comments') : $this->url->create('hem');
    $this->response->redirect($url);
}
}