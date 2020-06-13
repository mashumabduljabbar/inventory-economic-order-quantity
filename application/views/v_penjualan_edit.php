			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Ubah Penjualan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">					
				  <?php echo form_open_multipart("penjualan/penjualan_aksi_ubah"); ?>
				  <input type="hidden" name="id_penjualan" value="<?php echo $tbl_penjualan->id_penjualan;?>">
				  <input type="hidden" name="no_penjualan" value="<?php echo $tbl_penjualan->no_penjualan;?>">
					<div class="col-md-12">						
						<div class="table-responsive">
									<table class="table table-bordered table-condensed" width="50%">
										<tr>
											<th>Pelanggan</th>
											<td>
													<select id="kd_pelanggan" name="kd_pelanggan" class="form-control" required>
														<option value="<?php echo $tbl_pelanggan->kd_pelanggan;?>"><?php echo $tbl_pelanggan->nm_pelanggan;?></option>
													<select>
											</td>
										</tr>
										<tr>
											<th>Tanggal Penjualan</th>
											<td>
													<input type="date" class="form-control" name="tgl_penjualan" value="<?php echo $tbl_penjualan->tgl_penjualan;?>">
											</td>
										</tr>
									</table>
									<table class="table table-bordered" id="dataPenjualan" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Jual</th>
                                                <th>Jumlah Barang</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
									<table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										
										
										<?php 
										$jenis = 20;
										for($x=0; $x<$jenis; $x++){
											echo "
											<tr id='idnomorform$x' style='display:none;'>
												<td>
													<select id='kd_barang$x' name='kd_barang[]' class='form-control'>
														<option value=''>Pilih Barang</option>
													</select>
												</td>
												<td>
													<input type='number' class='form-control' id='jumlah$x' name='jumlah[]' placeholder='Jumlah Barang' value='0'>
												</td>
											</tr>";
										}
										?>
                                        </tbody>
                                    </table>
									<p style="font-style:italic;">NB : Maksimal <?php echo $jenis;?> Jenis Barang dalam satu kali Transaksi.</p>
									<div class="form-group">
										<input id="idhapusnilai" type="hidden" value="0">
										<label>
											<button id="tambahbarang"  type="button" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Barang</button>
										</label>
										<label>
											<button id="hapusbarang"  type="button" class="btn btn-warning"><i class="fa fa-trash"></i> Hapus Barang</button>
										</label>
									</div>
									<div class="form-group">
										<input type="submit" onclick="return confirm('Apakah Yakin Menyimpan?');" value="Submit" class="btn btn-success">
									</div>
					</div>
					<?php echo form_close(); ?>
				  
                            </div>
                        </div>
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
	$.getJSON("<?php echo base_url('pelanggan/jsonpelanggan');?>", function(data) {
				$.each(data, function(key, value) {
					$('#kd_pelanggan').append('<option value="' + value.kd_pelanggan + '">' + value.nm_pelanggan + '</option>');
				});
	});
	
	$.getJSON("<?php echo base_url('barang/jsonbarang');?>", function(data) {
				$.each(data, function(key, value) {
					$('select[name="kd_barang[]"]').append('<option value="' + value.kd_barang + '">' + value.nm_barang + '</option>');
				});
	});

$("#hapusbarang").hide();
$("#tambahbarang").click(function(){
	var nomor = $("#idhapusnilai").val();			
		if(nomor><?php echo $jenis-2;?>){
			$("#tambahbarang").hide();
		}
		
		if(nomor=>0){
			$("#hapusbarang").show();
		}
		$("#idnomorform"+nomor).show();
		nomor++;
		document.getElementById( 'idhapusnilai' ).value = nomor;
		nomor--;
    return false;
});

$("#hapusbarang").click(function() {
	var nomornya = $("#idhapusnilai").val();
		nomornya--;
		if(nomornya<1){
			$("#hapusbarang").hide();
		}
		$("#idnomorform"+nomornya).hide();
		$("#kd_barang"+nomornya).val("");
		$("#jumlah"+nomornya).val("0");
		if(nomornya<<?php echo $jenis;?>){
			$("#tambahbarang").show();
		}
		document.getElementById( 'idhapusnilai' ).value = nomornya;
	return false;
});

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
				},{
				   targets: [4],
				    data: 'id_penjualan_barang',
				   render: function ( data, type, row, meta ) { 

					var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus penjualan barang ini ?')\" href='<?php echo base_url();?>penjualan/penjualan_barang_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					
					return hapus;
				   }
				}],
			});
});	
</script>