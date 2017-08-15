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
				<h2 class="page_title">Get in touch</h2>
				<h2 id="Note"></h2>
				<div class="form">
					<?php echo form_open('cart/contact_us', 'class="cmxform" id="CommentForm"'); ?>												
						<label>Name:</label> <input type="text" name="name"
							id="ContactName" value="<?php echo set_value('name')?>" class="form_input radius4 required" />
						<label>Email:</label> <input type="text" name="email_address"
							id="ContactEmail" value="<?php echo set_value('email_address')?>"
							class="form_input radius4 required email" /> 
						<label>Telephone number:</label>
						<input type="text" name="telephone_number"
							id="telephone_number" value="<?php echo set_value('telephone_number')?>"
							class="form_input radius4 required" />		
						<label>Message:</label>
						<textarea name="comment" id="ContactComment"
							class="form_textarea radius4 textarea required" rows="" cols=""><?php echo set_value('comment')?></textarea>
						<input type="submit" name="submit"
							class="form_submit radius4 green green_borderbottom" id="submit"
							value="Send" /> 
							<input class="" type="hidden" name="submitted"
							value="bbbooogggs@gmail.com" />							
						</label>
					</form>
				</div>

				<h2>Address</h2>
				<a class="address_block ">
				<?php echo $profile['address']?>
				</a>
				
				<h2>Let's socialize</h2>
				<ul class="social">
					<?php if(!empty($profile['facebook'])):?>
					<li class="social_facebook"><a href="<?php echo $profile['facebook']?>" target="_blank"><img
							src="<?php echo theme_img('/icons/social/facebook.png') ?>"
							alt="" title="" border="0" />
					</a>
					<?php endif;?>
					</li>
					<?php if(!empty($profile['twitter'])):?>
					<li class="social_twitter"><a href="<?php echo $profile['twitter']?>" target="_blank"><img
							src="<?php echo theme_img('/icons/social/twitter.png') ?>" alt=""
							title="" border="0" />
					</a>
					</li>
					<?php endif;?>
					<?php if(!empty($profile['google_plus'])):?>
					<li class="social_google"><a href="<?php echo $profile['google_plus']?>" target="_blank"><img
							src="<?php echo theme_img('/icons/social/google.png') ?>" alt=""
							title="" border="0" />
					</a>
					</li>
					<?php endif;?>
					<?php if(!empty($profile['pinterest'])):?>
					<li class="social_pinterest"><a href="<?php echo $profile['pinterest']?>" target="_blank"><img
							src="<?php echo theme_img('/icons/social/pinterest.png') ?>"
							alt="" title="" border="0" />
					</a>
					
					<?php endif;?>
				</ul>
				<h2>Give Us a call</h2>
					<?php if(!empty($profile['mobile'])):?>
						<a href="tel:<?php echo $profile['mobile']?>" class="call_button radius8">Click To Call
					Now!</a>
					<?php endif;?> 
					
					<?php if(!empty($profile['location'])):?>
						<a href="<?php echo $profile['location']?>" target="_blank"
						class="map_button radius8">View our location</a>
					<?php endif; ?>
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
