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
		url:"userInfo.php?action=DeactivationPaymentClear",
 		data:"row_id="+row_id,
		success:function(msg){
		 
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
		url:"userInfo.php?action=DeactivationPaymentPending",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			  
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
		url:"userInfo.php?action=deactivateaccountbackComment",
 		 
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
  <h1>Deactivation of account</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FFC184;font-weight:bold;">Light Brown:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
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
	 $WhereQuery=" where (pay_pending!='' or account_comment!=''or forward_back_comment!='') and approve_status=0 and final_status=0";
 } 
 else
 { 
	  
	 /*$WhereQuery=" where (approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) and (device_remove_status='N' or no_device_removed!='') or (sales_comment!='') or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')";*/
	 
	 $WhereQuery=" where ((approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) or (final_status=1 and delete_form_debtors='Yes' and close_date is null)) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
	 	 
 }
  
 
 
$query = select_query("SELECT * FROM deactivation_of_account   ". $WhereQuery."  order by id desc ");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Client</th>
        <th>Total No Of Vehicles</th>
        <th>Deactivate Temporary</th>
        <th>Reason</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <!--<tr align="center" <?// if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["pay_pending"]!="" && $query[$i]["account_comment"]=="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?> >-->
      
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["admin_comment"]!="" && $query[$i]["approve_status"]=="0"){ echo 'style="background-color:#FFC184"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1 && $query[$i]["close_date"]!=''){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <? if($query[$i]["acc_manager"]=='saleslogin') {
$account_manager=$query[$i]["sales_manager"]; 
}
else {
$account_manager=$query[$i]["acc_manager"]; 
}

?>
        <td><?php echo $account_manager;?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
	$rowuser=select_query($sql);

			?>
        <td><?php echo $query[$i]["company"];?></td>
        <td><?php echo $query[$i]["total_no_of_vehicles"];?></td>
        <td><?php echo $query[$i]["deactivate_temp"];?></td>
        <!-- <td><?php echo $query[$i]["reg_no"];?></td>
  <td><?php echo $query[$i]["ps_of_location"];?></td>
  <td><?php echo $query[$i]["ps_of_ownership"];?></td>
  <td><?php echo $query[$i]["reason"];?></td>
  <td><?php echo $query[$i]["psd_paid"];?></td>
  <td><?php echo $query[$i]["psd_unpaid"];?></td>
  <td><?php echo $query[$i]["ps_rent"];?></td>
  <td><?php echo $query[$i]["service_action"];?></td> -->
        <td><?php echo $query[$i]["reason"];?></td>
        <td style="230px"><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'deactivation_of_account','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onclick="return ConfirmPaymentClear(<?php echo $query[$i]["id"];?>);"  >Payment Clear</a> | <a href="#" onclick="return ConfirmPaymentPending(<?php echo $query[$i]["id"];?>);"  >Pending</a>
          <? 
if( $query[$i]["forward_back_comment"]=="" && ($query[$i]["forward_req_user"]=="sarvesh" || $query[$i]["forward_req_user"]=="praveen")){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
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
