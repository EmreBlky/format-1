<?php
include("include/header.inc.php");
include ("config.php");
ob_start();
if(isset($_REQUEST['action'])==edit)
{
$id=$_GET['id'];
$query=mysql_query("SELECT * FROM services WHERE id='$id'");

$rows=mysql_fetch_array($query);
}
//print_r($rows);
if(isset($_POST['submit']))
	{
	$name=$_POST['name'];
	$veh_reg=$_POST['veh_reg'];
	$Notwoking=$_POST['Notwoking'];
	$location=$_POST['location'];
	$atime=$_POST['atime'];
	$cnumber=$_POST['cnumber'];
	$inst_name=$_POST['inst_name'];
	$inst_name1=$_POST['inst_name1'];
	$payment_status=$_POST['payment_status'];
	$amount=$_POST['amount'];
	$paymode=$_POST['paymode'];
	$inst_cur_location=$_POST['inst_cur_location'];
	$reason=addslashes($_POST['reason']);
	$time=$_POST['time'];
	$pending=$_POST['pending'];
	$newstatus=$_POST['newstatus'];
	if(isset($_POST['Extreason']) && $_POST['Extreason']!="")
		{
		$reason= $_POST['reason'] ."-" .$_POST['Extreason'];
		}
	
	$billing=$_POST['billing'];
	if($billing=="") { $billing="no"; }
	$payment=$_POST['payment'];
	if($payment=="") { $payment="no"; }

	//$query1=("UPDATE services SET name='$name', veh_reg='$veh_reg', Notwoking='$Notwoking', location='$location', atime='$atime',  cnumber='$cnumber',inst_name='$inst_name',inst_cur_location='$inst_cur_location',reason='$reason',time='$time',close_date=inst_date='".date("Y-m-d")."',newpending='0',newstatus='0' WHERE id='$id'");
	
	mysql_query("UPDATE services SET name='$name', veh_reg='$veh_reg', Notwoking='$Notwoking', location='$location', atime='$atime',  cnumber='$cnumber',payment_status='$payment_status',amount='$amount',paymode='$paymode',reason='$reason',time='$time',close_date='".date("Y-m-d")."',inst_date='".date("Y-m-d")."',newpending='0',newstatus='0' ,billing='$billing',payment='$payment' WHERE id='$id'");
	
	 mysql_query("update installer set status=0 where inst_name='$inst_name1'");
	if(stristr($reason, 'Device removed') == true)
	{ 
	 header("location:testphp.php?veh_regtrue=$veh_reg");
	 
	}
	else
	{
		header("location:testphp.php?veh_regfalse=$veh_reg"); 
		//mysql_query("update services set device_removed_service=2 where veh_reg='$veh_reg'");
	
	}
	 
//	header("location:newinstallation.php");

	}

if(isset($_POST['update']))
	{
	$inst_name=$_POST['inst_name'];
	$inst_name1=$_POST['inst_name1'];
	$inst_cur_location=$_POST['inst_cur_location'];
	$billing=$_POST['billing'];
	if($billing=="") { $billing="no"; }
	$payment=$_POST['payment'];
	if($payment=="") { $payment="no"; }
	
	$pending=mysql_query("UPDATE services SET inst_name='$inst_name',inst_cur_location='$inst_cur_location' ,billing='$billing',payment='$payment' WHERE id='$id'");
	mysql_query("update installer set status=1 where inst_name='$inst_name'");
	mysql_query("update installer set status=0 where inst_name='$inst_name1'");
	
	header("location:newinstallation.php");
	}
