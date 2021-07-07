<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Akun</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="row">
					<div class="col-sm-8 m-b-xs">
						<a href="<?= base_url(); ?>admin/user" class="btn btn-w-m btn-white">Kembali</a>
					</div>

					<div class="col-sm-4">
						<form method="get" action="<?= base_url(); ?>admin/user/search">
							<div class="input-group">
								<input type="text" name='q' placeholder="Search" class="input-sm form-control" value="<?= isset($_GET['q']) ? $_GET['q'] : ""; ?>">
								<span class="input-group-btn"><button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span>
							</div>
						</form>
					</div>
				</div>
				<?php if ($this->session->flashdata('message')) : ?>
					<div class="row">
						<div class="col-sm-8">
							<?= $this->session->flashdata('message'); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="table-responsive">
					<?php if (count($result) == 0) : ?>
						<div class="alert alert-info">
							<p>Akun yang dicari tidak ditemukan</p>
						</div>
					<?php else : ?>
						<p class='alert alert-info'>Pencarian : <strong><?= $search; ?></strong> </p>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Role</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($result as $user) : ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $user->name; ?></td>
										<td><?= $user->email; ?></td>
										<td><?= $user->username; ?></td>
										<td><?= $user->role == 1 ? "Admin" : "User"; ?></td>
										<td>
											<a href="<?= base_url() ?>admin/user/edit/<?= $user->id; ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit </a>
											<a href="<?= base_url() ?>admin/user/delete/<?= $user->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Ingin menghapus data ini?');"><i class="fa fa-trash"></i> Hapus </a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CONTENT END -->
