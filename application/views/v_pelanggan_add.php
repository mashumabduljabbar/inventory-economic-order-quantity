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
				  <?php echo form_open_multipart("pelanggan/pelanggan_aksi_tambah"); ?>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Pelanggan</label>
							<input type="text" class="form-control" name="nm_pelanggan" placeholder="Nama Pelanggan" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Alamat</label>
							<input type="text" class="form-control" name="alamat_pelanggan" placeholder="Alamat" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	No Telp</label>
							<input type="text" class="form-control" name="no_telp_pelanggan" placeholder="No Telp" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Keterangan</label>
							<input type="text" class="form-control" name="keterangan_pelanggan" placeholder="Keterangan">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Jenis</label>
							<select name='jenis' class='form-control'>
								<option value=''>Pilih Jenis</option>
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