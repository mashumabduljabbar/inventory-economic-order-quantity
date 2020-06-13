<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Penjualan extends CI_Controller {
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
        $this->load->view("v_penjualan");
        $this->load->view("v_main_footer");
    }
	
	public function penjualan_detail($id_penjualan="")
    {
		if($id_penjualan!=""){
			$where = array("id_penjualan" => $id_penjualan);
			$data['tbl_penjualan'] = $this->m_general->view_by("tbl_penjualan",$where);
			$data['tbl_penjualan_barang'] = $this->db->query("select sum(a.harga_jual*a.jumlah) as total
from tbl_penjualan_barang a
left join tbl_penjualan b on a.no_penjualan=b.no_penjualan
where b.id_penjualan='$id_penjualan'")->row();
			$this->load->view("v_main_header");
			$this->load->view('v_penjualan_detail', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('penjualan');
		}
    }
	
	////////////////////////////////////
	
	public function get_data_master_penjualan()
	{
		$table = "
        (
select a.*, b.nm_pelanggan, c.nm_user, 
(select sum(d.jumlah) from tbl_penjualan_barang d where d.no_penjualan=a.no_penjualan) as jumlah,
(select sum(e.harga_jual*e.jumlah) from tbl_penjualan_barang e where e.no_penjualan=a.no_penjualan) as harga_jual
from tbl_penjualan a 
left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
left join tbl_user c on a.kd_user=c.kd_user
order by a.no_penjualan ASC
        )temp";
		
        $primaryKey = 'id_penjualan';
        $columns = array(
        array( 'db' => 'no_penjualan',     'dt' => 'no_penjualan' ),
        array( 'db' => 'nm_pelanggan',     'dt' => 'nm_pelanggan' ),
        array( 'db' => 'tgl_penjualan',     'dt' => 'tgl_penjualan' ),
        array( 'db' => 'nm_user',     'dt' => 'nm_user' ),
        array( 'db' => 'jumlah',     'dt' => 'jumlah' ),
        array( 'db' => 'harga_jual',     'dt' => 'harga_jual' ),
        array( 'db' => 'id_penjualan',     'dt' => 'id_penjualan' )
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
	public function get_data_master_detail_penjualan($id_penjualan)
	{
		$table = "
        (
			select a.id_penjualan_barang, a.no_penjualan,
c.nm_barang, a.harga_jual, a.jumlah,
(select sum(d.harga_jual*d.jumlah) from tbl_penjualan_barang d 
where d.kd_barang=a.kd_barang and d.id_penjualan_barang=a.id_penjualan_barang) as total
from tbl_penjualan_barang a
left join tbl_penjualan b on a.no_penjualan=b.no_penjualan
left join tbl_barang c on a.kd_barang=c.kd_barang
where b.id_penjualan='$id_penjualan'

        )temp";
		
        $primaryKey = 'id_penjualan_barang';
        $columns = array(
        array( 'db' => 'nm_barang',     'dt' => 'nm_barang' ),
        array( 'db' => 'harga_jual',     'dt' => 'harga_jual' ),
        array( 'db' => 'jumlah',     'dt' => 'jumlah' ),
        array( 'db' => 'total',     'dt' => 'total' ),
        array( 'db' => 'id_penjualan_barang',     'dt' => 'id_penjualan_barang' )
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
	public function penjualan_tambah()
    {
		$this->load->view("v_main_header");
        $this->load->view("v_penjualan_add");
		$this->load->view("v_main_footer");
    }
	public function penjualan_ubah($id_penjualan="")
	{
		if($id_penjualan!=""){
			$where = array("id_penjualan" => $id_penjualan);
			$data['tbl_penjualan'] = $this->m_general->view_by("tbl_penjualan",$where);
			$where2 = array("kd_pelanggan" => $data['tbl_penjualan']->kd_pelanggan);
			$data['tbl_pelanggan'] = $this->m_general->view_by("tbl_pelanggan",$where2);
			$this->load->view("v_main_header");
			$this->load->view('v_penjualan_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('penjualan');
		}
	}
	public function penjualan_aksi_tambah()
    {
		$kd_user = $this->session->userdata('kd_user');
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_penjualan", "id_penjualan");
		$no_penjualan = "J".sprintf("%03d",(substr($id_terakhir,-2)));
		$data_penjualan = array(
							"id_penjualan" => $id_terakhir,
							"no_penjualan" => $no_penjualan,
							"tgl_penjualan" => $_POST['tgl_penjualan'],
							"kd_pelanggan" => $_POST['kd_pelanggan'],
							"kd_user" => $kd_user
						);
		
		$this->m_general->add("tbl_penjualan", $data_penjualan);
		
		$jumlah_kd_barang = count($this->input->post('kd_barang'), COUNT_RECURSIVE);
		for($n=0; $n<$jumlah_kd_barang; $n++){
			if($_POST['jumlah'][$n]!="0"){
				
				$where_pelanggan = array("kd_pelanggan"=>$_POST['kd_pelanggan']);
				$tbl_pelanggan = $this->m_general->view_by("tbl_pelanggan",$where_pelanggan);
				
				$where[$n] = array("kd_barang"=>$_POST['kd_barang'][$n]);
				$tbl_barang = $this->m_general->view_by("tbl_barang",$where[$n]);
				
				if($tbl_pelanggan->jenis=="Umum"){
					$harga_jual[$n] = $tbl_barang->hrg_jual_umum;
				}elseif($tbl_pelanggan->jenis=="Khusus"){
					$harga_jual[$n] = $tbl_barang->hrg_jual_khusus;
				}
				
				$data_penjualan_barang = array(
					'no_penjualan'=>$no_penjualan,
					'kd_barang'=>$_POST['kd_barang'][$n],
					'harga_jual'=>$harga_jual[$n],
					'jumlah'=>$_POST['jumlah'][$n],
				);
				$this->m_general->add("tbl_penjualan_barang", $data_penjualan_barang);
				
				$stok_opname = $tbl_barang->stok_opname-$_POST['jumlah'][$n];
				$data_barang = array("stok_opname"=>$stok_opname);
				$this->m_general->edit("tbl_barang",$where[$n],$data_barang);
			}
		}
		
		redirect('penjualan');
    }	
	public function penjualan_aksi_ubah()
    {
		if(isset($_POST['id_penjualan'])){			
			$where['id_penjualan'] = $_POST['id_penjualan'];
			$data_penjualan = array(
							"tgl_penjualan" => $_POST['tgl_penjualan'],
							"kd_pelanggan" => $_POST['kd_pelanggan']
						);
			$this->m_general->edit("tbl_penjualan", $where, $data_penjualan);
			
			$jumlah_kd_barang = count($this->input->post('kd_barang'), COUNT_RECURSIVE);
			for($n=0; $n<$jumlah_kd_barang; $n++){
				if($_POST['jumlah'][$n]!="0"){
					
					$where_pelanggan = array("kd_pelanggan"=>$_POST['kd_pelanggan']);
				$tbl_pelanggan = $this->m_general->view_by("tbl_pelanggan",$where_pelanggan);
				
					$where[$n] = array("kd_barang"=>$_POST['kd_barang'][$n]);
					$tbl_barang = $this->m_general->view_by("tbl_barang",$where[$n]);
				
					if($tbl_pelanggan->jenis=="Umum"){
						$harga_jual[$n] = $tbl_barang->hrg_jual_umum;
					}elseif($tbl_pelanggan->jenis=="Khusus"){
						$harga_jual[$n] = $tbl_barang->hrg_jual_khusus;
					}
					
					$data_penjualan_barang = array(
						'no_penjualan'=>$_POST['no_penjualan'],
						'kd_barang'=>$_POST['kd_barang'][$n],
						'harga_jual'=>$harga_jual[$n],
						'jumlah'=>$_POST['jumlah'][$n],
					);
					$this->m_general->add("tbl_penjualan_barang", $data_penjualan_barang);
					
					$stok_opname = $tbl_barang->stok_opname-$_POST['jumlah'][$n];
					$data_barang = array("stok_opname"=>$stok_opname);
					$this->m_general->edit("tbl_barang",$where[$n],$data_barang);
				}
			}
			
			redirect('penjualan');
		}else{
			redirect('penjualan/penjualan_ubah/');
		}
    }	
	public function penjualan_aksi_hapus($id_penjualan=""){
		if($id_penjualan!=""){
			$where['id_penjualan'] = $id_penjualan;
			$tbl_penjualan = $this->m_general->view_by("tbl_penjualan", $where);
			
			$where2['no_penjualan'] = $tbl_penjualan->no_penjualan;
			$tbl_penjualan_barang = $this->m_general->view_where("tbl_penjualan_barang", $where2,"id_penjualan_barang ASC");
			foreach($tbl_penjualan_barang as $penjualan_barang){
				$where3['kd_barang'] = $penjualan_barang->kd_barang;
				$tbl_barang = $this->m_general->view_by("tbl_barang",$where3);
				$stok_opname = $tbl_barang->stok_opname+$penjualan_barang->jumlah;
				$data_barang = array("stok_opname"=>$stok_opname);
				$this->m_general->edit("tbl_barang",$where3,$data_barang);
			}
			
			$this->m_general->hapus("tbl_penjualan", $where);
			redirect('penjualan');
		}else{
			redirect('penjualan');
		}
	}	
	public function penjualan_barang_aksi_hapus($id_penjualan_barang=""){
		if($id_penjualan_barang!=""){
			$where['id_penjualan_barang'] = $id_penjualan_barang;
			$tbl_penjualan_barang = $this->m_general->view_by("tbl_penjualan_barang", $where);
			
			$where2['no_penjualan'] = $tbl_penjualan_barang->no_penjualan;
			$tbl_penjualan = $this->m_general->view_by("tbl_penjualan", $where2);
			
			$where3['kd_barang'] = $tbl_penjualan_barang->kd_barang;
			$tbl_barang = $this->m_general->view_by("tbl_barang",$where3);
			$stok_opname = $tbl_barang->stok_opname+$tbl_penjualan_barang->jumlah;
			$data_barang = array("stok_opname"=>$stok_opname);
			$this->m_general->edit("tbl_barang",$where3,$data_barang);
			
			$this->m_general->hapus("tbl_penjualan_barang", $where);
			redirect("penjualan/penjualan_ubah/$tbl_penjualan->id_penjualan");
		}else{
			redirect('penjualan');
		}
	}
}