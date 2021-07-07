<div class="text-center loginscreen animated fadeInDown" style="position: relative;">
	<h1 class="logo-name" style="margin: 0;"><?= strtoupper($config_web->short_title); ?></h1>
</div>
<!-- <img src="<?= base_url() ?>storage/configuration/images/<?= $config_web->image; ?>" style="height:300px;width:auto;margin-left:auto;margin-right:auto;display:block;"> -->
<div class="middle-box text-center loginscreen animated fadeInDown">
    <h3>Selamat Datang di <?= $config_web->short_title; ?></h3>
	<p>Silahkan Login</p>
	<?= $this->session->flashdata('message'); ?>
	<form class="m-t" role="form" action="<?= base_url() ?>admin/auth/check_login" method="post">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Username / Email" name="email" required="">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="password" required="">
		</div>
		<button type="submit" class="btn btn-success block full-width m-b" style="background-color:#243BA5;">Login</button>
	</form>
</div>
