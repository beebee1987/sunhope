<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>


<link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet" />
<!-- Morris -->
<link type="text/css" href="<?php echo base_url('assets/css/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet" />
<!-- Gritter -->
<link type="text/css" href="<?php echo base_url('assets/js/plugins/gritter/jquery.gritter.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/animate.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/print.css');?>" rel="stylesheet" />

<link type="text/css" href="<?php echo base_url('assets/css/plugins/datapicker/datepicker3.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/plugins/summernote/summernote.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/plugins/summernote/summernote-bs3.css');?>" rel="stylesheet" />

<link type="text/css" href="<?php echo base_url('assets/css/plugins/dropzone/basic.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/plugins/dropzone/dropzone.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/plugins/jasny/jasny-bootstrap.min.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/plugins/codemirror/codemirror.css');?>" rel="stylesheet" />


</head>

<body>
<?php 
	$admin_url = site_url($this->config->item('admin_folder')).'/';
	$current_admin	= $this->session->userdata('admin');
?>
<div id="wrapper">

<nav class="navbar-default navbar-static-side no-print" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav no-print" id="side-menu">
                <li class="nav-header">
                    <!--div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile_small.jpg')?>" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div-->
                    <div class="logo-element">
                        Sunhope Industry Sdn Bhd
                    </div>
                </li>
                <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'dashboard') ? 'class="active"' : ''; ?>>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo lang('common_home');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li ><a href="<?php echo $admin_url?>">Overwiew</a></li>                        
                    </ul>
                </li>
                <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'slider') ? 'class="active"' : ''; ?>>
                        <a href="<?php echo $admin_url?>slider"><i class="fa fa-picture-o"></i> <span class="nav-label"><?php echo lang('common_slider') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a>
                </li>  
                <?php if($this->auth->check_access('Admin')) : ?>
	                <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'admin') ? 'class="active"' : ''; ?>>
	                    <a href="<?php echo $admin_url;?>admin"><i class="fa fa-user-md"></i> <span class="nav-label"><?php echo lang('common_administrators') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a>
	                </li>
                <?php endif;?>
                
                <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'messages') ? 'class="active"' : ''; ?>>
                    <a href="#"><i class="fa fa-vimeo-square"></i> <span class="nav-label"><?php echo lang('common_messages');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo $admin_url;?>messages"><i class="fa fa-list-ol"></i> <span class="nav-label"><?php echo lang('common_messages') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a></li>
                    </ul>
                </li>

                 <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'clients') ? 'class="active"' : ''; ?>>
                    <a href="#"><i class="fa fa-vimeo-square"></i> <span class="nav-label"><?php echo lang('common_clients');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo $admin_url;?>clients"><i class="fa fa-list-ol"></i> <span class="nav-label"><?php echo lang('common_clients') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a></li>
                    </ul>
                </li>
                
                <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'projects/form') ? 'class="active"' : ''; ?>>
                    <a href="#"><i class="fa fa-vimeo-square"></i> <span class="nav-label"><?php echo lang('common_projects');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo $admin_url;?>projects"><i class="fa fa-list-ol"></i> <span class="nav-label"><?php echo lang('common_project') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a></li>
                        <li><a href="<?php echo $admin_url;?>projectcategorys"><i class="fa fa-list-ol"></i> <span class="nav-label"><?php echo lang('common_category') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a></li>
                        <li><a href="<?php echo $admin_url;?>projectcategorys/form"><i class="fa fa-list-ol"></i> <span class="nav-label"><?php echo lang('common_category_form') ?></span> <!--span class="label label-primary pull-right">NEW</span--></a></li>
                    </ul>
                </li>
                                                       
            </ul>

        </div>
    </nav>

<div id="page-wrapper" class="gray-bg">

	<div class="row border-bottom no-print">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!--form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form-->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Sun Hope Industry Sdn. Bhd.</span>
                </li>
                <!-- li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/a7.jpg')?>">
                                </a>
                                <div>
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/a4.jpg')?>">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile.jpg')?>">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li-->
                <!--li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li-->


                <li>
                    <a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>">
                        <i class="fa fa-sign-out"></i> <?php echo lang('common_log_out')?>
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
        </div>

<div class="wrapper wrapper-content">
     

<div class="row wrapper border-bottom white-bg page-heading toast-bottom-full-width no-print">
                <div class="col-lg-10">
                    <h2><?php echo (isset($page_title) && !empty($page_title)) ? $page_title : '-' ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $admin_url?>"><?php echo lang('home')?></a>
                        </li>                        
                        <li class="active">
                            <strong><?php echo (isset($page_title) && !empty($page_title)) ? $page_title : '-' ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
</div>
    <?php
    //lets have the flashdata overright "$message" if it exists
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error  = $this->session->flashdata('error');
    }
    
    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?>
    
    <div id="js_error_container" class="alert alert-error" style="display:none;"> 
        <p id="js_error"></p>
    </div>
    
    <div id="js_note_container" class="alert alert-note" style="display:none;">
        
    </div>
    
    <?php if (!empty($message)): ?>
  
        <div class="alert alert-success alert-dismissable">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <?php echo $message; ?>
        </div>
  
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
    
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <?php echo $error; ?>
        </div>
	   
    <?php endif; ?>
  
  
    
    