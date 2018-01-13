<?php
session_start();
$con=mysql_connect("localhost","root","");
mysql_select_db("patient") or("Database not connected!");
$flag="OK";

if(isset($_GET['email']))
{
$uname=$_GET['uname'];
$sql=mysql_query("select uname from login where uname='$uname'");
$row=mysql_fetch_row($sql);

if(!empty($row))
   {
     $msg="Username already exist";
	 $flag="Error";
   }
   
  $email=$_GET['email'];
  $sql=mysql_query("select email from login where email='$email'");
  $row=mysql_fetch_row($sql);

   if(!empty($row))
   {
     $msg="Email already exist";
	 $flag="Error";
   }
   
    if($flag=="OK")
   { 
  $pass=$_GET['pass'];
  $sql=mysql_query("insert into login(uname,email,pass)values('".$uname."','".$email."','".$pass."')");
  $msg="Registration successfull";
  }
  
  if(isset($msg))
	{
   $string="<?xml version='1.0'?> <document> <status>".$flag."</status><message>".$msg."</message></document>";  
  
 
 $handle = fopen("race_info.xml", "w");
 fwrite($handle, $string);
 fclose($handle);
  header("location:race_info.xml");

	} 
}
?>
