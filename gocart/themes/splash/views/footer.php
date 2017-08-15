<!--scripts-->


<div class="navbar">
  <div style="text-align:center;margin: 10px 0;>
    <table width="100%" height="38" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
    <tbody><tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody><tr>
                <td><div align="center"><a href="<?php echo base_url(); ?>"><img src="<?php echo theme_img('icons/home.png')?>" width="25" border="0"></a></div></td>
              </tr>
            </tbody></table>
          </div></td>               
          
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody>
              <tr>
                <td><div align="center"><a href="<?php echo site_url("secure/my_account"); ?>"><img src="<?php echo theme_img('icons/about.png')?>" width="25" border="0"></a></div></td>
              </tr>
            </tbody></table>
          </div></td>
                    
            <!-- Company Detail -->
          
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody><tr>
                <td><div align="center"><a href="<?php echo site_url('company_details');?>"><img src="<?php echo theme_img('icons/law.png')?>" width="25" border="0"></a></div></td>
              </tr>
            </tbody></table>
          </div></td>
          
          <!-- My Card -->
          
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody><tr>
                <td><div align="center"><a href="<?php echo site_url('my_card');?>"><img src="<?php echo theme_img('icons/docs.png')?>" width="25" border="0"></a></div></td>
              </tr>
            </tbody></table>
          </div></td>
          
          <!-- Member Centre -->
          
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody><tr>
                <td><div align="center"><a href="<?php echo site_url('member_center');?>"><img src="<?php echo theme_img('icons/about.png')?>" width="25" border="0"></a></div></td>
              </tr>
            </tbody></table>
          </div></td>
          
          <td><div align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tbody>
              <tr>
              	<?php if($this->Customer_model->is_logged_in(false, false)):?>
                	<td><div align="center"><a href="<?php echo site_url("secure/logout")?>"><img src="<?php echo theme_img('icons/docs.png')?>" width="25" border="0"></a></div></td>
                <?php else:?>
                	<td><div align="center"><a href="<?php echo site_url("secure/login")?>"><img src="<?php echo theme_img('icons/docs.png')?>" width="25" border="0"></a></div></td>                
                <?php endif;?>
              </tr>
            </tbody></table>
          </div></td>
          
        </tr>
        <tr>
          <td><div align="center"><a href="<?php echo base_url(); ?>">Home</a></div></td>
          <!--td><div align="center"><a href="reward.php">Rewards</a></div></td>
          <td><div align="center"><a href="network.php">My Networks</a></div></td>
          <td><div align="center"><a href="<?php echo site_url("secure/my_account"); ?>">Profile</a></div></td>
          <td><div align="center"><a href="setting.php">Settings</a></div></td-->
          <!--td><div align="center"><a href="<?php echo site_url("cart/details"); ?>">My Card</a></div></td-->
          <td><div align="center"><a href="<?php echo site_url("secure/my_account"); ?>">Profile</a></div></td>                    
          <td><div align="center"><a href="<?php echo site_url('cart/company_details');?>">Company</a></div></td>
          <td><div align="center"><a href="<?php echo site_url('cart/my_card');?>">Card</a></div></td>
          <td><div align="center"><a href="<?php echo site_url('cart/member_center');?>">Center</a></div></td>
          <?php if($this->Customer_model->is_logged_in(false, false)):?>
          	<td><div align="center"><a href="<?php echo site_url("secure/logout"); ?>">Logout</a></div></td>
          <?php else: ?>
          	<td><div align="center"><a href="<?php echo site_url("secure/login"); ?>">Login</a></div></td>
          <?php endif; ?>
          
          
        </tr>
      </tbody></table></td>
      </tr>
  </tbody></table>
</div>
</div>

