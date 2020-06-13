<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general'); // Load model/m_general ke controller ini
	}
	
	public function cetak($cetak=""){
		if($cetak!==""){
			$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8', 
			'format' => 'A4-P',
			'margin_left' => 12,
			'margin_right' => 12,
			'margin_top' => 10,
			'margin_bottom' => 15,
			'margin_header' => 3,
			'margin_footer' => 5,
			]); //L For Landscape , P for Portrait
			$title = date("Y-m-d")." Laporan data ".$cetak;
			$mpdf->SetTitle($title);
			$data[''] = "";
			$halaman = $this->load->view("v_".$cetak."_cetak",$data,true);
			$mpdf->setFooter('{PAGENO}');
			$mpdf->WriteHTML($halaman);
			$mpdf->Output($title, 'I');
		}else{
			echo "";
		}
	}
	
}