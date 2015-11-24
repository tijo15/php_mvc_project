<?php

namespace Anax\Questions;
 
/**
 * A controller for users and admin related events.
 *
 */
class TagsController implements \Anax\DI\IInjectionAware
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

        $this->tagslist = new \Anax\Questions\Tags(); 
        $this->tagslist->setDI($this->di);

        $this->tags = new \Anax\Questions\TagsView(); 
        $this->tags->setDI($this->di);
    
   }
 /**
     * View all tags.
     *
     * @return void
     */
    public function viewAction($pagekey)
    {

    $alltags = $this->tagslist->query('tags')
            ->execute();
        $this->views->add('tags/taggar', [
            'tags'  => $alltags,
        ]);

    }

  /**
 * List Tags with id.
 *
 * @param int $id of tag to display
 *
 * @return void
 */
public function tagAction($tag = null)
{   

    $this->initialize();
    $taggen = $this->tags->query()
        ->where('tags = ?')
        ->limit('1')
        ->execute(array($tag));

    if (empty($taggen)){ 
    $tagname = null;
    }  
    else{
         $tagname = $taggen[0]->tags; 
    } 

    if ($tagname == NULL) {
      $this->views->add('default/pageback', [
            'title' => 'Ojdå',
            'content' => 'Det finns inga frågor med denna tagg ännu',
    ]);
    }

    $alltagsid = $this->tags->query('questionId')
            ->where('tags = ?')
            ->execute(array($tagname)); 

    $allquestions = $this->questions->query()
             ->execute();
    
    $this->theme->setTitle("Frågor ställda till: " . $tagname);
   
    $this->views->add('tags/tags', [
            'tagid' => $alltagsid,
            'questions' => $allquestions,
            'tagname' => $tagname,
    ]);
      
}


}