<?php

namespace Anax\FlashMessage;
 
/**
 * A controller for users and admin related events.
 *
 */
class FlashController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;




 public function __construct(){
        if(!isset($_SESSION['flashmsg'])){
            $_SESSION['flashmsg'] = array();
        }
    }

    public function addMessage($message, $type){
        $msg = array('content' => $message, 'type' => $type);
        $_SESSION['flashmsg'][] = $msg;
    }
    
    public function addErrorMsg ($message){
        $this->addMessage('error', $message);
    }
    
    public function addSuccessMsg($message){
        $this->addMessage('success', $message);
    }
    
    public function addInfoMsg($message){
        $this->message('info', $message);
    }
    
    public function addWarningMsg($message){
        $this ->message('warning', $message);
    }
    
    public function getFlashMessages(){
        
        $messages = $_SESSION['flashmsg'];
        $output = null;
        
        if($messages) {
            foreach ($messages as $key => $message) {
                $output .= "<p class='". $message['type'] . "'>" . $message['content'] . "</p>";
            }
        } else {
            $output = null;
        }
        return $output;
    }
 	


 	public function deleteMessages(){
        $_SESSION['flashmsg'] = null;
    }









}