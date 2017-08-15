<div id="wrapper">

    <div id="content">
            <?php $this->load->view('header_menu'); ?>   
                        
       <div class="sliderbg ">
                                        <div class="pages_container">
                                        <h2 class="page_title"><?php echo $page_title?></h2>
                           
                           <?php echo (count($companies) < 1)?'<p>'.lang('no_companies').'</p>':''?>
                           <?php foreach ($companies as $company):?>
                           <ul class="listing_detailed">                                          
						
							<!-- This need a function for users add in -->
						
							<ol>
								<li><a href="#"><?php echo $company['company_name']?></a></li>								
							</ol>													
						    
						    <ol>
								<li>
									<a href="tel:<?php echo $company['phone']?>"><?php echo $company['phone']?></a>
								</li>								
							</ol>                                    
						 
						 	<ol>
								<li>
									<!--a href="#">3-3A / NB Plaza, 3000 Jalan Baru, 13700 Perai, Pulau Pinang</a-->								
									<a style="cursor: pointer;" onclick="myNavFunc('<?php echo $company['gps']?>')"><?php echo $company['address']?></a>								
								</li>								
							</ol>                         						 						 						 	
						 
						 	<ol>
						 		More Details
								<div class="toogle_wrap radius8">
										<div class="trigger_point"><a href="#">Company Details</a></div>
										<div class="toggle_container_point">
										<ul class="listing_detailed">                                          						
											<ol>
												<li><?php echo $company['company_details']?>
												</li>								
											</ol>
										</ul>                                            
				                    </div>
				                </div>
							</ol>                         
						</ul>   
                           
                           <?php endforeach;?>
                          
	                                            
	         </div>
	    </div>
	</div> 
</div>

<script>
function myNavFunc(gps){
		
    // If it's an iPhone..
    if( (navigator.platform.indexOf("iPhone") != -1) 
        || (navigator.platform.indexOf("iPod") != -1)
        || (navigator.platform.indexOf("iPad") != -1))
         window.open("maps:" + gps);
    else
         window.open(gps);
}
</script>
