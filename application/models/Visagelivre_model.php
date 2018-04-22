<?php
class Visagelivre_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function creation()
	{
		if (isset($_POST['pseudo']) and isset($_POST['mail']) and isset($_POST['mdp']) and isset($_POST['mdp2']) and $this->verification()==1) {
			$this->insert_user($_POST['pseudo'],$_POST['mail'],$_POST['mdp']);
			return 1;
		}

		return 0;

	}
	/*
	 * Obtenir la liste de tous les utilisateurs sans celui qui est connecté
	 */
	public function getUsers($login){

		return $this->db->query("select nickname from visagelivre._user where nickname<>'$login'")->result_array();
	}
	/*
	 * Obtenir la liste des ami
	 */

	public function getFriendOfs($pseudo){
		return $this->db->query("select nickname,friend from visagelivre._friendof where nickname='$pseudo'")->result_array();
	}
	/*Supprimer l'amitier*/
	public function delete_friend_mdl($target,$login){
		if(!empty($this->verification_amitier($target,$login))) {
			$this->db->query("delete from visagelivre._friendof where friend='$target' and nickname='$login'");
			$this->db->query("delete from visagelivre._friendof where friend='$login' and nickname='$target'");
			return "lien d'amitier supprimer pour $target!";
		}else{
			return "Vous n'êtes pas encore ami à $target, veillez consulter la liste des demandes.";
		}
	}
	/*
	 * Ajout d'un nouvel etudiant
	 */
	public function insert_user($pseudo,$mail,$mdp){
		return $this->db->query("insert into visagelivre._user(nickname,email,pass) values('$pseudo','$mail','$mdp')");
;
	}
	/*
	 * Verifications de la saisie
	 */
	public function verification(){
		if(strlen($_POST['pseudo'])>5 and strlen($_POST['pseudo'])<20 and $_POST['mdp']===$_POST['mdp2']){
			return 1;
		}else{
			return 0;
		}
	}
	/*
	 * Vérification de la connexion
	 */
	public function verification_connexion(){
		$sql="select * from visagelivre._user where nickname=? and pass=?";
		if(empty($this->db->query($sql, array($_POST['pseudo'], $_POST['mdp']))->result_array())){
			$_SESSION['login']=$_POST['pseudo'];
			$v=0;
		}else{
			$v=1;
		}
		return $v;
	}
	/*
	 * les fonctions de gestion de demande d'ami
	 */
	//L'envoi de la demande d'ami
	public function requester_mdl($target,$login){
		if(empty($this->verification_amitier($target,$login)) and empty($this->verification_demande($target,$login))){
			$this->db->query("insert into visagelivre._friendrequest values('$login','$target')");
			return "";
		}else{
			return "Demande d'ami en attente ou déjà ami avec $target";
		}
	}
	/*
	 * Vérifier l'amitier
	 */
	public function verification_amitier($target,$login){
		return $this->db->query("select friend from visagelivre._friendof where friend='$target' and nickname='$login'")->result_array();
	}
	/*
	 * Vérifier la demande
	 */
	public function verification_demande($target,$login){
		return $this->db->query("select target from visagelivre._friendrequest where target='$target' and nickname='$login'")->result_array();
	}
	/*
	 * Obtenir toutes ses demandes d'ami
	 */
	public function getRequester_of($login){
		return $this->db->query("select * from visagelivre._friendrequest where nickname='$login'")->result_array();
	}
	/*
	 * Accepter une demande d'ami
	 */
	public function requester_accepted($login,$target){
		$sql="insert into visagelivre._friendof values(?,?)";
		$this->db->query($sql, array($login,$target));
		//
		$this->db->query($sql, array($target,$login));
		$this->requester_deleted($login,$target);
		return "Vous êtes désormais ami avec $target";
	}
	/*
	 * Réfuser une demande
	 */
	public function requester_deleted($login,$target){
		$this->db->query("delete from visagelivre._friendrequest where  nickname='$login' and target='$target'");
		$this->db->query("delete from visagelivre._friendrequest where  nickname='$target' and target='$login'");
		return "Vous venez de supprimer la demande de relation avec $target";
	}
	/*
	 * Fonction de création d'un post
	 */
	public function billet_creation_mdl($login,$contenu){
		$this->db->query("insert into visagelivre._document(content,auteur) values('$contenu','$login')");
		$id=$this->db->query("select iddoc from visagelivre._document where content='$contenu' and auteur='$login'")->result_array();
		$idpost=$id[0]['iddoc'];
		$this->db->query("insert into visagelivre._post values($idpost)");
		return "Votre post est créé";
	}
	/*
	 * La fonction pour savoir qui est propriétaire d'un post
	 */
	public function is_admin($login,$iddoc){
		return $this->db->query("select auteur from visagelivre_.document where auteur='$login' and iddoc='$iddoc'")->result_array();
	}
	/*
	 * Y'a t-il un commentaire associer ?
	 */
	public function comment_asso_billet($iddoc){
		return $this->db->query("select iddoc from visagelivre_.comment where iddoc='$iddoc'")->result_array();
	}
	/*
	 * Fonction de suppresion d'un post
	 */
	public function billet_delete_mdl($login,$iddoc){
		if(!empty($this->is_admin($login,$iddoc))){
			if(empty($this->comment_asso_billet($iddoc))){
				$this->db->query("delete from visagelivre._document where iddoc='$iddoc' ");
				$re="Pas de commentaire.";
			}else{
				$this->db->query("delete from visagelivre._document where iddoc='$iddoc' ");
				$re="Les commentaires associés sont aussi supprimés.";
			}
			/*
			$this->db->query("delete from visagelivre._ where ");
			$this->db->query("delete from visagelivre._ where ");
			$this->db->query("delete from visagelivre._ where ");
			*/
		}
	}
	/*
	 * Avoir tous les post des amis et extraction de 30 premiers caractères
	 */
	public function get_ami_billet_mdl($dmd){
		return $this->db->query("select iddoc, nickname, left(content,30) as content from visagelivre._friendof f inner join visagelivre._document d on f.nickname=d.auteur where f.friend='$dmd' order by f.nickname,create_date desc ")->result_array();
	}
	/*
	 * extraction de 30 premiers caractères des my_post
	 */
	public function get_my_billet($login){
		return $this->db->query("select p.iddoc,left(content,30) as content from visagelivre._document d inner join visagelivre._post p on p.iddoc=d.iddoc where auteur='$login' order by create_date desc")->result_array();
	}
	/*
	 * Obtenir tous le contenu d'un post
	 */
	public function get_un_billet($id){
		return $this->db->query("select iddoc,content from visagelivre._document where iddoc=$id")->result_array();
	}
	/*
	 * Commentaire
	 */
	public function creation_comment($id,$login,$contenu){
		if(!empty($this->db->query("select iddoc from visagelivre._document where iddoc=$id and auteur='$login'")->result_array())
			or !empty("select f.nicknaame from visagelivre._document d inner join visagelivre_.friendof f  on d.auteur=f.nickname where d.iddoc='$id' and f.friend='$login'"))
		{
			$this->db->query("insert into visagelivre._document(content,auteur) values('$contenu','$login')");
			$idd=$this->db->query("select iddoc from visagelivre._document where content='$contenu' and auteur='$login'")->result_array();
			$idcom=$idd[0]['iddoc'];
			$this->db->query("insert into visagelivre._comment values($idcom,$id)");
			$r="commenté !";
		}else{
			$r="non commenté !";
		}
		return $r;
	}
	/*
	 * Suppression d'un compte
	 */
	public function delete_count($login){
		$this->db->query("delete from visagelivre._document where auteur='$login'");
		$this->db->query("delete from visagelivre._user where nickname='$login'");
	}
}
?>
