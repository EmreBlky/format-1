<?php
ob_start();
session_start();
include("dbcon.php");

 

 if(isset($_POST['logout']))
 {
 session_destroy();
 header("location:index.php");
 }
 
 
 if($_SESSION['username']=="")
	{
	echo "<script> location.href='index.php' </script>";
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Cleint Support</title>
    <link rel="stylesheet" href="./styles/main.css" media="screen">
    <link rel="stylesheet" href="./styles/colors.css" media="screen">
    
    <script type="text/javascript" src="js/sorting/jquery-1.5.1.js"></script>
	<script type="text/javascript" src="js/sorting/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="js/sorting/jquery.tablesorter.pager.js"></script>
	
    
   <link href="css/soring_style.css" rel="stylesheet" type="text/css" /> 

</head>
<body>
<div id="container">
    <div id="header" align="right">
	<p><form method="post">
	<? $username=$_SESSION['username']; echo "welcome to $username" ?>	
	<input type="submit" name="logout" value="logout" align="right"></p>
	</form>
        <a id="logo" href="index.php" title="Support Center"><img src="./images/logo2.jpg" border=0 alt="Support Center"></a>
        <p><span>CLIENT SUPPORT</span> SYSTEM</p>
		
    </div>
 	<br clear="all" />

		 
	     


	 
 

   
    