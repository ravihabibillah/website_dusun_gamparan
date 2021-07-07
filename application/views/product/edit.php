<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins p-2">
				<div class="ibox-title">
					<h3 class="font-weight-bold">Edit Data Produk Unggulan</h3>
				</div>
				<!-- Flash Data Message disini -->
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
							<div class="col-sm-10"><input type="text" class="form-control b-r-md title" name="title" value="<?= $product->title; ?>"></div>
							<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Keterangan</label>
							<div class="col-sm-10">
								<div class="ibox float-e-margins">
									<div class="ibox-content no-padding">
										<textarea name="description" class="summernote"><?= $product->description; ?></textarea>
									</div>
								</div>
								<?= form_error('description', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Gambar</label>
							<div class="col-sm-10">
								<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<span class="input-group-addon btn btn-default btn-file">
	                                	<span class="fileinput-new">Pilih gambar</span>
		                                <span class="fileinput-exists">Ubah</span>
		                                <input type="file" id="upload-logo" name="image" />
		                                <input type="hidden" name="image_hidden" value="<?= $product->image; ?>" />
	                            	</span>
	                                <a href="#" id="remove-logo" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
									</div>
	                        	</div>
								<small class='text-info'>Max upload 10 MB</small>
								<?= $this->session->flashdata('img_message'); ?>
								<?= form_error('image', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Pratinjau Gambar</label>
							<div class="col-sm-6">
								<canvas class="canvas-box" id="canvas-logo-preview"></canvas>
							</div>
						</div>

						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/product/index" class="btn btn-white">Kembali</a>
							<input class="btn btn-primary " type="submit" name="submit" value="Perbaharui">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
