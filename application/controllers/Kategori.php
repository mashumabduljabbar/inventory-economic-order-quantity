<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_kategori");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	public function jsonkategori()
    {
		$tbl_kategori = $this->db->query("select * from tbl_kategori order by kd_kategori ASC")->result_array();
		echo json_encode($tbl_kategori);
    }
	
	public function get_data_master_kategori()
	{
		$table = "
        (
          select * from tbl_kategori order by kd_kategori ASC
        )temp";
		
        $primaryKey = 'id_kategori';
        $columns = array(
        array( 'db' => 'kd_kategori',     'dt' => 'kd_kategori' ),
        array( 'db' => 'nm_kategori',     'dt' => 'nm_kategori' ),
        array( 'db' => 'id_kategori',     'dt' => 'id_kategori' )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}	
	public function kategori_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_kategori_add");
		$this->load->view("v_main_footer");
    }
	public function kategori_ubah($id_kategori="")
	{
		if($id_kategori!=""){
			$where = array("id_kategori" => $id_kategori);
			$data['tbl_kategori'] = $this->m_general->view_by("tbl_kategori",$where);
			$this->load->view("v_main_header");
			$this->load->view('v_kategori_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('kategori');
		}
	}
	public function kategori_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_kategori", "id_kategori");
		$_POST['id_kategori'] = $id_terakhir;
		$kd_kategori = sprintf("%03d",(substr($id_terakhir,-2)));
		$_POST['kd_kategori'] = "K".$kd_kategori;
		$this->m_general->add("tbl_kategori", $_POST);
		redirect('kategori');
    }	
	public function kategori_aksi_ubah()
    {
		if(isset($_POST['id_kategori'])){			
			$where['id_kategori'] = $_POST['id_kategori'];
			$this->m_general->edit("tbl_kategori", $where, $_POST);
			redirect('kategori');
		}else{
			redirect('kategori/kategori_ubah/');
		}
    }	
	public function kategori_aksi_hapus($id_kategori=""){
		if($id_kategori!=""){
			$where['id_kategori'] = $id_kategori;
			$this->m_general->hapus("tbl_kategori", $where);
			redirect('kategori');
		}else{
			redirect('kategori');
		}
	}
}