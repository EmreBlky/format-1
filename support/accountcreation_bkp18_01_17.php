<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/

$support_id = $_SESSION['userId'];

/*if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

if($_SESSION['user_name']=="kanha"){
	$branch='branch_id IN (2,4,7)';	
}
else if($_SESSION['user_name']=="vivek"){
	$branch='branch_id IN (3)';
}
else if($_SESSION['user_name']=="amit"){
	$branch='branch_id IN (6)';
}
else{
	$branch='branch_id IN (1)';
}*/
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
	
$.ajax({
		type:"GET",
		url:"userInfo.php?action=NewAccclose",
 		data:"row_id="+row_id,
		success:function(msg){
		location.reload(true);		
		}
	});
}
function backComment(row_id)
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
		url:"userInfo.php?action=NewAccsupportComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 
		 
		location.reload(true);		
		}
	});
}
 function forwardbackComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment1(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment1(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=accountcreationbackComment",
 		 
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>New Account Creation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
//$num=mysql_num_rows(mysql_query("SELECT * FROM new_account_creation order by id DESC"));
 if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where support_id='$support_id' and approve_status=1 and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" where support_id='$support_id' and approve_status=1 ";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (support_id='$support_id' and support_comment!='' and final_status=0 and (sales_comment is null or acc_creation_status=2)) or (forward_req_user='".$_SESSION["user_name"]."' and forward_back_comment!='')";
 } 
 else
 { 
	  
	 $WhereQuery=" where (support_id='$support_id' and approve_status=1 and final_status!=1 and (support_comment is null or sales_comment!='') and acc_creation_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
	   
 }
 //$query = mysql_query("SELECT * FROM deactivation_of_account ". $WhereQuery."  order by id desc "); 
$query = select_query("SELECT * FROM new_account_creation ". $WhereQuery."   order by id DESC ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Company</th>
        <th>Potential</th>
        <th>Device Price</th>
        <th>Rent</th>
        <th>mode of payment</th>
        <th>Dimts Fee status</th>
        <th>Rent status</th>
        <th>Vehicle type</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <!--<tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 && $query[$i]["sales_comment"]=="" ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}?> >-->
      
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 && ($query[$i]["sales_comment"]=="" || $query[$i]["acc_creation_status"]==2)){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <?php
  if($query[$i][0]["account_manager"]=='reena') {
$account_manager=$query[$i]["sales_manager"]; 
}
else {
$account_manager=$query[$i]["account_manager"]; 
}
?>
        <td><?php echo $account_manager;?></td>
        <td><?php echo $query[$i]["company"];?></td>
        <td><?php echo $query[$i]["potential"];?></td>
        <?php
  if($query[$i]["mode_of_payment"]=="Cash") {
  $device_price=$query[$i]["device_price_total"];
  $device_rent=$query[$i]["DTotalREnt"];
  }
  else if($query[$i]["mode_of_payment"]=="Cheque") {
  $device_price=$query[$i]["device_price"];
  $device_rent=$query[$i]["device_rent_Price"];
  }
  ?>
        <td><?php echo $device_price;?></td>
        <td><?php echo $device_rent;?></td>
        <td><?php echo $query[$i]["mode_of_payment"];?></td>
        <td><?php echo $query[$i]["dimts_fee"];?>
        <td><?php echo $query[$i]["rent_status"];?>
        <td><?php echo $query[$i]["vehicle_type"];?> 
          <!--  <td><?php echo $query[$i]["billing_name"];?></td>
  <td><?php echo $query[$i]["billing_address"];?></td>
  <td><?php echo $query[$i]["device_rent_price"];?></td>
  <td><?php echo $query[$i]["device_rent_vat"];?></td>
  <td><?php echo $query[$i]["device_rent_total"];?></td>
  <td><?php echo $query[$i]["device_rent_rent"];?></td>
  <td><?php echo $query[$i]["device_rent_service_tax"];?></td>
  <td><?php echo $query[$i]["mode_of_payment"];?></td> --> 
          <!-- <td><?php echo $query[$i]["vehicle_type"];?></td> --> 
          <!-- <td><?php echo $query[$i]["immobilizer"];?></td>
  <td><?php echo $query[$i]["ac_on_off"];?></td>
  <td><?php echo $query[$i]["email_id"];?></td> 
  <td><?php echo $query[$i]["user_name"];?></td>
  <td><?php echo $query[$i]["user_password"];?></td> -->
        <td  style="width:200px"><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'new_account_creation','popup1'); " class="topopup">View Detail</a>
          <?php if( $_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2 ){?>
          | <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Done</a> | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <? 
 if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
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
