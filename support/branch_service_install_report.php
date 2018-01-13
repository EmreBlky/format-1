<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/


$Header="Service & Installation Report";

$date=date("Y-m-d H:i:s");
$req_persion=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$Header="Edit Repair Report";
	$result=select_query("select * from branch_service_install_report where id='".$id."'");	
	
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
	$total_services=$_POST['total_services'];
	$service_done=$_POST['service_done'];
	$service_cancel=$_POST['service_cancel'];
	$total_installation=$_POST['total_installation'];
	$installation_done=$_POST['installation_done'];
	$installation_cancel=$_POST['installation_cancel'];
	$persent_installer=$_POST['persent_installer'];
	
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
		$update_query="UPDATE branch_service_install_report SET request_date='".$date."',request_by='".$req_persion."',total_services='".$total_services."',service_done='".$service_done."',service_cancel='".$service_cancel."',total_installation='".$total_installation."',installation_done='".$installation_done."',installation_cancel='".$installation_cancel."',present_installer='".$persent_installer."' WHERE id='".$id."'";
		
		mysql_query($update_query);
		echo "<script>document.location.href ='list_branch_service_report.php'</script>";
	
	}
	else
	{
	
		$query = "INSERT INTO branch_service_install_report (request_date, request_by, total_services, service_done, service_cancel, total_installation, installation_done, installation_cancel, present_installer, branch_id) 
		VALUES('".$date."','".$req_persion."','".$total_services."','".$service_done."','".$service_cancel."','".$total_installation."','".$installation_done."','".$installation_cancel."','".$persent_installer."','".$branch_id."')";
		
		mysql_query($query);
		echo "<script>document.location.href ='list_branch_service_report.php'</script>";
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
        <td  align="right">No Of Services:</td>
        <td><input type="text" name="total_services" id="total_services"  value="<?php echo $result[0]['total_services'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Services Done:</td>
        <td><input type="text" name="service_done" id="service_done"  value="<?php echo $result[0]['service_done'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Services Cancellation:</td>
        <td><input type="text" name="service_cancel" id="service_cancel"  value="<?php echo $result[0]['service_cancel'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">No Of Installation:</td>
        <td><input type="text" name="total_installation" id="total_installation"  value="<?php echo $result[0]['total_installation'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Installation Done:</td>
        <td><input type="text" name="installation_done" id="installation_done"  value="<?php echo $result[0]['installation_done'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Installation Cancellation:</td>
        <td><input type="text" name="installation_cancel" id="installation_cancel"  value="<?php echo $result[0]['installation_cancel'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Present Installer:</td>
        <td><input type="text" name="persent_installer" id="persent_installer"  value="<?php echo $result[0]['present_installer'];?>"/></td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_branch_service_report.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?
include("../include/footer.php");

?>
