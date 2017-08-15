<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">


<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>


<?php if(isset($meta)):?>
	<?php echo $meta;?>
<?php else:?>
<meta name="Keywords" content="Shopping Cart, eCommerce, Code Igniter">
<meta name="Description" content="Go Cart is an open source shopping cart built on the Code Igniter framework">
<?php endif;?>
<!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

        
<?php echo theme_css('ratchet.css', true);?>
<?php echo theme_css('ratchet-theme-ios.css', true);?>




<?php
//with this I can put header data in the header instead of in the body.
if(isset($additional_header_info))
{
	echo $additional_header_info;
}


?>
</head>

<body>
	
<!-- Make sure all your bars are the first things in your <body> -->
    <header class="bar bar-nav">   
    <?php 
    
	    if(isset($_SERVER['HTTP_REFERER'])) {
	    	$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
				echo "<a class='icon icon-left-nav pull-left' href='$url'></a>";
	    	}
	    else
	    {
	    	//echo "<a class='icon icon-left-nav pull-left' onclick='history.back(-1)'></a>";	  
	    	echo "";
	    }    
    	
    ?>   	      
      <a class="icon icon-gear pull-right" href="#settingsModal"></a>
      <h1 class="title"><?php echo (isset($page_title) && !empty($page_title)) ? $page_title : '' ?></h1>
    </header>
	
		
<?php
/*
End header.php file
*/