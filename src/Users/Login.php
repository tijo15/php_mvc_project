<?php
namespace Anax\Users;
 
/**
 * Model for Users.
 *
 */
class Login extends \Anax\MVC\CDatabaseModel
{
 



//Handle login for the user

// public function loginFunc($acronym) {
//             $res = $this->findUser($acronym);
//             var_dump($res);
//             if(isset($res[0])) {
//             	var_dump($res);
//            $this->session->set('user', $res[0]);
            
//     }
// }

public function loginFunc($acronym)
{
    $this->db->select()
            ->from('user')
            ->where("acronym = ?");
     
    $this->db->execute([$acronym]);
    return $this->db->fetchInto($this);
}


}