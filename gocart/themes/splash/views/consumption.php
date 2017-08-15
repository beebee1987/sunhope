<div id="wrapper">

	    <div id="content">
	            <?php $this->load->view('header_menu'); ?>   
	                        
	       <div class="sliderbg ">
	       
	       		 <?php echo form_open('cart/consumption/'.$encrypt .'/'.$customer_id, 'class="form-horizontal"'); ?>
	             <div class="pages_container">
		             <h2 class="page_title"><?php echo $page_title?></h2>
		             		             
		            <?php $this->load->view('error_message'); ?>   
		             		             
		             <!-- This is Branch retrieve from Database -->
		             <!--div class="control-group">
							 <label class="control-label" for="staff_branch"><?php echo lang('staff_branch');?></label> 
				             <div class="controls">
								<input type="text" name="staff_branch" value="<?php echo set_value('staff_branch') ?>" class="form_input radius4 required"/>							
							 </div>
		             </div-->
		             
		             <div class="control-group">
		             	 <label class="control-label" for="staff_username"><?php echo lang('staff_username');?></label> <span style="color:red"> * </span>
			             <div class="controls">
							<input type="text" name="staff_username" class="form_input radius4 required"/>							
						 </div>
	            	 </div>
	            	 
	            	 
	            	<div class="control-group">
		             	 <label class="control-label" for="staff_password"><?php echo lang('staff_password');?></label> <span style="color:red"> * </span>
		            	<div class="controls">
							<input type="password" name="staff_password" class="form_input radius4 required"/>							
						</div>
	            	</div>
	            	            	
	            	<hr/>
	            	            	
	            	<div class="control-group">
		             	 <label class="control-label" for="customer_name"><?php echo lang('customer_name');?></label>            	
		            	<div class="controls">
							<!--input type="text" name="customer_name" value="<?php echo set_value('customer_name') ?>" class="form_input radius4 required"/-->	
							<b><?php echo $customer['name']?></b>
						 </div>
					 </div>
					
					
					<div class="control-group">
		             	 <label class="control-label" for="products"><?php echo lang('products');?></label> <span style="color:red"> * </span>            	
		            	<div class="controls">
							<?php echo form_dropdown('voucher_id', $vouchers, set_value('voucher_id',$voucher_id), 'id="voucher_id" class="form_input radius4 required" onChange="select_voucher();"'); ?>
						 </div>
					 </div>
					 					 					 
					
					<div class="control-group">
		             	 <label class="control-label" for="payment"><?php echo lang('payment');?></label> <span style="color:red"> * </span>           	
		            	<div class="controls">
							<?php
							$options = array(	'Credit'	=> 'Credit',
												'Point'	=> 'Point'
							                );
							echo form_dropdown('payment', $options, set_value('payment'), 'id="payment" class="form_input radius4 required" onChange="select_voucher();"');
							?>							
						 </div>
					 </div>
					
					 
					 <div class="control-group">
		             	 <label class="control-label" for="consume_amount"><?php echo lang('consume_amount');?></label>  <span style="color:red"> * </span>          	
		            	<div class="controls">
							<input type="text" name="consume_amount" id="consume_amount" value="<?php echo set_value('consume_amount') ?>" class="form_input radius4 required" readonly/>							
						 </div>
					 </div>
					 
					 
					 <div class="control-group">
		             	 <label class="control-label" for="remark"><?php echo lang('remark');?></label>  <span style="color:red"> * </span>          	
		            	 <div class="controls">
							<textarea name="remark" class="form_input radius4" id="remark"><?php echo set_value('remark') ?></textarea>
						 </div>
					 </div>
					 
					 
					 				
					<input type="hidden" value="submitted" name="submitted"/>
					<input type="hidden" value="<?php echo $customer_id ?>" name="customer_id"/>
					 
					<div class="control-group">
							<label class="control-label" for="submit"></label>
							<div class="controls">
								<input type="submit" value="<?php echo lang('submit');?>" name="submit" class="form_submit radius4 red red_borderbottom"/>
							</div>
					</div>
					
					<div style="height:50px;"></div>
					
	         	</div>
	         	</form>
	    </div>
	</div> 
</div>
