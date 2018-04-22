<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>
		Visage Livre
	</title>
</head>
<body>
	<form method="post" action='requester_send_ctrl'>
		<select multiple name="accept[]">
			<?php foreach ($users as $user): ?>
				<option value=<?php echo $user['nickname']; ?> ><?php echo "<li>".$user['nickname']."</li>"; ?></option>
			<?php endforeach ?>
		</select><br>
		<input type="submit" value="Ajouter" />
	</form>

</body>
</html>
