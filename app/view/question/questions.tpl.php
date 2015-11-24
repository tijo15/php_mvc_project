<?php if (is_array($questions)) : ?>
  <div class="row">
<div class="col-md-12">
<?php if (!empty($questions)): ?> 
<h4>Frågor</h4>
<?php endif; ?>
 <?php foreach ($questions as $id => $question) : ?>
<ul class="media-list"> 
 <li class="media well">
   <a class="pull-left" href="<?=$this->url->create('users/id').'/'.$question->userid ?>"><img src="<?=$question->gravatar?>" class="media-object" alt="gravatar"></a>
  <div class="media-body">
  <h5 class="media-heading meta">
  <?=$question->timestamp;?> <a href="<?=$this->url->create('users/id').'/'.$question->userid ?>"><?=$question->author;?></a></h5>
     <p>
  <small>Frågar</small>
	<?=$question->content?>
    </p>
    <?php if (!empty($checkuser)): ?> 
   <i class="pull-left"><a href='<?=$this->url->create('question/answer/'. $question->id . '/' . $question->pagekey)?>'><small>Svara <i class="fa fa-reply fa-fw"> </i></small></a> 
   <a href='<?=$this->url->create('question/comment/'. $question->id . '/' . $question->pagekey)?>'><small>&nbsp;Kommentera <i class="fa fa-comment fa-fw"></i></small></a>
	<a href='<?=$this->url->create('question/edit-view/'. $question->id . '/' . $question->pagekey)?>'><small>&nbsp;Redigera <i class="fa fa-pencil fa-fw"> </i></small></a></i>
    <?php endif; ?>

  <?php if (is_array($tags)) : ?>
  <p class="btn-group" style="float:left; clear:both; margin-bottom:30px; margin-top:10px;">
  <?php foreach ($tags as $tag) : ?>
  <?php if ($tag->questionId == $question->id) :?>
  <button class="btn btn-primary btn-xs " style="margin-left:5px;"><a href='<?=$this->url->create('tags/tag/') . '/'. $tag->tags?>'><i class="fa fa-tag fa-fw"></i><?=$tag->tags?></a></button>
  <?php endif; ?>
  <?php endforeach;?>
   </p>
  <?php endif; ?>

<?php if (is_array($answer)) : ?>
<?php foreach ($answer as $answers) : ?>
<?php if ($question->id == $answers->question_id) :?>
 <!-- Nested media object -->
  <div class ="media" style="margin-top:60px; clear:both;">
  <a class="pull-left" href="<?=$this->url->create('users/id').'/'.$answers->userid ?>"><img src="<?=$answers->gravatar?>" class="media-object" alt="gravatar"></a>
  <div class="media-body">
  <h5 class="media-heading meta">
  <?=$answers->timestamp;?> <a href="<?=$this->url->create('users/id').'/'.$answers->userid ?>"><?=$answers->author;?></a>
  </h5>
     <p>
     <small>Svarar</small>
	 <?=$answers->answer; ?>

    </p>
     <?php if (!empty($checkuser)): ?> 
    <p> <i class="pull-left"><a href='<?=$this->url->create('question/answer/'. $question->id . '/' . $question->pagekey)?>'><small>Svara <i class="fa fa-reply"> </i></small></a></i></p>
 <?php endif; ?>
<?php endif; ?>
<?php endforeach;?>
<?php endif; ?>
<?php if (is_array($reply)) : ?>
<?php foreach ($reply as $replies) : ?>
<?php if ($answers->id == $replies->answers_id && $question->id == $answers->question_id) :?>
 <!-- Nested media object -->
  <div class = "media">
  <a class="pull-left" href="<?=$this->url->create('users/id').'/'.$replies->userid ?>"><img src="<?=$replies->gravatar?>" class="media-object" alt="gravatar"></a>
  <div class="media-body">
  <h5 class="media-heading meta">
  <?=$replies->timestamp;?> <a href="#"><?=$replies->author;?></a>
  </h5>
     <p>
      <small>Svarar</small>
	     <?=$replies->answers; ?>
    </p>
    <?php if (!empty($checkuser)): ?> 
    <p> <i class="pull-left"><a href='<?=$this->url->create('question/answerreply/'. $answers->id . '/' . $question->pagekey)?>'><small>Svara <i class="fa fa-reply"></i></small></a></i></p>
			 <?php endif; ?>
      </div>
			</div>
			</div>	 
			</div>              
  		</div>
</li>	
<?php endif; ?>
<?php endforeach;?>
  
<?php endif; ?>

	
<?php if (is_array($comment)) : ?>
<ul class="media-list">
<?php foreach ($comment as $comments) : ?>
<?php if ($question->id == $comments->question_id) :?>
 <li class="media" style="margin-top:50px;">
   <a class="pull-left" href="<?=$this->url->create('users/id').'/'.$comments->userid ?>"><img src="<?=$comments->gravatar?>" class="media-object" alt="gravatar"></a>
  <div class="media-body">
  <h5 class="media-heading meta">
  <?=$comments->timestamp; ?> <a href="<?=$this->url->create('users/id').'/'.$comments->userid ?>"><?=$comments->author; ?></a>
   </h5>
     <p> 
     <small>Kommenterar</small>
	<?=$comments->comments; ?>
    </p>
    <?php if (!empty($checkuser)): ?> 
    <p> <i class="pull-left"><a href='<?=$this->url->create('question/comment/'. $question->id . '/' . $question->pagekey)?>'><small>Kommentera <i class="fa fa-comment"></i></small></a></i></p>
    <?php endif; ?>
</div>
</li>	

<?php endif; ?>
<?php endforeach;?>
</ul>
</ul>
<?php endif; ?>
<?php endforeach; ?>




	  </div>
	</div>


<?php endif; ?>

