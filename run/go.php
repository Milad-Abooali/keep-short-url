<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Gorun 2.0.0.0
    Core ? go.php
    Release Tiime:  11:26 AM 12/24/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Gorun';
#---------------------------------------------------Place Here---------------------------------------------------
    if (!isset($_GET["run"]))  {
        $URL='http://booo.ir';
    } else {
        $URL = $_GET["run"];
    }
    function AddVisit($nlink) {
        $sql = "UPDATE links SET visits=visits+1 WHERE nlink='$nlink'";
        LinkDB($sql,$close=1);
    }
    function GoURL($nlink){
        AddVisit($nlink);
        $SYS = new Mahan_SYS();
        $URL=$SYS->Select('links','link',"nlink='$nlink'",0,1);
        echo $URL;
    }
?>