
<?php 
	$f_image		= array('name'=>'image', 'id'=>'image');
?>


<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                    
                        <div class="ibox-title">
                            <h5><?php echo lang('message_form')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open_multipart($this->config->item('admin_folder').'/messages/form/'.$id, 'class="form-horizontal"'); ?>                                               
                        
						 <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('message_name');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control', 'readonly'=>'true');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>

						 <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('message_email');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('email', $email), 'class'=>'form-control', 'readonly'=>'true');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>

						 <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('message_content');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('message', $message), 'class'=>'form-control', 'readonly'=>'true');
							echo '<div class="col-sm-10">'.form_textarea($data).'</div>'; ?>
						 </div>

						 <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('message_created_date');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('created_date', $created_date), 'class'=>'form-control', 'readonly'=>'true');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <div class="hr-line-dashed"></div>
						
                        
                        </form>
                       
                        
                        </div>
                        
                     </div>
                </div>
</div>     


<script type="text/javascript">




</script>