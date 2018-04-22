<h2><?php echo $title_user ?></h2>

<ul>
	<?php foreach ($users as $user): ?>
	<form method="get" action='requester_send_ctrl'>
		<?php $i=$user['nickname']; echo "<li>".$user['nickname']."</li>"; ?>
		<input type="submit" name='add' value="<?php echo $user['nickname']; ?>" />
	</form>
	<?php endforeach ?>
</ul>

<br><br>
<h2><?php echo $title_friend ?></h2>
<ul>
	<?php foreach ($friendofs as $friend): ?>
		<?php echo "<li>".$friend['nickname']."</li>"; ?>
	<?php endforeach ?>
</ul>
<br><br>
<form method="post" action='espace_perso_ctrl'>
	<input type="submit" name='retour' value="Retourner à votre espace personnel" />
</form>