<!DOCTYPE html>

    <head>
    	<!-- Metadata -->

    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<title><?= $config_web->short_title; ?> - <?= $title; ?></title>

    	<!-- CSS Files -->
    	<!-- <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"> -->
    	<link href="<?= base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/animate.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/dropzone/basic.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    	<!-- Toastr style -->
    	<link href="<?= base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    	<!-- Gritter -->
    	<link href="<?= base_url(); ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    	<!-- Summernote -->
    	<link href="<?= base_url(); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
    	<link href="<?= base_url(); ?>assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
        <!-- Data picker -->
        <link href="<?= base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <!-- Chosen -->
        <link href="<?= base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
        <!-- blueimp gallery -->
        <link href="<?= base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">

    	<!-- Your Custom CSS -->
    	<link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet">
    </head>

    <body>
    	<div id="wrapper">
    		<nav class="navbar-default navbar-static-side" role="navigation">
    			<div class="sidebar-collapse">
    				<ul class="nav metismenu" id="side-menu">
    					<li class="nav-header">
    						<div class="dropdown profile-element">
    							<span>
    								<img style="max-width: 80%;" class="img-circle" src="<?= base_url() ?>storage/user/<?= $auth->username; ?>/images/<?= $auth->image; ?>">
    							</span>
    							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
    								<span class="clear">
    									<span class="block m-t-xs">
    										<strong class="font-bold"><?= $auth->name; ?></strong>
    									</span>
    									<span class="text-muted text-xs block">
    										Menu
    										<b class="caret"></b>
    									</span>
    									<ul class="dropdown-menu animated fadeInRight m-t-xs">
    										<li><a href="<?= base_url(); ?>admin/user/setting">Setting</a></li>
    										<li class="divider"></li>
    										<li><a href="<?= base_url(); ?>admin/auth/logout">Logout</a></li>
    									</ul>
    								</span>
    							</a>
    						</div>
    					</li>
    					<li>
    						<a href="<?= base_url(); ?>admin/dashboard/">
    							<i class="fa fa-dashboard"></i>
    							<span class="nav-label">Dashboard</span>
    						</a>
    					</li>
                        <li>
                            <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Konten Halaman</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?= base_url(); ?>admin/intro">Perkenalan</a></li>
                                <li><a href="<?= base_url(); ?>admin/product">Produk Unggulan</a></li>
                                <li><a href="<?= base_url(); ?>admin/blog">Artikel Blog</a></li>
                                <li><a href="<?= base_url(); ?>admin/gallery">Galeri</a></li>
                                <li><a href="<?= base_url(); ?>admin/about">Tentang</a></li>
                                <li><a href="<?= base_url(); ?>admin/contact">Kontak</a></li>
                            </ul>
                        </li>
                        <?php if ($auth->role == 1) : ?>
        					<li>
        						<a href="<?= base_url(); ?>admin/configurations/index">
                                    <i class="fa fa-wrench"></i>
                                    <span class="nav-label">Konfigurasi Web</span>
                                </a>
        					</li>
        					<li>
        						<a href="<?= base_url(); ?>admin/user/index">
        							<i class="fa fa-user-circle"></i>
        							<span class="nav-label">Manajemen Akun</span>
        						</a>
        					</li>
                        <?php endif ?>
    				</ul>
    			</div>
    		</nav>
    		<div id="page-wrapper" class="gray-bg dashbard-1">
    			<div class="row border-bottom">
    				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    					<div class="navbar-header ">
    						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    					</div>
    					<ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Selamat datang, <?= $auth->name; ?></span>
                            </li>
    						<li>
    							<a href="<?= base_url(); ?>admin/auth/logout">
    								<i class="fa fa-sign-out"></i> Log out
    							</a>
    						</li>
    					</ul>
    				</nav>
    			</div>
