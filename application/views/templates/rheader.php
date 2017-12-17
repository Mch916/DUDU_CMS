<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DuDu Party Room</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- external javascript files -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url('js/jquery-2.1.4.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.menu-aim.js');?>" ></script>
        <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/main.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/modernizr.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/common.js');?>" ></script>

        <!-- external css files -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sidebar.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/mobile.css');?>">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
        <style>
          .fc-content {
            cursor: pointer;
          }
          @media only screen and (max-width: 500px) {
            .fc-toolbar h2 {
                font-size: 15px;
            }
            .fc button {
                height:0;
                padding: 0;
                font-size:0.9em;
            }
          }

        </style>
    </head>
        <body>
            <header class="cd-main-header" style="z-index:10;">
    		<a href="#0" class="cd-logo"><img src="<?php echo base_url('image/cd-logo.svg');?>" alt="Logo"></a>

    		<!-- <div class="cd-search is-hidden">
    			<form action="#0">
    				<input type="search" placeholder="Search...">
    			</form>
    		</div> cd-search -->

    		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

    		<nav class="cd-nav">
    			<ul class="cd-top-nav">
    				<li><a href="http://dudupartyroomhk.com/">Website</a></li>
            <?php if($this->session->userdata('login')) : ?>
    				<li class="has-children account">
    					<a href="#0">
    						<img src="<?php echo base_url('image/cd-avatar.png');?>" alt="avatar">
    						<?php echo $this->session->userdata('username');?>
    					</a>
    					<ul>
    						<li><a href="<?php echo site_url('users/change_pw');?>">Edit Account</a></li>
    						<li><a href="<?php echo base_url('index.php/users/logout');?>">Logout</a></li>
    					</ul>
    				</li>
          <?php endif; ?>
    			</ul>
    		</nav>
    	</header> <!-- .cd-main-header -->

      <?php if($this->session->userdata('login')) : ?>
    	<main class="cd-main-content">
    		<nav class="cd-side-nav" style="z-index:9;">
    			<ul>
    				<li class="cd-label">Main</li>
    				<li class="overview">
    					<a href="<?php echo base_url('index.php/dashboard');?>">Dashboard</a>
    				</li>
    				<li class="notifications">
    					<a href="<?php echo base_url('index.php/bookings');?>">Booking</a>
    				</li>
            <li class="notifications">
    					<a href="<?php echo base_url('index.php/works');?>">Work Schedule</a>
    				</li>
    				<li class="comments">
    					<a href="<?php echo base_url('index.php/expense');?>">Expense</a>
    				</li>
    			</ul>

    			<ul>
    				<li class="cd-label">Secondary</li>
    				<li class="has-children bookmarks">
    					<a href="#0">Report</a>
    					<ul>
    						<li><a href="<?php echo site_url('report/index');?>">Party Room</a></li>
    						<li><a href="#0">Income</a></li>
    					</ul>
    				</li>
            <?php if($this->session->userdata('username') == 'admin') : ?>
    				<li class="has-children users">
    					<a href="#0">Users</a>
              <ul>
    						<li><a href="<?php echo site_url('users/create');?>">Create User</a></li>
    						<li><a href="<?php echo site_url('users/edit');?>">Edit User</a></li>
    					</ul>
    				</li>
            <?php endif; ?>
    			</ul>

                <ul>
    				<li class="cd-label">Action</li>
    				<li class="action-btn"><a href="<?php echo base_url('index.php/dashboard');?>">+ Button</a></li>
    			</ul>
    		</nav>
      <?php endif; ?>

    		<div class="content-wrapper">
