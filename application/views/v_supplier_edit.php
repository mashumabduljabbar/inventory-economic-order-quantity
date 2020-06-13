			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Supplier</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">					
				  <?php echo form_open_multipart("supplier/supplier_aksi_ubah"); ?>
					<input type="hidden"name="id_supplier" value="<?php echo $tbl_supplier->id_supplier;?>" required>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Supplier</label>
							<input type="text" class="form-control" name="nm_supplier" placeholder="Nama Supplier" value="<?php echo $tbl_supplier->nm_supplier;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Alamat</label>
							<input type="text" class="form-control" name="alamat_supplier" placeholder="Alamat" value="<?php echo $tbl_supplier->alamat_supplier;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	No Telp</label>
							<input type="text" class="form-control" name="no_telp_supplier" placeholder="No Telp" value="<?php echo $tbl_supplier->no_telp_supplier;?>"required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Keterangan</label>
							<input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?php echo $tbl_supplier->keterangan;?>">
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