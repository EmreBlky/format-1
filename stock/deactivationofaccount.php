<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_stock.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_stock.php");*/

 $action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from deactivation_of_account where id=$id");	
	}
?>

<div class="top-bar">
  <h1>Deactivation Of Account</h1>
</div>
<div class="table">
<?
 
$temprary= 'checked';
$permanent = 'unchecked';
$tot_no_of_vehicles=0;
 if(isset($_POST["submit"]))
{
$date=$_POST["date"];
$acc_manager=$_POST["account_manager"];
$company=$_POST["company"];
$main_user_id=$_POST["main_user_id"];
$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
$device_remove_status=$_POST["deviceremove"];
$alert_date=$_POST["alert_date"];
$selected_radio=$_POST['deactivateStatus'];
$DeleteFromDebtors=$_POST['DeleteFromDebtors'];
//$stock_comment = $_POST["stock_comment"];
$payment_status=$_POST["payment_status"];
$sales_manager=$_POST["sales_manager"];
$reason=$_POST["reason"];

$no_devices_removed=$_POST["no_devices_removed"];

if($result[0]['deactivate_temp']=='Permanent')
{ 
for($N=1;$N<=$no_devices_removed;$N++)
	{
	//$deviceIMEI=$_REQUEST["DeviceIMEI$N"];
    //$clientlist=$_POST["userRecord$N"];
	$deviceIMEI=(isset($_POST["DeviceIMEI$N"])) ? trim($_POST["DeviceIMEI$N"])  : "";
	$other_deviceIMEI=$_REQUEST["otherDeviceIMEI$N"];
	$clientlist=(isset($_POST["userRecord$N"])) ? trim($_POST["userRecord$N"])  : "";
	$devicelocation=(isset($_POST["devicelocation$N"])) ? trim($_POST["devicelocation$N"])  : "";
  
 if(($deviceIMEI!="" or $other_deviceIMEI!="" ) && $clientlist!="")
		{
	 
	 $query="INSERT INTO `stock_deactivation_of_account` (`deactivate_acc_id`,`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,deactivate_temp,`reason`,delete_form_debtors,`no_device_removed`,`imei_of_removed_devices`,`other_imei_removed`,`client`,`device_location`) 
	 VALUES ('".$id."','".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$selected_radio."','".$reason."','".$DeleteFromDebtors."','".$no_devices_removed." device removed"."','".$deviceIMEI."','".$other_deviceIMEI."','".$clientlist."','".$devicelocation."')";
	
 	mysql_query($query) ;
    }
  }
    $query1="update deactivation_of_account set no_device_removed='".$no_devices_removed." device removed"."' where id=$id";
	mysql_query($query1) ;
	echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
 }
 
 else if($result[0]['deactivate_temp']=='temporary') 
{ 
for($N=1;$N<=$no_devices_removed;$N++)
	{
	$deviceIMEI=(isset($_POST["DeviceIMEI$N"])) ? trim($_POST["DeviceIMEI$N"])  : "";
	$other_deviceIMEI=$_REQUEST["otherDeviceIMEI$N"];
	$clientlist=(isset($_POST["userRecord$N"])) ? trim($_POST["userRecord$N"])  : "";
	$devicelocation=(isset($_POST["devicelocation$N"])) ? trim($_POST["devicelocation$N"])  : "";
  
 if(($deviceIMEI!="" or $other_deviceIMEI!="" ) && $clientlist!="")
		{
	 
	 $query="INSERT INTO `stock_deactivation_of_account` (`deactivate_acc_id`,`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,deactivate_temp,`reason`,alert_date,`no_device_removed`,`imei_of_removed_devices`,`other_imei_removed`,`client`,`device_location`) 
	 VALUES ('".$id."','".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$selected_radio."','".$reason."','".$alert_date."','".$no_devices_removed." device removed"."','".$deviceIMEI."','".$other_deviceIMEI."','".$clientlist."','".$devicelocation."')";
	 
 	mysql_query($query);
	}
  }
    $query1="update deactivation_of_account set no_device_removed='".$no_devices_removed." device removed"."' where id=$id";
	mysql_query($query1);
	echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
 }
 

/*if($action=='edit')
	{
	if($result[0]['deactivate_temp']=='Permanent')
{ 
$query="update deactivation_of_account set date='".$date."',acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',device_remove_status='".$device_remove_status."',no_of_removed_devices='".$no_of_removed_devices."',deactivate_temp='".$selected_radio."',reason='".$reason."',delete_form_debtors='".$DeleteFromDebtors."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."' where id=$id";
 }
 else if($result[0]['deactivate_temp']=='temporary') {
 $query="update deactivation_of_account set date='".$date."',acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',device_remove_status='".$device_remove_status."',no_of_removed_devices='".$no_of_removed_devices."',deactivate_temp='".$selected_radio."',reason='".$reason."',alert_date='".$alert_date."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."' where id=$id";
 }
 
 $query;
 mysql_query($query);
echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
	}
  else
  {

if($selected_radio=='Permanent')
{ 
   $query="INSERT INTO `deactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,no_of_removed_devices,deactivate_temp,`reason`,delete_form_debtors) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$no_of_removed_devices."','".$selected_radio."','".$reason."','".$DeleteFromDebtors."')";
}
else {
$query="INSERT INTO `deactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,no_of_removed_devices,deactivate_temp,`reason`,alert_date) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$no_of_removed_devices."','".$selected_radio."','".$reason."','".$alert_date."')";

}
mysql_query($query) or die(mysql_error());
 echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
//header('location: sales_request.php');
}*/
}
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script type="text/javascript">
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

