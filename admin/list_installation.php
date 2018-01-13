<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/

?>
<script>
// function ConfirmDelete(row_id,branchId,deviceType,deviceModel,noOfVehicle)
// {
//   //alert(deviceModel)
//    var retVal1 = prompt("No. of Approve Device : ", "Enter Digits Only");
	
// 	if (retVal1)
// 	{
// 		if (retVal1 >= 0 && retVal1 != "")
// 		{
// 			addComment1(row_id,retVal1,branchId,deviceType,deviceModel,noOfVehicle);
// 			return true;
// 		}
// 		else
// 		{
// 			 alert("Please Enter Digits Only");
// 			 false;
// 		}
// 	}
// 	else
// 	{
// 		//alert("Please Enter Digits Only");
// 		return false;
// 	}
// }

// function addComment1(row_id,retVal1,branchId,deviceType,deviceModel,noOfVehicle)
// {
// alert('tt');
// $.ajax({
// 		type:"GET",
// 		url:"userInfo.php?action=Installationapprove",
// 		data:"row_id="+row_id+"&comment="+retVal1+"&branch_id="+branchId+"&deviceType="+deviceType+"&deviceModel="+deviceModel+"&noOfVehicle="+noOfVehicle,
// 		success:function(msg){
//       alert(msg);
//       // if(msg == ""){}
//       // else{ alert(msg) }
// 			location.reload(true);		
// 		}
// 	});
// }

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
		url:"userInfo.php?action=InstallationadminComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			  //alert(msg);
		 
		location.reload(true);		
		}
	});
}
</script>
<style type="text/css">
/*body2 {
  font-family: Arial, sans-serif;
  background: #ddd;
}

h12 {
  text-align: center;
  font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
  color: #333;
  text-shadow: 0 1px 0 #fff;
  margin: 50px 0;
}

#wrapper2 {
  width: 100px;
  margin: 0 auto;
  background: #fff;
  padding: 20px;
  border: 10px solid #aaa;
  border-radius: 15px;
  background-clip: padding-box;
  text-align: center;
}

.button2 {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 13px;
  padding: 5px 10px;
  border: 1px solid #aaa;
  background-color: #eee;
  background-image: linear-gradient(top, #fff, #f0f0f0);
  border-radius: 2px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.15);
  color: #666;
  text-decoration: none;
  text-shadow: 0 1px 0 #fff;
  cursor: pointer;
  transition: all 0.2s ease-out;
  &:hover {
    border-color: #999;
    box-shadow: 0 1px 3px rgba(0,0,0,0.25);
  }
  &:active2 {
    box-shadow: 0 1px 3px rgba(0,0,0,0.25) inset;
  }


.overlay2 {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.5);
  transition: opacity 200ms;
  visibility: hidden;
  opacity: 0;
  &.light {
    background: rgba(255,255,255,0.5);
  }
  .cancel2 {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: default;
  }
  &:target2 {
    visibility: visible;
    opacity: 1;
  }


.popup2 {
  margin: 75px auto;
  padding: 20px;
  background: #fff;
  border: 1px solid #666;
  width: 300px;
  box-shadow: 0 0 50px rgba(0,0,0,0.5);
  position: relative;
  .light & {
    border-color: #aaa;
    box-shadow: 0 2px 10px rgba(0,0,0,0.25);
  }
  h22 {
    margin-top: 0;
    color: #666;
    font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
  }
  .close2 {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 20px;
    right: 20px;
    opacity: 0.8;
    transition: all 200ms;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #666;
    &:hover {
      opacity: 1;
    }
  
  .content2 {
    max-height: 400px;
    overflow: auto;
  }
  p2 {
    margin: 0 0 1em;
    &:last-child {
      margin: 0;
    }
  
  body2 {
  font-family: Arial, sans-serif;
  background: #ddd;
}

h12 {
  text-align: center;
  font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
  color: #333;
  text-shadow: 0 1px 0 #fff;
  margin: 50px 0;
}

#wrapper2 {
  width: 100px;
  margin: 0 auto;
  background: #fff;
  padding: 20px;
  border: 10px solid #aaa;
  border-radius: 15px;
  background-clip: padding-box;
  text-align: center;
}

.button2 {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 13px;
  padding: 5px 10px;
  border: 1px solid #aaa;
  background-color: #eee;
  background-image: linear-gradient(top, #fff, #f0f0f0);
  border-radius: 2px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.15);
  color: #666;
  text-decoration: none;
  text-shadow: 0 1px 0 #fff;
  cursor: pointer;
  transition: all 0.2s ease-out;
  &:hover {
    border-color: #999;
    box-shadow: 0 1px 3px rgba(0,0,0,0.25);
  }
  &:active2 {
    box-shadow: 0 1px 3px rgba(0,0,0,0.25) inset;
  }


.overlay2 {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.5);
  transition: opacity 200ms;
  visibility: hidden;
  opacity: 0;
  &.light {
    background: rgba(255,255,255,0.5);
  }
  .cancel2 {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: default;
  }
  &:target2 {
    visibility: visible;
    opacity: 1;
  }


.popup2 {
  margin: 75px auto;
  padding: 20px;
  background: #fff;
  border: 1px solid #666;
  width: 300px;
  box-shadow: 0 0 50px rgba(0,0,0,0.5);
  position: relative;
  .light & {
    border-color: #aaa;
    box-shadow: 0 2px 10px rgba(0,0,0,0.25);
  }
  h22 {
    margin-top: 0;
    color: #666;
    font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
  }
  .close2 {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 20px;
    right: 20px;
    opacity: 0.8;
    transition: all 200ms;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #666;
    &:hover {
      opacity: 1;
    }
  
  .content2 {
    max-height: 400px;
    overflow: auto;
  }
  p2 {
    margin: 0 0 1em;
    &:last-child {
      margin: 0;
    }*/
  
