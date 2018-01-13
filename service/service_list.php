<?php 
include("include/header.inc.php");
$name=(isset($_POST["name"]));
$vehicle=(isset($_POST["vehicle"]));
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
<script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
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
	
	function getVeh(vehId) {		
		var strURL="vehreg.php?name="+vehId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('vehdiv').innerHTML=req.responseText;						
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

<body>
 <form action="export.php" method="POST" name="name">
 <h2 align="center">&nbsp;</h2>
 <h2 align="center"> <strong><u>Services Report</u></strong></h2>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 
 <table border="0px" align="center">
 <tr>
 <td width="228"><strong>User Name : </strong></td>
 <td width="214">

   <p>
     <? 
include ("config.php");

$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?>
     <select name="name" onChange="getVeh(this.value)" id="name">
       <option>Select Name</option>
       <? while($row=mysql_fetch_array($result)) { ?>
       <option value=<?=$row['user_id']?>>
         <?=$row['name']?>
         </option>
       <? } ?>
     </select>
   </p>
   </td></tr>
 <tr style="">
    <td><strong>Vehicles</strong></td>
    <td ><div id="vehdiv"><select name="vehicle" id="vehicle">
	<option>Select Name First</option>
        </select></div></td>
  </tr>
<tr>
<td height="53" style="padding-bottom:5px;">
<b>From : &nbsp;&nbsp;</b>
<input name="dateStart" type="text" value="" id="dateStart" readonly="true" style="width:110px;" /></td>
<td style="padding-bottom:5px; text-align:left;">
<b>To :&nbsp;&nbsp; </b>&nbsp;<input name="dateEnd" type="text" value="" id="dateEnd" readonly="true" style="width:110px;" /></td>
</tr>
<tr align="right">
 <td><input name="submit" type="submit" value="submit" id="submit" /></td>


</tr> 

</table></form>

</body>
</html>
<?
include("include/footer.inc.php");

?>


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
