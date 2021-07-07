<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins p-2">
				<div class="ibox-title">
					<h3 class="font-weight-bold">Edit Akun</h3>
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
		                                <input type="hidden" name="image_hidden" value="<?= $user->image; ?>" />
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
								<input type="text" class="form-control" name="name" value="<?= $user->name; ?>" placeholder="<?= $user->name; ?>" />
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="email" value="<?= $user->email; ?>" placeholder="<?= $user->email; ?>" />
								<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="username" value="<?= $user->username; ?>" placeholder="<?= $user->username; ?> | Username minimal 4 karakter" />
								<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="password" value="" placeholder="Password minimal 4 karakter"/>
								<small class="text-info">Kosongkan jika tidak ingin melalukan perubahan</small>
								<br><?= form_error('password', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Role</label>
							<div class="col-sm-10">
								<select class="form-control" name="role">
									<option value="1" <?= $user->role == 1 ? "selected" : ""; ?>>Admin</option>
									<option value="0" <?= $user->role == 0 ? "selected" : ""; ?>>User</option>
								</select>
								<?= form_error('role', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/user" class="btn btn-white">Kembali</a>
							<input type="hidden" name="user_id" value="<?= $user->id; ?>">
							<input class="btn btn-primary " type="submit" name="submit" value="Perbaharui">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
