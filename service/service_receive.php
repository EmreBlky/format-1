<?php
include("include/header.inc.php");
include ("config.php");
if(isset($_POST['submit'])) {

 $subject = $_POST['subject'];
 $mailto = $_POST['mailto'];
 $mailtocc = $_POST['mailtocc'];
 $message = $_POST['message'];

   $headers ="MIME-Version: 1.0\r\n";
  $headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
 
   $subject="$subject";
  $sendId ="$mailto,$mailtocc";
  
  $textTosend='Dear Sir,';
  $textTosend.='<br><br>As per conversation, I talked at the given contact Numbers to confirm the availability of the vehicles and the status is mentioned below';
  $textTosend.='<br><br>
 <table id="MainTable" border="1" cellspacing="0" cellpadding="0" width="540">
   <tr>
   
    <td width="130" valign="middle"><p align="center"><strong>Vehicle No.</strong></p></td>
    <td width="126" valign="middle"><p align="center"><strong>Contact Person</strong></p></td>
    <td width="147" valign="middle"><p align="center"><strong>Contact No.</strong></p></td>
    <td width="130" valign="middle"><p align="center"><strong>Availability</strong></p></td>
   </tr>';
 
for ($i = 0; $i < count($_POST['vehicle']); ++$i) {

$textTosend.='<tr>
  <td >
  '.$_POST['vehicle'][$i].'  </td>
  <td >
  '.$_POST['contact'][$i].'  </td>
  <td >
  '.$_POST['person'][$i].'  </td>
  <td >
  '.$_POST['avail'][$i].'  </td>
 
  
  </tr>
  ';
  }
  
  $textTosend.='</table><br>'; 
  $textTosend.='Thanks & Regards<br>
  				G-Trac <br>
  				Customer Care<br>
				011-46254625	'; 
 $headers  .= "From: info@g-trac.in";
 
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
 <meta name="robots" content="noindex,nofollow" />
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
                while(count-- > +1)                    first_row.clone().appendTo('#MainTable');
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
<table id="MainTable" border="1" cellspacing="0" cellpadding="0" width="855">
   
  <tr>
   
    <td width="209" valign="middle"><p align="center"><strong>Vehicle No.</strong> </p></td>
    <td width="182" nowrap="nowrap" valign="bottom"><p align="center"><strong>Contact Person </strong></p></td>
    <td width="170" nowrap="nowrap" valign="bottom"><p align="center"><strong>Contact No.</strong></p></td>
    <td width="167" nowrap="nowrap" valign="bottom"><p align="center"><strong>Availability</strong></p></td>
    
	<th width="115"></th>
  </tr>
  
   
 <tr id="FirstRow">    
    <td width="209" height="81" valign="middle"><p align="center"></p>
        <div id="vehdiv">
          <div align="center">
            <select name="vehicle[]" id="vehicle">
              <option>Select Name First</option>
            </select>
          </div>
        </div>
    <p></p></td>
    <p></p>
   
    <td width="182" valign="middle"><p align="center">
      <input type="text" name="contact[]">
    </p></td>
    <td width="170" valign="middle"><p align="center">
       <input type="text" name="person[]">
    </p></td>
    <td width="167" valign="middle"><p align="center">
       <input type="text" name="avail[]">
    </p></td>
    <td><p align="center"><input type="button" class="remove" value="remove" /></p></td>
  </tr>
      </table>
         
  </div>
      
  
<p>&nbsp;</p>
<table width="429" border="0.5">
  <tr>
    <th width="119" height="26" scope="col"><div align="left">Subject:-</div></th>
    <th width="300" scope="col">
      <label>
        <div align="center">
          <input name="subject" type="text" value="Service Receiving Status" size="50" />
        </div>
      </label>
     </th>
  </tr>
 
  <tr>
    <td height="62"><div align="left"><strong>To:-</strong></div></td>
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

    
