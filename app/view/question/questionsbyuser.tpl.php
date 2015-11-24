
<?php if (is_array($questions)) : ?>
<h4 class="list-group-item-heading"><?=$headline?></h4>
<div class="row">
 <?php foreach ($questions as $id => $question) : ?>
<div class="row" style="margin-bottom:20px;" >
<div class="list-group">
<div class="col-md-4">
<a href='<?=$this->url->create('question/edit-view/'. $question->id . '/' . $question->pagekey)?>' class="list-group-item disable">
    <h5 class="list-group-item-heading">Fråga</h5>
    <p class="list-group-item-text"><?=$question->content?></p>
    </a>
    </div>
</div>
</div>	
<?php endforeach; ?>
</div>

<?php endif; ?>
<?php if (is_array($answer)) : ?>
<h4 class="list-group-item-heading"><?=$headline2?></h4>	
<div class="row">
<?php foreach ($answer as $answers) : ?>
<div class="row" style="margin-bottom:20px;">
<div class="list-group">
<div class="col-md-4">
<a  class="list-group-item disable">
    <p class="list-group-item-text">Fråga av&nbsp; <?=$answers->author; ?></p>
    <p><?=$answers->content; ?></p>
    <br>
    <h5 class="list-group-item-heading">Svar<br> <?=$answers->answer; ?></h5>
    </a>
    </div>
</div>
</div>
<?php endforeach;?>	
</div>
<?php endif; ?>
