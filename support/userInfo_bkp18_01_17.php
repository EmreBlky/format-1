<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER["DOCUMENT_ROOT"]."/format/connection.php");
include($_SERVER["DOCUMENT_ROOT"]."/format/sqlconnection.php");*/

include("C:/xampp/htdocs/send_alert/class.phpmailer.php");
include("C:/xampp/htdocs/send_alert/class.smtp.php");


$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$comment=$_GET["comment"];

 //Final Close from Support
 
if(isset($_GET['action']) && $_GET['action']=='devicechangeclose')
{
    $Updateapprovestatus="update device_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully Approved";*/
}

 

if(isset($_GET['action']) && $_GET['action']=='NewAccclose')
{
    $Updateapprovestatus="update new_account_creation set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='imei_changeclose')
{
    $Updateapprovestatus="update imei_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}
if(isset($_GET['action']) && $_GET['action']=='stop_gpsclose')
{
    $Updateapprovestatus="update stop_gps set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='start_gpsclose')
{
    $Updateapprovestatus="update start_gps set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='new_device_additionclose')
{
    $Updateapprovestatus="update new_device_addition set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changeclose')
{
    $Updateapprovestatus="update vehicle_no_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}
if(isset($_GET['action']) && $_GET['action']=='sim_changeclose')
{
    $check_query = select_query("SELECT * FROM sim_change WHERE id='".$row_id."'");
   
    $update_inventory = mssql_query("update sim set SimRemoveDate='".$check_query[0]['date']."', sim_status=92, active_status=1, is_testsim=0, status=0, flag=3, SimChangeRemarks='Support Team Send - ".$check_query[0]['reg_no']." - SIM changed' where phone_no='".$check_query[0]['old_sim']."'");
   
    $Updateapprovestatus="update sim_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    //echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='deactivate_simclose')
{
    //$Updateapprovestatus="update deactivate_sim set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    $Updateapprovestatus="update deactivate_sim set final_status=1 where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='device_lostclose')
{
    $Updateapprovestatus="update device_lost set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='deletionclose')
{
    $check_query = select_query("SELECT deactivation_of_sim FROM deletion WHERE id='".$row_id."'");
   
    /*if($check_query["deactivation_of_sim"]=="Yes"){
        $Updateapprovestatus="update deletion  set final_status=1 where id=".$row_id;
    }
    else{*/
   
       $Updateapprovestatus="update deletion  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

/*if(isset($_GET['action']) && $_GET['action']=='SimChange_forwardtoacc')
{
    $check_query = mysql_fetch_array(mysql_query("SELECT * FROM sim_change WHERE id='".$row_id."'"));
   
        $insert_query="INSERT INTO deactivate_sim (date, acc_manager, user_id, client, sales_manager, vehicle, device_sim, change_date, reason, approve_status) VALUES ('".date("Y-m-d H:i:s")."','".$check_query["acc_manager"]."','".$check_query["user_id"]."','".$check_query["client"]."','".$check_query["sales_manager"]."','".$check_query["reg_no"]."','".$check_query["old_sim"]."','".$check_query["sim_change_date"]."','".trim($check_query["reason"])."','1')";
       
 mysql_query($insert_query) or die(mysql_error());

       $Updateapprovestatus="update sim_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
}*/

if(isset($_GET['action']) && $_GET['action']=='forwardtoaccountreq')
{
    $check_query = select_query("SELECT * FROM deletion WHERE id='".$row_id."'");
    $reason = str_replace("'","",$check_query[0]["reason"]);
   
        $insert_query="INSERT INTO deactivate_sim (date, acc_manager, user_id, client, sales_manager, vehicle, device_imei, device_sim, ps_of_ownership, change_date, reason, approve_status) VALUES ('".date("Y-m-d H:i:s")."','".$check_query[0]["acc_manager"]."','".$check_query[0]["user_id"]."','".$check_query[0]["client"]."','".$check_query[0]["sales_manager"]."','".$check_query[0]["reg_no"]."','".$check_query[0]["imei"]."','".$check_query[0]["device_sim_no"]."','".$check_query[0]["vehicle_location"]."','".$check_query[0]["deletion_date"]."','".$reason."','".$check_query[0]["approve_status"]."')";
       
 mysql_query($insert_query);

       $Updateapprovestatus="update deletion  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationclose')
{
    $Updateapprovestatus="update sub_user_creation  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}



if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountclose')
{
     /*$deactvate_query = mysql_fetch_array(mysql_query("select * from deactivation_of_account where id='".$row_id."'"));   
     $user_id = $deactvate_query["user_id"];
     
     $sql_user=mysql_fetch_array(mysql_query("select id,sys_username from matrix.users  where id='".$deactvate_query["user_id"]."'"));
     $clent_dec_ac = $sql_user["sys_username"];*/
     
    /*if($deactvate_query["deactivate_temp"]=="temporary"){*/
             $Updateapprovestatus="update deactivation_of_account  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    /*}
    else{
        $Updateapprovestatus="update deactivation_of_account  set final_status=1 where id=".$row_id;
    }*/
    $result= mysql_query($Updateapprovestatus);
   
   
}

/*if(isset($_GET['action']) && $_GET['action']=='SimforwardtoAccountDeact')
{
     $deactvate_query = mysql_fetch_array(mysql_query("select user_id from deactivation_of_account where id='".$row_id."'"));   
     $user_id = $deactvate_query["user_id"];
     
     $mysql_sim_query=mysql_query("SELECT services.id,veh_reg,devices.imei,mobile_simcards.mobile_no FROM matrix.services
 LEFT JOIN matrix.devices ON devices.id=services.sys_device_id LEFT JOIN matrix.mobile_simcards
 ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN
 (SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE AND sys_group_id IN
 (SELECT sys_group_id FROM matrix.group_users WHERE sys_user_id='".$user_id."'))");
     
     while($rslt=mysql_fetch_array($mysql_sim_query)){
         $sim_data[] =$rsltt;
         $insert_sim_query = "INSERT INTO deactivate_sim_forword_account(`date`,vehicle_no,device_imei,mobile_no,reason) VALUES('".date("Y-m-d H:i:s")."','".$rslt['veh_reg']."','".$rslt['imei']."','".$rslt['mobile_no']."','Deactive sim')";
         mysql_query($insert_sim_query);
     }
   
    $Updateapprovestatus="update deactivation_of_account  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
   
    $result= mysql_query($Updateapprovestatus);
   
   
}*/

if(isset($_GET['action']) && $_GET['action']=='Reactivation_of_accountclose')
{

    $Updateapprovestatus="update reactivation_of_account  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    $result= mysql_query($Updateapprovestatus);
   
}


/*if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsclose')
{
    $Updateapprovestatus="update del_form_debtors  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}    */


/*if(isset($_GET['action']) && $_GET['action']=='no_billsclose')
{
    $Updateapprovestatus="update no_bills  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
}*/   

if(isset($_GET['action']) && $_GET['action']=='discount_detailsclose')
{
    $Updateapprovestatus="update discount_details  set final_status=1 ,close_date='".date("Y-m-d h:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}   

if(isset($_GET['action']) && $_GET['action']=='software_requestclose')
{
    $Updateapprovestatus="update software_request  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehicleclose')
{
    $Updateapprovestatus="update transfer_the_vehicle  set final_status=1,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";*/
     
}   
 

// Add Comment

if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentPending')
{
     
      $Updateapprovestatus="update dimts_imei  set imei_upload_reason='".$comment."',dimts_status='2'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentClear')
{

        $Updateapprovestatus="update dimts_imei  set support_comment='IMEI Uploaded-Done ".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}   


if(isset($_GET['action']) && $_GET['action']=='devicechangesupportComment')
{

    $query = "SELECT support_comment FROM device_change  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update device_change  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',device_change_status='2' where id=".$row_id;

    mysql_query($Updateapprovestatus);
    //$Updateapprovestatus="update device_change set support_comment='".$comment."' where id=".$row_id;
   
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

 

if(isset($_GET['action']) && $_GET['action']=='NewAccsupportComment')
{
   
    $query = "SELECT support_comment FROM new_account_creation  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update new_account_creation  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',acc_creation_status='2' where id=".$row_id;

    //$Updateapprovestatus="update new_account_creation set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}


if(isset($_GET['action']) && $_GET['action']=='imei_changesupportComment')
{


    $query = "SELECT support_comment FROM imei_change  where id=".$row_id;
    $row=select_query($query);

     

    $Updateapprovestatus="update imei_change  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

    //$Updateapprovestatus="update imei_change set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='stop_gpssupportComment')
{

    $query = "SELECT support_comment FROM stop_gps  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update stop_gps  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',stop_gps_status='2' where id=".$row_id;
    //$Updateapprovestatus="update stop_gps set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='start_gpssupportComment')
{

    $query = "SELECT support_comment FROM start_gps  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update start_gps  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',start_gps_status='2' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='deactivate_simsupportComment')
{

    $query = "SELECT support_comment FROM deactivate_sim  where id=".$row_id;
    $row=select_query($query);

     

    $Updateapprovestatus="update deactivate_sim  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

    //$Updateapprovestatus="update deactivate_sim set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}


if(isset($_GET['action']) && $_GET['action']=='new_device_additionsupportComment')
{

    $query = "SELECT support_comment FROM new_device_addition  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update new_device_addition  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',new_device_status='2' where id=".$row_id;

    //$Updateapprovestatus="update new_device_addition set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changesupportComment')
{
    $query = "SELECT support_comment FROM vehicle_no_change  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update vehicle_no_change  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',vehicle_status='2' where id=".$row_id;
   
    //$Updateapprovestatus="update vehicle_no_change set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='sim_changesupportComment')
{

    $query = "SELECT support_comment FROM sim_change  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update sim_change  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',sim_change_status='2' where id=".$row_id;

    //$Updateapprovestatus="update sim_change set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='device_lostsupportComment')
{

    $query = "SELECT support_comment FROM device_lost  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update device_lost  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',device_lost_status='2' where id=".$row_id;

    //$Updateapprovestatus="update device_lost set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='deletionsupportComment')
{
    $query = "SELECT support_comment FROM deletion  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update deletion  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',delete_veh_status='2' where id=".$row_id;
   
    //$Updateapprovestatus="update deletion set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationsupportComment')
{
    $query = "SELECT support_comment FROM sub_user_creation  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update sub_user_creation  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',sub_user_status='2' where id=".$row_id;
   
    //$Updateapprovestatus="update sub_user_creation  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}



if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountsupportComment')
{

    $query = "SELECT support_comment FROM deactivation_of_account  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update deactivation_of_account  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',deactivation_status='2' where id=".$row_id;

    //$Updateapprovestatus="update deactivation_of_account  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='Reactivation_of_accountsupportComment')
{

    $query = "SELECT support_comment FROM reactivation_of_account  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update reactivation_of_account  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',reactivation_status='2' where id=".$row_id;

    mysql_query($Updateapprovestatus);
}


if(isset($_GET['action']) && $_GET['action']=='del_form_debtorssupportComment')
{
    $query = "SELECT support_comment FROM del_form_debtors  where id=".$row_id;
    $row=select_query($query);

     

    $Updateapprovestatus="update del_form_debtors  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
    //$Updateapprovestatus="update del_form_debtors  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}   


if(isset($_GET['action']) && $_GET['action']=='no_billssupportComment')
{

    $query = "SELECT support_comment FROM no_bills  where id=".$row_id;
    $row=select_query($query);
 
    $Updateapprovestatus="update no_bills  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',no_bill_status='2' where id=".$row_id;

    //$Updateapprovestatus="update no_bills  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='Add_no_bill_supportComment')
{

    $query = "SELECT software_comment FROM no_bills  where id=".$row_id;
    $row=select_query($query);
 
    $Updateapprovestatus="update no_bills  set software_comment='".$row[0]["software_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;

    mysql_query($Updateapprovestatus);
}       

if(isset($_GET['action']) && $_GET['action']=='discount_detailssupportComment')
{
   
    $query = "SELECT support_comment FROM discount_details  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update discount_details  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',discount_status='2' where id=".$row_id;
   
   
    //$Updateapprovestatus="update discount_details  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}   

if(isset($_GET['action']) && $_GET['action']=='discount_addComment')
{
    $query = "SELECT software_comment FROM discount_details  where id=".$row_id;
    $row=select_query($query);
 
    $Updateapprovestatus="update discount_details  set software_comment='".$row[0]["software_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
}   

if(isset($_GET['action']) && $_GET['action']=='software_requestsupportComment')
{

    $query = "SELECT support_comment FROM software_request  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update software_request  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',software_status='2' where id=".$row_id;
   
    //$Updateapprovestatus="update software_request  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehiclesupportComment')
{
   
    $query = "SELECT support_comment FROM transfer_the_vehicle  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update transfer_the_vehicle  set support_comment='".$row[0]["support_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',transfer_veh_status='2' where id=".$row_id;
   
    //$Updateapprovestatus="update transfer_the_vehicle  set support_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
     
}   
 if(isset($_GET['action']) && $_GET['action']=='deletevehiclebackComment')
{
   
        $query = "SELECT forward_back_comment FROM deletion  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update deletion set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='devicechangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM device_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update device_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='newdeviceadditionbackComment')
{
   
        $query = "SELECT forward_back_comment FROM new_device_addition  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update new_device_addition set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='vehiclenochangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM vehicle_no_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update vehicle_no_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='simchangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM sim_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update sim_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='devicelostbackComment')
{
   
        $query = "SELECT forward_back_comment FROM device_lost  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update device_lost set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='deactivatesimbackComment')
{
   
        $query = "SELECT forward_back_comment FROM deactivate_sim  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update deactivate_sim set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='dimtsimeibackComment')
{
   
        $query = "SELECT forward_back_comment FROM dimts_imei  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='accountcreationbackComment')
{
   
        $query = "SELECT forward_back_comment FROM new_account_creation  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update new_account_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='stopgpsbackComment')
{
   
        $query = "SELECT forward_back_comment FROM stop_gps  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update stop_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='startgpsbackComment')
{
   
    $query = "SELECT forward_back_comment FROM start_gps  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update start_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='ActivateUserAccount')
{
        $query = "SELECT acc_reason,again_activate_date,sys_username,company FROM matrix.users where id=".$row_id;
        $row=select_query_live($query);
       
        $data1 = array('active' => 1);
		$condition = array('sys_user_id' => $row_id);
		
		update_query_live_con('matrix.group_users', $data1, $condition);
		update_query_live('matrix.group_users', $data1, $condition);
		
		//$activate_user = mysql_query("update matrix.group_users set active=1 where group_users.sys_user_id='".$row_id."'",$dblink);
       
        /*$Updateapprovestatus="update matrix.users set sys_active=1,acc_reason='".$row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -" .$comment." ,Act. By-anoop', again_activate_date='".$row[0]["again_activate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name']."'  where id=".$row_id;
        mysql_query($Updateapprovestatus,$dblink);*/
		
		$Updateapprovestatus = array('sys_active' => 1, 'acc_reason' => $row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -".$comment." Act. By-".$_SESSION['user_name'], 'again_activate_date' => $row[0]["again_activate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name'] );
		$condition2 = array('id' => $row_id);
		
		update_query_live_con('matrix.users', $Updateapprovestatus, $condition2);
		update_query_live('matrix.users', $Updateapprovestatus, $condition2);
   
        $Subject="Activate G-Trac Account of this Client - ".$row[0]["sys_username"];
 
        
		
		$mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        //$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "mail.gtrac.in";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port
        $mail->Username   = "report@gtrac.in";  // GMAIL username
        $mail->Password   = "12345";            // GMAIL password
        $mail->From       = "report@gtrac.in";
        $mail->FromName   = "G-trac";

        $mail->Subject    = $Subject;
        //$mail->Body       = $message;                      //HTML Body
        $mail->AltBody    = ""; //Text Body
        $mail->WordWrap   = 50; // set word wrap
       
        $textTosend.='Dear Sir,<br>';
        $textTosend.='<br>Anoop Activate G-Trac Client login Account.<br><br>';
        $textTosend.='User:- '.$row[0]["sys_username"];
        $textTosend.='<br>Company Name:- '.$row[0]["company"];
        //$textTosend.='<br>Activate Date:- '.date("Y-m-d");
       
        //$mail->AddAddress("harish@g-trac.in","Harish Sharma");
        $mail->AddAddress("anuj@g-trac.in","Anuj Juneja");
        $mail->AddAddress("anoop@g-trac.in","Anoop");
        $mail->AddAddress("ritesh@g-trac.in","Ritesh Kapoor");
        $mail->AddAddress("radhika@g-trac.in","Radhika");
        $mail->AddAddress("praveen@g-trac.in","Praveen");
        $mail->AddAddress("sarvesh@g-trac.in","Sarvesh");
           
         
        $mail->AddReplyTo("anoop@g-trac.in","Anoop");
        $mail->IsHTML(true); 
       
        $mail->Body = $textTosend;
       
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        }
     
}

if(isset($_GET['action']) && $_GET['action']=='deactivateUserAccount')
{

    $query = "SELECT acc_reason,deactivate_date,sys_username,company FROM matrix.users where id=".$row_id;
    $row=select_query_live($query);
 	
	$data1 = array('active' => 0);
	$condition = array('sys_user_id' => $row_id);
	
	update_query_live_con('matrix.group_users', $data1, $condition);
	update_query_live('matrix.group_users', $data1, $condition);
	
    /*$deactivate_user = mysql_query("update matrix.group_users set active=0 where group_users.sys_user_id='".$row_id."'",$dblink);
   
    $Updateapprovestatus="update matrix.users set acc_reason='".$row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -" .$comment." ,Dect. By-".$_SESSION['user_name']."',deactivate_date='".$row[0]["deactivate_date"]."<br/>".date("Y-m-d H:i:s")." By-anoop',sys_active=0 where id=".$row_id;

    mysql_query($Updateapprovestatus,$dblink);*/
	
	$Updateapprovestatus = array('sys_active' => 0, 'acc_reason' => $row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -".$comment." Dect. By-".$_SESSION['user_name'], 'deactivate_date' => $row[0]["deactivate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name'] );
	$condition2 = array('id' => $row_id);
		
	update_query_live_con('matrix.users', $Updateapprovestatus, $condition2);
	update_query_live('matrix.users', $Updateapprovestatus, $condition2);
     
     $Subject="Deactivate G-Trac Account of this Client - ".$row[0]["sys_username"];
         
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        //$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "mail.gtrac.in";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port
        $mail->Username   = "report@gtrac.in";  // GMAIL username
        $mail->Password   = "12345";            // GMAIL password
        $mail->From       = "report@gtrac.in";
        $mail->FromName   = "G-trac";

        $mail->Subject    = $Subject;
        //$mail->Body       = $message;                      //HTML Body
        $mail->AltBody    = ""; //Text Body
        $mail->WordWrap   = 50; // set word wrap
       
         
       
        $textTosend.='Dear Sir,<br>';
        $textTosend.='<br>Anoop Deactivate G-Trac Client login Account.<br><br>';
        $textTosend.='User:- '.$row[0]["sys_username"];
        $textTosend.='<br>Company Name:- '.$row[0]["company"];
        $textTosend.='<br>Reason:- '.$comment;
        //$textTosend.='<br>Deactivate Date:- '.date("Y-m-d");
       
        //$mail->AddAddress("harish@g-trac.in","Harish Sharma");
        $mail->AddAddress("anuj@g-trac.in","Anuj Juneja");
        $mail->AddAddress("anoop@g-trac.in","Anoop");
        $mail->AddAddress("ritesh@g-trac.in","Ritesh Kapoor");
        $mail->AddAddress("radhika@g-trac.in","Radhika");
        $mail->AddAddress("praveen@g-trac.in","Praveen");
        $mail->AddAddress("sarvesh@g-trac.in","Sarvesh");
           
         
        $mail->AddReplyTo("anoop@g-trac.in","Anoop");
        $mail->IsHTML(true); 
       
        $mail->Body = $textTosend;
       
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        }
}

if(isset($_GET['action']) && $_GET['action']=='subusercreationbackComment')
{
   
        $query = "SELECT forward_back_comment FROM sub_user_creation  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update sub_user_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='deactivateaccountbackComment')
{
   
        $query = "SELECT forward_back_comment FROM deactivation_of_account  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update deactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='ReactivateaccountbackComment')
{
   
        $query = "SELECT forward_back_comment FROM reactivation_of_account  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update reactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='deletefromdebtorsbackComment')
{
   
        $query = "SELECT forward_back_comment FROM del_form_debtors  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update del_form_debtors set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='nobillbackComment')
{
   
        $query = "SELECT forward_back_comment FROM no_bills  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update no_bills set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='discountingbackComment')
{
   
        $query = "SELECT forward_back_comment FROM discount_details  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update discount_details set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='softwarerequestbackComment')
{
   
        $query = "SELECT forward_back_comment FROM software_request  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update software_request set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}
if(isset($_GET['action']) && $_GET['action']=='transferthevehiclebackComment')
{
   
        $query = "SELECT forward_back_comment FROM transfer_the_vehicle  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update transfer_the_vehicle set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
    /*if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";*/
}


    if(isset($_GET['action']) && $_GET['action']=='getrowSales')
    {
         ?>

 <style type="text/css">
#databox{width:840px; height:650px; margin: 30px auto auto; border:1px solid #bfc0c1; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; color:#3f4041;}
.heading{ font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:700; word-spacing:5px; text-align:center;   color:#3E3E3E;   background-color:#ECEFE7; margin-bottom:10px;  }
.dataleft{float:left; width:400px; height:400px; margin-left:10px; border-right:1px solid #bfc0c1;}
.dataright{float:right; width:400px; height:400px; margin-left:19px;}
td{padding-right:20px; padding-left:20px;}
</style>

        <?
            $RowId=$_GET["RowId"];
            $tablename=$_GET["tablename"];
           
     

If($tablename=="new_account_creation")
        {
    $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">New account creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["account_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["account_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>

</tr><td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Price</td><td><?echo $row[0]["device_price"];?></td></tr>
<tr><td>Vat</td><td><?echo $row[0]["device_price_vat"];?></td></tr>
<tr><td>Total Price</td><td><?echo $row[0]["device_price_total"];?></td></tr>
<tr><td>Rent</td><td><?echo $row[0]["device_rent_Price"];?></td></tr>
<tr><td>Service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<tr><td>Total Rent</td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<tr><td>Dimts Fee status </td><td><?echo $row[0]["dimts_fee"];?></td></tr>
 <tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Rent Status</td><td><?echo $row[0]["rent_status"];?></td></tr>
<tr><td>Rent Month</td><td><?echo $row[0]["rent_month"];?></td></tr>
<tr><td>Account Type</td><td><?echo $row[0]["account_type"];?></td></tr>
<tr><td>Assign Telecaller</td><td><?echo $row[0]["telecaller_name"];?></td></tr>
<tr><td>Assign to Support</td><td>
<? $query_support = select_query("SELECT user_name FROM login_user WHERE id='".$row[0]["support_id"]."'");
echo $query_support[0]['user_name'];
?></td></tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Type of Organisation</td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td>PAN No.</td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td>Copy of Pan Card</td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td>Copy of Address Proof</td><td><?echo $row[0]["address_proof"];?></td>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
<tr><td>New Sales Comment</td><td><?echo $row[0]["new_acc_salescomment"];?></td></tr>
<tr><td>Telecaller Name</td><td><?echo $row[0]["telecaller_name"];?></td></tr>

<!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
 <tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["acc_creation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["acc_creation_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["acc_creation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["acc_creation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tr>
</tbody></table>
</div>
</div>

    <? }


    else If($tablename=="stop_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">Stop Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
    

<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<!--<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["reg_no"];?></td></tr>-->
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location     </td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Data to Display     </td><td><?echo $row[0]["data_display"];?></td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Vehicle to Stop GPS </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["stop_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["stop_gps_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["stop_gps_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["stop_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
</tbody></table>
</div>
</div>

<? }


    else If($tablename=="start_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
    <div id="databox">
<div class="heading">Start Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Vehicle to Start GPS </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

</tbody></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["start_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["start_gps_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["start_gps_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["start_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr></tbody>
    </table>
    </div>
    </div>
   
   
    <? }
    else If($tablename=="no_bills")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
    ?><div id="databox">
<div class="heading">No Bills</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>

<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company_name"];?></td></tr>
<!--<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>-->

<tr><td>Vehicle Num </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>No Bill For    </td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Provision Bill    </td><td><?echo $row[0]["provision_bill"];?></td></tr> 
<tr><td>Duration for Provision Bill    </td><td><?echo $row[0]["duration"];?></td></tr>
<tr><td>Issue for No Bill</td><td><?echo $row[0]["no_bill_issue"];?></td></tr>
</tbody></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["no_bill_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}   
    elseif($row[0]["no_bill_issue"]=="Software Issue" && ($row[0]["support_comment"]=="" || $row[0]["no_bill_status"]==1) && $row[0]["software_comment"]=="")
    {echo "Pending at Tech Support Team";}   
    elseif(($row[0]["no_bill_issue"]=="Service Issue" || $row[0]["no_bill_issue"]=="Client Side Issue") && $row[0]["no_bill_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")    {echo "Pending at Service Team";}   
    elseif($row[0]["no_bill_status"]==1 && $row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 ){echo "Pending at Accounts";}    
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["no_bill_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}   
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["no_bill_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For No Bill";}   
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
 
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tbody></table>
</div>
</div>

    <? }
     
 
    else If($tablename=="discount_details")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
           
    ?><div id="databox">
<div class="heading">Discount</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>

<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["client"];?></td></tr>
<!--<tr><td>Vehicle    for discount</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
<tr><td>Vehicle    for discount </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Discount For</td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Month</td><td><?echo $row[0]["mon_of_dis_in_case_of_rent"];?></td></tr>
<tr><td>Discount Amount     </td><td><?echo $row[0]["dis_amt"];?></td></tr>
<tr><td>After Discount     </td><td><?echo $row[0]["amt_rec_after_dis"];?></td></tr>
<tr><td>Before Discount     </td><td><?echo $row[0]["amt_before_dis"];?></td></tr>
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Issue for Discountng</td><td><?echo $row[0]["discount_issue"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
 <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["discount_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["approve_status"]==0 && $row[0]["software_comment"]=="" && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1){echo "Pending at Tech Support Login (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["software_comment"]=="")
    {echo "Pending at Tech Support Login";}
    elseif($row[0]["discount_issue"]=="Repair Cost Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["repair_comment"]=="")
    {echo "Pending at Repair Login";}
    elseif($row[0]["discount_issue"]=="Service Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
    {echo "Pending at Service Support Login";}   
    elseif($row[0]["discount_status"]==1 && $row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]!=1){echo "Pending at Account Login";}   
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["discount_status"]==1)
    {echo "Pending Admin Approval";}       
    elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For Discounting";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tbody></table>
</div>
</div>

    <? }
    elseIf($tablename=="sub_user_creation")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">Sub User Creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 <tr><td>Date    </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

 <tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<!--<tr><td>Vehicle to move     </td><td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td></tr>-->

<tr><td>Vehicle to move </td><td><?php $vechile_no = explode(",",$row[0]["reg_no_of_vehicle_to_move"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Contact Person     </td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number     </td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Sub-User Name     </td><td><?echo $row[0]["name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["req_sub_user_pass"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Main User Separate</td><td><?echo $row[0]["billing_separate"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["sub_user_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["sub_user_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["sub_user_status"]==1){echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["sub_user_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tbody></table>
</div>

</div>

    <? }
    else If($tablename=="deactivation_of_account")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
        
		 $query1 = select_query("SELECT imei_of_removed_devices,other_imei_removed,client,device_location FROM stock_deactivation_of_account where deactivate_acc_id=".$RowId);

 
    ?><div id="databox">
<div class="heading">Deactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    

<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>    
<tr><td>Deactivate </td><td><?echo $row[0]["deactivate_temp"];?></td></tr>
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_removed_devices"];?></td></tr>     
 <tr><td>Alert Date </td><td><?echo $row[0]["alert_date"];?></td></tr>
<tr><td>Delete From Debtors </td><td><?echo $row[0]["delete_form_debtors"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr>
<tr>
    <td colspan="2">
        <table cellspacing="2" cellpadding="2">
            <tbody>
                <tr>
                    <td align="left">IMEI No.</td>
                    <td>Client Name</td>
                    <td>Device Location</td>
                </tr>
                <?php //while($get_imei = mysql_fetch_array($query1))
						for($da=0;$da<count($query1);$da++)
						{?>
                <tr>
                <?php if($query1[$da]["imei_of_removed_devices"]!=""){ ?>
                    <td><?php echo $query1[$da]["imei_of_removed_devices"];?></td>
                    <?php }else{ ?>
                    <td><?php echo $query1[$da]["other_imei_removed"];?></td>
                    <?php } ?>
                    <td><?php echo $query1[$da]["client"];?></td>
                    <td><?php echo $query1[$da]["device_location"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </td>
</tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["deactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";}
    elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["deactivation_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["deactivation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["deactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tbody></table>
</div>
</div>

<? }
    else If($tablename=="reactivation_of_account")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);


 
    ?><div id="databox">
<div class="heading">Reactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>    
<tr><td>Deactivate Account</td><td><?echo $row[0]["deactivate_temp"];?></td></tr>
<tr><td>Deactivate Reason</td><td><?echo $row[0]["deact_reason"];?></td></tr>
<tr><td>Deactivate Req Date</td><td><?echo $row[0]["deact_req_date"];?></td></tr>
<tr><td>Deactivate Close Date</td><td><?echo $row[0]["deact_close_date"];?></td></tr>

<tr><td>Reactivate Account Status</td><td><?echo $row[0]["reactivate_account_status"];?></td></tr>
<tr><td>Reactivate Reason</td><td><?echo $row[0]["reason"];?></td></tr>

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["reactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["reactivation_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["reactivation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["reactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Pending Amount</td>  <td><?echo $row[0]["pay_pending"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr><tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
</tbody>
    </table>
    </div>
    </div>

<? }
    else If($tablename=="dimts_imei")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

 
 
    ?>
    <div id="databox">
<div class="heading">View Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Sales Manager </td><td><?echo $row[0]["sales_manager"];?></td></tr>    
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Vehicle No</td><td><?echo $row[0]["veh_reg"];?></td></tr>        
<tr><td>7 digit IMEI </td><td><?echo $row[0]["device_imei_7"];?></td></tr>   
<tr><td>15 digit IMEI</td><td><?echo $row[0]["device_imei_15"];?></td></tr>
<tr><td>Changed to Port</td><td><?echo $row[0]["port_change"];?></td></tr>

 <tr><td colspan="2">-------------------------------------------</td> </tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["dimts_status"]==2 || (($row[0]["imei_upload_reason"]!="" || $row[0]["admin_comment"]!="") && $row[0]["support_comment"]=="" && $row[0]["service_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["dimts_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["dimts_status"]==1)
    {echo "Pending Admin Approval";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["support_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Tech Support for IMEI Uplode";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
    elseif($row[0]["support_comment"]!="" && $row[0]["repair_comment"]!="" && $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr></tbody>

    </table>
    </div>
    </div>

    <? }
    else If($tablename=="del_form_debtors")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">Delete From Debtors</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr>    
<tr><td>Date Of Creation  </td><td><?echo $row[0]["date_of_creation"];?></td></tr>
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_devices_removed"];?></td></tr>    
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["del_debtors_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["del_debtors_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["del_debtors_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["del_debtors_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>

    </tbody></table>
</div>
</div>

    <? }
    else If($tablename=="software_request")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">Software Request</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   

<tr><td>Company Name</td><td><?echo $row[0]["company"];?></td></tr>     
<tr><td>Total No Of Vehicle</td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>     
<tr><td>Potential</td><td><?echo $row[0]["potential"];?></td></tr> 

<tr><td>Requested Alerts:---</td><td></td></tr>     

<tr><td>Google Map</td><td><?echo $row[0]["rs_google_map"];?></td></tr>     
<tr><td>Admin </td><td><?echo $row[0]["rs_admin"];?></td></tr>    
<tr><td><tr><td>Type Of Alert</td><td><?echo $row[0]["alert"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact"];?></td></tr>     
<tr><td>Client Contact Number </td><td><?echo $row[0]["client_contact_num"];?></td></tr>
 </tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>
<tr><td><tr><td>Reports</td><td><?echo $row[0]["reports"];?></td></tr> 
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr>    
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["software_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["software_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["software_status"]==1){echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["software_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
 

</tbody></table>
</div>
</div>
    <?
    }

    else If($tablename=="transfer_the_vehicle")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">Transfer Vehicle</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_from_user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   

 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["date"];?></td></tr>    
<!--<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr> -->

<tr><td>Vehicle to move </td><td><?php $vechile_no = explode(",",$row[0]["transfer_from_reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>


<tr><td>Transfer To:--</td><td> </td></tr>
   
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Transfer User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   

<tr><td>Transfer Company Name     </td><td><?echo $row[0]["transfer_to_company"];?></td></tr>
<tr><td>Billing</td><td><?echo $row[0]["transfer_to_billing"];?></td></tr>     
     <tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>


</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["transfer_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["transfer_veh_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["transfer_veh_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["transfer_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
 

</tbody></table>
</div>
</div>
    <?
    }
    If($tablename=="device_change")
        {
    $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">View Device Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Veh Num</td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["mobile_no"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["rdd_username"];
    $rowuser_old=select_query($sql);
    ?>
<tr><td><strong>Replaced Device Info</strong></td><td>---------------------------</td></tr>
<tr><td>Client User</td><td><?echo $rowuser_old[0]["sys_username"];?></td></tr>
<tr><td>Client Name</td><td><?echo $row[0]["rdd_companyname"];?></td></tr>
<tr><td>Device Type</td><td><?echo $row[0]["rdd_device_type"];?></td></tr>
<tr><td>Vehicle No</td><td><?echo $row[0]["rdd_reg_no"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["rdd_device_model"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["rdd_device_id"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if(($row[0]["device_change_status"]==2 && $row[0]["rdd_device_type"]!="New") || (($row[0]["support_comment"]!="" || ($row[0]["admin_comment"]!="" && $row[0]["rdd_device_type"]!="New")) && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}   
 elseif($row[0]["rdd_device_imei"]=="" && $row[0]["rdd_reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
 elseif($row[0]["account_comment"]=="" && $row[0]["pay_status"]=="" && $row[0]["rdd_reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
 elseif($row[0]["rdd_device_type"]=="New" && ($row[0]["service_support_com"]=='' || $row[0]["device_change_status"]==2) && $row[0]["approve_status"]==0){echo "Pending at Delhi Service Support Login";}
 elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_change_status"]==1) 
 {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
 elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_status"]!="") && $row[0]["final_status"]==0 && $row[0]["device_change_status"]==1)
 {echo "Pending Admin Approval";}
 elseif($row[0]["approve_status"]==1 && $row[0]["device_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
 elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
    </tbody></table>
</div>

</div>

    <? }


    else If($tablename=="imei_change")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">IMEI Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

<tr><td>Veh Num</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["od_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["od_sim"];?></td></tr>
<tr><td>Date of installation</td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td><strong>Replaced IMEI Details</strong></td><td>---------------------------</td></tr>
 
<tr><td>Device Model</td><td><?echo $row[0]["new_devicetype"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["new_device_imei"];?></td></tr>

<?
if($row[0]["device_type"]=='New') {
$Deviceid=$row[0]["device_id"];
}
else if($row[0]["device_type"]=='Old') {
$Deviceid=$row[0]["old_device_id"];
}
?>

<tr><td>Device ID </td><td><? echo $Deviceid;?></td></tr>   
<tr><td>Mobile Number</td><td><?echo $row[0]["new_sim"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></tbody></table>
</div>
</div>
    <? }

    elseIf($tablename=="new_device_addition")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
          $row=select_query($query);
           
        $ffc_query= mssql_query("select ffc_reason from device_replace_ffc where imei_no='".$row[0]["device_imei"]."' order by id desc");
        $ffc_count = mssql_num_rows($ffc_query);
        $ffc_details = mssql_fetch_array($ffc_query);

    ?><div id="databox">
<div class="heading">View New device Addition</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

<tr><td>Vehicle Name</td><td><?echo $row[0]["vehicle_no"];?></td></tr>    
<tr><td>Device Type </td><td><?echo $row[0]["device_type"];?></td></tr>   
 <tr><td>Old Company Name </td><td><?echo $row[0]["old_device_client"];?></td></tr>   
<tr><td>Old Registration No </td><td><?echo $row[0]["old_vehicle_name"];?></td></tr>   
<tr><td>Device Model     </td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI </td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Device ID </td><td><?echo $row[0]["device_id"];?></td></tr>   
<tr><td>Device Mobile Number     </td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>Old Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>

<?  /*if($row[0]["device_type"]=='New'){
$biliing_status=$row[0]["billing"];
}
else{
$biliing_status=$row[0]["billing_if_old_device"];
}*/
    ?>

<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC      </td><td><?echo $row[0]["ac"];?></td></tr>
<tr><td>Device Type:  </td><td><?echo $row[0]["comment"];?></td></tr> 
<?php if($ffc_count > 0){?>
<tr><td><strong>FFC Reason </strong></td><td><?echo $ffc_details["ffc_reason"];?></td></tr>
<?php } ?>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_if_no_reason"];?></td></tr>   
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
 <tr><td><strong>Process Pending</strong> </td>  <td><strong>
<?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>

   
</tbody></table>
</div>
</div>
<? }


    else If($tablename=="deactivate_sim")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
    <div id="databox">
<div class="heading">Deactivate SIM</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>

<tr><td>Veh Num</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["device_sim"];?></td></tr>
<tr><td><strong>Present Status of Device</strong></td><td>---------------------------</td></tr>
<tr><td>Location</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Ownership</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>SIM Status</td><td><?echo $row[0]["sim_status"];?></td></tr>
<tr><td>Change Date</td><td><?echo $row[0]["change_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr></tbody></table></div></div>
 
 


    <? }
    else If($tablename=="vehicle_no_change")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

 
 
    ?><div id="databox">
<div class="heading">View Vehicle Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
  
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Registration No</td><td><?echo $row[0]["old_reg_no"];?></td></tr>        
<tr><td>New Registration No </td><td><?echo $row[0]["new_reg_no"];?></td></tr>   
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_reason"];?></td></tr>
<tr><td>Date     </td><td><?echo $row[0]["numberchange_date"];?></td></tr>
<tr><td>Vehicle No Change Reason </td><td><?echo $row[0]["reason"];?></td></tr>  
<tr><td>Client Request Reason </td><td><?echo $row[0]["vehicle_reason"];?></td></tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["reason"]=='Temperory no to Permanent no' || $row[0]["reason"]=='Personal no to Commercial no' || $row[0]["reason"]=='Commercial no to Personal no' || $row[0]["reason"]=='For Warranty Renuwal Purpose')
    {
        if($row[0]["vehicle_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
        {echo "Reply Pending at Request Side";}
        elseif($row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
        elseif($row[0]["final_status"]==1){echo "Process Done";}
    }
    else{
        if($row[0]["vehicle_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
        {echo "Reply Pending at Request Side";}
        elseif($row[0]["new_reg_no"]=="" && $row[0]["reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
        elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";}
        elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["vehicle_status"]==1)   
        {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
        elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["payment_status"]!="") && $row[0]["final_status"]==0 && $row[0]["vehicle_status"]==1)
        {echo "Pending Admin Approval";}
        elseif($row[0]["approve_status"]==1 && $row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
        elseif($row[0]["final_status"]==1){echo "Process Done";}
    } ?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
 
</tbody></table>
</div>

</div>

    <? }
    else If($tablename=="sim_change")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">View Mobile Number Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
   
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
 
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Registration No</td><td><?echo $row[0]["reg_no"];?></td></tr>        
<tr><td>Old Mobile Number </td><td><?echo $row[0]["old_sim"];?></td></tr>
<tr><td>New Mobile Number </td><td><?echo $row[0]["new_sim"];?></td></tr>   
 <tr><td>Sim Change Date     </td><td><?echo $row[0]["sim_change_date"];?></td></tr>   
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>   


</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Support Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?     if($row[0]["sim_change_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
        {echo "Reply Pending at Request Side";}
        elseif($row[0]["sim_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
        elseif($row[0]["final_status"]==1){echo "Process Done";}
     ?></strong></td></tr>
   
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr> 
  </tbody></table>
</div>
</div>
 
 
    <? }
    else If($tablename=="device_lost")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">View Device Lost</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
   

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   

<tr><td>Company Name</td><td><?echo $row[0]["client"];?></td></tr>     
<tr><td>Registration No </td><td><?echo $row[0]["odd_reg_no"];?></td></tr>     
<tr><td>Device Model </td><td><?echo $row[0]["odd_device_model"];?></td></tr>

<tr><td>Device IMEI </td><td><?echo $row[0]["odd_imei"];?></td></tr>     
<tr><td>Device Mobile Number  </td><td><?echo $row[0]["odd_sim"];?></td></tr>  
<tr><td>Date Of Installation   </td><td><?echo $row[0]["odd_instaltion_date"];?></td></tr>
<tr><td>New Device Detail:---</td><td></td></tr>     
 
<tr><td>Device Model </td><td><?echo $row[0]["ndd_device_model"];?></td></tr>     
<tr><td>Device Id  </td><td><?echo $row[0]["ndd_device_id"];?></td></tr>    
     
<tr><td>Device IMEI</td><td><?echo $row[0]["ndd_imei"];?></td></tr>     
<tr><td>Device Mobile Number  </td><td><?echo $row[0]["ndd_sim"];?></td></tr>
<tr><td>Date</td><td><?echo $row[0]["newdevice_addeddate"];?></td></tr>     
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["device_lost_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_lost_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["device_lost_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["device_lost_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td>
    </tr>
</tbody></table>
</div>
</div>

<?
    }


    else If($tablename=="installation")
        {
$query = "select * from  installation left join re_city_spr_1 on installation.Zone_area =re_city_spr_1.id where installation.id=".$RowId;
            $row=select_query($query);
    ?>
    <div id="databox">
<div class="heading">Installation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody><tr>
 <td> Date:  </td><td><?echo $row[0]["req_date"];?></td></tr>      
<tr><td>Request By:  </td><td><?echo $row[0]["request_by"];?></td></tr>
<? 
$sales=select_query("select name from sales_person where id='".$row[0]['sales_person']."'");
?>
<tr><td>Sales Person     </td><td><?echo $sales[0]['name'];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name    </td><td><?echo $row[0]["company_name"];?></td></tr>
<tr><td>No. Of Vehicales:   </td><td><?echo $row[0]["no_of_vehicals"];?></td></tr>
<tr><td>Area: </td><td><?echo $row[0]["name"];?></td></tr>      

<!--<tr><td>Location: </td><td><?echo $row[0]["location"];?></td></tr>-->
<?php if($row[0]['location']!=""){?>
<tr><td>Location: </td><td><?echo $row[0]["location"];?></td> </tr>
<?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
<tr><td>Location: </td><td><?echo $city[0]["city"];?></td> </tr>
<?php }?>
      
<tr><td>Model:</td><td><?echo $row[0]["model"];?></td></tr>
<tr><td>Available Time Status: </td><td><?echo $row[0]["atime_status"];?></td></tr>   
<tr><td>Time:  </td><td><?echo $row[0]["time"];?></td></tr> 
<tr><td>To Time:  </td><td><?echo $row[0]["totime"];?></td></tr>    
<tr><td>Contact No.:</td><td><?echo $row[0]["contact_number"];?></td></tr>        
<tr><td>Contact Person:   </td><td><?echo $row[0]["contact_person"];?></td></tr>    
<tr><td>DIMTS:   </td><td><?echo $row[0]["dimts"];?></td></tr>     
<tr><td>Demo:  </td><td><?echo $row[0]["demo"];?></td></tr>      
<tr><td>Vehicle Type:  </td><td><?echo $row[0]["veh_type"];?></td></tr>      
<tr><td>Immobilizer:  </td><td><?echo $row[0]["immobilizer_type"];?></td></tr>  
 
 
 </tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Payment:  </td><td><?echo $row[0]["payment_req"];?></td>
 <tr><td>Amount:  </td><td><?echo $row[0]["amount"];?></td>
 <tr><td>Payment Mode:  </td><td><?echo $row[0]["pay_mode"];?></td>
 <tr><td>Required.:</td><td><?echo $row[0]["required"];?></td></tr>    
<tr><td>IP Box.:    </td><td><?echo $row[0]["IP_Box"];?></td></tr> 
<tr><td>Contact Person No.:  </td><td><?echo $row[0]["contact_person_no"];?></td></tr>  
<tr><td>Installation Made:  </td><td><?echo $row[0]["installation_made"];?></td></tr> 
<tr><td>Installer Name: </td><td><?echo $row[0]["inst_name"];?></td></tr> 
<tr><td>Installer Current Location: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr> 
<!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>  
--><tr><td>Installation Done At: </td><td><?echo $row[0]["rtime"];?></td></tr> 
<tr><td>Reason To Back Services:</td><td><?echo $row[0]["back_reason"];?></td> </tr>

<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
    elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
    elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
    elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
    elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
    elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
    elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
    elseif($row[0]["installation_status"]==5 && $row[0]["installation_status"]==6){echo "Installation Close";}?></strong></td></tr>

<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>

</tbody></table>
</div>
</div>

    <? }


    else If($tablename=="services")
        {
          $query = "SELECT * FROM services left join re_city_spr_1 on services.Zone_area =re_city_spr_1.id  where services.id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">Service</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody><tr>
 
     <td>  Date    </td><td><?echo $row[0]["req_date"];?></td></tr>
<tr><td>Request By    </td><td><?echo $row[0]["request_by"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name    </td><td><?echo $row[0]["company_name"];?></td></tr>
<tr><td>Registration No    </td><td><?echo $row[0]["veh_reg"];?></td></tr>
 
<tr><td>Device Model:    </td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI:    </td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Date Of Installation:    </td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td>Not working:</td><td><?echo $row[0]["Notwoking"];?></td></tr>   

<tr><td>Area: </td><td><?echo $row[0]["name"];?></td></tr>

<?php if($row[0]['location']!=""){?>
<tr><td>Location: </td><td><?echo $row[0]["location"];?></td> </tr>
<?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
<tr><td>Location: </td><td><? echo $city[0]["city"];?></td> </tr>
<?php }?>
<tr><td>Available Time Status: </td><td><?echo $row[0]["atime_status"];?></td></tr>   
<tr><td>Available Time: </td><td><?echo $row[0]["atime"];?></td></tr>   
<tr><td>To Available Time: </td><td><?echo $row[0]["atimeto"];?></td></tr>
<tr><td>Person Name: </td><td><?echo $row[0]["pname"];?></td></tr>
<tr><td>Contact No: </td><td><?echo $row[0]["cnumber"];?></td></tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Job:     </td><td><?echo $row[0]["service_reinstall"];?></td></tr>
<tr><td>Required:     </td><td><?echo $row[0]["required"];?></td></tr>
<tr><td>IP Box:     </td><td><?echo $row[0]["IP_Box"];?></td></tr>
<tr><td>Comment</td><td><?echo $row[0]["comment"];?></td></tr>
<tr><td>Reason To Back Services:</td><td><?echo $row[0]["back_reason"];?></td></tr> 
    <tr><td>Installer Name: </td><td><?echo $row[0]["inst_name"];?></td></tr> 
<tr><td>Installer Current Location: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr> 
<!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>  
-->
    <tr><td>Problem:</td><td><?echo $row[0]["reason"];?></td></tr> 
    <tr><td>Problem Due to:</td><td><?echo $row[0]["problem_in_service"];?></td></tr> 
    <tr><td>Reason:</td><td><?echo $row[0]["problem"];?></td></tr> 
    <tr><td>Antenna Billing:</td><td><?echo $row[0]["ant_billing_amt"];?></td></tr> 
    <tr><td>Billing Reason:</td><td><?echo $row[0]["ant_billing_reason"];?></td></tr> 
    <tr><td>Forward to Repair :</td><td><?echo $row[0]["fwd_serv_to_repair"];?></td></tr>
    <tr><td>Repair Reason:</td><td><?echo $row[0]["fwd_repair_to_serv"];?></td></tr>

<tr><td>Service Done At: </td><td><?echo $row[0]["time"];?></td></tr> 
 </table>
    </div>
    </div>


    <?
    }


    else If($tablename=="deletion")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">Deletion Vehicle</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
  <tr><td>date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
 
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
     
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>        
<tr><td>Registration No </td><td><?echo $row[0]["reg_no"];?></td></tr>        
<tr><td>Device Model     </td><td><?echo $row[0]["device_model"];?></td></tr>    
<tr><td>Device IMEI     </td><td><?echo $row[0]["imei"];?></td></tr>    
<tr><td>Device Mobile Number </td><td><?echo $row[0]["device_sim_no"];?></td></tr>        
<tr><td>Date Of Installation </td><td><?echo $row[0]["date_of_installation"];?></td></tr>        
<tr><td>Present Status of device</td><td>----------------------</td></tr>
<tr><td>Device Status</td><td><?echo $row[0]["device_status"];?></td></tr>    
<tr><td>Location     </td><td><?echo $row[0]["vehicle_location"];?></td></tr>    
<tr><td>Contact person     </td><td><?echo $row[0]["Contact_person"];?></td></tr>    
<tr><td>Deactivation of SIM     </td><td><?echo $row[0]["deactivation_of_sim"];?></td></tr>
<tr><td>Deletion date     </td><td><?echo $row[0]["deletion_date"];?></td></tr>    
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>    
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["delete_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["vehicle_location"]=="gtrack office" && $row[0]["stock_comment"]==""){echo "Pending at Stock";}
    elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["delete_veh_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["delete_veh_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["delete_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
  <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!="")
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}

?></td></tr>
<tr><td>Closed By</td><td><?echo $row[0]["req_close_by"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!="" )
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td></tr>
</tbody></table>
</div>

    <?
    }
    }
?>