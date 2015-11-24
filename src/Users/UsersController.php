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
        $this->login = new \Anax\Users\Login();
        $this->login->setDI($this->di);
        $this->questions = new \Anax\Questions\Question(); 
        $this->questions->setDI($this->di);
        $this->answers = new \Anax\Questions\AnswersView(); 
        $this->answers->setDI($this->di);  
    } 
    
   
   /**
 * List all users.
 *
 * @return void
 */
public function listAction()
{
    $this->initialize();
   // $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
 
    $all = $this->users->findAll();
 
    $this->theme->setTitle("Alla användare");

    $this->views->add('users/sidemenu', [
    ]);

    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Alla användare",
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

    $this->initialize();
    $user = $this->users->find($id);

  

    $this->theme->setTitle("Visa en användare");
   
    $this->views->add('users/sidemenu', [
    ]);

    $this->views->add('users/view', [
        'user' => $user,
    ]);
    //Find user acroynm with corresponding id from the user db and use that acronym to match with the author from the questions db
    $author = $user->acronym;

    $all = $this->questions->query()
            ->where('author = ?')
            ->execute(array($author));

    $allanswers = $this->answers->query()
            ->where('author = ?')
            ->execute(array($author));        

    if ($all) {
        $headline = 'Frågor ställda av: ' . $author;
    }
    else{
        $headline = $author . ' har inte ställt några frågor';
    }    
    if ($allanswers) {
        $headline2 = 'Svar av: ' . $author;
    }
    else{
        $headline2 =  $author .' har inte gett några svar';
    }
    
        $this->views->add('question/questionsbyuser', [
            'questions' => $all,
            'author'  => $author,
            'headline' => $headline,
            'headline2' => $headline2,
            'answer' => $allanswers,
        ]);
    if($this->checkUserlogin($id) ==true){
    $form = $this->form->create([], [      
        'Logout' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $this->form->saveInSession = false;
                return true;
            }
        ],
    ]);

    $status = $this->form->check();

    if ($status === true) {

    $this->logoutAction();

    }

    $this->views->add('default/page', [
        'title' => "",
        'content' => $this->form->getHTML(),
    ], 'main');
}

}

/**
 * Add new user.
 *
 * @param string $acronym of user to add.
 *
 * @return void
 */
public function addAction($acronym = null)
{
    $form = new \Anax\HTMLForm\CFormAddUser();
    $form->setDI($this->di);
    $status = $form->check();

    $this->views->add('default/page', [
        'title' => "Lägg till ny användare",
        'content' => $form->getHTML()
    ]);
}



/**
 * Update user.
 *
 * @param string $acronym of user to add.
 *
 * @return void
 */
public function updateAction($id = null)
{

    $user = $this->users->find($id);

    $acronym = $user->acronym;
    $name = $user->name;
    $email = $user->email;

    $form = new \Anax\HTMLForm\CFormUpdateUser($id,$acronym,$email,$name);
    $form->setDI($this->di);
    $status = $form->check();

    $this->views->add('default/page', [
        'title' => "Uppdatera användare",
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
 
    $res = $this->users->delete($id);
 
    $url = $this->url->create('users');
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
 
    $now = gmdate('Y-m-d H:i:s');
 
    $user = $this->users->find($id);
 
    $user->deleted = $now;
    $user->save();
 
    $url = $this->url->create('users/trashcan');
    $this->response->redirect($url);
}

/**
 * Delete (soft) user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function undosoftDeleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
 
    $now = gmdate('Y-m-d H:i:s');
 
    $user = $this->users->find($id);
 
    $user->deleted = NULL;
    $user->save();
 
    $url = $this->url->create('users/');
    $this->response->redirect($url);
}

/**
 * List all softdeleted users.
 *
 * @return void
 */

public function trashCanAction(){

   $all = $this->users->query()
        ->where('deleted is NOT NULL')
        ->execute();
 
    $this->theme->setTitle("Papperskorgen");

    $this->views->add('users/sidemenu', [
    ]);

    $this->views->add('users/trashcan', [
        'users' => $all,
        'title' => "Papperskorgen",
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
        ->where('active IS NOT NULL')
        ->andWhere('deleted is NULL')
        ->execute();
 
    $this->theme->setTitle("Aktiva användare");

     $this->views->add('users/sidemenu', [
    ]);

    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Aktiva användare",
    ]);
}



/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function reactivateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }

    $now = gmdate('Y-m-d H:i:s');

    $user = $this->users->find($id);
    $user->active = $now;
    $user->save();
 
    $url = $this->url->create('users/active');
    $this->response->redirect($url);
}
/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function deactiveAction($id = null)
{

if (!isset($id)) {
        die("Missing id");
    }
 
    $user = $this->users->find($id);
    $user->active = NULL;
    $user->save();
 
    $url = $this->url->create('users/listInActive');
    $this->response->redirect($url);
}


