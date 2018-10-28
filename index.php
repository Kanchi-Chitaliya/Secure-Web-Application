<?php
#author:Kanchi Chitaliya, kach6618
#date:03/12/2018
#purpose:secure web application
#filename:index.php

include_once('header.php');
include_once('/var/www/html/sky-walk/sky-walk-lib.php');
$db=connect();
icheck($s);
#icheck($name);
#icheck($starname);
#icheck($bodyname);

echo "
<html>
<head><title>Sky Walk Database</title>
<body background=\"tip8-2012-total-solar-eclipse-2017-edit.jpg\"> </html>";
if ($s!=Null && !is_numeric($s)){
        echo "Error: value is not numeric \n";
}

switch($s){
        case 0;
        default:
/*
#		echo "<center><button type=\"button\" class=\"btn btn-light\"><a href=index.php?s=1>Planets</a</div></button><br><br><br>";
#		echo "<button type=\"button\" class=\"btn btn-light\"><a href=index.php?s=2>Stars</a></button><br><br><br>";
#		echo "<button type=\"button\" class=\"btn btn-light\"><a href=index.php?s=3>Other Celestial Bodies</a></button><br>";
#
#              echo"</table>";
        break;
	*/
echo"
	<div class=\"container\">
    <div>
      <h2><a href=index.php?s=1><font color=white>PLANETS</a></h2></div><br>
    <div>
      <h2><a href=index.php?s=2> <font color=white>STARS</a></h2></div><br>
     <div>
      <h2><a href=index.php?s=3><font color=white> OTHER CELESTIAL BODIES</a></h2></div></div>";


	
	break;

        case 1;
                echo "<h1 class=\"display-10\"><font color=white>Planets Data</h1><hr color=white size=20>\n";
		if ($stmt=mysqli_prepare($db,"SELECT name FROM planets")){;
			mysqli_stmt_execute($stmt);
                	mysqli_stmt_bind_result($stmt,$name);		

			while(mysqli_stmt_fetch($stmt)){
			
        	                $name=htmlspecialchars($name);
				echo"<font size=5><a href=index.php?name=$name&s=4>$name</a><br> \n";
                      
                	}
			mysqli_stmt_close($stmt);
		}
                echo"</table>";
        break;
        case 2;
		echo "<h1 class=\"display-10\"><font color=white>Stars Data</h1><hr color=white size=20>\n";
                if ($stmt=mysqli_prepare($db,"SELECT starid,name FROM stars")){;
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt,$starid,$starname);

                        while(mysqli_stmt_fetch($stmt)){
				$starid=htmlspecialchars($starid);
                                $starname=htmlspecialchars($starname);
                                echo"<font size=5><a href=index.php?starid=$starid&s=5>$starname</a><br> \n";
				echo "<font size=5><a href=index.php?starid=$starid&s=5> <input type=hidden name=\"starname\" value=$starname></a>";
                        }
                        mysqli_stmt_close($stmt);
                }
                echo"</table>";
	
	break;
        case 3;
		echo "<h1 class=\"display-10\"><font color=white>Other Celestial Bodies Data</h1><hr color=white size=20>\n";
		if ($stmt=mysqli_prepare($db,"SELECT bodyid,name FROM others")){;
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt,$bodyid,$bodyname);

                        while(mysqli_stmt_fetch($stmt)){
				$bodyid=htmlspecialchars($bodyid);
                                $bodyname=htmlspecialchars($bodyname);
                                echo"<font size=5> <a href=index.php?bodyid=$bodyid&s=6>$bodyname</a><br> \n";

                        }
                        mysqli_stmt_close($stmt);
                }
                echo"</table>";
		

        break;
	
	case 4;
		echo "<table><tr><td><b><u><font color=white>Available Data about $name</b></u></td></tr>\n";
		$name=mysqli_real_escape_string($db, $name);
		if ($stmt=mysqli_prepare($db,"SELECT distance_from_sun,diameter,mass,number_of_moons FROM planets where name=?")){
		mysqli_stmt_bind_param($stmt, "s", $name);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $distance_from_sun, $diameter,$mass,$number_of_moons);
                        while(mysqli_stmt_fetch($stmt)){
                                $distance_from_sun=htmlspecialchars($distance_from_sun);
                                $diameter=htmlspecialchars($diameter);
				$mass=htmlspecialchars($mass);
				$number_of_moons=htmlspecialchars($number_of_moons);
                                echo"<tr><td><font color=white>Distance from the Sun= $distance_from_sun *10^6 kms </td></tr> \n";
				echo"<tr><td><font color=white>Diameter= $diameter  km </td></tr> \n";
				echo"<tr><td><font color=white>Mass= $mass  *10^24 kg </td></tr> \n";
				echo"<tr><td><font color=white>Number of Moons= $number_of_moons </td></tr> \n";
                        }
                        mysqli_stmt_close($stmt);
                }
                echo"</table>";

	break;

	case 5;
                if ($stmt=mysqli_prepare($db,"SELECT name,distance_from_earth,constellation,age FROM stars where starid=?")){
		mysqli_stmt_bind_param($stmt, "i", $starid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $starname,$distance_from_earth, $constellation,$age);
                        while(mysqli_stmt_fetch($stmt)){
				$starname=htmlspecialchars($starname);
                                $distance_from_earth=htmlspecialchars($distance_from_earth);
                                $constellation=htmlspecialchars($constellation);
                                $age=htmlspecialchars($age);
				echo "<table><tr><td><b><u><font color=white>Available Data about $starname</b></u></td></tr>\n";
                                echo"<tr><td><font color=white>Distance from the Earth= $distance_from_earth trillion km </td></tr> \n";
                                echo"<tr><td><font color=white>Constellation= $constellation <td></tr> \n";
                                echo"<tr><td><font color=white>Age= $age  Gpr</td></tr> \n";
                        }
                        mysqli_stmt_close($stmt);
                }
                echo"</table>";

		
	break;

	case 6;
		if ($stmt=mysqli_prepare($db,"SELECT name,type,distance_from_earth,mass,age FROM others where bodyid=?")){
                mysqli_stmt_bind_param($stmt, "i", $bodyid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $bodyname,$type,$distance_from_earth, $mass,$age);
                        while(mysqli_stmt_fetch($stmt)){
                                $bodyname=htmlspecialchars($bodyname);
                                $distance_from_earth=htmlspecialchars($distance_from_earth);
                                $type=htmlspecialchars($type);
				$mass=htmlspecialchars($mass);
                                $age=htmlspecialchars($age);
                                echo "<table><tr><td><b><u><font color=white>Available Data about $bodyname</b></u></td></tr>\n";
				echo"<tr><td><font color=white>Type= $type <td></tr> \n";
                                echo"<tr><td><font color=white>Distance from the Earth= $distance_from_earth billion kms </td></tr> \n";
                                echo"<tr><td><font color=white>Mass= $mass*10^14 Kg<td></tr> \n";
                                echo"<tr><td><font color=white>Age/Repeats After= $age  Gpr</td></tr> \n";
                        }
                        mysqli_stmt_close($stmt);
                }
                echo"</table>";


	break;




        case 50;
		echo "<html><body background=\"Space-Galaxy-Star-Black-Dark-Hd-Desktop-Wallpaper-For-Computer-Full-Pics.jpg\"> </html>";	
                #echo "<font color=white>\n";
		$command = escapeshellcmd('python /var/www/html/sky-walk/scrap.py ' .$data);

		$output = shell_exec($command);
		echo" <font color=white>$output";
        break;


}
?>


