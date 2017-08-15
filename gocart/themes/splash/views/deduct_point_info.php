<div id="wrapper">

	    <div id="content">
	            <div class="no-print"><?php $this->load->view('header_menu'); ?>   </div>
	                        
	       <div class="sliderbg">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo $page_title?></h2>	             	             
	             
	             <a href="javascript: void(0)" class="no-print" onclick="javascript: print_receipt();"><?php echo lang('print_receipt')?></a>
	             <div class="clearfix print-display space_between"></div>
	             <div class="print-display" style="text-align:left;">
	             <h4><?php echo $company[0]['company_name'] ?></h4>
	            	<h5><?php echo $company[0]['ssm'] ?></h5>
	            	<h5><?php echo $company[0]['address'] ?></h5>
	            	<h5>Tel: <?php echo (!empty($company[0]['phone']) && isset($company[0]['phone'])) ? $company[0]['phone'] : '-'?></h5>
	            	<div class="clearfix print-display space_between"></div>
	             	<h2 class="print-display"><b><?php echo lang('receipt')?> </b></h2>
	             </div>
	             	             	             
            	 <h3 class="no-print"><?php echo lang('topup_point_info')?> </h3>
            	 
            	 <?php if(isset($info['trx_no']) && !empty($info['trx_no'])):?>
            	 	<blockquote><span><b><?php echo lang('trx_no');?> : </b></span> <span><?php echo $info['trx_no']?></span></blockquote>
            	 <?php endif;?>
            	 
            	 <blockquote><span><b><?php echo lang('consume_date');?> : </b></span> <span><?php echo $info['created']?></span></blockquote>
            	 <blockquote><span><b><?php echo lang('staff_branch');?> : </b></span> <span><?php echo (isset($admin['branch_name']) && !empty($admin['branch_name'])) ? $admin['branch_name'] : '-'?></span></blockquote>
            	 <!--blockquote><span><b><?php echo lang('staff_name');?> : </b></span> <span><?php echo $info['staff_id']?></span></blockquote-->
            	 <blockquote><span><b><?php echo lang('customer_name');?> : </b></span> <span><?php echo $info['customer_name']?></span></blockquote>
            	 
            	 <blockquote><span><b><?php echo lang('total_consume');?> : </b></span> <span><?php echo $info['depoint']?></span></blockquote>            	 	
            	 
            	 <blockquote><span><b><?php echo lang('remark');?> : </b></span> <span><?php echo $info['remark']?></span></blockquote>        
            	         
            	  
				 <br/><br/><br/><br/>
				 <div class="print-display" style="text-align:center;">
				  		
				  		<?php echo lang('customer_sign')?>
	             		<br/><br/><br/><br/> <br/><br/><br/><br/>
	             		---------------------------
	             </div>
            	 
            	 <div class="print-display" style="text-align:center;">
				  		 <br/><br/><br/><br/>
				  		<?php echo lang('staff_sign')?>
	             		<br/><br/><br/><br/> <br/><br/><br/><br/>
	             		---------------------------
	             </div> 
            	             	 
	         	</div>
	       </div>
	</div> 
</div>

<script>

//function to generate invoice full report
function print_receipt()
{
	window.print();
}
</script>