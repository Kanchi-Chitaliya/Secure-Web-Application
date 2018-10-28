<?php
#author:Kanchi Chitaliya, kach6618
#date:03/12/2018
#purpose:secure web application
#filename:sky-walk-lib.php

isset($_REQUEST["s"])?$s=strip_tags($_REQUEST["s"]):$s="";
isset($_REQUEST["name"])?$name=strip_tags($_REQUEST["name"]):$name="";
isset($_REQUEST["starname"])?$starname=strip_tags($_REQUEST["starname"]):$starname="";
isset($_REQUEST["starid"])?$starid=strip_tags($_REQUEST["starid"]):$starid="";
isset($_REQUEST["bodyid"])?$bodyid=strip_tags($_REQUEST["bodyid"]):$bodyid="";
isset($_REQUEST["bodyname"])?$bodyname=strip_tags($_REQUEST["bodyname"]):$bodyname="";
isset($_REQUEST["planetName"])?$planetName=strip_tags($_REQUEST["planetName"]):$planetName="";
isset($_REQUEST["distance_from_sun"])?$distance_from_sun=strip_tags($_REQUEST["distance_from_sun"]):$distance_from_sun="";
isset($_REQUEST["diameter"])?$diameter=strip_tags($_REQUEST["diameter"]):$diameter="";
isset($_REQUEST["mass"])?$mass=strip_tags($_REQUEST["mass"]):$mass="";
isset($_REQUEST["number_of_moons"])?$number_of_moons=strip_tags($_REQUEST["number_of_moons"]):$number_of_moons="";
isset($_REQUEST["distance_from_earth"])?$distance_from_earth=strip_tags($_REQUEST["distance_from_earth"]):$distance_from_earth="";
isset($_REQUEST["age"])?$age=strip_tags($_REQUEST["age"]):$age="";
isset($_REQUEST["constellation"])?$constellation=strip_tags($_REQUEST["constellation"]):$constellation="";

isset($_REQUEST["type"])?$type=strip_tags($_REQUEST["age"]):$type="";
isset($_REQUEST["postUser"])?$postUser=strip_tags($_REQUEST["postUser"]):$postUser="";
isset($_REQUEST["postPass"])?$postPass=$_REQUEST["postPass"]:$postPass="";
isset($_REQUEST["newPass"])?$newPass=$_REQUEST["newPass"]:$newPass="";
isset($_REQUEST["newUser"])?$newUser=strip_tags($_REQUEST["newUser"]):$newUser="";
isset($_REQUEST["data"])?$data=strip_tags($_REQUEST["data"]):$data="";
isset($_REQUEST["addUser"])?$addUser=strip_tags($_REQUEST["addUser"]):$addUser="";
isset($_REQUEST["newEmail"])?$newEmail=strip_tags($_REQUEST["newEmail"]):$newEmail="";
isset($_REQUEST["updatePass"])?$updatePass=$_REQUEST["updatePass"]:$updatePass="";
isset($_REQUEST["userid"])?$userid=strip_tags($_REQUEST["userid"]):$userid="";
#$white_list=array("127.0.0.1","128.138.65.109","10.201.26.174","198.18.8.42");
$ip=$_SERVER['REMOTE_ADDR'];
function connect(){
        $mycnf="/etc/sky-walk-mysql.conf";
        if(!file_exists($mycnf)){
                echo "ERROR: DB config file not found: $mycnf";
                exit;
        }

        $mysql_ini_array=parse_ini_file($mycnf);
        $db_host=$mysql_ini_array["host"];
        $db_user=$mysql_ini_array["user"];
        $db_pass=$mysql_ini_array["pass"];
        $db_port=$mysql_ini_array["port"];
        $db_name=$mysql_ini_array["dbName"];
        $db= mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

        if (!$db){
                print "Error connecting to DB:" . mysqli_connect_error();
                exit;
        }
        return $db;
}

function icheck($i){
        if ($i!=null){
                if(!is_numeric($i)){
                        print "<b>ERROR: </b>
                        Invalid Syntax. ";
                        exit;
                }
        }
}
#$white_list=array("127.0.0.1","128.138.65.109","10.201.26.174","198.18.8.42");
$ip=$_SERVER['REMOTE_ADDR'];
#$x=0;
function checkAuth($db,$ip,$postUser,$postPass,$white_list){
	if (in_array($ip,$white_list)){
		return;
	}else{
		
		#authenticate($db,$ip,$postUser,$postPass);
		login_check($db,$ip,$postUser,$postPass,$white_list);
		return;
}	
}

