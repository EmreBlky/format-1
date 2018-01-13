<?php
ini_set('max_execution_time', 500);
include("connection.php");

 /*$get_user_data = select_query_live_con("select id, CASE WHEN sys_active=1 THEN '1' ELSE '0' END sys_active, sys_username, sys_parent_user, branch_id, sys_added_date from matrix.users where sys_parent_user!='1' order by id asc");*/
 
 $get_user_data = select_query_live_con("select id, CASE WHEN sys_active=1 THEN '1' ELSE '0' END sys_active, sys_username, sys_parent_user, branch_id, sys_added_date from matrix.users where sys_parent_user!='1' and id >= '6454' order by id asc");
 
 //echo "<pre>";print_r($get_user_data);die;
 
 for($i=0;$i<count($get_user_data);$i++)
 {
	 
	 $add_tbl_chk = select_query("select Userid from internalsoftware.addclient where Userid='".$get_user_data[$i]['id']."'");
	 
	 $sub_user_branch_id = select_query_live_con("select branch_id from matrix.users where id='".$get_user_data[$i]['sys_parent_user']."' limit 1");
	 if($sub_user_branch_id[0]['branch_id'] == "")
	 {
		$branch_id = '1'; 
	 }
	 else
	 {
	 	$branch_id = $sub_user_branch_id[0]['branch_id']; 
	 }
	 
	 if(count($add_tbl_chk)>0)
	 {
		 
		 $update_query = array('UserName' => $get_user_data[$i]['sys_username'], 'sys_parent_user' =>  $get_user_data[$i]['sys_parent_user'], 'sys_active' => $get_user_data[$i]['sys_active'], 'Branch_id' => $branch_id, 'Date' => $get_user_data[$i]['sys_added_date']);
		 
		 $condition = array('Userid' => $get_user_data[$i]['id']);
		//echo "<pre>";
		update_query('internalsoftware.addclient', $update_query, $condition);
		echo "<br/>";
		echo "Data Successfully Updated.";
		
	 }
	 else
	 {
		 
		 if($get_user_data[$i]['branch_id'] == 1 && $get_user_data[$i]['sys_parent_user'] == 1)
		 {
			 $GroupId = '1';
			 $LoginName = 'Anoop';
		 }
		 else if($branch_id == 1 && $get_user_data[$i]['sys_parent_user'] != 1)
		 {
			 $GroupId = '9';
			 $LoginName = 'rakhi';
		 }
		 else if($branch_id == 2 || $branch_id == 3 || $branch_id == 4 || $branch_id == 7 )
		 {
			 $GroupId = '10';
			 $LoginName = 'Ankur';
		 }
		 elseif($branch_id == 6)
		 {
			 $GroupId = '11';
			 $LoginName = 'Amit';
		 }
		 else
		 {
			 $GroupId = '1';
			 $LoginName = 'Anoop'; 
		 }
			 
		 		 
		 $insert_query = array('Userid' => $get_user_data[$i]['id'], 'UserName' => $get_user_data[$i]['sys_username'], 'GroupId' =>  $GroupId, 'sys_parent_user' =>  $get_user_data[$i]['sys_parent_user'], 'LoginName' =>  $LoginName, 'sys_active' => $get_user_data[$i]['sys_active'], 'Branch_id' => $branch_id, 'Date' => $get_user_data[$i]['sys_added_date']);
		//echo "<pre>"; 		
		insert_query('internalsoftware.addclient', $insert_query);
		echo "<br/>";
		echo "Data Successfully Insert."; 
	 }
	 
	
 }
 
?>

