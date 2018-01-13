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
		url:"userInfo.php?action=Device_lostPaymentClear",
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
		url:"userInfo.php?action=Device_lostPaymentPending",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 alert(msg); 
		location.reload(true);		
		}
	});
}



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
		url:"userInfo.php?action=Device_lostComment",
 		 
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
		url:"userInfo.php?action=devicelostbackComment",
 		 
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
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Device Lost List</h1>
  <div class="top-bar">
    <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
    <br/>
    <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
    <br/>
    <div style="float:right";><font style="color:#FFC184;font-weight:bold;">Light Brown:</font> Back from Account</div>
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
	 $WhereQuery=" where approve_status=1 ";
 }
  else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1";
 }
  else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (odd_paid_unpaid!='' or account_comment!='' or forward_back_comment!='') and approve_status=0 and final_status=0 or forward_req_user='".$_SESSION["user_name"]."'";
 }
 else
 { 
	  
	 $WhereQuery=" where (approve_status=0 and final_status!=1 and odd_paid_unpaid is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
  
 }
 
$query = select_query("SELECT * FROM device_lost  ". $WhereQuery."   order by id DESC ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>client</th>
        <th>Vehicle Number</th>
        <th>Old Mobile No. </th>
        <th>New Mobile No.</th>
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
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["odd_paid_unpaid"]!="" && $query[$i]["odd_paid_unpaid"]!="Payment cleared" && $query[$i]["service_comment"]==""){ echo 'style="background-color:#FFC184"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["odd_reg_no"];?></td>
        <td><?php echo $query[$i]["odd_sim"];?></td>
        <td><?php echo $query[$i]["ndd_sim"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td style="width:140px"><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'device_lost','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Comment</a>
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
