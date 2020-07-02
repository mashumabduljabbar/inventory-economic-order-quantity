				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Hitung EOQ</li>
                        </ol>
                        <div class="card mb-4">
                           <div class="card-body">
								<table class="">
									<tr>
										<td width="350px">
											Kode Barang
										</td>
										<td width="10px">
											:
										</td>
										<td>
										<select id='kd_barang' name='kd_barang' width="100%">
											<option value=''>Pilih Kode Barang</option>
										</select>
										</td>
									</tr>
									<tr>
										<td>
											Nama Barang
										</td>
										<td>: </td>
										<td><span id="nm_barang"></span>
										</td>
									</tr>
									<tr>
										<td>
											Total Order (berapa kali)
										</td>
										<td>: </td>
										<td><span id="total_order"></span>
										</td>
									</tr>
									<tr>
										<td>
											Jumlah Keseluruhan Pesanan (D)
										</td>
										<td>: </td>
										<td><span id="jumlah_keseluruhan"></span><input id="jumlah_keseluruhan_value" type="hidden">
										</td>
									</tr>
									<tr>
										<td>
											Total Harga Keseluruhan Pesanan
										</td>
										<td>: </td>
										<td><span id="total_harga"></span>
										<input id="total_harga_value" type="hidden">
										</td>
									</tr>
									<tr>
										<td>
											Harga Rata-Rata Per Unit
										</td>
										<td>: </td>
										<td><span id="harga_mean"></span>
										<input id="harga_mean_value" type="hidden">
										</td>
									</tr>
									<tr>
										<td>
											Biaya Penyimpanan (%)
										</td>
										<td>: </td>
										<td><input id="biaya_penyimpanan" type="number"> <span id="biaya_penyimpanan_span"></span>
										</td>
									</tr>
									<tr>
										<td>
											Biaya Pemesanan/Ongkos/Jasa/dll (Co)
										</td>
										<td>: </td>
										<td><input id="biaya_pemesanan" type="number"> 
										</td>
									</tr>
									<tr>
										<td>
											Hitung Biaya Penyimpanan (Ch)
										</td>
										<td>: </td>
										<td><span id="hitung_biaya_pemesanan"></span><input id="hitung_biaya_pemesanan_value" type="hidden">
										</td>
									</tr>
									<tr>
										<td>
											Optimal Jumlah Unit untuk di Pesan (EOQ)
										</td>
										<td>: </td>
										<td><span id="eoq"></span>
										</td>
									</tr>
								</table>
                           </div>
						   <div class="card-body">
							<input id="tableshow" type="button" value="Tampilkan" class="btn btn-success" />
                           </div>
                           <div class="card-body">
								<table id="master_eoq" class="table table-bordered table-striped">
								<thead>
									<tr> 
										<th>ORDER</th>
										<th>Qty</th>
										<th>Rata-rata Inventory (Qty/10)</th>
										<th>Total Holding Cost (Qty/10*Ch)</th>
										<th>Total Ordering Cost (D/Qty*Co)</th>
										<th>Total Cost ((Qty/10*Ch)+(D/Qty*Co))</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							  </table>
                           </div>
							<div class="card-body">	
							<input id="total_cost_1" type="hidden">
							<input id="total_cost_2" type="hidden">
							<input id="total_cost_3" type="hidden">
							<input id="total_cost_4" type="hidden">
							<input id="total_cost_5" type="hidden">
							<input id="total_cost_6" type="hidden">
							<input id="total_cost_7" type="hidden">
							<input id="total_cost_8" type="hidden">
							<input id="total_cost_9" type="hidden">
							<input id="total_cost_10" type="hidden">
							 <input id="sorting" type="button" value="Cost Min" class="btn btn-info" />
							</div>
							<div class="card-body">	
								<table class="table table-bordered table-striped">
									<tr>
										<th>TOTAL COST MIN. (pemesanan unit yang paling optimal pada keseluruhan Order)</th>
										<th>
											<span id="costmin"></span>
										</th>
									</tr>
								</table>
                           </div>
                        </div>
                    </div>
                </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>		
