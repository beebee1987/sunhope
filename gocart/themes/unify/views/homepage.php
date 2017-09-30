<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <title>Sun Hope Industry Sdn Bhd | Sun Hope Engineering</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">

        <!-- Web Fonts -->
        <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

        <!-- CSS Global Compulsory -->

        <!--custom css-->
        <?php echo theme_unify_css('assets/plugins/bootstrap/css/bootstrap.min.css', true); ?>
        <?php echo theme_css('one.style.css', true); ?>

        <!-- CSS Footer -->
        <?php echo theme_css('footers/footer-v7.css', true); ?>

        <!-- CSS Implementing Plugins -->
        <?php echo theme_unify_css('assets/plugins/animate.css', true); ?>	
        <?php echo theme_unify_css('assets/plugins/line-icons/line-icons.css', true); ?>
        <?php echo theme_unify_css('assets/plugins/font-awesome/css/font-awesome.min.css', true); ?>
        <?php echo theme_unify_css('assets/plugins/pace/pace-flash.css', true); ?>
        <?php echo theme_unify_css('assets/plugins/owl-carousel/owl.carousel.css', true); ?>
        <?php echo theme_unify_css('assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css', true); ?>	
        <?php echo theme_unify_css('assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css', true); ?>	
        <?php echo theme_unify_css('assets/plugins/revolution-slider/rs-plugin/css/settings.css', 'screen'); ?>	
            <!--[if lt IE 9]><?php echo theme_unify_css('assets/plugins/revolution-slider/rs-plugin/css/settings-ie8.css', 'screen'); ?><![endif]-->

        <!-- CSS Theme -->
        <?php echo theme_css('theme-colors/default.css', true, 'style_color'); ?>    
        <?php echo theme_css('theme-skins/one.dark.css', true); ?>

        <!-- CSS Customization -->
        <?php echo theme_css('custom.css', true); ?>    
    </head>

    <!--
    The #page-top ID is part of the scrolling feature.
    The data-spy and data-target are part of the built-in Bootstrap scrollspy function.
    -->
    <body id="body" data-spy="scroll" data-target=".one-page-header" class="demo-lightbox-project dark">
        <!--=== Header ===-->

        <nav class="one-page-header navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="menu-container page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="#intro">
                        <div id="logo_pos"><img src="<?php echo base_url('assets/img/logo.png');?>" width="130px"></div>
                        <span class="sunhope_title"><b>Sun Hope Industry Sdn Bhd</b><div class="sunhope_title2">&nbsp; (Sun Hope Engineering)</div></span> 
                        <span class="sunhope_title_ipad"><b>Sun Hope Industry Sdn Bhd</b><div style="font-size: 12px; margin-top: 5px;">(Sun Hope Engineering)</div></span>
                        <span class="sunhope_title_mobile"><b>Sun Hope Industry</b><div style="font-size: 12px; margin-top: 5px;">(Sun Hope Engineering)</div></span>
                        <!-- <img src="assets/img/logo1.png" alt="Logo"> -->
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav">
                            <li class="page-scroll home">
                                <a href="#body">Home</a>
                            </li>
                            <li class="page-scroll">
                                <a href="#about">About Us</a>
                            </li>
                            <li class="page-scroll">
                                <a href="#services">Services</a>
                            </li>
                            <!--li class="page-scroll">
                                <a href="#news">News</a>
                            </li-->
                            <li class="page-scroll">
                                <a href="#projects">Projects</a>
                            </li>
                            <li class="page-scroll">
                                <a href="#contact">Contact</a>
                            </li>
                            <!--li class="page-scroll">
                                <a href="../index.html">Main</a>
                            </li-->
                        </ul>
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!--=== End Header ===-->

        <!-- Intro Section -->
        <section id="intro" class="intro-section">
            <div class="fullscreenbanner-container">
                <div class="fullscreenbanner">
                    <ul>
                        <?php 
                            foreach ($sliders as $slider):                             
                        ?>
                        
                        <li data-transition="curtain-<?php echo $slider['id'] ?>" data-title="<?php echo $slider['title'] ?>">
                            <img src="<?php echo base_url($slider['image']); ?>" alt="slidebg<?php echo $slider['id'] ?>" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                        </li>
                            
                        <?php endforeach; 
                        ?>  
                        
                        
                        <!-- SLIDE 1 -->
