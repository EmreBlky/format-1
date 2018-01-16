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
$.ajax({
    type:"GET",
    url:"userInfo.php?action=InstallationbackComment",
    data:"row_id="+row_id+"&comment="+retVal,
    success:function(msg){
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
      return true;
  }
  else
    return false;
}

function approve(row_id)
{
 // alert(row_id);
$.ajax({
    type:"GET",
    url:"userInfo.php?action=InstallationConfirm",
    data:"row_id="+row_id,
    success:function(msg){
     // alert("Request Confirmed");
      location.reload(true);    
    }
  });
}

</script>
<style>
thead{
  display:table;
  width:100%;
  width:calc(100% - 20px);
}
tbody {
  height:400px;
  overflow:auto;
  overflow-x:hidden;
  display:block;
}
tbody tr {
  display:table;
  width:100%;
  table-layout:fixed;
}
</style>
<div class="top-bar">
  
  <h1>Installation Request</h1>
  <div style="margin-left:796px;font-size:12px;">
    <a href="add_installation.php">Installation</a> || 
    <a href="re_installation.php">Re-Addition</a> || 
    <!-- <a href="add_installation.php">Crack</a> ||  -->
    <a href="online_crack.php">Online-Crack</a>
  </div>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#e5e50d;font-weight:bold;">GreenYellow:</font> Urgent Installation</div>
  <br/>
  <div style="float:right";><font style="color:#f9f500;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Closed Installation</div>
  <br/>
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#EDA4FF;font-weight:bold;">LightBlue:</font> InterBranch Installation</div>
  <br/>
  <div style="float:right";><font style="color:#ff9bc8;font-weight:bold;">Pink:</font> Pending Installtion</div>
</div>
<div class="table">
<?php 
$fromdateof_service="";
$todaydate = date("Y-m-d  H:i:s");
$newdate = strtotime ( '-5 day' , strtotime ( $todaydate ) ) ;
$fromdateof_service = date ( 'Y-m-j H:i:s' , $newdate );
$PendingDateService = date('Y-m-d', strtotime("-4 days"));
$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }
  
  if($mode=='close')
  {
    $query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation where (installation_status='5' or installation_status='6') and time>'".$fromdateof_service."' and branch_id=".$_SESSION['BranchId']." and request_by='".$_SESSION['username']."' order by id desc");
  }
  else if($mode=='new')
  {
   
  $query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation_request where  (installation_status ='1' or installation_status='2' or installation_status='4' or installation_status='7' or installation_status='8' or installation_status='9' or installation_status='3')   and branch_id=".$_SESSION['BranchId']."  and request_by='".$_SESSION['username']."'  order by id desc");
  } 
  //echo '<pre>'; print_r($query); die;
  ?>
  <div style="float:right"><a href="installation.php?mode=new">New</a> | <a href="installation.php?mode=close">Closed</a></div>
  <?php
 
