<?php 
	$info = '';	
	$payment_type = '';
	$consume_amt = 0;
	$date = '';
	if(isset($credit)){
		$info = $credit;
		$payment_type = 'Credit';
		$consume_amt = $credit['out'];
		$date = $credit['created'];
	}else{
		$info = $point;
		$payment_type = 'Point';
		$consume_amt = $point['depoint'];
		$date = $point['created'];
	}
?>

<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('consume_info')?> - <?php echo lang('receipt')?></h5>
                            
                        </div>
                        <div class="ibox-content">
                                        
                                <a href="#" onclick="javascript: print_receipt();" class="btn btn-danger no-print"><?php echo lang('print_receipt')?></a>        
                                                
								<form class="form-horizontal"> 
																           
								  <?php if(isset($info['trx_no']) && !empty($info['trx_no'])):?>         
								  <div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('trx_no');?></label>
										<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo $info['trx_no']?></label>
								  </div>            
								  <?php endif; ?>
								               
                                  <div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('consume_date');?></label>
										<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo date("d-m-Y", strtotime($date)); ?></label>
								  </div>   
								  <div class="hr-line-dashed"></div>			           
                                                
		                          <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('card');?></label>
									<label class="col-sm-2 control-label">:</label>
									<label class="col-sm-2 control-label"><?php echo $info['customer_card']?></label>
								  </div>
								  <div class="hr-line-dashed"></div>
								  
								  <div class="form-group">
								  	<label class="col-sm-2 control-label"><?php echo lang('payment');?></label>
					             	<label class="col-sm-2 control-label">:</label>
									<label class="col-sm-2 control-label"><?php echo $payment_type ?></label>							
								 </div>	
								 													  																  
								  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('consume_amount');?></label>
									<label class="col-sm-2 control-label">:</label>
									<label class="col-sm-2 control-label"><?php echo $consume_amt ?></label>
								  </div>								  
								  								                   
                                  <div class="hr-line-dashed"></div>
                                  
                                  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('remark');?></label>
                                    <label class="col-sm-2 control-label">:</label>
									<label class="col-sm-2 control-label"><?php echo $info['remark']?></label>		
                                  </div>
                                  
                                                                                                                          
                                                                	
                              <div class="hr-line-dashed"></div>                              															
                              																									
								<div class="form-group">
                                    <div>
                                        <!--button class="btn btn-white" type="submit">Cancel</button-->
                                        <a class="btn btn-primary no-print" href="<?php echo site_url($this->config->item('admin_folder')).'/credit';?>"><?php echo lang('back_to_listing');?></a>
                                    </div>
                                </div>
								
																	
								</form>

                        </div>
                    </div>
                </div>
            </div>

<script>

//function to generate invoice full report
function print_receipt()
{
	window.print();
}
</script>
	