<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory System</title>
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
<table width="100%" style="border-bottom:1px solid black;">
<tr>
	<td style="text-align:center; padding:2px;">
		<img src="<?php echo base_url("assets/header.jpg"); ?>" width="30%">
	</td>
</tr>
</table>
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">INVENTORY SYSTEM</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#"></a><a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
<?php
  $geturl1 = $this->uri->segment(1);
  $geturl2 = $this->uri->segment(2);
  $beranda = "";
  $user = "";
  $supplier = "";
  $pelanggan = "";
  $kategori = "";
  $barang = "";
  $pembelian = "";
  $penjualan = "";
  $hitungeoq = "";
  
  if($geturl1=="admin" && ($geturl2=="" or strpos($geturl2, "index")!== FALSE)){
	  $beranda = "active";
  }
  if(strpos($geturl1, "user")!== FALSE){
	  $user = "active";
  }
  if(strpos($geturl1, "supplier")!== FALSE){
	  $supplier = "active";
  }
  if(strpos($geturl1, "pelanggan")!== FALSE){
	  $pelanggan = "active";
  }
  if(strpos($geturl1, "kategori")!== FALSE){
	  $kategori = "active";
  }
  if(strpos($geturl1, "barang")!== FALSE){
	  $barang = "active";
  }
  if(strpos($geturl1, "pembelian")!== FALSE){
	  $pembelian = "active";
  }
  if(strpos($geturl1, "penjualan")!== FALSE){
	  $penjualan = "active";
  }
  if(strpos($geturl1, "hitungeoq")!== FALSE){
	  $hitungeoq = "active";
  }
?>
<div id="layoutSidenav">
	 <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link <?php echo $beranda;?>" href="<?php echo base_url(); ?>admin"
                                ><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Beranda</a>
							<a class="nav-link <?php echo $user;?>" href="<?php echo base_url(); ?>user"
                                ><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                User</a>
							<a class="nav-link <?php echo $supplier;?>" href="<?php echo base_url(); ?>supplier"
                                ><div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Supplier</a>
							<a class="nav-link <?php echo $pelanggan;?>" href="<?php echo base_url(); ?>pelanggan"
                                ><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pelanggan</a>
							<a class="nav-link <?php echo $kategori;?>" href="<?php echo base_url(); ?>kategori"
                                ><div class="sb-nav-link-icon"><i class="fas fa-cogs "></i></div>
                                Kategori</a>
							<a class="nav-link <?php echo $barang;?>" href="<?php echo base_url(); ?>barang"
                                ><div class="sb-nav-link-icon"><i class="fas fa-briefcase "></i></div>
                                Barang</a>
							<a class="nav-link <?php echo $pembelian;?>" href="<?php echo base_url(); ?>pembelian"
                                ><div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                                Pembelian</a>
							<a class="nav-link <?php echo $penjualan;?>" href="<?php echo base_url(); ?>penjualan"
                                ><div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Penjualan</a>
							<a class="nav-link <?php echo $hitungeoq;?>" href="<?php echo base_url(); ?>hitungeoq"
                                ><div class="sb-nav-link-icon"><i class="fas fa-dot-circle"></i></div>
                                Hitung EOQ</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login sebagai :</div>
                        <?php 
						$id_user = $this->session->userdata('id_user');
						$tbl_user = $this->db->query("select * from tbl_user where id_user='$id_user'")->row();
						echo $tbl_user->nm_user;?>
                    </div>
                </nav>
      </div>
	  <div id="layoutSidenav_content">