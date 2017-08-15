
<div class="container">
	<div class="text-center row">
		<h1>Price List</h1>		
		<h4>(Click on image to view price list) 
						</h4>
	</div>
</div>

<div id="promotion-menu" class="container">
	<?php 
		$total_row = count($rs_price_list);
		$loop_times = 3;
		$row = 0;				
		
		$div_new_row_beginning = '<div class="text-center row">';		
		$div_new_row_ending = '</div>';		
		$content = '';		
		$content = $div_new_row_beginning;
		// set one row has three image. the more image have, the more times deduct with 3. Means that , this is keep looping		
		while($total_row >= 3 && $loop_times > 0){
			
			// ** content of image attribute **//
			$image_path = $rs_price_list[$row]['image'];
			$id_title = 'promotion_'.$rs_price_list[$row]['id'].'_modal';			
			$caption = $rs_price_list[$row]['caption'];
			$url_link = $rs_price_list[$row]['url_link'];
			$target = '#'.$id_title;			
			// ******************************//			
			$display_images = '<div class="col-lg-4 col-md-4">'.'<a href="'.$url_link.'" target="_blank"><img src="'.base_url('uploads/'.$image_path).'" alt="'.$caption.'"></a></div> ';
			// ** append into div **//
			$content .= $display_images;				
			
			//calculation of the row only display three images
			$loop_times--;
			$row++;
			if($loop_times <= 0){
				$total_row = $total_row - 3;
				$loop_times = 3;
			}
		}
		// concat end of div
		$content .= $div_new_row_ending;
		// display row content
			echo $content;
				
		// the left
		if($total_row > 0){		
	?>		
		<div class="text-center row">
		<div class="col-lg-2 col-md-2">&nbsp;</div>
		<?php for($i = 0; $i < $total_row; $i++){
			$image_path = $rs_price_list[$row]['image'];
			$id_title = 'promotion_'.$rs_price_list[$row]['id'].'_modal';
			$caption = $rs_price_list[$row]['caption'];
			$target = '#'.$id_title;
		?>
			<div class="col-lg-4 col-md-4">
				<a href="<?php echo $rs_price_list[$row]['url_link'] ?>" target="_blank"><img src="<?php echo base_url('uploads/'.$image_path); ?>" alt="<?php echo $caption?>"></a>
			</div>
		<?php 
			$row++;
		}
		?>			
		</div>

	<?php }?>
</div>
