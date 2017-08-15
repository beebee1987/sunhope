<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>

		<div class="sliderbg ">
			<div class="pages_container">
				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<p>								
				<div class="member_card_label">
					<img src="<?php echo base_url($image_card)?>" alt="member-card" class="image-card" style="width:450px; height:auto" />
					<h2><span><?php echo $customer['card']?></span></h2>
				</div>
				</p>
				<center><p>E - Member Card: <?php echo $customer['card']?></p></center>
				<center><p>E - Member Card, easier carrier and never lost it.</p></center>
				

				<p>
				
				
				<ul class="responsive_table">
					<li class="table_row">
						<div class="table_section">
							<center>
								Consumer Records
								<?php 
									//echo format_currency($customer_credits['total_consumption']) 	
									echo $customer_credits['total_consumption'] > 0 ? $customer_credits['total_consumption'] : '0.00';
								?>
							</center>
						</div>
						<div class="table_section">
							<center>
								Remaining Points
								<?php echo $customer_points['point_amt'] > 0 ? $customer_points['point_amt'] : '0.00' ?>
								Point
							</center>
						</div>
						<div class="table_section">
							<center>My Balance <?php echo $customer_credits_remain['credit_amt'] > 0 ? $customer_credits_remain['credit_amt'] : '0.00' ?> </center>
						</div>
					</li>
				</ul>

				</p>
				<div class="clearfix"></div>
				
				<a href="<?php echo site_url('my_coupons')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">My Coupons</div>	            
	            	</div>
            	</a>
            	
            	<a href="<?php echo site_url('my_vouchers')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">My Vouchers</div>	            
	            	</div>
            	</a>
				
				<a href="<?php echo site_url('transaction_record')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">Transaction Record</div>	            
	            	</div>
            	</a>
            	
            	
            	<!-- Earn Point need discuss again -->
            	<!--a href="#">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">Sign Earn Points</div>	            
	            	</div>
            	</a-->
				
				<a href="<?php echo site_url('secure/my_account')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">Personal Details</div>	            
	            	</div>
            	</a>

            	<a href="<?php echo site_url('details')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">Membership Card Detail</div>	            
	            	</div>
            	</a>
            	
            	<a href="<?php echo site_url('company_details')?>">
		            <div class="toogle_wrap radius8">
		                <div class="go_next_page">Company Contact</div>	            
	            	</div>
            	</a>

			</div>
		</div>
	</div>
</div>
