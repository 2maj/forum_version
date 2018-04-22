<?php
include('../connect.php');
class Todo_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function get_user(){
		$query=$this->db->get('_user');
		return $query->result_array();
	}
	public function get_friendof(){
		$query=$this->db->get('_friendof');
		return $query->result_array();
	}
	public function user_add_friend($nickname){
		$data=array('nickname'=>$nickname);
		return $this->db->insert('_friendof',$data);
		// produce ' INSERT INTO todo ( title ) VALUES (...) ;'
	}
	public function todo_delete_task($nickname){
		$data=array('nickname'=>$nickname);
		$this->db->delete('_friendof',$data);
	}
}
?>
