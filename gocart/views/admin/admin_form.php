<?php 
	$current_admin	= $this->session->userdata('admin');
?>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('admin_form')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/admin/form/'.$id, 'class="form-horizontal"'); ?>
                                                                                                                      
		                          <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('firstname');?></label>
									<?php
									$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('lastname');?></label>
									<?php
									$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('username');?></label>
									<?php
									$data	= array('name'=>'username', 'value'=>set_value('username', $username), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('email');?></label>
									<?php
									$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>		
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('access');?></label>
									<?php
									$options = array(	'Admin'		=> 'Admin',
														'Supervisor'=> 'Supervisor'
									                );
									
											echo '<div class="col-sm-10">'.form_dropdown('access', $options, set_value('access',$access), 'class="form-control m-b"').'</div>'; 
									?>																	
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('branch');?> (<?php echo lang('merchant')?>)</label>
									<?php echo '<div class="col-sm-10">'.form_dropdown('branch_id', $branches, set_value('branch_id',$branch_id), 'class="form-control m-b"').'</div>'; ?>
								  </div>
								  <?php 
								  		echo $current_admin['branch'] == 0 ? '<font style="color:red">If no select Branch(Merchant), which mean is Super Admin.</font>' : '';
								  ?>
  		  
								  <div class="hr-line-dashed"></div>
								  
								  								  								                                    
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('password');?></label>
                                  <?php
										$data	= array('name'=>'password', 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_password($data).'</div>'; ?>                        
                                  </div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('confirm_password');?></label>
                                  <?php
										$data	= array('name'=>'confirm', 'class'=>'form-control');										             
										echo '<div class="col-sm-10">'.form_password($data).'</div>'; ?>              
                                  </div>
                                                          
                                <div class="hr-line-dashed"></div>                                                                    	                             
                              								
								 <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
                                        <input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>">
                                    </div>
                                </div>
								
																	
								</form>

                        </div>
                    </div>
                </div>
            </div>

</form>
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>
	