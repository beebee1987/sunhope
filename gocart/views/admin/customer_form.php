<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('customer_details')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/customers/form/'.$id, 'class="form-horizontal"'); ?>
                                                
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('card');?></label>
									<?php
									$data	= array('name'=>'card', 'value'=>set_value('card', $card), 'class'=>'form-control', 'readonly'=>true);
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
																	
								  </div>
								  <div class="hr-line-dashed"></div>              
                                                
		                          <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('name');?></label>
									<?php
									$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  <div class="hr-line-dashed"></div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('email');?></label>
									<?php
									$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>								  
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('phone');?></label>
                                    <?php
										$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_input($data).'<span class="help-block m-b-none">example: 60115558888</span></div>'; ?>
                                  </div>                       
                                  <div class="hr-line-dashed"></div>
                                  
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('password');?></label>
                                  <?php
										$data	= array('name'=>'password', 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_password($data).'</div>'; ?>                        
                                  </div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('confirm');?></label>
                                  <?php
										$data	= array('name'=>'confirm', 'class'=>'form-control');										             
										echo '<div class="col-sm-10">'.form_password($data).'</div>'; ?>              
                                  </div>
                                                          
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                        <label class="checkbox">                                         
                                        <?php $data	= array('name'=>'email_subscribe', 'value'=>1, 'checked'=>(bool)$email_subscribe);
										echo form_checkbox($data).' '.lang('email_subscribed'); ?>
                                        </label>
                                        </div>                                       
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group"><label class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <div class="checkbox">
                                        <label class="checkbox">
                                        <?php
											$data	= array('name'=>'active', 'value'=>1, 'checked'=>$active);
											echo form_checkbox($data).' '.lang('active'); 
										?>
                                        </label>
                                        </div>                                       
                                    </div>
                                </div>
                                                                	
                              <div class="hr-line-dashed"></div>
                              								
								<div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('group');?></label>
									<?php echo '<div class="col-sm-10">'.form_dropdown('group_id', $group_list, set_value('group_id',$group_id), 'class="form-control m-b"').'</div>'; ?>
								</div>
                              																									
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


	