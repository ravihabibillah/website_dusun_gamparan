<section id="wrapper">
                <header>
                    <div class="inner">
                        <h2>Produk di Dusun Gamparan</h2>
                        <p>Berikut produk UMKM yang ada di Dusun Gamparan</p>
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

                            <h3 class="major">List Produk</h3>
                            <!-- <p>Berikut ini adalah kegiatan-kegiatan yang diselenggarakan di dusun gamparan</p> -->
                            <?php if (count($produks) == 0) : ?>
                                <h3>Belum ada Produk  yang tersedia</h3>
                            <?php else : ?>
                                
                            <section class="features">
                            <?php foreach ($produks as $produk) : ?>
                                <article>
                                    <a target="_blank" href="<?= base_url(); ?>home/produk_detail/<?= $produk->id; ?>" class="image"><img src="<?= base_url('storage/products/images/') . $produk->image; ?>" alt="" /></a>
                                    <h3 align="center" class="major"><?= $produk->title; ?></h3>
                                    <!-- <p><?= $produk->description; ?></p> -->
                                    <!-- <a href="<?= base_url(); ?>home/produk_detail/<?= $produk->id; ?>" target="_blank" class="special">Selengkapnya</a> -->
                                </article>
                                <?php endforeach ?>
                            </section>

                                
                            <?php endif ?>
                            
                        </div>
                    </div>

            </section>