function login_check($db,$ip,$postUser,$postPass,$white_list){
	$ip=mysqli_real_escape_string($db,$ip);
	$x=0;

	#echo "$x";
	if ($stmt = mysqli_prepare($db, "select action from login where ip=? and date_sub(now(), INTERVAL 1 HOUR)")) {

		mysqli_stmt_bind_param($stmt,"s",$ip);
        	mysqli_stmt_execute($stmt);

        	mysqli_stmt_bind_result($stmt,$action);
        	while (mysqli_stmt_fetch($stmt)) {

			$action = htmlspecialchars($action);
			if ($action=="fail"){

				$x=$x+1;

			}
		}
	}mysqli_stmt_close($stmt);

	
	if($x>=3 and !(in_array($ip,$white_list))){
        	header("Location:login.php?message=blocked");
	
		exit;
    	}else{
		return;
}
		
	
} 
function insert_login($db, $ip, $postUser, $action){
	$postUser = mysqli_real_escape_string($db, $postUser);
        $ip = mysqli_real_escape_string($db, $ip);
        $action= mysqli_real_escape_string($db, $action);
        if ($stmt = mysqli_prepare($db, "insert into login set ip=?, user=?, action=?, date=NOW()")) {
		mysqli_stmt_bind_param($stmt, "sss", $ip, $postUser, $action);
		mysqli_stmt_execute($stmt);
		#mysqli_stmt_bind_result($stmt);
		mysqli_stmt_close($stmt);
        }

}
function check_uid($db,$postUser){
	$query="select userid from users where username=?";
        if($stmt=mysqli_prepare($db,$query)){
                mysqli_stmt_bind_param($stmt,"s",$postUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$userid);
                while(mysqli_stmt_fetch($stmt)){
                        $userid=htmlspecialchars($userid);
		}
                mysqli_stmt_close($stmt);
		if ($_SESSION['userid']==1){
			return 1;
		}else{
			return 0;
		}	

	}			
}

function authenticate($db,$ip,$postUser,$postPass){
	$white_list=array("127.0.0.1","128.138.65.109","10.201.26.174","198.18.8.42");
	$ip=$_SERVER['REMOTE_ADDR'];
	#echo "$ip";
	checkAuth($db,$ip,$postUser,$postPass,$white_list);
	$query="select userid,email,password,salt from users where username=?";
	if($stmt=mysqli_prepare($db,$query)){
		mysqli_stmt_bind_param($stmt,"s",$postUser);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$userid,$email,$password,$salt);
		while(mysqli_stmt_fetch($stmt)){
			$userid=htmlspecialchars($userid);
			$password=($password);
			$salt=$salt;
			$email=htmlspecialchars($email);
		}
		mysqli_stmt_close($stmt);
		$epass=hash('sha256',$postPass.$salt);
		if($epass==$password){
			session_regenerate_id();
			$_SESSION['userid']=$userid;
			$_SESSION['email']=$email;
			$_SESSION['authenticated']="yes";
			$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
			$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT']);
			$_SESSION['created']=time();
			error_log("***Error*** Sky-Walk App has Successful Login from:".$_SERVER['REMOTE_ADDR'],0);
			#echo "Hello";
			insert_login($db,$ip,$postUser,"success");
		#	exit;
			session_check();
		}elseif($postUser){
			insert_login($db,$ip,$postUser,"fail");
			error_log("***Error*** Sky-Walk App has Failed Login from:".$_SERVER['REMOTE_ADDR'],0);
			header("Location: /sky-walk/login.php");
			exit;
		}
		else{
			header("Location: /sky-walk/login.php");
                        exit;
		}
	}
}

function session_check(){
	if (isset($_SESSION['HTTP_USER_AGENT'])){
		if ($_SESSION['HTTP_USER_AGENT']!=md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT'])){
			header("Location: /sky-walk/login.php");
			exit;
		}
	}else{
		header("Location: /sky-walk/login.php");
		exit;
	}
	
	 if (isset($_SESSION['ip'])){
                if ($_SESSION['ip']!=$_SERVER['REMOTE_ADDR']){
                        header("Location: /sky-walk/login.php");
			exit;
                }
        }else{
                header("Location: /sky-walk/login.php");
		exit;
        }
	
	 if (isset($_SESSION['created'])){
                if (time()-$_SESSION['created']>1800){
                        header("Location: /sky-walk/login.php");
			exit;
                }
        }else{
                header("Location: /sky-walk/login.php");
		exit;
        }

	 if ("POST"==$_SERVER["REQUEST_METHOD"]){
                if (isset($_SERVER['HTTP_ORIGIN'])){
			if ($_SERVER['HTTP_ORIGIN']!= "https://100.66.1.8"){
	                        header("Location: /sky-walk/login.php");
				exit;
                }
        	}else{
                	header("Location: /sky-walk/login.php");
			exit;
       		}
	}
}

?>
