				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Penjualan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:170px;" href="<?php echo base_url("penjualan/penjualan_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Penjualan</span>
							</a></label>
							<label><a class="btn-sm btn-success nav-link" style="width:160px;" href="<?php echo base_url("laporan/cetak/penjualan");?>"><i class="fa fa-print"></i> <span>Cetak Laporan</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataPenjualan" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Penjualan</th>
                                                <th>Pelanggan</th>
                                                <th>Tanggal Penjualan</th>
                                                <th>Petugas</th>
                                                <th>Jumlah Barang</th>
                                                <th>Jumlah Biaya</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Penjualan</th>
                                                <th>Pelanggan</th>
                                                <th>Tanggal Penjualan</th>
                                                <th>Petugas</th>
                                                <th>Jumlah Barang</th>
                                                <th>Jumlah Biaya</th>
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

$('#dataPenjualan').DataTable({
			"ajax": "<?php echo base_url('penjualan/get_data_master_penjualan/');?>" ,
			"columns": [
				{ "data": "no_penjualan" },
				{ "data": "nm_pelanggan" },
				{ "data": "tgl_penjualan" },
				{ "data": "nm_user" },
				{ "data": "jumlah" },
				{ "data": "harga_jual" }
			],
			columnDefs: [
				   {
				   targets: [5],
				    data: 'harga_jual',
				   render: function ( data, type, row, meta ) { 
					return addCommas(data);
				   }
				},{
				   targets: [6],
				    data: 'id_penjualan',
				   render: function ( data, type, row, meta ) { 

					var detail = "<a href='<?php echo base_url();?>penjualan/penjualan_detail/"+data+"' title='Detail'> <button type='button' class='btn btn-sm btn-info'><i class='fa fa-list'></i> </button></a>";
					
					var edit = "<a href='<?php echo base_url();?>penjualan/penjualan_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus penjualan ini ?')\" href='<?php echo base_url();?>penjualan/penjualan_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					
					return detail + edit + hapus;
				   }
				},],
			});
	});
</script>