<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    Database Loader 2.0.0.0
    Core ? functions.php > lib_database.php
    Release Tiime:  11:53 AM 12/21/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>Database Loader';
#---------------------------------------------------Link Database---------------------------------------------------
function LinkDB($sql,$close=1){
    $con_db = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ('Cannot connect to server');
    mysqli_set_charset($con_db, 'utf8');
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    mb_http_input('UTF-8');
    mb_language('uni');
    mb_regex_encoding('UTF-8');
    ob_start('mb_output_handler');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $retval = mysqli_query($con_db,$sql) or die('Could not look up user information; ' . mysqli_error($con_db));
    if ($close==1) {
        mysqli_close($con_db);
    }
    return $retval;
}
#---------------------------------------------------Query Database---------------------------------------------------
function QDB($sql,$order,$limit){
    if (!empty($sql)){
        if ($order!=0){
            $sql.=" ORDER BY $order ";
        }
        if ($limit!=0){
            $sql.=" limit $limit";
        }
        $retval = LinkDB($sql);
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $output[] = $row;
        }
        if (!empty($output)){
            if ($limit==1){
                return $output['0'];
            }else{
                return $output;
            }
        }
        return False;
    }else{
        return False;
    }
}
#---------------------------------------------------Tables Size---------------------------------------------------
function SizeT() { 
    $tables = array();
    $rb_name = DB_DATABASE;
    $rb_user = DB_USERNAME;
    $rb_pwd = DB_PASSWORD;
    $rb_host = DB_HOSTNAME;
    $con_db = mysqli_connect($rb_host, $rb_user, $rb_pwd, $rb_name) or die ('Cannot connect to server');
    mysqli_select_db($con_db, $rb_name);
    $result = mysqli_query($con_db,"SHOW TABLE STATUS");  
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $total_size = ($row[ "Data_length" ] + 
                       $row[ "Index_length" ]) / 1024;
        $tables[$row['Name']] = sprintf("%.2f", $total_size);
    }
    return $tables;
    mysqli_close($con_db);
}
#---------------------------------------------------@ db @---------------------------------------------------
class Mahan_DB {
#---------------------------------------------------DB > Count Table---------------------------------------------------
    public function Count($table, $day='all') {
        if ($day=='all') {
            $sql = "SELECT COUNT(*) FROM $table";
        } elseif ($day==0) {
            $sql = "SELECT COUNT(*) FROM $table WHERE count>1";
        } else {
            $sql = "SELECT COUNT(*) FROM $table WHERE DATE(`timestamp`) = CURDATE()-$day";
        }
        $count = QDB($sql,0,1);
        $output = number_format($count['COUNT(*)'], 0, '.', ' ');
        return $output;
    }
#---------------------------------------------------DB > Count Table By Range---------------------------------------------------
    public function Count_Range($table, $start, $end) {
        $sql = "SELECT COUNT(*) FROM $table WHERE DATE(`timestamp`) < $end and DATE(`timestamp`) >= $start";
        $count = QDB($sql,0,1);
        $output = number_format($count['COUNT(*)'], 0, '.', ' ');
        return $output;
    }
#---------------------------------------------------DB > Reset Table---------------------------------------------------
    public function Reset($table) {
        $sql = "TRUNCATE TABLE $table";
        LinkDB($sql);
        return True;
    }
#---------------------------------------------------DB > Delete Row---------------------------------------------------
    public function Delete($table,$id) {
        $sql = "DELETE FROM $table Where id=$id";
        LinkDB($sql);
        return True;
    }
#---------------------------------------------------DB > Select Table---------------------------------------------------
    public function Select($table,$Q='*',$where=1,$order=0,$limit=0) {
        $sql = "SELECT $Q FROM $table WHERE $where";
        $output = QDB($sql,$order,$limit);
        if ($output) {
            if ($Q=='*'){
                return $output;
            }else{
                return $output["$Q"];
            }
        } else {
            return False;
        }
    }
#---------------------------------------------------DB > Exist In Table---------------------------------------------------
    public function Exist($table,$Q,$C) {
        $sql = "SELECT * FROM $table WHERE $C='$Q'";
        $output = QDB($sql,0,1);
        if ($output) {
            return True;
        } else {
            return False;
        }
    }
#---------------------------------------------------DB >  Insert To Tables---------------------------------------------------
    public function Insert($table,$array) {
        $columns = implode(", ",array_keys($array));
        $values  = implode("', '", $array);
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        $con_db = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die ('Cannot connect to server');
        mysqli_set_charset($con_db, 'utf8');
        mb_internal_encoding('UTF-8');
        mb_http_output('UTF-8');
        mb_http_input('UTF-8');
        mb_language('uni');
        mb_regex_encoding('UTF-8');
        ob_start('mb_output_handler');
        if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}
        $retval = mysqli_query($con_db,$sql) or die('Could not look up user information; ' . mysqli_error($con_db));
        $output=mysqli_insert_id($con_db);
        mysqli_close($con_db);
        return $output;
    }
#---------------------------------------------------DB >Database Size---------------------------------------------------
    public function SizeDB() {
        $tables = SizeT();
        $sum = array_sum($tables)/1024;
        $output = number_format($sum, 2, '.', ' ');
        return $output;
    }
}

#---------------------------------------------------Place Here---------------------------------------------------

?>