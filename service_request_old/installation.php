<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

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
		url:"userInfo.php?action=InstallationbackComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 // alert(msg);
		 
		location.reload(true);		
		}
	});
}

function doneConfirm(row_id)
{
  var x = confirm("Are you sure Client Confirm this installation?");
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
		url:"userInfo.php?action=InstallationConfirm",
 		data:"row_id="+row_id,
		success:function(msg){
			//alert(msg);
		location.reload(true);		
		}
	});
}

</script>

<div class="top-bar"> <a href="add_installation.php" class="button">ADD NEW </a>
  <h1>Installation Request</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#ADFF2F;font-weight:bold;">GreenYellow:</font> Urgent Installation</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Closed Installation</div>
  <br/>
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#EDA4FF;font-weight:bold;">LightBlue:</font> InterBranch Installation</div>
</div>
<div class="table">
  <? 
$fromdateof_service="";
$todaydate = date("Y-m-d  H:i:s");
$newdate = strtotime ( '-5 day' , strtotime ( $todaydate ) ) ;
$fromdateof_service = date ( 'Y-m-j H:i:s' , $newdate );

$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }
	
  if($mode=='close')
	{
	//$query = mysql_query("SELECT * FROM installation where reason!='' or rtime!='' and branch_id=".$_SESSION['BranchId']."  order by id desc");
	 
	$query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation where (installation_status='5' or installation_status='6') and time>'".$fromdateof_service."' and branch_id=".$_SESSION['BranchId']." and request_by='".$_SESSION['username']."' order by id desc ");
	}
	else if($mode=='new')
	{
	 
 	$query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation_request where  (installation_status ='1' or installation_status='2' or installation_status='4' or installation_status='7' or installation_status='8' or installation_status='9')   and branch_id=".$_SESSION['BranchId']."  and request_by='".$_SESSION['username']."'  order by id desc");
	}	

	?>
  <div style="float:right"><a href="installation.php?mode=new">New</a> | <a href="installation.php?mode=close">Closed</a></div>
  <?php
 

	
 

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>Sl. No</th>
        <th>Request By </th>
        <th>Request Date </th>
        <th><font color="#0E2C3C"><b>Sales Person </b></font></th>
        <th><font color="#0E2C3C"><b>Client</b></font></th>
        <th><font color="#0E2C3C"><b>No. Of Vehicle</b></font></th>
        <th><font color="#0E2C3C"><b>Location</b></font></th>
        <th><font color="#0E2C3C"><b>Model</b></font></th>
        <th><font color="#0E2C3C"><b>Time</b></font></th>
        <th><font color="#0E2C3C"><b>Installer Name</b></font></th>
        <th>View Detail</th>
        <? if($mode=='close')
	   {?>
        <th  ><font color="#0E2C3C"><b>Closed</b></font></th>
        <?}
		else
		{?>
        <th><font color="#0E2C3C"><b>Edit</b></font></th>
        <?}?>
      </tr>
    </thead>
    <tbody>
      <?php 
 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
	$sales=select_query("select name from sales_person where id='".$query[$i]['sales_person']."' ");
	 	
?>
      <!--<tr  <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#FF3333"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}?> >-->
      
      <tr <? if($query[$i]["approve_status"]==1 && $query[$i]["installation_status"]==9){ echo 'style="background-color:#B6B6B4"';}elseif($query[$i]['installation_status']==5 or $query[$i]['installation_status']==6 )  {  ?> style="background:#99FF66;" <? }elseif( $query[$i]["admin_comment"]!="" && ($query[$i]["sales_comment"]=="" || $query[$i]["installation_status"]==7)){ echo 'style="background-color:#F2F5A9"';}elseif($query[$i]['required']=='urgent'){ ?>style="background:#ADFF2F" <? }elseif($query[$i]['inter_branch']!=0){ ?>style="background:#EDA4FF" <? }?> >
        <td align="center"><?php echo $i+1;?></td>
        <td align="center">&nbsp;<?php echo $query[$i]['request_by'];?></td>
        <td>&nbsp;<?php echo $query[$i]['req_date'];?></td>
        <td align="center">&nbsp;<?php echo $sales[0]['name'];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
	$rowuser=select_query($sql);
	?>
        <td align="center"><?echo $rowuser[0]["sys_username"];?></td>
        <td align="center">&nbsp;<?php echo $query[$i]['no_of_vehicals'];?></td>
        <?php if($query[$i]['location']!=""){?>
        <td align="center">&nbsp;<?php echo $query[$i]['location'];?></td>
        <?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$query[$i]['inter_branch']."'");?>
        <td align="center">&nbsp;<?php echo $city[0]['city'];?></td>
        <?php }?>
        <td align="center">&nbsp;<?php echo $query[$i]['model'];?></td>
        <td align="center">&nbsp;<?php echo $query[$i]['time'];?></td>
        <td align="center">&nbsp;<?php echo $query[$i]['inst_name'];?></td>
        <td align="center"><? if($mode=='close') {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a>
          <? } else {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation_request','popup1'); " class="topopup">View Detail</a>
          <? } ?>
          <?php if($query[$i]["admin_comment"]!="" && ($query[$i]["sales_comment"]=="" || $query[$i]["installation_status"]==7)){?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php } 
                 if($query[$i]["installation_status"]==9 && $query[$i]["approve_status"]==1){?>
          | <a href="#" onclick="return doneConfirm(<?php echo $query[$i]["id"];?>);"  >Confirmation Done</a>
          <?php } ?></td>
        <? if($mode=='close')
	   {?>
        <td >Closed</td>
        <? }
		else
		{?>
        <td >&nbsp;
          <?php //if($query[$i]["approve_status"]!=1){?>
          
          <!-- <a href="add_installation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>-->
          
          <?php if($query[$i]["installation_status"]!= 2 ) {?>
          <a href="update_installation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>
          <?php }?></td>
        <?}?>
        
        <!--<td >&nbsp;<a href="installation.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>--> 
        
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
<?
include("../include/footer.php");

?>
