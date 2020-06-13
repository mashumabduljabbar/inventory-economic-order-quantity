				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pelanggan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:170px;" href="<?php echo base_url("pelanggan/pelanggan_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Pelanggan</span>
							</a></label>
							<label><a class="btn-sm btn-success nav-link" style="width:160px;" href="<?php echo base_url("laporan/cetak/pelanggan");?>"><i class="fa fa-print"></i> <span>Cetak Laporan</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataPelanggan" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Keterangan</th>
                                                <th>Jenis</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Keterangan</th>
                                                <th>Jenis</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
$('#dataPelanggan').DataTable({
			"ajax": "<?php echo base_url('pelanggan/get_data_master_pelanggan/');?>" ,
			"columns": [
				{ "data": "kd_pelanggan" },
				{ "data": "nm_pelanggan" },
				{ "data": "alamat_pelanggan" },
				{ "data": "no_telp_pelanggan" },
				{ "data": "keterangan_pelanggan" },
				{ "data": "jenis" }
			],
			columnDefs: [
				   {
				   targets: [6],
				    data: 'id_pelanggan',
				   render: function ( data, type, row, meta ) { 

					var edit = "<a href='<?php echo base_url();?>pelanggan/pelanggan_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus pelanggan ini ?')\" href='<?php echo base_url();?>pelanggan/pelanggan_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					
					return edit +  hapus;
				   }
				},],
			});
	});
</script>