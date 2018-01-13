<?php
include_once('inc/sessionstart.php');
include_once('inc/connect.php');
include_once('inc/functions.php');
//include('../inc/check_user.php');
//printarray($_SESSION);
if($_SESSION["UserId"]=="" and  $_SESSION["UserType"]=="") 
 {} 
else{
	gotopage($homeurl."user/myaccount.php");
	exit;
	
}


foreach($_POST as $key=>$value){
	$$key=safe($value);
}
//printarray($_POST);
		if($submit!=""){
			

			if($password==""){$error="Password can't be blank";}
			elseif($new_password==""){$error="New Password can't be blank";}
			elseif($confirm_password==""){$error="Confirm Password can not be blank";}
			elseif($new_password!=$confirm_password){$error="New Password and Confirm Password does not match";}
			elseif($user==""){$error="error";}
			
			if($error==""){
			
			$data=select_query("select * from users where sys_username='$user' and sys_password='$password'");

					if(count($data)==1 && is_array($data)){					
					$id	= $data['0']['id'];
					$qry="update users set sys_password='$new_password' where id=$id";
					$fp=fopen("debug/debug/log/passwordLog.txt",'a+');
					$string=date('d-m-Y H:i:s')."	".$user."	".$password."	".$new_password."	".$qry."\r";
					fwrite($fp,$string);
					fclose($fp);
					echo "Password has been updated!!";
						mysql_query($qry);
					}
					else{
						$error="User Name and Password does not match";
					}
					
			}

}

?>
<style>
body,td{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
</style>
<html>
<head>
</head>
<body>


<form name="form1" method="post" action="change-password.php">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="3" align="center"><strong>Reset Password</strong></td>

  </tr>
    <tr>
    <td colspan="3" align="left" style="color:red">
	<?php
	if($error!=""){
	echo "".$error."<br><br>";
	}
	?>
	
	</td>

  </tr>
  <tr>
    <td width="57%">User</td>
    <td width="1%">:</td>
    <td width="42%"><input type="text" name="user" id="user" value=""></td>
  </tr>
  <tr>
    <td>Old Password</td>
    <td>:</td>
    <td><input type="password" name="password" id="password" value=""></td>
  </tr>
  <tr>
    <td>New Password </td>
    <td>:</td>
    <td><input type="password" name="new_password" id="new_password" value=""></td>
  </tr>
  <tr>
    <td>Confirm Password </td>
    <td>:</td>
    <td><input type="password" name="confirm_password" id="confirm_password" value=""></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Submit"></td>
  </tr>
</table>
</form>
</body>
</html>
