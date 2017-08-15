<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">
				<?php if ($this->session->flashdata('message')):?>
				<div class="alert alert-success">
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif;?>
			
				<?php if ($this->session->flashdata('error')):?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('error');?>
					</div>
				<?php endif;?>
			
				<?php if (!empty($error)):?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
				<?php endif;?>
				
				<div class="control-group">						
						<div class="controls">
							<center><img src="<?php echo theme_img('logo.png')?>"></center>
						</div>
				</div>
				
				<h2 class="page_title"><?php echo lang('login');?></h2>
				
				
				<?php echo form_open('secure/login', 'class="form-horizontal"'); ?>
				<fieldset>
				
					
				
					<!--div class="control-group">
						<label class="control-label" for="email"><?php echo lang('email');?></label>
						<div class="controls">
							<input type="text" name="email" class="form_input radius4 required"/>
						</div>
					</div-->
					<div class="control-group">
						<label class="control-label" for="phone"><?php echo lang('phone');?></label>
						<div class="controls">
							<input type="text" name="phone" class="form_input radius4 required"/>
							<p>eg: 60126668888</p>
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label" for="password"><?php echo lang('password');?></label>
						<div class="controls">
							<input type="password" name="password" class="form_input radius4 required" autocomplete="off" />
						</div>
					</div>
				
					<!--div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<label class="checkbox">
								<input name="remember" value="true" type="checkbox" />
								 <?php echo lang('keep_me_logged_in');?>
							</label>
						</div>
					</div-->
					<div class="control-group">
						<label class="control-label" for="password"></label>
						<div class="controls">
							<input type="submit" value="<?php echo lang('form_login');?>" name="submit" class="form_submit radius4 red red_borderbottom"/>
						</div>
					</div>
				</fieldset>
				
				<input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
				<input type="hidden" value="submitted" name="submitted"/>
				<input type="hidden" value="true" name="remember" />
				
			</form>
		
			<div class="label_instruction">
				<a href="<?php echo site_url('secure/forgot_password'); ?>"><?php echo lang('forgot_password')?></a> | <a href="<?php echo site_url('secure/register'); ?>"><?php echo lang('register');?></a>
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

