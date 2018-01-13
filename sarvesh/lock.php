<?php
include('connection.php');
session_start();
$user_check=$_SESSION['user_name'];

$ses_sql=mysql_query("select user_name from admin_user where user_name='$user_check' ");

$row=mysql_fetch_array($ses_sql);

 $login_session=$row['user_name']; 

if(!isset($login_session))
{
header("Location: ../index.php");
}
?>