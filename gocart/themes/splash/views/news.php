
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<?php echo (count($latest_news) < 1)?'<p>'.lang('no_news').'</p>':''?>
				<?php foreach($latest_news as $new):?>
				
				<div class="toogle_wrap radius8">
	                <div class="trigger"><a href="#"><?php echo $new['title'] ?></a></div>
	            
	                <div class="toggle_container">
	                <p>
	            		<?php echo $new['content'] ?>
	                </p>
	                </div>
	            </div>
	            
	            <?php endforeach;?>
	            
	            
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

