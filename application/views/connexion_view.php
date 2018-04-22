<?php

?>
<h1>Connectez-vous à votre espace</h1>
<div>
	<?php echo form_open('visagelivre/visagelivre_connexion'); ?>	
		<input name="pseudo" type="text" placeholder="Pseudo..." required /><br><br>
		<input name="mdp" type="password" placeholder="Mot de passe..." required /><br><br>
		<input type="submit" value="Log in" />
	</form>
</div>
