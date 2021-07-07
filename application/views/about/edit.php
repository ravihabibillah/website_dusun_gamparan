<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins p-2">
				<div class="ibox-title">
					<h3 class="font-weight-bold">Ubah Tentang Kami</h3>
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
							<label class="col-sm-2 col-form-label">Tentang Kami</label>
							<div class="col-sm-10">
								<div class="ibox float-e-margins">
									<div class="ibox-content no-padding">
										<textarea name="about" class="summernote"><?= $about == null ? '' : $about->about; ?></textarea>
									</div>
								</div>
								<?= form_error('about', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/dashboard" class="btn btn-white"><i class="fa fa-chevron-left"></i> Kembali</a>
							<input class="btn btn-success" type="submit" name="submit" value="Simpan">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
