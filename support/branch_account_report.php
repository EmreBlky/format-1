<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/


$Header="Payment Report";

$date=date("Y-m-d H:i:s");
$req_persion=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$Header="Edit Repair Report";
	$result=select_query("select * from branch_account_report where id='".$id."'");	
	
	}
?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">
  <?
if(isset($_POST['submit']))
{
	$date=$_POST['date'];
	$req_persion=$_POST['req_persion'];
	$client_name=$_POST['client_name'];
	$expected_ammount=$_POST['expected_ammount'];
	$received_ammount=$_POST['received_ammount'];
	$day_total=$_POST['day_total'];
	
	if($_SESSION['username']=="anoop")
	{
		$branch_id=1;
	}
	else if($_SESSION['username']=="kanha")
	{
		$branch_id=2;
	}
	else if($_SESSION['username']=="amit")
	{
		$branch_id=6;
	}
	else if($_SESSION['username']=="vivek")
	{
		$branch_id=3;
	}
	else
	{
		$branch_id=1;	
	}
	
	if($action=='edit')
	{
		$update_query="UPDATE branch_account_report SET request_date='".$date."',request_by='".$req_persion."',clients='".$client_name."',expected_ammount='".$expected_ammount."',received_ammount='".$received_ammount."',day_total='".$day_total."' WHERE id='".$id."'";
		
		mysql_query($update_query);
		echo "<script>document.location.href ='list_branch_account_report.php'</script>";
	
	}
	else
	{
	
		$query = "INSERT INTO branch_account_report(request_date,request_by,clients,expected_ammount,received_ammount,day_total,branch_id) 
		VALUES('".$date."','".$req_persion."','".$client_name."','".$expected_ammount."','".$received_ammount."','".$day_total."','".$branch_id."')";
		
		mysql_query($query);
		echo "<script>document.location.href ='list_branch_account_report.php'</script>";
	}
}

?>
  <form method="post" action="" name="form1" onSubmit="">
    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td align="right">Request Date</td>
        <td><input type="text" name="date" id="datepicker1" value="<?php echo $date;?>" /></td>
      </tr>
      <tr>
        <td align="right">Request By: </td>
        <td><input type="text" name="req_persion" id="TxtAccManager" readonly value="<?php echo $req_persion;?>"/></td>
      </tr>
      <tr>
        <td  align="right">Client Name:</td>
        <td><input type="text" name="client_name" id="TxtClient_name"  value="<?php echo $result[0]['clients'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Expected Ammount:</td>
        <td><input type="text" name="expected_ammount" id="TxtExpectedAmmount"  value="<?php echo $result[0]['expected_ammount'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Received Ammount:</td>
        <td><input type="text" name="received_ammount" id="TxtReceivedAmmount"  value="<?php echo $result[0]['received_ammount'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Day Total:</td>
        <td><input type="text" name="day_total" id="TxtDayTotal"  value="<?php echo $result[0]['day_total'];?>"/></td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_branch_account_report.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?
include("../include/footer.php");

?>
