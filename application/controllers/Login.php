<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE){       
            redirect('admin/','refresh');
        } else {     
			$data['web']					= $this->ADM->identitaswebsite();
			$this->load->vars($data);
			$this->load->view('backend/login');
        }
	}
	
	public function ceklogin()
	{
		$username		= $this->input->post('username');
		$password		= $this->input->post('password');
		$do				= $this->input->post('masuk');
		
		$where_login['username']	= $username;
		$where_login['password']	= do_hash($password, 'md5');
		
		if ($this->LOG->cek_login($where_login) === TRUE){
			redirect("admin/");
		} else {
			$this->session->set_flashdata('warning','Username dan Password tidak cocok!');
            redirect("login");
		}
	}
	
	public function keluar()
	{
		$this->LOG->remov_session();
        session_destroy();
		redirect("login");
	}
}