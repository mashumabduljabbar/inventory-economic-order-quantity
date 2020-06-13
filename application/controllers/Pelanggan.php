<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Pelanggan extends CI_Controller {
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
        $this->load->view("v_pelanggan");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	public function jsonpelanggan()
    {
		$tbl_pelanggan = $this->db->query("select * from tbl_pelanggan order by nm_pelanggan ASC")->result_array();
		echo json_encode($tbl_pelanggan);
    }
	
	public function get_data_master_pelanggan()
	{
		$table = "
        (
          select * from tbl_pelanggan order by nm_pelanggan ASC
        )temp";
		
        $primaryKey = 'id_pelanggan';
        $columns = array(
        array( 'db' => 'kd_pelanggan',     'dt' => 'kd_pelanggan' ),
        array( 'db' => 'nm_pelanggan',     'dt' => 'nm_pelanggan' ),
        array( 'db' => 'alamat_pelanggan',     'dt' => 'alamat_pelanggan' ),
        array( 'db' => 'no_telp_pelanggan',     'dt' => 'no_telp_pelanggan' ),
        array( 'db' => 'keterangan_pelanggan',     'dt' => 'keterangan_pelanggan' ),
        array( 'db' => 'jenis',     'dt' => 'jenis' ),
        array( 'db' => 'id_pelanggan',     'dt' => 'id_pelanggan' )
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
	public function pelanggan_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_pelanggan_add");
		$this->load->view("v_main_footer");
    }
	public function pelanggan_ubah($id_pelanggan="")
	{
		if($id_pelanggan!=""){
			$where = array("id_pelanggan" => $id_pelanggan);
			$data['tbl_pelanggan'] = $this->m_general->view_by("tbl_pelanggan",$where);
			$this->load->view("v_main_header");
			$this->load->view('v_pelanggan_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('pelanggan');
		}
	}
	public function pelanggan_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_pelanggan", "id_pelanggan");
		$_POST['id_pelanggan'] = $id_terakhir;
		$kd_pelanggan = sprintf("%03d",(substr($id_terakhir,-2)));
		$_POST['kd_pelanggan'] = "P".$kd_pelanggan;
		$this->m_general->add("tbl_pelanggan", $_POST);
		redirect('pelanggan');
    }	
	public function pelanggan_aksi_ubah()
    {
		if(isset($_POST['id_pelanggan'])){			
			$where['id_pelanggan'] = $_POST['id_pelanggan'];
			$this->m_general->edit("tbl_pelanggan", $where, $_POST);
			redirect('pelanggan');
		}else{
			redirect('pelanggan/pelanggan_ubah/');
		}
    }	
	public function pelanggan_aksi_hapus($id_pelanggan=""){
		if($id_pelanggan!=""){
			$where['id_pelanggan'] = $id_pelanggan;
			$this->m_general->hapus("tbl_pelanggan", $where);
			redirect('pelanggan');
		}else{
			redirect('pelanggan');
		}
	}
}