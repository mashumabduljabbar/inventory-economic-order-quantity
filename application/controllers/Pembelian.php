<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Pembelian extends CI_Controller {
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
        $this->load->view("v_pembelian");
        $this->load->view("v_main_footer");
    }
	
	public function pembelian_detail($id_pembelian="")
    {
		if($id_pembelian!=""){
			$where = array("id_pembelian" => $id_pembelian);
			$data['tbl_pembelian'] = $this->m_general->view_by("tbl_pembelian",$where);
			$data['tbl_pembelian_barang'] = $this->db->query("select sum(a.harga_beli*a.jumlah) as total
from tbl_pembelian_barang a
left join tbl_pembelian b on a.no_pembelian=b.no_pembelian
where b.id_pembelian='$id_pembelian'")->row();
			$this->load->view("v_main_header");
			$this->load->view('v_pembelian_detail', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('pembelian');
		}
    }
	
	////////////////////////////////////
	
	public function get_data_master_pembelian()
	{
		$table = "
        (
select a.*, b.nm_supplier, c.nm_user, 
(select sum(d.jumlah) from tbl_pembelian_barang d where d.no_pembelian=a.no_pembelian) as jumlah,
(select sum(e.harga_beli*e.jumlah) from tbl_pembelian_barang e where e.no_pembelian=a.no_pembelian) as harga_beli
from tbl_pembelian a 
left join tbl_supplier b on a.kd_supplier=b.kd_supplier
left join tbl_user c on a.kd_user=c.kd_user
order by a.no_pembelian ASC
        )temp";
		
        $primaryKey = 'id_pembelian';
        $columns = array(
        array( 'db' => 'no_pembelian',     'dt' => 'no_pembelian' ),
        array( 'db' => 'nm_supplier',     'dt' => 'nm_supplier' ),
        array( 'db' => 'tgl_pembelian',     'dt' => 'tgl_pembelian' ),
        array( 'db' => 'nm_user',     'dt' => 'nm_user' ),
        array( 'db' => 'jumlah',     'dt' => 'jumlah' ),
        array( 'db' => 'harga_beli',     'dt' => 'harga_beli' ),
        array( 'db' => 'id_pembelian',     'dt' => 'id_pembelian' )
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
	public function get_data_master_detail_pembelian($id_pembelian)
	{
		$table = "
        (
			select a.id_pembelian_barang, a.no_pembelian,
c.nm_barang, a.harga_beli, a.jumlah,
(select sum(d.harga_beli*d.jumlah) from tbl_pembelian_barang d 
where d.kd_barang=a.kd_barang and d.id_pembelian_barang=a.id_pembelian_barang) as total
from tbl_pembelian_barang a
left join tbl_pembelian b on a.no_pembelian=b.no_pembelian
left join tbl_barang c on a.kd_barang=c.kd_barang
where b.id_pembelian='$id_pembelian'

        )temp";
		
        $primaryKey = 'id_pembelian_barang';
        $columns = array(
        array( 'db' => 'nm_barang',     'dt' => 'nm_barang' ),
        array( 'db' => 'harga_beli',     'dt' => 'harga_beli' ),
        array( 'db' => 'jumlah',     'dt' => 'jumlah' ),
        array( 'db' => 'total',     'dt' => 'total' ),
        array( 'db' => 'id_pembelian_barang',     'dt' => 'id_pembelian_barang' )
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
	public function pembelian_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_pembelian_add");
		$this->load->view("v_main_footer");
    }
	public function pembelian_ubah($id_pembelian="")
	{
		if($id_pembelian!=""){
			$where = array("id_pembelian" => $id_pembelian);
			$data['tbl_pembelian'] = $this->m_general->view_by("tbl_pembelian",$where);
			$where2 = array("kd_supplier" => $data['tbl_pembelian']->kd_supplier);
			$data['tbl_supplier'] = $this->m_general->view_by("tbl_supplier",$where2);
			$this->load->view("v_main_header");
			$this->load->view('v_pembelian_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('pembelian');
		}
	}
	public function pembelian_aksi_tambah()
    {
		$kd_user = $this->session->userdata('kd_user');
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_pembelian", "id_pembelian");
		$no_pembelian = "B".sprintf("%03d",(substr($id_terakhir,-2)));
		$data_pembelian = array(
							"id_pembelian" => $id_terakhir,
							"no_pembelian" => $no_pembelian,
							"tgl_pembelian" => $_POST['tgl_pembelian'],
							"kd_supplier" => $_POST['kd_supplier'],
							"kd_user" => $kd_user
						);
		
		$this->m_general->add("tbl_pembelian", $data_pembelian);
		
		$jumlah_kd_barang = count($this->input->post('kd_barang'), COUNT_RECURSIVE);
		for($n=0; $n<$jumlah_kd_barang; $n++){
			if($_POST['jumlah'][$n]!="0"){
				$data_pembelian_barang = array(
					'no_pembelian'=>$no_pembelian,
					'kd_barang'=>$_POST['kd_barang'][$n],
					'harga_beli'=>$_POST['harga_beli'][$n],
					'jumlah'=>$_POST['jumlah'][$n],
				);
				$this->m_general->add("tbl_pembelian_barang", $data_pembelian_barang);
				$where[$n] = array("kd_barang"=>$_POST['kd_barang'][$n]);
				$tbl_barang = $this->m_general->view_by("tbl_barang",$where[$n]);
				$stok_opname = $tbl_barang->stok_opname+$_POST['jumlah'][$n];
				$data_barang = array("stok_opname"=>$stok_opname);
				$this->m_general->edit("tbl_barang",$where[$n],$data_barang);
			}
		}
		
		redirect('pembelian');
    }	
	public function pembelian_aksi_ubah()
    {
		if(isset($_POST['id_pembelian'])){			
			$where['id_pembelian'] = $_POST['id_pembelian'];
			$data_pembelian = array(
							"tgl_pembelian" => $_POST['tgl_pembelian'],
							"kd_supplier" => $_POST['kd_supplier']
						);
			$this->m_general->edit("tbl_pembelian", $where, $data_pembelian);
			
			$jumlah_kd_barang = count($this->input->post('kd_barang'), COUNT_RECURSIVE);
			for($n=0; $n<$jumlah_kd_barang; $n++){
				if($_POST['jumlah'][$n]!="0"){
					$data_pembelian_barang = array(
						'no_pembelian'=>$_POST['no_pembelian'],
						'kd_barang'=>$_POST['kd_barang'][$n],
						'harga_beli'=>$_POST['harga_beli'][$n],
						'jumlah'=>$_POST['jumlah'][$n],
					);
					$this->m_general->add("tbl_pembelian_barang", $data_pembelian_barang);
					$where[$n] = array("kd_barang"=>$_POST['kd_barang'][$n]);
					$tbl_barang = $this->m_general->view_by("tbl_barang",$where[$n]);
					$stok_opname = $tbl_barang->stok_opname+$_POST['jumlah'][$n];
					$data_barang = array("stok_opname"=>$stok_opname);
					$this->m_general->edit("tbl_barang",$where[$n],$data_barang);
				}
			}
			
			redirect('pembelian');
		}else{
			redirect('pembelian/pembelian_ubah/');
		}
    }	
	public function pembelian_aksi_hapus($id_pembelian=""){
		if($id_pembelian!=""){
			$where['id_pembelian'] = $id_pembelian;
			$tbl_pembelian = $this->m_general->view_by("tbl_pembelian", $where);
			
			$where2['no_pembelian'] = $tbl_pembelian->no_pembelian;
			$tbl_pembelian_barang = $this->m_general->view_where("tbl_pembelian_barang", $where2,"id_pembelian_barang ASC");
			foreach($tbl_pembelian_barang as $pembelian_barang){
				$where3['kd_barang'] = $pembelian_barang->kd_barang;
				$tbl_barang = $this->m_general->view_by("tbl_barang",$where3);
				$stok_opname = $tbl_barang->stok_opname-$pembelian_barang->jumlah;
				$data_barang = array("stok_opname"=>$stok_opname);
				$this->m_general->edit("tbl_barang",$where3,$data_barang);
			}
			
			$this->m_general->hapus("tbl_pembelian", $where);
			redirect('pembelian');
		}else{
			redirect('pembelian');
		}
	}	
	public function pembelian_barang_aksi_hapus($id_pembelian_barang=""){
		if($id_pembelian_barang!=""){
			$where['id_pembelian_barang'] = $id_pembelian_barang;
			$tbl_pembelian_barang = $this->m_general->view_by("tbl_pembelian_barang", $where);
			
			$where2['no_pembelian'] = $tbl_pembelian_barang->no_pembelian;
			$tbl_pembelian = $this->m_general->view_by("tbl_pembelian", $where2);
			
			$where3['kd_barang'] = $tbl_pembelian_barang->kd_barang;
			$tbl_barang = $this->m_general->view_by("tbl_barang",$where3);
			$stok_opname = $tbl_barang->stok_opname-$tbl_pembelian_barang->jumlah;
			$data_barang = array("stok_opname"=>$stok_opname);
			$this->m_general->edit("tbl_barang",$where3,$data_barang);
			
			$this->m_general->hapus("tbl_pembelian_barang", $where);
			redirect("pembelian/pembelian_ubah/$tbl_pembelian->id_pembelian");
		}else{
			redirect('pembelian');
		}
	}
}