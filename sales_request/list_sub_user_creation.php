<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");*/

if($_SESSION['user_name']=='saleslogin' || $_SESSION['user_name']=='asaleslogin' || $_SESSION['user_name']=='jsaleslogin' || $_SESSION['user_name']=='msaleslogin' || $_SESSION['user_name']=='ksaleslogin') 
{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
}
else{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/
}


if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

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
		url:"userInfo.php?action=subusercreationbackComment",
 		 
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <a href="sub_user_creation.php" class="button">ADD NEW </a>
  <h1>Sub User Creation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#CFBF7E;font-weight:bold;">Brown:</font>Admin forward request</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
if($_POST["Showrequest"]==1)
 {
	   $WhereQuery=" where approve_status=1 and final_status=1 and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==2)
 {
	$WhereQuery=" where (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1 and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (sales_comment!='' or forward_back_comment!='') and final_status!=1 and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else
 { 
   $WhereQuery=" where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or sub_user_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))";
 }
  
$query = select_query("SELECT * FROM sub_user_creation  ". $WhereQuery."   order by id desc ");  

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Company</th>
        <th>Main User Id</th>
        <th>No Of Vehicles To Move</th>
        <!--  <th>Total No Of Vehicles</th> -->
        
        <th>Sub-Username</th>
        <!--  <th>Requested Sub User/Password</th>
            <th>Reg.No. of Vehicle To Move</th>
            <th>Billing Separete</th>
            <th>Billing Main User</th>
            <th>Reason</th> -->
        <th>Reason</th>
        <th>Current Status</th>
        <th>View Detail</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" && $query[$i]["approve_status"]!=1){ echo 'style="background-color:#CFBF7E"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}?> >
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
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["main_user_id"];
	$rowuser=select_query($sql);

			?>
        <td><?php echo $query[$i]["company"];?></td>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["no_vehicle_move"];?></td>
        <!--  <td><?php echo $query[$i]["tot_no_of_vehicles"];?></td> -->
        
        <td><?php echo $query[$i]["name"];?></td>
        <!-- <td><?php echo $query[$i]["req_sub_user_pass"];?></td>
  <td><?php echo $query[$i]["reg_no_of_vehicle_to_move"];?></td>
  <td><?php echo $query[$i]["billing_separate"];?></td>
  <td><?php echo $query[$i]["billing_main_user"];?></td>
  <td><?php echo $query[$i]["payment_status"];?></td> 
  <td><?php echo $query[$i]["reason"];?></td> -->
        <td><?php echo $query[$i]["reason"];?></td>
        <td><strong>
<?  if($query[0]["sub_user_status"]==2 || (($query[0]["support_comment"]!="" || $query[0]["admin_comment"]!="") && $query[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($query[0]["approve_status"]==0 && $query[0]["forward_req_user"]!="" && $query[0]["forward_back_comment"]=="" && $query[0]["sub_user_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$query[0]["forward_req_user"].")";}
    elseif($query[0]["approve_status"]==0 && $query[0]["final_status"]==0 && $query[0]["sub_user_status"]==1){echo "Pending Admin Approval";}
    elseif($query[0]["approve_status"]==1 && $query[0]["sub_user_status"]==1 && $query[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($query[0]["final_status"]==1){echo "Process Done";}?></strong></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'sub_user_creation','popup1'); " class="topopup">View Detail</a>
          <? 
if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"]){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }?></td>
        <td><?php 
if(( $query[$i]["support_comment"]!="" or $query[$i]["admin_comment"]!="") && $query[$i]["final_status"]!=1 ) {?>
          <a href="sub_user_creation.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a> 
          <!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>-->
          
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
