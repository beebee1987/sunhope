<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>

		<div class="sliderbg">
			<div class="pages_container">
				<h2 class="page_title">Photo Gallery</h2>
				<ul class="photo_gallery_13_round">
										
					<?php foreach($rs_gallery as $gallery):?>
				
					<li>
					<a rel="gallery-3" href="<?php echo base_url('/uploads/'.$gallery['image']) ?>" title="<?php echo $gallery['title']?>" class="swipebox">
						<img src="<?php echo base_url('/uploads/'.$gallery['image']) ?>" alt="image" />
					</a>
					</li>
				
					<?php endforeach;?>
				
					
				</ul>
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
