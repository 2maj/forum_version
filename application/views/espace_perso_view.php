<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>
		Visage Livre
	</title>
</head>
<body>
<h1>votre espace personnel <?php echo $_SESSION['pseudo'];?></h1>
<div>
	<h3>Les utilisateurs :</h3>
	<form method="get" action='espace_perso_ctrl'>
		<?php foreach($user as $membre ):?>
			<li><?php echo $membre['nickname'] ;?></li>
		<?php endforeach; ?>
	</form>
	<h3>Mes amis :</h3>
	<form method="get" action='afficheAmis'>
		<?php foreach($amis as $friends ):?>
			<li><?php echo $friends['nickname'] ;?></li>
		<?php endforeach; ?>
	</form>
</div>

</body>
</html>

