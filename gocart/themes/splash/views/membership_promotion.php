<div class="loading"></div>
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>
				
				
				<div id="tabs">
					  <ul>
					    <li><a href="#tabs-1"><?php echo lang('coupons') ?></a></li>
					    <li><a href="#tabs-2"><?php echo lang('vouchers')?></a></li>					    
					  </ul>
					  <div id="tabs-1">
					    <?php echo (count($coupons) < 1)?'<p>'.lang('no_coupons').'</p>':''?>
							<?php foreach ($coupons as $coupon):?>
							
							<div class="portfolio_item radius8">
								<div class="portfolio_image">
									<a rel="gallery-1" href="<?php echo base_url($coupon->image)?>"
										class="swipebox" title="<?php echo $coupon->name?>"><img
										src="<?php echo base_url($coupon->image)?>" alt="" title="" border="0" /> </a>
															
									<div class="controls">
											<input type="button" value="<?php echo lang('click_button');?>" name="click_button" href="javascript: void(0);" onclick="javascript: add_coupon('<?php echo $coupon->id ?>', '<?php echo $customer_id ?>');"  class="form_submit radius4 red red_borderbottom"/>
									</div>																								
								</div>
								<div class="portfolio_details">
									<p><?php echo $coupon->name ?>( <?php echo $coupon->code ?> )</p>
									<p><?php echo $coupon->desc ?></p>						
									<a rel="gallery-2" href="<?php echo base_url($coupon->image)?>"
										class="swipebox view_details" title="Webdesign work">view details</a>
								</div>
							</div>
							
						<?php endforeach; ?>
					  </div>
					  <div id="tabs-2">
					      <?php echo (count($vouchers) < 1)?'<p>'.lang('no_vouchers').'</p>':''?>
							<?php foreach ($vouchers as $voucher):?>
							
							<div class="portfolio_item radius8">
								<div class="portfolio_image">
									<a rel="gallery-1" href="<?php echo base_url($voucher->image)?>"
										class="swipebox" title="<?php echo $voucher->name?>"><img
										src="<?php echo base_url($voucher->image)?>" alt="" title="" border="0" /> </a>
															
									<div class="controls">
											
											<input type="button" value="<?php echo lang('click_button');?>" name="click_button" onclick="javascript:go_consumption_qrcode('<?php echo $encrypt ?>', '<?php echo $customer_id ?>', '<?php echo $voucher->id ?>')" class="form_submit radius4 red red_borderbottom"/>
									</div>
								</div>
								<div class="portfolio_details">
									<p><?php echo $voucher->name ?>( <?php echo $voucher->code ?> )</p>
									<p><?php echo $voucher->desc ?></p>						
									<a rel="gallery-2" href="<?php echo base_url($voucher->image)?>"
										class="swipebox view_details" title="Webdesign work">view details</a>
								</div>
							</div>
							
						<?php endforeach; ?>
					  </div>					  
				</div>
				
				
				
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
<script type="text/javascript">
//function to add in voucher to users
function add_voucher(voucherID, customerID)
{
	$('.loading').fadeIn('slow');
	//console.log('voucherID: ' + voucherID + 'customerID: ' + customerID);
	
	$.post("<?php echo site_url('cart/add_voucher'); ?>", {
		voucher_id : voucherID,
		customer_id : customerID,		
		},
		function(data) {
		    $('.loading').fadeOut('slow');		   
		    if(data == 1){
		    	alert('Added Successful');
		    }else{
		    	alert('You have got it!');
		    }	 		    
		});		
}
function add_coupon(couponID, customerID)
{
	if (confirm('<?php echo lang('confirm_add_coupon')?>')) {
		$('.loading').fadeIn('slow');
		
		$.post("<?php echo site_url('cart/add_coupon'); ?>", {
			coupon_id : couponID,
			customer_id : customerID,		
			},
			function(data) {
			    $('.loading').fadeOut('slow');	
				console.log(data);

			    	   
			    if(data == 1){
			    	alert('Added Successful');
			    }else{
			    	alert('You have got it!');
			    }	 		    
			});		
	}

	
	
}
</script>
