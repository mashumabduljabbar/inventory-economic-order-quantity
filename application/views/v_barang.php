				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:150px;" href="<?php echo base_url("barang/barang_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Barang</span>
							</a></label>
							<label><a class="btn-sm btn-success nav-link" style="width:160px;" href="<?php echo base_url("laporan/cetak/barang");?>"><i class="fa fa-print"></i> <span>Cetak Laporan</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataBarang" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual Khusus</th>
                                                <th>Harga Jual Umum</th>
                                                <th>Satuan</th>
                                                <th>Stok</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual Khusus</th>
                                                <th>Harga Jual Umum</th>
                                                <th>Satuan</th>
                                                <th>Stok</th>
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
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$('#dataBarang').DataTable({
			"ajax": "<?php echo base_url('barang/get_data_master_barang/');?>" ,
			"columns": [
				{ "data": "nm_kategori" },
				{ "data": "kd_barang" },
				{ "data": "nm_barang" },
				{ "data": "hrg_jual_khusus" },
				{ "data": "hrg_jual_umum" },
				{ "data": "satuan" },
				{ "data": "stok" }
			],
			columnDefs: [
				   {
				   targets: [3,4],
				    data: 'harga_beli',
				   render: function ( data, type, row, meta ) { 
					return addCommas(data);
				   }
				},{
				   targets: [7],
				    data: 'id_barang',
				   render: function ( data, type, row, meta ) { 

					var edit = "<a href='<?php echo base_url();?>barang/barang_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus barang ini ?')\" href='<?php echo base_url();?>barang/barang_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					
					return edit +  hapus;
				   }
				},],
			});
	});
</script>