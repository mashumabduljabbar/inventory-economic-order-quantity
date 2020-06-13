<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Supplier extends CI_Controller {
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
        $this->load->view("v_supplier");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	public function jsonsupplier()
    {
		$tbl_supplier = $this->db->query("select * from tbl_supplier order by nm_supplier ASC")->result_array();
		echo json_encode($tbl_supplier);
    }
	
	public function get_data_master_supplier()
	{
		$table = "
        (
          select * from tbl_supplier order by kd_supplier ASC
        )temp";
		
        $primaryKey = 'id_supplier';
        $columns = array(
        array( 'db' => 'kd_supplier',     'dt' => 'kd_supplier' ),
        array( 'db' => 'nm_supplier',     'dt' => 'nm_supplier' ),
        array( 'db' => 'alamat_supplier',     'dt' => 'alamat_supplier' ),
        array( 'db' => 'no_telp_supplier',     'dt' => 'no_telp_supplier' ),
        array( 'db' => 'keterangan',     'dt' => 'keterangan' ),
        array( 'db' => 'id_supplier',     'dt' => 'id_supplier' )
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
	public function supplier_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_supplier_add");
		$this->load->view("v_main_footer");
    }
	public function supplier_ubah($id_supplier="")
	{
		if($id_supplier!=""){
			$where = array("id_supplier" => $id_supplier);
			$data['tbl_supplier'] = $this->m_general->view_by("tbl_supplier",$where);
			$this->load->view("v_main_header");
			$this->load->view('v_supplier_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('supplier');
		}
	}
	public function supplier_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_supplier", "id_supplier");
		$_POST['id_supplier'] = $id_terakhir;
		$kd_supplier = sprintf("%02d",(substr($id_terakhir,-2)));
		$_POST['kd_supplier'] = "S".$kd_supplier;
		$this->m_general->add("tbl_supplier", $_POST);
		redirect('supplier');
    }	
	public function supplier_aksi_ubah()
    {
		if(isset($_POST['id_supplier'])){			
			$where['id_supplier'] = $_POST['id_supplier'];
			$this->m_general->edit("tbl_supplier", $where, $_POST);
			redirect('supplier');
		}else{
			redirect('supplier/supplier_ubah/');
		}
    }	
	public function supplier_aksi_hapus($id_supplier=""){
		if($id_supplier!=""){
			$where['id_supplier'] = $id_supplier;
			$this->m_general->hapus("tbl_supplier", $where);
			redirect('supplier');
		}else{
			redirect('supplier');
		}
	}
}