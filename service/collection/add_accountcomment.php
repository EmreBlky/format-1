<?php
 include("dbcon.php");
$Cash = 'unchecked';
$Cheque = 'unchecked';
$PDC = 'unchecked';
if(isset($_GET["userid"]) && $_GET["userid"]!="" )
{
	$User_Id= $_GET["userid"];
}
 

if(isset($_POST['submit']))
{

$selected_radio = $_POST['PaymentMode'];
if ($selected_radio == 'Cash')
{
$Cash = 'checked';
}
else if ($selected_radio == 'Cheque')
{
$Cheque = 'checked';
}
else if ($selected_radio == 'PDC')
{
$PDC = 'checked';
}



$month=$_POST['month'];
$year=$_POST['year'];
$PaymentMode=$_POST['PaymentMode'];
$Cheque=$_POST['Cheque'];
$Amount=$_POST['Amount'];
$time=$_POST['time'];
$CollectionBy=$_POST['CollectionBy'];
$reason=$_POST['reason'];
 $paid_status=1;

$act_amount="";
if($action=='edit')
	{
	$sql="update installation set sales_person='".$sales_person."',client='".$client."',no_of_vehicals='".$no_of_vehicals."',location='".$location."',model='".$model."',time='".$time."',contact_number='".$cnumber."' ,contact_person='".$contact_person."' ,contact_person_no='".$contact_person_no."' ,required='".$required."',datapullingtime='".$datapullingtime."',IP_Box='".$IP_Box."'  where id=$id";
	$execute=mysql_query($sql); 
	} 
	else
	{
	  $sql="INSERT INTO payment_status(user_id,month_rent,year,paid_status,act_amount,payment_recdate,collectionby,paymentby,amount_rec,cheque_no,comment_byaccounts)VALUES('".$User_Id."','".$month."','".$year."','".$paid_status."','".$act_amount."','".$time."','".$CollectionBy."','".$PaymentMode."','".$Amount."','".$Cheque."','".$reason."')";
	$execute=mysql_query($sql);
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
 
  if(document.form1.month.value=="")
  {
  alert("please choose one month") ;
  document.form1.month.focus();
  return false;
  }  
  if(document.form1.year.value=="")
  {
  alert("please choose one year") ;
  document.form1.year.focus();
  return false;
  } 
  if(document.form1.Amount.value=="")
  {
  alert("please Enter Amount") ;
  document.form1.Amount.focus();
  return false;
  }  
  
  if(document.form1.time.value=="")
  {
  alert("please Enter Date/Time") ;
  document.form1.time.focus();
  return false;
  }
  if(document.form1.collectionBy.value=="")
  {
  alert("please Enter collection by name") ;
  document.form1.collectionBy.focus();
  return false;
  }
    if(document.form3.reason.value =="")
  {
   alert("please enter reason");
   document.form3.reason.focus();
   return false;
   }
 
	
} 



</script>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/calendar/calendar.js"></script>
<script type="text/javascript" src="js/calendar/calendar-en.js"></script>   
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script>

</head>

<body>
<form method="post" action="" name="form1" onSubmit="return req_info();">
<table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">

 <tr>
<td height="29" align="right" >Month:*</td>
<td>

<select name="month" id="month">
<option value="" >Select Month</option>

<option value="1" <?PHP if($month==1) echo "selected";?>>January</option>
<option value="2" <?PHP if($month==2) echo "selected";?>>February</option>
<option value="3" <?PHP if($month==3) echo "selected";?>>March</option>
<option value="4" <?PHP if($month==4) echo "selected";?>>April</option>
<option value="5" <?PHP if($month==5) echo "selected";?>>May</option>
<option value="6" <?PHP if($month==6) echo "selected";?>>June</option>
<option value="7" <?PHP if($month==7) echo "selected";?>>July</option>
<option value="8" <?PHP if($month==8) echo "selected";?>>August</option>
<option value="9" <?PHP if($month==9) echo "selected";?>>September</option>
<option value="10" <?PHP if($month==10) echo "selected";?>>October</option>
<option value="11" <?PHP if($month==11) echo "selected";?>>November</option>
<option value="12" <?PHP if($month==12) echo "selected";?>>December</option>
</select></td>
</tr>
<tr style="">
<td align="right">Year*:</td>
<td><select name="year" id="year">
<option value="">Select Year</option>

<option value="2012" <?PHP if($year==2012) echo "selected";?>>2012</option>
<option value="2013" <?PHP if($year==2013) echo "selected";?>>2013</option>
<option value="2014" <?PHP if($year==2014) echo "selected";?>>2014</option>
<option value="2015" <?PHP if($year==2015) echo "selected";?>>2015</option>
<option value="2016" <?PHP if($year==2016) echo "selected";?>>2016</option>
 
</select>
</td>
</tr>

<tr>
<td height="32" align="right">Payment Mode:*</td>
<td>
<Input type = 'Radio' Name ='PaymentMode' value= 'Cash'
<?PHP print $cash; ?>
>Cash
<Input type = 'Radio' Name ='PaymentMode' value= 'Cheque'
<?PHP print $Cheque; ?>
>Cheque 
<Input type = 'Radio' Name ='PaymentMode' value= 'PDC'
<?PHP print $PDC; ?>
>PDC 
</td>
</tr>
<tr>
<td height="32" align="right">Cheque:</td><td><input type="text" name="Cheque" value="<?=$result['Cheque']?>" style="width:147px" id="Cheque"/></td>
</tr>
<tr>
<td height="32" align="right">Amount*</td>
<td>
  <input type="text" name="Amount" id="Amount" value="<?=$result['Amount']?>" style="width:147px" autocomplete="off"/> 		
 </td>
</tr>

<tr>
<td height="32" align="right">Received Date*</td>
<td>
	 <input type="text" name="time" id="time" value="<?=$result['time']?>" style="width:147px"/> 		
	  	</td>
</tr>
<tr>
<td height="32" align="right">Collection By:*</td>
<td><input type="text" name="CollectionBy" value="<?=$result['CollectionBy']?>" style="width:147px"/></td>
</tr>
<tr>
<td height="32" align="right">Comment:*</td>
<td>

<?php
 $query="SELECT * FROM reason where reason_for='collection'";
$result_reason=mysql_query($query);

?> 
<select name="reason" id="reason"   style="width:200px" onchange="ShowTextBox(this.value)">
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
</td>
</tr>

<tr>
<td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" onClick="return req_info(form2)"/>&nbsp;&nbsp; </td>
 
</tr>

 
</table>
</form>
</body>
</html>
 

<script type="text/javascript">  
    
    Calendar.setup({
        inputField     :    "time",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    
   
</script> 
 