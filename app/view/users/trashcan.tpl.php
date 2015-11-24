<h2><?=$title?></h2>
 
 
 <table class='usersTable'>
 <tr> 
 <th>Användare</th> <th>Id</th> <th>Aktiv</th> <th>Ta bort permanent</th><th>Återställ</th>
 </tr>

<?php foreach ($users as $user) : ?>
	<tr>
		<td><a href="<?=$this->url->create('users/id').'/'.$user->getProperties()['id']?>"><?=$user->getProperties()['acronym']?></a></td>
		<td><?=$user->getProperties()['id']?></td>
		<td><?=$user->getProperties()['active']?></td>
		<td><a href="<?=$this->url->create('users/delete').'/'.$user->getProperties()['id']?>" style="color:red;"><i class="fa fa-trash"></i></a></td>
		<td><a href="<?=$this->url->create('users/undosoftDelete').'/'.$user->getProperties()['id']?>" style="color:green;"><i class="fa fa-repeat"></i> </a></td>
	</tr>

<?php endforeach; ?>
</table>
