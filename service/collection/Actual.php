<?php
session_start();
 include("dbcon.php");
 
if(isset($_GET["userid"]) && $_GET["userid"]!="" )
{
	$User_Id= $_GET["userid"];
}

$sql1 = "select * from actual_payment where user_id='".$User_Id."' group by month  order by currenttime desc"; 
 
$rsd1 = mysql_query($sql1);
echo "<table border='1'><tr>";
while ($row = mysql_fetch_assoc($rsd1))
	{
$monthNum = date($row["month"]);
$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
//echo $monthName;  
//echo $month_payment=date($row["month"]);
  $totalpayment=$row["totalpayment"];

echo " <td><table border='0'>
<tr><td>".$monthName."</td></tr><tr><td>".$totalpayment."</td></tr></table></td>";

	
	 
	}
 
 echo "</tr></table>";

 $msg_update="";
 $action="";
if(isset($_POST['submit']))
{
$month=$_POST['month'];
$year=$_POST['year'];
$totalpayment=$_POST['Rent'] + $_POST['Device'];
$Rent=$_POST['Rent'];
$Device=$_POST['Device'];
// $totalpayment=

$act_amount="";

  /*$sql = "select * from actual_payment where month ='".$month."' and user_id='".$User_Id."'"; 
$rsd = mysql_query($sql);
 $result=mysql_fetch_assoc($rsd);

if(count($result)>0)
	{
	$_SESSION["Id_update"]=$result["id"];
 $msg_update= "You already added payment for this month, Just enter updated value for this month";
 $_POST['month']=$result["id"];
 $_POST['year']=$result["id"];
$_POST['totalpayment']=$result["id"];
 $_POST['Rent']=$result["id"];
 $_POST['Device']=$result["id"];
	} 
	else
	{  
	echo
	
	*/


	
  	$sql="INSERT INTO actual_payment(user_id,month,year,totalpayment,rent,device) VALUES ('".$User_Id."','".$month."','".$year."','".$totalpayment."','".$Rent."','".$Device."')";
	 
	$execute=mysql_query($sql);

	echo "Update successfully";
}
 	/*}
}

if(isset($_POST['update']))
{
//$_SESSION['Id_update']
 $month=$_POST['month'];
$year=$_POST['year'];
$totalpayment=$_POST['totalpayment'];
$Rent=$_POST['Rent'];
$Device=$_POST['Device'];
	   $sql="update actual_payment set month='".$month."',year='".$year."',totalpayment='".$totalpayment."',rent='".$Rent."',device='".$Device."' where id=".$_SESSION['Id_update'];
	 $execute=mysql_query($sql); 

}*/
  

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
  if(document.form1.totalpayment.value=="")
  {
  alert("please Enter total payment") ;
  document.form1.totalpayment.focus();
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
<form method="post" action="Actual.php?userid=<? echo  $_GET["userid"] ?>" name="form1"  >
<table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">

 <tr>
<td height="29" align="right" >Month:*</td>
<td>

<select name="month" id="month"  >
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
<td height="32" align="right">Rent:</td><td><input type="text" name="Rent" value="<? if(isset($_POST['Rent'])) echo $_POST['Rent'];?>" style="width:147px" id="Rent"/></td>
</tr>
<tr>
<td height="32" align="right">Device:</td>
<td>
  <input type="text" name="Device" id="Device" value="<? if(isset($_POST['Device'])) echo $_POST['Device'];?>" style="width:147px" autocomplete="off"/> 		
 </td>
</tr>
 <tr>
<td height="32" align="right">Totalpayment:*</td>
<td>

<? echo $totalpayment ?>
 <!--<input type="text" name="totalpayment" value="<? if(isset($_POST['totalpayment'])) echo $_POST['totalpayment'];?>" style="width:147px" id="totalpayment"/>-->
</td>
</tr>
 
<tr>
<td height="32" align="right">
<input type="submit" name="submit" value="submit" align="right" />&nbsp;&nbsp; </td>
</tr>
 
 
</table>
</form>
</body>
</html>
 
 
 