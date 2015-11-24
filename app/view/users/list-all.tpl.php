<h2><?=$title?></h2>
 
 
 <table class='usersTable'>
 <tr> 
 <th>Användare</th><!-- <th>Uppdatera</th><th>Inaktivera | Aktivera</th><th>Ta bort</th> -->
 </tr>

<?php foreach ($users as $user) : ?>
	<tr>
		<td><a href="<?=$this->url->create('users/id').'/'.$user->getProperties()['id']?>"><?=$user->getProperties()['acronym']?></a></td>
		<!-- <td><a href="<?=$this->url->create('users/update').'/'.$user->getProperties()['id']?>" style="color:blue;"><i class="fa fa-wrench"></i></a></td>
		<td><a href="<?=$this->url->create('users/deactive').'/'.$user->getProperties()['id']?>" style="color:black;"><i class="fa fa-lock"></i></a> <a href="<?=$this->url->create('users/reactivate').'/'.$user->getProperties()['id']?>" style="color:green;"><i class="fa fa-repeat" style="margin-left:90px;"></i></a></td>
		<td><a href="<?=$this->url->create('users/softDelete').'/'.$user->getProperties()['id']?>" style="color:red;"><i class="fa fa-trash"></i></a></td> -->
	</tr>

<?php endforeach; ?>
</table>

