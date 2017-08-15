
<div id="wrapper">

	<div id="content">
		


		<div class="sliderbg">
			<div class="pages_container">
			
				
				<a href="javascript:void(0)" onclick="javascript: print_receipt();" class="button_12 orange orange_borderbottom radius4 no-print"><?php echo lang('print_receipt')?></a>
	            <div class="clearfix"></div>
	            <h3 class="print-display"><?php echo $page_title?> </h3>
												     		             		             	            	            	
	            	<hr/>
		             <blockquote><span><b><?php echo lang('coupon_name');?>: </b></span> <span><b><?php echo $coupon['name']?></b></span></blockquote>											  						  
					 <blockquote><span><b><?php echo lang('card');?>:</b></span>  <span><b><?php echo $customer['card']?></b></span> </blockquote>					 	            	 
	            	 <blockquote><span><b><?php echo lang('customer_name');?>:</b></span> <span><b><?php echo $customer['name']?></b></span> </blockquote>
	            	 
	            	 <blockquote><span><b><?php echo lang('qty_own');?>:</b></span> <span><b><?php echo $coupon['qty']?></b></span> </blockquote>
	            	 <blockquote><span><b><?php echo lang('used_own');?>:</b></span> <span><b><?php echo $coupon['used']?></b></span> </blockquote>
			
			</div>
			<!--End of page container-->
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
