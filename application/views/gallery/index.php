<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Tambah Foto ke Galeri</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content" style="padding: 5em 3em;">
				<?php if ($this->session->flashdata('message')) : ?>
					<div class="row">
						<div class="col-sm-8">
							<?= $this->session->flashdata('message'); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-sm-12">
						<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label class="col-sm-2 col-form-label">Judul</label>
								<div class="col-sm-10"><input type="text" class="form-control b-r-md title" name="title"></div>
								<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label class="col-sm-2 col-form-label">Foto</label>
								<div class="col-sm-10">
									<div class="fileinput fileinput-new input-group" data-provides="fileinput">
										<span class="input-group-addon btn btn-default btn-file">
		                                	<span class="fileinput-new">Pilih foto</span>
			                                <span class="fileinput-exists">Ubah</span>
			                                <input type="file" id="upload-logo" name="image" />
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
								<label class="col-sm-2 col-form-label">Pratinjau Foto</label>
								<div class="col-sm-6">
									<canvas class="canvas-box" id="canvas-logo-preview"></canvas>
								</div>
							</div>

							<div class="form-group m-r-xl m-t-sm" style="float: right">
								<input class="btn btn-primary " type="submit" name="submit" value="Tambahkan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Galeri</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-sm-12">
						<div class="text-center">
							<?php if (count($galleries) == 0 ) : ?>
								<h2>Belum ada foto yang tersedia</h2>
							<?php else : ?>
								<?php foreach ($galleries as $gallery) : ?>
							        <div class="file-box" style="height: 256px;">
							        	<div class="file">
							        		<span class="corner"></span>
								        	<a href="<?= base_url(); ?>storage/galleries/images/<?= $gallery->image; ?>" data-gallery="">
								        		<div class="image">
							                        <img alt="<?= $gallery->title; ?>" class="img-responsive" src="<?= base_url(); ?>storage/galleries/images/<?= $gallery->image; ?>" style="height: 100%;width:100%;object-fit: cover;">
							                    </div>
								        	</a>
								        	<div class="file-name">
						                    	<p><?= $gallery->title; ?></p>
						                        <small>
						                        	<a href="<?= base_url(); ?>storage/galleries/images/<?= $gallery->image; ?>" class="btn btn-xs btn-info" download><i class="fa fa-download"></i> Download </a>
						                            <a href="<?= base_url()?>admin/gallery/delete/<?= $gallery->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Ingin menghapus foto ini?');"><i class="fa fa-trash"></i> Hapus </a>
						                        </small>
						                    </div>
								        </div>
							        </div>
								<?php endforeach ?>
								<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
					            <div id="blueimp-gallery" class="blueimp-gallery">
					                <div class="slides"></div>
					                <h3 class="title"></h3>
					                <a class="prev">‹</a>
					                <a class="next">›</a>
					                <a class="close">×</a>
					                <a class="play-pause"></a>
					                <ol class="indicator"></ol>
					            </div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!-- CONTENT END -->
