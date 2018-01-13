<?php
session_start();
$con=mysql_connect("localhost","root","");
mysql_select_db("patient") or("Database not connected!");
$Uname="";
$Pass="";
$flag="OK";

if(isset($_GET['uname']))
{
$uname=addslashes($_GET['uname']);
}
if(isset($_GET['pass']))
{
$Pass=addslashes($_GET['pass']);
}

$sql=mysql_query("select * from login where uname='$uname' and pass='$pass'");
$row=mysql_fetch_array($sql);

if(!empty($row))
{
$msg="login is successfull";
     $flag="OK";
}
else
{
$msg="username or password not matched";
   $flag="Error";
}


if(isset($msg))
	{
   $string="<?xml version='1.0'?> <Login> <status>".$flag."</status><message>".$msg."</message></Login>";  
  
 
 $handle = fopen("login.xml", "w");
 fwrite($handle, $string);
 fclose($handle);
  header("location:login.xml");

	}
?>