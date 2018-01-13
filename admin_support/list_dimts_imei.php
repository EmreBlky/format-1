<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/
?>
<script>
function ConfirmDelete(row_id)
{
  var x = confirm("Are you sure you want to Approve?");
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
		url:"userInfo.php?action=dimts_imeiapprove",
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
		url:"userInfo.php?action=dimts_imeiadminComment",
 		 
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
      <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Approved</option>
      <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
      <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
      <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
      <option value="6" <?if($_POST['Showrequest']==6){ echo "Selected"; }?>>Forwarded Request</option>
      <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
    </select>
  </form>
</div>
<h1>Dimts Slip List</h1>
<div style="float:right";><font style="color:#DA8954;font-weight:bold;">Brown:</font> Port changed</div>
<br/>
<div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Payemnt Cleared</div>
<br/>
<div style="float:right";><font style="color:#DDE362;font-weight:bold;">Yellow:</font> IEMI Uploaded</div>
<br/>
<div style="float:right";><font style="color:#A4B0EC;font-weight:bold;">Blue:</font> Dimts Slip Done</div>
<div class="table">
  <?php
				   
  if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where approve_status=1 and final_status=1 and acc_manager!='triloki'";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery="where acc_manager!='triloki'";
 }
 else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status=0 and service_comment is null and acc_manager!='triloki'";
 }
  else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where admin_comment!='' and dimts_status=2 and acc_manager!='triloki'";
 }
 else if($_POST["Showrequest"]==6)
 {
	 $WhereQuery=" where approve_status=0  and forward_req_user!='' and forward_comment!='' and acc_manager!='triloki'";
 }
 else
 { 
	 $WhereQuery=" where approve_status=0 and acc_manager!='triloki' and (payment_status!='') and (admin_comment is null or service_comment!='') and dimts_status=1 and (forward_req_user is null or forward_back_comment!='')";
  
 }
$query = select_query("SELECT * FROM dimts_imei ". $WhereQuery."   order by id desc ");   

?>
  </p>
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
        <th>Forward Request</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      
      <!--<tr align="center" <? //if($query[$i]["final_status"]==1){ echo 'style="background-color:#A4B0EC"';}elseif($query[$i]["account_comment"]=='Payment cleared'){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["payment_status"]!=''){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["repair_comment"]=='Port Changed'){ echo 'style="background-color:#DA8954"';}elseif($query[$i]["port_change_reason"]!=''){ echo 'style="background-color:#6BBBE7"';}elseif($query[$i]["support_comment"]=='IMEI Uploaded'){ echo 'style="background-color:#DDE362"';}elseif($query[$i]["imei_upload_reason"]!=''){ echo 'style="background-color:#C0C0C0"';} ?> >-->
      <tr align="center" <? if($query[$i]["final_status"]==1){ echo 'style="background-color:#A4B0EC"';}elseif($query[$i]["account_comment"]=='Payment cleared'){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["repair_comment"]=='Port Changed'){ echo 'style="background-color:#DA8954"';}elseif($query[$i]["port_change_reason"]!=''){ echo 'style="background-color:#6BBBE7"';}elseif($query[$i]["support_comment"]=='IMEI Uploaded'){ echo 'style="background-color:#DDE362"';}elseif($query[$i]["imei_upload_reason"]!=''){ echo 'style="background-color:#C0C0C0"';} ?> >
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
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'dimts_imei','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          |
          <? if($query[$i]["approve_status"]==1){?>
          Approved
          <?}else{?>
          <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Approve</a>
          <?}?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php } ?></td>
        <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <a href="forwardrequest-iframe.php?id=<?= $query[$i]["id"]?>&req_id=8&height=220&width=330" class="thickbox"  >Froward Request</a>
          <?php } ?></td>
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
