<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('credit_details')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/credit/topup_credit_form/'.$id, 'class="form-horizontal"'); ?>
                                                
                                  <div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('topup_date');?></label>
										<?php $topup_date	= array('name'=>'topup_date', 'id'=>'topup_date', 'class'=>'form-control', 'value'=>set_value('topup_date', set_value('topup_date', $created)));?>
										<?php echo '<div class="col-sm-4 input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>'.form_input($topup_date).'</div>'; ?>
								  </div>   
								  <div class="hr-line-dashed"></div>			           
                                                
		                          <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('card');?></label>
									<?php
									$data	= array('name'=>'card', 'value'=>set_value('card', $card), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  
								  <div class="hr-line-dashed"></div>								  								
								  
								   <?php
										$current_admin	= $this->session->userdata('admin');
										if ($current_admin['branch'] == 0): 
									?>
									<div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('branch');?></label>
										<?php echo '<div class="col-sm-10">'.form_dropdown('branch_id', $branches, set_value('branch_id',$branch_id), 'class="form-control m-b"').'</div>'; ?>
									</div>
									<?php endif;?>
								  
								  <div class="hr-line-dashed"></div>		
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('customer_cost');?></label>
									<?php
									$data	= array('name'=>'customer_cost', 'value'=>set_value('customer_cost', $cost), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>								  
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('customer_topup_value');?></label>
                                    <?php
										$data	= array('name'=>'customer_topup_value', 'value'=>set_value('customer_topup_value', $in), 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
                                  </div>                       
                                  <div class="hr-line-dashed"></div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('remark');?></label>
                                    <?php
										$data	= array('name'=>'remark', 'value'=>set_value('remark', $remark), 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
                                  </div>
                                  
                                                                                          
                                <!--div class="form-group"><label class="col-sm-2 control-label">&nbsp;</label>
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
                                </div-->
                                                                	
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


	