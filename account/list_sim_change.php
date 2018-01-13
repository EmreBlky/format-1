<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/
 
?>
<script>
/*function ConfirmApprove(row_id)
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
		url:"userInfo.php?action=sim_changeclose",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}
*/
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
	 //alert(row_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=accountSimchangeComment",
 		 
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
		url:"userInfo.php?action=simchangebackComment",
 		 
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
        <!--<option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>support Approved</option>-->
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="4" <?if($_POST['Showrequest']=='4'){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Mobile Number Change</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>support Approved</div>
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
	  $WhereQuery=" where final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" ";
 }
 /* else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1";
 }*/
  else if($_POST["Showrequest"]==4)
 {
	 //$WhereQuery=" where approve_status=1 and final_status!=1 and (account_comment!='' or forward_back_comment!='')";
	 $WhereQuery=" where account_comment!='' or forward_back_comment!=''";
 }
 else
 { 
	  
	/* $WhereQuery=" where (approve_status=0 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')";*/
	
	 $WhereQuery=" where (approve_status=1 and final_status!=1 and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";  
  
 }
 
$query = select_query("SELECT * FROM sim_change  ". $WhereQuery."    order by id DESC ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Client</th>
        <th>Vehicles No</th>
        <th>Device Mobile Number</th>
        <th>Oprator</th>
        <th>New SIM No</th>
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
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["total_pending"]!="" && $query[$i]["account_comment"]=="" && $query[$i]["service_comment"]==""){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1 && $query[$i]["close_date"]!=""){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["reg_no"];?></td>
        <td><?php echo $query[$i]["old_sim"];?></td>
        <td><?php $oprator_old = mssql_fetch_array(mssql_query("select operator from sim where phone_no like '%".trim($query[$i]["old_sim"])."%'")); echo $oprator_old["operator"];?></td>
        <td><?php echo $query[$i]["new_sim"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'sim_change','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <?php //if( $query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1 ){ ?>
          
          <!--| <a href="#" onclick="return ConfirmApprove(<?php echo $query[$i]["id"];?>);"  >Done</a>-->
          
          <? //}?>
          | <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Comment</a>
          <? 
    if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"] ){ ?>
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
