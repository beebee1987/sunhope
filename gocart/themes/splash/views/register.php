<?php
$company	= array('id'=>'bill_company', 'class'=>'form_input radius4 required', 'name'=>'company', 'value'=> set_value('company'));
$name		= array('id'=>'bill_name', 'class'=>'form_input radius4 required', 'name'=>'name', 'value'=> set_value('name'));
$email		= array('id'=>'bill_email', 'class'=>'form_input radius4 required', 'name'=>'email', 'value'=>set_value('email'));
$phone		= array('id'=>'bill_phone', 'class'=>'form_input radius4 required', 'name'=>'phone', 'value'=> set_value('phone'));
?>


<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">				
			 	
			 	<h2 class="page_title"><?php echo lang('form_register');?></h2>			
				<?php $this->load->view('error_message'); ?>   
				
				<?php echo form_open('secure/register'); ?>
					<input type="hidden" name="submitted" value="submitted" />
					<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		
					<fieldset>
						
						<div class="row">	
							<div class="span3">
								<label for="account_name"><?php echo lang('account_name');?></label>
								<?php echo form_input($name);?>
							</div>													
						</div>
					
						<div class="row">
							<div class="span3">
								<label for="account_email"><?php echo lang('account_email');?></label>
								<?php echo form_input($email);?>								
							</div>
						
							<div class="span3">
								<label for="account_phone"><?php echo lang('account_phone');?></label>
								<?php echo form_input($phone);?>
								<p>eg: 60126668888</p>
							</div>
						</div>
					
						<div class="row">
							<div class="span7">
								<label class="checkbox">
									<input type="checkbox" name="email_subscribe" value="1" <?php echo set_radio('email_subscribe', '1', TRUE); ?>/> <?php echo lang('account_newsletter_subscribe');?>
								</label>
							</div>
						</div>
					
						<div class="row">	
							<div class="span3">
								<label for="account_password"><?php echo lang('account_password');?></label>
								<input type="password" name="password" value="" class="form_input radius4 required" autocomplete="off" />
							</div>
		
							<div class="span3">
								<label for="account_confirm"><?php echo lang('account_confirm');?></label>
								<input type="password" name="confirm" value="" class="form_input radius4 required" autocomplete="off" />
							</div>
						</div>
						
						<input type="submit" value="<?php echo lang('form_register');?>" class="form_submit radius4 red red_borderbottom" />
					</fieldset>
				</form>
			
				<div class="label_instruction">
					<a href="<?php echo site_url('secure/login'); ?>"><?php echo lang('go_to_login');?></a>
				</div>				
			
			
				<div class="clearfix"></div>
				<div class="scrolltop radius20">
					<a
						onClick="jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );"
						href="javascript:void(0);"><img
						src="<?php echo theme_img('/icons/top.png') ?>" alt="Go on top"
						title="Go on top" />
					</a>
				</div>
			</div>
			<!--End of page container-->
		</div>
	</div>
</div>
