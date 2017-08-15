<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    	
                        <div class="ibox-title">
                            <h5><?php echo lang('point_details')?> - <?php echo lang('receipt')?> </h5>                                                                                                            
                        </div>
                        
                        
                        <div class="ibox-content">
                        		 
                        		 <a href="#" onclick="javascript: print_receipt();" class="btn btn-danger no-print"><?php echo lang('print_receipt')?></a>                       						
                                 
                                 <form class="form-horizontal">               
                                 
                                  <div class="form-group">
		                          		<label class="col-sm-2 control-label"><?php echo lang('trx_no');?></label>
										<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo $point['trx_no'];?></label>
								  </div>
                                 
                                  <div class="form-group">
										<label class="col-sm-2 control-label" for="topup_date"><?php echo lang('add_date');?></label>
										<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo date("d-m-Y h:i:s", strtotime($point['created'])); ?></label>
								  </div>
								  <div class="hr-line-dashed"></div>			           
                                                
		                          <div class="form-group">
		                          		<label class="col-sm-2 control-label"><?php echo lang('card');?></label>
										<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo $point['customer_card'];?></label>
								  </div>
								  <div class="hr-line-dashed"></div>								  																  														  
								  
								  <div class="form-group">
								  		<label class="col-sm-2 control-label"><?php echo lang('add_point_amount');?></label>
                                    	<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo $point['point'];?></label>
                                  </div>                       
                                  <div class="hr-line-dashed"></div>
                                  
                                  <div class="form-group">
                                  		<label class="col-sm-2 control-label"><?php echo lang('remark');?></label>
                                    	<label class="col-sm-2 control-label">:</label>
										<label class="col-sm-2 control-label"><?php echo $point['remark'];?></label>
                                  </div>
                                                                                                                                                                                                                          	
                              	   <div class="hr-line-dashed"></div>
                                   <!--button class="btn btn-white" type="submit">Cancel</button-->
                                   <a class="btn btn-info no-print" href="<?php echo site_url($this->config->item('admin_folder')).'/point';?>"> <?php echo lang('back_to_listing');?> </a>
																	
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
	