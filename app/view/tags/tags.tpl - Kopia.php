

<h3>Frågor till <?=$tagname?></h3>

<?php if (is_array($questions)) : ?>
  <?php if (is_array($tagid)) : ?>
  <div class="row">
    <div class="col-md-12">
 <?php foreach ($questions as $id => $question) : ?>
  <?php foreach ($tagid as $tag) : ?>
<?php if ($question->id == $tag->questionId) :?>
<ul class="media-list"> 
 <li class="media" style="margin-top:30px;">
   <a class="pull-left" href="<?=$this->url->create('users/id').'/'.$question->userid ?>"><img src="<?=$question->gravatar?>" class="media-object" alt="gravatar"></a>
  <div class="media-body">
  <h5 class="media-heading meta">
  <?=$question->timestamp;?> <a href="<?=$this->url->create('users/id').'/'.$question->userid ?>"><?=$question->author;?></a>
 </h5>
     <p>
	<?=$question->content?>
    </p>
</div>
</li>
<?php endif; ?>
<?php endforeach;?>
<?php endforeach;?>
</ul>
<?php endif; ?>
<?php endif; ?>
