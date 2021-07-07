<!-- Welcome -->
<!-- <section>
    <div> -->
        <!-- Jumbotron -->
         <!-- <div class="card card-image" style="background-image: url('<?= base_url(); ?>assets/img/jumbotron/image1.jpg')"> -->
            <!-- <div class="text-white text-center rgba-stylish-strong py-5 px-4"> -->
                <!-- <div class="py-5"> -->
                    <!-- Content -->
                    <!-- <div class="container container-index mt-2 mb-2 pt-2 pb-2"> -->
                        <!-- <?= $intro == null ? '<h2 class="card-title h2 my-4 py-2">Selamat Datang</h2>' : $intro->intro; ?> -->
                        <!-- <a href="<?= base_url(); ?>home/gallery" class="btn btn-outline-light"><i class="fa fa-image"> Kunjungi Galery</i></a> -->
                    <!-- </div>
                </div>
            </div>
        </div> --> 
        <!-- Jumbotron -->
    <!-- </div>
</section> -->
<!-- Welcome -->
<!-- Gallery Product -->
<!-- <section>
    <div class="container">
        <h1 class="text-center text-gallery mt-5 mb-3">Produk Ungulan</h1>
    </div>
</section>
<section>
    <div class="container">
        <div class="row row-cols-2 shadow-sm p-3 mb-5 mt-5 bg-white rounded produk-unggulan">
            <?php if (count($products) == 0) : ?>
                <div class="col">
                    <h3>Belum ada Produk Unggul yang ingin ditampilkan</h3>
                </div>
            <?php else : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col">
                        <img src="<?= base_url(); ?>storage/products/images/<?= $product->image; ?>" class="img-fluid">
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
</section> -->
<!-- Gallery Product -->

<!-- Banner -->
					<section  id="banner">
						<div  class="inner">
							<div class="logo"><span class="icon"><i class="fas fa-home"></i></span></div>
                            <h2>Dusun Gamparan</h2>
                        <?= $intro == null ? '' : $intro->intro; ?> 
						</div>
					</section>

				<!-- Wrapper -->
					<section id="wrapper">

						<!-- One -->
							<section id="one" class="wrapper spotlight style1">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Keadaan Dusun Gamparan</h2>
										<!-- <p>Lorem ipsum dolor sit amet, etiam lorem adipiscing elit. Cras turpis ante, nullam sit amet turpis non, sollicitudin posuere urna. Mauris id tellus arcu. Nunc vehicula id nulla dignissim dapibus. Nullam ultrices, neque et faucibus viverra, ex nulla cursus.</p> -->
                                        <?= $intro == null ? '' : $intro->keadaan; ?> 
                                        <a href="<?= base_url(); ?>home/tentang" class="special">Selengkapnya</a>
									</div>
								</div>
							</section>

						<!-- Two -->
							<section id="two" class="wrapper alt spotlight style2">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Produk Penduduk Dusun Gamparan</h2>
										<!-- <p>Lorem ipsum dolor sit amet, etiam lorem adipiscing elit. Cras turpis ante, nullam sit amet turpis non, sollicitudin posuere urna. Mauris id tellus arcu. Nunc vehicula id nulla dignissim dapibus. Nullam ultrices, neque et faucibus viverra, ex nulla cursus.</p> -->
                                        <?= $intro == null ? '' : $intro->produk; ?>
                                        <a href="<?= base_url(); ?>home/produk" class="special">Selengkapnya</a>
									</div>
								</div>
							</section>

						<!-- Three -->
							<section id="three" class="wrapper spotlight style3">
								<div class="inner">
									<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
									<div class="content">
										<h2 class="major">Komunitas Dusun Gamparan</h2>
                                        <?= $intro == null ? '' : $intro->komunitas; ?> 
										<!-- <p>Lorem ipsum dolor sit amet, etiam lorem adipiscing elit. Cras turpis ante, nullam sit amet turpis non, sollicitudin posuere urna. Mauris id tellus arcu. Nunc vehicula id nulla dignissim dapibus. Nullam ultrices, neque et faucibus viverra, ex nulla cursus.</p> -->
										<a href="detail.html" class="special">Selengkapnya</a>
									</div>
								</div>
							</section>

						<!-- Four -->
							<section id="four" class="wrapper alt style1">
								<div class="inner">
									<h2 class="major">Kegiatan Terbaru</h2>
									<!-- <p>Berikut adalah kegiatan yang ada di Dusun Gamparan</p> -->
									<section class="features">
                                    <?php if (count($blogs) == 0) : ?>
                                        <h3>Belum ada Artikel / Blog yang tersedia</h3>
                                    <?php else : ?>
                                        <?php foreach ($blogs as $blog) : ?>
										<article>
											<a href="#" class="image"><img src="<?= $blog->src_image;?>" alt="" /></a>
											<h3 class="major"><?= $blog->title; ?></h3>
                                            <!-- <p class="text-left  tanggal-blog"><?= date('d F Y', strtotime($blog->created_at)); ?></p> -->
                                            <?= $blog->content; ?>
                                            <a href="<?= base_url(); ?>home/blog_detail/<?= $blog->id; ?>" class="special">Selengkapnya</a>
										</article>
                                            <?php endforeach ?>
                                        <?php endif ?>
									</section>
									<ul class="actions">
										<li><a href="#" class="button">Telusuri Semua</a></li>
									</ul>
								</div>
							</section>

					</section>