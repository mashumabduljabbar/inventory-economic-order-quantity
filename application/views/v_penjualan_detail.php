				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Detail Kode Penjualan <?php echo $tbl_penjualan->no_penjualan;?></li>
                        </ol>
                        <div class="card mb-4">
                           <div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataPenjualan" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual</th>
                                                <th>Jumlah Barang</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Total Harga Penjualan <?php echo number_format($tbl_penjualan_barang->total);?></li>
                        </ol>
                    </div>
                </main>
<?php $id_penjualan = $tbl_penjualan->id_penjualan;?>
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
			"ajax": "<?php echo base_url('penjualan/get_data_master_detail_penjualan/'.$id_penjualan);?>" ,
			"columns": [
				{ "data": "nm_barang" },
				{ "data": "harga_jual" },
				{ "data": "jumlah" },
				{ "data": "total" }
			],
			columnDefs: [
				   {
				   targets: [1,2,3],
				    data: 'harga_jual',
				   render: function ( data, type, row, meta ) { 
					return addCommas(data);
				   }
				}],
			});
	});
</script>