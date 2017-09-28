<?php include('login_header.php'); ?>

<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <!--h1 class="logo-name">Red Merchant</h1-->
				
				    <?php
				    //lets have the flashdata overright "$message" if it exists
				    if($this->session->flashdata('message'))
				    {
				        $message    = $this->session->flashdata('message');
				    }
				    
				    if($this->session->flashdata('error'))
				    {
				        $error  = $this->session->flashdata('error');
				    }
				    
				    if(function_exists('validation_errors') && validation_errors() != '')
				    {
				        $error  = validation_errors();
				    }
				    ?>
				    
				    <div id="js_error_container" class="alert alert-error" style="display:none;"> 
				        <p id="js_error"></p>
				    </div>
				    
				    <div id="js_note_container" class="alert alert-note" style="display:none;">
				        
				    </div>
				    
				    <?php if (!empty($message)): ?>
				        <div class="alert alert-success alert-dismissable">
				           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
				            <?php echo $message; ?>
				        </div>
				    <?php endif; ?>
				
				    <?php if (!empty($error)): ?>
				        <div class="alert alert-danger alert-dismissable">
				           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
				            <?php echo $error; ?>
				        </div>
				    <?php endif; ?>
				
            <img src="<?php echo base_url('assets/img/logo.png');?>" width="120px">
            
            </div>
            <h3>Welcome to Sunhope Industry Sdn Bhd</h3>
            <p>Login in</p>
            <?php echo form_open($this->config->item('admin_folder').'/login') ?>
                <div class="form-group">
                    <label for="username"><?php echo lang('username');?></label>
                    <?php echo form_input(array('name'=>'username', 'class'=>'form-control', 'placeholder="Username"')); ?>                                        
                </div>
                <div class="form-group">
                	<label for="password"><?php echo lang('password');?></label>
                    <?php echo form_password(array('name'=>'password', 'class'=>'form-control', 'placeholder="Password"')); ?>                                        
                </div>
                
                <input class="btn btn-primary block full-width m-b" type="submit" value="<?php echo lang('login');?>"/>

                 <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
        		 <input type="hidden" value="submitted" name="submitted"/>
                
                <!--a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a-->
            <?php echo  form_close(); ?>
            <p class="m-t"> <small>Sun Hope Industry &copy; <?php echo date("Y"); ?></small> </p>
        </div>
</div>
    
    

<?php include('login_footer.php'); ?>