<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/


$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from new_device_addition where id=$id");	
	}

?>

<div class="top-bar">
  <h1>New Device Addition</h1>
</div>
<div class="table">
  <?php


if(isset($_POST["submit"]))
{  

	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$client=$_POST["company"];
	$user_id=$_POST["main_user_id"];
	$Device_type=$_POST["Device_type"];
	$Veh_num=$_POST["Veh_num"];
	
	$rdd_device_model=$_POST["rdd_device_model"];
	$rdd_device_id=$_POST["rdd_device_id"]; 
	$rdd_device_imei=$_POST["rdd_device_imei"]; 
	$rdd_sim_no=$_POST["rdd_sim_no"];
	
	$replace_user_id=$_POST["replace_user_id"]; 
	$ReplaceCompany=$_POST["ReplaceCompany"];
	$veh_reg_replce=$_POST["veh_reg_replce"];
	$replaceDevice_model=$_POST["replaceDevice_model"];
	$replaceDeviceIMEI=$_POST["replaceDeviceIMEI"];
	$replaceDevicemobile=$_POST["replaceDevicemobile"];
	$replacedate_of_install=$_POST["replacedate_of_install"];
	
	$immobilizer=$_POST['immobilizer'];
	$ac_on_off=$_POST['ac_on_off'];
	$rdd_date=$_POST["rdd_date"];
	$TxtReason=$_POST["TxtReason"];  
  //$inst_name=$_POST["inst_name"];  
    $service_comment=$_POST["service_comment"];  
    $sales_manager=$_POST["sales_manager"];  
    $dimts=$_POST["dimts"];  


	if($Device_type=='New') 
	{
	  $billing=$_POST["billing"];
	}
	else if($Device_type=='Old') 
	{
	  $billing=$_POST["billing1"];
	}
	  
	if($Device_type=='New') 
	{
		$reason=$_POST["billing_reason_nonew"];
	}
	else if($Device_type=='Old') 
	{
		$reason=$_POST["billing_reason_noold"];
	}

	
	if($veh_reg_replce=="") 
	{
		$veh_reg_replce_edit=$result[0]['old_vehicle_name'];
	}
	else 
	{
		$veh_reg_replce_edit=$veh_reg_replce;
	}

  
	if($action=='edit')
	{
	
		if($Device_type=='New')
		{  
			 $query="update new_device_addition set client='".$client."',user_id='".$user_id."',vehicle_no='".$Veh_num."',ac='".$ac_on_off."',immobilizer='".$immobilizer."',device_type='".$Device_type."',device_model='".$rdd_device_model."',device_id='".$rdd_device_id."',device_imei='".$rdd_device_imei."',device_sim_num='".$rdd_sim_no."',date_of_installation='".$rdd_date."',reason='".$TxtReason."',billing='".$billing."',billing_if_no_reason='".$reason."',service_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$service_comment."',dimts='".$dimts."' where id=$id";
		
		}
		elseif($Device_type=='Old')
		{  
		
			 $query="update new_device_addition set client='".$client."',user_id='".$user_id."',vehicle_no='".$Veh_num."',ac='".$ac_on_off."',immobilizer='".$immobilizer."' ,device_type='".$Device_type."',device_model='".$replaceDevice_model."',device_imei='".$replaceDeviceIMEI."',device_sim_num='".$replaceDevicemobile."',old_device_client='".$ReplaceCompany."',old_device_user='".$replace_user_id."',old_vehicle_name='".$veh_reg_replce_edit."',olddate_of_installation='".$replacedate_of_install."',date_of_installation='".$rdd_date."',reason='".$TxtReason."',billing_if_old_device='".$billing."',billing_if_no_reason='".$reason."',service_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$service_comment."',dimts='".$dimts."' where id=$id";
		
		}
 
		
		mysql_query($query);
		echo "<script>document.location.href ='list_new_device_addition.php'</script>";
	}
	else
	{
  
		if($Device_type=='New')
		{  
		
			$query="INSERT INTO `new_device_addition` (`date`, `acc_manager`,sales_manager,`client`, `user_id`, `vehicle_no`, `ac`, `immobilizer`, `device_type`, `device_model`, `device_id`, `device_imei`, `date_of_installation`,`reason`,billing,billing_if_no_reason,dimts) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$Veh_num."','".$ac_on_off."','".$immobilizer."','".$Device_type."','".$rdd_device_model."','".$rdd_device_id."','".$rdd_device_imei."','".$rdd_date."','".$TxtReason."','".$billing."','".$reason."','".$dimts."')";
		
		}
		else if($Device_type=='Old')
		{  
			
			$query="INSERT INTO `new_device_addition` (`date`, `acc_manager`,sales_manager,`client`, `user_id`, `vehicle_no`, `ac`, `immobilizer`, `device_type`, `device_model`, `device_imei`, `device_sim_num`, `old_device_client`, `old_device_user`, `old_vehicle_name`, olddate_of_installation, `date_of_installation`,`reason`, billing_if_old_device, billing_if_no_reason, dimts)   VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$Veh_num."','".$ac_on_off."','".$immobilizer."','".$Device_type."','".$replaceDevice_model."','".$replaceDeviceIMEI."','".$replaceDevicemobile."','".$ReplaceCompany."','".$replace_user_id."','".$veh_reg_replce."','".$replacedate_of_install."','".$rdd_date."','".$TxtReason."','".$billing."','".$reason."','".$dimts."')";
		}
		
		//die;
		mysql_query($query);
		echo "<script>document.location.href ='list_new_device_addition.php'</script>";
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
	  return false;
  }
  if(document.myForm.TxtMainUserId.value=="")
  {
	  alert("please choose Client Name") ;
	  document.myForm.TxtMainUserId.focus();
	  return false;
  }  
  if(document.myForm.Veh_num.value=="")
  {
	  alert("please Enter Vehicle no.") ;
	  document.myForm.Veh_num.focus();
	  return false;
  }  
  if(document.myForm.Device_type.value=="")
  {
	  alert("please Choose Device Type") ;
	  document.myForm.Device_type.focus();
	  return false;
  }
  
 if(document.myForm.Device_type.value=="New")
 {
  
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
	  if(document.myForm.billing.value=="")
	  {
		  alert("please Select Billing") ;
		  return false;
	  }
	  var bill = document.myForm.billing.value;
	  var reason = document.myForm.billing_reason.value;
	  //alert(reason);
	  if(bill=="No")
	  {
		if(document.myForm.billing_reason.value=="")
		{
			alert("please Enter billing reason") ;
			return false;
		}
  	  }
  /* if(document.myForm.rdd_sim_no.value=="")
  {
  alert("please Enter SIM No.") ;
  document.myForm.rdd_sim_no.focus();
  return false;
  }
  var rdd_sim_no=document.myForm.rdd_sim_no.value;
  if(rdd_sim_no!="")
        {
	var length=rdd_sim_no.length;
	
        if(length < 9 || length > 15 || rdd_sim_no.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.myForm.rdd_sim_no.focus();
        document.myForm.rdd_sim_no.value="";
        return false;
        }
        }*/
		
	}
	else
	{
		if(document.myForm.replace_user_id.value=="")
		{
			alert("please Enter User Name") ;
			document.myForm.replace_user_id.focus();
			return false;
		}
		
		if(document.myForm.replaceDevice_model.value=="")
		{
			alert("please Enter Model") ;
			document.myForm.replaceDevice_model.focus();
			return false;
		}
		if(document.myForm.billing1.value=="")
		{
		  alert("please Select Billing") ;
		  return false;
		}	
		var bill1 = document.myForm.billing1.value;
		var reasion = document.myForm.billing_reason1.value;
		//alert(bill1);
		if(bill1=="No" && reasion=="")
		{
			alert("please Enter billing reason") ;
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
	if(document.myForm.dimts.value=="")
	{
		alert("please Select Dimts") ;
		return false;
	}
	if(document.myForm.TxtServiceComment.value=="")
	{
		alert("please enter Service Comment") ;
		return false;
	}
} 
	
	

 function NewOldDeviceDiv(radioValue)
{
	
if(radioValue=='New')
	{
	document.getElementById('OldDevice').style.display = "none";
	document.getElementById('NewDevice').style.display = "block";
	document.getElementById('OldDevice1').style.display = "none";
	document.getElementById('NewDevice1').style.display = "none";

	}
	else if(radioValue=='Old')
	{
	document.getElementById('OldDevice').style.display = "block";
	document.getElementById('NewDevice').style.display = "none";
	document.getElementById('OldDevice1').style.display = "none";
	document.getElementById('NewDevice1').style.display = "none";

	}
	}
 function Status(radioValue)
{
 if(radioValue=="Yes")
	{
	document.getElementById('No').style.display = "none";
	document.getElementById('No1').style.display = "none";

	}
	else if(radioValue=="No")
	{

	document.getElementById('No').style.display = "block";
	document.getElementById('No1').style.display = "none";
	}
	else
	{
	document.getElementById('No').style.display = "none";
	document.getElementById('No1').style.display = "none";
	} 
	
}
function Status_old(radioValue)
{
 if(radioValue=="Yes")
	{
	document.getElementById('old_No').style.display = "none";
	document.getElementById('old_No1').style.display = "none";

	}
	else if(radioValue=="No")
	{

	document.getElementById('old_No').style.display = "block";
	document.getElementById('old_No1').style.display = "none";
	}
	else
	{
	document.getElementById('old_No1').style.display = "none";
	document.getElementById('old_No').style.display = "none";
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
				$sales_manager = select_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
				//while($data=mysql_fetch_array($query)) 
				for($s=0;$s<count($sales_manager);$s++)
				
				{
				?>
            <option name="sales_manager" value="<?=$sales_manager[$s]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$s]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$s]['name']; ?> </option>
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
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
            $main_user_iddata = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
            //while ($data=mysql_fetch_assoc($main_user_iddata))
			for($u=0;$u<count($main_user_iddata);$u++)
            {
            ?>
            <option name="main_user_id" value="<?=$main_user_iddata[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_iddata[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_iddata[$u]['name']; ?> </option>
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
        <td> Vehicle Name</td>
        <td><input type="text" name="Veh_num" id="Veh_num" value="<?=$result[0]['vehicle_no']?>"  /></td>
      </tr>
      <tr>
        <td>Device Type</td>
        <td><select name="Device_type" id="Device_type" onchange="NewOldDeviceDiv(this.value)" >
            <option value="" >-- select one --</option>
            <option value="New" <? if($result[0]['device_type']=='New') {?> selected="selected" <? } ?> > New Device</option>
            <option value="Old" <? if($result[0]['device_type']=='Old') {?> selected="selected" <? } ?> > Old Device</option>
          </select></td>
      </tr>
      <tr>
        <td colspan="2" align="left"><?php if($result[0]['device_type']=='New'){ ?>
          <table  id="NewDevice"  align="center" style="width: 500px; border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td><label id="lblDmodel">Device Model</label></td>
              <td><select name="rdd_device_model" id="rdd_device_model">
                  <option value="" >-- Select One --</option>
                  <?php
                    $main_user_id = select_query("SELECT * FROM `device_type`");
                    //while ($data=mysql_fetch_assoc($main_user_id))
					for($d=0;$d<count($main_user_id);$d++)
                    {
                    ?>
                  <option value ="<?php echo $main_user_id[$d]['device_type'] ?>" <? if($result[0]['device_model']==$main_user_id[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$d]['device_type']; ?> </option>
                  <?php 
                    } 
                    
                    ?>
                </select></td>
            </tr>
            <tr>
              <td><label id="lblDmodel">Device Id</label></td>
              <td><input type="text" name="rdd_device_id" id="rdd_device_id" value="<?=$result[0]['device_id']?>" /></td>
            </tr>
            <tr>
              <td><label id="lblDmodel">Device IMEI</label></td>
              <td><input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result[0]['device_imei']?>"/></td>
            </tr>
            <tr>
              <td class="style2"> Billing</td>
              <td><select name="billing" id="billing" onchange="Status(this.value)">
                  <option value="">Select Reason</option>
                  <option value="Yes" <? if($result[0]['billing']=="Yes") {?> selected="selected" <? } ?> >Yes</option>
                  <option value="No" <? if($result[0]['billing']=="No") {?> selected="selected" <? } ?> >No</option>
                </select></td>
              <!--<td>
        
                     <Input type = 'Radio' Name ='billing'    value= 'Yes' <?php if($result[0]['billing']=="Yes"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)"
                    >Yes
                    
                    <Input type = 'Radio' Name ='billing'    value= 'No' <?php if($result[0]['billing']=="No"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)"
                    >No</td>--> 
            </tr>
            <tr>
              <td colspan="2"><?php if($result[0]['billing']=='No') { ?>
                <table  id="No1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_nonew" id="billing_reason" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table>
                <? } ?>
                <table  id="No" align="left"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_nonew" id="billing_reason" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <? } ?>
          <table  id="NewDevice" align="left"  style="width: 500px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td><label id="lblDmodel">Device Model</label></td>
              <td><select name="rdd_device_model" id="rdd_device_model">
                  <option value="" >-- Select One --</option>
                  <?php
                    $main_user_id=mysql_query("SELECT * FROM `device_type`");
                    //while ($data=mysql_fetch_assoc($main_user_id))
					for($d=0;$d<count($main_user_id);$d++)
                    {
                    ?>
                  <option value ="<?php echo $main_user_id[$d]['device_type'] ?>" <? if($result[0]['device_model']==$main_user_id[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$d]['device_type']; ?> </option>
                  <?php 
                    } 
                    
                    ?>
                </select></td>
            </tr>
            <tr>
              <td><label id="lblDmodel">Device Id</label></td>
              <td><input type="text" name="rdd_device_id" id="rdd_device_id" value="<?=$result[0]['device_id']?>" /></td>
            </tr>
            <tr>
              <td><label id="lblDmodel">Device IMEI</label></td>
              <td><input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result[0]['device_imei']?>" /></td>
            </tr>
            <tr>
              <td class="style2"> Billing</td>
              <td><select name="billing" id="billing" onchange="Status(this.value)">
                  <option value="">Select Reason</option>
                  <option value="Yes" <? if($result[0]['billing']=="Yes") {?> selected="selected" <? } ?> >Yes</option>
                  <option value="No" <? if($result[0]['billing']=="No") {?> selected="selected" <? } ?> >No</option>
                </select></td>
              <!--<td>
        
                     <Input type = 'Radio' Name ='billing'    value= 'Yes' <?php if($result[0]['billing']=="Yes"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)"
                    >Yes
                    
                    <Input type = 'Radio' Name ='billing'    value= 'No' <?php if($result[0]['billing']=="No"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)"
                    >No</td>--> 
            </tr>
            <tr>
              <td colspan="2"><?php if($result[0]['billing']=='No') { ?>
                <table  id="No1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_nonew" id="billing_reason" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table>
                <? } ?>
                <table  id="No" align="left"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_nonew" id="billing_reason" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2" align="left"><?php if($result[0]['device_type']=='Old'){ ?>
          <table  id="OldDevice1" align="center" style="width: 500px; border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td> Client User Name</td>
              <h2></h2>
              <td><select name="replace_user_id" id="replace_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'ReplaceCompany');">
                  <option value=""  >-- Select One --</option>
                  <?php
                $main_user_id1 = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
                //while ($data=mysql_fetch_assoc($main_user_id))
				for($u=0;$u<count($main_user_id1);$u++)
                {
                ?>
                  <option   value="<?=$main_user_id1[$u]['user_id']?>" <? if($result[0]['old_device_user']==$main_user_id1[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id1[$u]['name']; ?> </option>
                  <?php 
                } 
                
                ?>
                </select></td>
            </tr>
            <tr>
              <td> Company Name</td>
              <td><input type="text" name="ReplaceCompany" id="ReplaceCompany" value="<?=$result[0]['old_device_client']?>" readonly /></td>
            </tr>
            <tr>
              <td> Registration No</td>
              <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
                
                <div id="ajaxdatareplace">
                  <?=$result[0]['old_vehicle_name']?>
                </div></td>
            </tr>
            <tr>
              <td><label for="DeviceMOdel" id="replacelblDeviceModel">Device Model</label></td>
              <td><select name="replaceDevice_model" id="replaceDevice_model">
                  <option value=""  >-- Select One --</option>
                  <?php
                $device = select_query("SELECT * FROM `device_type`");
                //while ($data=mysql_fetch_assoc($device))
					for($d=0;$d<count($device);$d++)
				
                {
                ?>
                  <option   value="<?php echo $device[$d]['device_type'] ?>" <? if($result[0]['device_model']==$device[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $device[$d]['device_type']; ?> </option>
                  <?php 
                } 
                
                ?>
                </select></td>
            </tr>
            <tr>
              <td><label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
              <td><input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" value="<?=$result[0]['device_imei']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="Deviceid" id="lblDeviceid">Device Id</label></td>
              <td><input type="text" name="replaceDeviceid" id="replaceDeviceid" value="<?=$result[0]['oldDevice_id']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
              <td><input type="text" name="replaceDevicemobile" id="replaceDevicemobile" value="<?=$result[0]['device_sim_num']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>
              <td><input type="text" name="replacedate_of_install" id="replacedate_of_install" value="<?=$result[0]['olddate_of_installation']?>" readonly/></td>
            </tr>
            <tr>
              <td> Billing</td>
              <td><select name="billing1" id="billing1" onchange="Status_old(this.value)">
                  <option value="">Select Reason</option>
                  <option value="Yes" <? if($result[0]['billing']=="Yes") {?> selected="selected" <? } ?> >Yes</option>
                  <option value="No" <? if($result[0]['billing']=="No") {?> selected="selected" <? } ?> >No</option>
                </select></td>
              <!--<td>
    
            <Input type = 'Radio' Name ='billing1'    value= 'Yes' <?php if($result[0]['billing']=="Yes"){echo "checked=\"checked\""; }?>
                onchange="Status_old(this.value)">Yes
    
            <Input type = 'Radio' Name ='billing1'    value= 'No' <?php if($result[0]['billing']=="No"){echo "checked=\"checked\""; }?>
            onchange="Status_old(this.value)">No</td>--> 
            </tr>
            <tr>
              <td colspan="2"><?php if($result[0]['billing_if_old_device']=='No') { ?>
                <table  id="old_No1" align="center"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_noold" id="billing_reason1" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table>
                <? } ?>
                <table  id="old_No" align="left"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_noold" id="billing_reason1" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          <? } ?>
          <table  id="OldDevice" align="center"  style="width: 500px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td> Client User Name</td>
              <h2></h2>
              <td><select name="replace_user_id" id="replace_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'ReplaceCompany');">
                  <option value=""  >-- Select One --</option>
                  <?php
            $main_user_id2 = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient ORDER BY `name` asc");
            //while ($data=mysql_fetch_assoc($main_user_id2))
			for($c=0;$c<count($main_user_id2);$c++)
            {
            ?>
                  <option   value="<?=$main_user_id2[$c]['user_id']?>" <? if($result[0]['old_device_user']==$main_user_id2[$c]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id2[$c]['name']; ?> </option>
                  <?php 
            } 
            
            ?>
                </select></td>
            </tr>
            <tr>
              <td> Company Name</td>
              <td><input type="text" name="ReplaceCompany" id="ReplaceCompany" value="<?=$result[0]['old_device_client']?>" readonly /></td>
            </tr>
            <tr>
              <td> Registration No</td>
              <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
                
                <div id="ajaxdatareplace">
                  <?=$result[0]['old_vehicle_name']?>
                </div></td>
            </tr>
            <tr>
              <td><label for="DeviceMOdel" id="replacelblDeviceModel">Device Model</label></td>
              <td><select name="replaceDevice_model" id="replaceDevice_model">
                  <option value=""  >-- Select One --</option>
                  <?php
            $device2 = select_query("SELECT * FROM `device_type`");
            //while ($data=mysql_fetch_assoc($main_user_id))
			for($d=0;$d<count($device2);$d++)
            {
            ?>
                  <option   value="<?php echo $device2[$d]['device_type'] ?>" <? if($result[0]['device_model']==$device2[$d]['device_type']) {?> selected="selected" <? } ?> > <?php echo $device2[$d]['device_type']; ?> </option>
                  <?php 
            } 
            
            ?>
                </select></td>
            </tr>
            <tr>
              <td><label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
              <td><input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" value="<?=$result[0]['device_imei']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="Deviceid" id="lblDeviceid">Device Id</label></td>
              <td><input type="text" name="replaceDeviceid" id="replaceDeviceid" value="<?=$result[0]['old_device_id']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
              <td><input type="text" name="replaceDevicemobile" id="replaceDevicemobile" value="<?=$result[0]['device_sim_num']?>" readonly/></td>
            </tr>
            <tr>
              <td><label for="Device_id" id="lblDevice_id">Date Of Installation</label></td>
              <td><input type="text" name="replacedate_of_install" id="replacedate_of_install" value="<?=$result[0]['olddate_of_installation']?>" readonly/></td>
            </tr>
            <tr>
              <td class="style2"> Billing</td>
              <td><select name="billing1" id="billing1" onchange="Status_old(this.value)">
                  <option value="">Select Reason</option>
                  <option value="Yes" <? if($result[0]['billing']=="Yes") {?> selected="selected" <? } ?> >Yes</option>
                  <option value="No" <? if($result[0]['billing']=="No") {?> selected="selected" <? } ?> >No</option>
                </select></td>
              <!-- <td>

             <Input type = 'Radio' Name ='billing1'    value= 'Yes' <?php if($result[0]['billing']=="Yes"){echo "checked=\"checked\""; }?>
            onchange="Status_old(this.value)"
            >Yes
            
            <Input type = 'Radio' Name ='billing1'   value= 'No' <?php if($result[0]['billing']=="No"){echo "checked=\"checked\""; }?>
            onchange="Status_old(this.value)"
            >No</td>--> 
            </tr>
            <tr>
              <td colspan="2"><?php if($result[0]['billing_if_old_device']=='No') { ?>
                <table  id="old_No1" align="center"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_noold" id="billing_reason1" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table>
                <? } ?>
                <table  id="old_No" align="center"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
                  <tr>
                    <td><label  id="lbDlBilling">Reason</label></td>
                    <td><input type="text" name="billing_reason_noold" id="billing_reason1" value="<?=$result[0]['billing_if_no_reason']?>" /></td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><label for="Imobillizer" id="lblImmobilizer">Immobilizer </label></td>
        <td><Input type ='Radio' Name ='immobilizer' id='immobilizer' value= "Yes"   <?php if($result[0]['immobilizer']=='Yes'){echo "checked=\"checked\""; }?> >
          Yes
          <Input type ='Radio' Name ='immobilizer' value= "No" <?php if($result[0]['immobilizer']=='No'){echo "checked=\"checked\""; }?> >
          No </td>
      </tr>
      <tr>
        <td><label for="AC" id="lblACStatus">AC </label></td>
        <td><Input type ='Radio' Name ='ac_on_off'  id='ac_on_off' value= "on"  <?php if($result[0]['ac']=='on'){echo "checked=\"checked\""; }?>/>
          Yes
          <Input type ='Radio' Name ='ac_on_off' id='ac_on_off'  value= "off"  <?php if($result[0]['ac']=='off'){echo "checked=\"checked\""; }?>/>
          No </td>
      </tr>
      <tr>
        <td><label  id="lbDlDate">Date</label></td>
        <td><input type="text" name="rdd_date" id="datepicker" value="<?php echo $result[0]['date_of_installation']; ?>" /></td>
      </tr>
      <tr>
        <td><label  id="lblReason">Reason</label></td>
        <td><textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" />
          <?php echo $result[0]['reason'];?>
          </textarea></td>
      </tr>
      <!--<table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">-->
      <tr>
        <td>Dimts</td>
        <td><select name="dimts" id="dimts">
            <option value="" >-- select one --</option>
            <option value="Yes" <? if($result[0]['dimts']=='yes') {?> selected="selected" <? } ?> > Yes</option>
            <option value="No" <? if($result[0]['dimts']=='no') {?> selected="selected" <? } ?> > No</option>
          </select></td>
      </tr>
      <!--<tr>
    <td>Installer Name:</td>
    <td>
    <?php
     $query="SELECT inst_name FROM installer where branch_id=".$_SESSION['BranchId'];
    $result1=mysql_query($query);
    ?> 
    
     <select name="inst_name" id="inst_name">
     <option value="0">Select Name</option>
    <? while($row=mysql_fetch_array($result1)) { ?>
    <option value ="<?php echo $row['inst_name']; ?>" <?php if($result1['inst_name']==$row['inst_name']) {?> selected="selected" <?php } ?> > 
                <?php echo $row['inst_name']; ?>        </option>
    <? } ?>
    </select>
    </td>
</tr>-->
      
      <?php 
		//if($action=='edit') {
		?>
      <!--<tr>
            <td class="style2">
                Service Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><? //$result[0]['service_comment']?></textarea>
                </td>
      </tr>-->
      <?php //} ?>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="submit"  />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_new_device_addition.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
