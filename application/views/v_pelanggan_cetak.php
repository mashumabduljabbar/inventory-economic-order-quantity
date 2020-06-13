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
<h4 style="text-align:center;">LAPORAN DATA PELANGGAN</h4>
<table width="100%" border="1" class="laporan">
	<thead>
		<tr>
			<th>Kode Pelanggan</th>
			<th>Nama Pelanggan</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>Keterangan</th>
			<th>Jenis</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$query = $this->db->query("select * from tbl_pelanggan order by nm_pelanggan ASC");
		
		if($query->num_rows()>0){
			foreach($query->result() as $data){
		
		echo "
		<tr>
			<td>$data->kd_pelanggan</td>
			<td>$data->nm_pelanggan</td>
			<td>$data->alamat_pelanggan</td>
			<td>$data->no_telp_pelanggan</td>
			<td>$data->keterangan_pelanggan</td>
			<td>$data->jenis</td>
		</tr>";
			 }
		}
		?>
	</tbody>
</table>