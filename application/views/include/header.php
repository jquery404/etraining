<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel='shortcut icon' href='<?php echo base_url(); ?>assets/imgs/taxi.ico' type="image/x-icon"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/theme.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->
</head>

<body class="<?php if(isset($body_class)) echo $body_class; ?>">

  <?php if(isset($show_header)): ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E-Log</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-Log</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">


    </nav>
  </header>

  <?php endif; ?>

  <?php if(isset($show_nav)): ?>

  <div class="nav-side-menu">
    <div class="brand">Welcome <?php echo $role; ?></div>
    <i class="fa fa-bars fa-3x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
      <ul id="menu-content" class="menu-content collapse out">
      
        <li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-home fa-lg"></i> Home</a></li>
        <?php
          foreach ($permissions as $key => $value) {
            if($value == "add_staff") echo "<li><a href='".site_url('home/add')."'><i class='fa fa-plus-circle fa-lg'></i> Add Staff</a></li>";
            if($value == "search_staff") echo "<li><a href='".site_url('search')."'><i class='fa fa-search fa-lg'></i> Search Staff</a></li>";
            if($value == "invite_user") echo "<li><a href='".site_url('home/invite_user')."'><i class='fa fa-plug fa-lg'></i> Invite User</a></li>";
            if($value == "user_group") echo "<li><a href='".site_url('home/user_group')."'><i class='fa fa-cubes fa-lg'></i> User Group</a></li>";
            if($value == "toggle_user") echo "<li><a href='".site_url('home/user_toggle')."'><i class='fa fa-bolt fa-lg'></i> User Toggle</a></li>";
            if($value == "print_staff") echo "<li><a href='".site_url('home/printing')."'><i class='fa fa-print fa-lg'></i> Print</a></li>";
          }
        ?>
        <li><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-circle-o fa-lg"></i> Log Out</a></li>

      

      </ul>
    </div>
  </div>

  <?php endif; ?>
