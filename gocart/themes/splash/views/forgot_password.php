<div id="wrapper">

	    <div id="content">
	            <?php $this->load->view('header_menu'); ?>   
	                        
	       <div class="sliderbg ">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo lang('forgot_password');?></h2>
	             
	             <?php $this->load->view('error_message'); ?>   
	             
	            <?php echo form_open('secure/forgot_password', 'class="form-horizontal"') ?>
				<fieldset>
				
					<div class="control-group">
						<label class="control-label" for="email"><?php echo lang('email');?></label>
						<div class="controls">
							<input type="text" name="email" class="form_input radius4 required"/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<input type="hidden" value="submitted" name="submitted"/>
							<input type="submit" value="<?php echo lang('reset_password');?>" name="submit" class="form_submit radius4 red red_borderbottom"/>
						</div>
					</div>
				</fieldset>
				</form>
				<div class="label_instruction">
					<a href="<?php echo site_url('secure/login'); ?>" class="label_instruction"><?php echo lang('return_to_login');?></a>
				</div>
            	             	 
	         </div>
	       </div>
	</div> 
</div>