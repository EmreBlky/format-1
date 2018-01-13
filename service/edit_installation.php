<?php
include("include/header.inc.php");
include ("config.php");
ob_start();
if(isset($_REQUEST['action'])==edit)
{
$id=$_GET['id'];
$setqry="";
if(isset($_GET['newstatus']))
	{
	$newstst=$_GET['newstatus'];
	$setqry=" , newstatus='1'";
	}



$query=mysql_query("SELECT * FROM installation WHERE id='$id'");

$rows=mysql_fetch_array($query);
}
//print_r($rows);
if(isset($_POST['submit']))
{

$inst_name=$_POST['inst_name'];
$inst_cur_location=$_POST['inst_cur_location'];
/*$newpending=$_POST['newpending'];
$status=$_POST['status'];*/
$billing=$_POST['billing'];
	if($billing=="") { $billing="no"; }
	$payment=$_POST['payment'];
	if($payment=="") { $payment="no"; }


/*echo $query1=("UPDATE installation SET  inst_name='$inst_name',inst_cur_location='$inst_cur_location',inst_date='".date("Y-m-d")."',newpending='0',status='0' ".$setqry." WHERE id='$id'");*/

 $query1=("UPDATE installation SET  inst_name='$inst_name',inst_cur_location='$inst_cur_location',newpending='0',status='0' ,billing='$billing',payment='$payment'  ".$setqry." WHERE id='$id'");

mysql_query("update installer set status=1 where inst_name='$inst_name'");
$execut=mysql_query($query1);

header("location:installation_from_sales.php");

}
if(isset($_POST['backservice']))
{

/*$pending=$_POST['pending'];
$newpending=$_POST['newpending'];*/
//echo $pending;die();
$back_reason=$_POST['reason_to_back'];
$pending=mysql_query("UPDATE installation SET pending='1',status='0',newpending='0' ,back_reason='$back_reason' WHERE id='$id'");
mysql_query("update installer set status=1 where inst_name='$inst_name'");


header("location:installation_from_sales.php");
}



?>
<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
var xmlhttp=false;
try{
xmlhttp=new XMLHttpRequest();
}
catch(e) {
try{
xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
}
catch(e){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e1){
xmlhttp=false;
}
}
}
 
return xmlhttp;
}
 
function getYear(user_id) {
 
var strURL="ajax.php?user_id="+user_id;
var req = getXMLHTTP();
 
if (req) {
 
req.onreadystatechange = function() {

if (req.readyState == 4) {
// only if "OK"
if (req.status == 200) {
document.getElementById('statediv').innerHTML=req.responseText;
} else {
alert("There was a problem while using XMLHTTP:\n" + req.statusText);
}
}
}
req.open("GET", strURL, true);
req.send(null);
}
}

</script>
<script type="text/javascript">
function req_info(form2)
{

  var inst_name=document.getElementById(inst_name)
  if(document.form2.inst_name.value==0)
  {
  alert("please choose one name") ;
  document.form2.inst_name.focus();
  return false;
  }
  
  if(document.form2.inst_cur_location.value =="")
  {
   alert("please enter installer current location");
   document.form2.inst_cur_location.focus();
   return false;
   }
}
function req_info1(form2){	
	var reason=ltrim(document.form2.reason_to_back.value);	
   if(reason=="")
  {
   alert("Please Enter Reason To Back Services");
   document.form2.reason_to_back.focus();
   return false;
   }

}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
	}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>


<form method="post" action="" name="form2">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><td><input name="id" type="hidden" id="id" value="<?php echo $rows['id'];?>"></td></td></tr>

 <tr>
<td height="29" align="right">Sales Person:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="sales" id="sales" readonly="readonly" value="<?php $sales=mysql_fetch_array(mysql_query("select name from sales_person where id='$rows[sales_person]' ")); echo $sales['name'];?>" /></td>
</tr>
 <tr>
<td height="29" align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="client" id="client" readonly="readonly" value="<?php echo $rows['client'];?>" /></td>
</tr>
<tr>
<td align="right">No. Of Vehicle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="no_of_vehicals" id="no_of_vehicals" readonly="readonly" value="<?php echo $rows['no_of_vehicals'];?>" /></td>
</tr>

<tr>
<td height="32" align="right">Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="location" id="location" readonly="readonly" value="<?php echo $rows['location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="model" readonly="readonly" id="model" value="<?php echo $rows['model'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Installed Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="installed_date" id="installed_date" readonly="readonly" value="<?php echo $rows['installed_date'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">DIMTS :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="dimts" id="dimts" readonly="readonly" value="<?php echo $rows['dimts'];?>" /></td>
</tr>

<tr>
<td height="32" align="right">Demo :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="demo" id="demo" readonly="readonly" value="<?php echo $rows['demo'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Amount :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="payment_req" id="payment_req" readonly="readonly" value="<?php echo $rows['payment_req'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Vehicle Type :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="veh_type" id="veh_type" readonly="readonly" value="<?php echo $rows['veh_type'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Immobilizer :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="immobilizer_type" id="immobilizer_type" readonly="readonly" value="<?php echo $rows['immobilizer_type'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Contact No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="contact_number" readonly="readonly" id="contact_number" value="<?php echo $rows['contact_number'];?>" /></td>
</tr>
<tr>

<td height="32" align="right">Installer Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<?php
include("config.php");
$query="SELECT inst_id,inst_name FROM installer where status=0";
$result=mysql_query($query);

?> 
<? $name1=$rows['inst_name']; ?> 
<td><select name="inst_name" ><option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['inst_name']?><? if($name1==$row['inst_name']) { ?> selected="selected" <? }?>><?=$row['inst_name']?></option>
<? } ?>
</select>
</td>
</tr>
<tr><td>&nbsp;</td>
<td>
<input type="checkbox" name="billing" id="billing" value="yes" />Billing <input type="checkbox" name="payment" id="payment" value="yes" />Payment
</td></tr>


<tr>
<td height="32" align="right">Installer Current Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="inst_cur_location" id="inst_cur_location" value="<?php echo $rows['inst_cur_location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Reason To Back Services:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><textarea name="reason_to_back" id="reason_to_back" rows="5" cols="15"><?php echo $rows['back_reason'];?></textarea> </td>
</tr>

<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" onClick="return req_info(form2)"/>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation_from_sales.php' " />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="backservice" value="back to service" align="right" onClick="return req_info1(form2)" /></td>
 
</tr>

</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>