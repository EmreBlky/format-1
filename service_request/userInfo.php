<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");
//include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

//include($_SERVER["DOCUMENT_ROOT"]."/service/sqlconnection.php");

$q=$_GET["user_id"];

$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$inst_id=$_GET["inst_id"];
$comment=$_GET["comment"];


if(isset($_GET['action']) && $_GET['action']=='pricing')
{
         
  $sql="SELECT * FROM $internalsoftware.new_account_creation WHERE user_name=(SELECT UserName FROM $internalsoftware.addclient WHERE Userid='".$q."') ORDER BY id DESC limit 1";
  $row=select_query($sql);
  
  if($row[0]["mode_of_payment"] == 'Cheque')
  {
    echo $row[0]["mode_of_payment"].'##'.$row[0]["device_price"].'##'.$row[0]["device_rent_Price"]; 
  }
  else if($row[0]["mode_of_payment"] == 'Cash' || $row[0]["mode_of_payment"] == 'Lease')
  {
    echo $row[0]["mode_of_payment"].'##'.$row[0]["device_price_total"].'##'.$row[0]["DTotalREnt"]; 
  }
  else if($row[0]["mode_of_payment"] == 'Demo')
  {
    echo $row[0]["mode_of_payment"].'##'.$row[0]["demo_time"]; 
  }
  else if($row[0]["mode_of_payment"] == 'FOC' || $row[0]["mode_of_payment"] == 'Trip Based')
  {
    echo $row[0]["mode_of_payment"].'##'.$row[0]["device_price"].'##'.$row[0]["device_rent_Price"];
  }
  else
  {
    echo $row[0]["mode_of_payment"].'##'.$row[0]["device_price"].'##'.$row[0]["device_rent_Price"];
  }
    
    
}

if(isset($_GET['action']) && $_GET['action']=='countDeletedImei')
{    
    $sql="select imei from $internalsoftware.deletion where final_status=1 and user_id=".$row_id;  
    $row=select_query($sql);  
    echo json_encode($row);
}

