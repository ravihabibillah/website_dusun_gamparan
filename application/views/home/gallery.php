<section>
    <div class="container mt-3">
        <h1 class="text-center">Galeri</h1>
    </div>
</section>
<section>
    <div class="container pb-5 shadow-sm p-3 pt-5 mb-5 bg-white rounded">
        <?php if (count($galleries) == 0) : ?>
            <div class="row">
                <h2>Belum ada foto galeri</h2>
            </div>
        <?php else : ?>
            <?php $i = 0; ?>
            <?php foreach ($galleries as $gallery) : ?>
                <?php if (($i % 3) == 0) : ?>
                    <div class="row">
                <?php endif ?>
                        <div class="col-sm mb-5">
                            <div class="row-sm">
                                <img src="<?= base_url(); ?>storage/galleries/images/<?= $gallery->image; ?>" style="height: 384px;width: 100%;object-fit: cover;" class="img-fluid rounded-lg">
                            </div>
                            <div class="row-sm">
                                <small class="font-weight-bold"><?= $gallery->title; ?></small>
                            </div>
                            <div class="row-sm">
                                <section>
                                    <div class="mt-1">
                                        <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#image<?= $i; ?>">Lihat Gambar</button>
                                        <div class="modal fade bd-example-modal-xl" id="image<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <img src="<?= base_url(); ?>storage/galleries/images/<?= $gallery->image; ?>" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                <?php if (($i % 3) == 2) : ?>
                    </div>
                <?php endif ?>
                <?php $i++; ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</section>