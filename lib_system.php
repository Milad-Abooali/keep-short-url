<?php

/*'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    #   Mahan 2.0.0.0
    #   Author: Codebox <mahan@codebox.ir>
    #   Copyright   2011-2017 (c) Codebox.ir
    ------------------------------------------------------------------------
    System Loader 2.0.0.0
    Core ? functions.php > lib_system.php
    Release Tiime:  12:01 PM 12/21/2016
    Author: Milad Abooali <m.abooali@hotmail.com>
-----------------------------------------------------------------------------*/
    if(!isset ($pageID)) {
        $pageID = '';
    }
    Global $pageID;
    $pageID.='>System Loader';
#---------------------------------------------------SYS > See Contents---------------------------------------------------
function See($string=0,$item=NULL){
    if (is_array($string)) {
        if (isset($item)) {
            echo $string[$item];
        } else {
            print_r($string);
        }
    } else {
        echo $string;
    }
}
#---------------------------------------------------@ SYS @---------------------------------------------------
Class Mahan_SYS extends Mahan_DB {
#---------------------------------------------------SYS > Get IP---------------------------------------------------
    public function UserIP() {
        if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }
        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;
        return $ip;
    } 
#---------------------------------------------------SYS > Add Error---------------------------------------------------
    public function Error($error,$layer=0,$lang=NULL,$pageID=NULL){
        $table='error_logs';
        if (!isset($_SESSION['LOGIN']))  {
            $user='#system';
        } elseif ($_SESSION['LOGIN']==False) {
            $user='#system';
        } else {
            $user=$_SESSION['LOGIN'];
        }
        $IP = $this->UserIP();
        $array=array(
                            "lang"=>"$lang",
                            "page"=>"$pageID",
                            "error"=>"$error",
                            "user"=>"$user",
                            "ip"=>"$IP"
                            );
        $output = parent::Insert($table,$array);
        return $output;
    }
#---------------------------------------------------SYS > Multi Hash---------------------------------------------------
    public function HashIt($string="rand()"){
        $md5 = md5($string);
        $sha1 = sha1($string);
        $sha128 = hash('md5', $string);
        $sha256 = hash('sha256', $string);
        $sha1_md5 = sha1($md5);
        $md5_sha1 = md5($sha1);
        $output=array(
                            "mh1"=>"$sha1_md5",
                            "mh2"=>"$md5_sha1",
                            "md5"=>"$md5",
                            "sha1"=>"$sha1",
                            "sha128"=>"$sha128",
                            "sha256"=>"$sha256"
                            );
        return $output;
    }
#---------------------------------------------------SYS > Jalali Date---------------------------------------------------
    public function Jalali($gregorian=NULL){
        if (file_exists('date.php')) {
            include('date.php');
        }elseif (file_exists('../date.php')) {
            include('date.php');
        } else {
            $error_id = $this->Error(0,NULL,$page_id,'Jalali Date File Is Missing !');
            die("Error: $error_id. <br />Date File Missing !");
        }
        if ($gregorian==NULL) {
            $output = jdate('l j F Y');
       } else {
            $JD_Carray=array(
                                        date('Y', strtotime($gregorian)),
                                        date('m', strtotime($gregorian)),
                                        date('j', strtotime($gregorian))
                                        );   
            $JD_converted=gregorian_to_jalali($JD_Carray[0],$JD_Carray[1],$JD_Carray[2]);
            $JD_Warray=array(
                                        'ss'=>$JD_converted[0],
                                        'mm'=>$JD_converted[1],
                                        'rr'=>$JD_converted[2]
                                        );
            $JD_words=jdate_words($JD_Warray);
            $output=$JD_converted['2'].' '.$JD_words['mm'].' '.$JD_converted['0'];
        }
        return $output;
    }
#---------------------------------------------------SYS > Get Browser---------------------------------------------------
    public function Browser(){ 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {

        }
        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }
        if ($version==null || $version=="") {$version="?";}
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
#---------------------------------------------------SYS > Visits---------------------------------------------------
    public function Visits(){
        $session_id=session_id();
        $ip=$this->UserIP();
        $ua=$this->Browser();
        $platform=$ua['platform'];
        $browser=$ua['name'];
        
                $user_id=0; //////////////////////////////////////////////////////

        $sql = "INSERT INTO visitors (
                                                    session_id,
                                                    count,
                                                    user_id,
                                                    ip,
                                                    platform,
                                                    browser,
                                                    start_time
                                    ) VALUES (
                                                    '$session_id',
                                                    '1',
                                                    '$user_id',
                                                    '$ip',
                                                    '$platform',
                                                    '$browser',
                                                    NOW()
                                                  )
                ON DUPLICATE KEY
                UPDATE                     count=count+1,
                                                user_id=$user_id,
                                                last_activity=NOW()";
        LinkDB($sql);
        return True;
    }
#---------------------------------------------------SYS > Add Counts---------------------------------------------------
    public function Counts($target,$type){
        $sql = "INSERT INTO counters (target,counts,type) VALUES ('$target','1','$type') 
                ON DUPLICATE KEY
                UPDATE counts=counts+1";
        LinkDB($sql);
        return True;
    }
}
#---------------------------------------------------@ SITE @---------------------------------------------------
Class Mahan_SITE extends Mahan_DB  {
    Public $table= 'site_settings';   
#---------------------------------------------------SITE > Siite Settings---------------------------------------------------
    public function Info($Q='*') {
        $output = parent::Select($this->table,$Q,1,0,1);
        return $output;
    }
#---------------------------------------------------SITE > Change Language---------------------------------------------------
    public function ChangeLang($lang) {
        $_SESSION['site_lang'] = $lang; 
        return True;
    }
}

#---------------------------------------------------Place Here---------------------------------------------------

?>