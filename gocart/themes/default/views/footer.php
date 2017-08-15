    <footer class="footer">

        <div style="text-align:center;"><a href="http://gocartdv.com" target="_blank"><img src="<?php echo base_url('assets/img/drivenByGoCart.svg');?>" alt="Driven By GoCart"></a></div>
        
    </footer>
</div>

<script type="text/javascript">

var counter = 2;

$("#addButton").click(function(){

	if(counter>10){
        alert("Only 10 textboxes allow");
        return false;
	} 

	var newTextBoxDiv = $(document.createElement('div')).attr("id", 'OrderBoxDiv' + counter);
	console.log('OrderBoxDiv' + counter);
	$('<label>OrderId #'+ counter + ' : </label>' +
      '<input type="text" name="order_id[]" id="order_id' + counter 
      + '" value="" class="span3" style="margin:0px;">').appendTo(newTextBoxDiv);

	newTextBoxDiv.appendTo("#OrderGroup");

	counter++;
	
});

$("#removeButton").click(function () {

	if(counter==1){
          alert("No more textbox to remove");
          return false;
    }else{
        if(counter>2){
        	counter--;
        }else{
        	if(counter == 2){
        		alert("No more textbox to remove");
                return false;
        	}
        }    	
    	console.log('OrderBoxDiv' + counter);
    	$("#OrderBoxDiv" + counter).remove();  

    	
    }   
    
	
   	
});



</script>

</body>
</html>