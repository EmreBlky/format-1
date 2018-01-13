<?php
include("include/header.inc.php");
include ("config.php");

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
	$result=mysql_fetch_array(mysql_query("select * from installation_mumbai where id=$id"));	
	}


if(isset($_POST['submit']))
{
$sales_person=$_POST['sales_person'];
$client=$_POST['client'];
$no_of_vehicals=$_POST['no_of_vehicals'];
$location=$_POST['location'];
$model=$_POST['model'];
$time=$_POST['time'];
$cnumber=$_POST['cnumber'];
$contact_person=$_POST['contact_person'];
$contact_person_no=$_POST['contact_person_no'];



if($action=='edit')
	{
	$sql="update installation_mumbai set sales_person='".$sales_person."',client='".$client."',no_of_vehicals='".$no_of_vehicals."',location='".$location."',model='".$model."',time='".$time."',contact_number='".$cnumber."' ,contact_person='".$contact_person."' ,contact_person_no='".$contact_person_no."' where id=$id";
	$execute=mysql_query($sql);
	header("location:installation_mum.php");

	}
	else if($action=='editp')
	{
	$setqry="";
	if(isset($_GET['pending']))
	{
	$newstst=$_GET['pending'];
	$setqry=", status='1'";
	}
	$sql="update installation_mumbai set sales_person='".$sales_person."',client='".$client."',no_of_vehicals='".$no_of_vehicals."',location='".$location."',model='".$model."',time='".$time."',contact_number='".$cnumber."',pending=0 ".$setqry." ,contact_person='".$contact_person."' ,contact_person_no='".$contact_person_no."' where id=$id";
	
	$execute=mysql_query($sql);
header("location:installation_mum.php");

	}
	else
		{
	$sql="INSERT INTO installation_mumbai(sales_person,client,no_of_vehicals,location,model,time,contact_number,installed_date,status,contact_person,contact_person_no)VALUES('".$sales_person."','".$client."','".$no_of_vehicals."','".$location."','".$model."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$contact_person_no."')";
	
	$execute=mysql_query($sql);
header("location:installation_mum.php");
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
	 <input type="text" name="model" id="model" value="<?=$result['model']?>" style="width:147px" autocomplete="off"/> 		
	  	</td>
</tr>

<tr>
<td height="32" align="right">Time:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
	 <input type="text" name="time" id="time" value="<?=$result['time']?>" style="width:147px"/> 		
	  	</td>
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