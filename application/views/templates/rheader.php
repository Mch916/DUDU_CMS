<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DuDu Party Room</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- external javascript files -->
        <script type="text/javascript" src="<?php echo base_url('js/jquery-2.1.4.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.menu-aim.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/main.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/modernizr.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/staff.js');?>" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- external css files -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sidebar.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/mobile.css');?>">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
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
    				<li class="has-children account">
    					<a href="#0">
    						<img src="<?php echo base_url('image/cd-avatar.png');?>" alt="avatar">
    						Account
    					</a>
    					<ul>
    						<li><a href="#0">Edit Account</a></li>
    						<li><a href="#0">Logout</a></li>
    					</ul>
    				</li>
    			</ul>
    		</nav>
    	</header> <!-- .cd-main-header -->

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
    						<li><a href="#0">Party Room</a></li>
    						<li><a href="#0">Income</a></li>
    					</ul>
    				</li>
    				<li class="has-children images">
    					<a href="#0">Admin</a>
    					<ul>
    						<li><a href="<?php echo base_url('staff');?>">Staff</a></li>
    						<li><a href="<?php echo base_url('user');?>">Login</a></li>
    					</ul>
    				</li>

    				<li class="has-children users">
    					<a href="#0">Other</a>
    				</li>
    			</ul>

                <ul>
    				<li class="cd-label">Action</li>
    				<li class="action-btn"><a href="<?php echo base_url('index.php/dashboard');?>">+ Button</a></li>
    			</ul>
    		</nav>

    		<div class="content-wrapper">
