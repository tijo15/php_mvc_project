<div id="sidebar">
<div class= "col-md-8">
<h4><?=$title?></h4>

<?=$content?>
</div>
<?php if (isset($links)) : ?>
<ul>
<?php foreach ($links as $link) : ?>
<li><a href="<?=$link['href']?>"><?=$link['text']?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>