<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/  
?>
<script>
 
function BackComment(row_id)
{
  //var retVal = prompt("Write Comment : ", "Comment");
  var retVal = confirm("Are you sure you want to Close?");
  if (retVal){
      addComment(row_id,'Done');
      return ture;
  }
  else
    return false; 
}

function addComment(row_id,retVal)
{
  //alert(user_id);
   $.ajax({
    type:"GET",
    url:"userInfo.php?action=ForwardServiceDone",
     
     data:"row_id="+row_id+"&comment="+retVal,
    success:function(msg){
       alert(msg);
      location.reload(true);    
    }
  });
}

function DeviceRemoved(row_id)
{
  var retVal = confirm("Are you sure to Removed Device?");
  if (retVal){
      updateComment(row_id,'Device Removed');
      return ture;
  }
  else
    return false; 
}

function updateComment(row_id,retVal)
{
  //alert(user_id);
   $.ajax({
    type:"GET",
    url:"userInfo.php?action=ServiceDeviceRemoved",
     
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
      <select name="Showrequest" id="Showrequest" onchange="form.submit();">
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="3" <?if($_POST['Showrequest']==3){ echo "Selected" ;}?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Service List</h1>
  <div style="float:right";><font style="color:#ADFF2F;font-weight:bold;">GreenYellow:</font> Urgent Service</div>
  <br/>
  <div style="float:right";><font style="color:#CCCCCC;font-weight:bold;">Grey:</font> Closed Service</div>
</div>
<div class="table">
<!--   <?php
if($_POST["Showrequest"]==1)
 {
     $WhereQuery=" where (fwd_repair_id='".$_SESSION['userId']."' and (service_status='5' or service_status='6')) or((service_status='5' or service_status='6') and fwd_repair_to_serv is NOT NULL and fwd_tech_rm_id is NULL and fwd_repair_id is NULL)";
 }
 else if($_POST["Showrequest"]==2)
 {
    $WhereQuery="where fwd_repair_id='".$_SESSION['userId']."'";
 }
 else if($_POST["Showrequest"]==3)
 {
    $WhereQuery="where service_status='2' and fwd_repair_id='".$_SESSION['userId']."' and fwd_repair_to_serv is NOT NULL ";
 }
 else
 { 
   $WhereQuery=" where service_status='11' and fwd_repair_id='".$_SESSION['userId']."' and fwd_serv_to_repair is NOT NULL and fwd_repair_to_serv is NULL ";
  
 }
   
$query = select_query("SELECT * FROM services ". $WhereQuery."  order by id desc limit 1500");   

?> -->
 <?php
  //echo $_SESSION['userId']; die;
if($_SESSION['userId']==60)
{
    if($_POST["Showrequest"]==1)
   {
       // $WhereQuery=" where (fwd_repair_id='".$_SESSION['userId']."' and (service_status='5' or service_status='6')) or((service_status='5' or service_status='6') and fwd_repair_to_serv is NOT NULL and fwd_tech_rm_id is NULL and fwd_repair_id is NULL)";
     $WhereQuery=" where (fwd_repair_id in (29,58,59,60,61,62,63,64) and (service_status='5' or service_status='6')) or((service_status='5' or service_status='6') and fwd_repair_to_serv is NOT NULL and fwd_tech_rm_id is NULL and fwd_repair_id is NULL)";
   }
   else if($_POST["Showrequest"]==2)
   {
      //$WhereQuery="where fwd_repair_id='".$_SESSION['userId']."'";
     $WhereQuery="where fwd_repair_id in (29,58,59,60,61,62,63,64)";
   }
   else if($_POST["Showrequest"]==3)
   {
      // $WhereQuery="where service_status='2' and fwd_repair_id='".$_SESSION['userId']."' and fwd_repair_to_serv is NOT NULL ";
    $WhereQuery="where service_status='2' and fwd_repair_id in (29,58,59,60,61,62,63,64) and fwd_repair_to_serv is NOT NULL ";
   }
   else
   { 
     // $WhereQuery=" where service_status='11' and fwd_repair_id='".$_SESSION['userId']."' and fwd_serv_to_repair is NOT NULL and fwd_repair_to_serv is NULL ";
     $WhereQuery=" where service_status='11' and fwd_repair_id in (29,58,59,60,61,62,63,64) and fwd_serv_to_repair is NOT NULL and fwd_repair_to_serv is NULL ";
    
   }
}
else
{
   if($_POST["Showrequest"]==1)
   {
       $WhereQuery=" where (fwd_repair_id='".$_SESSION['userId']."' and (service_status='5' or service_status='6')) or((service_status='5' or service_status='6') and fwd_repair_to_serv is NOT NULL and fwd_tech_rm_id is NULL and fwd_repair_id is NULL)";

   }
   else if($_POST["Showrequest"]==2)
   {
      $WhereQuery="where fwd_repair_id='".$_SESSION['userId']."'";
    
   }
   else if($_POST["Showrequest"]==3)
   {
      $WhereQuery="where service_status='2' and fwd_repair_id='".$_SESSION['userId']."' and fwd_repair_to_serv is NOT NULL ";

   }
   else
   { 
     $WhereQuery=" where service_status='11' and fwd_repair_id='".$_SESSION['userId']."' and fwd_serv_to_repair is NOT NULL and fwd_repair_to_serv is NULL ";
    
    
   }
}
   //echo "SELECT * FROM services ". $WhereQuery."  order by id desc limit 1500"; die;
$query = select_query("SELECT * FROM services ". $WhereQuery."  order by id desc limit 1500");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th><font color="#0E2C3C"><b>Sl. No</b></font></th>
        <th><font color="#0E2C3C"><b>Request Date </b></font></th>
        <th><font color="#0E2C3C"><b>Client Name </b></font></th>
        <th><font color="#0E2C3C"><b>Vehicle No <br/>
          (IP Box/ Required)</b></font></th>
        <th><font color="#0E2C3C"><b>Device IMEI</b></font></th>
        <th><font color="#0E2C3C"><b>Notworking </b></font></th>
        <th><font color="#0E2C3C"><b>Location</b></font></th>
        <th><font color="#0E2C3C"><b>Available Time</b></font></th>
        <th><font color="#0E2C3C"><b>Installer Name</b></font></th>
        <!--<th><font color="#0E2C3C"><b>Support Comment</b></font></th>-->
        <th><font color="#0E2C3C"><b>Dispatch Comment</b></font></th>
        <th><font color="#0E2C3C"><b>R&amp;D Comment</b></font></th>
        <th><font color="#0E2C3C"><b>View Detail</b></font></th>
        <th><font color="#0E2C3C"><b>Forward</b></font></th>
      </tr>
    </thead>
    <tbody>
      <?php 
  
    //while ($row = mysql_fetch_array($rs)) 
  for($i=0;$i<count($query);$i++)
  {
    if($query[$i]['IP_Box']==""){ $ip_box="Not Required";}  else { $ip_box = $query[$i]['IP_Box']; }; 
  
    ?>
      

      <tr align="Center"   <? if($query[$i]['service_status']==5 or $query[$i]['service_status']==6 )  {  ?> style="background:#CCCCCC;" <? }
  else  if($query[$i]['required']=='urgent'){ ?>style="background:#ADFF2F" <? } ?>>
        <td><?php echo $i+1; ?></td>
        
        <td>&nbsp;<?php echo $query[$i]['req_date'];?></td>
        <td>&nbsp;<?php echo $query[$i]['name'];?></td>
        <td>&nbsp;<?php echo $query[$i]['veh_reg']." <br/><br/>(".$ip_box.")";?></span></td>
        <td>&nbsp;<?php echo  $query[$i]['device_imei'] ?></td>
        <td>&nbsp;<?php echo  $query[$i]['Notwoking'] ?></td>
        <?php if($query[$i]['location']!=""){?>
        <td>&nbsp;<?php echo $query[$i]['location'];?></td>
        <?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$query[$i]['inter_branch']."'");?>
        <td>&nbsp;<?php echo $city[0]['city'];?></td>
        <?php }?>
        <td>&nbsp;<?php echo $query[$i]['atime'] ;?></td>
        <td  style="font-size:12px">&nbsp;<strong><?php echo $query[$i]['inst_name'];
    if($query[$i]['job_type']==2)
    {
      echo "<br/><font color='red'>(pending Job)</font>";
    }
    else
    {
      echo "<br/>(Ongoing Job)";
    }
    ?> </strong></td>        
         <td>&nbsp;<?php if($query[$i]['fwd_serv_to_repair'] != "" && $query[$i]['fwd_repair_id'] != "") {
          echo $query[$i]['fwd_repair_date'].' - '.$query[$i]['fwd_serv_to_repair']; 
        }?></td>
        <td><?php if($query[$i]['fwd_reason'] != "" && $query[$i]['fwd_tech_rm_id'] != "") { 
          echo $query[$i]['fwd_datetime'].' - '.$query[$i]['fwd_reason'];
        } ?>
        </td>
       <!-- <td>&nbsp;<?php if($query[$i]['fwd_repair_to_serv'] != "" && $query[$i]['fwd_done_time'] != "") { 
              echo $query[$i]['fwd_done_time'].' - '.$query[$i]['fwd_repair_to_serv'];
          } else { echo $query[$i]['fwd_repair_to_serv']; }?>
        </td>-->
        
        
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'services','popup1'); " class="topopup">View</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2 && $_POST["Showrequest"]!=3){?>
          |<a href="#" onclick="return BackComment(<?php echo $query[$i]["id"];?>);">Action</a>
          |<a href="#" onclick="return DeviceRemoved(<?php echo $query[$i]["id"];?>);">Device Removed</a>
          <?php } ?></td>
        <td>
        <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2 && $_POST["Showrequest"]!=3){?>
        <a href="forward_iframe.php?id=<?=$query[$i]["id"];?>&req_id=1&height=220&width=480" class="thickbox">Forward</a>
         <?php } ?>
        </td>
      </tr>
      <?php  
      }
   
    ?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1" style ="height:100%;width:100%"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?
include("../include/footer.inc.php");

?>
