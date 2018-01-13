<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/


$Header="Stock Report";

$date=date("Y-m-d H:i:s");
$req_persion=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$Header="Edit Repair Report";
	$result = select_query("select * from branch_stock_report where id='".$id."'");	
	
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
	$device_modal=$_POST['device_modal'];
	$courier_in=$_POST['courier_in'];
	$installed_out=$_POST['installed_out'];
	$ffc=$_POST['ffc'];
	$current_stock=$_POST['current_stock'];
	if($_SESSION['username']=="anoop")
	{
		$branch_id=1;
	}
	else if($_SESSION['username']=="rakhi")
	{
		$branch_id=2;
	}
	else if($_SESSION['username']=="amit")
	{
		$branch_id=6;
	}
	else if($_SESSION['username']=="ankur")
	{
		$branch_id=3;
	}
	else
	{
		$branch_id=1;	
	}
	
	if($action=='edit')
	{
		$update_query="UPDATE branch_stock_report SET request_date='".$date."',request_by='".$req_persion."',description='".$device_modal."',courier_in='".$courier_in."',installed_out='".$installed_out."',ffc='".$ffc."',current_stock='".$current_stock."' WHERE id='".$id."'";
		
		mysql_query($update_query);
		echo "<script>document.location.href ='list_branch_stock_report.php'</script>";
	
	}
	else
	{
	
		$query = "INSERT INTO branch_stock_report(request_date,request_by,description,courier_in,installed_out,ffc,current_stock,branch_id) 
		VALUES('".$date."','".$req_persion."','".$device_modal."','".$courier_in."','".$installed_out."','".$ffc."','".$current_stock."','".$branch_id."')";
		
		mysql_query($query);
		echo "<script>document.location.href ='list_branch_stock_report.php'</script>";
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
        <td  align="right">Devices Modal:</td>
        <!--<td>
            	<input type="text" name="device_modal" id="TxtDevice_modal"  value="<?php echo $result[0]['description'];?>"/>
            </td>-->
        <td><select name="device_modal" id="device_modal">
            <option value="">-- Select One --</option>
            <?php
                $main_user_id = select_query("SELECT * FROM `device_type`");
                //while ($data=mysql_fetch_assoc($main_user_id))
				for($i=0;$i<count($main_user_id);$i++)
                {
                ?>
            <option value ="<?php echo $main_user_id[$i]['device_type'] ?>" <? if($result[0]['description']==$main_user_id[$i]['device_type']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$i]['device_type']; ?> </option>
            <?php 
                } 
                
                ?>
          </select></td>
      </tr>
      <tr>
        <td  align="right">Courier In:</td>
        <td><input type="text" name="courier_in" id="TxtCourier_in"  value="<?php echo $result[0]['courier_in'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Installed Out:</td>
        <td><input type="text" name="installed_out" id="TxtInstalled_out"  value="<?php echo $result[0]['installed_out'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">FFC:</td>
        <td><input type="text" name="ffc" id="Txtffc"  value="<?php echo $result[0]['ffc'];?>"/></td>
      </tr>
      <tr>
        <td  align="right">Current Stock:</td>
        <td><input type="text" name="current_stock" id="TxtCurrent_stock"  value="<?php echo $result[0]['current_stock'];?>"/></td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_branch_stock_report.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?
include("../include/footer.php");

?>
