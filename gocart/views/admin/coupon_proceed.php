<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                    	
                        <div class="ibox-title">
                            <h5><?php echo lang('customer_coupon_form')?></h5>                            
                        </div>
                        
                        <div class="ibox-content">

                        <?php echo form_open($this->config->item('admin_folder').'/coupons/process_coupon/'.$id, 'class="form-horizontal"'); ?>
                        
                          <!--div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('coupon_code');?></label>
							<?php
							$data	= array('name'=>'code', 'value'=>set_value('code', $code), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						  </div-->
						  
						 <div class="form-group">
			             	<label class="col-sm-2 control-label" for="coupon_name"><?php echo lang('coupon_name');?></label>            	
			            	<div class="controls">
								<?php echo '<div class="col-sm-10">'.form_dropdown('coupon_id', $coupons, set_value('coupon_id',$coupon_id), 'id="coupon_id" class="form-control m-b"').'</div>';; ?>
							 </div>
						 </div>						  
						  
						  <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('card');?></label>
							<?php
							$data	= array('name'=>'card', 'value'=>set_value('card', $card), 'class'=>'form-control');
							echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
						 </div>
						 
						 <div class="hr-line-dashed"></div>
                        
                         
						 						 
						
						
						 <div class="form-actions">
								<button type="submit" class="btn btn-primary"><?php echo lang('next');?></button>
						 </div>
                        
                        </form>
                       
                        
                        </div>
                        
                     </div>
                </div>
</div>     

