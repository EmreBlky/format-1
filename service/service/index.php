<?php
include ("config.php");
ob_start();
session_start();
$username="";
$password="";
if(isset($_POST['login']))
{

$username=$_POST['username'];

$password=$_POST['password'];

$login_user=mysql_query("SELECT * FROM servicelogin WHERE username='".$username."' AND password='".$password."'");
//echo"SELECT * FROM servicelogin WHERE username='".$username."' AND password='".$password."'";die();
$row=mysql_fetch_array($login_user);
//print_r($row);die();
 $num=mysql_num_rows($login_user);

if($num>0)
{
 $_SESSION['username']=$username;
 $_SESSION['userId']=$row['id'];
  
}

 
 
switch($_SESSION['username']) {

case "swati":
	$_SESSION['branch_id']=1;
header("Location: services.php");

break;

case "radhika":
	$_SESSION['branch_id']=1;
header("Location: show_installation.php");
break;

case "stock":
	$_SESSION['branch_id']=1;
header("Location: show_repairs.php");
break;

case "gurmeet":
	$_SESSION['branch_id']=1;
header("Location: newinstallation.php");
break;

case "prabhakar":
	$_SESSION['branch_id']=1;
header("Location: repair_device.php");
break;

case "santosh":
	$_SESSION['branch_id']=1;
header("Location: open_device.php");
break;
case "mumbai":
$_SESSION['branch_id']=2;
$_SESSION['branch_name']="mumbai";

header("Location: services.php");
break;
case "mumbai1":
$_SESSION['branch_id']=2;
$_SESSION['branch_name']="mumbai";

header("Location: newinstallation.php");
break;

case "jaipur":
$_SESSION['branch_id']=3;
$_SESSION['branch_name']="jaipur";

header("Location: services.php");
break;
case "jaipur1":
$_SESSION['branch_id']=3;
header("Location: newinstallation.php");
break;


case "praveen":
	$_SESSION['branch_id']=1;
header("Location: billing.php");
break;


 
}


if(empty($row))
   {
   
   echo "username or password does not match.";
   }

}

?>
<script type="text/javascript" language="javascript">

function req_info()
{
  if(document.form1.username.value =="")
  {
   alert("please enter username");
   document.form1.username.focus();
   return false;
   }
   
   if(document.form1.password.value =="")
  {
   alert("please enter password");
   document.form1.password.focus();
   return false;
   }
}
</script>

 
			 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gtrac Client Support</title>
<link rel="stylesheet" href="css/login.css" type="text/css" />
<meta name="robots" content="noindex" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
</head>
<body id="loginBody">
<div id="loginBox">
	<h1 id="logo"><img src="images/logo2.jpg"><a href="index.php">gtrac Staff Control Panel</a></h1>
	<h1>Authentication Required</h1>

	<br />
	<form action="" method="post" name="form1" onSubmit="return req_info();">
	<input type="hidden" name=do value="scplogin" />
    <table border=0 align="center">
        <tr><td width=100px align="right"><b>Username</b>:</td><td><input type="text" name="username" value="" /></td></tr>
        <tr><td align="right"><b>Password</b>:</td><td><input type="password" name="password" value="" /></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;&nbsp;<input class="submit" type="submit" name="login" value="Login" /></td></tr>

    </table>
</form>

</div>
<!-- <div id="copyRights">Copyright &copy; <a href='http://www.osticket.com' target="_blank">osTicket.com</a></div> -->
</body>
</html>