if(isset($_GET['action']) && $_GET['action']=='getAllImei')
  {
    //echo 'tt'; die;
    $device_imei_data=array();
    $userId=$_GET['userId'];
    $deviceStatus=$_GET['dStatus'];
    //$sql="select distinct(imei) from deletion where user_id=".$userId;

    $deactive_query = select_query_live_con("SELECT sys_service_id FROM matrix.group_services WHERE active=0 AND sys_group_id=(SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$userId."')");

          //print_r($deactive_query); die;
    //echo count($deactive_query);die;

            $veh_id_get = "";
            $veh_id_data = "";
            for($ser=0;$ser<count($deactive_query);$ser++)
            {
                $veh_id_get.= $deactive_query[$ser]['sys_service_id']."','";
            }

            $veh_id_data=substr($veh_id_get,0,strlen($veh_id_get)-3);

            //echo "SELECT id,sys_device_id FROM matrix.services WHERE id IN ('".$veh_id_data."')";die;

            $device_get_query = select_query_live_con("SELECT id,sys_device_id FROM matrix.services WHERE id IN ('".$veh_id_data."')");

            //print_r($device_get_query);die;

            $sys_device_id = "";
            $sys_device_id_data='';
            for($de=0;$de<count($device_get_query);$de++)
            {
                $sys_device_id.= $device_get_query[$de]['sys_device_id']."','";
            }
            //echo $sys_device_id;die;

            $sys_device_id_data=substr($sys_device_id,0,strlen($sys_device_id)-3);
            //echo $sys_device_id_data; die;

            $sys_device_imei = "";
            $sys_device_imei_data='';

            $sys_device_imei_arr= select_query_live_con("SELECT device_imei FROM matrix.device_mapping WHERE device_id IN ('".$sys_device_id_data."')");

            //print_r($sys_device_imei_arr);die;
             for($e=0;$e<count($sys_device_imei_arr);$e++)
            {
                $sys_device_imei.= $sys_device_imei_arr[$e]['device_imei']."','";
            }

            $sys_device_imei_data =substr($sys_device_imei,0,strlen($sys_device_imei)-3);

            $IMEI =  "'".$sys_device_imei_data."'";

            if(count($sys_device_imei_arr) > 0){

              if($deviceStatus == 1){
                //echo "SELECT device_imei FROM inventory.device WHERE device_status IN (57,63,64) and device_imei IN ($IMEI)";die;
                $result=select_query_inventory("SELECT device_imei FROM inventory.device WHERE device_status IN (57,63,64) and device_imei IN ($IMEI)");
                //print_r($result);die;

              }
              else{
               //echo "SELECT device_imei FROM inventory.device WHERE device_status IN (103) and device_imei IN ($IMEI)";die;
                $result=select_query_inventory("SELECT device_imei FROM inventory.device WHERE device_status IN (103) and device_imei IN ($IMEI)");
                //print_r($result);die;

              }

            }
            echo json_encode($result);
  }


  if(isset($_GET['action']) && $_GET['action']=='imeiDeviceType')
  { 
      $imei=$_GET['imeiNo']; 

     $query="select device_type from inventory.device where device_imei=".$imei; 
     //echo $query; die;

    $deviceType=select_query_inventory($query);
   // echo '<pre>'; print_r($deviceType); die;

     $sql="select im.item_id,im.item_name as childName,imm.item_name as parentName from inventory.item_master as im,inventory.item_master as imm where im.item_id='".$deviceType[0]['device_type']."' and imm.item_id=im.parent_id";      
     // echo $sql; die;

      $row=select_query_inventory($sql);

    echo $row[0]['parentName'];
  }

  if(isset($_GET['action']) && $_GET['action']=='imeiModelName')
  { 
    $imei=$_GET['imeiNo'];

    $query="select device_type from inventory.device where device_imei=".$imei;

    $deviceType=select_query_inventory($query);

    $sql="select im.item_id,im.item_name as childName,imm.item_name as parentName from inventory.item_master as im,inventory.item_master as imm where im.item_id='".$deviceType[0]['device_type']."' and imm.item_id=im.parent_id";     
    $row=select_query_inventory($sql);

    echo $row[0]['childName'];
}


if(isset($_GET['action']) && $_GET['action']=='imeistatus')
  {   
   $imei=$_GET['imeiNo'];
   $sql="SELECT device_status from inventory.device where device_imei=".$imei; 
  
   $row=select_query_inventory($sql); 

  if($row[0]['device_status'] == '103')
    {    
      echo "Client Office"; 
    } 
    else if($row[0]['device_status'] == '65')
    {    
      echo "Device Installed";  
    } 
    else if($row[0]['device_status'] == '57')
      {    
        echo "G-TRAC";  
      } 
    else if($row[0]['device_status'] == '63')
      {    
        echo "G-TRAC";  
      } 
      else if($row[0]['device_status'] == '64')
      {    
        echo "G-TRAC";  
      } 
      else if($row[0]['device_status'] == '116')
      {   
        echo "G-TRAC";  
      } 
      else
      {   echo "Under Process";
      }
  }

if(isset($_GET['action']) && $_GET['action']=='toolsAccessories')
{

  $toolName=array();

  //print_r($toolName);
//echo "select accessories_tollkit from new_account_creation where user_id=".$q; die;
  $sql=select_query("select accessories_tollkit from new_account_creation where user_id=".$q);
if(count($sql)>0)
  {
  $toolkitId = explode("#",$sql[0]['accessories_tollkit']);

  for($i=0;$i<=count($toolkitId)-1;$i++){

    $sqlToolsName=select_query("select * from toolkit_access where id='".$toolkitId[$i]."'");
  
      $data = array(

        "item_id"=>$sqlToolsName[0]['id'],
        "item_name"=>$sqlToolsName[0]['items']

      );

      array_push($toolName,$data);

    }
    echo json_encode($toolName);
  }
  else
  {
    echo '0';
  }

  

}

if(isset($_GET['action']) && $_GET['action']=='deviceName')
{ 
    $userId=$_GET["user_id"];
 
    // $sql2="SELECT dtype.id as dev_type_id,dtype.device_type as deviceType FROM new_account_model_master as newmodel LEFT JOIN device_type as dtype ON newmodel.device_type=dtype.id WHERE new_account_reqid='".$userId."'"; 
    // //echo $sql2; die;
    // $row2=select_query($sql2);  
    // echo json_encode($row2);

    $select=select_query("select id from $internalsoftware.new_account_creation where user_id='".$userId."' ");
    $acc_req_id=$select[0]['id'];

    //  $select=select_query("select new_account_reqid from $internalsoftware.new_account_model_master where user_id='".$userId."' ");
    // $acc_req_id=$select[0]['id'];

  $sql2="SELECT distinct dtype.item_id as dev_type_id,dtype.item_name as deviceType FROM new_account_model_master as newmodel LEFT JOIN item_master as dtype ON newmodel.device_type=dtype.item_id WHERE new_account_reqid='".$acc_req_id."'"; 
    //echo $sql2; die;
    $row2=select_query($sql2);  
    echo json_encode($row2);
}

if(isset($_GET['action']) && $_GET['action']=='modelname')
{ 
    $dev_type_id=$_GET["dev_type"];
    $userId1=$_GET["user_id"]; 

    $select=select_query("select id from $internalsoftware.new_account_creation where user_id='".$userId1."' ");
    $acc_req_id=$select[0]['id'];
    // $sql2="SELECT dm.id as model_id,dm.device_model as model_name from new_account_model_master as newmodel inner join device_model as dm  ON newmodel.device_model=dm.id WHERE newmodel.new_account_reqid='".$userId1."' and dm.parent_id='".$dev_type_id."'" ;
    // //echo $sql2; die;
    // $row2=select_query($sql2);  
    // echo json_encode($row2);

      $sql2="SELECT dm.item_id as model_id,dm.item_name as model_name from new_account_model_master as newmodel inner join item_master as dm  ON newmodel.device_model=dm.item_id WHERE newmodel.new_account_reqid='".$acc_req_id."' and dm.parent_id='".$dev_type_id."'" ;
    //echo $sql2; die;
    $row2=select_query($sql2);  
    echo json_encode($row2);
}

if(isset($_GET['action']) && $_GET['action']=='salespersonname')
{
  $sql="SELECT name AS 'sales_person_name' FROM addclient ac LEFT JOIN sales_person sp ON ac.sales_person_id = sp.id  WHERE ac.Userid=".$q;

  $row=select_query($sql);

  echo $row[0]["sales_person_name"];
}

if(isset($_GET['action']) && $_GET['action']=='deletevehiclebackComment')
{
   
     $query = "SELECT forward_back_comment FROM deletion  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update deletion set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='devicechangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM device_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update device_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='InstallationbackComment')
{

    $query = "SELECT sales_comment FROM installation_request  where id=".$row_id;
     $row=select_query($query);

     $Updateapprovestatus="update installation_request set sales_comment='".$row[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',installation_status='8' where id=".$row_id;
     mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='InstallationConfirm')
{
    //  $query = "SELECT * FROM installation_request  where id=".$row_id;
    //  $row=select_query($query);
    //  $approve_inst = $row[0]["installation_approve"];
    //  $time_status = $row[0]["atime_status"];
   
    // for($N=1;$N<=$approve_inst;$N++)
    // {       
    //     if($time_status == "Till")
    //     {
    //         $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location,model,time, contact_number,installed_date, status, contact_person, dimts,demo, veh_type,comment, immobilizer_type, payment_req,required, IP_Box,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, approve_status, installation_approve, approve_date, fuel_sensor, bonnet_sensor, rfid_reader, speed_alarm, door_lock_unlock, temperature_sensor, duty_box, panic_button) VALUES('".$row[0]["id"]."','".$row[0]["req_date"]."','".$row[0]["request_by"]."','".$row[0]["sales_person"]."', '".$row[0]["user_id"]."', '".$row[0]["company_name"]."','1','".$row[0]["location"]."','".$row[0]["model"]."','".$row[0]["time"]."','".$row[0]["contact_number"]."','".$row[0]["installed_date"]."',1,'".$row[0]["contact_person"]."','".$row[0]["dimts"]."','".$row[0]["demo"]."','".$row[0]["veh_type"]."','".$row[0]["comment"]."','".$row[0]["immobilizer_type"]."','".$row[0]["payment_req"]."','".$row[0]["required"]."','".$row[0]["IP_Box"]."','".$row[0]["branch_id"]."','1','".$row[0]["Zone_area"]."','".$row[0]["atime_status"]."','".$row[0]["inter_branch"]."','".$row[0]["branch_type"]."','".$row[0]["instal_reinstall"]."','".$row[0]["approve_status"]."','1','".$row[0]["approve_date"]."','".$row[0]["fuel_sensor"]."','".$row[0]["bonnet_sensor"]."','".$row[0]["rfid_reader"]."','".$row[0]["speed_alarm"]."','".$row[0]["door_lock_unlock"]."','".$row[0]["temperature_sensor"]."','".$row[0]["duty_box"]."','".$row[0]["panic_button"]."')";
               
    //         $execute_inst=mysql_query($installation);
    //     }
       
    //     if($time_status == "Between")
    //     {
    //         $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location,model,time,totime, contact_number,installed_date, status, contact_person, dimts,demo, veh_type,comment, immobilizer_type, payment_req,required, IP_Box,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, approve_status, installation_approve, approve_date, fuel_sensor, bonnet_sensor, rfid_reader, speed_alarm, door_lock_unlock, temperature_sensor, duty_box, panic_button) VALUES('".$row[0]["id"]."','".$row[0]["req_date"]."','".$row[0]["request_by"]."','".$row[0]["sales_person"]."', '".$row[0]["user_id"]."', '".$row[0]["company_name"]."','1','".$row[0]["location"]."','".$row[0]["model"]."','".$row[0]["time"]."','".$row[0]["totime"]."','".$row[0]["contact_number"]."','".$row[0]["installed_date"]."',1,'".$row[0]["contact_person"]."','".$row[0]["dimts"]."','".$row[0]["demo"]."','".$row[0]["veh_type"]."','".$row[0]["comment"]."','".$row[0]["immobilizer_type"]."','".$row[0]["payment_req"]."','".$row[0]["required"]."','".$row[0]["IP_Box"]."','".$row[0]["branch_id"]."','1','".$row[0]["Zone_area"]."','".$row[0]["atime_status"]."','".$row[0]["inter_branch"]."','".$row[0]["branch_type"]."','".$row[0]["instal_reinstall"]."','".$row[0]["approve_status"]."','1','".$row[0]["approve_date"]."','".$row[0]["fuel_sensor"]."','".$row[0]["bonnet_sensor"]."','".$row[0]["rfid_reader"]."','".$row[0]["speed_alarm"]."','".$row[0]["door_lock_unlock"]."','".$row[0]["temperature_sensor"]."','".$row[0]["duty_box"]."','".$row[0]["panic_button"]."')";
               
    //             $execute_inst=mysql_query($installation);
    //     }
    // }
           
    $Updateapprovestatus="update installation_request set installation_status=1 where id=".$row_id;
    mysql_query($Updateapprovestatus);
   
}

/*if(isset($_GET['action']) && $_GET['action']=='FFCDeviceRslt')
{
    $ffc_imei = $_GET["ffc_imei"];
    $ffc_details = mssql_fetch_array(mssql_query("select old_client_name,ffc_date,old_veh from device_replace_ffc where imei_no=".$ffc_imei));

    //echo $ffc_data = $ffc_details["old_client_name"]."~".$ffc_details["old_veh"]."~".$ffc_details["ffc_date"];
    echo $ffc_data = 'harish'."~".'HR30A4567'."~".'2015-05-30 15:34:27';
}*/

if(isset($_GET['action']) && $_GET['action']=='serviceComment')
{
    $query = "SELECT service_comment FROM device_change  where id=".$row_id;
    $row=select_query($query);
     
    $Updateapprovestatus="update device_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', device_change_status='1' where id=".$row_id;
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

/*if(isset($_GET['action']) && $_GET['action']=='InstallationClosed')
{
    $Updateapprovestatus="update installation set inst_close_reason='".date("Y-m-d H:i:s")." - ".$comment."',installation_status='5' where id=".$row_id;
    mysql_query($Updateapprovestatus);
}*/


if(isset($_GET['action']) && $_GET['action']=='AccCreationServiceComment')
{
    $query = "SELECT sales_comment FROM new_account_creation  where id=".$row_id;
    $row=select_query($query);
     
    $Updateapprovestatus="update new_account_creation set sales_comment='".$row[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', acc_creation_status='1' where id=".$row_id;
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='NewDeviceAddComment')
{
    $query = "SELECT service_comment FROM new_device_addition where id=".$row_id;
    $row=select_query($query);
     
    $Updateapprovestatus="update new_device_addition set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', new_device_status='1' where id=".$row_id;
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='renew_serviceComment')
{
    $query = "SELECT service_comment FROM renew_dimts_imei  where id=".$row_id;
    $row=select_query($query);
     
    $Updateapprovestatus="update renew_dimts_imei set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', renew_dimts_status='1' where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='DevicecloseComment')
{
   
    $Updateapprovestatus="update device_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',service_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='newdeviceadditionbackComment')
{
   
        $query = "SELECT forward_back_comment FROM new_device_addition  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update new_device_addition set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='vehiclenochangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM vehicle_no_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update vehicle_no_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='vehicleserviceComment')
{
   
     $query = "SELECT service_comment FROM vehicle_no_change  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update vehicle_no_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', vehicle_status='1' where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='vehiclecloseComment')
{
   
    $Updateapprovestatus="update vehicle_no_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='simchangebackComment')
{
   
        $query = "SELECT forward_back_comment FROM sim_change  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update sim_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='SimcloseComment')
{
   
    $Updateapprovestatus="update sim_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
   
    mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='simchangeserviceComment')
{
   
        $query = "SELECT service_comment FROM sim_change  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update sim_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',sim_change_status=1 where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='devicelostbackComment')
{
   
        $query = "SELECT forward_back_comment FROM device_lost  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update device_lost set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='deactivatesimbackComment')
{
   
        $query = "SELECT forward_back_comment FROM deactivate_sim  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update deactivate_sim set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='dimtsimeibackComment')
{
   
        $query = "SELECT forward_back_comment FROM dimts_imei  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='RenewdimtsimeibackComment')
{
   
        $query = "SELECT forward_back_comment FROM renew_dimts_imei  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update renew_dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='aacountcreationbackComment')
{
   
        $query = "SELECT forward_back_comment FROM new_account_creation  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update new_account_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='RenewDimtsImiei')
{
   
        $query = "SELECT * FROM dimts_imei  where id=".$row_id;
       $row=select_query($query);
       
        $Updateapprovestatus="update dimts_imei set renew_status='Y',renew_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
        mysql_query($Updateapprovestatus);
       
        $renew_query="INSERT INTO `renew_dimts_imei` (`date`,sales_manager,acc_manager,`client`,`user_id`,`veh_reg`, `device_imei_7`,device_imei_15,port_change,reason)
        VALUES ('".date("Y-m-d H:i:s")."','".$row[0]["sales_manager"]."','".$row[0]["acc_manager"]."','".$row[0]["client"]."','".$row[0]["user_id"]."','".$row[0]["veh_reg"]."','".$row[0]["device_imei_7"]."','".$row[0]["device_imei_15"]."','".$row[0]["port_change"]."','".$comment."')";
       
        mysql_query($renew_query);     
}

if(isset($_GET['action']) && $_GET['action']=='getdata')
{
 
    $result="select services.id as id,services.id,veh_reg from matrix.services
   
    where services.id in
    
    (select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
    
    select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";

                                                                 
  $data=select_query_live_con($result);
  //$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");ShowDeviceInfo(this.value);

  $msg=' <select name="veh_reg" id="<?=$select_id?>" onchange="getdeviceImei(this.value,\'TxtDeviceIMEI\');getInstaltiondate(this.value,\'date_of_install\');getdevicemobile(this.value,\'Devicemobile\');">
  <option value="0">Select Vehicle No</option>';

  //while($row = mysql_fetch_array($data))
  for($i=0;$i<count($data);$i++)
    {
      if($i%3==0) {
      $msg .="</tr><tr>";
      }
    $msg .="<option value='".$data[$i]['veh_reg']."'>".$data[$i]['veh_reg']."</option>"; 
   
    }
   
   
    $msg .="</select>";
   
    echo $msg;
}


if(isset($_GET['action']) && $_GET['action']=='getdatareplce')
{
 
  $result="select services.id as id,services.id,veh_reg from $matrix.services
 
where services.id in (select distinct sys_service_id from $matrix.group_services where active=true and sys_group_id in (

select sys_group_id from $matrix.group_users where sys_user_id=(".$q.")))";

                                                               
$data=select_query_live_con($result);
$num_row = count($data);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");ShowDeviceInfo(this.value);

$msg=' <select name="veh_reg_replce" id="veh_reg_replce" onchange="getdeviceImei(this.value,\'replaceDeviceIMEI\');getInstaltiondate(this.value,\'replacedate_of_install\');getInstaltiondate(this.value,\'replacedate_oInstaltiondate_install\');getdevicemobile(this.value,\'replaceDevicemobile\');">
<option value="0">Select Vehicle No</option>';


if($num_row > 0){

//while($row = mysql_fetch_array($data))
for($i=0;$i<count($data);$i++)
  {

  $vehreg=str_replace(" ",",",$data[$i]['veh_reg']);
    if($i%3==0) {
    //$msg .="</tr><tr>";
    }
  $msg .="<option value=".$vehreg.">".$data[$i]['veh_reg']."</option>"; 
 
  }
 
}

  $msg .="</select>";
 
  echo $msg;
}
 

if(isset($_GET['action']) && $_GET['action']=='ReInstalltion')
{
 
    $UserId=$_GET["user_id"];
       
    $vehicle_id_row = select_query_live_con("SELECT sys_service_id FROM $matrix.group_services WHERE active=0 AND sys_group_id=(SELECT sys_group_id FROM $matrix.group_users where sys_user_id='".$UserId."')");
   
    $veh_id_get = "";
    //while($vehicle_id_row = mysql_fetch_array($deactive_query))
  for($re=0;$re<count($vehicle_id_row);$re++)
    {
        $veh_id_get.= $vehicle_id_row[$re]['sys_service_id']."','";
    }
    $veh_id_data=substr($veh_id_get,0,strlen($veh_id_get)-3);
   
    $device_get_row = select_query_live_con("SELECT id,sys_device_id FROM $matrix.services WHERE id IN ('".$veh_id_data."')");
   
    $sys_device_id = "";
    //while($device_get_row = mysql_fetch_array($device_get_query))
  for($de=0;$de<count($device_get_row);$de++)
    {
        $sys_device_id.= $device_get_row[$de]['sys_device_id']."','";
    }
    $sys_device_id_data=substr($sys_device_id,0,strlen($sys_device_id)-3);
   
    $result = select_query_live_con("SELECT device_imei FROM $matrix.device_mapping WHERE device_id IN ('".$sys_device_id_data."')"); 
   
    /*$imei_no_row = "";
    while($imei_get_row = mysql_fetch_array($imei_query))
    {
        $no_of_imei = str_replace("_","",$imei_get_row['device_imei']);
        $imei_no_row.= $no_of_imei."','";
    }
    $imei_no_data=substr($imei_no_row,0,strlen($imei_no_row)-3);
   
    $result = mysql_query("SELECT imei FROM internalsoftware.deletion where user_id='".$UserId."' AND imei in ('".$imei_no_data."') AND final_status=1 AND ((device_status IN('Sold Vehicle','Vehicle Stand For Long Time','Stop GPS') and vehicle_location IN('gtrack office','client office')) or (device_status IN('Device Lost','Device Dead') and vehicle_location IN('gtrack office')) or  (vehicle_location IN('gtrack office','client office') and device_status is null)) order by id DESC");*/
   

$msg.=" <select  name='deleted_imei'  id='deleted_imei'>
    <option value=''>Select imei</option>";
 
  //while($row = mysql_fetch_array($result))
  for($r=0;$r<count($result);$r++)
  {
     
     $device_imei = str_replace("_","",$result[$r]['device_imei']);
    if($device_imei !='')
    {
           $msg .="<option value=".$device_imei.">".$device_imei."</option>";
    }
   
  }
 
  $msg .="</select></td></tr>";
    
  echo $msg;
}



if(isset($_GET['action']) && $_GET['action']=='total')
    {
          $result="select services.id as id,services.id,veh_reg from $matrix.services
 
where services.id in

(select distinct sys_service_id from $matrix.group_services where active=true and sys_group_id in (

select sys_group_id from $matrix.group_users where sys_user_id=(".$q.")))";

                                                               
    $data=select_query_live_con($result);
    
        echo count($data);
    }

if(isset($_GET['action']) && $_GET['action']=='companyname')
    {echo "tt";die;
         
        $sql="select `group`.name as company from $matrix.group_users left join $matrix.`group` on group_users.sys_group_id=`group`.id where group_users.sys_user_id=".$q;
        //echo $sql;die;
        $row=select_query_live_con($sql);

        echo $row[0]["company"];
    }


if(isset($_GET['action']) && $_GET['action']=='creationdate')
    {
         
        $sql="select * from $matrix.users where id=".$q;

        $row=select_query_live_con($sql);

        echo date("d-M-Y",strtotime($row[0]["sys_added_date"]));
    }



if(isset($_GET['action']) && $_GET['action']=='deviceImei')
    {
       
      $sql1="select imei from $matrix.devices where id in
  (select sys_device_id from $matrix.services where veh_reg='".str_replace(","," ",$veh_reg)."') limit 1";
    $row=select_query_live_con($sql1);
     
 echo $row[0]["imei"];
    }
   
   
if(isset($_GET['action']) && $_GET['action']=='deviceMobile')
    {
         
       $sql1="select mobile_no from $matrix.mobile_simcards where id in ( select sys_simcard from matrix.devices where id in (select sys_device_id from $matrix.services where veh_reg='".str_replace(","," ",$veh_reg)."'))";
    $row=select_query_live_con($sql1);
     
     echo $row[0]["mobile_no"];
    }


if(isset($_GET['action']) && $_GET['action']=='installermobile')
    {
       
        $sql2="select installer_mobile as installer_mobile from installer where inst_id=".$inst_id;

        $row2=select_query($sql2);

        echo $row2[0]["installer_mobile"];
    }


if(isset($_GET['action']) && $_GET['action']=='Instaltiondate')
    {
         
        $sql="select sys_created from $matrix.services where veh_reg='".str_replace(","," ",$veh_reg)."' limit 1";
 
        $row=select_query_live_con($sql);

        echo date("Y-m-d",strtotime($row[0]["sys_created"]));
    }
   
   
if(isset($_GET['action']) && $_GET['action']=='dimts_imeiclose')
{
    $Updateapprovestatus="update dimts_imei set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='Renewdimts_imeiclose')
{
    $Updateapprovestatus="update renew_dimts_imei set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='Port_change')
{
    $Updateapprovestatus="update renew_dimts_imei set port_change_status='Yes' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully Submit";
}
   
if(isset($_GET['action']) && $_GET['action']=='debugComment')
{
   
   
     $Comment_by=$_SESSION['username'];
   
        //$Updateapprovestatus="update device_lost set account_comment='".addslashes($comment)."' where id=".$row_id;
          $Updateapprovestatus="insert into comment(service_id,comment,comment_by) values('".$row_id."','".addslashes($comment)."','".$Comment_by."')";
     //if(mysql_query($Updateapprovestatus))
      echo "Comment Added Successfully";
   
 }

   
 ?>
 

 
 <?
 

    if(isset($_GET['action']) && $_GET['action']=='getrowSales')
    {
         
         
            $RowId=$_GET["RowId"];
            $tablename=$_GET["tablename"];
           
     ?>
     
<style type="text/css">
#databox{width:840px; height:650px; margin: 30px auto auto; border:1px solid #bfc0c1; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; color:#3f4041;}
.heading{ font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:700; word-spacing:5px; text-align:center;   color:#3E3E3E;   background-color:#ECEFE7; margin-bottom:10px;  }
.dataleft{float:left; width:400px; height:400px; margin-left:10px; border-right:1px solid #bfc0c1;}
.dataright{float:right; width:400px; height:400px; margin-left:19px;}
td{padding-right:20px; padding-left:20px;}
</style>
 
<?

If($tablename=="device_change")
        {
    $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
   
    <div id="databox">
<div class="heading">
    View Device Change</div>
    <div class="dataleft">
<table cellspacing="2" cellpadding="2">     
    
    
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
<tr><td>Date of installation </td><td><?echo $row[0]["date_of_install"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["rdd_username"];
    $rowuser_old=select_query($sql);
    ?>
<tr><td>Replaced Device Details</td><td>---------------------------</td></tr>
<tr><td>Client User</td><td><?echo $rowuser_old[0]["sys_username"];?></td></tr>
<tr><td>Client Name</td><td><?echo $row[0]["rdd_companyname"];?></td></tr>
<tr><td>Device Type</td><td><?echo $row[0]["rdd_device_type"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["rdd_device_model"];?></td></tr>
<tr><td>Vehicle No</td><td><?echo $row[0]["rdd_reg_no"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
<tr><td>Date of installation </td><td><?echo $row[0]["rdd_date_replace"];?></td></tr>
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Amount</td><td><?echo $row[0]["billing_amount"];?></td></tr>
</table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2">

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

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td>Payment Pending </td>  <td><?echo $row[0]["pay_status"];?></td></tr>
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
    </table>
    </div>
    </div>   
    <? }

    else If($tablename=="new_account_creation")
        {
    $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
   
<div id="databox">
<div class="heading">New account creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
     
<tbody><tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>

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
<tr><td>Contact No.</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Add</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Payment Mode</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Demo Period</td><td><?echo $row[0]["demo_time"];?></td></tr>
<tr><td>Device Price </td><td><?echo $row[0]["device_price"];?></td></tr>   
<tr><td>Tax(18%) </td><td><?echo $row[0]["device_price_vat"];?></td></tr>   
<tr><td>Total </td><td><?echo $row[0]["device_price_total"];?></td></tr>   
<tr><td>Rent </td><td><?echo $row[0]["device_rent_Price"];?></td></tr>   
<tr><td>Service Tex(18%) </td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>   
<tr><td>Total Rent</td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<tr><td>Dimts Fee status </td><td><?echo $row[0]["dimts_fee"];?></td></tr>
<tr><td>Rent Status</td><td><?echo $row[0]["rent_status"];?></td></tr>
<tr><td>Rent Month</td><td><?echo $row[0]["rent_month"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Account Type</td><td><?echo $row[0]["account_type"];?></td></tr>
</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Type of Organisation</td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td>PAN No.</td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td> Copy of Pan Card</td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td>Copy of Address Proof</td><td><?echo $row[0]["address_proof"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>

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

<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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


    else If($tablename=="imei_change")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
<div class="heading">IMEI Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
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
<tr><td>Replaced IMEI Details</td><td>---------------------------</td></tr>
 
<tr><td>Device Model</td><td><?echo $row[0]["new_devicetype"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["new_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["new_deviceid"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["new_sim"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
</table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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


    else If($tablename=="deactivate_sim")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?><div id="databox">
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

<tr><td>Veh No.</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["device_sim"];?></td></tr>
<tr><td>Present Status of Device</td><td>---------------------------</td></tr>
<tr><td>Location</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Ownership</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>SIM Status</td><td><?echo $row[0]["sim_status"];?></td></tr>
<tr><td>Change Date</td><td><?echo $row[0]["change_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["replace_date"];?></td></tr>
</table></div>
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
   
   
    else If($tablename=="comment")
        {
        //"select * from comment where service_id='".$service_id."' order by date desc"
         
    ?><div > <div style=" padding-left: 50px;">
    <h1>Comment</h1> </div>
    <div class="table">
     <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
       <tr><td>  
 <?

$data=select_query_live_con("select * from matrix.comment where service_id='".$RowId."' order by date desc");
 
if(count($data)>0)
{
echo '<table cellspacing="0" cellpadding="0" border="1" width="100%" >
     
        <tr  ><th>Date</th><th>Comment By</th><th>Comment</th></tr>';
for($c=0;$c<count($data);$c++)
    {

 echo '<tr ><td>'. $data[$c]["date"]. '</td><td>'. $data[$c]["comment_by"]. '</td><td>'. $data[$c]["comment"]. '</td></tr>';
    /*echo '<div>'. $data[$c]["date"]. '<div>';
    echo '<br/>';
    echo '<div>Comment By--'. $data[$c]["comment_by"]. '<div>';
    echo '<br/>';
    echo '<div>'. $data[$c]["comment"]. '<div>';
    //echo '<div align="right"><a href="?d=true&id='.$data[$c]["id"].'" >Remove </a></div>';

    echo '<hr>&nbsp;</hr>';*/
    }
    echo '</table>';

 }
 else
    {
     echo '<div> No Comments<div>';

    echo '<hr>&nbsp;</hr>';
    }
 ?>
 </td></tr>
 </table>
    </div>
    </div>
 
    <? }

    elseIf($tablename=="new_device_addition")
        {

            $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?>
   
    <div id="databox">
<div class="heading">View New device Addition</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">

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
 <tr><td>OLD Company Name </td><td><?echo $row[0]["old_device_client"];?></td></tr>   
<tr><td>OLD Registration No </td><td><?echo $row[0]["old_vehicle_name"];?></td></tr>   
<tr><td>Device Model     </td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI </td><td><?echo $row[0]["device_imei"];?></td></tr>   

<?
if($row[0]["device_type"]=='Old' || $row[0]["device_type"]=='old')
{
    $Deviceid=$row[0]["old_device_id"];
}
else {
    $Deviceid=$row[0]["device_id"];
}

?>
<tr><td>Device ID </td><td><?echo $Deviceid;?></td></tr>   
<tr><td>Device Mobile Number     </td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>OLD Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>   
<? /*if($row[0]["device_type"]=='New'){
$biliing_status=$row[0]["billing"];
}
else{
$biliing_status=$row[0]["billing_if_old_device"];
}*/
    ?>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_if_no_reason"];?></td></tr>
</table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td>Installer</td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC      </td><td><?echo $row[0]["ac"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td><strong>Process Pending</strong> </td>  <td><strong>
<?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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

    </table>
    </div>
    </div>



    <? }
    elseIf($tablename=="installer")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div > <div style=" padding-left: 50px;">
    <h1>View Installer Contact Info</h1> </div>
    <div class="table">
    <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
    

<tr><td>Installer Name</td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Address</td><td><?echo $row[0]["address"];?></td></tr>
<tr><td>E-mail</td><td><?echo $row[0]["email"];?></td></tr>
<tr><td>Mobile No.     </td><td><?echo $row[0]["installer_mobile"];?></td></tr>
<? $sql="select * from gtrac_branch where id=".$row[0]["branch_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Branch Name</td><td><?echo $rowuser[0]["branch_name"];?></td></tr>    
<tr><td>Status</td><td><?echo $row[0]["status"];?></td></tr>   
    </table>
    </div>
    </div>



    <? }
    else If($tablename=="vehicle_no_change")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
    <div id="databox">
<div class="heading">View Vehicle Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Registration No</td><td><?echo $row[0]["old_reg_no"];?></td></tr>        
<tr><td>New Registration No </td><td><?echo $row[0]["new_reg_no"];?></td></tr>   
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_reason"];?></td></tr>
<tr><td>Date     </td><td><?echo $row[0]["numberchange_date"];?></td></tr>
<tr><td>Vehicle No Change Reason </td><td><?echo $row[0]["reason"];?></td></tr>   
<tr><td>Client Request Reason </td><td><?echo $row[0]["vehicle_reason"];?></td></tr>
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
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
<tr><td>Payment status</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
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
 
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
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
    else If($tablename=="renew_dimts_imei")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

 
 
    ?>
    <div id="databox">
<div class="heading">View Renew Dimts IMEI Details</div>
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
<tr><td>Port Change Status</td><td><?echo $row[0]["port_change_status"];?></td></tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["renew_dimts_status"]==2 || ( $row[0]["admin_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["renew_dimts_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["renew_dimts_status"]==1)
    {echo "Pending Admin Approval";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["renew_dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["port_change_status"]=="Yes" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
    elseif(($row[0]["repair_comment"]!="" || ($row[0]["port_change_status"]!="Yes" && ($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="")))&& $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<!--<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>-->
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
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
    else If($tablename=="sim_change")
        {
            $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?>
    <div id="databox">
<div class="heading">View Mobile Number Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
   
   
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
 <tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Registration No</td><td><?echo $row[0]["reg_no"];?></td></tr>        
<tr><td>Old Mobile Number </td><td><?echo $row[0]["old_sim"];?></td></tr>
<tr><td>New Mobile Number </td><td><?echo $row[0]["new_sim"];?></td></tr>   
 <tr><td>Sim Change Date     </td><td><?echo $row[0]["sim_change_date"];?></td></tr>   
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>   
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
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
  </tbody>
    </table>
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
<tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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
<tr><td>Device Location     </td><td><?echo $row[0]["vehicle_location"];?></td></tr>
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


    else If($tablename=="stop_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
    <div id="databox">
<div class="heading">Stop Gps</div>
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
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location     </td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Data to Display     </td><td><?echo $row[0]["data_display"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
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
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
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


elseif($tablename=="installation")
        {
   
    
    $query = "select * FROM $internalsoftware.installation left join $internalsoftware.re_city_spr_1 on installation.Zone_area=re_city_spr_1.id 
  where installation.id=".$RowId;
    $row=select_query($query);

     $toolk=explode('#',$row[0]['accessories_tollkit']);
     $tools=array();
     $accessory_data=array();
    // echo '<pre>'; print_r($toolk);die;

    ?>
<div id="databox">
  <div class="heading">Installation</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td> Date: </td>
          <td><?echo $row[0]["req_date"];?></td>
        </tr>
        <tr>
          <td>Request By: </td>
          <td><?echo $row[0]["request_by"];?></td>
        </tr>
        <? 
    $sales=select_query("select name FROM $internalsoftware.sales_person where id='".$row[0]['sales_person']."' ");
    ?>
        <tr>
          <td>Sales Person </td>
          <td><?echo $sales[0]['name'];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM $internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>No. Of Vehicales: </td>
          <td><?echo $row[0]["no_of_vehicals"];?></td>
        </tr>
        <tr>
          <td>Approve Installation: </td>
          <td><?echo $row[0]["installation_approve"];?></td>
        </tr>
        <tr>
          <td>Area: </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        <?php if($row[0]['location']!=""){?>
        <tr>
          <td>Location: </td>
          <td><?echo $row[0]["location"];?></td>
        </tr>
        <?php }else{ $city= select_query("select * FROM $internalsoftware.tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
        <tr>
          <td>Location: </td>
          <td><?echo $city[0]["city"];?></td>
        </tr>
         <?php
          //echo "select * FROM internalsoftware.admin_stock_approved_history where internalsoftware.installation_req_id=".$RowId;die;
          $adminApproved = select_query("select * FROM $internalsoftware.admin_stock_approved_history where installation_req_id=".$RowId);
          if($adminApproved[0]['device_type_id'] != $adminApproved[0]['previousModel']){
        ?>
        <tr>
          <td>Installation Req Model:</td>
          <td>
            <?php
              $sqlModel=select_query("SELECT item_name FROM item_master where item_id='".$adminApproved[0]['previousModel']."'");

              echo $sqlModel[0]['item_name']."</br>";
            ?>
          </td>
        </tr>
        <?php } ?>
        <?php }?>
             <tr>
        <?php $sqlDevice=select_query("SELECT device_type FROM device_type where id='".$row[0]["device_type"]."' ");   ?>
          <td>Device Type:</td>
          <td><?echo $sqlDevice[0]["device_type"];?></td>
        </tr>
        <tr>
        <?php $sqlModel=select_query("SELECT device_model FROM device_model where id='".$row[0]["model"]."' ");   ?>
          <td>Model:</td>
          <td><?echo $sqlModel[0]["device_model"];?></td>
        </tr>

        <tr>
          <td>Available Time Status: </td>
          <td><?echo $row[0]["atime_status"];?></td>
        </tr>
        <tr>
          <td>Time: </td>
          <td><?echo $row[0]["time"];?></td>
        </tr>
               <tr>
          <td>Vehicle Type: </td>
          <td><?echo $row[0]["veh_type"];?></td>
        </tr>
        <tr>
          <td>Trailer Type </td>
          <td><?echo $row[0]["TrailerType"];?></td>
        </tr>
        <tr>
          <td>Machine Type</td>
          <td><?echo $row[0]["MachineType"];?></td>
        </tr>
        <tr>
          <td>AC/Non AC </td>
          <td><?echo $row[0]["actype"];?></td>
        </tr>
        <tr>
          <td>Delux/Non Delux</td>
          <td><?echo $row[0]["standard"];?></td>
        </tr>
        <tr>
          <td>Truck Type</td>
          <td><?echo $row[0]["TruckType"];?></td>
        </tr>
         <tr>
          <td>Billing</td>
          <td><?echo $row[0]["billing"];?></td>
        </tr>
      
        
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Job: </td>
          <td><?echo $row[0]["instal_reinstall"];?></td>
        </tr>
       <!--  <tr>
          <td>Vehicle Type: </td>
          <td><?echo $row[0]["veh_type"];?></td>
        </tr> -->
        <?php  for($v=0;$v<count($toolk);$v++)
        {
        //$tools[]=$toolk[$v]; 
         // echo "SELECT items AS `access_name` FROM toolkit_access where id='".$toolk[$v]."' ORDER BY `access_name` asc"; die;
         $accessory_data=select_query("SELECT items AS `access_name` FROM toolkit_access where id='".$toolk[$v]."' ORDER BY `access_name` asc");
         if($accessory_data!="")
         {?>
          <tr>
            <td><?php echo $accessory_data[0]['access_name'];?> </td>
           <td>Yes</td>
          <tr>
         <?php }
         
       }
    // echo $accessories_tollkits; die;
     ?>
        <tr>
          <td>Contact Person No.: </td>
          <td><?echo $row[0]["contact_person_no"];?></td>
        </tr>
        <tr>
          <td>Installation Made: </td>
          <td><?echo $row[0]["installation_made"];?></td>
        </tr>
        <tr>
          <td>Installer Name: </td>
          <td><?echo $row[0]["inst_name"];?></td>
        </tr>
        <tr>
          <td>Installer Current Location: </td>
          <td><?echo $row[0]["inst_cur_location"];?></td>
        </tr>
        <!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>  
-->
        <tr>
          <td>Installation Done At: </td>
          <td><?echo $row[0]["rtime"];?></td>
        </tr>
        <tr>
          <td>Reason To Back Services:</td>
          <td><?echo $row[0]["back_reason"];?></td>
        </tr>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
        elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
        elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
        elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
        elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
        elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
        elseif($row[0]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
        elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
        elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
        elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?>
            </strong></td>
        </tr>
        <?php if($_SESSION['BranchId']==1){?>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td>Approval Date</td>
          <td><?
      if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
      {
      echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
      }
      else
      {
        echo "";
      }
       
      ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }



elseif($tablename=="installation_request")
        {
   $query = "select * FROM $internalsoftware.installation_request left join $internalsoftware.re_city_spr_1 on installation_request.Zone_area =re_city_spr_1.id where installation_request.id=".$RowId;
    $row=select_query($query);
 // echo '<pre>'; print_r($row);die;
    //echo $row[0]['accessories_tollkit']; die;
   $toolk=explode('#',$row[0]['accessories_tollkit']);
   $tools=array();
   $accessory_data=array();

    ?>
<div id="databox">
  <div class="heading">Installation Request</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td> Date: </td>
          <td><?echo $row[0]["req_date"];?></td>
        </tr>
        <tr>
          <td>Request By: </td>
          <td><?echo $row[0]["request_by"];?></td>
        </tr>
        <? 
    $sales=select_query("select name FROM $internalsoftware.sales_person where id='".$row[0]['sales_person']."' ");
    ?>
        <tr>
          <td>Sales Person </td>
          <td><?echo $sales[0]['name'];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM $internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>No. Of Vehicles: </td>
          <td><?echo $row[0]["no_of_vehicals"];?></td>
        </tr>
        <tr>
          <td>Approve Installation: </td>
          <td><?echo $row[0]["installation_approve"];?></td>
        </tr>
        <tr>
          <td>Area: </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        <?php if($row[0]['location']!=""){?>
        <tr>
          <td>Location: </td>
          <td><?echo $row[0]["location"];?></td>
        </tr>
        <?php }else{ $city= select_query("select * FROM $internalsoftware.tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
        <tr>
          <td>Location: </td>
          <td><?echo $city[0]["city"];?></td>
        </tr>
        <?php }?>

         <?php
          //echo "select * FROM internalsoftware.admin_stock_approved_history where internalsoftware.installation_req_id=".$RowId;die;
          $adminApproved = select_query("select * FROM $internalsoftware.admin_stock_approved_history where installation_req_id=".$RowId);
          if($adminApproved[0]['device_type_id'] != $adminApproved[0]['previousModel']){
        ?>
        <tr>
          <td>Installation Req Model:</td>
          <td>
            <?php
              $sqlModel=select_query("SELECT item_name FROM $internalsoftware.item_master where item_id='".$adminApproved[0]['previousModel']."'");

              echo $sqlModel[0]['item_name']."</br>";
            ?>
          </td>
        </tr>
        <?php } 


        ?>


        <tr>
        <?php
        //$sqlDevice=select_query("SELECT device_type FROM device_type where id='".$row[0]["device_type"]."' ");
         $sqlDevice=select_query("SELECT item_name FROM item_master where item_id='".$row[0]["model_parent"]."'");
         $sqlModel=select_query("SELECT item_name FROM item_master where item_id='".$row[0]["model"]."'"); 
          ?>
          <td>Device Type:</td>
          <td><?echo $sqlDevice[0]["item_name"]?></td>
        </tr>
        <tr>
           <td>Device Model:</td>
           <td><?echo $sqlModel[0]["item_name"]?></td>
        </tr>
        <tr>


       
        <tr>
          <td>Available Time Status: </td>
          <td><?echo $row[0]["atime_status"];?></td>
        </tr>
        <tr>
          <td>Time: </td>
          <td><?echo $row[0]["time"];?></td>
        </tr>
        <tr>
          <td>To Time: </td>
          <td><?echo $row[0]["totime"];?></td>
        </tr>
       <!--  <tr>
          <td>Contact No.:</td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr> -->
        <!-- <tr>
          <td>Contact Person: </td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>Alternative Contact No.</td>
          <td><?echo $row[0]["alter_contact_no"];?></td>
        </tr>
        <tr>
          <td>Designation</td>
          <td><?echo $row[0]["designation"];?></td>
        </tr> -->
         <tr>
         <td><?php if($row[0]["veh_type"]) {?> Vehicle Type: <?php } ?></td>
         <td><?echo $row[0]["veh_type"];?></td>
       </tr>
       <tr>
         <td><?php if($row[0]["TrailerType"]) {?> Trailer Type <?php } ?></td>
         <td><?echo $row[0]["TrailerType"];?></td>
       </tr>
       <tr>
         <td><?php if($row[0]["MachineType"]) {?> Machine Type <?php } ?></td>
         <td><?echo $row[0]["MachineType"];?></td>
       </tr>
       <tr>
         <td><?php if($row[0]["actype"]) {?>AC/Non AC <?php } ?></td>
         <td><?echo $row[0]["actype"];?></td>
       </tr>
       <tr>
         <td><?php if($row[0]["standard"]) {?>Delux/Non Delux <?php } ?></td>
         <td><?php echo $row[0]["standard"];?></td>
       </tr>
       <tr>
         <td><?php if($row[0]["TruckType"]) {?>Truck Type<?php } ?></td>
         <td><?echo $row[0]["TruckType"];?></td>
       </tr>

         <tr>
          <td>Billing</td>
          <td><?echo $row[0]["billing"];?></td>
        </tr></tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
      <tr>
          <td>Required</td>
          <td><?echo $row[0]["required"];?></td>
        </tr>
        <tr>
          <td>Job: </td>
          <td>
          <? 
          if($row[0]["instal_reinstall"] == 're_install'){ echo "Re-Addition";}
          else { echo $row[0]["instal_reinstall"]; }
          ?></td>
        </tr>
     <?php  for($v=0;$v<count($toolk);$v++)
      {
        //$tools[]=$toolk[$v]; 
         $accessory_data=select_query("SELECT items AS `access_name` FROM $internalsoftware.toolkit_access where id='".$toolk[$v]."' ORDER BY `access_name` asc");
         if($accessory_data!="")
         {?>
          <tr>
            <td><?php echo $accessory_data[0]['access_name'];?> </td>
           <td>Yes</td>
          <tr>
         <?php }
         
      }
    // echo $accessories_tollkits; die;
     ?>

       
        <tr>
          <td>Contact Person: </td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>Contact No.: </td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>



        <tr>
          <td>Designation.: </td>
          <td><?echo $row[0]["designation"];?></td>
        </tr>

         <tr>
          <td>Alternative Contact Person.: </td>
          <td><?echo $row[0]["alt_cont_person"];?></td>
        </tr>
        <tr>
          <td>Alternative Contact No.: </td>
          <td><?echo $row[0]["alter_contact_no"];?></td>
        </tr>
          <tr>
          <td>Designation.: </td>
          <td><?echo $row[0]["alt_designation"];?></td>
        </tr>
        <tr>
          <td>Installation Made: </td>
          <td><?echo $row[0]["installation_made"];?></td>
        </tr>
        <tr>
          <td>Installer Name: </td>
          <td><?echo $row[0]["inst_name"];?></td>
        </tr>
        <tr>
          <td>Installer Current Location: </td>
          <td><?echo $row[0]["inst_cur_location"];?></td>
        </tr>
        <!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>  
-->
        <tr>
          <td>Installation Done At: </td>
          <td><?echo $row[0]["rtime"];?></td>
        </tr>
        <tr>
          <td>Reason To Back Services:</td>
          <td><?echo $row[0]["back_reason"];?></td>
        </tr>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
        elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
        elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
        elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
        elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
        elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
        elseif($row[0]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
        elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
        elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
        elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?>
            </strong></td>
        </tr>
        <?php if($_SESSION['BranchId']==1 || $row[0]["inter_branch"]==1){?>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td>Approval Date</td>
          <td><?
    if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
    {
    echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
    }
    else
    {
        echo "";
    }
   
    ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
 <div>&#160;</div>
 <div>&#160;</div>
  <?php 
  if($row[0]["instal_reinstall"] == 'online_crack'){
 ?>   
 <div>
   <table border="2" width="100%" cellspacing="2" cellpadding="2">
     
      <thead>
        <tr>
          <td width="20%"><b>Veh Reg No.:</b></td>
           <td width="80%">
            <?php

              $veh_reg = $row[0]["veh_reg"];
              //$newveh_reg = wordwrap($veh_reg, 21, "\n", true);

              echo "$veh_reg\n";

            ?>
          </td>
        </tr>
        <tr>
          <td width="20%"><b>Veh Device IMEI:</b></td>
           <td width="80%">
            <?php

              $deviceIMEI = $row[0]["device_imei"];
              //$newdeviceIMEI = wordwrap($deviceIMEI, 21, "\n", true);

              echo "$deviceIMEI\n";

            ?>
          </td>
        </tr>
      </thead>
   </table>
 </div>
 <?php } ?>
 <?php 
  if($row[0]["instal_reinstall"] == 're_install'){
 ?>   
 <div>
   <table border="2" width="100%">
     
      <thead>
        
         <tr>
          <td>Device IMEI:</td>
           <td>
            <?php

              $deviceIMEI = $row[0]["device_imei"];
              $newdeviceIMEI = wordwrap($deviceIMEI, 21, "\n", true);

              echo "$newdeviceIMEI\n";

            ?>
          </td>
        </tr>
      </thead>
   </table>
 </div>
 <?php } ?>
</div>
<? }
elseif($tablename=="no_bills")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
           
    ?><div id="databox">
<div class="heading">No Bills</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
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

<tr><td>Total no of Vehicles </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicles for no bill</td><td><?echo $row[0]["veh_no_bill"];?></td></tr>
<tr><td>No Bill For    </td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Provision Bill    </td><td><?echo $row[0]["provision_bill"];?></td></tr>
<tr><td>Duration for Provision Bill    </td><td><?echo $row[0]["duration"];?></td></tr>
</tbody></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["no_bill_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif(($row[0]["no_bill_issue"]=="Software Issue" && $row[0]["support_comment"]=="") || $row[0]["approve_status"]==1 && $row[0]["no_bill_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["no_bill_issue"]=="Service Issue" && $row[0]["no_bill_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
    {echo "Pending at Service Team";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["no_bill_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["no_bill_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
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
     
 
    else If($tablename=="discount_details")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
           
    ?><div id="databox">
<div class="heading">Discount</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>


<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
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
<tr><td>Service Action</td><td><?echo $row[0]["service_action"];?></td></tr> 

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

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

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
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
   
   
<? /*}
    else If($tablename=="dimts_imei")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);*/

 
 
    ?>
    <!--<div id="databox">
<div class="heading">View Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Sales Manager </td><td><?echo $row[0]["sales_manager"];?></td></tr>    
<? /*$sql="select * from matrix.users  where id=".$row[0]["user_id"];
    $rowuser=select_query($sql);*/
    ?>
<tr><td>User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>       
<tr><td>Vehicle No</td><td><?echo $row[0]["veh_reg"];?></td></tr>        
<tr><td>7 digit IMEI </td><td><?echo $row[0]["device_imei_7"];?></td></tr>   
<tr><td>15 digit IMEI</td><td><?echo $row[0]["device_imei_15"];?></td></tr>
<tr><td>Changed to Port</td><td><?echo $row[0]["port_change"];?></td></tr>


</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
 <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr><tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
<tr><td>Approval Date</td><td><?
/*if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
    echo "";
}*/

?></td></tr>
<tr><td>Closed Date</td><td><?
/*if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}*/

?></td>
    </tr></tbody>

    </table>
    </div>
    </div>     -->
   
   
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
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

 <tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicle to move     </td><td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td></tr>
<tr><td>Contact Person     </td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number     </td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Sub-User Name     </td><td><?echo $row[0]["name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["req_sub_user_pass"];?></td></tr>
<tr><td>Main User Separate</td><td><?echo $row[0]["billing_separate"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

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
    else If($tablename=="deactivation_of_account")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">Deactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>    
<tr><td>Deactivate </td><td><?echo $row[0]["deactivate_temp"];?></td></tr>
 <tr><td>Alert Date </td><td><?echo $row[0]["alert_date"];?></td></tr>
<tr><td>Delete From Debtors </td><td><?echo $row[0]["delete_form_debtors"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>

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
    else If($tablename=="del_form_debtors")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">Delete From Debtors</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>    
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr>    
<tr><td>Date Of Creation  </td><td><?echo $row[0]["date_of_creation"];?></td></tr>    
 
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

<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
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
    else If($tablename=="software_request")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">Software Request</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
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

<tr><td>Requested Reports:---</td><td></td></tr> 
    <tr><td><tr><td>Reports</td><td><?echo $row[0]["reports"];?></td></tr> 

    </tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>     
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr>    
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact"];?></td></tr>     
<tr><td>Client Contact Number </td><td><?echo $row[0]["client_contact_num"];?></td></tr>
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
    <?
    }

    else If($tablename=="transfer_the_vehicle")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);



    ?><div id="databox">
<div class="heading">Transfer Vehicle</div>
<div class="dataleft"><table cellspacing="0" cellpadding="0">
    <tbody>
 

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_veh"];?></td></tr>    
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
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

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
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
    echo "";
}

?></td></tr>
</tbody>
 

    </table>
    </div>
    </div>
    <?
    }
    }
?> 