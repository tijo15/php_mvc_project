

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
<a href='<?=$this->url->create('users/')?>'>Tillbaka</a>
<!-- <a href="<?=$this->url->create('users/deActiveAction').'/'.$user->getProperties()['id']?>">Inaktivera användare</a> -->
