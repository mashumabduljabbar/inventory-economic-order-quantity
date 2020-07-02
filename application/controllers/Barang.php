<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Barang extends CI_Controller {
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
        $this->load->view("v_barang");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	public function jsonbarang()
    {
		$tbl_barang = $this->db->query("select * from tbl_barang order by nm_barang ASC")->result_array();
		echo json_encode($tbl_barang);
    }
	
	public function jsonbarangwhere()
    {
		$kd_barang = $_POST['kd_barang'];
		$tbl_barang = $this->db->query("SELECT (select count(*) from tbl_pembelian c
left join tbl_pembelian_barang d 
on c.no_pembelian=d.no_pembelian
where d.kd_barang='$kd_barang') as total_order,
(select sum(jumlah) from tbl_pembelian_barang d
where d.kd_barang='$kd_barang') as jumlah_keseluruhan,
(select sum(d.harga_beli*d.jumlah) from tbl_pembelian_barang d
where d.kd_barang='$kd_barang') as total_harga,
(select round(sum(d.harga_beli*d.jumlah)/sum(jumlah),2) from tbl_pembelian_barang d
where d.kd_barang='$kd_barang') as harga_mean,
(select a.nm_barang from tbl_barang a where a.kd_barang='$kd_barang') as nm_barang
")->result_array();
		echo json_encode($tbl_barang);
    }
	
	public function get_data_master_barang()
	{
		$table = "
        (
          select a.*, IFNULL(a.stok_opname,0) as stok, b.nm_kategori from tbl_barang a left join tbl_kategori b on a.kd_kategori=b.kd_kategori order by a.nm_barang ASC
        )temp";
		
        $primaryKey = 'id_barang';
        $columns = array(
        array( 'db' => 'nm_kategori',     'dt' => 'nm_kategori' ),
        array( 'db' => 'kd_barang',     'dt' => 'kd_barang' ),
        array( 'db' => 'nm_barang',     'dt' => 'nm_barang' ),
        array( 'db' => 'hrg_jual_khusus',     'dt' => 'hrg_jual_khusus' ),
        array( 'db' => 'hrg_jual_umum',     'dt' => 'hrg_jual_umum' ),
        array( 'db' => 'satuan',     'dt' => 'satuan' ),
        array( 'db' => 'stok',     'dt' => 'stok' ),
        array( 'db' => 'id_barang',     'dt' => 'id_barang' )
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
	
	public function get_data_master_eoq($kd_barang="")
	{
		$table = "
        (
          select (@cnt := @cnt + 1) AS id, 
			a.jumlah, a.id_pembelian_barang, round(a.jumlah/10,2) as mean
			from tbl_pembelian_barang a 
			CROSS JOIN (SELECT @cnt := 0) AS dummy
			where a.kd_barang='$kd_barang' order by a.id_pembelian_barang DESC
			LIMIT 10
        )temp";
		
        $primaryKey = 'id_pembelian_barang';
        $columns = array(
        array( 'db' => 'jumlah',     'dt' => 'jumlah' ),
        array( 'db' => 'mean',     'dt' => 'mean' ),
        array( 'db' => 'id',     'dt' => 'id' )
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
	
	public function barang_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_barang_add");
		$this->load->view("v_main_footer");
    }
	public function barang_ubah($id_barang="")
	{
		if($id_barang!=""){
			$where = array("id_barang" => $id_barang);
			$data['tbl_barang'] = $this->m_general->view_by("tbl_barang",$where);
			$where2 = array("kd_kategori" => $data['tbl_barang']->kd_kategori);
			$data['tbl_kategori'] = $this->m_general->view_by("tbl_kategori",$where2);
			$this->load->view("v_main_header");
			$this->load->view('v_barang_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('barang');
		}
	}
	public function barang_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_barang", "id_barang");
		$_POST['id_barang'] = $id_terakhir;
		$kd_barang = sprintf("%03d",(substr($id_terakhir,-2)));
		$_POST['kd_barang'] = "P".$kd_barang;
		$this->m_general->add("tbl_barang", $_POST);
		redirect('barang');
    }	
	public function barang_aksi_ubah()
    {
		if(isset($_POST['id_barang'])){			
			$where['id_barang'] = $_POST['id_barang'];
			$this->m_general->edit("tbl_barang", $where, $_POST);
			redirect('barang');
		}else{
			redirect('barang/barang_ubah/');
		}
    }	
	public function barang_aksi_hapus($id_barang=""){
		if($id_barang!=""){
			$where['id_barang'] = $id_barang;
			$this->m_general->hapus("tbl_barang", $where);
			redirect('barang');
		}else{
			redirect('barang');
		}
	}
}