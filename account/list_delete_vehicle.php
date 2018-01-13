<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/
 
?>
<script>
function ConfirmPaymentClear(row_id)
{
  var x = confirm("All payment cleared?");
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
		url:"userInfo.php?action=deletionPaymentClear",
 		data:"row_id="+row_id,
		success:function(msg){
		 alert(msg);
		location.reload(true);		
		}
	});
}

function ConfirmPaymentPending(row_id)
{
   var retVal = prompt("Pending Amount : ", "Pending Amount");
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
		url:"userInfo.php?action=deletionPaymentPending",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 alert(msg); 
		location.reload(true);		
		}
	});
}

/*function ConfirmData(row_id)
{
  var x = confirm("Are you sure you want to Close this?");
  if (x)
  {
  approve(row_id);
      return ture;
  }
  else
    return false;
}

function approve(row_id)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deletionclose",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}*/

function ConfirmDelete(row_id)
{
	
   var retVal = prompt("Write Comment : ", "");
  if (retVal)
  {
  addComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deletionComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			alert(msg);
		 
		location.reload(true);		
		}
	});
}
</script>
<script>
function forwardbackComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deletevehiclebackComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 alert(msg);
			 
		 
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
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Deletion List</h1>
  <div class="top-bar">
    <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
    <br/>
    <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
    <br/>
    <div style="float:right";><font style="color:#FFC184;font-weight:bold;">Light Brown:</font> Back from Admin</div>
    <br/>
    <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
  </div>
</div>
<div class="table">
  <?php

if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where approve_status=1 and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" ";
 }
  else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1";
 }
  else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (odd_paid_unpaid!='' or account_comment!='' or forward_back_comment!='') and approve_status=0";
 }
 else
 { 
	  
	 $WhereQuery=" where (approve_status=0 and final_status!=1) and (vehicle_location!='gtrack office' or stock_comment!='') and (odd_paid_unpaid is null and account_comment is null)  or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
	 /*
	 $WhereQuery=" where ((approve_status=0 and final_status!=1 and odd_paid_unpaid is null and account_comment is null) or (final_status=1 and deactivation_of_sim='Yes' and close_date is null)) and (vehicle_location!='gtrack office' or stock_comment!='') or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')";*/
	 
 }
 
$query = select_query("SELECT * FROM deletion ". $WhereQuery. " order by id DESC ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>client</th>
        <th>Vehicle Number</th>
        <th> Device IMEI</th>
        <th> Sim No.</th>
        <th>Reason</th>
        <th>View Detail</th>
        <th>Old Device Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <!--<tr align="center" <?// if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';} elseif($query[$i]["odd_paid_unpaid"]!="" && $query[$i]["odd_paid_unpaid"]!="Payment cleared" && $query[$i]["service_comment"]==""){ echo 'style="background-color:#FFC184"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?> >-->
      
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';} elseif($query[$i]["admin_comment"]!="" && $query[$i]["approve_status"]=="0"){ echo 'style="background-color:#FFC184"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1 && $query[$i]["close_date"]!=''){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["reg_no"];?></td>
        <td><?php echo $query[$i]["imei"];?></td>
        <td><?php echo $query[$i]["device_sim_no"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td style="width:140px"><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'deletion','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          
          <!--<?php// if( $query[$i]["final_status"]==1 && $query[$i]["close_date"]==""){ ?>
    | <a href="#" onclick="return ConfirmData(<?php// echo $query[$i]["id"];?>);"  >Done</a>
 <?php// } ?>--> 
          |<a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Comment</a>
          <? 
if( $query[$i]["forward_back_comment"]=="" && ($query[$i]["forward_req_user"]=="sarvesh" || $query[$i]["forward_req_user"]=="praveen")){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
        <td  style="width:80px"><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <a href="#" onclick="return ConfirmPaymentClear(<?php echo $query[$i]["id"];?>);"  > Paid</a> | <a href="#" onclick="return ConfirmPaymentPending(<?php echo $query[$i]["id"];?>);"  > Unpaid </a>
          <?php }?></td>
      </tr>
      <?php }?>
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
