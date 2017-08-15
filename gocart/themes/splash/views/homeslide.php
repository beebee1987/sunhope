<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>

		<div class="sliderbg ">
			<div class="pages_container">
				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>			
				
				  <!-- SlidesJS Required: Start Slides -->
				  <!-- The container is used to define the width of the slideshow -->
				  <div class="container">
				    <div id="slides">
				    <?php foreach($sliders as $slider):?>
	        			<img src="<?php echo base_url($slider['image'])?>" alt="" title=""/> 
	        		<?php endforeach;?>
				    <!--img src="<?php echo theme_img('banner0.jpg')?>" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/"-->				      
				    </div>
				  </div>
				  <!-- End SlidesJS Required: Start Slides -->
				
				<a href="<?php echo site_url('my_card') ?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">My Membership Card</div>	            
            	</div>
            	</a>
            	
            	
            	<?php if((isset($companies[0]['phone']) && !empty($companies[0]['phone']))){?>
            	<a href="tel:<?php echo $companies[0]['phone']?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page"><?php echo $companies[0]['phone'] ?></div>	            
            	</div>
            	</a>
            	<?php }?>
				
				<?php if((isset($companies[0]['address']) && !empty($companies[0]['address']))){?>
				<a style="cursor: pointer;" onclick="myNavFunc('<?php echo $companies[0]['gps']?>')">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page"><?php echo $companies[0]['address']?></div>	            
            	</div>
            	</a>
            	<?php }?>
            	
            	<a href="<?php echo site_url('company_details')?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">More Details</div>	            
            	</div>
            	</a>
				
			</div>
		</div>
	</div>
</div>

<script>
function myNavFunc(){
    // If it's an iPhone..
    if( (navigator.platform.indexOf("iPhone") != -1) 
        || (navigator.platform.indexOf("iPod") != -1)
        || (navigator.platform.indexOf("iPad") != -1))
         window.open("maps:https://goo.gl/maps/iEZ5l");
    else
         window.open("https://goo.gl/maps/iEZ5l");
}
</script>
