<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins p-2">
				<div class="ibox-title">
					<h3 class="font-weight-bold">Edit Konfigurasi Web</h3>
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
							<label class="col-sm-2 col-form-label">Judul</label>
							<div class="col-sm-10"><input type="text" name="title" class="form-control b-r-md title" value="<?= $configurations->title; ?>"></div>
							<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Judul Singkat Web</label>
							<div class="col-sm-10"><input type="text" name="short_title" class="form-control b-r-md title" value="<?= $configurations->short_title; ?>"></div>
							<?= form_error('short_title', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Logo Web</label>
							<div class="col-sm-10">
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<span class="input-group-addon btn btn-default btn-file">
	                                	<span class="fileinput-new">Select file</span>
		                                <span class="fileinput-exists">Change</span>
		                                <input type="file" id="upload-logo" name="image" />
		                                <input type="hidden" name="image_hidden" value="<?= $configurations->image; ?>" />
	                            	</span>
	                                <a href="#" id="remove-logo" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
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
							<label class="col-sm-2 col-form-label">Pratinjau Logo</label>
							<div class="col-sm-6">
								<canvas class="canvas-box" id="canvas-logo-preview"></canvas>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Alamat</label>
							<div class="col-sm-10">
								<div class="ibox float-e-margins">
									<div class="ibox-content no-padding">
										<textarea name="address" class="summernote"><?= $configurations->address; ?></textarea>
									</div>
								</div>
							</div>
							<?= form_error('address', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Telp.</label>
							<div class="col-sm-10"><input type="text" name="telp" class="form-control b-r-md title" value="<?= $configurations->telp; ?>"></div>
							<?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10"><input type="text" name="email" class="form-control b-r-md title" value="<?= $configurations->email; ?>"></div>
							<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/configurations" class="btn btn-white"><i class="fa fa-arrow-left"></i> Kembali</a>
							<input type="hidden" name="configurations_id" value="<?= $configurations->id; ?>">
							<input class="btn btn-primary " type="submit" name="submit" value="Perbaharui">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