if(isset($_POST['backservice']))
	{
	$pending=$_POST['newpending'];
	$back_reason=$_POST['reason_to_back'];
	$inst_name1=$_POST['inst_name1'];
	
	$pending=mysql_query("UPDATE services SET newpending='1',newstatus='0',back_reason='$back_reason' WHERE id='$id'");
	mysql_query("update installer set status=0 where inst_name='$inst_name1'");
	
	header("location:newinstallation.php");
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript">
function req_info(form3)
{
	var inst_name=ltrim(document.form3.inst_name.value);	
   if(inst_name=="")
  {
   alert("Please Enter Intallation Name");
   document.form3.inst_name.focus();
   return false;
   }
   var inst_cur_location=ltrim(document.form3.inst_cur_location.value);	
   if(inst_cur_location=="")
  {
   alert("Please Enter Installer Current Location");
   document.form3.inst_cur_location.focus();
   return false;
   }
   if(document.form3.reason.value =="")
  {
   alert("please enter reason");
   document.form3.reason.focus();
   return false;
   }
if(document.form3.time.value =="")
  {
   alert("please enter time");
   document.form3.time.focus();
   return false;
   }
   
}
function req_info1(form3){	
	var reason=ltrim(document.form3.reason_to_back.value);	
   if(reason=="")
  {
   alert("Please Enter Reason To Back Services");
   document.form3.reason_to_back.focus();
   return false;
   }

}

function req_info2(form3){	
	var inst_name=ltrim(document.form3.inst_name.value);	
   if(inst_name=="0")
  {
   alert("Please Enter Intallation Name");
   document.form3.inst_name.focus();
   return false;
   }
   var inst_cur_location=ltrim(document.form3.inst_cur_location.value);	
   if(inst_cur_location=="")
  {
   alert("Please Enter Installer Current Location");
   document.form3.inst_cur_location.focus();
   return false;
   }

}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
	}

</script>


<form method="post" action="" name="form3">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><td><input name="id" type="hidden" id="id" value="<?php echo $rows['id'];?>"></td></td></tr>
 <tr>
<td  align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="name" id="name" readonly value="<?php echo $rows['name'];?>" /></td>
</tr>
<tr style="">
<td align="right">Vehicle No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="veh_reg" id="veh_reg" readonly value="<?php echo $rows['veh_reg'];?>" /></td>
</tr>
<td height="32" align="right">Notwoking:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="Notwoking" id="Notwoking" value="<?php echo $rows['Notwoking'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="location" readonly id="location" value="<?php echo $rows['location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Available Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="atime" readonly id="atime" value="<?php echo $rows['atime'];?>" /></td>
</tr>
<tr>
<tr>
<td height="32" align="right">Person Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="pname" readonly id="pname" value="<?php echo $rows['pname'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Contact No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="cnumber" readonly id="cnumber" value="<?php echo $rows['cnumber'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Device Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="device_model" readonly id="device_model" value="<?php echo $rows['device_model'];?>" /></td>
</tr>

<tr>
<td height="32" align="right">Installation Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="inst_name1" readonly id="inst_name1" value="<?php echo $rows['inst_name'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Change Installation Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<?php
include("config.php");
$query="SELECT inst_id,inst_name FROM installer where status=0";
$result=mysql_query($query);
$name1=$rows['inst_name']; ?> 
<td><select name="inst_name" id="inst_name" ><option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['inst_name']?>><?=$row['inst_name']?></option>
<? } ?>
</select>
</tr>

<tr>
<td width="47%" height="27" align="right">Payment Status*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="53%"><select name="payment_status">
	<option value="">Select Payment Status</option>
	<option value="Not Required">Not Required</option>
	<option value="Collected">Collected</option>
	<option value="Not collected">Not collected</option>
        </select></td>
</tr>
<tr>
<td height="32" align="right">Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="amount" id="amount" value="<?php echo $rows['amount'];?>" /></td>
</tr>
<tr>
<td width="47%" height="27" align="right">Mode*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="53%"><select name="paymode">
	<option value="">Select Payment mode</option>
	<option value="Cash">Cash</option>
	<option value="cheque">cheque</option>
	<option value="DD">DD</option>
        </select></td>
</tr>



<tr><td>&nbsp;</td>
<td>
<input type="checkbox" name="billing" id="billing" value="yes" />Billing <input type="checkbox" name="payment" id="payment" value="yes" />Payment
</td></tr>
<tr>
<td height="32" align="right">Installer Current Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="inst_cur_location" id="inst_cur_location" value="<?php echo $rows['inst_cur_location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Reason:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>

<?php
 $query="SELECT * FROM reason where reason_for='service' order by reason";
$result_reason=mysql_query($query);

?> 

<SCRIPT LANGUAGE="JavaScript">
 <!--
	function ShowTextBox(reason)
	{
		if(reason=="Device re-installed")
		{
		document.getElementById("Extreason").style.display = 'block';
		}
		else
		{
		document.getElementById("Extreason").style.display = 'none';
		}

	}
 //-->
 </SCRIPT> 
<select name="reason" id="reason"   style="width:200px" onChange="ShowTextBox(this.value)">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result_reason)) { 
$highlight="";
if($_POST["reason"]==$row['reason'])
	{
	$highlight="selected";
	}
	?>
<option value="<?=$row['reason']?>" <?=$highlight ?> ><?=$row['reason']?></option>
<? } ?>
</select>

  <input type="text" name="Extreason" id="Extreason" value="<?php echo $rows['reason'];?>" style="display:none" />   </td>
