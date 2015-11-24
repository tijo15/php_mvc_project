<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAddUser extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct([], [
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Acronym:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'Email:',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Name:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],

              'gravatar' => [
                'type'        => 'hidden',
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


   private function get_gravatar($s = 50, $d = 'monsterid', $r = 'g', $img = false, $atts = array() ) {
            $url = 'http://www.gravatar.com/avatar/';
            $url .= md5( strtolower( trim( $this->Value('email') ) ) );
            $url .= "?s=$s&d=$d&r=$r";
            if ( $img ) {
                $url = '<img src="' . $url . '"';
                foreach ( $atts as $key => $val )
                    $url .= ' ' . $key . '="' . $val . '"';
                $url .= ' />';
            }
            return $url;
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

    
        $url = "?s=50s&d=mm&";
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
      //  $gravatar = ('http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg');
        
        $save = $this->user->save([
            'acronym' => $this->Value('acronym'),
            'email' => $this->Value('email'),
            'name' => $this->Value('name'),
            'gravatar'  => $this->get_gravatar(),
           // 'gravatar' => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg' . $url,
            'password' => password_hash($this->Value('acronym'), PASSWORD_DEFAULT),
            'created' => $now,
            'active' => $now,
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
        $this->redirectTo('users/add/');
        echo "failed";
    }
}
