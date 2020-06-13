			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">					
				  <?php echo form_open_multipart("barang/barang_aksi_ubah"); ?>
					<input type="hidden"name="id_barang" value="<?php echo $tbl_barang->id_barang;?>" required>
					<div class="col-md-6">						
						<div class="form-group">
							<label>Kategori</label>
							<select id="kd_kategori" name="kd_kategori" class="form-control" required>
								<option value="<?php echo $tbl_kategori->kd_kategori;?>"><?php echo $tbl_kategori->nm_kategori;?></option>						  
							<select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Barang</label>
							<input type="text" class="form-control" name="nm_barang" placeholder="Nama Barang" value="<?php echo $tbl_barang->nm_barang;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Harga Jual Khusus</label>
							<input type="number" class="form-control" name="hrg_jual_khusus" placeholder="Harga Jual Khusus" value="<?php echo $tbl_barang->hrg_jual_khusus;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Harga Jual Umum</label>
							<input type="number" class="form-control" name="hrg_jual_umum" placeholder="Harga Jual Umum" value="<?php echo $tbl_barang->hrg_jual_umum;?>"required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Satuan</label>
							<input type="text" class="form-control" name="satuan" placeholder="Satuan" value="<?php echo $tbl_barang->satuan;?>">
						</div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
						<input type="submit" onclick="return confirm('Apakah Yakin Menyimpan?');" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php echo form_close(); ?>
				  
                            </div>
                        </div>
                    </div>
                </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>				
<script>  
$(document).ready(function() {	
	$.getJSON("<?php echo base_url('kategori/jsonkategori');?>", function(data) {
				$.each(data, function(key, value) {
					$('#kd_kategori').append('<option value="' + value.kd_kategori + '">' + value.nm_kategori + '</option>');
				});
	});
});	
</script>