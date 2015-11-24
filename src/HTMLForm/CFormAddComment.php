<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAddComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



       /** 
     * Constructor 
     * 
     */ 
    public function __construct($key, $ip) 
    { 
        parent::__construct([], [ 
            'pagekey' => [ 
                'type'        => 'hidden', 
                'value'       => $key, 
            ], 

            'ip' => [ 
                'type'        => 'hidden', 
                'value'       => $ip, 
            ], 

            'content' => [ 
                'type'        => 'textarea', 
                'label'       => 'Kommentera:', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
        
            ], 
            'name' => [ 
                'type'        => 'text', 
                'label'       => 'Namn:', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 
            'web' => [ 
                'type'        => 'url', 
                'label'       => 'Hemsida:', 
 
            ], 
            'email' => [ 
                'type'        => 'email', 
                'label'       => 'Email:',
                'validation'  => ['not_empty'], 
                
            ], 
            'submit' => [ 
                'type'      => 'submit', 
                'value'     => 'Comment', 
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
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {
       
        $this->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
        // $this->AddOutput("<p><b>Name: " . $this->Value('name') . "</b></p>");
        // $this->AddOutput("<p><b>Email: " . $this->Value('email') . "</b></p>");
        // $this->AddOutput("<p><b>Phone: " . $this->Value('phone') . "</b></p>");

        $this->comment = new \Anax\Comments\Comment();
        $this->comment->setDI($this->di);
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $save = $this->comment->save([ 
            'pagekey' => $this->Value('pagekey'), 
            'content' => $this->Value('content'), 
            'name' => $this->Value('name'), 
            'web' => $this->Value('web'), 
            'email' => $this->Value('email'), 
            'timestamp' => $now, 
            'ip' => $this->Value('ip'), 
            'gravatar' => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg',
            
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
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $this->redirectTo(); 
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