</style>
<!--<div class="processing-img" id="loadingmessage" style='display:none;'>
  <img src="<?php echo __SITE_URL;?>/img/loader.gif" >
</div>-->
<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1 style="margin-right:2000px;">Installation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
 if($_POST["Showrequest"]==1)
 {
	  /*$WhereQuery=" where installation_status=5 and (branch_id=1 or inter_branch=1)";*/
	  $WhereQuery=" where installation_status=5 and approve_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 /*$WhereQuery=" where (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" ";
 }
 else if($_POST["Showrequest"]==3)
 {
	 /*$WhereQuery=" where approve_status=1 and installation_status IN(1,9) and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where approve_status=1 and installation_status IN(1,9)";
 }
 else if($_POST["Showrequest"]==4)
 {
	 /*$WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null and installation_status NOT IN(5,6)";
 }
 else
 { 
	  
	 /*$WhereQuery=" where installation_status=8 and approve_status=0 and (branch_id=1 or inter_branch=1) and (admin_comment is null or sales_comment!='') ";*/
	 $WhereQuery=" where installation_status=8 and approve_status=0 and (admin_comment is null or sales_comment!='') ";
  
 }
  
$query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation_request ". $WhereQuery."  order by id DESC ");
//echo "<pre>"; print_r($query);
?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Request Date</th>
        <th>Sales Person</th>
        <th>Client</th>
        <th>No. Of Vehicle</th>
        <th>Request Device Type/Model</th>
        <th>Approve Vehicle</th>
        <th>Approve Device Type/Model</th>
        <th>Time</th>
        <th>Branch</th>
        <th>Current Status</th>
        <th>View Detail</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
	$sales = select_query("select name from sales_person where id='".$query[$i]['sales_person']."' ");
	
	$sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
	$rowuser=select_query($sql);
	
	$sqlDevice = select_query("SELECT parent_id,item_name FROM item_master where item_id='".$query[$i]["model"]."'");
    $DeviceName = select_query("SELECT item_name FROM item_master where item_id='".$sqlDevice[0]["parent_id"]."'");
    $request_model = $sqlDevice[0]['item_name']." / ".$DeviceName[0]['item_name'];
	
	if($query[$i]["approved_model"] != '')
	{
		$approve_sqlDevice = select_query("SELECT parent_id,item_name FROM item_master where item_id='".$query[$i]["approved_model"]."'");
		$approve_DeviceName = select_query("SELECT item_name FROM item_master where item_id='".$approve_sqlDevice[0]["parent_id"]."'");
		$approve_model = $approve_sqlDevice[0]['item_name']." / ".$approve_DeviceName[0]['item_name'];
		
		$checkAdminAproveModel = select_query("SELECT * FROM admin_stock_approved_history where installation_req_id='".$query[$i]["id"]."'");
        $totalModelApproved = $checkAdminAproveModel[0]['ffc_device_approved'] + $checkAdminAproveModel[0]['new_device_approved'];
	}
	else
	{
		$approve_model = "-- / --";
		$totalModelApproved = '--';
	}
	
	if($query[$i]["inter_branch"] == 0)
	{
		$approve_branch = $query[$i]["branch_id"];
	}
	else
	{
		$approve_branch = $query[$i]["inter_branch"];
	}
	
	if($approve_branch==1){ $branch = "Delhi";}
	elseif($approve_branch==2){ $branch = "Mumbai";}
	elseif($approve_branch==3){ $branch = "Jaipur";}
	elseif($approve_branch==4){ $branch = "Sonipath";}
	elseif($approve_branch==6){ $branch = "Ahmedabad";}
	elseif($approve_branch==7){ $branch = "Kolkata";}
	
?>
      <tr align="center" <? if($query[$i]["approve_status"]==1 && $query[$i]["installation_status"]!=5){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#F2F5A9"';}elseif($query[$i]["installation_status"]==5){ echo 'style="background-color:#99FF66"';}?> >
      
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["req_date"];?></td>
        <td><?php echo $sales[0]['name'];?></td>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["no_of_vehicals"];?></td>       
        <td><?=$request_model;?> </td>
        <td><?=$totalModelApproved;?> </td>
        <td><?=$approve_model;?> </td>
        <td><?php echo $query[$i]["time"];?></td>
        <td><?php echo $branch;?></td>
        <td><?  if($query[$i]["installation_status"]==7 && ($query[$i]["admin_comment"]!="" || $query[$i]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
        elseif($query[$i]["installation_status"]==7 && $query[$i]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
        elseif($query[$i]["approve_status"]==0 && $query[$i]["installation_status"]==8 ){echo "Pending Admin Approval";}
        elseif($query[$i]["installation_status"]==9 && $query[$i]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
        elseif($query[$i]["installation_status"]==1 ){echo "Pending Dispatch Team";}
        elseif($query[$i]["installation_status"]==2 ){echo "Assign To Installer";}
        elseif($query[$i]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
        elseif($query[$i]["installation_status"]==3 ){echo "Back Installation";}
        elseif($query[$i]["installation_status"]==15 ){echo "Pending Remaining Installation";}
        elseif($query[$i]["installation_status"]==5 || $query[$i]["installation_status"]==6){echo "Installation Close";}?></td>
        
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View</a>          
          |  <a href="adminstock-iframe.php?id=<?=$query[$i]["id"]?>&branch_id=<?=$approve_branch;?>&deviceModel=<?=$query[$i]["model"]?>&height=500&width=800" class="thickbox" >StockView</a>
        </td>
        <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          
          <? if($query[$i]["approve_status"]==1){?>
          Approved
          <? } else { ?>
          <!-- <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>,<?php echo $query[$i]["branch_id"];?>,<?php echo $query[$i]["device_type"];?>,<?php echo $query[$i]["model"];?>);"  >Approve</a>  -->

         <a href="adminapproval-iframe.php?id=<?=$query[$i]["id"]?>&branch_id=<?=$approve_branch?>&deviceModel=<?=$query[$i]["model"]?>&noVehicle=<?=$query[$i]["no_of_vehicals"]?>&client_id=<?=$query[$i]["user_id"]?>&req_id=6&height=500&width=800"  class="thickbox">Approve</a> 

          <? } ?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);" >Back </a>
          <?php }?> </td>
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
