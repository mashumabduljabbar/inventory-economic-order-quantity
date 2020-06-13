			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah User</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					<?php 
					if($_POST['username']==1){
							$username = $_POST['username'];
							$nm_user = $_POST['nm_user'];
							$password = $_POST['password'];
					?>
					<p style="color:red;"><i>Username sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$username = "";
							$nm_user = "";
							$password = "";
					}?>
					
				  <?php echo form_open_multipart("user/user_aksi_tambah"); ?>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama User</label>
							<input type="text" class="form-control" name="nm_user" placeholder="Nama User" value="<?php echo $nm_user;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password;?>" required>
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