<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

$sim=$_POST["sim"]; 
?>

<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
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
	
	function getClient(branchID) {		
		
		var strURL="findclient.php?branch="+branchID;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('clientdiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getVeh(veh) {		
		var strURL="findveh.php?veh="+veh;
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
	function getNosim(no_simID) {		
		var strURL="findnosim.php?no_sim="+no_simID;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('nosimdiv').innerHTML=req.responseText;						
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
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
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
	
	function getClient1(branchID1) {		
		
		var strURL="findclient1.php?branch1="+branchID1;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('clientdiv1').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getVeh1(veh1) {		
		var strURL="findveh1.php?branch1="+veh1;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('vehdiv1').innerHTML=req.responseText;						
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
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style10 {font-size: 14px}
-->
</style>
</head>
<body>
<form method="post" action="" name="form1">
 <h2 align="center">&nbsp;</h2>
 <h2 align="center" class="style1"> <u>Airtel Billing Report</u></h2><a href="reliancebilling.php"> Reliance Billing</a>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 
 <table width="927" border="1px" align="center">
 <tr>
 <td width="222" height="90"><span class="style10"><strong>Branches:- </strong>
     <? 

$query="SELECT id,branch_name FROM gtrac_branch";
$result=mysql_query($query);

?>
     <select name="branch" onChange="getClient(this.value)">
        <option>Select Branch</option>
       <? while($row=mysql_fetch_array($result)) { ?>
       <option value="<?=$row['id']?>">
         <?=$row['branch_name']?>
         </option>
       <? } ?>
     </select>
 </span></td>
   
 <td width="291">
  <div class="style10" id="clientdiv"><strong>Clients:-</strong><select name="client" >
     <option>Select Branch First</option>
   </select></div></td>
	
<td width="392">
<div class="style10" id="vehdiv"><strong>Vehicle No:-</strong>  <select name="veh">
    <option>Select Client First</option>
  </select></div></td> 
    </tr> 
</table>



 <table width="929" border="1px" align="center">
 <tr>
 <td width="222" height="90"><span class="style10"><strong>Branches:- </strong>
     <? 

$query="SELECT id,branch_name FROM gtrac_branch";
$result=mysql_query($query);

?>
     <select name="branch1" onChange="getClient1(this.value),getVeh1(this.value)">
        <option>Select Branch</option>
       <? while($row=mysql_fetch_array($result)) { ?>
       <option value="<?=$row['id']?>">
         <?=$row['branch_name']?>
         </option>
       <? } ?>
     </select>
 </span></td>
   
 <td width="291">
	<div class="style10" id="clientdiv1"><strong>Clients:-</strong><select name="client1" >
	<option>Select Branch First</option>
      </select></div></td>
	
<td width="394">
	<div class="style10" id="vehdiv1"><strong>Vehicle No:-</strong><select name="veh1">
	<option>Select Client First</option>
      </select></div></td>
</tr> 
</table>
<table width="929" border="1px" align="center">
 <tr>
 <td width="326" height="90"><span class="style10"><strong>Others Sim Details:- </strong>
 
     <select name="no_sim" onChange="getNosim(this.value)">
       <option>Select Reason</option>
       <option value="no_vehsim">Sim not in Any vehicle</option>
       <option value="highbill_sim">Sim of Higher Billing</option>
       <option value="voice_sim_bill">Voice sim Billing</option>
     </select>
 </span></td>
   
<td width="587">
	<div class="style10" id="nosimdiv"><strong>Sim details:-</strong><select name="noveh_sim">
	<option>Select Reason First</option>
      </select></div></td>
</tr> 
<tr>
<td height="86">
  <span class="style10"><strong>Find Sim details:-</strong>
  <input name="sim" id="sim">
  <input name="Submit" type="submit" value="Find">
  </span></td>
<td>

<?php


$query="SELECT client_details.veh_no,client_details.client,client_details.branch,sim_no.amt,sim_no.sim_no from client_details join sim_no on sim_no.sim_no=client_details.sim_no where client_details.sim_no='$sim'";
$result1=mysql_query($query);
 while($row1=mysql_fetch_array($result1)) { 
 
 $query="select * from gtrac_branch where id=".$row1['branch'];
	 $rowuser=mysql_query($query);
	
	while($rowuser1=mysql_fetch_array($rowuser)) { 
  $branch_name=$rowuser1['branch_name']; 
 }
 
	?>
 
 
 
<table>
<tr>
<td width="228"><span class="style10"><strong>Branch:-</strong>
    <?=$branch_name?>
</span></td>
<td width="228"><span class="style10"><strong>Client:-</strong>
    <?=$row1['client']?>
</span></td>
<td width="310"><span class="style10"><strong>Vehicle No:-</strong>
    <?=$row1['veh_no']?>
</span></td>
</tr>
<tr>
<td><span class="style10"><strong>Sim No:-</strong>
    <?=$row1['sim_no']?>
</span></td>
<td><span class="style10"><strong>Sim Amt:-</strong>
    <?=$row1['amt']?>
</span></td>
</tr>
</table>
<? } ?></td></tr>
</table>
</form>

</body>
</html>
