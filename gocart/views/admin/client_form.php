
<?php 
	$f_logo		= array('name'=>'logo', 'id'=>'logo');
?>


<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                    
                        <div class="ibox-title">
                            <h5><?php echo lang('client_form')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open_multipart($this->config->item('admin_folder').'/clients/form/'.$id, 'class="form-horizontal"'); ?>                                               
                        
                         <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('client_company');?></label>
							<?php
							$data	= array('name'=>'company', 'value'=>set_value('company', $company), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div>

						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('client_name');?></label>
							<?php
							$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>

						 <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('client_email');?></label>
							<?php
							$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div>

						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('client_phone');?></label>
							<?php
							$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div>

						   

						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('client_billing_address');?></label>
							<?php
							$data	= array('name'=>'default_billing_address', 'value'=>set_value('default_billing_address', $default_billing_address), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div>

							
							<div class="form-group"><label class="col-sm-2 control-label" for="logo"><?php echo lang('logo');?></label>
								<?php echo '<div class="col-sm-10">'.form_upload($f_logo).'</div>'; ?>
							</div>
							
							
							<?php if($id && $logo != ''):?>
								<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url($logo);?>" width="100%" alt="current"/><br/><?php echo lang('current_file');?></div>
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