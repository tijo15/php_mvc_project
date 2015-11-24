

<h3>Visa en användare</h3>
 
<ul>
<li>Gravatar: <figure>
    <img src="<?=$user->getProperties()['gravatar']?>" alt="gravatar">
</figure></li>
<li>Akronym: <?=$user->getProperties()['acronym']?></li>
<li>Namn: <?=$user->getProperties()['name']?></li>
<li>Id: <?=$user->getProperties()['id']?></li>
<li>Email: <?=$user->getProperties()['email']?></li>
</ul>
 <button class="btn btn-primary btn-xs" style="margin-bottom:40px;"><a href='<?=$this->url->create('users/update').'/'.$user->getProperties()['id']?>'><i class="fa fa-wrench fa-fw"></i>Uppdatera användare</a></button>
<button class="btn btn-primary btn-xs" style="margin-bottom:40px;"><a href='<?=$this->url->create('users/')?>'><i class="fa fa-chevron-left fa-fw"></i>Tillbaka</a></button>

