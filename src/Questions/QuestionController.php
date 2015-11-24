<?php

namespace Anax\Questions;
 
/**
 * A controller for users and admin related events.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
 
   /** 
     * Initialize the controller. 
     * 
     * @return void 
     */ 
    public function initialize() 
    { 

        $this->questions = new \Anax\Questions\Question(); 
        $this->questions->setDI($this->di); 

        // $this->answers = new \Anax\Questions\AnswersView(); 
        // $this->answers->setDI($this->di);

        $this->comments = new \Anax\Questions\Comments(); 
        $this->comments->setDI($this->di);

        $this->answersreply = new \Anax\Questions\Answersreplyview(); 
        $this->answersreply->setDI($this->di);

        $this->answer = new \Anax\Questions\Answers(); 
        $this->answer->setDI($this->di);

        $this->tags = new \Anax\Questions\TagsView(); 
        $this->tags->setDI($this->di);
    } 
    
   
 /**
     * View all questions.
     *
     * @return void
     */
    public function viewAction($pagekey)
    {

        $all = $this->questions->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

            if ($pagekey == 'hem') {
             $newquestions = $this->questions->query()
            ->orderby('timestamp asc')
            ->limit('5')
            ->execute();

            $toptags = $this->tags->query('tags, COUNT(*) as sum')
            ->groupby('tags')
            ->orderby('COUNT(*) desc')
            ->limit('5')
            ->execute();

            $topusers = $this->questions->query('author, COUNT(*) as sum')
            ->groupby('author')
            ->orderby('COUNT(*) desc')
            ->limit('5')
            ->execute();
            
             $this->views->add('question/newquestions', [
            'questions' => $newquestions,
            'tags' => $toptags,
            'user' =>$topusers,
             ]);  
            }
     
        $allanswers = $this->answer->query()
            ->execute();  
         
        $allcomments = $this->comments->query()
            ->execute();  

        $allanswersreply = $this->answersreply->query()
            ->execute(); 

        $alltags = $this->tags->query()
            ->execute(); 
        $userisloggedin = false;
        if(!empty($this->session->has('userid'))){
        $userisloggedin = true;
        }    
            if ($pagekey == 'questions') {
            $this->views->add('question/questions', [
            'questions' => $all,
            'pagekey'  => $pagekey,
            'answer' => $allanswers,
            'comment' => $allcomments,
            'reply' => $allanswersreply,
            'tags'  => $alltags,
            'checkuser' => $userisloggedin,
        ]);
      
            }
    

    }

  
      

/**
     * Add a question.
     *
     * @param string $pagekey with pagekey to page
     *
     * @return void
     */
    public function addAction($pagekey = null)
    {
        if(!empty($this->session->has('userid'))){

            $this->initialize();
            $ip = $this->request->getServer('REMOTE_ADDR');

            $form = new \Anax\HTMLForm\CFormAddQuestion($pagekey, $ip);
            $form->setDI($this->di);
            $form->check();
          
            $this->di->views->add('default/page', [
            'title' => "Lägg till en fråga",
            'content' => $form->getHTML()
            ]);

    $this->views->add('question/questionButtons', [
        'pagekey' => 'questions',
    ]);
        }

    }

/**
    * Show form to edit question
    *
    * @param int $id with question id
    *
    * @return void
    */
    public function editViewAction($id = null)
    {

        if (!isset($id)) {
            die("Missing id");
        }
         
        $question = $this->questions->find($id);
        $content = $question->content;
        $name = $question->name;
        $web = $question->web;
        $email = $question->email;
        $pagekey = $question->pagekey;

        $form = new \Anax\HTMLForm\CFormUpdateQuestion($id, $content, $name, $web, $email, $pagekey);
        $form->setDI($this->di);
        $status = $form->check();

        $this->di->theme->setTitle("Redigera fråga");
        $this->di->views->add('default/page', [
            'title' => "Redigera fråga",
            'content' => $form->getHTML(),
        ]);
    }




       public function answerAction($id = null)
    {
        if (!isset($id)) {
            die("Question is missing id");
        }

        $question = $this->questions->find($id);

        $form = new \Anax\HTMLForm\CFormAddQuestionAnswer($id);
        $form->setDI($this->di);
        $status = $form->check();
      
      
        $this->di->theme->setTitle("Svara på fråga");
        $this->di->views->add('default/page', [
            'title' => "Svara på fråga",
            'content' => $form->getHTML()
        ]);
    }


       public function answerreplyAction($id = null)
    {
        if (!isset($id)) {
            die("Answer is missing id");
        }

        $question = $this->answer->find($id);

        $form = new \Anax\HTMLForm\CFormAddQuestionAnswerreply($id);
        $form->setDI($this->di);
        $status = $form->check();
      
      
        $this->di->theme->setTitle("Svara på svar");
        $this->di->views->add('default/page', [
            'title' => "Svara på svar",
            'content' => $form->getHTML()
        ]);
    }


      public function commentAction($id = null)
    {
        if (!isset($id)) {
            die("Question is missing id");
        }

        $question = $this->questions->find($id);

        $form = new \Anax\HTMLForm\CFormAddQuestionComment($id);
        $form->setDI($this->di);
        $status = $form->check();
      
      
        $this->di->theme->setTitle("Kommentera");
        $this->di->views->add('default/page', [
            'title' => "Kommentera",
            'content' => $form->getHTML()
        ]);
    }

    /**
     * Remove all questions.
     *
     * @param string $pagekey with pagekey to page
     *
     * @return void
     */
    public function removeAllAction($pagekey)
    {
        $questions = $this->questions->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

        foreach ($questions as $question) {
            $this->questions->delete($question->getProperties()['id']);
        }

        $url = $pagekey == 'questions' ? $this->url->create('questions') : $this->url->create('hem');
        $this->response->redirect($url);
    }


   /**
     * Restore/setup user database and setup two example users.
     *
     *
     * @return void
     */
    public function restorequestionsAction($pagekey = null)
    {
        
        $this->db->dropTableIfExists('question')->execute();

      
        $this->db->createTable(
            'question',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content' => ['text'],
                'author' =>['varchar(80)'],
                'name' => ['varchar(80)'],
                'email' => ['varchar(80)'],
                'web' => ['varchar(80)'],
                'timestamp' => ['datetime'],
                'ip' => ['text'],
                'gravatar' => ['varchar(80)'],
                'userid' => ['integer'],
                'pagekey' => ['varchar(20)']
            ]
        )->execute();

        $this->db->execute('TRUNCATE phpmvc_answersreply');
        $this->db->execute('TRUNCATE phpmvc_comments');
        $this->db->execute('TRUNCATE phpmvc_answers');
        $this->db->execute('TRUNCATE phpmvc_questiontags');

        // $this->db->insert(
        //     'question',
        //      ['content', 'author', 'name', 'email', 'web', 'timestamp', 'ip', 'gravatar', 'pagekey']
        // );

        // date_default_timezone_set('Europe/Berlin');
        // $now = date('Y-m-d H:i:s');

        // $this->db->execute([
        //     'testar questions',
        //     'Exempel författare',
        //     'Testgubbe',
        //     'admin@dbwebb.se',
        //     'www.testing.com',
        //     $now,
        //     $this->request->getServer('REMOTE_ADDR'),
        //     'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
        //     'questions'
            
        // ]);

        // $url = $this->Value('pagekey') == 'questions' ? 'questions' : 'hem'; 
        // $this->redirectTo($url); 
    $url = $pagekey == 'questions' ? $this->url->create('questions') : $this->url->create('hem');
    $this->response->redirect($url);
}
}