<script>  
$(document).ready(function() {	
	
	function numberWithCommas(x) { return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }
	
	$.getJSON("<?php echo base_url('barang/jsonbarang');?>", function(data) {
		$.each(data, function(key, value) {
			$('select[name="kd_barang"]').append('<option value="' + value.kd_barang + '">' + value.kd_barang +'</option>');
		});
	});
	$("#kd_barang").change(function(){
	  var kd_barang = $("#kd_barang").val();
			$.ajax({
				url: "<?php echo base_url('barang/jsonbarangwhere');?>",
				type     : 'POST',
				dataType : 'json',
				data: 'kd_barang='+kd_barang,
				cache: false,
				success: function(response){
					$.each(response, function(key, value) {
						
						var totalorder = numberWithCommas(value.total_order);
						var jumlahkeseluruhan = numberWithCommas(value.jumlah_keseluruhan);
						var totalharga = numberWithCommas(value.total_harga);
						var hargamean = numberWithCommas(value.harga_mean);
						var harga_mean = value.harga_mean;
						$("#nm_barang").html(value.nm_barang);
						$("#total_order").html(totalorder);
						$("#jumlah_keseluruhan").html(jumlahkeseluruhan);
						$("#total_harga").html(totalharga);
						$("#harga_mean").html(hargamean);
						$("#harga_mean_value").val(harga_mean);
						$("#total_harga_value").val(value.total_harga);
						$("#jumlah_keseluruhan_value").val(value.jumlah_keseluruhan);
					});
				}
			});
	});
	$("#biaya_penyimpanan").keyup(function(){
		var biaya_penyimpanan = $("#biaya_penyimpanan").val();
		var biaya_penyimpanan = biaya_penyimpanan/100;
		$("#biaya_penyimpanan_span").html(biaya_penyimpanan+' %');
	});
	$("#biaya_pemesanan").keyup(function(){
		var biaya_pemesanan = $("#biaya_pemesanan").val();
		var harga_mean_value = $("#harga_mean_value").val();
		var biaya_penyimpanan = $("#biaya_penyimpanan").val();
		var hitung_biaya_pemesanan = Math.round(harga_mean_value*biaya_penyimpanan/100);
		var hitung_biaya_pemesanan_value = numberWithCommas(hitung_biaya_pemesanan);
		
		$("#hitung_biaya_pemesanan").html(hitung_biaya_pemesanan_value);
		
		var jumlah_keseluruhan_value = $("#jumlah_keseluruhan_value").val();
		var eoq = Math.sqrt(2*jumlah_keseluruhan_value*biaya_pemesanan/hitung_biaya_pemesanan)
		$("#eoq").html(eoq);
		
		$("#hitung_biaya_pemesanan_value").val(hitung_biaya_pemesanan);
	});
});	
</script><script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
	function numberCommas(x) { return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); }
	
	 $("#tableshow").click(function(){
		var kd_barang = $("#kd_barang").val();
		var jumlah_keseluruhan_value = $("#jumlah_keseluruhan_value").val();
		var biaya_pemesanan = $("#biaya_pemesanan").val();
		var hitung_biaya_pemesanan_value = $("#hitung_biaya_pemesanan_value").val();
		$('#master_eoq').DataTable({
			"ajax": "<?php echo base_url('barang/get_data_master_eoq/');?>"+kd_barang ,
			"order": false,
			//"order": [[ 5, "asc" ]],
			"columns": [
				{ "data": "id" },
				{ "data": "jumlah" },
				{ "data": "mean" }
			],
			columnDefs: [
				   {
					targets: [0],
					data: '',
					 render: function ( data, type, row, meta ) { 
						return 'Order Ke '+data;
					 }
					},{
					targets: [3],
					data: 'mean',
					 render: function ( data, type, row, meta ) { 
						var total_holding_cost = Math.round(data*hitung_biaya_pemesanan_value);
						return numberCommas(total_holding_cost);
					 }
					},{
					targets: [4],
					data: 'jumlah',
					 render: function ( data, type, row, meta ) { 
						var total_ordering_cost = jumlah_keseluruhan_value/data*biaya_pemesanan;
						return numberCommas(total_ordering_cost);
					 }
					},{
					targets: [5],
					data: 'id',
					 render: function ( data, type, row, meta ) { 
						var total_holding_cost = Math.round(row.mean*hitung_biaya_pemesanan_value);
						
						var total_ordering_cost = jumlah_keseluruhan_value/row.jumlah*biaya_pemesanan;
						
						var total_cost = total_holding_cost+total_ordering_cost;
						
						$("#total_cost_"+data).val(total_cost);
						
						return numberCommas(total_cost);
						
					 }
					},
				],
			});
	});
	
	
	$("#sorting").click(function(){		
		var a = $("#total_cost_1").val();
		var b = $("#total_cost_2").val();
		var c = $("#total_cost_3").val();
		var d = $("#total_cost_4").val();
		var e = $("#total_cost_5").val();
		var f = $("#total_cost_6").val();
		var g = $("#total_cost_7").val();
		var h = $("#total_cost_8").val();
		var i = $("#total_cost_9").val();
		var j = $("#total_cost_10").val();
		var arrayan = [a, b, c, d, e, f, g, h, i, j];
		var sort_arrayan = arrayan.sort((a,b)=>a-b);
		var costmin = sort_arrayan[0];
		var costmin = numberCommas(costmin); 
		$("#costmin").html(costmin);
	});
	
});
</script>