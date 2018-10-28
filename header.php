<!--
#author:Kanchi Chitaliya, kach6618
#date:03/12/2018
#purpose:secure web application
#filename:header.php
-->
<?php
echo "
<html>
<head>
<link rel=\"stylesheet\" href=\"bootstrap.css\">
<title> Sky Walk DB </title>
</head>
<body>
<center>
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
    <ul class=\"navbar-nav mr-auto\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=index.php>Information <span class=\"sr-only\">(current)</span></a>
      </li>
<li class=\"nav-item\">
        <a class=\"nav-link\" href=add.php><font color=black>Add Bodies</a>
      </li>
</ul>
<form method=post action=index.php?s=50 class=\"form-inline my-2 my-lg-0\">
      <input class=\"form-control mr-sm-2\" type=\"search\" name=\"data\" placeholder=\"Wikipedia Search\" aria-label=\"Search\">
<button class=\"btn btn-outline-dark my-2 my-sm-0\"  type=\"submit\"><a class=\"nav-link\">Search</a></button></form>
</nav>
<hr>
</center>
</body>
</html>"
?>


