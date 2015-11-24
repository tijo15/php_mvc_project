<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAddQuestionAnswerreply extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



       /** 
     * Constructor 
     * 
     */ 
    public function __construct($id) 
    { 

        parent::__construct([], [ 
       

            'id' => [ 
                'type'        => 'hidden', 
                'value'       => $id, 
            ], 
 

            'answer' => [ 
                'type'        => 'textarea', 
                'label'       => 'Svar:', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
        
            ], 
            'author' => [
                'type'        => 'hidden', 
                'label'       => 'Författare:',  
             
            ],

            'submit' => [ 
                'type'      => 'submit', 
                'value'     => 'Svara', 
                'callback'  => [$this, 'callbackSubmit'], 
            ], 
        ]); 
    } 



    /**
     * Customise the check() method.
     *
     * @param callable $callIfSuccess handler to call if function returns true.
     * @param callable $callIfFail    handler to call if function returns true.
     */
    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
        echo($id);
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {
       

        $this->question = new \Anax\Questions\Question();
        $this->question->setDI($this->di);

        $this->answerreply = new \Anax\Questions\Answersreply();
        $this->answerreply->setDI($this->di);

        $this->user = new \Anax\Users\UsersController();
        $this->user->setDI($this->di);

        $this->textFilter = new \Anax\Content\CTextFilter();
       $this->textFilter->setDI($this->di);

        $userid = $this->user->userId();
        $author = $this->user->userAcronym();
        $gravatar = $this->user->userGravatar();

        $content = $this->Value('answer');
        $contentMarkdown = $this->textFilter->doFilter($content, "markdown");


        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $save = $this->answerreply->save([ 
            'answers_id'  => $this->Value('id'), 
            'answers' => $contentMarkdown,
            'author' => $author,
            'timestamp' => $now,
            'userid' => $userid,
            'gravatar' => $gravatar,  
            ]);
        if($save) 
        {
        return true;
        }
        else return false;

    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        $this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $url = $this->user->url->create('questions/');
        $this->redirectTo($url); 
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        $this->redirectTo(); 
       
    }
}
