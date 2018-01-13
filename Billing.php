<?php
include("lock.php");
include("connection.php");
$date=(isset($_POST["date"])) ? trim($_POST["date"])  : "";
$acc_manager=(isset($_POST["acc_manager"])) ? trim($_POST["acc_manager"]): "";
$client=(isset($_POST["client"])) ? trim($_POST["client"]): "";
$user_id=(isset($_POST["user_id"])) ? trim($_POST["user_id"]): "";
$reg_no=(isset($_POST["reg_no"])) ? trim($_POST["reg_no"]): "";
$retail_maintenance=(isset($_POST["retail_maintenance"])) ? trim($_POST["retail_maintenance"]): "";
$spare_parts=(isset($_POST["spare_parts"])) ? trim($_POST["spare_parts"]): "";
$spare_costs=(isset($_POST["spare_costs"])) ? trim($_POST["spare_costs"]): "";
$reason=(isset($_POST["reason"])) ? trim($_POST["reason"]): "";

if(isset($_POST["submit"]))
{

 $query="insert into billing(date,acc_manager,client,user_id,reg_no,retail_maintenance,spare_parts,spare_costs,reason)values('".$date."','".$acc_manager."','".$client."','".$user_id."','".$reg_no."','".$retail_maintenance."','".$spare_parts."','".$spare_costs."','".$reason."')";

mysql_query("$query", $cn);
//echo "record saved";
echo "<script>document.location.href ='support_request.php'</script>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
	<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
    <style type="text/css">
        .style1
        {
            width: 50%;
        }
    </style>
		<link href="jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="jquery/jquery.min.js"></script>
	<script src="jquery/jquery-ui.min.js"></script>

<script>
	$(document).ready(function() {
			// For simple datepicker
			
			
			// get the current date
			var date = new Date();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
			
			// Disable all dates till today
			$('#datepicker1').datepicker({
					
					dateFormat: 'yy-mm-dd',
			});
			
			
			
		});
			
			
</script>

	
    <script type="text/javascript">
        function Check() {
            var Date = document.getElementById('datepicker1');
            var ACManager = document.getElementById('TxtAccManager');
            var Client = document.getElementById('TxtClient');

            var UserId = document.getElementById('TxtUserId');
            var RegNo = document.getElementById('TxtRegNo');
            var Retail = document.getElementById('TxtRetail');
            var SparePart = document.getElementById('TxtSparePart');
            var SpareCost = document.getElementById('TxtSpareCost');
            var Reason = document.getElementById('TxtReason');

            if (Date.value == '') {

                alert('Please Enter Date!!');
                return false;
            }
            else if (ACManager.value == '') {
                alert('Please Enter Account Manager!!');
                return false;
            }
            else if (Client.value == '') {
                alert('Please Enter Client!!');
                return false;
            }
            else if (UserId.value == '') {
                alert('Please Enter Main UserId!!');
                return false;
            }
            else if (RegNo.value == '') {
                alert('Please Enter Total Reg. No!!');
                return false;
            }
            else if (Retail.value == '') {
                alert('Please Enter Retail!!');
                return false;
            }
            else if (SparePart.value == '') {
                alert('Please Enter Spare Part!!');
                return false;
            }
            else if (SpareCost.value == '') {
                alert('Please Enter Spare Cost!!');
                return false;
            }
            else if (Reason.value == '') {
                alert('Please Enter Reason!!');
                return false;
            }
            else {
                return true;
            }
        }
    
    </script>
</head>
<body>
<?php include("include/header_support.php"); ?>
<br />
<center>
<form method="POST" action="">

<table class="style1">
    <tr>
        <td>
            Date</td>
        <td><input type="text" name="date" id="datepicker1"/>
           </td>
    </tr>
    <tr>
        <td>
            Account Manager</td>
        <td><input type="text" name="acc_manager" id="TxtAccManager" />
           </td>
    </tr>
    <tr>
        <td>
            Client</td>
        <td><input type="text" name="client" id="TxtClient" />
           </td>
    </tr>
    <tr>
        <td>
            User Id</td>
        <td><input type="text" name="user_id" id="TxtUserId" />
           </td>
    </tr>
    <tr>
        <td>
            Reg. No.</td>
        <td><input type="value" name="reg_no" id="TxtRegNo" />
           </td>
    </tr>
    <tr>
        <td>
            Retail/Mainten</td>
        <td><input type="text" name="retail_maintenance" id="TxtRetail" />
           </td>
    </tr>
    <tr>
        <td>
            Spare Part</td>
        <td><input type="text" name="spare_parts" id="TxtSparePart" />
           </td>
    </tr>
    <tr>
        <td>
            Spare Cost</td>
        <td><input type="value" name="spare_costs" id="TxtSpareCost" />
           </td>
    </tr>
    <tr>
        <td>
            Reason</td>
        <td><input type="text" name="reason" id="TxtReason" />
           </td>
    </tr>
    <tr><td></td>
	<td class="submit"><input type="submit" id="button1" name="submit" value="submit" onclick="return Check();" /></td></tr>
</table>

</form>
</center>
</body>
</html>
