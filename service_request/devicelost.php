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
		$result = select_query("select * from device_lost where id=$id");	
	}
?> 

<div class="top-bar">
<h1>Device Lost</h1>
</div>
<div class="table"> 
<?php


if(isset($_POST["submit"]))
{ 

	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$client=$_POST["company"];
	$user_id=$_POST["main_user_id"];
	
	$veh_reg=$_POST["veh_reg"];
	$device_model=$_POST["Device_model"];
	
	$device_imei=$_POST["TxtDeviceIMEI"];
	$Devicemobile=$_POST["Devicemobile"]; 
	$date_of_install=$_POST["date_of_install"];  
	
	$rdd_device_model=$_POST["replaceDevice_model"];
	$rdddevice_id=$_POST["rdd_device_id"];
	$rdd_device_imei=$_POST["rdd_device_imei"]; 
	$rddDevicemobile=$_POST["rdd_Devicemobile"];
	
	$rdd_sim_no=$_POST["rdd_sim_no"]; 
	$TxtReason=$_POST["TxtReason"];
	$Txtrdd_date=$_POST["rdd_date"];
	$service_comment=$_POST["service_comment"];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];  

  
	if($veh_reg=="") {
	$veh_reg_edit=$result[0]['odd_reg_no'];
	}
	else {
	$veh_reg_edit=$veh_reg;
	}

  
  if($action=='edit')
	{
	
 $query="update device_lost set date='".$date."',acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',odd_device_model='".$device_model."',odd_reg_no='".$veh_reg_edit."',odd_sim='".$Devicemobile."',odd_imei='".$device_imei."',odd_instaltion_date='".$date_of_install."',ndd_device_id='".$rdddevice_id."',ndd_imei='".$rdd_device_imei."',ndd_sim='".$rddDevicemobile."',ndd_device_model='".$rdd_device_model."',newdevice_addeddate='".$Txtrdd_date."',reason='".$TxtReason."',service_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d")." - ".$service_comment."',device_lost_status=1 where id=$id";
 
  mysql_query($query);
 echo "<script>document.location.href ='list_device_lost.php'</script>";
}

 else {
 
  
   $query="INSERT INTO `device_lost` (`date`, acc_manager,`sales_manager`, `client`, `user_id`, `odd_device_model`, `odd_reg_no`, `odd_device_id`, `odd_imei`, `odd_sim`,`odd_instaltion_date`, `ndd_device_id`, `ndd_imei`, `ndd_sim`,  `ndd_device_model`, `newdevice_addeddate`, `reason`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$device_model."','".$veh_reg."','','".$device_imei."','".$Devicemobile."','".$date_of_install."','".$rdddevice_id."','".$rdd_device_imei."','".$rddDevicemobile."','".$rdd_device_model."','".$Txtrdd_date."','".$TxtReason."')
 ";
 

 mysql_query($query);
 echo "<script>document.location.href ='list_device_lost.php'</script>";
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
 
 if(document.myForm.sales_manager.value=="")
  {
  alert("please Select Sales Manager") ;
  document.myForm.sales_manager.focus();
  return false;
  }
   if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
  if(document.myForm.Device_model.value=="")
  {
  alert("please Select Device Model") ;
  document.myForm.Device_model.focus();
  return false;
  }  
 
  if(document.myForm.replaceDevice_model.value=="")
  {
  alert("please select New Device Model") ;
  document.myForm.replaceDevice_model.focus();
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
	if(document.myForm.TxtServiceComment.value=="")
	{
  	alert("please Enter Service Comment") ;
  	document.myForm.TxtServiceComment.focus();
  	return false;
	}
} 
	
			
  
    </script>
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

   <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

         <tr>
            <td>Date</td>
            <td>
                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
        </tr>

		<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<? echo $_SESSION['user_name'];?>"/></td>
        </tr>
		 <tr>
            <td>Sales Manager</td>
			<td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
              <?php
        $sales_manager = select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
        //while ($data=mysql_fetch_assoc($sales_manager))
		for($s=0;$s<count($sales_manager);$s++)
        {
        ?>
        
        <option name="sales_manager" value="<?=$sales_manager[$s]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$s]['name']) {?> selected="selected" <? } ?> >
        <?php echo $sales_manager[$s]['name']; ?>
        </option>
        <?php 
        } 
        ?>
          
            </select> 
            </td>
            </tr>
        <tr>
        <td>
        Client User Name</td>
        <td> 
          
        <select name="main_user_id" id="TxtMainUserId"  onchange="
        showUser(this.value,'ajaxdata'); 
        getCompanyName(this.value,'TxtCompany');">
        <option value="" >-- Select One --</option>
        <?php
        $main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($m=0;$m<count($main_user_id);$m++)
        {
        ?>
        
         <option name="main_user_id" value="<?=$main_user_id[$m]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$m]['user_id']) {?> selected="selected" <? } ?> >
        <?php echo $main_user_id[$m]['name']; ?>
        </option>
        <?php 
        } 
        
        ?>
        </select>
        
        
        
        </td>
        </tr>
        
        
        <tr>
        <td>
        Company Name</td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['client']?>" readonly />
        </td>
        </tr>
        
        
        
        <tr>
        <td>
        Registration No</td>
        <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 
        <div id="ajaxdata">
        <?=$result[0]['odd_reg_no']?>
        </div> 
        
        </td>
        </tr>
        <tr>
        <td>
        <label for="DeviceMOdel" id="lblDeviceModel">Device Model</label></td>
        <td>
        <select name="Device_model" id="Device_model">
        <option value=""  >-- Select One --</option>
        <?php
        $device=select_query("SELECT * FROM `device_type`");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($d=0;$d<count($device);$d++)
        {
        ?>
        
          <option value ="<?php echo $device[$d]['device_type'] ?>" <? if($result[0]['odd_device_model']==$device[$d]['device_type']) {?> selected="selected" <? } ?> > 
            <?php echo $device[$d]['device_type']; ?>        </option>
        </option>
        <?php 
        } 
        
        ?>
        </select></td>
        </tr>
        <tr>
        <td>
        
        <label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
        <td>
        <input type="text" name="TxtDeviceIMEI" id="TxtDeviceIMEI" value="<?=$result[0]['odd_imei']?>" readonly/></td>
        </tr>
        
        <tr>
        <td>
        <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
        <td>
        <input type="text" name="Devicemobile" id="Devicemobile" value="<?=$result[0]['odd_sim']?>" readonly/></td>
        </tr>
       
        <tr>
        <td>
        <label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>
        <td>
        <input type="text" name="date_of_install" id="date_of_install" value="<?=$result[0]['odd_instaltion_date']?>" readonly/></td>
        </tr>
          
        
            <tr>
            <td><h2>New Device Detail</h2></td>
			<td></td>
            </tr>
          
            <tr>
            <td> <label id="lblDmodel">Device Model</label></td>
			<td> 
            
            <select name="replaceDevice_model" id="replaceDevice_model">
        <option value=""  >-- Select One --</option>
        <?php
        $device=select_query("SELECT * FROM `device_type`");
        //while ($data=mysql_fetch_assoc($main_user_id))
		for($d=0;$d<count($device);$d++)
        {
        ?>
        
          <option value ="<?php echo $device[$d]['device_type'] ?>" <? if($result[0]['ndd_device_model']==$device[$d]['device_type']) {?> selected="selected" <? } ?> > 
            <?php echo $device[$d]['device_type']; ?>        </option>
        </option>
        <?php 
        } 
        
        ?>
        </select>
        </td>
			</tr>
            
            <tr>
            <td> <label id="lblDmodel">Device Id</label></td>
			<td> <input type="text" name="rdd_device_id" id="rdd_device_id" value="<?=$result[0]['ndd_device_id']?>" /></td>
			</tr>
            
			<tr>
            <td> <label id="lblDmodel">Device IMEI</label></td>
			<td> <input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result[0]['ndd_imei']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
			</tr>
              <tr>
        <td>
        <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
        <td>
        <input type="text" name="rdd_Devicemobile" id="rdd_Devicemobile" value="<?=$result[0]['ndd_sim']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
        </tr>
          
              <tr><td> <label  id="lbDlDate">Date</label></td>
			  <td> <input type="text" name="rdd_date" id="datepicker" value="<?=$result[0]['newdevice_addeddate']?>" /></td>
			  </tr>
              <tr><td> <label  id="lblReason">Reason</label></td>
			  <td> <textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result[0]['reason']?></textarea>
</td>
			  </tr>
             <?php 
		if($action=='edit') {
		?>
		 <tr>
            <td class="style2">
                Service Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ></textarea>
                </td>
        </tr>
		<?php } ?>
            
    <tr><td colspan="2" align="center"> <input type="submit" name="submit" value="submit"  />
					   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_device_lost.php' " /></td>

	</tr>

  </table>   
	  </form>
   </div>
 
<?php
include("../include/footer.php"); ?>
