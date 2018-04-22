<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>
		Visage Livre
	</title>
</head>
<body>
	<h2><?php echo $title_requester?></h2>
		<ul>
		<form method="get" action='visagelivre/requester_list_ctrl'>
			<?php foreach ($requesterof as $request): ?>
				<?php echo "<li>".$request['target']."</li>"; ?>
			<input type="submit" name='accept' value="Accepter" />
			<input type="submit" name='refuse' value="Réfuser" />
			<br>
			<?php endforeach ?>
		<input type="submit" name='retour' value="Retour" />
		</form>
		</ul>
</body>
</html>