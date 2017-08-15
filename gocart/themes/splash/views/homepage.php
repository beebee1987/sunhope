<div id="wrapper">

    <div id="content">
      
      <?php       		
      		$background_customise = isset($setting['image_background']) ? base_url($setting['image_background']) : '';
      		$background_color_customise = isset($setting['color_background']) ? '#'.$setting['color_background'] : '';
      		$own_logo = isset($profile['image']) ? $profile['image'] : theme_img('/logo.png');
      ?>
      <div class="sliderbg_menu" style="background: url(<?php echo $background_customise ?>) no-repeat center center fixed;background-attachment:fixed; -webkit-background-size: 100%; -moz-background-size: 100%;-o-background-size: 100%;background-size: 100%;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;min-height:100%;background-color:<?php echo $background_color_customise ?>;">
              
        <div class="logo"><a href="#">
	      	<img src="<?php echo $own_logo ?>" alt="" title="" border="0" /><span></span></a>
	      	<p><?php echo !empty($profile['display_name']) ? $profile['display_name'] : ''?></p>
        </div>          
        
        <nav id="menu">
        <ul>
        <li><a href="<?php echo base_url("about");?>"><img src="<?php echo theme_img('icons/about.png')?>" alt="" title="" /><span>About Us</span></a></li>
        <?php if(!empty($profile['service'])): ?>
        	<li><a href="<?php echo base_url("services");?>"><img src="<?php echo theme_img('icons/tools.png')?>" alt="" title="" /><span>Services</span></a></li>
        <?php endif;?>
        <!--li><a href="<?php echo base_url("blog");?>"><img src="<?php echo theme_img('icons/blog.png')?>" alt="" title="" /><span>Blog</span></a></li-->
        <?php if(!empty($profile['portfolio'])): ?>
        	<li><a href="<?php echo base_url("portfolio");?>"><img src="<?php echo theme_img('icons/docs.png')?>" alt="" title="" /><span>Portfolio</span></a></li>
        <?php endif;?>
        <li><a href="<?php echo base_url("gallery");?>"><img src="<?php echo theme_img('icons/photos.png')?>" alt="" title="" /><span>Gallery</span></a></li>
        <!--li><a href="<?php echo base_url("videos");?>"><img src="<?php echo theme_img('/icons/videos.png') ?>" alt="" title="" /><span>Videos</span></a></li-->
        <?php if(!empty($profile['clients'])): ?>
        	<li><a href="<?php echo base_url("clients");?>"><img src="<?php echo theme_img('icons/clients.png')?>" alt="" title="" /><span>Clients</span></a></li>
        <?php endif;?>
        <!--li><a href="<?php echo base_url("twitter");?>"><img src="<?php echo theme_img('icons/twitter.png')?>" alt="" title="" /><span>Twitter</span></a></li-->
        <li><a href="<?php echo base_url("contact_us");?>"><img src="<?php echo theme_img('icons/contact.png')?>" alt="" title="" /><span>Contact</span></a></li>        
        
        <?php 
			if(isset($this->pages)){	
			
			foreach($this->pages[0] as $menu_page):
			
			$icon_default = !empty($menu_page->menu_default_icon) ? theme_img($menu_page->menu_default_icon) : theme_img('icons/layout.png');
			$icon_customise = isset($menu_page->menu_icon) ? base_url($menu_page->menu_icon) : $icon_default;
			?>
				<li><a href="<?php echo (!empty($menu_page->slug) && isset($menu_page->slug)) ? site_url($menu_page->slug) : $menu_page->url;?>" <?php if($menu_page->new_window ==1):{echo 'target="_blank"';} ?>> <img src="<?php echo $icon_customise ?>" alt="" title="" /> <span> <?php echo $menu_page->menu_title;?> </span></a> <?php else:?> <a href="<?php echo site_url($menu_page->slug);?>"> <img src="<?php echo $icon_customise ?>" width="112px" height="112px" alt="" title="" />  <span><?php echo $menu_page->menu_title;?></span> <?php endif; ?> </a></li>				
			<?php endforeach;} ?>
        
        </ul>
        </nav>
       <div class="clear"></div>  
     
     </div>
         
    </div>
</div>