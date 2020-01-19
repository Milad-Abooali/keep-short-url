<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Functions 2.0.0.0
    Core ? functions.php
    Release Tiime:  1:05 PM 12/22/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Functions';
#---------------------------------------------------ConfigMe---------------------------------------------------
    if (file_exists('configme.php')) {
        include('configme.php');
    } else {
        die('Please Install Mahan Configration.');
    }
#---------------------------------------------------Database Loader---------------------------------------------------
    if (file_exists('lib_database.php')) {
        include('lib_database.php');
    } else {
        die('Database Loader Missing !');
    }
    $DB = new Mahan_DB();
#---------------------------------------------------System Loader---------------------------------------------------
    if (file_exists('lib_system.php')) {
        include('lib_system.php');
    } else {
        die('System Loader Missing !');
    }
    $SYS = new Mahan_SYS();
    $SITE = new Mahan_SITE();
#---------------------------------------------------Genratre Short Link---------------------------------------------------
function GenShortLink($URL) {
    $table='links';
    $SYS = new Mahan_SYS();
    $exsit_url = $SYS->Exist($table,$URL,'link');
    if ($exsit_url==False) {
        $sha256=$SYS->HashIt($URL)['sha256'];
        $nc=rand(3,4);
        $ns=rand(33,58);
        $nlink=substr($sha256,$ns,$nc);
        $exsit = $SYS->Exist($table,$nlink,'nlink');
        if ($exsit==False) {
            $sha256=$SYS->HashIt($URL)['sha256'];
            $nc=rand(4,5);
            $ns=rand(6,38);
            $nlink=substr($sha256,$ns,$nc);
            $table='links';
            $exsit = $SYS->Exist($table,$nlink,'nlink');
        }
        $IP = $SYS->UserIP();
        $array=array(
                        "link"=>"$URL",
                        "nlink"=>"$nlink",
                        "ip	"=>"$IP"
                        );
        $SYS->Insert($table,$array);
        echo SITE_URL.$nlink;
    } else {
		$old = $SYS->Select($table,'nlink',"link='$URL'",0,1);
        echo SITE_URL.$old;
    }
}
#---------------------------------------------------Place Here---------------------------------------------------

//See('1');
//$DB->Reset('error_logs');
//$DB->Reset('visitors');
//$DB->Reset('counters');

?>