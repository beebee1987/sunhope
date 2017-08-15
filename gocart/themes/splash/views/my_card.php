<div id="wrapper">

	    <div id="content">
	            <?php $this->load->view('header_menu'); ?>   
	                        
	       <div class="sliderbg ">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo $page_title?></h2>
	             <p>
	                 <div class="member_card_label">
	                 	<img src="<?php echo base_url($image_card)?>" alt="member-card" class="image-card" style="width:450px; height:auto" />
	                 	<h2><span><?php echo $customer['card']?></span></h2>
	                 </div>                       
	             </p>
	             <center><p>E - Member Card: <?php echo $customer['card']?></p></center>
	             <center><p>E - Member Card, easier carrier and never lost it.</p></center>
	             <p>
	             	<a href="<?php echo site_url('top_up_credit_qrcode')?>" class="button_11 green green_borderbottom radius4"><i class="card_icon"><img src="<?php echo theme_img('credit.png')?>"></i>Top Up Credit</a>  
	             	<a href="<?php echo site_url('deduct_credit_qrcode')?>" class="button_11 bluegreen bluegreen_borderbottom radius4"><i class="card_icon"><img src="<?php echo theme_img('credit.png')?>"></i>Deduct Credit</a>
	             	<a href="<?php echo site_url('top_up_point_qrcode')?>" class="button_11 red red_borderbottom radius4"><i class="card_icon"><img src="<?php echo theme_img('point-1.png')?>"></i>Top Up Point</a>  
	             	<a href="<?php echo site_url('deduct_point_qrcode')?>" class="button_11 orange orange_borderbottom radius4"><i class="card_icon"><img src="<?php echo theme_img('point-1.png')?>"></i>Deduct Point</a>
	             	<a href="<?php echo site_url('consumption_qrcode')?>" class="button_11 blue blue_borderbottom radius4"><i class="card_icon"><img src="<?php echo theme_img('credit.png')?>" width="35px" height="35px"><img src="<?php echo theme_img('point-1.png')?>"></i>Consumption</a>
	             </p>
				 <div class="clearfix"></div>	             
	             
	            <a href="<?php echo site_url('membership_promotion') ?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Promotion</div>	            
            	</div>
            	</a>
            	
            	<!--a href="#">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Privilege</div>	            
            	</div>
            	</a-->
            	
            	<a href="<?php echo site_url('news') ?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">News</div>	            
            	</div>
            	</a>
            	
	            <a href="<?php echo site_url('secure/my_account')?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Personal Detail</div>	            
            	</div>
	            </a>
	            
	            <a href="<?php echo site_url('member_center')?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Card Detail</div>	            
            	</div>
            	</a>
            	
            	<a href="<?php echo site_url('company_details')?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">Company Detail</div>	            
            	</div>
            	</a>
            	
	         </div>
	    </div>
	</div> 
</div>