$( "#datepickercheque" ).datepicker({ dateFormat: "yy-mm-dd" });

});
    function validateForm()
			{

				//date,account_manager,main_user_id,company,tot_no_of_vehicles,tot_no_of_vehicles,contact_number,name,req_sub_user_pass,billing_separate,billing_name,reason
 

			 
			  var main_user_id=document.forms["myForm"]["main_user_id"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Select Username");
			  return false;
			  }

			var no_of_device=document.forms["myForm"]["no_devices_removed"].value;
			if (no_of_device==null || no_of_device=="")
			  {
			  alert("Select No of Removed Device");
			  return false;
			  }

			     var main_user_id=document.forms["myForm"]["reason"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Enter Reason");
			  return false;
			  }  
			}
			
function Status(radioValue)
{
 if(radioValue=="Permanent")
	{
	document.getElementById('temporarysat').style.display = "none";
	document.getElementById('Permanentsat').style.display = "block";
	document.getElementById('temporarysat1').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";

	}
	else if(radioValue=="temporary")
	{

	document.getElementById('temporarysat').style.display = "block";
	document.getElementById('Permanentsat').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";
	document.getElementById('temporarysat1').style.display = "none";
	}
	else
	{
	document.getElementById('temporarysat1').style.display = "none";
	document.getElementById('Permanentsat').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";
	document.getElementById('temporarysat1').style.display = "none";
	} 
	
}

function Statuschange(radioValue1)
{
 //alert(radioValue);
 if(radioValue1=="Y")
	{
	//document.getElementById('devicerecord1').style.display = "none";
	document.getElementById('devicerecord').style.display = "block";

	}
	else
	{
	document.getElementById('devicerecord').style.display = "none";
	document.getElementById('devicerecord1').style.display = "none";
	} 
	
}

function DetailFromAccount(value,UserId)
{
	//alert(value);
	var rootdomain="http://"+window.location.hostname
var loadstatustext="<img src='"+rootdomain+"/images/icons/other/waiting.gif' />"
document.getElementById("DetailFromAccount").innerHTML=loadstatustext; 
$.ajax({
		type:"GET",
		url:"userInfo.php?action=DetailFromAccount",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		// data:"RowId="+value,
		 data:"RowId="+value+"&UserId="+UserId,
		success:function(msg){
			 
		document.getElementById("DetailFromAccount").innerHTML = msg;
						
		}
	});
} 

