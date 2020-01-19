<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    ConfigMe 2.0.0.0
    Core ? functions.php > configme.php
    Release Tiime:  11:53 AM 12/21/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>ConfigMe';
#---------------------------------------------------SITE Path---------------------------------------------------
    define('SITE_URL', 'http://booo.ir/');
    define('ADMIN_URL', 'http://booo.ir/in');
#---------------------------------------------------Database Informations---------------------------------------------------
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', '  ');
    define('DB_PASSWORD', '  ');
    define('DB_DATABASE', 'boooir_1');
    
#---------------------------------------------------Debug Settings---------------------------------------------------
    //error_reporting(-1);
    //ini_set('display_errors', 'On');
    //set_error_handler("var_dump");

#---------------------------------------------------Place Here---------------------------------------------------

