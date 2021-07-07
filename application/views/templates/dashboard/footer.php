        </div>
        </div>
        <!-- Mainly scripts -->
        <script src="<?= base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?= base_url(); ?>assets/js/inspinia.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- SUMMERNOTE -->
        <script src="<?= base_url(); ?>assets/js/plugins/summernote/summernote.min.js"></script>
        <!-- Data picker -->
        <script src="<?= base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <!-- Chosen -->
        <script src="<?= base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
        <!-- blueimp gallery -->
        <script src="<?= base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

        <!-- ChartJS-->
        <script src="<?= base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>
        <!-- <script src="<?= base_url(); ?>assets/js/demo/chartjs-demo.js"></script> -->
        <?php if (isset($dashboard_graphics)) : ?>
        	<script src="<?= base_url(); ?>assets/js/dashboard.js" type="text/javascript"></script>
        <?php endif; ?>
        <!-- Jasny -->
        <script src="<?= base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/custom.js"></script>
        </body>

        </html>
