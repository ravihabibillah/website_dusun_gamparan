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
					<form method="post" class="form-horizontal" action="">
						<div class="form-group">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control name" placeholder="Nama" value="<?= $contact->name; ?>">
								<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">No. HP / WhatsApp</label>
							<div class="col-sm-10">
								<input type="text" name="telp" class="form-control telp" placeholder="085700752966" value="<?= $contact->telp; ?>">
								<?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" name="email" class="form-control b-r-md email" placeholder="email@email.com" value="<?= $contact->email; ?>">
								<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group m-r-xl m-t-sm" style="float: right">
							<a href="<?= base_url(); ?>admin/contact" class="btn btn-white">Kembali</a>
							<input class="btn btn-primary " type="submit" name="submit" value="Perbaharui">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
