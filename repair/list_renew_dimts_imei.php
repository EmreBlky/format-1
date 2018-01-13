<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
 

?>
<script>
 
function ConfirmPaymentClear(row_id)
{
  var x = confirm("Port Changed");
  if (x)
  {
  PaymentClear(row_id);
      return ture;
  }
  else
    return false;
}

function PaymentClear(row_id)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=RenewDimts_imei",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}

function ConfirmPaymentPending(row_id)
{
   var retVal = prompt("Port change Pending : ", "Because Device is not Responding ");
  if (retVal)
  {
  PaymentPending(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function PaymentPending(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=RenewDimts_imeiPort",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			  
		location.reload(true);		
		}
	});
}
</script>

<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1> Renew Dimts Imei List</h1>
  <div style="float:right";><font style="color:#6BBBE7;font-weight:bold;">Blue:</font> Back from Repair</div>
  <br/>
  <div style="float:right";><font style="color:#93E95F;font-weight:bold;">Green:</font> Port Changed</div>
</div>
<div class="table">
  <?php
if($_POST["Showrequest"]==1)
 {
	  //$WhereQuery=" where repair_comment='Port Changed'";
	   $WhereQuery=" where repair_comment!=''";
 }
 else if($_POST["Showrequest"]==2)
 {
	// $WhereQuery=" where approve_status=1";
	  $WhereQuery=" ";
 }
 
 else
 { 
	  
	 $WhereQuery=" where ((approve_status=1 or account_comment!='') and port_change_status='Yes' and repair_comment IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
  
 }
   
$query = select_query("SELECT * FROM renew_dimts_imei ". $WhereQuery."  order by id desc ");   

?>
  </p>
  <p>&nbsp; </p>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Sales Manager</th>
        <th>User Name</th>
        <th>Company Name</th>
        <th>Vehicle Number</th>
        <th>7 digit IMEI</th>
        <th>15 Digit IMEI</th>
        <th>Changed to Port</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if($query[$i]["repair_comment"]!=''){ echo 'style="background-color:#93E95F"';}elseif($query[$i]["port_change_reason"]!='' && $query[$i]["service_comment"]==''){ echo 'style="background-color:#6BBBE7"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["sales_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["veh_reg"];?></td>
        <td><?php echo $query[$i]["device_imei_7"];?></td>
        <td><?php echo $query[$i]["device_imei_15"];?></td>
        <td><?php echo $query[$i]["port_change"];?></td>
        <td style="230px"><a href="#" onClick="Show_record(<?php echo $query[$i]["id"];?>,'renew_dimts_imei','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onClick="return ConfirmPaymentClear(<?php echo $query[$i]["id"];?>);"  >Port Changed</a> | <a href="#" onClick="return ConfirmPaymentPending(<?php echo $query[$i]["id"];?>);"  >Port change Pending</a>
          <?php } ?></td>
      </tr>
      <?php  }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>
