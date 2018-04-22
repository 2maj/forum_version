<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>
		Visage Livre
	</title>
</head>
<body>
	<?php switch($_SESSION['etat']):
		case 0: ?>
			<?php echo "<h2>".'Verification faite !'."</h2>"; ?>
			<?php echo "<h2>".'Inscrit ! '."</h2>"; ?>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/visagelivre_ctrl'>
				<input type="submit" name='log_in' value="Se connecter" />
			</form>
		<?php break ?>
		 <?php case 1: ?>
			<h1>Bienvenue sur IUTbook</h1>
			<div>
				<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/visagelivre_ctrl'>
					<p>
						<input type="submit" name='register' value="S'inscrire" /><b></b>
						<input type="submit" name='log_in' value="Se connecter" />
					</p>
				</form>
			</div>
		<?php break; ?>
		<?php case 2: ?>
			<h1>Connectez-vous à votre espace</h1>
			<div>
				<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/connexion_ctrl'>
					<p>
						<input name="pseudo" type="text" placeholder="Pseudo..." /><br/><br/>
						<input name="mdp" type="password" placeholder="Mot de passe..." /><br/><br/>
						<input type="submit" name='login' value="se connecter" />
						<input type="submit" name='register' value="Créer un compte" />
					</p>
				</form>
			</div>
		<?php break; ?>
		<?php case 3: ?>
			<h1>inscription</h1>
			<div>
				<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/inscription'>
					<p>
						<input name="pseudo" type="text" placeholder="Pseudo..." required /><br>
						<input name="mail" type="email" placeholder="Adresse email..." required /><br>
						<input name="mdp" type="password" placeholder="Mot de passe..." required /><br>
						<input name="mdp2" type="password" placeholder="Confirmation..." required /><br>
						<input type="submit" value="S'inscrire" />
					</p>
				</form>
			</div>
		<?php break; ?>

		<?php case 4: ?>
			<h1>votre espace personnel <?php echo $_SESSION['login']; ?></h1>
			<div>
				<form method="get" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/espace_perso_ctrl'>
					<p>
						<input type="submit" name='affiche_user' value="Afficher liste des users" /><br><br>
						<input type="submit" name='requester_list' value="Voir la liste des demandes d'amis" /><br><br>
						<input type="submit" name='billet' value="Créer un billet" /><br><br>
						<input type="submit" name='my_post' value="Voir la liste de vos post" /><br><br>
						<input type="submit" name='friend_post' value="Voir la liste des post de vos amis" /><br><br>
						<input type="submit" name='log_out' value="Se déconnecter" /><br/><br/>
						<input type="submit" name='delete' value="Supprimer mon compte" />
					</p>
				</form>
			</div>
		<?php break; ?>
		<?php case 5:?>
			<h2><?php echo $_SESSION['title_user'] ?></h2>

			<ul>
				<?php foreach ($_SESSION['users'] as $user): ?>
				<form method="get" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/requester_send_ctrl'>
					<?php echo "<li>".$user['nickname']."</li>"; ?>
					<input type="hidden" name='target' value="<?php echo $user['nickname']; ?>">
					<input type="submit" name='add' value="Ajouter" />
					<input type="submit" name='end' value="arrêter amitier" />
				</form>
				<?php endforeach ?>
			</ul>

			<br><br>
			<h2><?php echo $_SESSION['title_friend'] ?></h2>
			<ul>
				<?php foreach ($_SESSION['friendofs'] as $friend): ?>
					<form method="get" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/requester_send_ctrl'>
						<?php echo "<li>".$friend['friend']."</li>"; ?>
						<input type="hidden" name='target' value="<?php echo $friend['friend']; ?>">
						<input type="submit" name='end' value="arrêter amitier" />
					</form>
				<?php endforeach ?>
			</ul>
			<br><br>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/espace_perso_ctrl'>
				<input type="submit" name='retour' value="Retourner à votre espace personnel" />
			</form>
		<?php break; ?>
		<?php case 6: ?>
			<h2><?php echo $_SESSION['title_requester']?></h2>
			<ul>
				<form method="get" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/requester_list_ctrl'>
					<?php foreach ($_SESSION['requesterof'] as $request): ?>
						<?php echo "<li>".$request['target']."</li>"; ?>
						<input type="hidden" name='dmd' value="<?php echo $request['target']; ?>">
						<input type="submit" name='accept' value="Accepter" />
						<input type="submit" name='refuse' value="Réfuser" />
						<br>
					<?php endforeach ?>
					<input type="submit" name='retour' value="Retour" />
				</form>
			</ul>
		<?php break;?>
		<?php case 7: ?>
			<h2>Création d'un billet</h2>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
				<p><label>Le contenu du post</label></p>
				<textarea type="text" name="contenu" placeholder="Votre post ici..." cols="50" rows="5"></textarea>
				<p>
					<input type="submit" name="create" value="créer le post"/>
					<input type="submit" name="cancel" value="Annuler"/>
				</p>
		<?php break ?>
		<?php case 8: ?>
			<h2>Liste de vos posts</h2>
			<table border="1">
				<tr><?php foreach(array_keys(current($_SESSION['my_post'])) as $key) :?>
						<th>
							<?php
							echo $key;
							?>
						</th>
					<?php endforeach; ?>
				</tr>

				<?php
				foreach($_SESSION['my_post'] as $un_post): ?>
					<tr>
						<?php
						foreach($un_post as $attr => $val) : ?>
							<td><?php if($attr=="content"): ?>
								<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
									<input type="hidden" name='id' value="<?php echo $un_post['iddoc']; ?>">
									<?php echo "$val ..."; ?>
									<p><input type="submit" name="post" value="Voir ce post"/></p>
									<?php else : ?>
										<?php echo "$val"; ?>
									<?php endif; ?>
								</form>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</table><br/><br/>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
				<input type="submit" name="retour" value="retour à mon espace"/>
			</form>

		<?php break ?>
		<?php case 9: ?>
			<h2>Liste des posts de vos ami(e)s</h2>
			<table border="1">
				<tr><?php foreach(array_keys(current($_SESSION['friend_post'])) as $key) :?>
						<th>
							<?php echo $key; ?>
						</th>
					<?php endforeach; ?>
				</tr>

				<?php
				foreach($_SESSION['friend_post'] as $un_post): ?>
					<tr>
						<?php
						foreach($un_post as $attr => $val) : ?>
							<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
							<td><?php if($attr=="content"): ?>
										<input type="hidden" name='id' value="<?php echo $un_post['iddoc']; ?>">
										<p><?php echo "$val ..."; ?></p>
									<p><input type="submit" name="post" value="Voir ce post"/></p>
									<?php else : ?>
										<?php echo "$val"; ?>
									<?php endif; ?>
							</form>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</table><br/><br/>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
				<input type="submit" name="retour" value="retour à mon espace"/>
			</form>
			<?php break ?>
		<?php case 10: ?>
			<h2>Votre post</h2>
			<table>

				<?php foreach($_SESSION['le_post'] as $un_post): ?>
					<tr>
						<td>
							<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/comment_ctrl'>
								<input type="hidden" name='id' value="<?php echo $un_post['iddoc']; ?>">
								<fieldset>
									<p><?php echo $un_post['content']; ?></p>
								</fieldset>
								<p><input type="submit" name="comment" value="commenter"/></p>
						</form>
					</td>
					</tr>
				<?php endforeach; ?>

			</table><br/><br/>
			<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/billet_ctrl'>
				<input type="submit" name="retour" value="retour à mon espace"/>
			</form>
		<?php break ?>
		<?php case 11: ?>
				<h2>Création d'un billet</h2>
				<form method="post" action='http://webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre/index.php/visagelivre/comment_ctrl'>
					<p><label>Le contenu du post</label></p>
					<textarea type="text" name="contenu" placeholder="Votre commentaire ici..." cols="50" rows="5"></textarea>
					<p>
						<input type="submit" name="create" value="créer le commentaire"/>
						<input type="submit" name="cancel" value="Annuler"/>
					</p>
		<?php break ?>
		<?php endswitch; ?>
</body>
</html>
