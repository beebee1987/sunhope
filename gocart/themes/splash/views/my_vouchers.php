
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
					<li><a href="#tabs-1"><?php echo lang('unused')?></a></li>					    
					<li><a href="#tabs-2"><?php echo lang('used') ?></a></li>					    
				</ul>
				<div id="tabs-1">
				<?php echo (count($vouchers) < 1)?'<p>'.lang('no_vouchers').'</p>':''?>
				<?php 
					$count_unused = 0;
					foreach ($vouchers as $voucher):
						if($voucher->used < $voucher->qty):
							$count_unused++;
				?>
				
				<div class="portfolio_item radius8">
					<div>
						<label><?php echo lang('you_got_voucher_qty')?>: <?php echo $voucher->qty ?></label>
					</div>
					<div>
						<label><?php echo lang('you_used_voucher_qty')?>: <?php echo $voucher->used ?></label>
					</div>	
					<div>
						<label><?php echo lang('qty_left')?>: <?php echo $voucher->qty - $voucher->used ?></label>
					</div>				
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo base_url($voucher->image)?>"
							class="swipebox" title="<?php echo $voucher->name?>"><img
							src="<?php echo base_url($voucher->image)?>" alt="" title="" border="0" /> </a>
												
						<div class="controls">
							<input type="button" value="<?php echo lang('use_button');?>" name="click_button" href="javascript: void(0);" onclick="javascript: process_voucher_qrcode('<?php echo $customer_id ?>', '<?php echo $voucher->id ?>');"  class="form_submit radius4 red red_borderbottom"/>
						</div>	
					</div>
					<div class="portfolio_details">
						<p><?php echo $voucher->name ?>( <?php echo $voucher->code ?> )</p>
						<p><?php echo $voucher->desc ?></p>						
						<a rel="gallery-2" href="<?php echo base_url($voucher->image)?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>
				
				<?php
						endif; 
					endforeach; 
					if(count($vouchers) >= 1 && $count_unused == 0)
						echo '<p>'. lang('no_vouchers') .'</p>';
				?>
				</div>
				
				<div id="tabs-2">
				<?php echo (count($vouchers) < 1)?'<p>'.lang('no_vouchers').'</p>':''?>
				<?php 
					$count_used = 0;
					foreach ($vouchers as $voucher):
						if($voucher->used >= $voucher->qty):
							$count_used++;
				?>
				
				<div class="portfolio_item radius8">
					<div>
						<label><?php echo lang('you_got_voucher_qty')?>: <?php echo $voucher->qty ?></label>
					</div>
					<div>
						<label><?php echo lang('you_used_voucher_qty')?>: <?php echo $voucher->used ?></label>
					</div>	
					<div>
						<label><?php echo lang('qty_left')?>: <?php echo $voucher->qty - $voucher->used ?></label>
					</div>		
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo base_url($voucher->image)?>"
							class="swipebox" title="<?php echo $voucher->name?>"><img
							src="<?php echo base_url($voucher->image)?>" alt="" title="" border="0" /> </a>
												
						
					</div>
					<div class="portfolio_details">
						<p><?php echo $voucher->name ?>( <?php echo $voucher->code ?> )</p>
						<p><?php echo $voucher->desc ?></p>						
						<a rel="gallery-2" href="<?php echo base_url($voucher->image)?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>
				
				<?php
						endif; 
					endforeach; 
					if(count($vouchers) >= 1 && $count_used == 0)
						echo '<p>'. lang('no_vouchers') .'</p>';
				?>
				
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

