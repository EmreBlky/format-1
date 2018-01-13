<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

?>

 <script>
 
 function ConfirmDelete(row_id)
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
		url:"userInfo.php?action=del_form_debtorsclose",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}
 
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
		url:"userInfo.php?action=DelfromDebtorsPaymentClear",
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
		url:"userInfo.php?action=DelfromDebtorsPaymentPending",
 		 
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
		url:"userInfo.php?action=deletefromdebtorsbackComment",
 		 
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
                    <h1>Delete From Debtors</h1>
					  
                </div>
                <div class="top-bar">
                  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
                    <br/>  
                    <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
                    <br/>
                    <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Admin</div>
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
	 $WhereQuery=" where (total_pending!='' or account_comment!='' or forward_back_comment!='') and approve_status=0 and final_status=0";
 } 
 else
 { 
	  
	/* $WhereQuery=" where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) and (device_remove_status='N' or no_device_removed!='') or (sales_comment!='') or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')";*/
	
	 $WhereQuery=" where ((approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (approve_status=1 and final_status!=1 and support_comment is null)) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
	   
 }
 
 
$query = mysql_query("SELECT * FROM del_form_debtors  ". $WhereQuery."  order by id DESC");

?>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
            <th>SL.No</th>
            <th>Date</th>
            <th>Account Manager</th>
            <th>Client</th>
            
            <th>Date Of Creation</th>
            <th>Total No Of Vehicle</th>
            <!-- <th>Total Payment Received</th>
            <th>Total Pending</th>
            <th>No Of Devices Removed</th>
            <th>Device Status</th> -->
            <th>Reason</th> 
            <!--  <th>IMEI Of Removed Device</th>  
            <th>Reg No</th> -->
            <th>View Detail</th>
		</tr>
	</thead>
	<tbody>


 
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<!--<tr align="center" <?// if( $row["support_comment"]!="" && $row["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($row["total_pending"]!="" && $row["account_comment"]=="" && $row["sales_comment"]==""){ echo 'style="background-color:#FF0000"';}elseif($row["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';} elseif($row["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?> >-->
 
<tr align="center" <? if( $row["support_comment"]!="" && $row["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($row["admin_comment"]!="" && $row["approve_status"]=="0" ){ echo 'style="background-color:#FF0000"';}elseif($row["approve_status"]==1 && $row["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';} elseif($row["final_status"]==1 && $row["close_date"]!=''){ echo 'style="background-color:#8BFF61"';}?> >

<td><?php echo $i ?></td>
  <td><?php echo $row["date"];?></td>
  <? if($row["acc_manager"]=='saleslogin') {
$account_manager=$row["sales_manager"]; 
}
else {
$account_manager=$row["acc_manager"]; 
}

?>
  
  <td><?php echo $account_manager;?></td>
 <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row["user_id"];
	$rowuser=select_query($sql);

			?>
  <td><?php echo $row["company"];?></td>
 
  <td><?php echo $row["date_of_creation"];?></td>
  
   <td><?php echo $row["total_no_of_vehicle"];?></td>
   <!-- 
  <td><?php echo $row["total_no_of_vehicle"];?></td>
  <td><?php echo $row["total_pay_rec"];?></td>
  <td><?php echo $row["total_pending"];?></td>
  <td><?php echo $row["no_of_devices_removed"];?></td>
  <td><?php echo $row["device_status"];?></td> -->
  <td><?php echo $row["reason"];?></td><!-- 
  <td><?php echo $row["imei_of_removel_devices"];?></td>
  <td><?php echo $row["reg_no"];?></td>
 -->

  <td><a href="#" onclick="Show_record(<?php echo $row["id"];?>,'del_form_debtors','popup1'); " class="topopup">View Detail</a> 
 <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?> 
  <?php if( $row["approve_status"]==1 && $row["final_status"]!=1){ ?>
  | <a href="#" onclick="return ConfirmDelete(<?php echo $row["id"];?>);"  >Done</a>
  <?php } ?>
   | <a href="#" onclick="return ConfirmPaymentClear(<?php echo $row["id"];?>);"  >Payment Clear</a>
    | <a href="#" onclick="return ConfirmPaymentPending(<?php echo $row["id"];?>);"  >Pending</a><? 
if( $row["forward_back_comment"]=="" && ($row["forward_req_user"]=="sarvesh" || $row["forward_req_user"]=="praveen")){ ?>
|<a href="#" onclick="return forwardbackComment(<?php echo $row["id"];?>);"  >Forward Back Comment</a>
<? }}?>
  
  
 </td>

</tr> <?php $i++; }?>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
<?php
include("../sales_request/include/footer.php"); ?>














 









 






 