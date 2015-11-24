<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAddQuestion extends \Mos\HTMLForm\CForm
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
                'label'       => 'Fråga:', 
                'required'    => true, 
                'validation'  => ['not_empty'], 
        
            ], 
            'author' => [
                'type'        => 'hidden', 
                'label'       => 'Författare:',  
             
            ],

             'taggar' => [
                  'label'       => 'Taggar',
                  'type'        => 'checkbox-multiple',
                  'values'      => ['Vampyrer', 'Zombies', 'Utomjordingar', 'Varulvar', 'Mumier'], 
                  'validation'  => ['must_accept'],
             ], 

       'submit' => [
                'type'      => 'submit', 
                'value'     => 'Ställ fråga', 
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


        $this->question = new \Anax\Questions\Question();
        $this->question->setDI($this->di);

        $this->user = new \Anax\Users\UsersController();
        $this->user->setDI($this->di);

        $this->userdb = new \Anax\Users\User();
        $this->userdb->setDI($this->di);

        $this->tags = new \Anax\Questions\Questiontags();
        $this->tags->setDI($this->di);

        $this->textFilter = new \Anax\Content\CTextFilter();
        $this->textFilter->setDI($this->di);

        $userid = $this->user->userId();
        $author = $this->user->userAcronym();
        $gravatar = $this->user->userGravatar();

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        $content = $this->Value('content');
        $contentMarkdown = $this->textFilter->doFilter($content, "markdown"); 

        $save = $this->question->save([ 
            'pagekey' => $this->Value('pagekey'), 
            'content' => $contentMarkdown,
            'author' => $author,
            'userid' => $userid,
            'timestamp' => $now, 
            'ip' => $this->Value('ip'), 
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

   private function map_Tags($n, $m)
    {
        return(array($n => $m));
    }

   //  public function setTags(){

   // // Get the selected tags as an array
   //      $items = $this->Value('taggar');
   //      $tagsIDarr = array('1','2','3');
   //      $tags = array_map(array($this, "map_Tags"), $items , $tagsIDarr);

   //      //$qId = $this->question->lastInsertId();
         
   //      foreach ($tags as $key => $value) {
   //          $tagIds =  (array_values($value));
   //          $itemsAsString[] = implode(", ", $tagIds);

   //      }

   //      foreach ($itemsAsString as $value) {
   //        //     print_r($ids);
   //      $ids[] = $value;

   //      }
   //          return $ids;
   //  }
    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {   

     //Get the selected tags as an array
        $items = $this->Value('taggar');

        $tagsIDarr = array();
        foreach ($items as $value) {
        
        if ($value == 'Vampyrer') {
            $tagsIDarr[0] = 1;
        }

        if ($value == 'Zombies') {
            $tagsIDarr[1] = 2;
        }

        if ($value == 'Utomjordingar') {
            $tagsIDarr[2] = 3;
        }

         if ($value == 'Varulvar') {
            $tagsIDarr[3] = 4;
        }
        
          if ($value == 'Mumier') {
            $tagsIDarr[4] = 5;
        }

        }
        
        $tags = array_map(array($this, "map_Tags"), $items , $tagsIDarr);

        $qId = $this->question->lastInsertId();
         
        foreach ($tags as $key => $value) {
            $tagIds =  (array_values($value));
            $itemsAsString[] = implode(", ", $tagIds);

        }

        foreach ($itemsAsString as $ids) {
         $this->tags->saveTags([
         'questionId' => $qId, 
          'tags_id' => $ids,
          ]);


        }
      
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
