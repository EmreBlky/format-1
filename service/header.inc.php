<?php
ob_start();
session_start();
include ("config.php");

$sql_pending=mysql_query("SELECT COUNT(*) FROM services WHERE pending='1'");
$row_pending=mysql_fetch_array($sql_pending);

 header("Content-Type: text/html; charset=UTF-8\r\n");
 if(isset($_POST['logout']))
 {
 session_destroy();
 header("location:index.php");
 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Cleint Support</title>
    <link rel="stylesheet" href="./styles/main.css" media="screen">
    <link rel="stylesheet" href="./styles/colors.css" media="screen">
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
	<? $username=$_SESSION['username'];?>
    <ul id="nav">
         <? 
		 
	   switch($username){
	   
	   case 'swati':
	                     
         ?>
    
		 <li><a   href="pendingservice.php">Pending Service<? $sql_pending=mysql_query("SELECT COUNT(*) FROM services WHERE pending='1'");
		 
$row_pending=mysql_fetch_array($sql_pending);?>(<?=$row_pending[0]?>)</a></li>
         <li><a   href="service_request.php">Add Client</a></li>
		 <!--<li><a   href="services.php">Services</a></li>-->
         <li><a class="home" href="services.php">Services</a></li>
		 
<?       break;
}?>
<? 
	   switch($username){
	   case 'radhika':
	                     
         ?>
    <li><a   href="stock_listing.php">Stock Listing</a></li>
		 <li><a   href="newpending.php">Pending Services<? $sql_pending=mysql_query("SELECT COUNT(*) FROM services WHERE newpending='1'");
                 $row_pending=mysql_fetch_array($sql_pending);?>(<?=$row_pending[0]?>)</a></li>
		 
         <li><img src="new.gif"><a   href="newservice.php">New Services<? $sql_status="SELECT COUNT(*) FROM services WHERE status='1'";
                                         $result_status=mysql_query($sql_status);
                                         $row_service=mysql_fetch_array($result_status);?>(<?=$row_service[0]?>)</a></li>
		 <!--<li><a   href="services_from_sales.php">Services from sales</a></li>-->
         <li><a class="home" href="services_from_sales.php">Services</a></li>
		 
<?       break;
}?>
<? 
	   switch($username){
	   case 'gurumeet':
	                     
         ?>
    
		<!-- <li><a   href="">Pending Service<? $sql_pending=mysql_query("SELECT COUNT(*) FROM services WHERE pending='1'");
                 $row_pending=mysql_fetch_array($sql_pending);?>(<?=$row_pending[0]?>)</a></li>-->
		 
         <li><a   href="newservice2.php">New Services<? $sql_status="SELECT COUNT(*) FROM services WHERE newstatus='1'";
                            $result_status=mysql_query($sql_status);
                        $row=mysql_fetch_array($result_status);?>(<?=$row[0]?>)</a></li>
		 <!--<li><a   href="newinstallation.php">New Installation</a></li>-->
         <li><a class="home" href="newinstallation.php">New Installation</a></li>
		 
<?       break;
}?>
<? 
	   switch($username){
	   case 'prabhakar':
	                     
         ?>
		 
         <li><a   href="stock_listing.php">Stock Listing</a></li>
		 <li><a href="add_vehicle.php">Add Vehicle</a></li>
		 <li><a href="add_user.php">Add User</a></li>
		 <li><a   href="add_device.php">Add Device</a></li>
         <li><a class="home" href="repair_device.php">Repair device</a></li>
		 
<?       break;
}?>
<? 
	   switch($username){
	   case 'santosh':
	                     
         ?>
		 
		 <li><a   href="repair_report.php">Device Report</a></li>
         <!--<li><a   href="repair.php">Add Device</a></li>-->
		 <!--<li><a   href="repair_device.php">Open device</a></li>-->
         <li><a class="home" href="open_device.php">Open device</a></li>
		 
<?       break;
}?>
    </ul>
    