<!--                        <li data-transition="curtain-1" data-title="Slide 1">-->
                            <!-- MAIN IMAGE -->
                            <!--<img src="<?php echo base_url('uploads/slider/slider3.jpg'); ?>" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">-->

                            <!-- LAYERS -->
                            <!-- <div class="tp-caption rs-caption-1 sft start"
                                 data-x="center"
                                 data-hoffset="0"
                                 data-y="100"
                                 data-speed="800"
                                 data-start="2000"
                                 data-easing="Back.easeInOut"
                                 data-endspeed="300">
                                WE ARE SUN HOPE ENGINEERING COMPANY
                            </div> -->
                        <!--</li>-->
                        



                    </ul>
                    <div class="tp-bannertimer tp-bottom"></div>
                    <div class="tp-dottedoverlay twoxtwo"></div>
                </div>
            </div>
        </section>
        <!-- End Intro Section -->

        <!--  About Section -->
        <section id="about" class="about-section section-first">


            <div class="about-image bg-grey">
                <div class="container">
                    <div class="title-v1">
                        <h1>About us</h1>
                        <p>Beginning with the inception of Sun Hope Engineering in 1996 and later the establishment
                            Sun Hope Industry Sdn Bhd in 2002. Sun Hope has evolved from fledgling company that
                            relied mostly on referral business to a competent and established corporation that
                            successfully secures and undertakes various projects from both local and multinational
                            companies
                            As a specialized yet total services provider in the M&E Engineering sector within three
                            primary industries – Oil & Gas, Manufacturing/Assembly Plants and Marine.
                            We look forward to the opportunity to provide solutions to meet your engineering needs!!
                        </p>
                    </div>
                    <!-- <div class="img-center">
                        <img class="img-responsive" src="<?php echo base_url('uploads/about/about_us.jpg') ?>" alt="">
                    </div> -->
                </div>
            </div>

<!--            <div class="container content-lg">
                <div class="title-v1">
                    <h2>Our Vision And Mission</h2>
                    <p>We <strong>meet</strong> and get to know you. You tell us and we listen. <br>
                        We build everyone you want.</p>
                </div>

                <div class="row">
                    <div class="col-md-6 content-boxes-v3 margin-bottom-40">
                        <div class="clearfix margin-bottom-30">
                            <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
                            <div class="content-boxes-in-v3">
                                <h2 class="heading-sm">Innovation Leader</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            </div>
                        </div>
                        <div class="clearfix margin-bottom-30">
                            <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-directions"></i>
                            <div class="content-boxes-in-v3">
                                <h2 class="heading-sm">Best Solutions &amp; Approaches</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            </div>
                        </div>
                        <div class="clearfix margin-bottom-30">
                            <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-diamond"></i>
                            <div class="content-boxes-in-v3">
                                <h2 class="heading-sm">Quality Service &amp; Support</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <img class="img-responsive" src="<?php echo base_url('uploads/about/vision.jpg') ?>" alt="">
                    </div>
                </div>
            </div>-->

            <!--div class="parallax-quote parallaxBg">
                <div class="container">
                    <div class="parallax-quote-in">
                        <p>If you can design one thing <span class="color-green">you can design</span> everything. <br> Just Believe It.</p>
                        <small>- HtmlStream -</small>
                    </div>
                </div>
            </div-->

            <!-- <div class="team-v1 bg-grey content-lg">
                <div class="container">
                    <div class="title-v1">
                        <h2>Meet Our Team</h2>
                        <p>We <strong>meet</strong> and get to know you. You tell us and we listen. <br>                    
                    </div>

                    <ul class="list-unstyled row"> -->
            <!--li class="col-sm-3 col-xs-6 md-margin-bottom-30">
                <div class="team-img">
                    <img class="img-responsive" src="<?php echo theme_img('team/img1-md.jpg') ?>" alt="">
                    <ul>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <h3>John Brown</h3>
                <h4>/ Technical Director</h4>
                <p>Technical Director mi porta gravida at eget metus id elit mi egetine...</p>
            </li-->
            <!--li class="col-sm-3 col-xs-6 md-margin-bottom-30">
                <div class="team-img">
                    <img class="img-responsive" src="<?php echo theme_img('team/img2-md.jpg') ?>" alt="">
                    <ul>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <h3>Tina Krueger</h3>
                <h4>/ Lead Designer</h4>
                <p>Lead Designer mi porta gravida at eget metus id elit mi egetine...</p>
            </li-->
            <!--li class="col-sm-3 col-xs-6">
                <div class="team-img">
                    <img class="img-responsive" src="<?php echo theme_img('team/img3-md.jpg') ?>" alt="">
                    <ul>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-custom icon-sm rounded-x fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <h3>David Case</h3>
                <h4>/ Web Developer</h4>
                <p>Web Developer in Unify agency porta gravida at eget metus id elit...</p>
            </li-->
            <!--  <li class="col-sm-4 col-xs-8">
             </li>
             <li class="col-sm-4 col-xs-8">
                 <div class="team-img">
                     <img class="img-responsive" src="<?php echo base_url('uploads/about/jack.jpg') ?>" alt="">
                     <ul>
                         <li><a href="https://www.facebook.com/Sun-Hope-Engineering-951607544873827/" target="_blank"><i class="icon-custom icon-sm rounded-x fa fa-facebook"></i></a></li>                                
                     </ul>
                 </div>
                 <h3>Jack Lee</h3>
                 <h4>VIP</h4>
                 <p>Highest Management in Sun Hope</p>
             </li>
             <li class="col-sm-4 col-xs-8">
             </li>                                        
         </ul>
     </div>
 </div> -->

            <!-- <div class="parallax-counter parallaxBg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-xs-8">
                            <div class="counters">
                                <span class="counter">300</span>
                                <h4>Projects</h4>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <div class="counters">
                                <span class="counter">150</span>
                                <h4>Team Members</h4>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <div class="counters">
                                <span class="counter">109</span>
                                <h4>Awards</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>
        <!--  About Section -->

        <!-- Services Section -->
        <section id="services">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>Our Services</h2>
