
<div class="container">
	<div class="text-center row">
		<h1>LATEST PROMOTIONS</h1>		
		<h4>(Click on image to enlarge) 
						</h4>
	</div>
</div>

<div id="latest-promotions-menu" class="container">
	<?php 
		$total_row = count($rs_latest_promotion);
		$loop_times = 3;
		$row = 0;				
		
		$div_new_row_beginning = '<div class="text-center row">';		
		$div_new_row_ending = '</div>';		
		$content = '';		
		$content = $div_new_row_beginning;
		// set one row has three image. the more image have, the more times deduct with 3. Means that , this is keep looping		
		while($total_row >= 3 && $loop_times > 0){
			
			// ** content of image attribute **//
			$image_path = $rs_latest_promotion[$row]['image'];
			$id_title = 'promotion_'.$rs_latest_promotion[$row]['id'].'_modal';			
			$caption = $rs_latest_promotion[$row]['caption'];
			$target = '#'.$id_title;			
			// ******************************//			
			$display_images = '<div class="col-lg-4 col-md-4">'.'<a href="#" data-toggle="modal" data-target="'.$target.'"><img src="'.base_url('uploads/'.$image_path).'" alt="'.$caption.'"></a></div> ';
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
			$image_path = $rs_latest_promotion[$row]['image'];
			$id_title = 'promotion_'.$rs_latest_promotion[$row]['id'].'_modal';
			$caption = $rs_latest_promotion[$row]['caption'];
			$target = '#'.$id_title;
		?>
			<div class="col-lg-4 col-md-4">
				<a href="#" data-toggle="modal" data-target="<?php echo $target?>"><img src="<?php echo base_url('uploads/'.$image_path); ?>" alt="<?php echo $caption?>"></a>
			</div>
		<?php 
			$row++;
		}
		?>			
		</div>

	<?php }?>
</div>

<?php 
	foreach($rs_latest_promotion as $latest):
?>
	<!-- Modal -->
<div class="modal fade" id="promotion_<?php echo $latest['id']?>_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        	<img src="<?php echo base_url('uploads/'.$latest['image']); ?>" class="responsive-image">
      </div>      
    </div>
  </div>
</div>
	
<?php endforeach;?>	
