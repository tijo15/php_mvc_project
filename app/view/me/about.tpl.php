<article class="article1">
 
<?=$content?>
<img src="<?=$this->url->asset("img/monster.jpg")?>" alt="monster"> 
<?php if(isset($byline)) : ?>
<footer class="byline">
<?=$byline?>
</footer>
<?php endif; ?>
 
</article>

