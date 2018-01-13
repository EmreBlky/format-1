<?php
include("include/header.inc.php");
include ("config.php");


if(isset($_POST['submit']))
{
$name=$_POST['name']; 
$Date=$_POST['Date']; 
$amount=$_POST['amount']; 
$Cno=$_POST['Cno']; 
$pay_type=$_POST['pay_type']; 
$RecName=$_POST['RecName'];  

$sql=mysql_query("SELECT name FROM users WHERE user_id='$name'");
$row=mysql_fetch_array($sql);


         
 	            
              
 	    
 	    
    

 $sql="INSERT INTO billing(client_name,date,amount,payment_type,cheque_no,payment_reciever)VALUES
('".$row['name']."','".$Date."','".$amount."','".$pay_type."','".$Cno."','".$RecName."')"; 
 
//echo "INSERT INTO services(name,veh_reg,Notwoking,location,atime,pname,cnumber,req_date,status)VALUES('".$row['name']."','".$veh_reg."','".$Notwoking."','".$location."','".$atime."','".$pname."','".$cnumber."','".date("Y-m-d")."','1')";die(); 
$execute=mysql_query($sql);
header("location:billing.php");
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
 
function getYear(user_id,veh_reg) {
 
var strURL="ajax.php?user_id="+user_id+"&select_id="+veh_reg;
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
  if(document.form1.name.value==0)
  {
  alert("please choose Client name") ;
  document.form1.name.focus();
  return false;
  } 

  if(document.form1.Date.value =="")
  {
   alert("please enter Date");
   document.form1.Date.focus();
   return false;
   }
   if(document.form1.amount.value =="")
  {
   alert("please enter Amount");
   document.form1.amount.focus();
   return false;
   }
     
   if(document.form1.RecName.value =="")
  {
   alert("please enter Reciever Name");
   document.form1.RecName.focus();
   return false;
   }
   
   return true;
   
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
<td width="24%" height="29" align="right" >Client Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2">
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name" id="name" onChange="getYear(this.value,'veh_reg')" style="width:150px">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['user_id']?>><?=$row['name']?></option>
<? } ?>
</select></td>
</tr>
 <tr>
<td height="32" align="right">Date:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2">
	 <input type="text" name="Date" id="Date" value="" style="width:147px" autocomplete="off"/> 		
	  	</td>
</tr>

<tr>
<td height="32" align="right">Amount:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2"><input type="text" name="amount" value="" id="amount" style="width:147px" autocomplete="off"/></td>
</tr>
<tr>
<td height="32" align="right">Cash/Cheque:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">

<Input type = 'Radio' Name ='pay_type' value= '1' checked
<?PHP if($pay_type==1) echo "checked"; ?>
>Cash

<Input type = 'Radio' Name ='pay_type' value= '2'
<?PHP if($pay_type==2) echo "checked"; ?>
>Cheque

</td>
</tr> 

<tr>
<td height="32" align="right">Cheque NO:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
	 <input type="text" name="Cno" id="Cno" value="" style="width:147px"/> 		
	  	</td>
</tr>
<tr>
<td height="32" align="right">Reciever Name:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2"><input type="text" name="RecName" value="" style="width:147px"/></td>
</tr>
 

<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'billing.php' " /></td>
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
        inputField     :    "Date",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    
    
</script>