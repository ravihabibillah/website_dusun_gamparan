<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header">
		</div>
		<div class="content-body">
    		<div class="row">
    			<div class="col-lg-12 col-md-12 col-12">
    				<div class="ibox float-e-margins p-2">
    					<div class="ibox-title">
    						<h3 class="font-weight-bold">SELAMAT DATANG DI <?= strtoupper($config_web->title); ?></h3>
    					</div>
    				</div>
    			</div>
    		</div>
            
            <section>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="widget style1 bg-success" style="height:130px;">
                            <div class="row vertical-align">
                                <div class="col-xs-3">
                                    <p>Jumlah Artikel</p>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h2 class="font-bold"><?= $total_articles; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="widget style1 bg-success" style="height:130px;">
                            <div class="row vertical-align">
                                <div class="col-xs-3">
                                    <p>Jumlah Foto Galeri</p>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h2 class="font-bold"><?= $total_galleries; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>    
                
            <section>
                <div class="row">
                    <div class="col-lg-8 mr-auto">
                        <div class="widget bg-success p-xl" style="overflow-y: auto; height: 300px">
                            <h2>
                                Aktivitas Terakhir Bulan <?= date('F'); ?>
                            </h2>
                            <ul class="list-unstyled m-t-md">
                                <div class="activity-stream">
                                    <?php if (count($history_activity) == 0) : ?>
                                        <div class="stream">
                                            <div class="stream-badge">
                                                <i class="fa fa-history bg-info"></i>
                                            </div>
                                            <div class="stream-panel">
                                                Belum ada aktivitas
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php foreach ($history_activity as $history) : ?>
                                            <div class="stream">
                                                <div class="stream-badge">
                                                    <?php if ($history->jenis == 'insert') : ?>
                                                        <i class="fa fa-plus bg-primary"></i>
                                                    <?php elseif ($history->jenis == 'update') : ?>
                                                        <i class="fa fa-pencil bg-info"></i>
                                                    <?php elseif ($history->jenis == 'delete') : ?>
                                                        <i class="fa fa-trash bg-danger"></i>
                                                    <?php elseif ($history->jenis == 'download') : ?>
                                                        <i class="fa fa-download bg-secondary"></i>
                                                    <?php else : ?>
                                                        <i class="fa fa-circle bg-warning"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="stream-panel">
                                                    <div class="text-white" style="font-size: 80%">
                                                        <span class="date"><?= date('d M Y, H:i:s', strtotime($history->created_at)); ?></span>
                                                    </div>
                                                    <?= $history->keterangan; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 mr-auto">
                        <div class="widget bg-success p-xl" style="overflow-y: auto; height: 300px">
                            <h2>
                                Aktivitas Login dan Logout Bulan <?= date('F'); ?>
                            </h2>
                            <ul class="list-unstyled m-t-md">
                                <?php if (count($history_user) == 0) : ?>
                                    <li>
                                        <div class="stream-small alert alert-info">
                                            <span class="label label-default"> Info</span>
                                            <span> Belum ada aktifitas login dan logout </span>
                                        </div>
                                    </li>
                                <?php else : ?>
                                    <?php foreach ($history_user as $history) : ?>
                                        <li>
                                            <div class="stream-small">
                                                <?= $history->is_success == "1" ? "<span class=\"label label-info\"> Success</span>" : "<span class=\"label label-danger\"> Failed</span>" ?>
                                                <span> <?= date('d M Y, H:i:s', strtotime($history->created_at)); ?> </span> - <strong><?= ucfirst($history->jenis); ?></strong> | <?= $history->ip; ?> | <?= $history->user_agent; ?>.
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
		</div>
	</div>
</div>