/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function listInActiveAction()
{
    $all = $this->users->query()
        ->where('active IS NULL')
        ->andWhere('deleted is NULL')
        ->execute();
 
    $this->theme->setTitle("Inaktiva användare");

     $this->views->add('users/sidemenu', [
    ]);

    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Inaktiva användare",
    ]);
}

   /**
     * Restore/setup user database and setup two example users.
     *
     *
     * @return void
     */
    public function restoreUsersAction()
    {
        
        $this->db->dropTableIfExists('user')->execute();

        $this->db->createTable(
            'user',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'acronym' => ['varchar(20)', 'unique', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'gravatar' => ['varchar(80)'],
                'password' => ['varchar(255)'],
                'created' => ['datetime'],
                'updated' => ['datetime'],
                'deleted' => ['datetime'],
                'active' => ['datetime'],
            ]
        )->execute();

        $this->db->insert(
            'user',
            ['acronym', 'email', 'name', 'gravatar', 'password', 'created', 'active']
        );

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $this->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
    $url = $this->url->create('users/');
    $this->response->redirect($url);
}


/**
 * Login to a useraccount.
 * 
 * Creates login form.
 * @return htmlform.
 */
public function loginAction() {

    $this->initialize();
    if (!empty($this->session->has('userid'))) {


    $form = $this->form->create([], [      
        'Logout' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $this->form->saveInSession = false;
                return true;
            }
        ],
    ]);

    $status = $this->form->check();

    if ($status === true) {

    $this->logoutAction();

    }

         $this->views->add('default/login', [
        'title' => "",
        'content' => 'Du är inloggad som: ' . $this->session->get('acronym'),
        'logout' => $this->form->getHTML(),
    ]);

     }

    else{
    $form = $this->form->create([], [
        'acronym' => [
            'type'        => 'text',
            'label'       => 'Användarnamn:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'password' => [
            'type'        => 'password',
            'label'       => 'Lösenord:',            
            'required'    => true,
            'validation'  => ['not_empty'],
        ],        
        'Login' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $this->form->saveInSession = false;
                return true;
            }
        ],


    ]);


    $status = $this->form->check();
    if ($status === true) {

        //check if user exists
        if($this->login->loginFunc($this->form->value('acronym')) == true) {
            $login = $this->login->loginFunc($this->form->value('acronym'));
            $info = $login->getProperties();
            
            //check if password verifies
            if(password_verify($this->form->value('password'), $info['password'])) {
                $this->session->set('userid', $info['id']);
                $this->session->set('acronym', $info['acronym']);
                $this->session->set('gravatar', $info['gravatar']);
                $this->response->redirect($this->url->create('questions/'));
            }


            else {
                $this->form->AddOutput("Fel användarnamn eller lösenord");
                header("Location: " . $this->di->request->getCurrentUrl());
                
            }
        }
        
        //If user doesn't exist
        else {
            $this->form->AddOutput("Fel användarnamn eller lösenord.");
            header("Location: " . $this->di->request->getCurrentUrl());
        }
    }
    
    else if ($status === false) {
            $this->form->AddOutput("Ett fel uppstod. Se felmeddelandena ovan.");
            header("Location: " . $this->di->request->getCurrentUrl());
    }
    
    $this->views->add('default/page', [
        'title' => "Logga in",
        'content' => $this->form->getHTML(),
    ], 'main');
}
}


/**
 * check if user is logged in.
 */
private function checkUserlogin($id) {
    if(!empty($this->session->has('userid')) && $this->session->get('userid') == $id) {
        return true;
    }
    else {
        return false;
    }
}


public function userAcronym(){
  return $this->session->get('acronym');

}

public function userId(){
$id = $this->session->get('userid');
return $id;

}

public function userGravatar(){

return $this->session->get('gravatar');
// $this->initialize();
// $id = $this->session->get('userid');
// echo($id);    
// $gravatar = $this->users->query('gravatar')
//         ->where('id = ?')
//         ->execute(array($id));    

// return $gravatar;

}

/**
 * Logout.
 */
public function logoutAction() {
    $this->session->unsets('userid');
    $this->session->unsets('acronym');
    $url = $this->url->create('questions/');
    $this->response->redirect($url);
}
 






















}