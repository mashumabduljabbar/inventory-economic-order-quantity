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
<h4 style="text-align:center;">LAPORAN DATA PENJUALAN</h4>
<table width="100%" border="1" class="laporan">
	<thead>
		<tr>
			<th>Kode Penjualan</th>
			<th>Pelanggan</th>
			<th>Tanggal Penjualan</th>
			<th>Petugas</th>
			<th>Jumlah Barang</th>
			<th>Jumlah Biaya</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$query = $this->db->query("select a.*, b.nm_pelanggan, c.nm_user, 
(select sum(d.jumlah) from tbl_penjualan_barang d where d.no_penjualan=a.no_penjualan) as jumlah,
(select sum(e.harga_jual*e.jumlah) from tbl_penjualan_barang e where e.no_penjualan=a.no_penjualan) as harga_jual
from tbl_penjualan a 
left join tbl_pelanggan b on a.kd_pelanggan=b.kd_pelanggan
left join tbl_user c on a.kd_user=c.kd_user
order by a.no_penjualan ASC");
		
		if($query->num_rows()>0){
			foreach($query->result() as $data){
		
		echo "
		<tr>
			<td>$data->no_penjualan</td>
			<td>$data->nm_pelanggan</td>
			<td>$data->tgl_penjualan</td>
			<td>$data->nm_user</td>
			<td>$data->jumlah</td>
			<td>$data->harga_jual</td>
		</tr>";
			 }
		}
		?>
	</tbody>
</table>