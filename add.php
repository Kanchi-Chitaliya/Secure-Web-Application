<?php
#author:Kanchi Chitaliya, kach6618
#date:03/12/2018
#purpose:secure web application
#filename:add.php
session_start();
session_regenerate_id();
include_once('header.php');
include_once('/var/www/html/sky-walk/sky-walk-lib.php');
$db=connect();
icheck($s);

echo "
<html>
<head><title>Sky Walk Database</title>
<body background=\"tip8-2012-total-solar-eclipse-2017-edit.jpg\"> </html>";
if ($s!=Null && !is_numeric($s)){
        echo "Error: value is not numeric \n";
}

if(!isset($_SESSION['authenticated'])){
	authenticate($db,$ip,$postUser,$postPass);
}
$a=check_uid($db,$postUser);
switch($s){
        case 4;
	default:
		
                echo"<form method=post action=add.php>";
                echo "<center><font size=5><b><u><a href=add.php?s=5><font color=white>Add New Planets to Database</a></b></u><br>\n";
		echo "<b><u><a href=add.php?s=6><font color=white>Add New Stars to Database</a></b></u><br>\n";
		echo "<b><u><a href=add.php?s=7><font color=white>Add New Other Celestial Bodies to Database</a></b></u><br><br><br></font>\n";
                
		echo"<tr><td><center><a href=add.php?s=99><font color=white>Logout</a></td></tr>";
		
		if ($a==1){
			echo "<tr><td><center><a href=add.php?s=90><font color=white>Add New Users</a></td></tr>
			<tr><td><center><a href=add.php?s=92><font color=white>Users Table</a></td></tr> <tr><td><center><a href=add.php?s=100><font color=white>Failed Login Table</a></td></tr>";
		}
		echo"</table></form>";
        break;

        case 5;
		echo"<form method=post action=add.php>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white>Planet Name  <input type=text name=\"planetName\" class=\"form-control\" value=\"\"> </div></div><br>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Distance From the Sun (*10<sup>6</sup> kms) <input type=text name=\"distance_from_sun\" class=\"form-control\" value=\"\"> </div></div><br>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Diameter (kms)<input type=text name=\"diameter\" class=\"form-control\" value=\"\"> </div></div><br>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Mass (*10<sup>24</sup> kg) <input type=text name=\"mass\" class=\"form-control\" value=\"\"> </div></div><br>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Number of Moons <input type=text name=\"number_of_moons\" class=\"form-control\" value=\"\"> </div></div><br>";
  		echo"<tr> <td> <input type=hidden name=\"s\" value=\"8\"> <input type=submit name=\"submit\" value=\"submit\"> <br>
                <tr><td><center><a href=add.php?s=99><font color=white>Logout</a></td></tr>";              

		 if ($a==1){
                        echo "<tr><td><center><a href=add.php?s=90><font color=white>Add New Users</a></td></tr>
                        <tr><td><center><a href=add.php?s=92><font color=white>Users Table</a></td></tr> <tr><td><center><a href=add.php?s=100><font color=white>Failed Login Table</a></td></tr>";
                }
                echo"</table></form>";
		
        break;
        case 6;
		echo"<form method=post action=add.php>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Star Name  <input type=text name=\"starname\" class=\"form-control\" value=\"\"> </div></div><br>";
                echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Distance From the Earth (trillion km)<input type=text name=\"distance_from_earth\" class=\"form-control\"  value=\"\"> </div></div><br>";
                echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Constellation <input type=text name=\"constellation\" class=\"form-control\"  value=\"\"> </div></div><br>";
                echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Age (million light years)<input type=text name=\"age\" class=\"form-control\" value=\"\"> </div></div><br>";

                echo"<tr> <td> <input type=hidden name=\"s\" value=\"9\"> <input type=submit name=\"submit\"  value=\"submit\"> </td> </tr><br><br>
                <tr><td><center><a href=add.php?s=99><font color=white>Logout</a></td></tr>";

                 if ($a==1){
                        echo "<tr><td><center><a href=add.php?s=90><font color=white>Add New Users</a></td></tr>
                        <tr><td><center><a href=add.php?s=92><font color=white>Users Table</a></td></tr> <tr><td><center><a href=add.php?s=100><font color=white>Failed Login Table</a></td></tr>";
                }
                echo"</table></form>";

	
        break;

        case 7;
		echo"<form method=post action=add.php>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Celestial Body Name <input type=text name=\"bodyname\" class=\"form-control\" value=\"\"> </div> </div><br>";
                echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Type of Celestial Body <input type=text name=\"type\" class=\"form-control\" value=\"\"> </div></div><br>";
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Distance From the Earth <input type=text name=\"distance_from_earth\" class=\"form-control\" value=\"\"> </div></div><br>";
                
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Mass <input type=text name=\"mass\" class=\"form-control\"  value=\"\"> </div> </div><br>";

		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Age <input type=text name=\"age\" class=\"form-control\" value=\"\"> </div></div><br>";
                echo"<tr> <td> <input type=hidden name=\"s\" value=\"10\"> <input type=submit name=\"submit\" value=\"submit\"> </td> </tr><br><br>
                <tr><td><center><a href=add.php?s=99><font color=white>Logout</a></td></tr>";

                 if ($a==1){
                        echo "<tr><td><center><a href=add.php?s=90><font color=white>Add New Users</a></td></tr>
                        <tr><td><center><a href=add.php?s=92><font color=white>Users Table</a></td></tr> <tr><td><center><a href=add.php?s=100><font color=white>Failed Login Table</a></td></tr>";
                }
                echo"</table></form>";


        break;

	case 8;

		#echo "here";
		$planetName=mysqli_real_escape_string($db,$planetName);
                $distance_from_sun=mysqli_real_escape_string($db,$distance_from_sun);
                $diameter=mysqli_real_escape_string($db,$diameter);
		$mass=mysqli_real_escape_string($db,$mass);
		$number_of_moons=mysqli_real_escape_string($db,$number_of_moons);
                if($stmt=mysqli_prepare($db, "INSERT INTO planets set planetid='',name=?, distance_from_sun=?,diameter=?,mass=?,number_of_moons=?")){

                        mysqli_stmt_bind_param($stmt,"sssss",$planetName,$distance_from_sun,$diameter,$mass,$number_of_moons);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
			echo"<form method=post action=add.php><font color=white>Planet Information Added to the database";
                }else{
                        echo"Error with Query";
                }
	
	break;
	
	case 9;

                echo "here";
                $starname=mysqli_real_escape_string($db,$starname);
                $distance_from_earth=mysqli_real_escape_string($db,$distance_from_earth);
                $constellation=mysqli_real_escape_string($db,$constellation);
                $age=mysqli_real_escape_string($db,$age);
                if($stmt=mysqli_prepare($db, "INSERT INTO stars set starid='',name=?, distance_from_earth=?,constellation=?,age=?")){

                    	mysqli_stmt_bind_param($stmt,"ssss",$starname,$distance_from_earth,$constellation,$age);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        echo"<font color=white>Star Information Added to the database";
                }else{
                        echo"Error with Query";
                }

        break;

	case 10;
		$bodyname=mysqli_real_escape_string($db,$bodyname);
		$type=mysqli_real_escape_string($db,$type);
                $distance_from_earth=mysqli_real_escape_string($db,$distance_from_earth);
                $mass=mysqli_real_escape_string($db,$mass);
                $age=mysqli_real_escape_string($db,$age);
                if($stmt=mysqli_prepare($db, "INSERT INTO others set bodyid='',name=?, type=?, distance_from_earth=?,mass=?,age=?")){

                        mysqli_stmt_bind_param($stmt,"sssss",$bodyname,$type,$distance_from_earth,$mass,$age);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        echo"<font color=white>Other Celestial Body's Information Added to the database";
                }else{
                        echo"Error with Query";
                }

		
	break;

	case 90;
		if($a!=1){
			echo"Cannot Display this page";
			echo "<tr><td><center><a href=add.php?s=99>Logout</a></td></tr>";
			exit;
		}
		echo"
		<form method=post action=add.php> 
		<h4><font color=white>Add Users to Sky Walk App </h4><br>
		<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white>Username: <input type=text name=\"addUser\" class=\"form-control\" value=\"\"> </div></div><br>
		<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white> Password: </td> <td> <input type=password name=\"newPass\" class=\"form-control\" value=\"\"> </div></div><br>
		<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white>Email: </td> <td> <input type=text name=\"newEmail\" class=\"form-control\" value=\"\"> </div></div><br>
		<tr> <td colspan=2> <input type=hidden name=\"s\" value=\"91\"> <input type=submit name=\"submit\" value=\"submit\"> 
		</table>
	
		<center><a href=add.php?s=99><font color=white>Logout</a>";
                
                        echo "<center><a href=add.php?s=90><font color=white>Add New Users</a>
                        <center><a href=add.php?s=92><font color=white>Users Table</a> <center><a href=add.php?s=100><font color=white>Failed Login Table</a>";
		
	break;

	case 91;
		$salt=md5(uniqid(rand(), true));
		$hash=hash('sha256',$newPass.$salt);
		#echo "new user is :$addUser";
		#echo "new password is: $newPass";
		if($stmt=mysqli_prepare($db, "INSERT INTO users set userid='',username=?,password=?,salt=?,email=?")){

                        mysqli_stmt_bind_param($stmt,"ssss",$addUser,$hash,$salt,$newEmail);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                }
		echo"<font color=white>Added new user $addUser <br><br>";
		echo"<center><a href=add.php?s=99>Logout</a>";
                if ($a==1){
                        echo "<center><a href=add.php?s=90>Add New Users</a>
                        <center><a href=add.php?s=92>Users Table</a><br><a href=add.php?s=100>Failed Login Table</a>";
		}
	
	break;

	case 92;
		echo "<form method=post action=add.php><font color=white>Users Table <br>"; 
		$query="SELECT userid,username from users";
                $result=mysqli_query($db,$query);
                while($row=mysqli_fetch_row($result)){
                        $row[0]=htmlspecialchars($row[0]);
			$row[1]=htmlspecialchars($row[1]);
			echo"<tr><td><a href=add.php?userid=$row[0]&s=93>$row[1]</a><br></td></tr>";
		}
		echo"</table>";
		echo"<center><a href=add.php?s=99><font color=white>Logout</a>";
                if ($a==1){
                        echo "<center><a href=add.php?s=90><font color=white>Add New Users</a><br><a href=add.php?s=100><font color=white>Failed Login Table</a>";
                }
		
	break;
	case 93;
		echo"<div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white>Update Password for user</div></div>";
		echo "<form method=post action=add.php>";
		echo "  <div class=\"form-row\">
    <div class=\"form-group col-md-4\"><font color=white><br>New Password: </td> <td> <input type=password name=\"updatePass\" class=\"form-control\" value=\"\"></div></div><br>";
		echo " <tr> <td colspan=2>  <input type=hidden name=\"userid\" value=$userid><input type=hidden name=\"s\" value=\"94\"> <input type=submit name=\"submit\" value=\"submit\"> </td></tr>";
		echo "</table>";
		echo"<center><a href=add.php?s=99><font color=white>Logout</a>";
                if ($a==1){
                        echo "<center><a href=add.php?s=90><font color=white>Add New Users</a>
                        <center><a href=add.php?s=92><font color=white>Users Table</a><br><center><a href=add.php?s=100><font color=white>Failed Login Table</a>";
		}
	break;
	case 94;
		$userid=mysqli_real_escape_string($db,$userid);
		$salt1=md5(uniqid(rand(), true));
                $hash1=hash('sha256',$updatePass.$salt1);
                if($stmt=mysqli_prepare($db, "UPDATE users set password=?,salt=? where userid=?")){

                        mysqli_stmt_bind_param($stmt,"ssi",$hash1,$salt1,$userid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                }
		echo "<font color=white>Password Updated Successfully <br><br>";
		echo"<center><a href=add.php?s=99><font color=white>Logout</a>";
                if ($a==1){
                        echo "<center><a href=add.php?s=90><font color=white>Add New Users</a>
                        <center><a href=add.php?s=92><font color=white>Users Table</a> <br><center><a href=add.php?s=100><font color=white>Failed Login Table</a>";
		}
	break;
	case 99;
		session_destroy();
		header("Location: /sky-walk/login.php");
		#echo "here";
		exit;
	break;
	case 100;
		echo "<font color=white>Failed Login Table";
		echo "<form method=post action=add.php><br><table border=4 bgcolor=white width=800>";
                $query="SELECT ip,user,date from login where action=\"fail\"";
                $result=mysqli_query($db,$query);
                while($row=mysqli_fetch_row($result)){
                        $row[0]=htmlspecialchars($row[0]);
                        $row[1]=htmlspecialchars($row[1]);
			$row[2]=htmlspecialchars($row[2]);
                        echo"<tr><td><center>$row[0]</td><td><center>$row[1]</td><td><center>$row[2]</td></tr>";
                }
		echo"</table><br><br>";
                echo"<center><a href=add.php?s=99><font color=white>Logout</a>";
                if ($a==1){
                        echo "<center><a href=add.php?s=90><font color=white>Add New Users</a></td></tr> <tr><td><center><a href=add.php?s=100><font color=white>Failed Login Table</a>";
                }
                

	break;
}
?>


