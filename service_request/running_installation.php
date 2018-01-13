<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");*/

 if(isset($_GET["for"]) && $_GET["for"]=='formatrequest')
 {
	 $pagefor="for=formatrequest";
	 include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
	 /*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
 }
 else
 { 
 	$pagefor="";
	 include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
	 /*include($_SERVER['DOCUMENT_ROOT']."/service/include/leftmenu.php");*/ 
 }


$id=$_GET['id'];
?>
<script type="text/javascript">
/*function ConfirmReactivate(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addreasonComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addreasonComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=InstallationClosed",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			// alert(msg);
		 
		location.reload(true);		
		}
	});
}*/
</script>

<div class="top-bar">
  <h1>Running Installation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#ADFF2F;font-weight:bold;">GreenYellow:</font> Urgent Installation</div>
  <br/>
  <div style="float:right";><font style="color:#EDA4FF;font-weight:bold;">LightBlue:</font> InterBranch Installation</div>
  <br/>
</div>
<div class="table">
  <?php
 
	
	//1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose,7-New request,8-show admin,9-Again Confirmation,11-forwardtorepair,15-pending installation
	$query = select_query("SELECT * FROM installation where installation_status IN ('1','2','11') AND (inter_branch='".$_SESSION['BranchId']."' OR branch_id='".$_SESSION['BranchId']."') and request_by='".$_SESSION['username']."' order by id desc");
 

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th nowrap>Job Type</th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Sales Person </b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>ClientName </b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>No.Of Vehicle </b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>time </b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle Type </b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact Person</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Installer Name</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Current Status</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>View Detail</b></font></th>
        <!--<th width="11%" align="center"><font color="#0E2C3C"><b>Edit</b></font></th>--> 
        
      </tr>
    </thead>
    <tbody>
      <?php 
 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if($query[$i]['inter_branch']!=0) {?> style="background:#EDA4FF;" <? }else if($query[$i]['required']=='urgent'){ ?>style="background:#ADFF2F" <? }?>>
        <td width="1%" align="center">
          <?php 
       
          $sql1 = select_query("select instal_reinstall from installation_request WHERE id='".$query[$i]['id']."'");

          if($query[$i]['instal_reinstall'] == "installation"){ echo "I";}elseif($query[$i]['instal_reinstall'] == "re_install"){ echo "Re-Add";}elseif($query[$i]['instal_reinstall'] == "crack"){ echo "C";}elseif($query[$i]['instal_reinstall'] == "online_crack"){ echo "OC";}
          
          ?>
        </td>
        <td width="11%" align="center">&nbsp;
          <?php $sales=select_query("select name from sales_person where id='".$query[$i]['sales_person']."' "); echo $sales[0]['name'];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
	$rowuser=select_query($sql);
	?>
        <td><? echo $rowuser[0]["sys_username"];?></td>
        <td width="11%" align="center">&nbsp;<?php echo '1';?></td>
        <?php if($query[$i]['location']!=""){?>
        <td align="center">&nbsp;<?php echo $query[$i]['location'];?></td>
        <?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$query[$i]['inter_branch']."'");?>
        <!-- <td align="center">&nbsp;<?php echo $city[0]['city'];?></td> -->

          <td align="center" width="1%">
          <?php
          $sql5 = select_query("select landmark from installation WHERE id='".$query[$i]['id']."'");

          $wraplandmark = wordwrap($sql5[0]['landmark'], 8, "\n", true);

          echo "$wraplandmark\n";
          ?>

        </td>
        <?php }?>
<!--         <td width="10%" align="center">&nbsp;<?php echo $query[$i]['model'];?></td> -->
  <td width="1%" align="center" nowrap>
        <?php 
        

          if($query[$i]['instal_reinstall'] == 're_install')
          {
            echo $query[$i]['device_status']."<br>".$query[$i]['device_current_location'];
          }
          else{
           //echo "SELECT item_name FROM item_master where item_id=='".$query[$i]["model"]."'";die;
            $sqlDevice=select_query("SELECT item_name FROM item_master where item_id='".$query[$i]["model_parent"]."'");
            $sqlModel=select_query("SELECT item_name FROM item_master where item_id='".$query[$i]["model"]."'");
        
             echo $sqlModel[0]['item_name']."<br>".$sqlDevice[0]['item_name'];
          
          }
      
          ?>
        </td>
        <td width="12%" align="center">&nbsp;<?php echo $query[$i]['time'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $query[$i]['veh_type'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $query[$i]['contact_number'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $query[$i]['contact_person'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $query[$i]['inst_name'];?></td>
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
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a> 
          <!--| <a href="#" onclick="return ConfirmReactivate(<?php echo $query[$i]["id"];?>);" >Closed</a>--></td>
        
        <!--<td width="10%" align="center">&nbsp;<a href="update_installation.php?id=<?=$query[$i]['id'];?>&pending=1&action=edit">Edit</a></td>--> 
        
      </tr>
      <?php   }?>
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
