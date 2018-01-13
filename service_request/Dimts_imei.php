<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from dimts_imei where id=$id");	
	}

?>

<div class="top-bar">
  <h1>Dimts Imei Addition</h1>
</div>
<div class="table">
  <?php


if(isset($_POST["submit"]))
{  
 
	$date=$_POST["date"];
	$sales_manager=$_POST["sales_manager"];
	$acc_manager=$_POST["acc_manager"];
	$client=$_POST["Company"];
	$user_id=$_POST["main_user_id"];
	$veh_reg=$_POST["veh_reg_replce"];
	$device_imei_7=trim($_POST["replaceDeviceIMEI"]); 
	$device_imei_15=trim($_POST["device_imei"]); 
	$port_change=$_POST["port_change"]; 
	$service_comment=$_POST["service_comment"]; 
	
	if($veh_reg=="") {
	$veh_reg_edit=$result[0]['veh_reg'];
	}
	else {
	$veh_reg_edit=$veh_reg;
	}
	
    if($action=='edit')
	{
	  $query="update dimts_imei set 
	date='".$date."', acc_manager='".$acc_manager."', sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',veh_reg='".$veh_reg_edit."',device_imei_7='".$device_imei_7."',device_imei_15='".$device_imei_15."',port_change='".$port_change."',service_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$service_comment."',dimts_status=1  where id=$id";
 
 
 	mysql_query($query);

 	$UpdateDeviceImei="update matrix.devices set dimts_imei='".$device_imei_15."' where imei='".$device_imei_7."' limit 1"; 
	 select_query_live($UpdateDeviceImei);

	 $UpdateVehStatus="update  matrix.services set is_dimts=1 where  sys_device_id in  (select id from matrix.devices where imei ='".$device_imei_7."')  limit 1"; 
	 select_query_live($UpdateVehStatus);
 //echo "record saved";
 	echo "<script>document.location.href ='list_dimts_imei.php'</script>";
  }
  
 else 
 {  
	$query="INSERT INTO `dimts_imei` (`date`,sales_manager,acc_manager,`client`,`user_id`,`veh_reg`, `device_imei_7`,device_imei_15,port_change) VALUES ('".$date."','".$sales_manager."','".$acc_manager."','".$client."','".$user_id."','".$veh_reg_edit."','".$device_imei_7."','".$device_imei_15."','".$port_change."')";
	
	mysql_query($query); 
	
	$UpdateDeviceImei="update matrix.devices set dimts_imei='".$device_imei_15."' where imei='".$device_imei_7."' limit 1"; 
	select_query_live($UpdateDeviceImei);
	
	$UpdateVehStatus="update  matrix.services set is_dimts=1 where  sys_device_id in  (select id from matrix.devices where imei ='".$device_imei_7."')  limit 1"; 
	select_query_live($UpdateVehStatus);
	 
 //echo "record saved";
 echo "<script>document.location.href ='list_dimts_imei.php'</script>";

}}
?>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
  <script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

$( "#datepickercheque" ).datepicker({ dateFormat: "yy-mm-dd" });

});
     
function validateForm()
{
  if(document.myForm.sales_manager.value=="")
  {
  alert("Please choose Sales Manager") ;
  document.myForm.sales_manager.focus();
  return false;
  }  
   if(document.myForm.main_user_id.value=="")
  {
  alert("Please Choose Client Name") ;
  document.myForm.main_user_id.focus();
  return false;
  }
   if(document.myForm.device_imei.value=="")
  {
  alert("Please enter 15 Digit IMEI ") ;
  document.myForm.device_imei.focus();
  return false;
  }
   
 var device_imei=document.myForm.device_imei.value;
  if(device_imei!="")
        {
	var length=device_imei.length;
	
        if(length < 15 || length > 20 || device_imei.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid 15 Digit IMEI ');
        document.myForm.device_imei.focus();
        document.myForm.device_imei.value="";
        return false;
        }
        }
	}
	
 
    </script>
  <form name="myForm" action="" onSubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td>Date</td>
        <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
      </tr>
      <tr>
        <td>Account Manager</td>
        <td><input type="text" name="acc_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
      </tr>
      <tr>
        <td>Sales Manager</td>
        <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
            <?php
        $sales_manager = select_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
        //while ($data=mysql_fetch_assoc($sales_manager))
		for($i=0;$i<count($sales_manager);$i++)
        {
        ?>
            <option name="sales_manager" value="<?=$sales_manager[$i]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$i]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$i]['name']; ?> </option>
            <?php 
        } 
        ?>
          </select></td>
      </tr>
      <tr>
        <td> User Name</td>
        <h2></h2>
        <td><select name="main_user_id" id="main_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'Company');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
            $main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
            //while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
            {
            ?>
            <option   value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?>> <?php echo $main_user_id[$u]['name']; ?> </option>
            <?php 
            } 
            
            ?>
          </select></td>
      </tr>
      <tr>
        <td> Company Name</td>
        <td><input type="text" name="Company" id="Company" readonly value="<?=$result[0]['client']?>" /></td>
      </tr>
      <tr>
        <td> Vehicle No</td>
        <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
          
          <div id="ajaxdatareplace">
            <?=$result[0]['veh_reg']?>
          </div></td>
      </tr>
      <tr>
        <td><label for="DeviceIMEI"  id="lblDeviceImei">7 Digit IMEI</label></td>
        <td><input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" readonly value="<?=$result[0]['device_imei_7']?>"/></td>
      </tr>
      <tr>
        <td><label  id="lbDlDate">15 Digit IMEI</label></td>
        <td><input type="text" name="device_imei" id="device_imei" value="<?=$result[0]['device_imei_15']?>"/></td>
      </tr>
      <tr>
        <td><label  id="lbDlDate">Changed to Port</label></td>
        <td><input type="text" name="port_change" id="port_change" value="14002" readonly=""/></td>
      </tr>
      <?php 
		if($action=='edit') {
		?>
      <tr>
        <td class="style2"> Service Comment</td>
        <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ></textarea></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="submit"  />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_dimts_imei.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
