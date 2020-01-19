<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $SITE->Info('description'); ?>">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $SITE->Info('name'); ?></title>
    <link href="view/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="view/js/jquery-1.11.0.js"></script>
</head>
<body>
<!--
    <nav id="header" class="navbar navbar-fixed-top">
        <div id="header-container" class="container navbar-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="brand" class="navbar-brand" href="#">Booo.ir</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo SITE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>?run=about">About</a></li>
                    <li><a href="<?php echo SITE_URL; ?>?run=contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav> 
-->
    
<div class="container Bpage">
    <div class="form-group">
        <br /><br />
        <input id="furl" type="url" class="Burl form-control text-center" id="pwd" placeholder="URL"><br />
        <div id="submiturl" class="text-center btn btn-block btn-success" >Genrate Short URL</div>
        <br /><br /><br />
        <div class="Bnurl text-center" ></div>
        <div id="ifbox"class="alert" ></div>
    </div>
</div>