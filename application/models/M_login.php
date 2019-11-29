<?php
class M_login extends CI_Model {
	
	function __contsruct(){
		parent::Model();
	}
	
	function cek_login($where){
		$data = "";
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0) {
			$data = $Q->row();
			$this->set_session($data);
			return true;
		}
		return false;
	}
	
	function set_session(&$data){
		$session = array(
					'username' 		=> $data->username,
					'password' 		=> $data->password,
					'user_role' 	=> $data->user_role,
					'logged_in'		=> TRUE
					);
		$this->session->set_userdata($session);
	}
	
	function update_log($where){
		$where['username'] = $data->username;
		$where['user_nama'] = $data->user_nama;
		$this->db->update('admin',$data,$where);
	}
	
	function remov_session() {
		$session = array(
					'username'  =>'',
					'password'  =>'',
					'user_role' =>'',
					'logged_in'	  => FALSE
					);
		$this->session->unset_userdata($session);
	}
}