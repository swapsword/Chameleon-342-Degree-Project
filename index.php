<!DOCTYPE HTML>
<html>
<head>
    <!-- Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php include 'includes/logo.php';?>
    <title>Chameleon-342</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Load CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <link href="css/index.css?<?php time();?>" rel="stylesheet" type="text/css" />
    <!-- Load Fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" type="text/css" />
    <!-- Load jQuery library -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!-- Load custom js -->
    <script type="text/javascript" src="js/custom.js<?php time();?>"></script>
    <script src="/semantic/out/semantic.min.js"></script>
</head>
<body class="pushable">
<div class="ui top left attached button menu compact">
    <a class="item">
        <i class="sidebar icon"></i>
        Menu
    </a>
</div>
<div class="ui bottom attached segment pushable">
    <div class="ui inverted labeled icon left inline vertical sidebar menu">
        <a href="<?php include 'includes/link.php';?>" class="item">
            <i class="home icon"></i>
            Home
        </a>
        <a href="<?php include 'includes/link.php';?>trafo-dashboard.php" class="item">
            <i class="dashboard icon"></i>
            TRAFO Dashboard
        </a>
        <a href="<?php include 'includes/link.php';?>ma-dashboard.php" class="item">
            <i class="dashboard icon"></i>
            MA Dashboard
        </a>
        <a href="<?php include 'includes/link.php';?>account-listings.php" class="item">
            <i class="browser icon"></i>
            Account Listings
        </a>
        <a href="<?php include 'includes/link.php';?>contact.php" class="item">
            <i class="phone icon"></i>
            Contact
        </a>
    </div>
    <div class="pusher">
        <div id="main">
            <a href="http://cisco.com" class="ui large image">
                <img src="images/cisco_logo.png">
            </a>
            <!-- Main Input -->
            <h1>@Cisco Search for dynamic account view:</h1>
            <div style="width: 355px;" class="ui fluid icon input">
                <input type="text" id="search" autocomplete="off">
                <i class="search icon"></i>
            </div>
            <!-- Show Results -->
            <h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
            <ul id="results"></ul>
        </div>
        <div style="height: 253px">
        </div>
    </div>
</div>
</body>
</html>