<!--                    <p>We do <strong>things</strong> differently company providing services. <br>
                        Focused on helping our clients to build a <strong>successful</strong> Machine</p>-->
                </div>

                <div class="row service-box-v1">
                    <div class="col-md-3 col-sm-6">                    
                        <div class="service-block service-block-default">
                            <i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-gear"></i>
                            <h2 class="heading-sm">Our Fabrication</h2>
                            <ul class="list-unstyled">
                                <li>Cutting</li>
                                <li>Rolling</li>
                                <li>Welding</li>
                                <li>Machining</li>
                                <li>Milling</li>
                                <li>Sand Blasting</li>
                                <li>Painting</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="service-block service-block-default">
                            <i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-fire"></i>
                            <h2 class="heading-sm">Welding Service</h2>
                            <ul class="list-unstyled">
                                <li>MIG Welding</li>
                                <li>Arc Welding</li>
                                <li>TIG Welding</li>
                                <li>Plasma Cutting </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">    
                        <div class="service-block service-block-default">
                            <i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-lightbulb-o"></i>
                            <h2 class="heading-sm">Site Service</h2>
                            <ul class="list-unstyled">
                                <li>Machinery Installation</li>
                                <li>Air Duct works</li>
                                <li>Piping works</li>
                            </ul>
                        </div>                
                    </div>
                    <div class="col-md-3 col-sm-6">    
                        <div class="service-block service-block-default">
                            <i class="icon-custom icon-lg icon-bg-u rounded-x fa fa-heart"></i>
                            <h2 class="heading-sm">Other Service</h2>
                            <ul class="list-unstyled">
                                <li>Consultancy</li>
                                <li>Maintenance and Service</li>
                                <li>Design</li>
                            </ul>
                        </div>                
                    </div>
                </div>
            </div>


            <!--ul class="list-unstyled row portfolio-box-v1">
                <li class="col-sm-4">
                    <img class="img-responsive" src="<?php echo theme_img('mockup/img1.jpg') ?>" alt="">
                    <div class="portfolio-box-v1-in">
                        <h3>Collective Package</h3>
                        <p>Web Design, Mock-up</p>
                        <a class="btn-u btn-u-sm btn-brd btn-brd-hover btn-u-light" href="#">Read More</a>
                    </div>
                </li>
                <li class="col-sm-4">
                    <img class="img-responsive" src="<?php echo theme_img('mockup/img2.jpg') ?>" alt="">
                    <div class="portfolio-box-v1-in">
                        <h3>Ahola Company</h3>
                        <p>Brand Design, UI</p>
                        <a class="btn-u btn-u-sm btn-brd btn-brd-hover btn-u-light" href="#">Read More</a>
                    </div>
                </li>
                <li class="col-sm-4">
                    <img class="img-responsive" src="<?php echo theme_img('mockup/img4.jpg') ?>" alt="">
                    <div class="portfolio-box-v1-in">
                        <h3>Allan Project</h3>
                        <p>Web Development, HTML5</p>
                        <a class="btn-u btn-u-sm btn-brd btn-brd-hover btn-u-light" href="#">Read More</a>
                    </div>
                </li>
            </ul-->

            <!--div class="call-action-v1">
                <div class="container">
                    <div class="call-action-v1-box">
                        <div class="call-action-v1-in">
                            <p>Unify creative technology company providing key digital services and focused on helping our clients to build a successful business on web and mobile.</p>
                        </div>
                        <div class="call-action-v1-in inner-btn page-scroll">
                            <a href="#portfolio" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-block">View Our Portfolio</a>
                        </div>
                    </div>
                </div>
            </div-->
        </section>
        <!-- End Services Section -->

        <!-- News Section -->
        <!--section id="news" class="news-section">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>Latest News</h2>
                    <p>We do <strong>things</strong> differently company providing key digital services. <br>
                    Focused on helping our clients to build a <strong>successful</strong> business on web and mobile.</p>
                </div>

                <div class="row news-v1">
                    <div class="col-md-4 md-margin-bottom-40">
                        <div class="news-v1-in">
                            <img class="img-responsive" src="<?php echo theme_img('contents/img1.jpg') ?>" alt="">
                            <h3><a href="#">Focused on helping our clients to build a successful business</a></h3>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                            <ul class="list-inline news-v1-info">
                                <li><span>By</span> <a href="#">Kathy Reyes</a></li>
                                <li>|</li>
                                <li><i class="fa fa-clock-o"></i> July 02, 2014</li>
                                <li class="pull-right"><a href="#"><i class="fa fa-comments-o"></i> 14</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 md-margin-bottom-40">
                        <div class="news-v1-in">
                            <img class="img-responsive" src="<?php echo theme_img('contents/img4.jpg') ?>" alt="">
                            <h3><a href="#">We build your website to realise your vision and best product</a></h3>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                            <ul class="list-inline news-v1-info">
                                <li><span>By</span> <a href="#">John Clarck</a></li>
                                <li>|</li>
                                <li><i class="fa fa-clock-o"></i> July 02, 2014</li>
                                <li class="pull-right"><a href="#"><i class="fa fa-comments-o"></i> 07</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-v1-in">
                            <img class="img-responsive" src="<?php echo theme_img('contents/img3.jpg') ?>" alt="">
                            <h3><a href="#">Focused on helping our clients to build a successful business</a></h3>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.</p>
                            <ul class="list-inline news-v1-info">
                                <li><span>By</span> <a href="#">Tina Kruiger</a></li>
                                <li>|</li>
                                <li><i class="fa fa-clock-o"></i> July 02, 2014</li>
                                <li class="pull-right"><a href="#"><i class="fa fa-comments-o"></i> 22</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="parallax-twitter parallaxBg">
                <div class="container parallax-twitter-in">
                    <div class="margin-bottom-30">
                        <i class="icon-custom rounded-x icon-bg-blue fa fa-twitter"></i>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <ul class="list-unstyled owl-twitter-v1">
                                <li class="item">
                                    <p>Unify has reached 10000 plus sales and we just want to thank you to our all customers for being part of the Unify Template success <a href="http://bit.ly/1c0UN3Y">http://bit.ly/1c0UN3Y</a><p>
                                    <span>3 min ago via <a href="https://twitter.com/htmlstream">@htmlstream</a></span>
                                </li>
                                <li class="item">
                                    <p><a href="#">@htmlstream</a> jQuery lightGallery - Lightweight jQuery lightbox project for displaying image and video project <a href="#">http://sachinchoolur.github.io/lightGallery</a> <a href="#">#javascript</a></p>
                                    <span>10 min ago Retweeted by <a href="https://twitter.com/htmlstream">@twbootstrap</a></span>
                                </li>
                                <li class="item">
                                    <p>New 100% Free Stock Photos. Every. Single. Day. Everything you need for your creative projects. <a href="#">http://publicdomainarchive.com</a></p>
                                    <span>30 min ago via <a href="https://twitter.com/htmlstream">@wrapbootstrap</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section-->
        <!-- End News Section -->

        <!-- Portfolio Section -->
        <section id="projects" class="about-section">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>Projects</h2>