</tr>
<tr>
<td height="32" align="right">Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="time" id="time" value="<?php echo $rows['time'];?>" /></td>
</tr>

<tr>
<td height="32" align="right">Reason To Back Services:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><textarea name="reason_to_back" id="reason_to_back" rows="5" cols="15"><?php echo $rows['back_reason'];?></textarea> </td>
</tr>
<tr>
<td height="32" align="right">
<input type="submit" name="update" id="update" value="Update" onClick="return req_info2(form3)"/>
<input type="submit" name="submit" value="submit" align="right" onClick="return req_info(form3)"/>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'newinstallation.php' " />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="backservice" value="back to service" align="right" onClick="return req_info1(form3)" /></td>
</tr>
</table>
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>


<script type="text/javascript">
    var maxDays = 31;
    
    function ctl07_cjr_reportRangesetDateRange(rangeName){
        var today = new Date();                    
                                      
        var start_field = document.getElementById("time"); 
        var start_s = start_field.value;   // Used to build the final start string.
        
        switch(rangeName){
            case 'today':
                today.setHours(0,0);
                start_s = today.getFullYear();
                start_s += '-';
                start_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                start_s += '-';
                start_s += ((today.getDate()) < 10) ? '0' + today.getDate() : today.getDate();
                
                break;
            case 'yesterday':
                var yesterday_t = today_t - Date.DAY;       // Yesterday at 00:00 in miliseconds.
                var yesterday = new Date(yesterday_t);      // Yesterday as a Date object.
                yesterday.setHours(0,0);
                start_s = yesterday.getFullYear();
                start_s += '-';
                start_s += ((yesterday.getMonth() + 1) < 10) ? '0' + (yesterday.getMonth() + 1) : (yesterday.getMonth() + 1);
                start_s += '-';
                start_s += ((yesterday.getDate() + 1) < 10) ? '0' + yesterday.getDate() : '0' +yesterday.getDate();
				 
                break;
            case 'last week':
                var tmpDate = new Date();
                var last_week_t = new Date();       // Last Week at 00:00 in miliseconds.
                last_week_t.setDate(tmpDate.getDate()-6);      // Last Week as a Date object.
                
                
                // build the from string.
                start_s = last_week_t.getFullYear();
                start_s += '-';
                start_s += ((last_week_t.getMonth() + 1) < 10) ? '0' + (last_week_t.getMonth() + 1) : (last_week_t.getMonth() + 1);
                start_s += '-';
                start_s += ((last_week_t.getDate() + 1) < 10) ? '0' + last_week_t.getDate() : last_week_t.getDate();
                start_s += ' 00:00';
             
                break;
            case 'this month':
                // build the from string.
                start_s = today.getFullYear();
                start_s += '-';
                start_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                start_s += '-';
                start_s += '01';
              
                break;
            case 'last month':
                var year = (today.getMonth() == 0) ? today.getFullYear() - 1 : today.getFullYear();
                var month = ((today.getMonth() == 0) ? '12' : ((today.getMonth() < 10) ? '0' + today.getMonth() : today.getMonth()));
                var day = '01';
                            
                // build the from string.
                start_s = year;
                start_s += '-';
                start_s += month;
                start_s += '-';
                start_s += day;
                               
                break;
        }
        start_field.value = start_s;
    }
    Calendar.setup({
        inputField     :    "time",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
  
    
    function getLastDayOfMonth(month)
    {
        var result = 30;
        
        switch(month){
            case 0:
                //january
                result = '31';
                break;
            case 1:
                //February
                result = '28';
                break;
            case 2:
                //March
                result = '31';
                break;
            case 3:
                //April
                result = '30';
                break;
            case 4:
                //May
                result = '31';
                break;
            case 5:
                //june
                result = '30';
                break;
            case 6:
                //July
                result = '31';
                break;
            case 7:
                //August
                result = '31';
                break;
            case 8:
                //September
                result = '30';
                break;
            case 9:
                //October
                result = '31';
                break;
            case 10:
                //November
                result = '30';
                break;
            case 11:
                //December
                result = '31';
                break;
            }
        return result;
    }
    ctl07_cjr_reportRangesetDateRange();
</script>