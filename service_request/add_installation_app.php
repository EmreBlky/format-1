<?php
include("../connection.php");

$headers = apache_request_headers();

foreach ($headers as $header => $value) {
        if($header=="INTERNALGTRAC")
        {
                $httpHeader=$value;
        }
 }
if($httpHeader!="APIapiGTRACgtrac")
{
        die();
}


$device_price = 0;
$device_price_vat = 0;
$device_price_total = 0;
$device_rent_Price = 0;
$device_rent_service_tax = 0;
$TxtDTotalREnt = 0;

if(isset($_POST))
{
   	//echo "<pre>";print_r($_POST);die;
    $date = date("Y-m-d H:i:s");
    $sales_manager = $_POST["account_manager"];;
    $sales_person = $_POST['sales_person'];
    $main_user_id = $_POST['main_user_id'];
	
	$get_company_name = select_query_live_con("select `group`.name as company from matrix.group_users left join matrix.`group` on group_users.sys_group_id=`group`.id where group_users.sys_user_id=".$main_user_id);	
    $company = $get_company_name[0]["company"];
	
    $no_of_vehicals = $_POST['no_of_vehicals'];
	$Area = $_POST['Zone_area'];
	$branch_type = $_POST['branch_type'];
	
	if($branch_type == "Interbranch"){
		
	$city = $_POST['inter_branch'];
	$location = "";
    
	}else{
        $city=0;
        $location=$_POST['location'];
    }
	
    $atime_status = $_POST['atime_status'];
    $cnumber = $_POST['cnumber'];
    $contact_person = $_POST['contact_person'];
	
	//$model = $_POST['model'];
    /*$veh_type = $_POST['veh_type'];	
    $comment = $_POST['comment'];
    $payment_req = $_POST['payment_req'];*/
	
	/*$required = $_POST['required'];
    if($required == "") { $required = "normal"; }
       
	$IP_Box = $_POST['IP_Box'];
	
	$fuel_sensor = $_POST['fuel_sensor'];
    $bonnet_sensor = $_POST['bonnet_sensor'];
    $rfid_reader = $_POST['rfid_reader'];
    $speed_alarm = $_POST['speed_alarm'];
    $door = $_POST['door'];
    $temperature = $_POST['temperature'];
    $duty_box = $_POST['duty_box'];
    $panic_button = $_POST['panic_button'];*/
	
    $instal_reinstall = $_POST['instal_reinstall'];
	$branch_id = $_POST["branch_id"];
	
	$rent_payment = $_POST["rent_payment"];
	
	$device_price = $_POST["device_price"];
	$device_price_vat = $_POST["device_price_vat"];
	$device_price_total = $_POST["device_price_total"];
	$device_rent_Price = $_POST["device_rent_Price"];
	$device_rent_service_tax = $_POST["device_rent_service_tax"];
	$TxtDTotalREnt = $_POST["TxtDTotalREnt"];

	if($branch_id == 1){
        $account_manager= "saleslogin";
    }
    elseif($branch_id == 2){
        $account_manager= "msaleslogin";
    }
    elseif($branch_id == 3){
        $account_manager= "jsaleslogin";
    }
    elseif($branch_id == 6){
        $account_manager= "asaleslogin";
    }
    elseif($branch_id == 7){
        $account_manager= "ksaleslogin";
    }
	
	$installation_status = 7;
       
    /*if($branch_id==1 && $branch_type == "Samebranch" && $instal_reinstall == "installation")
    {
        $installation_status = 8;
    }
    elseif($branch_type == "Interbranch" && $_POST['inter_branch'] == 1 && $instal_reinstall == "installation")
    {
        $installation_status = 8;
    }
    else{
        $installation_status = 1;
    }*/
	
	
    /*$dimts = $_POST['dimts'];    
	if($dimts == "") { $dimts="no"; }
	
    $demo = $_POST['demo'];
    if($demo == "") { $demo="no"; }

    $immobilizer_type = '';*/
	$result = array();
	
	if($sales_person != '')
	{
		
        if($atime_status=="Till")
        {
              $time = date('Y-m-d H:i:s',strtotime($_POST['time']));
                    
              /*$sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location, time, contact_number,installed_date, status, contact_person, branch_id, installation_status, Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall, device_price, device_price_vat, device_price_total, device_rent_Price, device_rent_service_tax, DTotalREnt,  rent_payment) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','".$no_of_vehicals."',".$location."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$branch_id."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$device_price."','".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."','".$TxtDTotalREnt."','".$rent_payment."')";
           	
            $execute = mysql_query($sql);
			$insert_id = mysql_insert_id();*/
			
			$installation_request = array('req_date' => $date, 'request_by' => $account_manager, 'sales_person' => $sales_person, 'user_id' =>  $main_user_id, 'company_name' =>  $company, 'no_of_vehicals' =>  $no_of_vehicals, 'location' =>  $location, 'time' =>  $time,  'contact_number' =>  $cnumber, 'installed_date' =>  date("Y-m-d H:i:s"), 'status' =>  1, 'contact_person' =>  $contact_person, 'branch_id' =>  $branch_id, 'installation_status' =>  $installation_status, 'Zone_area' =>  $Area, 'atime_status' =>  $atime_status, 'inter_branch' =>  $city,'branch_type' =>  $branch_type,'instal_reinstall' =>  $instal_reinstall,'device_price' =>  $device_price,'device_price_vat' =>  $device_price_vat,'device_price_total' =>  $device_price_total,'device_rent_Price' =>  $device_rent_Price,'device_rent_service_tax' =>  $device_rent_service_tax,'DTotalREnt' =>  $TxtDTotalREnt,'rent_payment' =>  $rent_payment);
		
			$execute = insert_query('internalsoftware.installation_request', $installation_request);
			$insert_id = mysql_insert_id();
			
			if($execute)
			{
				$result["status"] = true;
				$result["User"] = $main_user_id;
				$result["insertId"] = $insert_id;
				$result["message"] = "Data successfully Insert.";	
				
			}
			else
			{
				$result["status"] = false;	
				$result["User"] = $main_user_id;
				$result["message"] = "Data Not Insert.";	
			}
            
			  
			  
            /*if($installation_status == 1)
            {
                for($N=1;$N<=$no_of_vehicals;$N++)
                {
                   $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location,model,time, contact_number,installed_date, status, contact_person, dimts,demo, veh_type,comment, immobilizer_type, payment_req,required, IP_Box,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, fuel_sensor, bonnet_sensor, rfid_reader, speed_alarm, door_lock_unlock, temperature_sensor, duty_box, panic_button,  device_price, device_price_vat, device_price_total, device_rent_Price, device_rent_service_tax, DTotalREnt,  rent_payment) VALUES('".$insert_id."','".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$dimts."','".$demo."','".$veh_type."','".$comment."','".$immobilizer_type."','".$payment_req."','".$required."','".$IP_Box."','".$branch_id."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$fuel_sensor."','".$bonnet_sensor."','".$rfid_reader."','".$speed_alarm."','".$door."','".$temperature."','".$duty_box."','".$panic_button."','".$device_price."','".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."','".$TxtDTotalREnt."','".$rent_payment."')";
                   
                    $execute_inst = mysql_query($installation);
                }
            }*/
           
            // header("location:installation.php");
        }
           
        if($atime_status=="Between")
        {
			$time = date('Y-m-d H:i:s',strtotime($_POST['time']));
			$totime = date('Y-m-d H:i:s',strtotime($_POST['totime']));
                
            /*echo $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location, time, totime, contact_number, installed_date, status, contact_person, branch_id, installation_status, Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall,   device_price, device_price_vat, device_price_total, device_rent_Price, device_rent_service_tax, DTotalREnt,  rent_payment) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','".$no_of_vehicals."','".$location."','".$time."','".$totime."','".$cnumber."',now(),1,'".$contact_person."','".$branch_id."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$device_price."','".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."','".$TxtDTotalREnt."','".$rent_payment."')";*/          
            
			 //$execute = mysql_query($sql) or die(mysql_error());
			 //$insert_id = mysql_insert_id();
			 
			 $installation_request = array('req_date' => $date, 'request_by' => $account_manager, 'sales_person' => $sales_person, 'user_id' =>  $main_user_id, 'company_name' =>  $company, 'no_of_vehicals' =>  $no_of_vehicals, 'location' =>  $location, 'time' =>  $time, 'totime' =>  $totime, 'contact_number' =>  $cnumber, 'installed_date' =>  date("Y-m-d H:i:s"), 'status' =>  1, 'contact_person' =>  $contact_person, 'branch_id' =>  $branch_id, 'installation_status' =>  $installation_status, 'Zone_area' =>  $Area, 'atime_status' =>  $atime_status, 'inter_branch' =>  $city,'branch_type' =>  $branch_type,'instal_reinstall' =>  $instal_reinstall,'device_price' =>  $device_price,'device_price_vat' =>  $device_price_vat,'device_price_total' =>  $device_price_total,'device_rent_Price' =>  $device_rent_Price,'device_rent_service_tax' =>  $device_rent_service_tax,'DTotalREnt' =>  $TxtDTotalREnt,'rent_payment' =>  $rent_payment);
		
			$execute = insert_query('internalsoftware.installation_request', $installation_request);
			$insert_id = mysql_insert_id();
			
			 if($execute)
			 {
				$result["status"] = true;
				$result["User"] = $main_user_id;
				$result["insertId"] = $insert_id;
				$result["message"] = "Data successfully Insert.";
			 }
			 else
			{
				$result["status"] = false;	
				$result["User"] = $main_user_id;
				$result["message"] = "Data Not Insert.";	
			}
                

            /*if($installation_status == 1)
            {

                for($N=1;$N<=$no_of_vehicals;$N++)
                {
                   $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, location,model,time, totime,contact_number,installed_date, status, contact_person, dimts,demo, veh_type,comment, immobilizer_type, payment_req,required, IP_Box,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, fuel_sensor, bonnet_sensor, rfid_reader, speed_alarm, door_lock_unlock, temperature_sensor, duty_box, panic_button,  device_price, device_price_vat, device_price_total, device_rent_Price, device_rent_service_tax, DTotalREnt, rent_payment) VALUES('".$insert_id."','".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."','".$totime."','".$cnumber."',now(),1,'".$contact_person."','".$dimts."','".$demo."','".$veh_type."','".$comment."','".$immobilizer_type."','".$payment_req."','".$required."','".$IP_Box."','".$branch_id."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$fuel_sensor."','".$bonnet_sensor."','".$rfid_reader."','".$speed_alarm."','".$door."','".$temperature."','".$duty_box."','".$panic_button."','".$device_price."','".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."','".$TxtDTotalREnt."','".$rent_payment."')";
                   
                    $execute_inst = mysql_query($installation);
                }     
            }*/
             //header("location:installation.php");
        }
	}
	else
	{
		$result["status"] = false;	
		$result["User"] = $main_user_id;
		$result["message"] = "Session Expired.";	
	}
	   
    echo json_encode($result);
}
?>
 