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

echo "select users.id, `group`.name as company_name, users.sys_parent_user, users.branch_id, users.sys_username,
										users.price_per_unit, users.sys_added_date,users.sales_user_id,
										case when users.sys_active=true then true else false end as active  
										from matrix.users left join matrix.group_users on users.id=group_users.sys_user_id  
										left join matrix.`group` on group_users.sys_group_id =`group`.id
										where users.id in ($user) and users.sys_active=1 and users.read_status=0 order by users.sys_username";

$query_rslt = select_query_live_con("select users.id, `group`.name as company_name, users.sys_parent_user, users.branch_id, users.sys_username,
										users.price_per_unit, users.sys_added_date,users.sales_user_id,
										case when users.sys_active=true then true else false end as active  
										from matrix.users left join matrix.group_users on users.id=group_users.sys_user_id  
										left join matrix.`group` on group_users.sys_group_id =`group`.id
										where users.id in ($user) and users.sys_active=1 and users.read_status=0 order by users.sys_username");

echo "<pre>";print_r($query_rslt);die; 

	  
	  
$total_vehicle = '';

for($j=0;$j<count($query_rslt);$j++)
{
   	$user_id = $query_rslt[$j]["id"];        
	//$total_vehicle = 0;
	
	
	
	//$user_result = select_query_live_con("SELECT * FROM matrix.users where id='".$user_id."'"); 
				
	$total_vehicle = select_query_live_con("SELECT count(*) as total_vehicle FROM matrix.group_services WHERE active=1 AND sys_group_id in(SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$query_rslt[$j]["id"]."')");
	
	
	$device_result = select_query("SELECT * FROM new_account_creation where user_name='".$user_result[0]['sys_username']."'"); 
	
	




}
	  
	  
include("../include/footer.php"); ?>