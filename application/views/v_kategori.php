				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:170px;" href="<?php echo base_url("kategori/kategori_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Kategori</span>
							</a></label>
							<label><a class="btn-sm btn-success nav-link" style="width:160px;" href="<?php echo base_url("laporan/cetak/kategori");?>"><i class="fa fa-print"></i> <span>Cetak Laporan</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataKategori" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Kategori</th>
                                                <th>Nama Kategori</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Kategori</th>
                                                <th>Nama Kategori</th>
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
$('#dataKategori').DataTable({
			"ajax": "<?php echo base_url('kategori/get_data_master_kategori/');?>" ,
			"columns": [
				{ "data": "kd_kategori" },
				{ "data": "nm_kategori" }
			],
			columnDefs: [
				   {
				   targets: [2],
				    data: 'id_kategori',
				   render: function ( data, type, row, meta ) { 

					var edit = "<a href='<?php echo base_url();?>kategori/kategori_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus kategori ini ?')\" href='<?php echo base_url();?>kategori/kategori_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					
					return edit +  hapus;
				   }
				},],
			});
	});
</script>