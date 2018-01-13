<?php
include("include/header.inc.php");
include ("config.php");
ob_start();

$username=$_SESSION['username'];
$userId=$_SESSION['userId'];

if(isset($_POST['submit']))
{
$name=$_POST['name'];
$veh_reg=$_POST['veh_reg'];
$model=$_POST['model'];
$deviceid=$_POST['deviceid'];
$Imei=$_POST['Imei'];
$date=$_POST['date'];
$problem=$_POST['problem'];
$antina=$_POST['antina'];
$sql=mysql_query("SELECT name FROM users WHERE user_id='$name'");
$row=mysql_fetch_array($sql);

if($username=='gurmeet')
	{
$sql="INSERT INTO device(name,veh_reg,model,deviceid,Imei,date,problem,antina,servicelogin_id)VALUES('".$row['name']."','".$veh_reg."','".$model."','".$deviceid."','".$Imei."','".$date."','".$problem."','".$antina."',".$userId.")";
	}else
	{
	$sql="INSERT INTO repai_device(name,veh_reg,model,deviceid,Imei,date,problem,antina)VALUES('".$row['name']."','".$veh_reg."','".$model."','".$deviceid."','".$Imei."','".$date."','".$problem."','".$antina."')";
	}
	

$execute=mysql_query($sql);
header("location:repair_device.php");
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
function req_info()
{

  var name=document.getElementById(name)
  if(document.form2.name.value==0)
  {
  alert("please choose one name") ;
  document.form2.name.focus();
  return false;
  }
  var veh_reg=document.getElementById(veh_reg)
  if(document.form2.veh_reg.value==0)
  {
  alert("please choose vehicle number") ;
  document.form2.veh_reg.focus();
  return false;
  }
  if(document.form2.model.value==0)
  {
  alert("please enter model") ;
  document.form2.model.focus();
  return false;
  }
  
  if(document.form2.deviceid.value==0)
  {
  alert("please enter deviceid") ;
  document.form2.deviceid.focus();
  return false;
  }
  if(document.form2.Imei.value==0)
  {
  alert("please enter Imei number") ;
  document.form2.Imei.focus();
  return false;
  }
  if(document.form2.date.value==0)
  {
  alert("please enter date") ;
  document.form2.date.focus();
  return false;
  }
  if(document.form2.problem.value==0)
  {
  alert("please enter date") ;
  document.form2.problem.focus();
  return false;
  }
  if(document.form2.antina.value==0)
  {
  alert("please Select Antina") ;
  document.form2.antina.focus();
  return false;
  }
}
</script>



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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" action="" name="form2" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">

 <tr>
<td height="28" align="right">Client Name*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name" onChange="getYear(this.value)" style="width:150px">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr style="">
<td align="right">Vehicle No*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><div id="statediv"><select name="veh_reg" style="width:150px">
<option value="0">Select Name First</option>
</select></div></td>
</tr>

<tr>
<td height="32" align="right">Model*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="model" value="" style="width:146px"/></td>
</tr>
<tr>
<td height="32" align="right">Device Id*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="deviceid" value="" style="width:146px"/></td>
</tr>
<tr>
<td height="32" align="right">Imei*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="Imei" value="" style="width:146px"/></td>
</tr>
<tr>
<td height="32" align="right">Date*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="date" id="date" value="" style="width:146px" autocomplete="off"/></td>
</tr>
<tr>
<td height="32" align="right">Problem*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="problem" value="" style="width:146px"/></td>
</tr>
<tr>
<td height="32" align="right">Antina*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><select name="antina" id="antina" style="width:150px" autocomplete="off">
<option value="">Select One</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
<option value="Cut Off">Cut Off</option>
</select></td>
</tr>
<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'repair_device.php' " /></td>
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
                                      
        var start_field = document.getElementById("date");
		
        var start_s = "";   // Used to build the final start string.
        
        
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
        end_field.value = end_s;
    }
    Calendar.setup({
        inputField     :    "date",   // id of the input field
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