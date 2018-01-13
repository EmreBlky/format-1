<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/


$Header="Repair Report";

$date=date("Y-m-d H:i:s");
$req_persion=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$Header="Edit Repair Report";
	$result=select_query("select * from branch_repiar_report where id='".$id."'");	
	
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
	$device_remove=$_POST['device_remove'];
	$repaired_device=$_POST['repaired_device'];
	$send_to_delhi=$_POST['send_to_delhi'];
	$not_working=$_POST['not_working'];
	$reason=$_POST['reason'];
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
		$update_query="UPDATE branch_repiar_report SET request_date='".$date."',request_by='".$req_persion."',device_remove='".$device_remove."',repaired_device='".$repaired_device."',send_to_delhi='".$send_to_delhi."',not_working='".$not_working."',reason='".$reason."' WHERE id='".$id."'";
		
		mysql_query($update_query);
		echo "<script>document.location.href ='list_branch_repiar_report.php'</script>";
	
	}
	else
	{
	
		$query = "INSERT INTO branch_repiar_report(request_date,request_by,device_remove,repaired_device,send_to_delhi,not_working,reason,branch_id) 
		VALUES('".$date."','".$req_persion."','".$device_remove."','".$repaired_device."','".$send_to_delhi."','".$not_working."','".$reason."','".$branch_id."')";
		
		mysql_query($query);
		echo "<script>document.location.href ='list_branch_repiar_report.php'</script>";
	}
}

?>
	

<form method="post" action="" name="form1" onSubmit="">

    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
	
        <tr>
            <td align="right">Request Date</td>
            <td>
              <input type="text" name="date" id="datepicker1" value="<?php echo $date;?>" />
			  </td>
        </tr>

		<tr>
            <td align="right">Request By: </td>
            <td>
                <input type="text" name="req_persion" id="TxtAccManager" readonly value="<?php echo $req_persion;?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Devices Removed:</td>
            <td>
            	<input type="text" name="device_remove" id="TxtDevice_remove"  value="<?php echo $result[0]['device_remove'];?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Repaired Devices Installed Back:</td>
            <td>
            	<input type="text" name="repaired_device" id="TxtRepaired_device"  value="<?php echo $result[0]['repaired_device'];?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Send to Delhi for Repair:</td>
            <td>
            	<input type="text" name="send_to_delhi" id="TxtSend_to_delhi"  value="<?php echo $result[0]['send_to_delhi'];?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Not Working Stock:</td>
            <td>
            	<input type="text" name="not_working" id="TxtNot_working"  value="<?php echo $result[0]['not_working'];?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Reason:</td>
            <td>
                <textarea rows="5" cols="25"  type="text" name="reason" id="TxtReason" ><?php echo $result[0]['reason'];?></textarea>
            </td>
        </tr>
        <tr>
            <td height="32" align="right">
            	<input type="submit" name="submit" value="submit" align="right" />
             </td>
             <td>
             	<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_branch_repiar_report.php' " />
             </td>
        </tr>


</table>


	</form>
   </div>

<?
include("../include/footer.inc.php");

?>
 

 
 