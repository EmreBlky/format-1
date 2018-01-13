<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support_admin.php');

?>
<script>
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
		url:"userInfo.php?action=new_device_additionadminComment",
 		 
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
        <!--<option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="3" <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Action Taken</option>-->
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected"; }?>>Forwarded Request</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>New Device Addition List</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
  if($_POST["Showrequest"]==1)
 {
	  $WhereQuery="Where acc_manager!='triloki'";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" where forward_req_user!='' and forward_comment!='' and acc_manager!='triloki'";
 }
 else
 { 
	 $WhereQuery=" where final_status=1 and acc_manager!='triloki' and (forward_req_user is null or forward_back_comment!='')";
 }
 
$query = select_query("SELECT * FROM new_device_addition  ". $WhereQuery."   order by date DESC limit 2000");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Sales Manager</th>
        <th>Client</th>
        <th>Vehicles No</th>
        <th>IMEI</th>
        <th>Device Type</th>
        <th>Dimts</th>
        <th>Billing</th>
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
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 && $query[$i]["service_comment"]==""){ echo 'style="background-color:#F2F5A9"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["sales_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["vehicle_no"];?></td>
        <td><?php echo $query[$i]["device_imei"];?></td>
        <td><?php echo $query[$i]["device_type"];?></td>
        <td><?php echo $query[$i]["dimts"];?></td>
        <? /*if($query[$i]["device_type"]=='New'){
$billing_status=$query[$i]["billing"];
}
else{
$billing_status=$query[$i]["billing_if_old_device"];
}*/
	?>
        <td><?php echo $query[$i]["billing"]; ?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'new_device_addition','popup1'); " class="topopup">View Detail</a>
          <?php //if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          
          <!--| <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>-->
          
          <?php //} ?></td>
        <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <a href="forwardrequest-iframe.php?id=<?= $query[$i]["id"]?>&req_id=2&height=220&width=330" class="thickbox"  >Froward Request</a>
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
