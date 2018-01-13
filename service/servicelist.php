<?php 

$name=(isset($_POST["name"]));
$dateStart=(isset($_POST["dateStart"]));
$dateEnd=(isset($_POST["dateEnd"]));


 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Service Report</title>


 <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
</head>
  <!-- main calendar program -->
  <script type="text/javascript" src="js/calendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="js/calendar/calendar-en.js"></script> 
<!-- the following script defines the Calendar.setup helper function, which makes
adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="js/calendar/calendar-setup.js"></script> 



<body>
 <form action="export.php" method="POST" name="name">
 <h2 align="center">&nbsp;</h2>
 <h2 align="center"> <strong><u>Services Report</u></strong></h2>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 
 <table border="0px" align="center">
 <tr>
 <td width="207"><strong>User Name : </strong></td>
 


 <td width="235">
 <select name="name" id="name">
<?php 
$con=mysql_connect("localhost","root","");
if(!$con)
{
die('Connection failed' . mysql_error());
}
mysql_select_db("gtracservicedb", $con);
$sql1=mysql_query("SELECT name FROM users");
while ($data=mysql_fetch_assoc($sql1))
  {
    ?>
    <option name="drop1" checked value ="<?php echo $data['name'] ?>" >
    <?php echo $data['name']; ?>
    </option>
  <?php 
  } 
  mysql_close($con);
  ?>
</select>
<tr>
<td height="53" style="padding-bottom:5px;">
<b>From : &nbsp;&nbsp;</b>
<input name="dateStart" type="text" value="" id="dateStart" readonly="true" style="width:110px;" /></td>
<td style="padding-bottom:5px; text-align:left;">
<b>To :&nbsp;&nbsp; </b>&nbsp;<input name="dateEnd" type="text" value="" id="dateEnd" readonly="true" style="width:110px;" /></td>
</tr>
<tr>
 <td><input name="submit" type="submit" value="submit" id="submit" /></td>


</tr> 

</table></form>

</body>
</html>


<script type="text/javascript">
<!--
	Calendar.setup({
        inputField     :    "dateStart",   // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    Calendar.setup({
        inputField     :    "dateEnd",
        ifFormat       :    "%Y-%m-%d",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    
//-->

</script>
