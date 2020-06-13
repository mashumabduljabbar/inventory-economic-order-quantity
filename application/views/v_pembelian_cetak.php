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
<h4 style="text-align:center;">LAPORAN DATA PEMBELIAN</h4>
<table width="100%" border="1" class="laporan">
	<thead>
		<tr>
			<th>Kode Pembelian</th>
			<th>Supplier</th>
			<th>Tanggal Pembelian</th>
			<th>Petugas</th>
			<th>Jumlah Barang</th>
			<th>Jumlah Biaya</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$query = $this->db->query("select a.*, b.nm_supplier, c.nm_user, 
(select sum(d.jumlah) from tbl_pembelian_barang d where d.no_pembelian=a.no_pembelian) as jumlah,
(select sum(e.harga_beli*e.jumlah) from tbl_pembelian_barang e where e.no_pembelian=a.no_pembelian) as harga_beli
from tbl_pembelian a 
left join tbl_supplier b on a.kd_supplier=b.kd_supplier
left join tbl_user c on a.kd_user=c.kd_user
order by a.no_pembelian ASC");
		
		if($query->num_rows()>0){
			foreach($query->result() as $data){
		
		echo "
		<tr>
			<td>$data->no_pembelian</td>
			<td>$data->nm_supplier</td>
			<td>$data->tgl_pembelian</td>
			<td>$data->nm_user</td>
			<td>$data->jumlah</td>
			<td>$data->harga_beli</td>
		</tr>";
			 }
		}
		?>
	</tbody>
</table>