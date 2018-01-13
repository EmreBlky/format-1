<?php
session_start();
ob_start();
include("connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    

    $_SESSION['user_name']="";
    $_SESSION['userId']="";
    $_SESSION['ParentId']="";

   // $user=$_POST['user'];
    //$old_password=$_POST['old_password'];
    //$new_password=$_POST['new_password'];
    //$confirm_password=$_POST['confirm_password'];

    $user_name=addslashes($_POST['user_name']);
    $password=addslashes($_POST['password']);
   
    $user_name = mysql_real_escape_string($user_name);
    $password = mysql_real_escape_string($password);
   
    $row=select_query("SELECT * FROM login_user WHERE user_name='".$user_name."' and password='".$password."' ");
   //echo $sql; die;
    //$result=mysql_query($sql);
   // $row=mysql_fetch_array($result);
   
   // $count=mysql_num_rows($result);
   
    if(count($row)==1)
    {
    //print_r($_POST);
   
     $_SESSION['username']=$row[0]["user_name"];
     
     $_SESSION['user_name']=$row[0]["user_name"];
     $_SESSION['userId']=$row[0]['id'];
     $_SESSION['ParentId']=$row[0]['parent_id'];
     $_SESSION['BranchId']=$row[0]['branch_id'];
     $_SESSION['support_group_id']=$row[0]['tech_support_id'];
     $_SESSION['isadmin']=$row[0]['isadmin'];
	 $_SESSION['email']=$row[0]['email'];
    }
    else
    {
        $login_time = date("Y-m-d H:i:s");
       
        $temp_row=select_query("SELECT * FROM login_user_temp WHERE user_name='".$user_name."' and password='".$password."' and from_date<='".$login_time."' AND to_date>='".$login_time."' ");
        //$temp_result=mysql_query($sql_temp);
        //$temp_row=mysql_fetch_array($temp_result);
       
        $temp_count=getcountRow($temp_row);
       
        if($temp_count==1)
        {
         $_SESSION['username']=$temp_row[0]["user_name"];
         $_SESSION['user_name']=$temp_row[0]["user_name"];
         $_SESSION['userId']=$temp_row[0]['login_user_id'];
         $_SESSION['ParentId']=$temp_row[0]['parent_id'];
         $_SESSION['BranchId']=$temp_row[0]['branch_id'];
         $_SESSION['support_group_id']=$temp_row[0]['tech_support_id'];
         $_SESSION['isadmin'] = "";
        }
               
    }

    switch($_SESSION['ParentId'])
    {
       
        case "1":
        $_SESSION['id']=1;
        header("Location: sales_request/accountcreation.php");
        break;
       
        case "2":
        $_SESSION['id']=2;
        header("Location: service_request/list_device_change.php");
        break;
       
       
        case "3":
        $_SESSION['id']=3;
		$request_list = array('active_status' => 1);
		$condition = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition);
        header("Location: support/accountcreation.php");
        break;
       
        case "4":
        $_SESSION['id']=4;
        header("Location: account/account_home.php");
        break;
       
        case "6":
        $_SESSION['id']=6;
        header("Location: service_support/accountcreation.php");
        break;
       
        case "7":
        $_SESSION['id']=7;
		$request_list = array('active_status' => 1);
		$condition = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition);
        header("Location: repair/list_service_repair.php");
        break;
       
        case "8":
        $_SESSION['id']=8;
        header("Location: stock/list_deactivate_of_account.php");
        break;
       
        case "9":
        $_SESSION['id']=9;
        header("Location: payment/list_branch_account_report.php");
        break;
       
        case "11":
        $_SESSION['id']=11;
        header("Location: reports/reports_home.php");
        break;
       
        case "12":
        $_SESSION['id']=12;
        header("Location: admin/admin_home.php");
        break;
       
        case "13":
        $_SESSION['id']=13;
        header("Location: snp_request/debug.php");
        break;
       
        case "14":
        $_SESSION['id']=14;
        header("Location: repair/list_rdconversion.php");
        break;
		
		case "15":
		$_SESSION['id']=15;
		header("Location: service_request/imeisearch_vendor.php");
		break;
		
		case "16":
		$_SESSION['id']=16;
		$request_list = array('active_status' => 1);
		$condition = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition);
		header("Location: support/list_service_support.php");
		break;
		
		case "18":
        $_SESSION['id']=18;
        header("Location: admin_support/admin_home.php");
        break;
       
        /*case "anoop":
        $_SESSION['id']=5;
        header("Location: anoop.php");
        break;*/
       
        /*case "stock":
        $_SESSION['id']=6;
        header("Location: stock.php");
        break;*/
   
    }
   
    if(empty($count) && empty($temp_count))
    {
        //header('location: index.php');
        echo "<div style='color:red;'>"."Your Login Name or Password is invalid"."</div>";
    }



}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Gtrac Client Support</title>
<link rel="stylesheet" href="css/login.css" type="text/css" />
<meta name="robots" content="noindex" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
<script type="text/javascript" language="javascript" src="<?php echo __SITE_URL;?>/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo __SITE_URL;?>/js/function.js"></script>

<script src="http://trackingexperts.com/collection/thickbox/jquery-latest.js" type="text/javascript"></script>
<script src="http://trackingexperts.com/collection/thickbox/thickbox.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://trackingexperts.com/collection/thickbox/thickbox.css" type="text/css" media="projection, screen" />
<style>
body,td{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
</style>
</head>
<body id="loginBody">
<div id="loginBox">
    <h1 id="logo"><img src="img/logo.png"><a href="index.php">gtrac Staff Control Panel</a></h1>
    <h1>Authentication Required</h1>

    <br />
    <form method="post" action="" onSubmit="return oklogin()">
    <table border=0 align="center">
    <tr><td width=100 align="right"><b>Username</b>:</td>
    <td width="188"><input type="text"  name="user_name" id="username" placeholder="username" /></td></tr>
    <tr><td align="right"><b>Password</b>:</td><td><input type="password"  name="password" id="password" placeholder="password" />
    </td></tr>
      <tr><td align="right"><input type="submit" value="Go"/></td><td align="center">
   
  	<!--<a href="resetpwd-iframe.php?height=200&width=500" class="thickbox"  >Reset Password</a>-->
    </td>
</td>
        </tr>


    </table>
   
</form>
 </div>

<!-- <div id="copyRights">Copyright &copy; <a href='http://www.osticket.com' target="_blank">osTicket.com</a></div> -->
<script type="text/javascript">
function oklogin(){
    var u = document.getElementById('username');
    var p = document.getElementById('password');
   
    if((u.value != '' && u.value.length >0) && (p.value != '' && p.value.length >0)){
        return true;
    }else{
        return false;
    }
}   

</script>
     
</body>
</html>

