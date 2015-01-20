<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset='utf-8'>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/site.js" type="text/javascript"></script>
</head>
<body>
<div id="usernavbar" class="pure-menu pure-menu-open pure-menu-horizontal"><?php if($logged_in == true){echo '<a href="#" class="pure-menu-heading">'.$username.'</a>';}?><ul><?php if($logged_in == true){echo '<li><a href="/profile/1">Profile</a></li><li><a href="/user/logout">Logout</a></li>'; if($access >= 1){echo '<li><a href="/admin">Admin</a></li>';}}else{echo '<li><a href="/login">Login</a></li><li><a href="/register">Register</a></li>';} ?></ul></div>
<div id="header"><h1><a href="/">Project Zarmina</a></h1></div>
<div id="menuwrap"><?php if($logged_in == true) {echo '<a href="match/create">Create Game</a>';}?></div>
<div id="containerwrap">
