
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>
								
				<?php echo form_open('cart/process_voucher/'.$customer_id.'/'.$voucher_id, 'class="form-horizontal"'); ?>
	            
		           
		             		             
		            <?php $this->load->view('error_message'); ?>   
		             		             
		             <!-- This is Branch retrieve from Database -->
		             <!--div class="control-group">
							 <label class="control-label" for="staff_branch"><?php echo lang('staff_branch');?></label>
				             <div class="controls">
								<input type="text" name="staff_branch" value="<?php echo set_value('staff_branch') ?>" class="form_input radius4 required"/>							
							 </div>
		             </div-->
		             
		             <div class="control-group">
		             	 <label class="control-label" for="staff_username"><?php echo lang('staff_username');?></label>
			             <div class="controls">
							<input type="text" name="staff_username" class="form_input radius4 required"/>							
						 </div>
	            	 </div>
	            	 	            	 
	            	<div class="control-group">
		             	 <label class="control-label" for="staff_password"><?php echo lang('staff_password');?></label>
		            	<div class="controls">
							<input type="password" name="staff_password" class="form_input radius4 required"/>							
						</div>
	            	</div>
	            	            	
	            	<hr/>
	            	
	            	<div class="control-group">
		             	 <label class="col-sm-2 control-label" for="voucher_name"><?php echo lang('voucher_name');?></label>            	
		            	<div class="controls">
							<?php echo '<div class="col-sm-10">'.form_dropdown('voucher_id', $vouchers, set_value('voucher_id',$voucher_id), 'id="voucher_id" class="form_input radius4 required"').'</div>';; ?>							
						 </div>
					</div>
						  						  
					 <div class="control-group"><label class="control-label"><?php echo lang('card');?></label>
							<div class="controls">		
								<b><?php echo $customer['card']?></b>
							</div>
					 </div>
	            	            	
	            	 <div class="control-group">
		             	 <label class="control-label" for="customer_name"><?php echo lang('customer_name');?></label>            	
		            	<div class="controls">							
							<b><?php echo $customer['name']?></b>						
						 </div>
					 </div>
					 
					 <div class="control-group">
		             	 <label class="control-label" for="used_qty"><?php echo lang('used_qty');?></label>            	
		            	<div class="controls">
							<input type="text" name="used_qty" value="<?php echo set_value('used_qty') ?>" class="form_input radius4 required"/>							
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
	         	
	         	</form>
				
				<div class="clearfix"></div>
				<div class="scrolltop radius20">
					<a
						onClick="jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );"
						href="javascript:void(0);"><img
						src="<?php echo theme_img('/icons/top.png') ?>" alt="Go on top"
						title="Go on top" /> </a>
				</div>
			</div>
			<!--End of page container-->
		</div>
	</div>



</div>  



