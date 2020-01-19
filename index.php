<?php
/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Router 1 2.0.0.0
    Core ? index.php
    Release Tiime:  1:12 PM 12/22/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Router 1';
#---------------------------------------------------Comly Loader---------------------------------------------------
    if (file_exists('comly1.php')) {
        require_once('comly1.php');
    } else {
        //$error_id = $SYS->Error("Comly Missing",$layer,NULL,$pageID);
        die("Error: $error_id. <br />Comly Run Missing !");
    }
#---------------------------------------------------Page Loader---------------------------------------------------
    if(!isset($_GET["run"]))  {
        $on_page = "home";
    } else  {
        $on_page = $_GET["run"];
    }
    $page_run = 'run/'.$on_page.'.php';
    $page_lang = 'lang/'.$site_lang.'/'.$on_page.'.php';
    $page_view = 'view/'.$on_page.'.php';
    if (file_exists($page_view)) {
        if (file_exists($page_run)) {
            include($page_run);
        }
        if (file_exists($page_lang)) {
            include($page_lang);
        }
        if (file_exists('view/header.php')) {
            include('view/header.php');
            include('run/header.php');
        } else  {
            $error_id = $SYS->Error("Header Missing In $on_page",$layer,$site_lang,$pageID);
            die("Error: $error_id. <br />Header Run Missing !");
        }
            include($page_view);
        if (file_exists('view/footer.php')) {
            include('view/footer.php');
            include('run/footer.php');
        } else  {
            $error_id = $SYS->Error("Footer Run Missing In $on_page",$layer,$site_lang,$pageID);
            die("Error: $error_id. <br />Footer Run Missing !");
        }
    } else {
        $on_page = "go";
        $page_run = 'run/'.$on_page.'.php';
        $page_lang = 'lang/'.$site_lang.'/'.$on_page.'.php';
        $page_view = 'view/'.$on_page.'.php';
        if (file_exists($page_run)) {
            include($page_run);
        }
        if (file_exists($page_lang)) {
            include($page_lang);
        }
        if (file_exists('view/header.php')) {
            include('view/header.php');
            include('run/header.php');
        } else  {
            $error_id = $SYS->Error("Header Missing In $on_page",$layer,$site_lang,$pageID);
            die("Error: $error_id. <br />Header Run Missing !");
        }
            include($page_view);
        if (file_exists('view/footer.php')) {
            include('view/footer.php');
            include('run/footer.php');
        } else  {
            $error_id = $SYS->Error("Footer Run Missing In $on_page",$layer,$site_lang,$pageID);
            die("Error: $error_id. <br />Footer Run Missing !");
        }
   }
#---------------------------------------------------Count Visits---------------------------------------------------
    $SYS->Counts($on_page,'page');
    $SYS->Visits();
?>