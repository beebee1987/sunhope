    <div class="text-center row">
		<h1>Events</h1>	
	</div>

   
      <!-- Example row of columns -->
      <table class="table table-bordered">
	  	<tr>
	  		<th class="text-center">Date</th>
	  		<th class="text-center">Time</th>
	  		<th class="text-center">Event</th>
	  		<th class="text-center">Venue</th>
	  		<th class="text-center">Brands</th>
	  	</tr>
	  	
	  	<?php foreach($events as $event):?>	  	
	  	<tr>
	  			  			  		
	  		<?php 	  			  			
	  			// Date Display Pattern  				  		
	  			$date_from = $event->date;
	  			$date_to = $event->date_to;
	  			$php_datefrom = array();
	  			$php_dateto = array();
	  				  				  			
	  			$str_datefrom = '';
	  			$str_dateto = '';
	  			
	  			$year_seperate = '';
	  			$month_seperate = '';
	  			$day_seperate = '';
	  			
	  			//retrive date from
	  			if (($datefrom = strtotime($date_from)) !== false){
	  				$php_datefrom = getdate($datefrom);
	  			}else{
	  				// retrive invalid date from
	  				$date_display = 'invalid date from!';	  				
	  			}
	  			
	  			//check to if it is 00:00:00
	  				  			
	  			//retrive date to
	  			if (($dateto = strtotime($date_to)) !== false){
	  				$php_dateto = getdate($dateto);	  				
	  			}else{
	  				$date_display = 'invalid date to!';	  				
	  			}
	  			
	  			//year
	  			if($php_datefrom['year'] == $php_dateto['year']){
					$year_seperate = 'inline';
				}else{
					$year_seperate = 'seperate';
				}	  			
							
				//month
				if($php_datefrom['mon'] == $php_dateto['mon']){
					$month_seperate = 'inline';
				}else{
					$month_seperate = 'seperate';
				}
																
				$date_display = '';									

				if($event->date_to == '1970-01-01'){
					// only one date from
					$date_display = date('d M Y', $datefrom);
				}else{
					// from and to checking 
					if($year_seperate == 'seperate'){
						$date_display =  date('d M Y', $datefrom).' - '.date('d M Y', $dateto);
					}else if($month_seperate == 'inline' && $year_seperate == 'inline'){
						$date_display = $php_datefrom['mday'] . ' - ' .$php_dateto['mday']. ' '. $php_datefrom['month']. ' '. $php_datefrom['year'];
					}else if($month_seperate == 'seperate'){
						$date_display = $php_datefrom['mday'] . ' '. $php_datefrom['month']. ' - '. $php_dateto['mday'] . ' '. $php_dateto['month']. ' '. $php_datefrom['year'];
					}else{
						$date_display =  date('dd MM yyyy', $date_from) . ' - '. date('dd MM yyyy', $date_to);
					}
				}
				
				
				
				// Time Display Pattern
				$time_display = '';
				$time_display = date("g:i a", strtotime($event->time)).' - '. date("g:i a", strtotime($event->time_to)); 			
				
	  		?>
	  		<td><?php echo $date_display?></td>
	  		<td><?php echo $time_display?></td>
	  		
	  		<td><?php echo $event->event?></td>
	  		<td><?php echo $event->venue?></td>
	  		<td><?php echo $event->brands?></td>
	  	</tr>	  	
	  	<?php endforeach;?>
	  </table>
	

