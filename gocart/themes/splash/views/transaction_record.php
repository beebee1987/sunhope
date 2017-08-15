
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<ul class="responsive_table">
					<li class="table_row">
						<div class="table_section_small text_align_right"><?php echo lang('date')?></div>
						<div class="table_section_small text_align_right"><?php echo lang('cost')?></div>
						<div class="table_section_small text_align_right"><?php echo lang('in')?></div>
						<div class="table_section_small text_align_right"><?php echo lang('out')?></div>
					 </li>
						
					<?php 
						$total_cost = 0.00;
						$total_in = 0.00;
						$total_out = 0.00;
						foreach($credit_record as $record):
							$total_cost += $record['cost'];
							$total_in += $record['in'];
							$total_out += $record['out'];
					
					?>	
															
					<li class="table_row">
						<div class="table_section_small text_align_right">
							<?php 								
								$datetime = new DateTime($record['created']);
								$date = $datetime->format('d-m-Y');	
								$time = $datetime->format('H:i:s');
								
								if($time == "00:00:00"){
									echo $date;
								}else{
									echo $date.' '.$time;
								}																							
							?>
						</div>
						<div class="table_section_small text_align_right"><?php echo number_format($record['cost'],2) ?></div>
						<div class="table_section_small text_align_right"><?php echo number_format($record['in'],2) ?></div>
						<div class="table_section_small text_align_right"><?php echo number_format($record['out'],2) ?></div>
					 </li>
					
					
					
					<?php endforeach;?>
					
					<li class="table_row">				
						<div class="table_section_small text_align_right"><b><?php echo lang('totals')?></b></div>
						<div class="table_section_small text_align_right"><b><?php echo number_format($total_cost,2)?></b></div>
						<div class="table_section_small text_align_right"><b><?php echo number_format($total_in,2)?></b></div>
						<div class="table_section_small text_align_right"><b><?php echo number_format($total_out,2)?></b></div>
					 </li>
					
				</ul>
				
				

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

