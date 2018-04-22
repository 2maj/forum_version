<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Visagelivre extends CI_Controller{
	private $ss;
	public function __construct(){
		parent::__construct();
		$this->ss=session_start();
		$this->load->model('Visagelivre_model');
		//$this->load->helper('webetuinfo.iutlan.univ-rennes1.fr/adjimi/a26/visagelivre');
	}
	/*
	public function display($content) //$content='home'
	{ // note the default value
		if(!file_exists('application/views/'.$content.'.php')){
			//don't have the page
			show_404();
		}
		$data['content']=$content;
		$this->load->vars($data);
		$this->load->view($content);
	}
	*/
	public function index(){
		if($this->ss){
			if(!isset($_SESSION['etat'])){ //Petite erreur ici
				$_SESSION['etat']=1;
				$this->load->view('Visagelivre_view');
			
			}else{
				$this->load->view('Visagelivre_view');
			}
		
		}else{
			echo "Session off";
		}

	}
	//Selon le choix connexion ou inscription
	public function visagelivre_ctrl(){
		if(isset($_POST['log_in'])){
			$_SESSION['etat']=2;
			$this->load->view('Visagelivre_view');
			//$this->load->view('connexion_view');
		}
		if(isset($_POST['register'])){
			$_SESSION['etat']=3;
			$this->load->view('Visagelivre_view');

			//$this->load->view('inscription_view');
		}
	}
	
	public function test_getusers(){
		print_r($this->Visagelivre_model->getUsers());
	}
	/*
	 * Affichage users et friends
	 */
	/*
	public function list_user_friend_view(){
		$data['title_user']='USERS';
		$data['title_friend']='FRIENDS';
		$data['users']=$this->Visagelivre_model->getUsers();
		$data['friendofs']=$this->Visagelivre_model->getFriendofs();
	}
	*/
	public function inscription(){
		$erreur=$this->Visagelivre_model->creation();
		if($erreur==1){
			$_SESSION['etat']=0;
			$this->load->view('Visagelivre_view');
		}
		else{
			$_SESSION['etat']=3;
			$this->load->view('Visagelivre_view');
		}

	}
	/*
	public function connexion(){
	$this->load->view('connexion_view');
	}
	*/
	public function connexion_ctrl(){
		if(isset($_POST['login'])) {
			if ($this->Visagelivre_model->verification_connexion()) {
				//On charge la page de l'espace personnel donc l'état change pour être 4
				$_SESSION['etat'] = 4;
				$_SESSION['login'] = $_POST['pseudo'];
				$this->load->view('Visagelivre_view');

				//$this->load->view('espace_perso_view');
			} else {
				$_SESSION['etat'] = 2;
				$this->load->view('Visagelivre_view');
			}
		}
		if(isset($_POST['register'])){
			$_SESSION['etat']=3;
			$this->load->view('Visagelivre_view');
		}
	}
	/*
	 * Gestion des fonctions d'espace personnel de l'utilisateur
	 */
	public function espace_perso_ctrl(){
		//echo "espace perso";

		if(isset($_GET['affiche_user'])){
			$_SESSION['title_user']='USERS';
			$_SESSION['title_friend']='FRIENDS';
			$_SESSION['users']=$this->Visagelivre_model->getUsers($_SESSION['login']);
			$_SESSION['friendofs']=$this->Visagelivre_model->getFriendOfs($_SESSION['login']);
			//$this->load->vars($data);
			$_SESSION['etat']=5;
			$this->load->view('Visagelivre_view');

			//$this->load->view('list_user_friend_view');
		}
		if(isset($_POST['retour'])){
			$_SESSION['etat']=4;
			$this->load->view('Visagelivre_view');

			//$this->load->view('espace_perso_view');
		}
		/*
		 * Le ctrl de affichage de la liste des demande
		 */
		if(isset($_GET['requester_list'])){
			$_SESSION['etat']=6;
			$_SESSION['title_requester']='Demande amis(es)';
			$_SESSION['requesterof']=$this->Visagelivre_model->getRequester_of($_SESSION['login']);
			//$this->load->vars($data);
			$this->load->view('Visagelivre_view');
			//$this->requester_list_ctrl();
			//traitement dans requester_list_ctrl
		}
		/*
		 * La déconnexion de l'utilisateur
		 */
		if(isset($_GET['log_out'])){
			session_destroy();
			$_SESSION['etat']=1;
			$this->index();
		}
		/*
		 * Suppression compte
		 */
		if(isset($_GET['delete'])){
			$this->Visagelivre_model->delete_count($_SESSION['login']);
			session_destroy();
			$_SESSION['etat']=1;
			$this->index();
		}
		/*
		 * La création de post billet
		 */
		if(isset($_GET['billet'])){
			$_SESSION['etat']=7;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_GET['my_post'])){
			$_SESSION['my_post']=$this->Visagelivre_model->get_my_billet($_SESSION['login']);
			//print_r($_SESSION['my_post']);
			if(!empty($_SESSION['my_post'])){
				$_SESSION['etat']=8;
				$this->load->view('Visagelivre_view');
			}else{
				print_r("Aucun post !");
				$_SESSION['etat']=4;
				$this->load->view('Visagelivre_view');
			}
		}
		if(isset($_GET['friend_post'])){
			$_SESSION['friend_post']=$this->Visagelivre_model->get_ami_billet_mdl($_SESSION['login']);
			if(!empty($_SESSION['friend_post'])){			
				$_SESSION['etat']=9;
				$this->load->view('Visagelivre_view');
			}else{
				print_r("Aucun post !");
				$_SESSION['etat']=4;
				$this->load->view('Visagelivre_view');
			}
		}
	}
	/*
	 * Gestion des demandes d'amitier
	 */
	public function requester_send_ctrl(){
		if(isset($_GET['add'])){

			print_r($this->Visagelivre_model->requester_mdl($_GET['target'],$_SESSION['login']));
			$_SESSION['users']=$this->Visagelivre_model->getUsers($_SESSION['login']);
			$_SESSION['friendofs']=$this->Visagelivre_model->getFriendOfs($_SESSION['login']);
			//print_r($_GET['target']);
			$_SESSION['etat']=5;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_GET['end'])){
			print_r($this->Visagelivre_model->delete_friend_mdl($_GET['target'],$_SESSION['login']));
			$_SESSION['users']=$this->Visagelivre_model->getUsers($_SESSION['login']);
			$_SESSION['friendofs']=$this->Visagelivre_model->getFriendOfs($_SESSION['login']);
			$_SESSION['etat']=5;
			$this->load->view('Visagelivre_view');
		}

	}
	public function requester_list_ctrl(){
		if(isset($_GET['accept'])){
			print_r($this->Visagelivre_model->requester_accepted($_SESSION['login'],$_GET['dmd']));
			$_SESSION['etat']=6;
			$_SESSION['requesterof']=$this->Visagelivre_model->getRequester_of($_SESSION['login']);
			$this->load->view('Visagelivre_view');
		}
		if(isset($_GET['refuse'])){
			print_r($this->Visagelivre_model->requester_deleted($_SESSION['login'],$_GET['dmd']));
			$_SESSION['etat']=6;
			$_SESSION['requesterof']=$this->Visagelivre_model->getRequester_of($_SESSION['login']);
			$this->load->view('Visagelivre_view');
		}
		if(isset($_GET['retour'])){
			$_SESSION['etat']=4;
			$this->index();
		}
	}
	/*
	 * Gestion des post(billets)
	 */
	public function billet_ctrl(){
		if(isset($_POST['create'])){
			print_r($this->Visagelivre_model->billet_creation_mdl($_SESSION['login'],$_POST['contenu']));
			$_SESSION['etat']=4;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_POST['cancel'])){
			print_r("La création du post est annuler");
			$_SESSION['etat']=4;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_POST['retour'])){
			$_SESSION['etat']=4;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_POST['post'])){
			$_SESSION['le_post']=$this->Visagelivre_model->get_un_billet($_POST['id']);
			$_SESSION['etat']=10;
			$this->load->view('Visagelivre_view');
		}
	}
	public function comment_ctrl(){
		if(isset($_POST['comment'])){
			$_SESSION['etat']=11;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_POST['create'])){
			print_r($this->Visagelivre_model->creation_comment($_SESSION['le_post'][0]['iddoc'],$_SESSION['login'], $_POST['contenu']));
			$_SESSION['etat']=4;
			$this->load->view('Visagelivre_view');
		}
		if(isset($_POST['cancel'])){
			print_r("La création du commentaire a été annuler");
			$_SESSION['etat']=10;
			$this->load->view('Visagelivre_view');
		}
	}
}
?>
