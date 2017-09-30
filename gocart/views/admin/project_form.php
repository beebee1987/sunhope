<?php 
    $f_image        = array('name'=>'smaller_url', 'id'=>'smaller_url');
?>


<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                        <!--div class="alert alert-info" style="text-align:center;">
                            <strong><?php echo sprintf(lang('times_used'), @$num_uses);?></strong>
                        </div-->
                    
                        <div class="ibox-title">
                            <h5><?php echo lang('project_form_edit')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open_multipart($this->config->item('admin_folder').'/projects/form/'.$id, 'class="form-horizontal"'); ?>                                               
                        
                          
                            <!--div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
                                  <?php
                                  $data = array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
                                  echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
                           </div-->
                                                 
                            <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('category');?></label>
                                <?php echo '<div class="col-sm-10">'.form_dropdown('category', $categorys, set_value('category',$category), 'class="form-control m-b"').'</div>'; ?>
                             </div>
                            
                            <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('seq_no');?></label>
                                    <?php
                                    $data   = array('name'=>'seq_no', 'value'=>set_value('seq_no', $seq_no), 'class'=>'form-control');
                                    echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
                             </div>
                            
                            <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('status');?></label>
                                    <?php
    $options = array(
        'ACTIVE' => lang('enabled'),
        'INACTIVE' => lang('disabled')
    );
                                                                   echo '<div class="col-sm-10">'.form_dropdown('status', $options, set_value('enabled',$status), 'class="form-control m-b"');
                                                                   ?>
                             </div>
                         
                         <div class="hr-line-dashed"></div>
                         
                        
                         <!--div class="form-group"><label class="col-sm-2 control-label" for="desc"><?php echo lang('desc');?></label>
                                                        
                            <textarea class="input-block-level" id="summernote" name="description" rows="5">
                                <?php echo set_value('description', $description) ?>
                            </textarea>
                            
                         </div-->   
                        
                        <div class="form-group"><label class="col-sm-2 control-label" for="point_consume"><?php echo lang('image');?></label>
                                <?php echo '<div class="col-sm-10">'.form_upload($f_image).'</div>'; ?>
                                                </div>


                                                <?php if($id && $smaller_url != ''):?>
                                                        <div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url($smaller_url);?>" width="200px" alt="current"/><br/><?php echo lang('current_file');?></div>
                                                <?php endif;?>  
                        
                        
                         <div class="form-actions">
                                <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
                         </div>
                        
                        </form>
                       
                        
                        </div>
                        
                     </div>
                </div>
</div>     


<script type="text/javascript">
</script>