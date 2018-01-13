<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
 

?>
<script>
function repairComment(row_id)
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
		url:"userInfo.php?action=discount_addComment",
 		 
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
		url:"userInfo.php?action=discountingbackComment",
 		 
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Discounting List</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Account</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where approve_status=1 and final_status=1 and discount_issue='Repair Cost Issue'";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" where discount_issue='Repair Cost Issue' ";
 }
  else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1 and discount_issue='Repair Cost Issue'";
 }
  else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (repair_comment!='' or forward_back_comment!='') and approve_status=0";
 } 
 else
 { 
	  
   $WhereQuery=" where (approve_status=0 and discount_issue='Repair Cost Issue' and repair_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
  
 }
 
 

$query = select_query("SELECT * FROM discount_details  ". $WhereQuery."  order by id desc ");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Client</th>
        <th>Discounted Vehicle</th>
        <th>Discount Month/Device</th>
        <th>Amount Before discount</th>
        <th>Discount Amount</th>
        <th>Reason</th>
        <th>View Detail</th>
        <!--<th>Add Comments</th>--> 
        
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <?php /*?><? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["total_pending"]!="" && $query[$i]["account_comment"]=="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#FF0000"';} elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?><?php */?> >
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
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user"];
	$rowuser=select_query($sql);

			?>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["no_of_vehicle"];?></td>
        <? 
  if($query[$i]["rent_device"]=='Rent') {
  $Month_device=$query[$i]["mon_of_dis_in_case_of_rent"];
  }
  elseif($query[$i]["rent_device"]=='Device') {
  $Month_device='Device';
  }
  else {
  $Month_device='Repair Cost';
  }
  ?>
        <td><?php echo $Month_device;?></td>
        <td><?php echo $query[$i]["amt_before_dis"];?></td>
        <td bgcolor="#FF0000"><?php echo $query[$i]["dis_amt"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'discount_details','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onclick="return repairComment(<?php echo $query[$i]["id"];?>);">Add Comment</a>
          <? if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"] ){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
        <!--<td>-->
        <?php 
//if( $query[$i]["discount_issue"]=="Repair Cost Issue" ) {?>
        <!--<a href="discounting.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Add Comments</a>--> 
        <!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>-->
        <?php //} ?>
        <!--</td>--> 
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
