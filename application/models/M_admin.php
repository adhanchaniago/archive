<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }
	
	//CONFIGURATION TABEL BERITA
	public function insert_berita($data){
        $this->db->insert("berita",$data);
    }
    
    public function update_berita($where,$data){
        $this->db->update("berita",$data,$where);
    }

    public function delete_berita($where){
        $this->db->delete("berita", $where);
    }

	public function get_berita($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("berita");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_berita($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("berita");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	
    public function grid_all_berita2($select, $orderBy, $sortBy, $limit, $start, $month="", $year="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("berita");
		if ($month){
			$this->db->where("DATE_FORMAT(berita_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(berita_created,'%Y')", $year);
		}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
	}
	
	public function count_all_berita($where="", $like=""){
        $this->db->select("*");
        $this->db->from("berita");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	public function count_all_berita2($month="", $year="", $like=""){
        $this->db->select("*");
        $this->db->from("berita");
		if ($month){
			$this->db->where("DATE_FORMAT(berita_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(berita_created,'%Y')", $year);
		}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	//CONFIGURATION TABEL RAK
	public function insert_rak($data){
        $this->db->insert("rak",$data);
    }
    
    public function update_rak($where,$data){
        $this->db->update("rak",$data,$where);
    }

    public function delete_rak($where){
        $this->db->delete("rak", $where);
    }

	public function get_rak($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("rak");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_rak($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("rak");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_rak($where="", $like=""){
        $this->db->select("*");
        $this->db->from("rak");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	
	//CONFIGURATION TABEL Arsip
	public function insert_arsip($data){
        $this->db->insert("arsip",$data);
    }
    
    public function update_arsip($where,$data){
        $this->db->update("arsip",$data,$where);
    }

    public function delete_arsip($where){
        $this->db->delete("arsip", $where);
    }

	public function get_arsip($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("arsip a");
		$this->db->join('rak r', 'a.rak_id = r.rak_id');
		$this->db->join('berita b', 'a.berita_id = b.berita_id');
		$this->db->where($where);

		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_arsip($select, $orderBy, $sortBy, $limit, $start, $first_date, $second_date, $like=""){
		$data = "";
        $this->db->select($select);
        $this->db->from("arsip a");
		$this->db->join('rak r', 'a.rak_id = r.rak_id');
		$this->db->join('berita b', 'a.berita_id = b.berita_id');
					$this->db->where('arsip_created >=', $first_date);
					$this->db->where('arsip_created <=', $second_date);
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_arsip2($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
		$data = "";
        $this->db->select($select);
        $this->db->from("arsip a");
		$this->db->join('rak r', 'a.rak_id = r.rak_id');
		$this->db->join('berita b', 'a.berita_id = b.berita_id');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
	}
	
	public function count_all_arsip($first_date="2000-01-01 00:00:00", $second_date="2030-01-01 00:00:00", $like=""){
        $this->db->select("*");
        $this->db->from("arsip");
		$this->db->where('arsip_created >=', $first_date);
		$this->db->where('arsip_created <=', $second_date);
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	public function count_all_arsip2($where="", $like=""){
        $this->db->select("*");
        $this->db->from("arsip");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABEL USER
	public function select_admin(){
		$data = $this->db->get('user')->result();
		return $data;
	}

	public function insert_admin($data){
        $this->db->insert("user",$data);
    }
    
    public function update_admin($where,$data){
        $this->db->update("user",$data,$where);
    }

    public function delete_admin($where){
        $this->db->delete("user", $where);
    }

	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("user");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABEL IDENTITAS
	public function select_identitas(){
		$data = $this->db->get('identitas')->result();
		return $data;
	}

	public function insert_identitas($data){
        $this->db->insert("identitas",$data);
    }
    
    public function update_identitas($where,$data){
        $this->db->update("identitas",$data,$where);
    }

    public function delete_identitas($where){
        $this->db->delete("identitas", $where);
    }

	public function get_identitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_identitas($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit, $start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_identitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	public function identitaswebsite(){
        $data = "";
		$where['identitas_id'] = 1;
		$this->db->select("*");
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    
    // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

    // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	   // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box3($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name'  style='display:none;' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_kelas($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->kelas_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
}