

<h3>Comments</h3>
<?php if (is_array($comments)) : ?>
<div class='comments'>
<ul>
 <?php foreach ($comments as $id => $comment) : ?>
<!-- Sends a url with the comment id to the CommentController class and calling on the editAction method -->
<li>
<a href='<?=$this->url->create('comment/edit-view/'. $comment->id . '/' . $comment->pagekey)?>'><figure><img src='<?=$comment->gravatar?>?s=40'> <figcaption><?=$comment->name;   ?></figcaption> </figure></a>
<p> <?=$comment->content?></p>
<span> Hemsida:<?=$comment->web; ?></span>
<span> Email:<?=$comment->email; ?></span>
</li>
<!-- <p><?=dump($comment)?></p> -->
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

