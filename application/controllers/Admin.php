<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['username']		= $this->session->userdata('username');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']					= $this->ADM->identitaswebsite();
				$data['breadcrumb']             = 'Dashboard';
				$data['content']				= 'backend/content/dashboard';
				$data['jml_data']			= $this->ADM->count_all_berita('', '');
				$this->load->vars($data);
				$this->load->view('backend/home');
			} else {
				redirect("akun/user");
			}
		} else {
			redirect("login");
		}
	 }
}