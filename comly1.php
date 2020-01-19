<?php
/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Comly 1 2.0.0.0
    Core ? index.php > comly1.php
    Release Tiime:  3:54 PM 12/21/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Comly 1';
    $layer= 1;
    Global $layer;
#---------------------------------------------------L1 Login---------------------------------------------------
    if(!isset($_SESSION['LOGIN']))  {
        $_SESSION['LOGIN']=False;
    }
#---------------------------------------------------Load Functions---------------------------------------------------
    if (file_exists('functions.php')) {
        include('functions.php');
    }else{
        die('Functions Missing !');
    }
#---------------------------------------------------Select & Count Language---------------------------------------------------
    if(!isset($_SESSION['site_lang']))  {
        $site_lang = $SITE->Info('lang');
    } else  {
        $site_lang = $_SESSION['site_lang'];
    }
    $lang_path = 'lang/'.$site_lang.'/com.php';
    if (file_exists($lang_path)) {
        include($lang_path);
        $SYS->Counts($site_lang,'lang');
    }else{
        $error_id = $SYS->Error("$lang_path Missing",$layer,$site_lang,$pageID);
        die("Error: $error_id. <br />Language File Is Missing !");
    }
#---------------------------------------------------Count Layer---------------------------------------------------
    $SYS->Counts(1,'layer');
#---------------------------------------------------Place Here---------------------------------------------------   

?>