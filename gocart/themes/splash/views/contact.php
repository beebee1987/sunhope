<section id="page-tree">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-5">
				<h1>Contact</h1>
			</div>
		</div><!--row-->
	</div><!--container-->
</section><!--page-tree-->
	
	<?php if ($this->session->flashdata('message')):?>
	<div class="alert alert-info">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $this->session->flashdata('message');?>
		</div>
	<?php endif;?>

	<?php if ($this->session->flashdata('error')):?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $this->session->flashdata('error');?>
		</div>
	<?php endif;?>

	<?php if (!empty($error)):?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">X</a>
			<?php echo $error;?>
		</div>
	<?php endif;?>	

     <!--google map-->
    <div id="map-canvas" class="carousel"></div>
	<!--google map end-->
	
    <div class="divied-60"></div>
	<div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Get in touch</h3>
                    <p class="margin-btm40">
                        Thanks for your interest in our services. Please fill out the email form, submit and we will get back to you soon. 
                    </p>
					<?php echo form_open('cart/contact'); ?>                    
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name*</label>
                                        <input name="name" id="name" type="text" required class="form-control" value="<?php echo set_value('name')?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input name="email" id="email" type="email" required class="form-control" value="<?php echo set_value('email')?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input name="subject" id="subject" type="text" required class="form-control" value="<?php echo set_value('subject')?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Message*</label>
                                        <textarea name="message" class="form-control" required rows="6"><?php echo set_value('message')?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-dark btn-lg">Send Message</button>
									<input type="hidden" value="submitted" name="submitted"/>	
                                </div>
                            </div>
                        </form><!--Contact form-->
                </div>
                <div class="col-md-4">
                    <h3>Contact info</h3>                   
                    <ul class="list-unstyled contact-list margin-btm20">
                        <li><i class="ion-home"></i> 27D2-1-3 Condo Miharja Taman Miharja Jalan Palong 55200 Cheras Kuala Lumpur</li>
                        <li><i class="ion-ios7-telephone"></i> <strong>Phone:</strong> +6012-7029138</li>
                        <li><i class="ion-ios7-email"></i> <strong>Email:</strong> oracksoftware@gmail.com</li>
                        <li><i class="ion-ios7-world"></i> <strong>Website:</strong> http://www.orack.com.my/</li>
                    </ul>
                    <!--h3>Social Connect</h3>
                    <ul class="list-unstyled list-inline social">
                        <li><a href="#"><i class="ion-social-facebook-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Like On Facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow On twitter"></i></a></li>
                        <li><a href="#"><i class="ion-social-googleplus-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow On googleplus"></i></a></li>
                        <li><a href="#"><i class="ion-social-pinterest-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="pinterest"></i></a></li>
                        <li><a href="#"><i class="ion-social-skype-outline" data-toggle="tooltip" data-placement="top" title="" data-original-title="skype"></i></a></li>

                    </ul-->
                </div>
            </div>
        </div><!--Contact container end-->
        <div class="divied-60"></div>
	

