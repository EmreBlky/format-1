<?php
include ("connection.php");

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
</head>
<body>
<form method="post" action="" name="form1">
 <h2 align="center">&nbsp;</h2>
 <h2 align="center"> <strong><u>Billing Report</u></strong></h2>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 
 <table width="1135" border="1px" align="center">
 <tr>
 <td width="252" height="90"><strong>Branches:- </strong>
 <? 

$query="SELECT id,branch_name FROM gtrac_branch_new";
$result=mysql_query($query);

?>
   <select name="branch" onChange="getClient(this.value)">
	  <option>Select Branch</option>
       <? while($row=mysql_fetch_array($result)) { ?>
       <option value="<?=$row['id']?>">
         <?=$row['branch_name']?>
         </option>
       <? } ?>
      </select></td>
   
 <td width="286">
  <div id="clientdiv"><strong>Clients:-</strong><select name="client" >
     <option>Select Branch First</option>
   </select></div></td>
	
<td width="575">
<div id="vehdiv"><strong>Vehicle No:-</strong>  <select name="veh">
    <option>Select Client First</option>
  </select></div></td> 
  
    </tr> 
</table>



 <table width="1135" border="1px" align="center">
 <tr>
 <td width="252" height="90"><strong>Branches:- </strong>
 <? 

$query="SELECT id,branch_name FROM gtrac_branch_new";
$result=mysql_query($query);

?>
  <select name="branch1" onChange="getClient1(this.value),getVeh1(this.value)">
	  <option>Select Branch</option>
       <? while($row=mysql_fetch_array($result)) { ?>
       <option value="<?=$row['id']?>">
         <?=$row['branch_name']?>
         </option>
       <? } ?>
      </select></td>
   
 <td width="286">
	<div id="clientdiv1"><strong>Clients:-</strong><select name="client1" >
	<option>Select Branch First</option>
      </select></div></td>
	
<td width="575">
	<div id="vehdiv1"><strong>Vehicle No:-</strong><select name="veh1">
	<option>Select Client First</option>
      </select></div></td>
	

	


</tr> 
</table>
<table width="1135" border="1px" align="center">
 <tr>
 <td width="417" height="90"><strong>Others Sim Details:- </strong>
 
  <select name="no_sim" onChange="getNosim(this.value)">
	  <option>Select Reason</option>
      <option value="no_vehsim">Sim not in Any vehicle</option>
	   <option value="highbill_sim">Sim of Higher Billing</option>
	    <option value="voice_sim_bill">Voice sim Billing</option>
      
      </select></td>
   
<td width="702">
	<div id="nosimdiv"><strong>Sim details:-</strong><select name="noveh_sim">
	<option>Select Reason First</option>
      </select></div></td>

</tr> 
<tr>
<td height="86">
<strong>Find Sim details:-</strong><input name="sim" id="sim"><input name="Submit" type="submit" value="Find"></td>
<td>

<?php


$query="SELECT client_details.veh_no,client_details.client,client_details.branch,sim_no.amt,sim_no.sim_no from client_details join sim_no on sim_no.sim_no=client_details.sim_no where client_details.sim_no='$sim'";
$result1=mysql_query($query);
 while($row1=mysql_fetch_array($result1)) { 
 
 $query="select * from gtrac_branch_new where id=".$row1['branch'];
	 $rowuser=mysql_query($query);
	
	while($rowuser1=mysql_fetch_array($rowuser)) { 
  $branch_name=$rowuser1['branch_name']; 
 }
 
	?>
 
 
 
<table>
<tr>
<td width="228"><strong>Branch:-</strong><?=$branch_name?></td>
<td width="228"><strong>Client:-</strong><?=$row1['client']?></td>
<td width="310"><strong>Vehicle No:-</strong><?=$row1['veh_no']?></td>
</tr>
<tr>
<td><strong>Sim No:-</strong><?=$row1['sim_no']?></td>
<td><strong>Sim Amt:-</strong><?=$row1['amt']?></td>
</tr>
</table>
<? } ?>

</td></tr>
</table>
</form>

</body>
</html>
