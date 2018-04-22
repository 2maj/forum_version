<?php
if(isset($_POST['pseudo']) and isset($_POST['mail']) and isset($_POST['mdp']) and isset($_POST['mdp2'])){
		$inscription=new inscription($_POST['pseudo'], $_POST['mail'], $_POST['mdp'], $_POST['mdp2']);
		$erreur=$inscription->verification();
	}
?>
