<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('company_details')?></h5>                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/company/company_form/'.$id, 'class="form-horizontal"'); ?>
                                                
		                      <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('company_name');?></label>
								<?php
								$data	= array('name'=>'company_name', 'value'=>set_value('company_name', $company_name), 'class'=>'form-control');
								echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
							  </div>
							  
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
                                                                    
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('fax');?></label>
                                    <?php
									$data	= array('name'=>'fax', 'value'=>set_value('fax', $fax), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'<span class="help-block m-b-none">example: 60115558888</span></div>'; ?>
                                  </div>  
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('company_address');?></label>
									<?php
									$data	= array('name'=>'address', 'value'=>set_value('address', $address), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('gps');?></label>
									<?php
									$data	= array('name'=>'gps', 'value'=>set_value('gps', $gps), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('website');?></label>
									<?php
									$data	= array('name'=>'website', 'value'=>set_value('website', $website), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('gst');?></label>
									<?php
									$data	= array('name'=>'gst', 'value'=>set_value('gst', $gst), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('ssm');?></label>
									<?php
									$data	= array('name'=>'ssm', 'value'=>set_value('ssm', $ssm), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('company_details');?></label>																		
									<textarea class="input-block-level" id="summernote" name="company_details" rows="5">
		                        		<?php echo set_value('company_details', $company_details) ?>
		                        	</textarea>																		
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


	