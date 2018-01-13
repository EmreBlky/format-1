<?php
ob_start();
@session_start();
$user_check=$_SESSION['user_name'];


 $login_session=$_SESSION['user_name'];


if(!isset($_SESSION['user_name']) && $_SESSION['user_name']=="" )
{
header("Location: index.php");
}
?>