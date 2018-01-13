<?php
include("include/header.inc.php");
include ("config.php");

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
	$result=mysql_fetch_array(mysql_query("select * from installation where id=$id and branch_id=".$_SESSION['branch_id']));	
	}


if(isset($_POST['submit']))
{
$sales_person=$_POST['sales_person'];
$client=$_POST['client'];
$no_of_vehicals=$_POST['no_of_vehicals'];
$location=$_POST['location'];
$dimts=$_POST['dimts'];
if($dimts=="") { $dimts="no"; }
$demo=$_POST['demo'];
if($demo=="") { $demo="no"; }
$payment_req=$_POST['payment_req'];
$model=$_POST['model'];
$veh_type=$_POST['veh_type'];
$immobilizer_type=$_POST['immobilizer_type'];
$time=$_POST['time'];
$cnumber=$_POST['cnumber'];
$contact_person=$_POST['contact_person'];
$contact_person_no=$_POST['contact_person_no'];

$required=$_POST['required'];
	if($required=="") { $required="normal"; }
	
	$datapullingtime=$_POST['datapullingtime'];
	$IP_Box=$_POST['IP_Box'];




if($action=='edit')
	{
	$sql="update installation set sales_person='".$sales_person."',client='".$client."',payment_req='".$payment_req."',dimts='".$dimts."',demo='".$demo."',no_of_vehicals='".$no_of_vehicals."',location='".$location."',model='".$model."',time='".$time."',contact_number='".$cnumber."' ,contact_person='".$contact_person."' ,contact_person_no='".$contact_person_no."' ,required='".$required."',datapullingtime='".$datapullingtime."',IP_Box='".$IP_Box."'  where id=$id";
	$execute=mysql_query($sql);
	header("location:installation.php");

	}
	else if($action=='editp')
	{
	$setqry="";
	if(isset($_GET['pending']))
	{
	$newstst=$_GET['pending'];
	$setqry=", status='1'";
	}
	$sql="update installation set sales_person='".$sales_person."',client='".$client."',payment_req='".$payment_req."',dimts='".$dimts."',demo='".$demo."',no_of_vehicals='".$no_of_vehicals."',location='".$location."',model='".$model."',time='".$time."',contact_number='".$cnumber."',pending=0 ".$setqry." ,contact_person='".$contact_person."' ,contact_person_no='".$contact_person_no."',required='".$required."',datapullingtime='".$datapullingtime."'where id=$id";
	
	$execute=mysql_query($sql);
header("location:pendinginstallation.php");

	}
	else
		{
	$sql="INSERT INTO installation(sales_person,client,no_of_vehicals,location,model,payment_req,dimts,demo,veh_type,immobilizer_type,time,contact_number,installed_date,status,contact_person,contact_person_no,required,datapullingtime,IP_Box,branch_id)VALUES('".$sales_person."','".$client."','".$no_of_vehicals."','".$location."','".$model."','".$payment_req."','".$dimts."','".$demo."','".$veh_type."','".$immobilizer_type."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$contact_person_no."','".$required."','".$datapullingtime."','".$IP_Box."','".$_SESSION['branch_id']."')";
	
	$execute=mysql_query($sql);
header("location:installation.php");
	}


}

?>


<link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
<script src="../js/validation_new.js"></script>
    <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  
   <!-- main calendar program -->
  <script type="text/javascript" src="js/calendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="js/calendar/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="js/calendar/calendar-setup.js"></script>

<script type="text/javascript">

function req_info()
{
 
  if(document.form1.sales_person.value=="")
  {
  alert("please choose one name") ;
  document.form1.sales_person.focus();
  return false;
  }  
  if(document.form1.client.value=="")
  {
  alert("please Enter Client Name") ;
  document.form1.client.focus();
  return false;
  } 
  if(document.form1.no_of_vehicals.value=="")
  {
  alert("please Enter No. Of Vehicals") ;
  document.form1.no_of_vehicals.focus();
  return false;
  } 
  else
  var no_of_vehicals=document.form1.no_of_vehicals.value;
  if(no_of_vehicals!="")
        {
		
        if(no_of_vehicals.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter No. of Vehicals');
        document.form1.no_of_vehicals.focus();
        document.form1.no_of_vehicals.value="";
        return false;
        }
       }

  if(document.form1.location.value=="")
  {
  alert("please Enter Loaction") ;
  document.form1.location.focus();
  return false;
  } 
  if(document.form1.model.value=="")
  {
  alert("please Enter Model") ;
  document.form1.model.focus();
  return false;
  }  
  if(document.form1.time.value=="")
  {
  alert("please Enter Date/Time") ;
  document.form1.time.focus();
  return false;
  }
  if(document.form1.cnumber.value=="")
  {
  alert("please Enter Contact No.") ;
  document.form1.cnumber.focus();
  return false;
  }
  var cnumber=document.form1.cnumber.value;
  if(cnumber!="")
        {
	var lenth=cnumber.length;
	
        if(lenth < 9 || lenth > 15 || cnumber.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.form1.cnumber.focus();
        document.form1.cnumber.value="";
        return false;
        }
        }
	
} 
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}

