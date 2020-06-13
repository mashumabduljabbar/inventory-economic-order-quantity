<style>
.laporan{
	width: 100%;
	border: 1px solid black;
	border-collapse: collapse;
}

th,td
{
    font-family: arial;
    font-size: 8pt;
	padding: 5px;
}
</style>
<table width="100%" style="border-bottom:1px solid #9966cc;">
<tr>
	<td style="text-align:left; padding:10px;">
		<img src="<?php echo base_url("assets/header.jpg"); ?>" width="45%">
	</td>
</tr>
</table>
<h4 style="text-align:center;">LAPORAN DATA BARANG</h4>
<table width="100%" border="1" class="laporan">
	<thead>
		<tr>
			<th>Kategori</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Harga Jual Khusus</th>
			<th>Harga Jual Umum</th>
			<th>Satuan</th>
			<th>Stok</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$query = $this->db->query("select a.*, IFNULL(a.stok_opname,0) as stok, b.nm_kategori from tbl_barang a left join tbl_kategori b on a.kd_kategori=b.kd_kategori order by a.nm_barang ASC");
		
		if($query->num_rows()>0){
			foreach($query->result() as $data){
		
		echo "
		<tr>
			<td>$data->nm_kategori</td>
			<td>$data->kd_barang</td>
			<td>$data->nm_barang</td>
			<td>$data->hrg_jual_khusus</td>
			<td>$data->hrg_jual_umum</td>
			<td>$data->satuan</td>
			<td>$data->stok</td>
		</tr>";
			 }
		}
		?>
	</tbody>
</table>