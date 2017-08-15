<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('consume_form')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                                
								<?php echo form_open($this->config->item('admin_folder').'/credit/consume_form/'.$id, 'class="form-horizontal"'); ?>
                                                
                                  <div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('consume_date');?></label>
										<?php $consume_date	= array('name'=>'consume_date', 'id'=>'consume_date', 'class'=>'form-control', 'value'=>set_value('consume_date', set_value('consume_date', $created)));?>
										<?php echo '<div class="col-sm-4 input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>'.form_input($consume_date).'</div>'; ?>
								  </div>   
								  <div class="hr-line-dashed"></div>			           
                                                
		                          <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('card');?></label>
									<?php
									$data	= array('name'=>'card', 'value'=>set_value('card', $card), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								  </div>
								  <div class="hr-line-dashed"></div>
								  
								  <div class="form-group">
					             	 <label class="col-sm-2 control-label" for="products"><?php echo lang('products');?></label>            	
					            	<div class="controls">
										<?php echo '<div class="col-sm-10">'.form_dropdown('voucher_id', $vouchers, set_value('voucher_id',$voucher_id), 'id="voucher_id" class="form-control m-b" onChange="select_voucher();"').'</div>';; ?>
									 </div>
								 </div>
								  
								  
								  <div class="form-group">
					             	 <label class="col-sm-2 control-label" for="payment"><?php echo lang('payment');?></label>            	
										<?php
										$options = array(	'Credit'	=> 'credit',
															'Point'	=> 'point'
										                );
										echo '<div class="col-sm-10">'.form_dropdown('payment', $options, set_value('payment'), 'id="payment" class="form-control m-b" onChange="select_voucher();"').'</div>';
										?>							
								 </div>	
								 													  								
								  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('consume_amount');?></label>
									<?php
									$data	= array('name'=>'consume_amount', 'value'=>set_value('consume_amount', $out), 'class'=>'form-control', 'id'=> 'consume_amount', 'readonly'=>true);
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
                                        <input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>" onclick="return areyousure();">
                                    </div>
                                </div>
								
																	
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
	