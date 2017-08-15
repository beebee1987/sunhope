<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('branch_details')?></h5>                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/branch/branch_form/'.$id, 'class="form-horizontal"'); ?>
                                                
		                      <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('branch_name');?></label>
								<?php
								$data	= array('name'=>'name', 'value'=>set_value('branch_name', $name), 'class'=>'form-control');
								echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
							  </div>
							  
							  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('address');?></label>
								<?php
								$data	= array('name'=>'address', 'value'=>set_value('address', $address), 'class'=>'form-control');
								echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
							  </div>
							  
							  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('phone');?></label>
								<?php
								$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'form-control');
								echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
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


	