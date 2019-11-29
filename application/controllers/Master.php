<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

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
				redirect("master/laporan");
			}
		} else {
			redirect("login");
		}
	 }

    // ================================================== Berita ================================================== //
	//FUNCTION Berita
	public function berita($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Berita';
				$data['content'] 			= 'backend/content/master/berita';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('berita_id'=>'ID Berita',
														'berita_koran'=>'Nama Koran',
														'berita_hari'=>'Hari',
														'berita_kejadian'=>'Kejadian',
														'berita_judul'=>'Judul');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'berita_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_berita[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_berita('', $like_berita);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('berita_id'=>'ID Berita',
														'berita_koran'=>'Nama Koran',
														'berita_halaman'=>'Halaman',
														'berita_kolom'=>'Kolom',
														'berita_kejadian'=>'Kejadian',
														'berita_judul'=>'Judul',
														'berita_bulan'=>'Berita Bulan',
														'berita_tahun'=>'Berita Tahun'
												  );
					$data['onload']				= 'berita_id';
					$data['berita_id']			= ($this->input->post('berita_id'))?$this->input->post('berita_id'):'';
					$data['berita_bulan']		= ($this->input->post('berita_bulan'))?$this->input->post('berita_bulan'):'';	
					$data['berita_tahun']		= ($this->input->post('berita_tahun'))?$this->input->post('berita_tahun'):'';	
					$data['berita_koran']		= ($this->input->post('berita_koran'))?$this->input->post('berita_koran'):'';
					$data['berita_halaman']		= ($this->input->post('berita_halaman'))?$this->input->post('berita_halaman'):'';	
					$data['berita_kolom']		= ($this->input->post('berita_kolom'))?$this->input->post('berita_kolom'):'';	
					$data['berita_kejadian']	= ($this->input->post('berita_kejadian'))?$this->input->post('berita_kejadian'):'';	
					$data['berita_judul']		= ($this->input->post('berita_judul'))?$this->input->post('berita_judul'):'';		
					
					$where['berita_id']			= $data['berita_id'];
					$jml_berita				= $this->ADM->count_all_berita($where);
									
					$simpan						= $this->input->post('simpan');
					if ($simpan && $jml_berita < 1 ){								
						$insert['berita_id']			= validasi_sql($data['berita_id']);
						$insert['berita_koran']			= validasi_sql($data['berita_koran']);
						$insert['berita_halaman']		= validasi_sql($data['berita_halaman']);
						$insert['berita_kolom']			= validasi_sql($data['berita_kolom']);
						$insert['berita_kejadian']		= validasi_sql($data['berita_kejadian']);
						$insert['berita_judul']			= validasi_sql($data['berita_judul']);
						$insert['berita_bulan']			= validasi_sql($data['berita_bulan']);
						$insert['berita_tahun']			= validasi_sql($data['berita_tahun']);
						$date = new DateTime();
						$date = $date->format('dd-mm-YYYY');
						$insert['berita_hari']			= inday($date);
						$this->ADM->insert_berita($insert);
						$this->session->set_flashdata('success','Berita baru telah berhasil ditambahkan!,');
						redirect("master/berita");
					} elseif ($simpan && $jml_berita > 0 ){
						echo '<script type="text/javascript">
								alert("ID Berita sudah ada!,");
							</script>';
					}
				} elseif ($data['action'] == 'edit'){				
					$where['berita_id']		       = $filter2; 
					$data['validate']			= array('berita_id'=>'ID Berita',
														'berita_koran'=>'Nama Koran',
														'berita_halaman'=>'Halaman',
														'berita_kolom'=>'Kolom',
														'berita_kejadian'=>'Kejadian',
														'berita_judul'=>'Judul',
														'berita_bulan'=>'Berita Bulan',
														'berita_tahun'=>'Berita Tahun'
														);
					$data['onload']					= 'berita_id';
					$where_berita['berita_id']		= $filter2; 
					$berita							= $this->ADM->get_berita('*', $where_berita);
					$data['berita_id']				= ($this->input->post('berita_id'))?$this->input->post('berita_id'):$berita->berita_id;
					$data['berita_bulan']					= ($this->input->post('berita_bulan'))?$this->input->post('berita_bulan'):$berita->berita_bulan;
					$data['berita_tahun']					= ($this->input->post('berita_tahun'))?$this->input->post('berita_tahun'):$berita->berita_tahun;
					$data['berita_koran']				= ($this->input->post('berita_koran'))?$this->input->post('berita_koran'):$berita->berita_koran;	
					$data['berita_halaman']				= ($this->input->post('berita_halaman'))?$this->input->post('berita_halaman'):$berita->berita_halaman;	
					$data['berita_kolom']				= ($this->input->post('berita_kolom'))?$this->input->post('berita_kolom'):$berita->berita_kolom;	
					$data['berita_kejadian']				= ($this->input->post('berita_kejadian'))?$this->input->post('berita_kejadian'):$berita->berita_kejadian;	
					$data['berita_judul']				= ($this->input->post('berita_judul'))?$this->input->post('berita_judul'):$berita->berita_judul;				
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['berita_id']	= validasi_sql($data['berita_id']);
						$edit['berita_bulan']			= validasi_sql($data['berita_bulan']);
						$edit['berita_tahun']			= validasi_sql($data['berita_tahun']);
						$edit['berita_koran']			= validasi_sql($data['berita_koran']);
						$edit['berita_halaman']			= validasi_sql($data['berita_halaman']);
						$edit['berita_kolom']			= validasi_sql($data['berita_kolom']);
						$edit['berita_kejadian']			= validasi_sql($data['berita_kejadian']);
						$edit['berita_judul']			= validasi_sql($data['berita_judul']);
						$this->ADM->update_berita($where_edit, $edit);
						$this->session->set_flashdata('success','Berita telah berhasil diedit!,');
						redirect("master/berita");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'berita_id';
					$where_berita['berita_id']		        = $filter2; 
					$data['berita']							= $this->ADM->get_berita('*', $where_berita);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['berita_id'] = validasi_sql($filter2);
					$this->ADM->delete_berita($where_delete);
					$this->session->set_flashdata('warning','Berita telah berhasil dihapus!,');
					redirect("master/berita");
				}
			} else {
				redirect("akun/user");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
    // ================================================== END Berita ================================================== //
	
    // ================================================== RAK ================================================== //
	//FUNCTION Rak
	public function rak($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Rak';
				$data['content'] 			= 'backend/content/master/rak';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('rak_nama'=>'Nama Rak');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'rak_nama';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_rak[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_rak('', $like_rak);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('rak_nama'=>'Nama Rak');
					$data['onload']				= 'rak_id';
					$data['rak_nama']		= ($this->input->post('rak_nama'))?$this->input->post('rak_nama'):'';	
					$simpan						= $this->input->post('simpan');
					if ($simpan){
						$insert['rak_nama']			= validasi_sql($data['rak_nama']);
						$this->ADM->insert_rak($insert);
						$this->session->set_flashdata('success','Rak baru telah berhasil ditambahkan!,');
						redirect("master/rak");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['rak_id']		       = $filter2; 
					$data['validate']				= array(
														'rak_nama'=>'Nama Rak'
														);
					$data['onload']					= 'rak_id';
					$where_rak['rak_id']			= $filter2; 
					$rak							= $this->ADM->get_rak('*', $where_rak);
					$data['rak_id']					= ($this->input->post('rak_id'))?$this->input->post('rak_id'):$rak->rak_id;
					$data['rak_nama']				= ($this->input->post('rak_nama'))?$this->input->post('rak_nama'):$rak->rak_nama;	
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['rak_id']		= validasi_sql($data['rak_id']);
						$edit['rak_nama']			= validasi_sql($data['rak_nama']);
						$this->ADM->update_rak($where_edit, $edit);
						$this->session->set_flashdata('success','Rak telah berhasil diedit!,');
						redirect("master/rak");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'rak_id';
					$where_rak['rak_id']		    = $filter2; 

					$data['batas']				= 10000;
					$where_arsip['rak_id']		= $filter2;
					$data['jml_data']			= $this->ADM->count_all_arsip2($where_arsip, '');

					$data['rak']					= $this->ADM->get_rak('*', $where_rak);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['rak_id'] = validasi_sql($filter2);
					$this->ADM->delete_rak($where_delete);
					$this->session->set_flashdata('warning','Rak telah berhasil dihapus!,');
					redirect("master/rak");
				}
			} else {
				redirect("akun/user");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
    // ================================================== END Rak ================================================== //

	// ================================================== ARSIP ================================================== //
	//FUNCTION Arsip
	public function arsip($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Arsip';
				$data['content'] 			= 'backend/content/master/arsip';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['first_date'] ="2000-01-01";
					$data['second_date'] ="2030-01-01";
					$first_date = "2000-01-01";
					$second_date ="2030-01-01";
					$data['kirim']						= $this->input->post('kirim');
					if ($this->input->post('arsip_bulan')) {
						$first_date = $this->input->post('arsip_bulan').' 00:00:00';
						$second_date = $this->input->post('arsip_tahun').' 00:00:00';
					}
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$data['jml_data']			= $this->ADM->count_all_arsip($first_date, $second_date, '');
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);

				} elseif ($data['action'] == 'tambah'){		
					$data['where']		       = $filter2; 	

					$data['validate']			= array('arsip_id'=>'Arsip ID',
														'berita_id'=>'Berita ID',
														'rak_id'=>'Rak ID');
					$data['onload']				= 'arsip_id';
					$data['berita_id']		= ($this->input->post('berita_id'))?$this->input->post('berita_id'):'';	
					$data['rak_id']		= ($this->input->post('rak_id'))?$this->input->post('rak_id'):'';	
					$data['arsip_dok']		= ($this->input->post('arsip_dok'))?$this->input->post('arsip_dok'):'';	
					$simpan						= $this->input->post('simpan');
					if ($simpan){

						$insert['berita_id']			= validasi_sql($data['berita_id']);
						$insert['rak_id']				= validasi_sql($data['rak_id']);

						$config['upload_path']          = './assets/files/arsip_dok/'; 
						$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
						$config['encrypt_name'] 		= TRUE;
						$config['max_size']             = 11000;
						$config['max_width']            = 4096;
						$config['max_height']           = 2048;

						$this->upload->initialize($config);
						if ($this->upload->do_upload('arsip_dok'))
						{
							$data = array('upload_data' => $this->upload->data());
							$insert['arsip_dok'] = $this->upload->data('file_name');
						}

						$this->ADM->insert_arsip($insert);
						$this->session->set_flashdata('success','Arsip baru telah berhasil ditambahkan!,');
						redirect("master/arsip");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['arsip_id']		       = $filter2; 				
					$data['validate']			= array('arsip_id'=>'Arsip ID',
					'berita_id'=>'Berita ID',
					'rak_id'=>'Rak ID');
					$data['onload']					= 'arsip_id';
					$where_arsip['arsip_id']			= $filter2; 
					$arsip							= $this->ADM->get_arsip('*', $where_arsip);

					$data['arsip_id']					= ($this->input->post('arsip_id'))?$this->input->post('arsip_id'):$arsip->arsip_id;
					$data['berita_id']					= ($this->input->post('berita_id'))?$this->input->post('berita_id'):$arsip->berita_id;
					$data['berita_kejadian']					= ($this->input->post('berita_kejadian'))?$this->input->post('berita_kejadian'):$arsip->berita_kejadian;
					$data['berita_judul']					= ($this->input->post('berita_judul'))?$this->input->post('berita_judul'):$arsip->berita_judul;
					$data['rak_id']					= ($this->input->post('rak_id'))?$this->input->post('rak_id'):$arsip->rak_id;
					$data['rak_nama']					= ($this->input->post('rak_nama'))?$this->input->post('rak_nama'):$arsip->rak_nama;
					$data['arsip_dok']					= ($this->input->post('arsip_dok'))?$this->input->post('arsip_dok'):$arsip->arsip_dok;
				
								

					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['arsip_id']		= validasi_sql($data['arsip_id']);

						$edit['berita_id']			= validasi_sql($data['berita_id']);
						$edit['rak_id']				= validasi_sql($data['rak_id']);

						$config['upload_path']          = './assets/files/arsip_dok/'; 
						$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
						$config['encrypt_name'] 		= TRUE;
						$config['max_size']             = 11000;
						$config['max_width']            = 4096;
						$config['max_height']           = 2048;
					
					$this->upload->initialize($config);
					if ($this->upload->do_upload('arsip_dok'))
					{
						unlink("./assets/files/arsip_dok/".$arsip->arsip_dok);

						$data = array('upload_data' => $this->upload->data());
						$edit['arsip_dok'] 	= $this->upload->data('file_name');
					}


						$this->ADM->update_arsip($where_edit, $edit);
						$this->session->set_flashdata('success','Arsip telah berhasil diedit!,');
						redirect("master/arsip");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'arsip_id';
					$where_rak['arsip_id']		    = $filter2; 

					$data['batas']				= 10000;
					$where_arsip['arsip_id']		= $filter2;
					$data['arsip']					= $this->ADM->get_arsip('*', $where_arsip);
				} elseif ($data['action'] == 'hapus'){			
					$where_arsip['arsip_id']			= $filter2; 
					$arsip							= $this->ADM->get_arsip('*', $where_arsip);	
						unlink("./assets/files/arsip_dok/".$arsip->arsip_dok);
					$where_delete['arsip_id'] = validasi_sql($filter2);
					$this->ADM->delete_arsip($where_delete);
					$this->session->set_flashdata('warning','Arsip telah berhasil dihapus!,');
					redirect("master/arsip");
				}
			} else {
				redirect("akun/user");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Rak ================================================== //
	

	   // ================================================== Laporan ================================================== //
	//FUNCTION Laporan
	public function laporan($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Laporan List Berita';
				$data['content'] 			= 'backend/content/master/laporan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('berita_id'=>'ID Berita',
					'berita_koran'=>'Nama Koran',
					'berita_hari'=>'Hari',
					'berita_kejadian'=>'Kejadian',
					'berita_judul'=>'Judul');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'berita_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';

					$like_berita[$data['cari']]	= $data['q'];

					$data['month'] ="";
					$data['year'] ="";
					$month = "";
					$year ="";
					$data['kirim']				= $this->input->post('kirim');
					if ($this->input->post('month')) {
						$month = $this->input->post('month');
						$year = $this->input->post('year');
					}
					
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$data['jml_data']			= $this->ADM->count_all_berita2($month, $year, $like_berita);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				}
			} else {
				redirect("akun/user");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Laporan ================================================== //
	
	// ================================================== END PDF ================================================== //
	public function beritapdf($filter1='', $filter2='', $filter3=''){
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				$data['title'] = 'Cetak Template Kliping'; 
				$data['jml_data']			= $this->ADM->count_all_berita('' , '');

				$data['onload']		= 'berita_id';
				$where_berita['berita_id']		        = $filter1; 
				$data['berita']							= $this->ADM->get_berita('*', $where_berita);

				$this->load->view('backend/content/master/pdf/berita', $data);
				$paper_size  = 'A4'; 
				$orientation = 'potrait'; 
				$html = $this->output->get_output();
				def("DOMPDF_ENABLE_REMOTE", false);
				$this->dompdf->load_html($html);
				$this->dompdf->render();
				$this->dompdf->stream("templatekliping".$filter1.".pdf", array('Attachment'=>0));
			} else {
				redirect("akun/user");
			}
		} else {
			redirect("wp_login");
		}  
	}

	public function laporanpdf($filter1='', $filter2='', $filter3=''){
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'user') {
				$data['web']				= $this->ADM->identitaswebsite();
				$data['title'] = 'Cetak Laporan List Berita'; 

				if ($filter1) {
					$data['filter1']	        = $filter1; 
					$data['filter2']	        = $filter2; 
					$data['month']	        = $filter1; 
					$data['year']	        = $filter2; 
					$this->load->view('backend/content/master/pdf/laporan', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanlistberita-".$filter2."-".$filter1.".pdf", array('Attachment'=>0));
				} else {
					$data['filter1']	        = ''; 
					$data['filter2']	        = ''; 
					$data['month']	        = ''; 
					$data['year']	        = ''; 
					$this->load->view('backend/content/master/pdf/laporan', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanlistberitasemua.pdf", array('Attachment'=>0));
				}
			} else {
				redirect("akun/user");
			}
		} else {
			redirect("wp_login");
		}  
	}
}
