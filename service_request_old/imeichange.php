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
		$result = select_query("select * from imei_change where id=$id");	
	}

?>

<div class="top-bar">
  <h1>IMEI Change</h1>
</div>
<div class="table">
  <?
if(isset($_POST["submit"]))
{ 

 
	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$client=$_POST["company"];
	$user_id=$_POST["main_user_id"];
	$device_model=$_POST["Device_model"];
	$veh_reg=$_POST["veh_reg"];
	$device_imei=$_POST["TxtDeviceIMEI"];
	$Devicemobile=$_POST["Devicemobile"]; 
	$date_of_install=$_POST["date_of_install"]; 
	$rdd_device_model=$_POST["rdd_device_model"];
	
	$rdd_device_id=$_POST["rdd_device_id"];
	$rdd_device_imei=$_POST["rdd_device_imei"];
	$rddDevicemobile=$_POST["rdd_Devicemobile"];
	$replaceDevicemobile=$_POST["rdd_sim_num"];
	$TxtReason=$_POST["TxtReason"];
	$Txtrdd_date=$_POST["rdd_date"];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];  
	
	$service_comment=$_POST["service_comment"];

  if($veh_reg=="") {
	$veh_reg_edit=$result[0]['vehicle'];
	}
	else {
	$veh_reg_edit=$veh_reg;
	}

 
 
  if($action=='edit')
	{
	
 $query="update imei_change set date='".$date."',acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',vehicle='".$veh_reg_edit."',device_model='".$device_model."',od_imei='".$device_imei."' ,od_sim='".$Devicemobile."',date_of_installation='".$date_of_install."',new_devicetype='".$rdd_device_model."',new_deviceid='".$rdd_device_id."',new_device_imei='".$rdd_device_imei."',new_sim='".$rddDevicemobile."',replace_date='".$Txtrdd_date."',reason='".$TxtReason."',service_comment='".$service_comment."',payment_status='".$payment_status."' where id=$id";
  mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_imei_change.php'</script>";
}

 else {
 
   $query="INSERT INTO `imei_change` (`date`,acc_manager, sales_manager,`client`, `user_id`, `vehicle`, `device_model`, `od_imei`, `od_sim`, `date_of_installation`, `new_devicetype`, `new_deviceid`, `new_device_imei`, `new_sim`, `replace_date`, `reason`,payment_status) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$veh_reg."','".$device_model."','".$device_imei."','".$Devicemobile."','".$date_of_install."','".$rdd_device_model."','".$rdd_device_id."','".$rdd_device_imei."','".$rddDevicemobile."','".$Txtrdd_date."','".$TxtReason."','".$payment_status."')";
 
 mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_imei_change.php'</script>";
}
}
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
 
 
  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
   if(document.myForm.Device_model.value=="")
  {
  alert("please Enter Model") ;
  document.myForm.Device_model.focus();
  return false;
  }  
 
  if(document.myForm.rdd_device_model.value=="")
  {
  alert("please Enter Model") ;
  document.myForm.rdd_device_model.focus();
  return false;
  }
  if(document.myForm.rdd_device_id.value=="")
  {
  alert("please Enter Device Id") ;
  document.myForm.rdd_device_id.focus();
  return false;
  }
  if(document.myForm.rdd_device_imei.value=="")
  {
  alert("please Enter Device Imei") ;
  document.myForm.rdd_device_imei.focus();
  return false;
  }
   if(document.myForm.rdd_Devicemobile.value=="")
  {
  alert("please Enter Device Mobile No.") ;
  document.myForm.rdd_Devicemobile.focus();
  return false;
  }
  var rdd_Devicemobile=document.myForm.rdd_Devicemobile.value;
  if(rdd_Devicemobile!="")
        {
	var length=rdd_Devicemobile.length;
	
        if(length < 9 || length > 15 || rdd_Devicemobile.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.myForm.rdd_Devicemobile.focus();
        document.myForm.rdd_Devicemobile.value="";
        return false;
        }
        }

	if(document.myForm.rdd_sim_num.value=="")
  {
  alert("please Enter SIM No.") ;
  document.myForm.rdd_sim_num.focus();
  return false;
  }
	
	if(document.myForm.rdd_date.value=="")
	{
  	alert("please Enter Date") ;
  	document.myForm.rdd_date.focus();
  	return false;
  	}
	if(document.myForm.TxtReason.value=="")
	{
  	alert("please Enter Reason") ;
  	document.myForm.TxtReason.focus();
  	return false;
	}
			} 

      
    </script>
  <form name="myForm" action="" onsubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
    <tr>
      <td>Date</td>
      <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
    </tr>
    <tr>
      <td>Account Manager</td>
      <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
    </tr>
    <tr>
      <td>Sales Manager</td>
      <td><select name="sales_manager" id="sales_manager">
          <option value="" >-- select one --</option>
          <?php
        $sales_manager=select_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
        //while ($data=mysql_fetch_assoc($sales_manager))
		for($s=0;$s<count($sales_manager);$s++)
        {
        ?>
          <option name="sales_manager" value="<?=$sales_manager[$s]['name']?>" <? if($result[0]['sales_person']==$sales_manager[$s]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$s]['name']; ?> </option>
          <?php 
        } 
        ?>
        </select></td>
    </tr>
    <tr>
      <td> Client User Name</td>
      <td><select name="main_user_id" id="TxtMainUserId"  onchange="
        showUser(this.value,'ajaxdata'); 
        getCompanyName(this.value,'TxtCompany');">
          <option value="" >-- Select One --</option>
          <?php
        $main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($m=0;$m<count($main_user_id);$m++)
        {
        ?>
          <option name="main_user_id" value="<?=$main_user_id[$m]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$m]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$m]['name']; ?> </option>
          <?php 
        } 
        
        ?>
        </select></td>
    </tr>
    <tr>
      <td> Company Name</td>
      <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['client']?>" readonly /></td>
    </tr>
    <tr>
      <td> Registration No</td>
      <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
        
        <div id="ajaxdata">
          <?=$result[0]['vehicle']?>
        </div></td>
    </tr>
    <tr>
      <td><label for="DeviceMOdel" id="lblDeviceModel">Device Model</label></td>
      <td><select name="Device_model" id="Device_model">
          <option value=""  >-- Select One --</option>
          <?php
        $device=select_query("SELECT * FROM `device_type`");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($d=0;$d<count($device);$d++)
        {
        ?>
          <option value ="<?php echo $device[$d]['device_type'] ?>" <? if($result[0]['device_model']==$device[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $device[$d]['device_type']; ?> </option>
          <?php 
        } 
        
        ?>
        </select></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
      <td><input type="text" name="TxtDeviceIMEI" id="TxtDeviceIMEI" value="<?=$result[0]['od_imei']?>" readonly/></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
      <td><input type="text" name="Devicemobile" id="Devicemobile" value="<?=$result[0]['od_sim']?>" readonly/></td>
    </tr>
    <tr>
      <td><label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>
      <td><input type="text" name="date_of_install" id="date_of_install" value="<?=$result[0]['date_of_installation']?>" readonly/></td>
    </tr>
    <tr>
      <td><h2>Replaced IMEI Detail</h2></td>
      <td></td>
    </tr>
    <tr>
      <td><label id="lblDmodel">Device Model</label></td>
      <td><select name="rdd_device_model" id="rdd_device_model">
          <option value=""  >-- Select One --</option>
          <?php
        $device1=select_query("SELECT * FROM `device_type`");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($d=0;$d<count($device1);$d++)
        {
        ?>
          <option value ="<?php echo $device1[$d]['device_type'] ?>" <? if($result[0]['new_devicetype']==$device1[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $device1[$d]['device_type']; ?> </option>
          <?php 
        } 
        
        ?>
        </select></td>
    </tr>
    <tr>
      <td><label id="lblDmodel">Device Id</label></td>
      <td><input type="text" name="rdd_device_id" id="rdd_device_id" value="<?=$result[0]['new_deviceid']?>" /></td>
    </tr>
    <tr>
      <td><label id="lblDmodel">Device IMEI</label></td>
      <td><input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result[0]['new_device_imei']?>" /></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
      <td><input type="text" name="rdd_Devicemobile" id="rdd_Devicemobile" value="<?=$result[0]['new_sim']?>" /></td>
    </tr>
    <tr>
      <td width="276"><label  id="lbDlDate">Payment Status</label></td>
      <td width="187"><select name="payment_status" id="payment_status" >
          <option value="" >-- select one --</option>
          <option value="Paid" <? if($result[0]['payment_status']=='Paid') {?> selected="selected" <? } ?> > Paid</option>
          <option value="UnPaid" <? if($result[0]['payment_status']=='UnPaid') {?> selected="selected" <? } ?> > UnPaid</option>
        </select></td>
    </tr>
    <tr>
      <td><label  id="lbDlDate">Date</label></td>
      <td><input type="text" name="rdd_date" id="datepicker" value="<?=$result[0]['replace_date']?>" /></td>
    </tr>
    <tr>
      <td><label  id="lblReason">Reason</label></td>
      <td><textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result[0]['reason']?>
</textarea></td>
    </tr>
    <?php 
		if($action=='edit') {
		?>
    <tr>
      <td class="style2"> Service Comment</td>
      <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><?=$result[0]['service_comment']?>
</textarea></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="submit"  />
        <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_imei_change.php' " /></td>
    </tr>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