</div> <!-- END of Container in file header.php -->

	<!--scripts-->		
	<?php echo theme_js('jquery-1.10.1.min.js', true);?>	
	<?php echo theme_js('jquery-ui.js', true);?>	
	
	<?php echo theme_js('jquery.validate.min.js', true);?>
	
	
	<?php echo theme_js('jquery.tabify.js', true);?>
	
	<?php echo theme_js('jquery.swipebox.js', true);?>
	<?php echo theme_js('jquery.fitvids.js', true);?>
	<?php echo theme_js('twitter/jquery.tweet.js', true);?>
	<?php echo theme_js('email.js', true);?>
	
	<?php echo theme_js('jquery.slides.min.js', true);?>
	
	
	
	
    <!-- Demo -->

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
<script>
	$(function() {
    	$( "#tabs" ).tabs();
    	select_voucher();
  	});

  
	$(".toggle_container").show();
	$(".toggle_container_point").hide();
	$(".toggle_container_company").hide();
	
	var $toggle = false;
	/* Basic Gallery */
	$( '.swipebox' ).swipebox();
	
	/* Video */
	$( '.swipebox-video' ).swipebox();

	/* Dynamic Gallery */
	$( '#gallery' ).click( function( e ) {
		e.preventDefault();
		$.swipebox( [
			{ href : 'http://swipebox.csag.co/mages/image-1.jpg', title : 'My Caption' },
			{ href : 'http://swipebox.csag.co/images/image-2.jpg', title : 'My Second Caption' }
		] );
	} );

	/* Dynamic Gallery */
	$('.trigger').click( function( e ) {
		e.preventDefault();
		
			$(".toggle_container").show("slow");
			$(".toggle_container_point").hide("slow");
			$(".toggle_container_company").hide("slow");					
	} );

	/* Dynamic Gallery */
	$('.trigger_point').click( function( e ) {
		e.preventDefault();

		$(".toggle_container_point").show("slow");
		$(".toggle_container").hide("slow");		
		$(".toggle_container_company").hide("slow");			
		
	} );
	
	/* Dynamic Gallery */
	$('.trigger_company').click( function( e ) {
		e.preventDefault();

		$(".toggle_container_company").show("slow");
		$(".toggle_container").hide("slow");		
		$(".toggle_container_point").hide("slow");			
		
	} );	

	//function to add in voucher to users
	function select_voucher()
	{
		$('.loading').fadeIn('slow');
		//console.log('voucherID: ' + voucherID + 'customerID: ' + customerID);
		voucherID = $('#voucher_id').val();
		payment = $('#payment').val();
					
		$.post("<?php echo site_url('cart/retrieve_voucher_value'); ?>", {
			voucher_id : voucherID,
			payment : payment,		
			},
			function(data) {
				$('.loading').fadeOut('slow');		   		   
			    $('#consume_amount').val(data);	    	 		    
			});		
	}

	function go_consumption(encrypt, customer_id, voucher_id)
	{
		url = "<?php echo site_url('cart/consumption')?>";
		//console.log(url + "/" + encrypt + "/" + customer_id + "/" + voucher_id);
		window.location = url + "/" + encrypt + "/" + customer_id + "/" + voucher_id;
	}

	function go_consumption_qrcode(encrypt, customer_id, voucher_id)
	{
		url = "<?php echo site_url('cart/consumption_qrcode')?>";
		//console.log(url + "/" + encrypt + "/" + customer_id + "/" + voucher_id);
		window.location = url + "/" + encrypt + "/" + customer_id + "/" + voucher_id;
	}

	function process_voucher_qrcode(customer_id, voucher_id)
	{
		url = "<?php echo site_url('cart/process_voucher_qrcode')?>";
		//console.log(url + "/" + encrypt + "/" + customer_id + "/" + voucher_id);
		window.location = url + "/" + customer_id + "/" + voucher_id;
	}

	function process_coupon_qrcode(customer_id, coupon_id)
	{
		url = "<?php echo site_url('cart/process_coupon_qrcode')?>";		
		//console.log(url + "/" + encrypt + "/" + customer_id + "/" + voucher_id);
		window.location = url + "/" + customer_id + "/" + coupon_id;
	}
	
	//function to add in voucher to users
	function add_voucher(voucherID, customerID)
	{
		$('.loading').fadeIn('slow');
		//console.log('voucherID: ' + voucherID + 'customerID: ' + customerID);
		
		$.post("<?php echo site_url('cart/add_voucher'); ?>", {
			voucher_id : voucherID,
			customer_id : customerID,		
			},
			function(data) {
			    $('.loading').fadeOut('slow');		   
			    if(data == 1){
			    	alert('Added Successful');
			    }else{
			    	alert('You have got it!');
			    }	 		    
			});		
	}
	function add_coupon(couponID, customerID)
	{
		if (confirm('<?php echo lang('confirm_add_coupon')?>')) {
			$('.loading').fadeIn('slow');
			
			$.post("<?php echo site_url('cart/add_coupon'); ?>", {
				coupon_id : couponID,
				customer_id : customerID,		
				},
				function(data) {
				    $('.loading').fadeOut('slow');	
					console.log(data);

				    	   
				    if(data == 1){
				    	alert('Added Successful');
				    }else{
				    	alert('You have got it!');
				    }	 		    
				});		
		}

	}	

</script>
        
<!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    $(function() {

        
      $('#slides').slidesjs({
        width: 940,
        height: 528,
        navigation: {
          effect: "fade"
        },
        start: 1,
        play: {
          auto: true
        },
        pagination: {
          effect: "fade"
        },
        effect: {
          fade: {
            speed: 400
          }
        }
      });
    });
  </script>
  
</body>
</html>