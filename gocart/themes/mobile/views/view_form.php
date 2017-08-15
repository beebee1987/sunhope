<div class="page-header">
        <h2>View Form</h2>
</div>
<?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?>
           
	<div class="row" id="OrderGroup">
	
			<div class="span5" id="TextBoxDiv1">
				<label>OrderId #1 : </label>
	            <input type="text" name="order_id[]" id="order_id1" value="" class="span3" style="margin:0px;">            
	        </div>                 
	</div>
	
	<div class="row">	
		<div class="span5"></br></div>	
		<div class="span5">                    
				<input class="span2 btn" id="addButton" type="button" value="+"/>
				<input class="span2 btn" id="removeButton" type="button" value="-"/>
				<input type="hidden" name="check" value="check">
	        	<input class="span2 btn" type="submit" value="Checking"/>
	    </div>
	</div>  

</form>