?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th nowrap>Job Type</th>
        <th>Request By </th>
        <th>Request Date </th>
        <th><font color="#0E2C3C"><b>Sales Person </b></font></th>
        <th><font color="#0E2C3C"><b>Client</b></font></th>
        <th><font color="#0E2C3C"><b>No. Of Vehicle</b></font></th>
        <th><font color="#0E2C3C"><b>Approve Install</b></font></th>
        <th><font color="#0E2C3C"><b>Branch</b></font></th>
        <th><font color="#0E2C3C"><b>Branch Location</b></font></th>
        <th><font color="#0E2C3C"><b>Landmark</b></font></th>
        <th><font color="#0E2C3C"><b>Device Type/Model</b></font></th> 
        <th><font color="#0E2C3C"><b>Accessories</b></font></th>
        <th><font color="#0E2C3C"><b>A-Time</b></font></th>
        <th><font color="#0E2C3C"><b>Contact Details</b></font></th>
        <th><font color="#0E2C3C"><b>Current Status</b></font></th>
        <th>View Detail</th>
        <?php if($mode=='close')
     {?>
        <th  ><font color="#0E2C3C"><b>Closed</b></font></th>
        <?php }
    else
    {?>
        <th><font color="#0E2C3C"><b>Edit</b></font></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php 
 
for($i=0;$i<count($query);$i++)
{
  $date1=date_create(date("Y-m-d"));
  $date2=date_create(date("Y-m-d",strtotime($query[$i]['req_date'])));
  $diff=date_diff($date2,$date1);

  $sales=select_query("select name from sales_person where id='".$query[$i]['sales_person']."' ");

?>
      <tr <?php if($diff->format("%a") > 5) { echo 'style="background-color:#ff9bc8"';} else{if($query[$i]["approve_status"]==1 && $query[$i]["installation_status"]==9){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]['installation_status']==5 or $query[$i]['installation_status']==6 )  {  ?> style="background:#99FF66;" <?php }elseif( $query[$i]["admin_comment"]!="" && ($query[$i]["sales_comment"]=="" || $query[$i]["installation_status"]==7)){ echo 'style="background-color:#F2F5A9"';}elseif($query[$i]['required']=='urgent'){ if($PendingSql[$i]["req_date"] == $query[$i]['req_date']){ ?> style="background:#ff9bc8" <?php } else{ ?> style="background:#ADFF2F" <?php } }elseif($query[$i]['inter_branch']!=0){ ?>style="background:#EDA4FF" <?php }elseif($PendingSql[$i]["req_date"] == $query[$i]['req_date']){ ?>style="background:#ff9bc8" <?php }} ?>>
        <td width="1%" align="center">
          <?php 
       
          $sql1 = select_query("select instal_reinstall from installation_request WHERE id='".$query[$i]['id']."'");

          if($query[$i]['instal_reinstall'] == "installation"){ echo "I";}elseif($query[$i]['instal_reinstall'] == "re_install"){ echo "Re-Add";}elseif($query[$i]['instal_reinstall'] == "crack"){ echo "C";}elseif($query[$i]['instal_reinstall'] == "online_crack"){ echo "OC";}
          
          ?>
        </td>
        <td width="1%" align="center">&nbsp;<?php echo $query[$i]['request_by'];?></td>
        <td width="1%" nowrap> &nbsp;
          <?php 

          echo date("Y-m-d",strtotime($query[$i]['req_date']))."<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo date("G:i",strtotime($query[$i]['req_date']));

          ?>
        </td>
        <td width="1%" align="center">&nbsp;<?php echo $sales[0]['name'];?></td>
        <?php 
          $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
          $rowuser=select_query($sql);

          //print_r($rowuser);die();
        ?>
        <td width="1%" align="center"><?echo $rowuser[0]["sys_username"];?></td>
        <td width="1%" align="center">&nbsp;<?php echo $query[$i]['no_of_vehicals'];?></td>
        <td width="1%" align="center">&nbsp;
          <?php 
            if(($query[$i]['instal_reinstall'] == 're_install') || ($query[$i]['instal_reinstall'] == 'online_crack')){
              echo "Not Required";
            }
            else{
              echo $query[$i]['installation_approve'];
            }
          ?>
        </td>
        <?php if($query[$i]['location']!=""){?>
        <td width="1%" align="center">&nbsp;<?php echo $query[$i]['location'];?></td>
        <?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$query[$i]['inter_branch']."'");?>
        <td width="1%" align="center">



          &nbsp;<?php echo $city[0]['city'];

          $wrapcity = wordwrap($city[0]['city'], 8, "\n", true);

          echo "$wrapcity\n";
          
          ?>


        </td>
        <?php }?>
        <td width="1%">&nbsp;
          <?php 
          $sql1 = select_query("select Zone_area from installation_request WHERE id='".$query[$i]['id']."'");
          $sql2 = select_query("SELECT name FROM re_city_spr_1 WHERE id='".$sql1[0]['Zone_area']."'");

          echo $sql2[0]['name'];
          
          ?>
        </td>
        <td align="center" width="1%">
          <?php
          $sql5 = select_query("select landmark from installation_request WHERE id='".$query[$i]['id']."'");

          $wraplandmark = wordwrap($sql5[0]['landmark'], 8, "\n", true);

          echo "$wraplandmark\n";
          ?>

        </td>
        <td width="1%" align="center" nowrap>
        <?php 
        

          if($query[$i]['instal_reinstall'] == 're_install'){
            echo $query[$i]['device_status']."<br>".$query[$i]['device_current_location'];
          }
          else{

            $sqlDevice=select_query("SELECT item_name FROM item_master where item_id='".$query[$i]["model_parent"]."'");
            $sqlModel=select_query("select im.* from installation_request ir left join item_master im on ir.model=im.item_id where ir.model='".$query[$i]["model"]."'");
        
            echo $sqlModel[0]['item_name']."<br>".$sqlDevice[0]['item_name'];
          
          }
      
          ?>
        </td>
  
        <td width="1%" align="center">
          <?php

          echo $query[$i]['accessories_tollkit'] == '' ? "no" : "yes";

          ?>

        </td>
        <td width="1%" align="center" nowrap>

          <?php 
            echo date("Y-m-d",strtotime($query[$i]['time']))."<br>";
            echo date("G:i",strtotime($query[$i]['time']))."<br>";

            $sql4 = select_query("select atime_status from installation_request WHERE id='".$query[$i]['id']."'");

            echo $sql4[0]['atime_status'];
          ?>

        </td>
        <td width="1%">
          <?php
              $sql6 = select_query("select designation,contact_person,contact_number from installation_request WHERE id='".$query[$i]['id']."'");

              $wrapContactPerson = wordwrap($sql6[0]['contact_person'], 10, "\n", true);

              echo "$wrapContactPerson\n";
              echo $sql6[0]['contact_number']."<br>";
              echo "&#160;&#160;&#160;&#160;".$sql6[0]['designation']."<br>";
          ?>

        </td>


