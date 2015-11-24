<h3><?=$title?></h3>

<?=$content?>
<br>
<button onclick="history.go(-1);">Tillbaka</button>
<?php if (isset($links)) : ?>
<ul>
<?php foreach ($links as $link) : ?>
<li><a href="<?=$link['href']?>"><?=$link['text']?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