</script>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="" name="form1" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

 <tr>
<td height="29" align="right" >Sales Person:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>

<select name="sales_person" id="sales_person" style="width:150px">
<option value="">Select Name</option>
<?
$query=mysql_query("select * from sales_person order by name asc");
while($data=mysql_fetch_array($query)) {
 ?>
<option value="<?=$data['id']?>" <? if($result['sales_person']==$data['id']) {?> selected="selected" <? } ?> ><?=$data['name']?></option>
<? } ?>
</select></td>
</tr>
<tr style="">
<td align="right">Client*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="client" id="client" style="width:150px" value="<?=$result['client']?>"></td>
</tr>

<tr>
<td height="32" align="right">No. Of Vehicales:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="no_of_vehicals" value="<?=$result['no_of_vehicals']?>" id="no_of_vehicals" style="width:147px" autocomplete="off"/></td>
</tr>
<tr>
<td height="32" align="right">Location:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="location" value="<?=$result['location']?>" style="width:147px" id="location"/></td>
</tr>
<tr>
<td height="32" align="right">Model:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT device_model FROM device_model";
$result=mysql_query($query);
?> 
<select name="model" id="model" style="width:150px">
<option value="">Select Device Model</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['device_model']?>><?=$row['device_model']?></option>
<? } ?>
</select>	  	</td>
</tr>

<tr>
<td height="32" align="right">Time:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
	 <input type="text" name="time" id="time" value="<?=$result['time']?>" style="width:147px"/>	  	</td>
</tr>
<tr>
<td height="32" align="right">Contact No.:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="cnumber" value="<?=$result['contact_number']?>" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">Contact Person:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="contact_person" value="<?=$result['contact_person']?>" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">DIMTS:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" name="dimts" id="dimts" value="yes" /></td>
</tr>
<tr>
<td height="32" align="right">Demo:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" name="demo" id="demo" value="yes" /></td>
</tr>
<tr>
<td height="32" align="right">Vehicle Type:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="53%"><select name="veh_type">
	<option value="">Select Type</option>
	<option value="Car">Car</option>
	<option value="Bus">Bus</option>
	<option value="Truck">Truck</option>
	<option value="Bike">Bike</option>
	<option value="Trailer">Trailer</option>
	<option value="Tempo">Tempo</option>
	<option value="Train">Train</option>
        </select></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="579" height="32" align="right"><div align="right">Immobilizer:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
  <td width="721">
  <input type="radio" name="group1" value='immobilizer_type_yes'  onClick="setVisibility('sub4', 'block');";>Yes
	<input type="radio" name="group1" value='immobilizer_type_no' checked="checked" onClick="setVisibility('sub4', 'none');";>No
</td>
</tr></table>
<div id="sub4" style="display:none">
<table width="100%" border="0" cellpadding="0" cellspacing="" align="center">
<tr><td align="right"><?php
echo $msg;
?></td></tr>
<tr>
<td width="47%" height="27" align="right">Immobilizer Type*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="53%"><select name="immobilizer_type">
	<option value="">Select Type</option>
	<option value="12V">12V</option>
	<option value="24V">24V</option>
        </select></td>
</tr>

</table></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="579" height="32" align="right"><div align="right">Payment:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
  <td width="721">
  <input type="radio" name="group2" value='payment_req_yes'  onClick="setVisibility('sub3', 'block');";>Yes
	<input type="radio" name="group2" value='payment_req_no' checked="checked" onClick="setVisibility('sub3', 'none');";>No
</td>
</tr></table>
<div id="sub3" style="display:none">
<table width="100%" border="0" cellpadding="0" cellspacing="" align="center">
<tr><td align="right"><?php
echo $msg;
?></td></tr>
<tr>
<td width="47%" height="27" align="right">Amount*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="53%"><input type="text" name="payment_req" maxlength="500" value="<?php echo $rows['payment_req'];?>" /></td>
</tr>

</table></div>


<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

<tr>
<td width="46%" height="32" align="right">Required.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="54%"><input type="checkbox" name="required" id="required" value="urgent" <?php if($result['required']=='urgent') {?> checked="checked" <? }?> /> Urgent </td>
</tr>
<tr>
<td height="32" align="right">IP Box.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="checkbox" name="IP_Box" id="IP_Box" value="required" <?php if($result['IP_Box']=='required') {?> checked="checked" <? }?> /> Required </td>
</tr>
<tr>
<td height="32" align="right">Data Pulling Time.:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="datapullingtime" id="datapullingtime" value="<?=$result['datapullingtime']?>" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">Contact Person No.:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="contact_person_no" value="<?=$result['contact_person_no']?>" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
</tr>
</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>

<script type="text/javascript">  
    
    Calendar.setup({
        inputField     :    "time",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    
   
</script>