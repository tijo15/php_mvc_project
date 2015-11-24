
<?php if (is_array($user)) : ?>
  <div class="row pull-right">
    <div class="col-md-12">
<h4>Mest aktiva användarna</h4>
    <?php foreach ($user as $users) : ?>
  <ul class="list-group" style="width:30%;">
  <li class="list-group-item">
    <span class="badge"><?=$users->sum?></span>
    <i class="fa fa-user fa-fw"></i><?=$users->author?>
  </li>
</ul>
  <?php endforeach;?>
  <?php endif; ?>

<?php if (is_array($tags)) : ?>
<h4>Taggar</h4>
    <?php foreach ($tags as $tag) : ?>
  <ul class="list-group" style="width:30%;">
  <li class="list-group-item">
    <span class="badge"><?=$tag->sum?></span>
    <a href='<?=$this->url->create('tags/tag/') . '/'. $tag->tags?>'><i class="fa fa-tag fa-fw"></i><?=$tag->tags?></a>
  </li>
</ul>
  <?php endforeach;?>
  <?php endif; ?>
</div>
</div>
