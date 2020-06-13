			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Pelanggan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">					
				  <?php echo form_open_multipart("pelanggan/pelanggan_aksi_ubah"); ?>
					<input type="hidden"name="id_pelanggan" value="<?php echo $tbl_pelanggan->id_pelanggan;?>" required>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Pelanggan</label>
							<input type="text" class="form-control" name="nm_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $tbl_pelanggan->nm_pelanggan;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Alamat</label>
							<input type="text" class="form-control" name="alamat_pelanggan" placeholder="Alamat" value="<?php echo $tbl_pelanggan->alamat_pelanggan;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	No Telp</label>
							<input type="text" class="form-control" name="no_telp_pelanggan" placeholder="No Telp" value="<?php echo $tbl_pelanggan->no_telp_pelanggan;?>"required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Keterangan</label>
							<input type="text" class="form-control" name="keterangan_pelanggan" placeholder="Keterangan" value="<?php echo $tbl_pelanggan->keterangan_pelanggan;?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Jenis</label>
							<select name='jenis' class='form-control'>
								<option value='<?php echo $tbl_pelanggan->jenis;?>'><?php echo $tbl_pelanggan->jenis;?></option>
								<option value='Umum'>Umum</option>
								<option value='Khusus'>Khusus</option>
							</select>
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