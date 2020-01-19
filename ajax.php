<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Ajax Loader 1 2.0.0.0
    Core ? ajax.php
    Release Tiime:  2:52 PM 12/22/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Ajax Loader 1';
#---------------------------------------------------Comly Loader---------------------------------------------------
    if (file_exists('comly1.php')) {
        require_once('comly1.php');
    } else {
        //$error_id = $SYS->Error($layer,NULL,$pageID,"Comly Missing");
        die("Error: $error_id. <br />Comly Run Missing !");
    }
#---------------------------------------------------Switch Action---------------------------------------------------
    if (!isset($_GET["a"]))  {
        die("No Action !");
    } else {
        $called_action = $_GET["a"];
    }
switch ($called_action) {
#---------------------------------------------------Action ~ Test---------------------------------------------------
    case "test":
        if (!isset($_POST["var"]) && !isset($_GET["var"])) {
            die("No var !");
        } else  {
            if (!isset($_GET["var"])) {
                $var = $_POST["var"];
            } else {
                $var = $_GET["var"];
            }
        }
    See($var);
    break;
#---------------------------------------------------Action ~ Genratre Short Link---------------------------------------------------
    case "GenShortLink":
        if (!isset($_POST["url"]) && !isset($_GET["url"])) {
            die("No url !");
        } else  {
            if (!isset($_GET["url"])) {
                $URL = $_POST["url"];
            } else {
                $URL = $_GET["url"];
            }
        }
    GenShortLink($URL);
    break;
#---------------------------------------------------Action ~ NULL---------------------------------------------------
    break;
    default:
        $error_id = $SYS->Error("No Action !",$layer,$site_lang,$pageID);
        die("Error: $error_id. <br />No Action !");
    }
?>