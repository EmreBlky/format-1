<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

 $group_id = '';
 $group_id_get = select_query_live_con("select sys_group_id from matrix.tbl_history_devices where remove_Date is null and sys_group_id!=1998 group by sys_group_id");
 
 for($g=0;$g<count($group_id_get);$g++)
 {
	 $group_id.= "'".$group_id_get[$g]['sys_group_id']."',";
 }

 $group = substr($group_id,0,-1);
 
 $user_id_val = ''; 
 $user_get = select_query_live_con("select sys_user_id from matrix.group_users where sys_group_id in ($group) and group_users.active=1");
 
 for($u=0;$u<count($user_get);$u++)
 {
	 $user_id_val.= "'".$user_get[$u]['sys_user_id']."',";
 }
 
 $user = substr($user_id_val,0,-1);
 
?>

<script>

function ConfirmDeactivateUser(row_id)
{
    var x = confirm("Are you sure you want to Deactivate this?");
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
    //alert(row_id);
    //return false;
	$.ajax({
			type:"GET",
			url:"userInfo.php?action=tempdeactivateUserAccount",
			data:"row_id="+row_id,  
			success:function(msg){
				 alert(msg);         
				 location.reload(true);       

        }
    });
}

function ConfirmTransferUser(row_id)
{
    var x = confirm("Are you sure you want to Transfer this?");
	if (x)
	{
	transferUser(row_id);
	  return ture;
	}
	else
	  return false;
}

