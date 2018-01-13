<?php
include("include/header.inc.php");
include ("config.php");
if(isset($_POST['submit'])) {

 $subject = $_POST['subject'];
 $mailto = $_POST['mailto'];
 $mailtocc = $_POST['mailtocc'];

 
  
 /*$vehicle = $_POST['vehicle'];
 $date = $_POST['todaydate'];
 $status = $_POST['status'];
 $war = $_POST['warranty'];
 $sparep = $_POST['sparepart'];
 $sparec = $_POST['sparecost'];
 $remark = $_POST['remark'];
*/
 
  $headers  = "From: abc@g-trac.in";

  //$headers .="MIME-Version: 1.0\r\n";
  $headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
 
   $subject="$subject";
  $sendId ="$mailto,$mailtocc";
  
  $textTosend='
 <table id="MainTable" border="1" cellspacing="0" cellpadding="0" width="887">
   
  <tr>
   
    <td width="117" valign="middle"><p align="center"><strong>Vehicle No.</strong></p></td>
    <td width="91" valign="middle"><p align="center"><strong>Date</strong></p></td>
    <td width="111" valign="middle"><p align="center"><strong>Status</strong></p></td>
    <td width="192" valign="middle"><p align="center"><strong>warranty/out of warranty</strong></p></td>
    <td width="138" valign="middle"><p align="center"><strong>spare changed</strong></p></td>
    <td width="113" valign="middle"><p align="center"><strong>spare cost</strong></p></td>
    <td width="109" valign="middle"><p align="center"><strong>remark</strong></p></td>

	
  </tr>';
 
for ($i = 0; $i < count($_POST['vehicle']); ++$i) {

$textTosend.='<tr>
  <td >
  '.$_POST['vehicle'][$i].'  </td>
  <td >
  '.$_POST['date'][$i].'  </td>
  <td >
  '.$_POST['servicedate'][$i].'  </td>
  <td >
  '.$_POST['contact'][$i].'  </td>
  <td >
  '.$_POST['person'][$i].'  </td>
  <td >
  '.$_POST['avail'][$i].'  </td>
  <td >
  '.$_POST['remark'][$i].'  </td>
  
  </tr>
  ';
  }
  
  $textTosend.='</table><br>'; 
 
mail($sendId,$subject,$textTosend,$headers);
  }
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style>
.remove { display; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

  <meta name="robots" content="noindex,nofollow" />
<title>Dynamically attach jQuery DatePicker to Text box </title>
<link rel="stylesheet" href="/resources/themes/master.css" type="text/css" />
<link
 href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
 rel="stylesheet" type="text/css" />
<script
 src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"
 type="text/javascript"></script>
<script
 src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
 type="text/javascript"></script>
<script
 src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"
 type="text/javascript"></script>
<script src="/resources/scripts/mysamplecode.js" type="text/javascript"></script>
 
    <script type="text/javascript">
        $(document).ready(function () {
         
        $('#btnAdd').click(function () {
              var count = parseInt($('#HowManyRows').val()), first_row = $('#FirstRow');
                while(count-- > 0)                    first_row.clone().appendTo('#MainTable');
    });  
           $('body').on('focus',".datepicker_recurring_start", function(){
    $(this).datepicker();
});
 $('body').on('focus',".datepicker_recurring_service", function(){
    $(this).datepicker();
});

$('.form-fields').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });
        });
    </script>
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
</head>
<body>
<form name="form1" action="" method="POST">

<table width="943" border="0">
    <tr>
      <th width="151" scope="col"><div align="left">Client Username:- </div></th>
      <th width="205" scope="col"> <p align="left">
          <?php 
include ("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);
?>
          <select name="name" onchange="getVeh(this.value)" id="name">
            <option>Select Name</option>
            <? while($row=mysql_fetch_array($result)) { ?>
            <option value=<?=$row['user_id']?>>
            <?=$row['name']?>
            </option>
            <? } ?>
          </select>

    </p></th>
	 <th width="134" scope="col"><div align="left">No of vehicle:- </div></th>
      <th width="150" scope="col"> <p align="left">
	  <input type="text" name="HowManyRows" id="HowManyRows" style="width:110px;" />
	  </p></th>
	  <th width="281"><div align="justify">
    <input type="button" id="btnAdd" value="Add Vehicle"/>
  </div></th>
    </tr>
  </table>
    <div class="form-fields">
<table id="MainTable" border="1" cellspacing="0" cellpadding="0" width="1051">
   
  <tr>
   
    <td width="174" valign="middle"><p align="center"><strong>Vehicle No.</strong> </p></td>
    <td width="198" valign="middle"><p align="center"><strong>Date</strong></p></td>
    <td width="117" nowrap="nowrap" valign="bottom"><p align="center"><strong>Service Date</strong></p></td>
    <td width="121" nowrap="nowrap" valign="bottom"><p align="center"><strong>Contact No.</strong></p></td>
    <td width="121" nowrap="nowrap" valign="bottom"><p align="center"><strong>Contact Person</strong></p></td>
    <td width="149" nowrap="nowrap" valign="bottom"><p align="center"><strong>Availability</strong></p></td>
    <td width="159" nowrap="nowrap" valign="bottom"><p align="center"><strong>Service Remark</strong></p></td>
	<th width="4"></th>
  </tr>
  
   
 <tr id="FirstRow">    
    <td width="174" height="81" valign="middle"><p align="center"></p>
        <div id="vehdiv">
          <div align="center">
            <select name="vehicle[]" id="vehicle">
              <option>Select Name First</option>
            </select>
          </div>
        </div>
    <p></p></td>
    <td width="198" valign="middle"><p align="center">
    <input type="text" class="datepicker_recurring_start" name="date[]" />
     </p></td>
    <p></p>
   <td width="198" valign="middle"><p align="center">
    <input type="text" class="datepicker_recurring_service" name="servicedate[]" />
     </p></td>
    <td width="136" valign="middle"><p align="center">
      <textarea name="textarea" cols="10" rows="1" name="contact[]"></textarea>
    </p></td>
    <td width="126" valign="middle"><p align="center">
      <textarea name="textarea" cols="10" rows="1" name="person[]"></textarea>
    </p></td>
    <td width="128" valign="middle"><p align="center">
      <textarea name="textarea" cols="10" rows="1" name="avail[]"></textarea>
    </p></td>
    <td width="137" valign="middle"><p align="center">
      <textarea name="textarea" cols="10" rows="1" name="remark[]"></textarea>
    </p></td>
	<td><p align="center"><input type="button" class="remove" value="remove" /></p></td>
  </tr>
            </table>
         
      </div>
      
  
<p>&nbsp;</p>
<table width="429" border="0.5">
  <tr>
    <th width="65" height="26" scope="col"><div align="left">Subject:-</div></th>
    <th width="354" scope="col">
      <label>
        <div align="center">
          <input name="subject" type="text" value="Service Detail"size="50" />
        </div>
      </label>
     </th>
  </tr>
  <tr>
    <td height="75"><div align="left"><strong>To:-</strong></div></td>
    <td>
      <label>
      <div align="center">
        <input name="mailto" type="text" size="50" />
      </div>
      </label>
    </td>
  </tr>
  <tr>
    <td><div align="left"><strong>Cc:-</strong></div></td>
    <td>
      <label>
      <div align="center">
        <input name="mailtocc" type="text" size="50" />
      </div>
      </label>
   </td>
  </tr>
  <tr>
  <td>
  </td><td>
    <div align="center">
  <input type="submit" name="submit" id="submit" value="Send E-mail" />
 </div></td>
  </tr>
</table>
  
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>

    
