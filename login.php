<?php
#author:Kanchi Chitaliya, kach6618
#date:03/12/2018
#purpose:secure web application
#filename:login.php

include_once('header.php');
echo"
<html>
<head>
<title>Login</title>
</head>
<body background=\"tip8-2012-total-solar-eclipse-2017-edit.jpg\">

<center>
<form method=post action=add.php>
	<table><tr> <td><font color=white> Username: </td> <td> <input type=text name=postUser placeholder=\"Username\">  </td> </tr>
	<tr> <td><font color=white> Password: </td> <td> <input type=password name=postPass placeholder=\"Password\">  </td> </tr>
	<tr> <td colspan=2><button type=\"submit\" class=\"btn btn-primary\">Submit</button> </td></tr> 
	</table>
	</form>
</body>
</html>"
?>