function transferUser(row_id)
{
    //alert(row_id);
    //return false;
	$.ajax({
			type:"GET",
			url:"userInfo.php?action=transferUserAccount",
			data:"row_id="+row_id,  
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All </option>
      </select>
    </form>
  </div>
  <h1>Users Account List</h1>
</div>
<div class="top-bar">
  <!--<div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Deactivate Users</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Activate Users.</div>-->
</div>
<div style="float:right";><a href="reportfiles/list_billed_client.xls">Create Excel</a><br/>
</div>
<div class="table">
  <?php

if($_POST["Showrequest"]==1)
 {
      $WhereQuery=" where  users.id in ($user) and users.sys_active=1 and users.read_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
     $WhereQuery=" where  users.id in ($user) and users.sys_active=1 ";
 }
 else
 {
     $WhereQuery=" where users.id in ($user) and users.sys_active=1 and users.read_status=0";
 }
 

/*$query_rslt = select_query_live_con("SELECT *, case when sys_active=true then true else false end as active FROM matrix.users ".$WhereQuery." order by sys_username");*/  

$query_rslt = select_query_live_con("select users.id, `group`.name as company_name, users.sys_parent_user, users.branch_id, users.sys_username,
										users.price_per_unit, users.sys_added_date,users.sales_user_id,
										case when users.sys_active=true then true else false end as active  
										from matrix.users left join matrix.group_users on users.id=group_users.sys_user_id  
										left join matrix.`group` on group_users.sys_group_id =`group`.id
									".$WhereQuery." order by users.sys_username");

//echo "<pre>";print_r($query_rslt);die; 

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>Account Manager</th>
        <th>Users</th>
        <th>Company Name</th>
        <th>Rent</th>
        <th>Creation date</th>
        <!--<th>Total Vehicle</th>-->
        <th>Main/Sub</th>
        <th>Branch</th>
        <th>Edit</th>
        <th>Action</th>
        <th>Transfer To</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  
	  $excel_data.='<table cellpadding="5" cellspacing="5" border="1"><thead><tr><td colspan="7" align="center"><strong>Billed Client Details</strong></td></tr><tr><td colspan="7"></td></tr><tr><th width="5%">SL.No</th><th width="10%">Account Manager </th><th width="10%">Users </th><th width="20%">Company Name </th><th width="10%">Rent</th><th width="10%">Creation date</th><th width="10%">Main/Sub </th><th width="10%">Branch </th></tr></thead><tbody>';
	  
	  
$total_vehicle = '';

for($j=0;$j<count($query_rslt);$j++)
{
   	$user_id = $query_rslt[$j]["id"];        
	
    //$group_user_id = select_query_live_con("SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$user_id."'");
    //$group_id =  $group_user_id[0]['sys_group_id'];
    
    //$active_query = select_query_live_con("SELECT count(*) as total_vehicle FROM matrix.group_services WHERE active=1 AND sys_group_id in(SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$user_id."')");
	
    //$total_vehicle = $active_query[0]['total_vehicle'];
	$total_vehicle = 0;
	
	if($query_rslt[$j]["sys_parent_user"] == 1)
	{
		$main_sub = 'MainUser';
	}
	else
	{
		$main_sub = 'SubUser';
	}
	
	
    if($query_rslt[$j]["branch_id"]==1){ $branch = "Delhi";}
	elseif($query_rslt[$j]["branch_id"]==2){ $branch = "Mumbai";}
	elseif($query_rslt[$j]["branch_id"]==3){ $branch = "Jaipur";}
	elseif($query_rslt[$j]["branch_id"]==4){ $branch = "Sonipath";}
	elseif($query_rslt[$j]["branch_id"]==6){ $branch = "Ahmedabad";}
	elseif($query_rslt[$j]["branch_id"]==7){ $branch = "Kolkata";}
	
	
	if($query_rslt[$j]["sales_user_id"]==1){ $manager = "Kuldeep";}
	elseif($query_rslt[$j]["sales_user_id"]==2){ $manager = "Basant";}
	elseif($query_rslt[$j]["sales_user_id"]==3){ $manager = "Gaurav";}
	elseif($query_rslt[$j]["sales_user_id"]==4){ $manager = "Rahul";}
	elseif($query_rslt[$j]["sales_user_id"]==5){ $manager = "Jawahar";}
	elseif($query_rslt[$j]["sales_user_id"]==6){ $manager = "Raghvehdra";}
	elseif($query_rslt[$j]["sales_user_id"]==7){ $manager = "Krishna";}
	elseif($query_rslt[$j]["sales_user_id"]==8){ $manager = "Baljeet";}
	elseif($query_rslt[$j]["sales_user_id"]==9){ $manager = "Company";}
	elseif($query_rslt[$j]["sales_user_id"]==10){ $manager = "Ragini";}
	elseif($query_rslt[$j]["sales_user_id"]==11){ $manager = "Surabhi";}
	elseif($query_rslt[$j]["sales_user_id"]==12){ $manager = "Tushar";}
	elseif($query_rslt[$j]["sales_user_id"]==13){ $manager = "Kavita";}
	elseif($query_rslt[$j]["sales_user_id"]==14){ $manager = "Anand";}
	else { $manager = "No Manager";}
	
	
?>
      <tr align="center" >
        <td><?php echo $j+1;?></td>
        <td><?php echo $manager;?></td>
        <td><?php echo $query_rslt[$j]["sys_username"].'( '.$main_sub.' )';?></td>
        <td><?php echo $query_rslt[$j]["company_name"];?></td>
        <td><?php echo $query_rslt[$j]["price_per_unit"];?></td>
        <td><?php echo $query_rslt[$j]["sys_added_date"];?></td>
        <!--<td><?php echo $total_vehicle;?></td>-->
        <td><?php echo $main_sub;?></td>
        <td><?php echo $branch;?></td>
        <td><a href="update_client_billing.php?id=<?=$query_rslt[$j]['id'];?>&action=edit<? echo $pg;?>" target="_blank"> edit</a></td>
        <td><a href="#" onclick="return ConfirmDeactivateUser(<?=$query_rslt[$j]['id'];?>);">TempDeactivate</a></td>
        <td><a href="#" onclick="return ConfirmTransferUser(<?=$query_rslt[$j]['id'];?>);">Transfer</a></td>
      </tr>
      <?php 
	  
	  $sr_no = $j+1;
	  
	  $excel_data.="<tr><td width='5%'>".$sr_no."</td><td width='10%'>".$manager."</td><td width='10%'>".$query_rslt[$j]["sys_username"].'( '.$main_sub.' )'."</td><td width='10%'>".$query_rslt[$j]["company_name"]."</td><td width='10%'>".$query_rslt[$j]["price_per_unit"]."</td><td width='10%'>".$query_rslt[$j]["sys_added_date"]."</td><td width='10%'>".$main_sub."</td><td width='10%'>".$branch."</td></tr>";
	  
	  }
	  
	   $excel_data.='</tbody></table>';
	   
	  ?>
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

unlink(__DOCUMENT_ROOT.'/account/reportfiles/list_billed_client.xls');
$filepointer=fopen(__DOCUMENT_ROOT.'/account/reportfiles/list_billed_client.xls','w');
fwrite($filepointer,$excel_data);
fclose($filepointer);

include("../include/footer.php"); ?>