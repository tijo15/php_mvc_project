<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormUpdateUser extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct($id,$acronym, $email, $name)
    {
        parent::__construct([], [

            'id' => [
                'type'  => 'hidden',
                'value'       => $id,
                'required'    => true,
                'validation'  => ['not_empty'],
                ],
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Acronym:',
                'value'       => $acronym,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'Email:',
                'value'       => $email,
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Name:',
                'value'       => $name,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            // 'submit-fail' => [
            //     'type'      => 'submit',
            //     'callback'  => [$this, 'callbackSubmitFail'],
            // ],
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
        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);
        $this->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
        // $this->AddOutput("<p><b>Name: " . $this->Value('name') . "</b></p>");
        // $this->AddOutput("<p><b>Email: " . $this->Value('email') . "</b></p>");
        // $this->AddOutput("<p><b>Phone: " . $this->Value('phone') . "</b></p>");

    
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        
        $save = $this->user->save([
            'id'  => $this->Value('id'),
            'acronym' => $this->Value('acronym'),
            'email' => $this->Value('email'),
            'name' => $this->Value('name'),
            'password' => password_hash($this->Value('acronym'), PASSWORD_DEFAULT),
            'created' => $now,
            'updated' => $now,
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
        $this->redirectTo('users/id/' . $this->user->getProperties()['id']);
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        $this->redirectTo('users/update/');
        echo "failed";
    }
}