function showUser(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=getdataAccount",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		document.getElementById(setDivId).value = msg;		
		//document.getElementById(setDivId).innerHTML = msg;
		//alert(msg);				
		}
	});
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
  <?php 
		if($_SESSION['user_name']=='saleslogin') {
		?>
  <tr>
    <td>Sales Manager</td>
    <td><select name="sales_manager" id="sales_manager">
        <option value="" >-- select one --</option>
        <?php
        $sales_manager = select_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
        //while ($data=mysql_fetch_assoc($sales_manager))
		for($sl=0;$sl<count($sales_manager);$sl++)
        {
        ?>
        <option name="sales_manager" value="<?=$sales_manager[$sl]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$sl]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$sl]['name']; ?> </option>
        <?php 
        } 
        ?>
      </select></td>
  </tr>
  <?php } ?>
  <tr>
    <td> User Name</td>
    <td><select name="main_user_id" id="TxtMainUserId" readonly >
        <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
        <?php
			$main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($m=0;$m<count($main_user_id);$m++)
					{
			?>
        <option name="main_user_id" value="<?=$main_user_id[$m]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$m]['user_id']) {?> selected="selected" <? } ?>  > <?php echo $main_user_id[$m]['name']; ?> </option>
        <?php 
								} 
 
  ?>
      </select></td>
  </tr>
  <tr>
    <td> Company Name</td>
    <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>"  readonly /></td>
  </tr>
  <tr>
    <td> Total No Of Vehicle</td>
    <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_vehicles']?>"  readonly /></td>
  </tr>
  <tr>
    <td>Device Removed</td>
    <td><Input type = 'Radio' Name ='deviceremove'    value= 'Y' <?php if($result[0]['device_remove_status']=="Y"){echo "checked=\"checked\""; }?>  readonly="readonly" >
      Yes
      <Input type = 'Radio' Name ='deviceremove'    value= 'N' <?php if($result[0]['device_remove_status']=="N"){echo "checked=\"checked\""; }?>  readonly="readonly" >
      No</td>
  </tr>
  <tr>
    <td colspan="2"><table  id="devicerecord1" style=";width: 300px; border:1" cellspacing="5" cellpadding="5">
        <tr>
          <td width="300px"> No of Removed Device</td>
          <td><select name="no_devices_removed" id="no_devices_removed" onchange="DetailFromAccount(this.value,<?echo $result[0]['user_id']?>)">
              <option value="">-- Select One --</option>
              <option value ="0">0</option>
              <option value ="1">1</option>
              <option value ="2">2</option>
              <option value ="3">3</option>
              <option value ="4">4</option>
              <option value ="5">5</option>
              <option value ="6">6</option>
              <option value ="7">7</option>
              <option value ="8">8</option>
              <option value ="9">9</option>
              <option value ="10">10</option>
              <option value ="11">11</option>
              <option value ="12">12</option>
              <option value ="13">13</option>
              <option value ="14">14</option>
              <option value ="15">15</option>
              <option value ="16">16</option>
              <option value ="17">17</option>
              <option value ="18">18</option>
              <option value ="19">19</option>
              <option value="20">20</option>
              <option value ="21">21</option>
              <option value ="22">22</option>
              <option value ="23">23</option>
              <option value ="24">24</option>
              <option value ="25">25</option>
              <option value ="26">26</option>
              <option value ="27">27</option>
              <option value ="28">28</option>
              <option value ="29">29</option>
              <option value ="30">30</option>
              <option value ="31">31</option>
              <option value ="32">32</option>
              <option value ="33">33</option>
              <option value ="34">34</option>
              <option value ="35">35</option>
              <option value ="36">36</option>
              <option value ="37">37</option>
              <option value ="38">38</option>
              <option value ="39">39</option>
              <option value="40">40</option>
              <option value ="41">41</option>
              <option value ="42">42</option>
              <option value ="43">43</option>
              <option value ="44">44</option>
              <option value ="45">45</option>
              <option value ="46">46</option>
              <option value ="47">47</option>
              <option value ="48">48</option>
              <option value ="49">49</option>
              <option value ="50">50</option>
            </select></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><div id="DetailFromAccount"> </div></td>
  </tr>
</table>
<table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
<tr>
  <td class="style2"><h1>Deactivate</h1></td>
  <td><Input type = 'Radio' Name ='deactivateStatus'    value= 'temporary' <?php if($result[0]['deactivate_temp']=="temporary"){echo "checked=\"checked\""; }?>
  readonly="readonly"
>
    Temporary
    <Input type = 'Radio' Name ='deactivateStatus'    value= 'Permanent' <?php if($result[0]['deactivate_temp']=="Permanent"){echo "checked=\"checked\""; }?>
  readonly="readonly"
>
    Permanent</td>
</tr>
<?php if($result[0]['deactivate_temp']=="temporary") { ?>
<table  id="temporarysat1" align="center"  style="width: 250px; border:1" cellspacing="5" cellpadding="5">
  <tr>
    <td><label  id="lbDlDate">Alert Date</label></td>
    <td><input type="text" name="alert_date" id="datepicker1" value="<?=$result[0]['alert_date']?>" readonly="readonly" /></td>
  </tr>
</table>
<? } ?>
<table  id="temporarysat"  align="center"  style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
  <tr>
    <td><label  id="lbDlDate">Alert Date</label></td>
    <td><input type="text" name="alert_date" id="datepicker1" value="<?=$result[0]['alert_date']?>" readonly="readonly" /></td>
  </tr>
</table>
<?php if($result[0]['deactivate_temp']=="Permanent") { ?>
<table  id="Permanentsat1" align="center"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
  <tr>
    <td align="center"><Input type = 'Radio' Name ='DeleteFromDebtors'    value= 'Yes' <?php if($result[0]['delete_form_debtors']=="Yes"){echo "checked=\"checked\""; }?> readonly="readonly" />
      Delete From Debtors </td>
  </tr>
</table>
<? } ?>
<table  id="Permanentsat" align="center"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
  <tr>
    <td><Input type = 'Radio' Name ='DeleteFromDebtors'    value= 'Yes' <?php if($result[0]['delete_form_debtors']=="Yes"){echo "checked=\"checked\""; }?> />
      Delete From Debtors </td>
  </tr>
</table>
<table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
  <tr>
    <td width="173" class="style2"> Reason</td>
    <td width="290"><Textarea rows="5" cols="23" type="text" name="reason" id="TxtReason" readonly="readonly"><?=$result[0]['reason']?>
</textarea></td>
  </tr>
  <?php 
		//if($action=='edit') {
		?>
  <!--<tr>
            <td class="style2">
                Stock Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="stock_comment" id="TxtStockComment" ><?=$result[0]['stock_comment']?></textarea>
                </td>
        </tr>-->
  <?php //} ?>
  <tr>
    <td class="submit"><input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();"/>
      <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deactivate_of_account.php' " /></td>
  </tr>
</table>
</div>
<?php
include("../include/footer.php"); ?>
