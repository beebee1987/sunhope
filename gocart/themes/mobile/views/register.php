<?php
$company	= array('id'=>'bill_company', 'class'=>'span6', 'name'=>'company', 'value'=> set_value('company'));
$name		= array('id'=>'bill_name', 'class'=>'span3', 'name'=>'name', 'value'=> set_value('name'));
$email		= array('id'=>'bill_email', 'class'=>'span3', 'name'=>'email', 'value'=>set_value('email'));
$phone		= array('id'=>'bill_phone', 'class'=>'span3', 'name'=>'phone', 'value'=> set_value('phone'));
?>


<div class="content">
	
		<div class="page-header">
			<h1><?php echo lang('form_register');?></h1>
		</div>
		
		<?php echo form_open('secure/register', 'class="content-padded" name="register_form" id="register_form"'); ?>
			<input type="hidden" name="submitted" value="submitted" />
			<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
	
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
					</div>
				</div>
			
				<div class="row">
					<div class="span7">
						<label class="checkbox">
							<input type="checkbox" name="email_subscribe" value="1" <?php echo set_radio('email_subscribe', '1', TRUE); ?>/> <?php echo lang('account_newsletter_subscribe');?>
						</label>
					</div>
				</div>
			
				<!--div class="row">	
					<div class="span3">
						<label for="account_password"><?php echo lang('account_password');?></label>
						<input type="password" name="password" value="" class="span3" autocomplete="off" />
					</div>

					<div class="span3">
						<label for="account_confirm"><?php echo lang('account_confirm');?></label>
						<input type="password" name="confirm" value="" class="span3" autocomplete="off" />
					</div>
				</div-->
				
				<!--input type="submit" value="<?php echo lang('form_register');?>" data-ignore="push" class="btn btn-primary btn-block" /-->								
		</form>
		
		 <button class="btn btn-primary btn-block" id="save">Save</button>
	
		<div style="text-align:center;">
			<a href="<?php echo site_url('secure/login'); ?>"><?php echo lang('go_to_login');?></a>
		</div>
	
</div>