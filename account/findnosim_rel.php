<?php
include("../connection.php"); 

 $no_sim=$_GET['no_sim'];


if($no_sim=='no_vehsim') {
//$query="SELECT * FROM no_vehicle_sim";
  $query="SELECT * FROM reliance_sim";
  $result=mysql_query($query); 
}
 if($no_sim=='highbill_sim')
	 {   
	//$query="SELECT * FROM sim_no WHERE amt>'56'";
	$query="SELECT * FROM reliance_sim WHERE amt=0";
	
	  $result=mysql_query($query); 
	 } 
	 if($no_sim=='voice_sim_bill')
	 {   
	//$query="SELECT * FROM voice_sim";
	  $result=mysql_query($query); 
	 } 
	 ?>
	   
	 
	  
	   <html>
	   <style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
       </style>
	   <body>
	   <table>
	   <tr>
	   <td width="81">
	   <strong>Sim Nos.:-</strong></td>
	   <td width="169">
	   <select name="No_sim">
	  <option>All SIM nos.</option>
       <? 
	   $simlist="";
	   while($row=mysql_fetch_array($result)) {
         $simlist .="'".$row['sim_no']."',";
		 ?>
	
	   <option value="<?=$row['sim_no']?>">
         <?=$row['sim_no']?>----<?=$row['amt']?>----<?=$row['person']?>
         </option>
       <? } ?>
      </select>
	  </td>
	  <td width="126">
	    <span class="style1">
  <?
	  if($no_sim=='no_vehsim') {
	  
$query="SELECT sim_no,COUNT(sim_no) AS tagsim_no FROM reliance_no_client GROUP BY amt=0";
//$query="SELECT sim_no,COUNT(sim_no) AS tagsim_no FROM sim_no GROUP BY amt=0";

$result1=mysql_query($query);
}

  if($no_sim=='highbill_sim') {
	  
//$query="SELECT sim_no,COUNT(sim_no) AS tagsim_no FROM sim_no WHERE amt>'56' GROUP BY amt>56";
$result1=mysql_query($query);
}

if($no_sim=='voice_sim_bill') {
	  
//$query="SELECT sim_no,COUNT(sim_no) AS tagsim_no FROM voice_sim GROUP BY amt>56";
$result1=mysql_query($query);
}


while($row1=mysql_fetch_array($result1)) {

?> 
  
  Total Sim Nos.:- </span></td>
  <td width="133">
    <? echo $vehcount=$row1['tagsim_no']; } ?>  </td>
  
  
	  </tr>
	  
	  
	  
	 
	  
	
 <?
 
 if($no_sim=='voice_sim_bill')
	 {   
	//$query="SELECT sum(amt) as total FROM voice_sim WHERE sim_no in (".substr($simlist,0,-1).")";
	  $result2=mysql_query($query); 
	 } 
	 else{	 
 //$query="SELECT sum(amt) as total FROM sim_no WHERE sim_no in (".substr($simlist,0,-1).")";
}
$result2=mysql_query($query);
 while($row2=mysql_fetch_array($result2)) { ?>
 <tr>
 <td>
<strong>Total Amt:-</strong>
</td><td>
	   <input id="amt1" name="amt" value="<? echo $row2['total']; ?>">
	   
	   <? } ?> 
	   
	 
	
	  </td>
	  </tr>
	  
	  </table></body></html>
	