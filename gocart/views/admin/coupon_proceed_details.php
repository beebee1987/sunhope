<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                    	
                        <div class="ibox-title">
                            <h5><?php echo lang('customer_coupon_details')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                                               
                        <?php if(isset($details) && !empty($details)):?>
                        <?php echo form_open($this->config->item('admin_folder').'/coupons/process_coupon_details', 'class="form-horizontal"'); ?>
                        						
                        <div class="form-group">
			             	 <label class="col-sm-2 control-label" for="code"><?php echo lang('coupon_code');?>  </label>
			             	 <label class="col-sm-1 control-label"> : </label>
			             	 <label class="col-sm-2 control-label"> <?php echo $details['code'];?> </label>
						</div>	
						 
						<div class="form-group">
			             	 <label class="col-sm-2 control-label" for="name"><?php echo lang('coupon_name');?> </label>
			             	 <label class="col-sm-1 control-label"> : </label>
			             	 <label class="col-sm-2 control-label"> <?php echo $details['name'];?> </label>
						</div>	
						
						<div class="form-group">
			             	 <label class="col-sm-2 control-label" for="name"><?php echo lang('customer_name');?> </label>
			             	 <label class="col-sm-1 control-label"> : </label>
			             	 <label class="col-sm-2 control-label"> <?php echo $customer['name'];?> </label>
						</div>	
						
						<div class="form-group">
			             	 <label class="col-sm-2 control-label" for="name"><?php echo lang('customer_card');?> </label>
			             	 <label class="col-sm-1 control-label"> : </label>
			             	 <label class="col-sm-2 control-label"> <?php echo $customer['card'];?> </label>
						</div>	
                        
                                                
                         <!--div class="form-group">
			             	 <label class="col-sm-2 control-label" for="active"><?php echo lang('status');?></label>    
			             	 <label class="col-sm-1 control-label"> : </label>        	
								<?php
								$options = array(	'0'	=> 'Unused',
													'1'	=> 'Used',
													'2' => 'Cancelled'
								                );

								
								echo '<div class="col-sm-2">'.form_dropdown('active', $options, set_value('active', $details['use_status']), 'class="form-control m-b"').'</div>';
								?>							
						 </div-->	
						 
						  <div class="form-group">
						 	<label class="col-sm-2 control-label"><?php echo lang('use_qty');?></label>
						 	<label class="col-sm-1 control-label"> : </label>     
							<?php
							$data	= array('name'=>'used', 'value'=>set_value('used'), 'class'=>'form-control');
							echo '<div class="col-sm-1">'.form_input($data).'</div>'; ?>
						  </div>
						 
						 <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">
						 <input type="hidden" name="customer_card" value="<?php echo $customer['card']?>">
						 <input type="hidden" name="coupon_id" value="<?php echo $coupon_id?>">
						 

						 <div class="hr-line-dashed"></div>
			
						 <div class="form-actions">
								<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
						 </div>
                        
                        </form>
                        <?php else:?>
                        
                        <p><?php echo lang('error_not_found')?></p>
                        
                        <?php endif;?>
                        
                        </div>
                        
                     </div>
                </div>
</div>     

