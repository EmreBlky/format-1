<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/
 
$group_id = $_SESSION['support_group_id'];

 $user_id = "";
 /*
 if($_SESSION['support_group_id'] == 9 && $_SESSION['ParentId'] == "3"){
	 $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId IN ('1','".$group_id."')");
 }
 else if($_SESSION['support_group_id'] != 9 && $_SESSION['ParentId'] == "3"){
 	$user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 }
 */
  // Login Change By Neeraj

 if($_SESSION['support_group_id'] == 12 && $_SESSION['ParentId'] == "3"){
   $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId IN ('1','".$group_id."')");
 }
 else if($_SESSION['support_group_id'] == 13 && $_SESSION['ParentId'] == "3"){
   $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 }
 else if($_SESSION['support_group_id'] == 14 && $_SESSION['ParentId'] == "3"){
   $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 }
 else if($_SESSION['support_group_id'] == 15 && $_SESSION['ParentId'] == "3"){
   $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 }
 else if ($_SESSION['support_group_id'] != 12 && $_SESSION['ParentId'] == "3"){
  $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 }

 // End Login Change

 //$user_query = mysql_query("SELECT id FROM matrix.users WHERE $branch AND id NOT IN(1,2143)");
 //while($user_data = mysql_fetch_array($user_query))
 for($u=0;$u<count($user_query);$u++)
 {
	 $user_id.= $user_query[$u]['Userid'].",";
 }
 $user = substr($user_id,0,-1); 

?>
<script>
 
function ConfirmPaymentClear(row_id)
{
  var x = confirm("IMEI Uploaded");
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
		url:"userInfo.php?action=Dimts_imeiPaymentClear",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}

function ConfirmPaymentPending(row_id)
{
   var retVal = prompt("IMEI Upload Pending : ", "Because Imei already exist ");
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
		url:"userInfo.php?action=Dimts_imeiPaymentPending",
 		 
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
		url:"userInfo.php?action=dimtsimeibackComment",
 		 
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
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Dimts Imei List</h1>
  <div style="float:right";><font style="color:#6BBBE7;font-weight:bold;">Red:</font> Back from Support</div>
  <br/>
  <div style="float:right";><font style="color:#93E95F;font-weight:bold;">Green:</font> IMEI Uploaded</div>
</div>
<div class="table">
  <?php
if($_POST["Showrequest"]==1)
 {
	  //$WhereQuery=" where support_comment='IMEI Uploaded'";
	   $WhereQuery=" where user_id IN($user) and support_comment!=''";
 }
 else if($_POST["Showrequest"]==2)
 {
	 //$WhereQuery=" where approve_status=1 ";
	  $WhereQuery="where user_id IN($user) ";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (user_id IN($user) and support_comment!='' and final_status=0 and (service_comment is null or dimts_status=2)) or (forward_req_user='".$_SESSION["user_name"]."' and forward_back_comment!='')";

 } 
 else
 { 
	  
	 $WhereQuery=" where (user_id IN($user) and (approve_status=1 or account_comment!='') and (support_comment IS NULL or service_comment!='') and dimts_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
	   
 }
   
$query = select_query("SELECT * FROM dimts_imei ". $WhereQuery."  order by id desc ");   

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
      <tr align="center" <? if($query[$i]["support_comment"]!=''){ echo 'style="background-color:#93E95F"';}elseif($query[$i]["imei_upload_reason"]!='' && $query[$i]["service_comment"]==''){ echo 'style="background-color:#6BBBE7"';}?> >
      
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
        <td style="230px"><a href="#" onClick="Show_record(<?php echo $query[$i]["id"];?>,'dimts_imei','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onClick="return ConfirmPaymentClear(<?php echo $query[$i]["id"];?>);"  >IMEI Uploaded</a> | <a href="#" onClick="return ConfirmPaymentPending(<?php echo $query[$i]["id"];?>);"  >IMEI Upload Pending</a>
          <? 
if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ ?>
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
