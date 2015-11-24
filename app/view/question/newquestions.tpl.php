
<div class='sideMenu'>
<?php if (is_array($questions)) : ?>
 
  <div class="row">
    <div class="col-md-5">
          <?php if (!empty($questions)): ?> 
    <h4>Senaste frågorna</h4>
        <?php endif; ?>

 <?php foreach ($questions as $id => $question) : ?>
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
<?php endforeach;?>
</ul>
<?php endif; ?>
</div>
<?php if (is_array($user)) : ?>
   <div class="col-md-5 col-md-offset-2">

        <?php if (!empty($user)): ?> 
  <h4>Mest aktiva användarna</h4>
        <?php endif; ?>

    <?php foreach ($user as $users) : ?>
  <ul class="list-group" style="width:70%;">
  <li class="list-group-item">
    <span class="badge"><?=$users->sum?></span>
    <i class="fa fa-user fa-fw"></i><?=$users->author?>
  </li>
</ul>
  <?php endforeach;?>
   </div>
  <?php endif; ?>

<?php if (is_array($tags)) : ?>
     <div class="col-md-5 col-md-offset-2">
    <?php if (!empty($tags)): ?> 
  <h4>Mest använda taggar</h4>
        <?php endif; ?>
    <?php foreach ($tags as $tag) : ?>
  <ul class="list-group" style="width:70%;">
  <li class="list-group-item">
    <span class="badge"><?=$tag->sum?></span>
    <a href='<?=$this->url->create('tags/tag/') . '/'. $tag->tags?>'><i class="fa fa-tag fa-fw"></i><?=$tag->tags?></a>
  </li>
</ul>
  <?php endforeach;?>
  </div>
  <?php endif; ?>
</div>
</div>
