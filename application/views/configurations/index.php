<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Konfigurasi Web</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<?php if ($this->session->flashdata('message')) : ?>
					<div class="row">
						<div class="col-sm-8">
							<?= $this->session->flashdata('message'); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="table-responsive">
					<?php if (count($configurations_data) == 0) : ?>
						<div class="alert alert-info">
							<p>Belum ada konfigurasi web yang tersedia</p>
						</div>
					<?php else : ?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Judul Web</th>
									<th>Judul Singkat Web</th>
									<th>Logo Web</th>
									<th>Alamat</th>
									<th>Telp</th>
									<th>Email</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($configurations_data as $configuration) : ?>
									<tr>
										<td><?= $configuration->title; ?></td>
										<td><?= $configuration->short_title; ?></td>
										<td><?= $configuration->image; ?></td>
										<td><?= $configuration->address; ?></td>
										<td><?= $configuration->telp; ?></td>
										<td><?= $configuration->email; ?></td>
										<td><?= $configuration->created_at; ?></td>
										<td>
											<a href="<?= base_url() ?>admin/configurations/edit/<?= $configuration->id; ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit </a>
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
