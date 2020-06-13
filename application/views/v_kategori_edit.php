			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Kategori</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">					
				  <?php echo form_open_multipart("kategori/kategori_aksi_ubah"); ?>
					<input type="hidden"name="id_kategori" value="<?php echo $tbl_kategori->id_kategori;?>" required>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Kategori</label>
							<input type="text" class="form-control" name="nm_kategori" placeholder="Nama Kategori" value="<?php echo $tbl_kategori->nm_kategori;?>" required>
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