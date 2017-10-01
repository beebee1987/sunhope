<div class="wrapper wrapper-content animated fadeIn" >


    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('category'); ?></label>
                        <div class="col-sm-10">
<!--                            <select id = 'selected-category' name='selected-category' class="form-control m-b">
                                <?php
                                foreach ($categoryss as $row) {
                                    echo '<option value="' . $row->name . '">' . $row->name . '</option>';
                                }
                                ?>
                            </select>-->
                            <?php echo '<div class="col-sm-10">'.form_dropdown('category', $categorys, set_value('category',$category), 'class="form-control m-b" id="selected-category"').'</div>'; ?>
                        </div>

                    </div> 
                </div>
<!--                <button onclick="myFunction()">Try it</button>-->
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
<?php echo form_open($this->config->item('admin_folder') . '/projects/bulk_save', array('id' => 'bulk_form')); ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <!--th><?php echo lang('name'); ?></th-->
                                            <th><?php echo lang('image'); ?></th>
                                            <th><?php echo lang('category'); ?></th>
                                            <th><?php echo lang('seq_no'); ?></th>
                                            <!--th><?php echo lang('description'); ?></th-->
                                            <th><?php echo lang('status'); ?></th>	
                                            <th>
                                                <span class="btn-group pull-right">
                                                    <button class="btn" href="#"><i class="icon-ok"></i> <?php echo lang('bulk_save'); ?></button>
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php echo (count($projects) < 1) ? '<tr><td style="text-align:center;" colspan="4">' . lang('no_projects') . '</td></tr>' : '' ?>
                                        <?php foreach ($projects as $project): ?>
                                            <tr>
                                                <!--td><?php echo form_input(array('name' => 'project[' . $project->id . '][name]', 'value' => form_decode($project->name), 'class' => 'span1')); ?></td-->
                                                <td><?php if ($project->url != ''): ?>
                                                        <div style="text-align:center; padding:2px; border:1px solid #ccc;"><img src="<?php echo base_url($project->smaller_url); ?>" width="40px" alt="current"/><br/><?php echo lang('current_file'); ?></div>
    <?php endif; ?>	</td>
                                                <td><?php echo form_dropdown('project[' . $project->id . '][category]', $categorys, set_value('category', $project->category), 'class="span2"'); ?></td>
                                                <td><?php echo form_input(array('name' => 'project[' . $project->id . '][seq_no]', 'value' => form_decode($project->seq_no), 'class' => 'span1')); ?></td>
                                                <!--td><?php echo form_input(array('name' => 'project[' . $project->id . '][description]', 'value' => form_decode($project->description), 'class' => 'span1')); ?></td-->
                                                <td>
    <?php
    $options = array(
        'ACTIVE' => lang('enabled'),
        'INACTIVE' => lang('disabled')
    );
    echo form_dropdown('project[' . $project->id . '][status]', $options, set_value('enabled', $project->status), 'class="span2"');
    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" style="float:right;">
                                                        <a class="btn btn-white btn-bitbucket" href="<?php echo site_url($this->config->item('admin_folder') . '/projects/form/' . $project->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit'); ?></a>
                                                        <a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder') . '/projects/delete/' . $project->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete'); ?></a>
                                                    </div>
                                                </td>
                                            </tr>
<?php endforeach; ?>
                                    </tbody>
                                </table></form>
                            </div></div></div></div>
            </div>
        </div>
    </div>
</div>





</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/dropzone/dropzone.js'); ?>"></script>


<script>

    var product_code = null;
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        maxFilesize: 100, maxThumbnailFilesize: 100, createImageThumbnails: true,
        url: "<?php echo base_url() ?>admin/projects/uploadImage",
        acceptedFiles: "image/*",
        init: function () {
            this.on("complete", function (file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    window.location.replace("<?php echo base_url() ?>admin/projects"+"/"+$("#selected-category").val());
                }
            });
        }, sending: function (file, xhr, formData) {
            formData.append('sscategory', $("#selected-category").val());
//formData.append('sscategory', <?php echo  $category; ?>);
        },
    });
    function myFunction() {
        var aa = $("#selected-category").val();
        var x = document.getElementById("selected-category").value;
    //    document.getElementById("demo").innerHTML = x;
        console.log(aa);
    }

</script>