<!--                    <p>We do <strong>things</strong> differently company providing.</p>-->
                </div>


                <div class="cube-portfolio">
                    <div id="filters-container" class="cbp-l-filters-button">
                        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All </div>


                        <?php 
                            foreach ($categories as $category):                             
                        ?>
                        <div data-filter=".<?php echo $category->category ?>" class="cbp-filter-item"> <?php echo $category->category_name ?> </div>
                        <?php endforeach; 
                        ?>  



                    </div><!--/end Filters Container-->



                    <div id="grid-container" class="cbp-l-grid-project">

                         <?php 
                            foreach ($projects as $project):                             
                        ?>
                        <div class="cbp-item <?php echo $project->category ?> print">
                            <a class="cbp-captionclients" data-title="FBK<br>by Jack Lee">
                                <div class="cbp-caption-defaultWrap">
                                    <img src="<?php echo base_url($project->smaller_url.'?dummy='.rand()) ?>" alt="">
                                </div>
                            </a>
                        </div>
                        <?php endforeach; 
                        ?>                                


                      

                        
                    </div>

                    <!-- <div class="cbp-l-loadMore-button">
                        <a href="<?php echo theme_url('assets/ajax/loadMore.html') ?>" class="cbp-l-loadMore-button-link">LOAD MORE</a>
                    </div> -->
                </div>
            </div>

            <div class="clients-section parallaxBg">
                <div class="container">
                    <div class="title-v1">
                        <h2>Our Clients</h2>
                    </div>
                    <ul class="owl-clients-v2">
                        
                         <?php 
                            foreach ($clients as $client):                             
                        ?>
                        
                        <li class="item"><a><img src="<?php echo base_url($client->logo.'?dummy='.rand()) ?>" title="<?php echo $client->company ?>"></a></li>
                        
                        <?php endforeach; 
                        ?>     
                                                
                    </ul>
                </div>
            </div>

            <!--div class="testimonials-v3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <ul class="list-unstyled owl-ts-v1">
                                <li class="item">
                                    <img class="rounded-x img-bordered" src="<?php echo theme_img('team/img3-sm.jpg'); ?>" alt="">
                                    <div class="testimonials-v3-title">
                                        <p>David Case</p>
                                        <span>Web Developer, Google</span>
                                    </div>
                                    <p>I just wanted to tell you how much I like to use Unify - <strong>it's so sleek and elegant!</strong> <br>
                                    The customisation options you implemented are countless, and I feel sorry I can't use them all. Good job, and keep going!<p>
                                </li>
                                <li class="item">
                                    <img class="rounded-x img-bordered" src="<?php echo theme_img('team/img2-sm.jpg') ?>" alt="">
                                    <div class="testimonials-v3-title">
                                        <p>Tina Krueger</p>
                                        <span>UI Designer, Apple</span>
                                    </div>
                                    <p>Keep up the great work. Your template is by far the best on the market in terms of features, quality and value or money.</p>
                                </li>
                                <li class="item">
                                    <img class="rounded-x img-bordered" src="<?php echo theme_img('team/img1-sm.jpg') ?>" alt="">
                                    <div class="testimonials-v3-title">
                                        <p>John Clarck</p>
                                        <span>Marketing &amp; Cunsulting, IBM</span>
                                    </div>
                                    <p>So far I really like the theme. I am looking forward to exploring more of your themes. Thank you!</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div-->
        </section>
        <!-- End Portfolio Section -->

        <!-- Contact Section -->
        <section id="contact" class="contacts-section">
            <div class="container content-lg">
                <div class="title-v1">
                    <h2>Contact Us</h2>
