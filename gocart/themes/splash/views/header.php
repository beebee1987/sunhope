<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" href="images/apple-touch-startup-image-320x460.png" />
<meta name="author" content="FamousThemes" />

<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>


<?php if(isset($meta)):?>	
	<meta name="description" content="<?php echo $meta;?>" />	
<?php else:?>
<meta name="Keywords" content="Shopping Cart, eCommerce, ThunderMatch, TMT.MY">
<meta name="Description" content="Thunder Match Technology Sdn Bhd">
<?php endif;?>
	

<!--custom css-->
<?php echo theme_css('style.css', true);?>
<?php echo theme_css('splash.css', true);?>

<?php echo theme_css('print.css', true);?>

<?php echo theme_css('swipebox.css', true);?>
<?php echo theme_css('font-awesome.min.css', true);?>

<?php echo theme_css('jquery-ui.css', true);?>



<!--google lato font family-->
<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'/>

<meta name="twitter:widgets:theme" content="light">



<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<?php
//with this I can put header data in the header instead of in the body.
if(isset($additional_header_info))
{
	echo $additional_header_info;
}

?>
</head>
<body>

	
