<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/

?>
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
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Dimts Imei List</h1>
  <div style="float:right";><font style="color:#6BBBE7;font-weight:bold;">Blue:</font> Back from Repair</div>
  <br/>
  <div style="float:right";><font style="color:#DA8954;font-weight:bold;">Brown:</font> Port changed</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Account</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Payemnt Cleared</div>
  <br/>
  <div style="float:right";><font style="color:#DDE362;font-weight:bold;">Yellow:</font> IEMI Uploaded</div>
  <br/>
  <div style="float:right";><font style="color:#CFBF7E;font-weight:bold;">Brown:</font>Admin forward request</div>
  <br/>
  <div style="float:right";><font style="color:#C0C0C0;font-weight:bold;">Pink:</font> IEMI Not Uploaded</div>
</div>
<div class="table">
  <?php
 if($_POST["Showrequest"]==1)
 {
	   $WhereQuery=" where approve_status=1 and final_status=1 and sales_manager='".$_SESSION['user_name']."'";
 }
 else if($_POST["Showrequest"]==2)
 {
	$WhereQuery=" where sales_manager='".$_SESSION['user_name']."'";
 }
 else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and close_date is null and sales_manager='".$_SESSION['user_name']."'";
 }
 else
 { 
   $WhereQuery=" where (approve_status=0 or approve_status=2) and sales_manager='".$_SESSION['user_name']."'";
 }
  
$query = select_query("SELECT * FROM dimts_imei  ". $WhereQuery."   order by id desc ");  

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
      </tr>
    </thead>
    <tbody>
      <?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if($query[$i]["account_comment"]!=''){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["payment_status"]!=''){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["repair_comment"]!=''){ echo 'style="background-color:#DA8954"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ echo 'style="background-color:#CFBF7E"';}elseif($query[$i]["port_change_reason"]!=''){ echo 'style="background-color:#6BBBE7"';}elseif($query[$i]["support_comment"]!=''){ echo 'style="background-color:#DDE362"';}elseif($query[$i]["imei_upload_reason"]!=''){ echo 'style="background-color:#C0C0C0"';}?> >
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
          <? 
if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"]){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }?></td>
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