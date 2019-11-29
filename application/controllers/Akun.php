<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends CI_Controller {

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
			if ($data['admin']->user_role === 'admin') {
				$data['web']					= $this->ADM->identitaswebsite();
				$data['breadcrumb']             = 'Dashboard';
				$data['content']				= 'backend/content/dashboard';
				$data['jml_data']			= $this->ADM->count_all_berita('', '');
				$this->load->vars($data);
				$this->load->view('backend/home');
			} else {
				redirect("admin");
			}
		} else {
			redirect("login");
		}
	 }

    // ================================================== USER ================================================== //
	
	//FUNCTION User
	public function user($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'User';
				$data['content'] 			= 'backend/content/akun/user';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('username'=>'Username',
														'user_nama'=>'Nama');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'user_nama';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_admins[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_admin('', $like_admins);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('username'=>'Username',
													'password'=>'Password',
													'user_nama'=>'Nama',
													'user_role'=>'Role'
												);
					$data['onload']				= 'username';
					$data['username']			= ($this->input->post('username'))?$this->input->post('username'):'';
					$data['password']			= ($this->input->post('password'))?$this->input->post('password'):'';
					$data['user_nama']		= ($this->input->post('user_nama'))?$this->input->post('user_nama'):'';		
					
					$where['username']		= $data['username'];
					$jml_pengguna				= $this->ADM->count_all_admin($where);
									
					$simpan						= $this->input->post('simpan');
					if ($simpan && $jml_pengguna < 1 ){								
						$insert['username']		= validasi_sql($data['username']);
						$insert['password']		= validasi_sql(do_hash(($data['password']), 'md5'));
						$insert['user_nama']		= validasi_sql($data['user_nama']);
						$insert['user_role']		= 'user';
						$this->ADM->insert_admin($insert);
						$this->session->set_flashdata('success','User baru telah berhasil ditambahkan!,');
						redirect("akun/user");
					} elseif ($simpan && $jml_pengguna > 0 ){
						echo '<script type="text/javascript">
								alert("User telah terdaftar!,");
							</script>';
					}
				} elseif ($data['action'] == 'edit'){				
					$where['username']		       = $filter2; 
					$data['validate']			= array('username'=>'Username',
														'password'=>'Password',
														'user_nama'=>'Nama',
														'user_role'=>'Role'
														);
					$data['onload']					= 'username';
					$where_admin['username']		= $filter2; 
					$admin							= $this->ADM->get_admin('*', $where_admin);
					$data['username']				= ($this->input->post('username'))?$this->input->post('username'):$admin->username;
					$data['password']				= ($this->input->post('password'))?$this->input->post('password'):'';				
					$data['user_nama']				= ($this->input->post('user_nama'))?$this->input->post('user_nama'):$admin->user_nama;				
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['username']	= validasi_sql($data['username']);
						if ($data['password'] <> '') {						
						$edit['password']			= validasi_sql(do_hash(($data['password']), 'md5')); }
						$edit['user_nama']			= validasi_sql($data['user_nama']);
						$this->ADM->update_admin($where_edit, $edit);
						$this->session->set_flashdata('success','User telah berhasil diedit!,');
						redirect("akun/user");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'username';
					$where_admin['username']		        = $filter2; 
					$data['admins']							= $this->ADM->get_admin('*', $where_admin);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['username'] = validasi_sql($filter2);
					$this->ADM->delete_admin($where_delete);
					$this->session->set_flashdata('warning','User telah berhasil dihapus!,');
					redirect("akun/user");
				}
			} else {
				redirect("admin");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
    // ================================================== END USER ================================================== //
	
		//Fungsi Ubah Kata Sandi
		public function editpassword($filter1='', $filter2='', $filter3='')
		{
			if ($this->session->userdata('logged_in') == TRUE) {
				$where_admin['username'] 	= $this->session->userdata('username');
				$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
				$data['web']						= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         		= 'Edit Password';
				$data['content']					= 'backend/content/akun/editpassword';
	
				$data['validasi']					= array('password_recent'=>'Password Sekarang','password'=>'Password Baru','password_ulang'=>'Password Baru');
				$data['username']					= $this->session->userdata('username');
				$data['password_recent']			= ($this->input->post('password_recent'))?$this->input->post('password_recent'):'';
				$data['password']					= ($this->input->post('password'))?$this->input->post('password'):'';
				$data['password_ulang']			= ($this->input->post('password_ulang'))?$this->input->post('password_ulang'):'';
						
				$simpan	= $this->input->post('simpan');
				if($simpan){
					if(do_hash($data['password_recent'], 'md5') == $data['admin']->password) {
					   if($data['password'] == $data['password_ulang']) {
						   $where_edit['username']	= $data['username'];
						   if($data['password'] <> '') {
							   $edit['password']		= do_hash(($data['password']), 'md5'); 
						   }
						   $this->ADM->update_admin($where_edit, $edit);
						   $this->session->set_flashdata('success','Password Berhasil Diubah!,');
							   redirect("akun/editpassword");					   
					   } else {
						   $this->session->set_flashdata('error','Password Tidak Sesuai!,');
						   redirect("akun/editpassword");
					   }
				   } else {
					   $this->session->set_flashdata('warning','Password Sekarang Salah!,');
					   redirect("akun/editpassword");
				   }
				}
				$this->load->vars($data);
				$this->load->view('backend/home');
			} else {
				redirect("login");
			}
		}
}
