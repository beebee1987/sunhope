<div class="wrapper wrapper-content animated fadeIn" >


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
<!--                <div class="ibox-title">
                    <h5>Dropzone.js</h5>
                </div>
                <div class="ibox-content">-->

<!--                    <p>
                        <strong>Dropzone.js</strong> is a light weight JavaScript library that turns an HTML element into a dropzone. This means that a user can drag and drop a file onto it, and the file gets uploaded to the server via AJAX.
                    </p>-->

<!--                    <form action="<?php echo base_url() ?>admin/projects/uploadImage" class="dropzone">
                    </form>-->


                    <div id="my-dropzone" class="dropzone">
<!--                        <span class="">Content Div Area</span>-->
                        <div class="dz-message">
                            <h3>Drop files here</h3> or <strong>click</strong> to upload
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox">
                                <div class="ibox-content" id='table-data'>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('name'); ?></th>
                                                <th><?php echo lang('image'); ?></th>
                                                <th><?php echo lang('category'); ?></th>
                                                <th><?php echo lang('description'); ?></th>	
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo (count($vouchers) < 1) ? '<tr><td style="text-align:center;" colspan="4">' . lang('no_vouchers') . '</td></tr>' : '' ?>
                                            <?php foreach ($vouchers as $voucher): ?>
                                                <tr>
                                                    <td><?php echo $voucher->name; ?></td>
                                                    <td><?php if ($voucher->url != ''): ?>
                                                            <div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url($voucher->url); ?>" width="30px" alt="current"/><br/><?php echo lang('current_file'); ?></div>
                                                        <?php endif; ?>	</td>
                                                    <td><?php echo $voucher->category; ?></td>
                                                    <td><?php echo $voucher->description; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div></div></div></div>
                </div>
            </div>
        </div>
    </div>





</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/dropzone/dropzone.js'); ?>"></script>


<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {

        url: "<?php echo base_url() ?>admin/projects/uploadImage",
        acceptedFiles: "image/*",
        init: function () {
//            this.on("complete", function (file) {
//                window.location.replace("<?php echo base_url() ?>admin/projects/form");
                this.removeFile(file);
                $("#table-data").load("<?php echo base_url() ?>admin/projects/getData");
//            });
//            this.on("complete", function (file) {
//                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
//                redirect($this->config->item('admin_folder').'projects/form');
//              }
//            });
        }
    });

</script>