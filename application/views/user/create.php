<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins p-2">
				<div class="ibox-title">
					<h3 class="font-weight-bold">Tambah Akun</h3>
				</div>
				<?php if ($this->session->flashdata('message')) : ?>
					<div class="row">
						<div class="col-sm-8">
							<?= $this->session->flashdata('message'); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="ibox-content" style="padding: 5em 3em;">
					<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Foto</label>
							<div class="col-sm-10">
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<span class="input-group-addon btn btn-default btn-file">
	                                	<span class="fileinput-new">Select file</span>
		                                <span class="fileinput-exists">Change</span>
		                                <input type="file" id="upload-foto" name="image" />
	                            	</span>
	                                <a href="#" id="remove-foto" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
									</div>
                            	</div>
                            	<small class='text-info'>Max upload 2 MB</small>
								<?= $this->session->flashdata('img_message'); ?>
								<?= form_error('image', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Pratinjau Foto</label>
							<div class="col-sm-6">
								<canvas class="canvas-box img-circle" id="canvas-foto-preview"></canvas>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control b-r-md name" placeholder="Nama">
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" name="email" class="form-control b-r-md email" placeholder="email@email.com">
								<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control username" placeholder="Username minimal 4 karakter">
								<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control password" placeholder="Password minimal 4 karakter">
								<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Role</label>
							<div class="col-sm-10">
								<select class="form-control" name="role">
									<option value="1">Admin</option>
									<option value="0">User</option>
								</select>
								<?= form_error('role', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/user" class="btn btn-white"><i class="fa fa-chevron-left"></i> Kembali</a>
							<input class="btn btn-success" type="submit" name="submit" value="Tambahkan">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
