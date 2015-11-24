

<h3>Taggar</h3>

 <?php if (is_array($tags)) : ?>
  <p class="btn-group">
  <?php foreach ($tags as $tag) : ?>
  <button class="btn btn-primary btn-xs " style="margin-left:5px;"><a href='<?=$this->url->create('tags/tag/') . '/'. $tag->tags?>'><i class="fa fa-tag fa-fw"></i><?=$tag->tags?></a></button>
  <?php endforeach;?>
   </p>
  <?php endif; ?>