<td width="1%" align="center">
         <b><?  if($query[$i]["installation_status"]==7 && ($query[$i]["admin_comment"]!="" || $query[$i]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
       elseif($query[$i]["installation_status"]==7 && $query[$i]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
       elseif($query[$i]["approve_status"]==0 && $query[$i]["installation_status"]==8 ){echo "Pending Admin Approval";}
       elseif($query[$i]["installation_status"]==9 && $query[$i]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
       elseif($query[$i]["installation_status"]==1 ){echo "Pending Dispatch Team";}
       elseif($query[$i]["installation_status"]==2 ){echo "Assign To Installer";}
       elseif($query[$i]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
       elseif($query[$i]["installation_status"]==3 ){echo "Back Installation";}
       elseif($query[$i]["installation_status"]==15 ){echo "Pending Remaining Installation";}
       elseif($query[$i]["installation_status"]==5 || $query[$i]["installation_status"]==6){echo "Installation Close";}?></b>

       </td>
        <td width="1%" align="center" nowrap><?php if($mode=='close') {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a>
          <?php } else {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation_request','popup1'); " class="topopup">View Detail</a>
          <?php } ?>
          <?php if($query[$i]["admin_comment"]!="" && ($query[$i]["sales_comment"]=="" || $query[$i]["installation_status"]==7)){?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php } 
                 if($query[$i]["installation_status"]==9 && $query[$i]["approve_status"]==1){?>
          | <a href="#" onclick="return doneConfirm(<?php echo $query[$i]["id"];?>);"  >Confirmation Done</a>
          <?php } ?></td>
        <?php if($mode=='close')
     {?>
        <td >Closed</td>
        <?php }
    else
    { ?>
        <td width="1%">&nbsp;
          <?php //if($query[$i]["approve_status"]!=1){?>
          
          <!-- <a href="add_installation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>-->
          
          

        <?php if(($query[$i]["installation_status"] == 8) || ($query[$i]["installation_status"] == 3))
          {
              if($query[$i]["instal_reinstall"]=='installation') 
                {?>

              <a href="update_installation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>
              <?php
              } 
              if($query[$i]["instal_reinstall"]=='online_crack' ) 
                {?>

              <a href="update_online_crack.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>
              <?php
              }
              if($query[$i]["instal_reinstall"]=='re_install' ) 
                {?>

              <a href="update_reinstallation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>
              <?php
              }
               if($query[$i]["instal_reinstall"]=='crack' ) 
                {?>

              <a href="update_installation.php?id=<?=$query[$i]['id'];?>&action=edit">Edit</a>
              <?php
              }
            
          }
           
             ?>
             
 



        
        <!--<td >&nbsp;<a href="installation.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>--> 
        
      </tr>
      <?php  } }?>
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

include("../include/footer.php");

?>