<!--                    <p>Lorem Ipsum industry. <br>
                        It has been the Lorem Ipsum industry.</p>-->
                </div>



                <div class="row contacts-in">
                    <div class="col-md-6 md-margin-bottom-40">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-home"></i> Lot 10957, 4 1/2 Miles, Jalan Kebun, 41000 Klang, Selangor Darul Ehsan, West Malaysia</li>
                            <li><i class="fa fa-phone"></i> 03-5162 5534</li>
                            <li><i class="fa fa-fax"></i> 03-5167 1797</li>
                            <li><i class="fa fa-home"></i> Working hours: 8am - 5pm (Monday - Saturday) </li>
                            <li><i class="fa fa-envelope"></i> <a href="sunhope9028@gmail.com">sunhope9028@gmail.com</a></li>
                            <li><i class="fa fa-envelope"></i> <a href="waichoon_lee@hotmail.com">waichoon_lee@hotmail.com</a></li>
                            <li><i class="fa fa-globe"></i> <a href="www.sunhope.com.my">www.sunhope.com.my</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div class="alert allert-error hide" id="form-error">
                                <a class="close" data-dismiss="alert">×</a>
                        </div>
                        
                        <form action="" method="post" id="sky-form3" class="sky-form contact-style">
                            <fieldset>
                                <label>Name</label>
                                <div class="row">
                                    <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                        <div>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <label>Email <span class="color-red">*</span></label>
                                <div class="row">
                                    <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                        <div>
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <label>Message</label>
                                <div class="row">
                                    <div class="col-md-11 margin-bottom-20 col-md-offset-0">
                                        <div>
                                            <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <p><button type="button" onclick="send_email(); return false;" class="btn-u btn-brd btn-brd-hover btn-u-dark">Send Message</button></p>
                            </fieldset>

                            <div class="message">
                                <i class="rounded-x fa fa-check"></i>
                                <p>Your message was successfully sent!</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="copyright-section">
                <p><?php echo date("Y"); ?> &copy; All Rights Reserved. Sun Hope Industry Sdn Bhd</p>
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/Sun-Hope-Engineering-951607544873827/" target="_blank" data-original-title="Facebook" class="social_facebook rounded-x"></a></li>                
                </ul>
                <span class="page-scroll"><a href="#intro"><i class="fa fa-angle-double-up back-to-top"></i></a></span>
            </div>
        </section>
        <!-- End Contact Section -->

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                        <div class="success_title">
                            <h4 class="modal-title">Thank you!!!</h4>
                        </div>
                        
                        <div class="error_title">
                            <h4 class="modal-title">Sorry!!!</h4>
                        </div>
                        
                    </div>
                    <div class="modal-body">                        
                        <p class="success_message">Your message has been successfully sent. We will contact you very soon!</p>
                        <p class="error_message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



        <!-- JS Global Compulsory -->
        <?php echo theme_unify_js('assets/plugins/jquery/jquery.min.js', true); ?>
        <?php echo theme_unify_js('assets/plugins/jquery/jquery-migrate.min.js', true); ?>
        <?php echo theme_unify_js('assets/plugins/bootstrap/js/bootstrap.min.js', true); ?>    
        <!-- JS Implementing Plugins -->
        <?php echo theme_unify_js('assets/plugins/smoothScroll.js', true); ?>        
        <?php echo theme_unify_js('assets/plugins/jquery.easing.min.js', true); ?>    

        <?php echo theme_unify_js('assets/plugins/pace/pace.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/jquery.parallax.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/counter/waypoints.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/counter/jquery.counterup.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/owl-carousel/owl.carousel.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js', true); ?>    
        <?php echo theme_unify_js('assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js', true); ?>    
        <!-- JS Page Level-->
        <?php echo theme_js('one.app.js', true); ?>    
        <?php echo theme_js('forms/login.js', true); ?>  
        <?php echo theme_js('forms/contact.js', true); ?>  
        <?php echo theme_js('plugins/pace-loader.js', true); ?>  
        <?php echo theme_js('plugins/owl-carousel.js', true); ?>  
        <?php echo theme_js('plugins/revolution-slider.js', true); ?>  
        <?php echo theme_js('plugins/cube-portfolio/cube-portfolio-lightbox.js', true); ?>  

        <script type="text/javascript">
            jQuery(document).ready(function () {
                App.init();
                App.initCounter();
                App.initParallaxBg();
                LoginForm.initLoginForm();
                ContactForm.initContactForm();
                OwlCarousel.initOwlCarousel();
                RevolutionSlider.initRSfullScreen();

                $("#grid-container").cubeportfolio('destroy');

                $('#grid-container').cubeportfolio({
                    /**
                     *  This callback function will be trigger after the singlePage popup will be opened. (@param item = the current item clicked)
                     */
                    singlePageInlineCallback: function (href, element) {
                        // add content to singlePageInline
                        var that = this;

                        var contentSinglePage = '<div class="cbp-l-inline"><div class="cbp-l-inline-left">';
                        var imagePath = element.getElementsByTagName("img")[0].currentSrc;
                        var title = element.getElementsByClassName("cbp-l-caption-title")[0].innerHTML;
                        var subTitle = element.getElementsByClassName("cbp-l-caption-desc")[0].innerHTML;
                        var description = element.getElementsByClassName("cbp-l-caption-long-desc")[0].innerHTML;

                        contentSinglePage += '<img src="' + imagePath + '" alt="Dashboard" class="cbp-l-project-img"></div><div class="cbp-l-inline-right">';
                        contentSinglePage += '<div class="cbp-l-inline-title">' + title + '</div><div class="cbp-l-inline-subtitle">' + subTitle + '</div>';
                        contentSinglePage += '<div class="cbp-l-inline-desc">' + description + '</div></div></div>';

                        that.updateSinglePageInline(contentSinglePage);

                        //that.updateSinglePageInline('<div class="cbp-l-inline"><div class="cbp-l-inline-left"><img src="uploads/project/Akinbina.JPG" alt="Dashboard" class="cbp-l-project-img"></div><div class="cbp-l-inline-right"><div class="cbp-l-inline-title">Akinbina</div><div class="cbp-l-inline-subtitle">by Jack Lee</div><div class="cbp-l-inline-desc">Akinbina is a Akinbina</div></div></div>');

                    }, singlePageInlinePosition: 'below'

                });

            });
            
            function send_email()
                {
                    //ContactForm.initContactForm();
                    
                    //$('#sky-form3 button[type="button"]').attr('disabled', true);
                    $('#myModal').modal('hide'); 
                    

                    $.post("<?php echo site_url('cart/send_email'); ?>", {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        message: $('#message').val()
                    },
                    function (data) {
                            console.log(data);
                            if (data == 1)
                            {                               
                                <?php if($this->session->flashdata('success')){ ?>
                                    $('.success_message').show();
                                    $('.success_title').show();                                
                                    $('.error_message').hide();
                                    $('.error_title').hide();
                                    $('#myModal').modal('show');
                                    
                                    $('#name').val('');
                                    $('#email').val('');
                                    $('#message').val('');
                                <?php } ?>   

                            } else
                            {
                                console.log("test");
                                $('.success_message').hide();
                                $('.success_title').hide();
                                $('.error_message').html(data).show();
                                $('.error_title').show();
                                $('#myModal').modal('show');

                            }
                        //$('#sky-form3 button[type="button"]').attr('enable', true);
                        });
                          
                    
                    
                }
            
            
            
            
        </script>
        <!--[if lt IE 9]>
        
        
        <?php echo theme_unify_js('assets/plugins/respond.js', true); ?>  
        <?php echo theme_unify_js('assets/plugins/html5shiv.js', true); ?>  
        <?php echo theme_js('plugins/placeholder-IE-fixes.js', true); ?>  
        <?php echo theme_unify_js('assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js', true); ?>  
            
         
        <![endif]-->

        <!--[if lt IE 10]>
        <?php echo theme_unify_js('assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js', true); ?>  
            
        <![endif]-->
    </body>
</html>