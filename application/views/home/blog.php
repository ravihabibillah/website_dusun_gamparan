<!-- <section>
    <div class=" text-center pt-5 judulblog">
        <h1 class="text-white"><i class="fa fa-pencil"></i><br>Blog Dusun Gebang</h1>
    </div>
</section>
<section>
    <div class="team-boxed">
        <div class="container">
            <div class="row people">
                <?php if (count($blogs) == 0) : ?>
                    <h3>Belum ada Artikel / Blog yang tersedia</h3>
                <?php else : ?>
                    <?php foreach ($blogs as $blog) : ?>
                        <div class="col-md-6 col-lg-4 item">
                            <div class="box">
                                <img class="rounded img-fluid" src="<?= $blog->src_image; ?>">
                                <h3 class="name text-left"><?= $blog->title; ?></h3>
                                <p class="text-left  tanggal-blog"><?= date('d F Y', strtotime($blog->created_at)); ?></p>
                                <div class="description text-left">
                                    <?= $blog->content; ?>
                                </div>
                                <p class="text-left  nama-penulis"><?= $blog->writer; ?></p>
                                <a href="<?= base_url(); ?>home/blog_detail/<?= $blog->id; ?>" target="_blank" class="btn btn-primary btn-selengkapnya"><span>Selengkapnya</span></a>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section> -->
<section id="wrapper">
                <header>
                    <div class="inner">
                        <h2>Kegiatan di Dusun Gamparan</h2>
                        <p>Berikut kegiatan yang diselenggarakan di Dusun Gamparan</p>
                    </div>
                </header>

                <!-- Content -->
                    <div class="wrapper">
                        <div class="inner">
<!-- 
                            <h3 class="major">Deskripsi</h3>
                            <p>Morbi mattis mi consectetur tortor elementum, varius pellentesque velit convallis. Aenean tincidunt lectus auctor mauris maximus, ac scelerisque ipsum tempor. Duis vulputate ex et ex tincidunt, quis lacinia velit aliquet. Duis non efficitur nisi, id malesuada justo. Maecenas sagittis felis ac sagittis semper. Curabitur purus leo donec vel dolor at arcu tincidunt bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ut aliquet justo. Donec id neque ipsum. Integer eget ultricies odio. Nam vel ex a orci fringilla tincidunt. Aliquam eleifend ligula non velit accumsan cursus. Etiam ut gravida sapien.</p>
                             -->
                            <!-- <p>Vestibulum ultrices risus velit, sit amet blandit massa auctor sit amet. Sed eu lectus sem. Phasellus in odio at ipsum porttitor mollis id vel diam. Praesent sit amet posuere risus, eu faucibus lectus. Vivamus ex ligula, tempus pulvinar ipsum in, auctor porta quam. Proin nec commodo, vel scelerisque nisi scelerisque. Suspendisse id quam vel tortor tincidunt suscipit. Nullam auctor orci eu dolor consectetur, interdum ullamcorper ante tincidunt. Mauris felis nec felis elementum varius.</p> -->

                            <h3 class="major">List Kegiatan</h3>
                            <!-- <p>Berikut ini adalah kegiatan-kegiatan yang diselenggarakan di dusun gamparan</p> -->
                            <?php if (count($blogs) == 0) : ?>
                                <h3>Belum ada Artikel / Blog yang tersedia</h3>
                            <?php else : ?>
                                
                            <section class="features">
                            <?php foreach ($blogs as $blog) : ?>
                                <article>
                                    <a href="<?= base_url(); ?>home/blog_detail/<?= $blog->id; ?>" target="_blank" class="image"><img src="<?= $blog->src_image; ?>" alt="" /></a>
                                    <h3 align="center" class="major"><?= $blog->title; ?></h3>
                                    <p><?= $blog->content; ?></p>
                                    <a href="<?= base_url(); ?>home/blog_detail/<?= $blog->id; ?>" target="_blank" class="special">Selengkapnya</a>
                                </article>
                                <?php endforeach ?>
                            </section>

                                
                            <?php endif ?>
                            
                        </div>
                    </div>

            </section>