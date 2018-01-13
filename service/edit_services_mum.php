<?php
include("include/header.inc.php");
include ("config.php");
ob_start();
if(isset($_REQUEST['action'])=="edit")
{
$id=$_GET['id'];
$setqry="";
if(isset($_GET['pending']))
	{
	$newstst=$_GET['pending'];
	$setqry=", status='1'";
	}
$query=mysql_query("SELECT * FROM services_mumbai WHERE id='$id'");

$rows=mysql_fetch_array($query);
}
//print_r($rows);
if(isset($_POST['submit']))
{
$id=$_POST['id'];
$name=$_POST['name'];
$veh_reg=$_POST['veh_reg'];
$Notwoking=$_POST['Notwoking'];
$location=$_POST['location'];
$atime=$_POST['atime'];
$pname=$_POST['pname'];
$cnumber=$_POST['cnumber'];
$pending=$_POST['pending'];

$new_name=$_POST['new_name'];
$new_veh_reg=$_POST['new_veh_reg'];
$new_Notwoking=$_POST['new_Notwoking'];
$new_location=$_POST['new_location'];
$new_atime=$_POST['new_atime'];
$new_pname=$_POST['new_pname'];
$new_cnumber=$_POST['new_cnumber'];
$new_pending=$_POST['new_pending'];
//echo $pending;die(); 
$sql=mysql_query("SELECT name FROM users WHERE user_id='$name'");
$row=mysql_fetch_array($sql);

if($new_name!="" || $new_veh_reg!="" )
	{
	
	$sql1=mysql_query("SELECT name FROM users WHERE user_id='$new_name'");
	$row1=mysql_fetch_array($sql1);
	
	$query1="UPDATE services_mumbai SET name='".$row1['name']."', veh_reg='$new_veh_reg', Notwoking='$new_Notwoking', location='$new_location', atime='$new_atime', pname='$new_pname',  cnumber='$new_cnumber', pending='0',move_vehicles=1 ".$setqry." WHERE id='$id'";
	
	
	 $back_sql="INSERT INTO services_mumbai_backup(service_id,name,veh_reg,Notwoking,location,atime,pname,cnumber,req_date)VALUES(".$id.",'".$row['name']."','".$veh_reg."','".$Notwoking."','".$location."','".$atime."','".$pname."','".$cnumber."','".date("Y-m-d")."')"; 
	
	
	 mysql_query($back_sql);

	}
	else {
$query1=("UPDATE services_mumbai SET name='".$row['name']."', veh_reg='$veh_reg', Notwoking='$Notwoking', location='$location', atime='$atime', pname='$pname',  cnumber='$cnumber', pending='0' ".$setqry." WHERE id='$id'");
		}
mysql_query($query1);

$pg=$_GET['pg'];
//echo $pg;		
header("location:services_mum.php");
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
 
function getYear(user_id,div,select_id) {
 
var strURL="ajax.php?user_id="+user_id+"&select_id="+select_id;
var req = getXMLHTTP();
 
if (req) {
 
req.onreadystatechange = function() {

if (req.readyState == 4) {
// only if "OK"
if (req.status == 200) {
document.getElementById(div).innerHTML=req.responseText;
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
  if(document.form1.name.value==0)
  {
  alert("please choose one name") ;
  document.form1.name.focus();
  return false;
  }
  
  if(document.form1.veh_reg.value==0)
  {
  alert("please choose vehicle number") ;
  document.form1.veh_reg.focus();
  return false;
  }

  if(document.form1.Notwoking.value =="")
  {
   alert("please enter not working time");
   document.form1.Notwoking.focus();
   return false;
   }
   if(document.form1.location.value =="")
  {
   alert("please enter location");
   document.form1.location.focus();
   return false;
   }
   
    if(document.form1.atime.value =="")
  {
   alert("please enter available time");
   document.form1.atime.focus();
   return false;
   }
   
   if(document.form1.pname.value =="")
  {
   alert("please enter person name");
   document.form1.pname.focus();
   return false;
   }
   
   if(document.form1.cnumber.value =="")
  {
   alert("please enter contact number");
   document.form1.cnumber.focus();
   return false;
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


<form method="post" action="" name="form1" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td><td><input name="id" type="hidden" id="id" value="<?php echo $rows['id'];?>"></td></td></tr>
 <tr>
<td height="29" align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

<?
$name=$rows['name'];

?> 

<select name="name" onChange="getYear(this.value,'statediv','veh_reg')">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?><? if($name==$row['name']) { ?> selected="selected" <? }?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr>
<td align="right">Vehicle No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><div id="statediv"><select name="veh_reg" style="width:150px" id="veh_reg">
<option>Select Name First</option>

 <? if($rows['veh_reg']!="") { ?><option value="<?=$rows['veh_reg']?>" selected="selected"><?=$rows['veh_reg']?></option> <? } ?>
</select></div></td>
</tr>
<td height="32" align="right">Notwoking1:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="Notwoking" id="Notwoking" value="<?php echo $rows['Notwoking'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="location" id="location" value="<?php echo $rows['location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Available Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="atime" id="atime" value="<?php echo $rows['atime'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Person Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="pname" id="pname" value="<?php echo $rows['pname'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Contact No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="cnumber" id="cnumber" value="<?php echo $rows['cnumber'];?>" /></td>
</tr>
<tr><td></td><td><!--<input type="button"  value="Click Here To Move Vehicles"  onclick="showdiv();"/>--></td></tr>
<tr><td colspan="2"><div id="replace" style="display:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td align="right" style="color:#CC0000">Replace Vehicles To-</td><td></td></tr>

<tr><td><td><input name="id" type="hidden" id="id" value="<?php echo $rows['id'];?>"></td></td></tr>
 <tr>
<td height="29" align="right">Client Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

<?
$name=$rows['name'];

?> 

<select name="new_name" onChange="getYear(this.value,'statediv1','new_veh_reg')">
<option value="">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
<tr>
<td align="right">Vehicle No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><div id="statediv1"><select name="new_veh_reg" style="width:150px" id="veh_reg">
<option value="">Select Name First</option>
 
</select></div></td>
</tr>
<td height="32" align="right">Notwoking:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="new_Notwoking" id="new_Notwoking" value="<?php echo $rows['Notwoking'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="new_location" id="new_location" value="<?php echo $rows['location'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Available Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="new_atime" id="new_atime" value="<?php echo $rows['atime'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Person Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="new_pname" id="new_pname" value="<?php echo $rows['pname'];?>" /></td>
</tr>
<tr>
<td height="32" align="right">Contact No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="new_cnumber" id="new_cnumber" value="<?php echo $rows['cnumber'];?>" /></td>
</tr>


</table>

</div></td></tr>
<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'services.php' " /></td>
 
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
                                      
        var start_field = document.getElementById("Notwoking");
		
        var end_field = document.getElementById("atime");
        
        var start_s = start_field.value;   // Used to build the final start string.
        var end_s = end_field.value;     // Used to build the final end string.
        
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
                
                // build the to string.
                end_s = today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                end_s += '-';
                end_s += ((today.getDate() + 1) < 10) ? '0' + today.getDate() : today.getDate();
                
                break;
            case 'this month':
                // build the from string.
                start_s = today.getFullYear();
                start_s += '-';
                start_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                start_s += '-';
                start_s += '01';
                
                
                // build the to string.
                end_s = today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                end_s += '-';
                end_s += ((today.getDate() + 1) < 10) ? '0' + today.getDate() : today.getDate();
               
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
                
                
                // build the to string.
                end_s = (today.getMonth() == 0) ? today.getFullYear() - 1 : today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() == 0) ? '12' : ((today.getMonth() < 10) ? '0' + today.getMonth() : today.getMonth()));
                end_s += '-';
                end_s += getLastDayOfMonth(today.getMonth() - 1);
                
                break;
        }
        start_field.value = start_s;
        end_field.value = end_s;
    }
    Calendar.setup({
        inputField     :    "Notwoking",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    Calendar.setup({
        inputField     :    "atime",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
	Calendar.setup({
        inputField     :    "new_Notwoking",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
	Calendar.setup({
        inputField     :    "new_atime",
        ifFormat       :    "%Y-%m-%d %H:%M",
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
	function showdiv()
		{
		document.getElementById('replace').style.display = '';
		}
</script>