<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('deduct_point')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/point/deduct_point_form/'.$id, 'class="form-horizontal"'); ?>
                                                
                                  <!--div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('consume_date');?></label>
										<?php $consume_date	= array('name'=>'consume_date', 'id'=>'consume_date', 'class'=>'form-control', 'value'=>set_value('consume_date', set_value('consume_date', $created)));?>
										<?php echo '<div class="col-sm-4 input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>'.form_input($consume_date).'</div>'; ?>
								  </div-->   
								  								  								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('trx_no');?></label>
									<?php
										$data	= array('name'=>'trx_no', 'value'=>set_value('trx_no', $trx_no), 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
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
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('point_amount');?></label>
									<?php
									$data	= array('name'=>'point_amount', 'value'=>set_value('point_amount', $depoint), 'class'=>'form-control', 'id'=> 'point_amount');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>								  
								  								                   
                                  <div class="hr-line-dashed"></div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('remark');?></label>
                                    <?php
										$data	= array('name'=>'remark', 'value'=>set_value('remark', $remark), 'class'=>'form-control');
										echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
                                  </div>                                                                                                                       
                                                                	
                              <div class="hr-line-dashed"></div>                              															
                              																									
								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
                                        <input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>" onclick="return areyousure();">
                                    </div>
                                </div>
								<input type="hidden" value="Point" name="payment"/>					
																	
								</form>

                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_consume');?>');
}
</script>
	