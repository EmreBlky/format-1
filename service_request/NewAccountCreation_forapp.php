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

$action = $_GET['action'];
$id = $_GET['id'];
$page = $_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $result = select_query("select * from new_account_creation where id=$id");
    }
$device_price = 0;
$device_price_vat = 0;
$device_price_total = 0;
$device_rent_Price = 0;
$device_rent_service_tax = 0;
$TxtDTotalREnt = 0;


if(isset($_POST))
{
	//print_r($_POST);die;
	
    $action = $_POST['action'];
    //$id = $_POST["id"];
    $date = date("Y-m-d H:i:s");
    $company = $_POST["company"];
    $account_manager = $_POST["account_manager"];
    $potential = $_POST["potential"];
    $contact_person = $_POST["contact_person"];
    $contact_number = $_POST["contact_number"];
    $billing_name = $_POST["billing_name"];
    $billing_address = $_POST["billing_address"];
    $mode_of_payment = $_POST["mode_of_payment"];
    $type_of_org = $_POST["type_of_org"];
    $pan_no = $_POST["pan_no"];
    $dimts = $_POST["dimts"];
    $rent_status = $_POST["rent_status"];
	$rent_payment = $_POST["rent_payment"];
    $dimts_fee = $_POST["dimts_fee"];
	//device_price, device_price_vat,device_price_total,device_rent_Price,device_rent_service_tax,TxtDTotalREnt

    if($mode_of_payment=="Cash")
    {
        $device_price_total = $_POST["device_price_total"];
        $TxtDTotalREnt = $_POST["TxtDTotalREnt"];
        $rent_month = $_POST["rent_month"];

    }
    else if($mode_of_payment=="Cheque")
    {
        $device_price = $_POST["device_price"];
        $device_price_vat = $_POST["device_price_vat"];
        $device_price_total = $_POST["device_price_total"];
        $device_rent_Price = $_POST["device_rent_Price"];
        $device_rent_service_tax = $_POST["device_rent_service_tax"];
        $TxtDTotalREnt = $_POST["TxtDTotalREnt"];
        $rent_month = $_POST["rent_month"];

    }
    else if($mode_of_payment=="Demo")
    {
        $demo = $_POST["Demo"];
    }
    else if($mode_of_payment=="Lease")
    {
        $device_price_total = $_POST["device_price_total"];
    }

    $vehicle_type = $_POST["vehicle_type"];
    $account_type = $_POST["account_type"];
    $immobilizer = $_POST["immobilizer"];
    $ac_on_off = $_POST["ac_on_off"];
    $email_id = $_POST["email_id"];
    $user_name = $_POST["user_name"];
    $user_password = $_POST["user_password"];
    //$service_comment = $_POST["service_comment"])) ? trim($_POST["service_comment"]): "";
    $new_acc_salescomment = $_POST["new_acc_salescomment"];
    $sales_manager = $_POST["sales_manager"];
	
	$panic_button = $_POST["panic_button"];
	$advance_inst = $_POST["advance_inst"];
	$ignition = $_POST["ignition"];
	$temperature = $_POST["temperature"];






if($action=='edit')
    {

     $query="update new_account_creation set company='".$company."',potential='".$potential."',contact_person='".$contact_person."',contact_number='".$contact_number."',billing_name='".$billing_name."' ,billing_address='".$billing_address."',type_of_org='".$type_of_org."',pan_no='".$pan_no."',demo_time='".$demo."',device_price='".$device_price."',device_price_vat='".$device_price_vat."',device_price_total='".$device_price_total."',device_rent_Price='".$device_rent_Price."',device_rent_service_tax='".$device_rent_service_tax."',DTotalREnt='".$TxtDTotalREnt."',mode_of_payment='".$mode_of_payment."',rent_payment='".$rent_payment."',vehicle_type='".$vehicle_type."',immobilizer='".$immobilizer."',ac_on_off='".$ac_on_off."',account_type='".$account_type."',email_id='".$email_id."',user_name='".$user_name."',user_password='".$user_password."',dimts='".$dimts."',new_acc_salescomment='".$new_acc_salescomment."',sales_manager='".$sales_manager_edit."',rent_status='".$rent_status."',dimts_fee='".$dimts_fee."',rent_month='".$rent_month."',panic_button='".$panic_button."',advance_inst='".$advance_inst."',ignition='".$ignition."',temperature='".$temperature."' where id=$id";


    mysql_query($query);
    /*echo "<script>document.location.href ='accountcreation.php?for=formatrequest'</script>";*/
    }
  else
  {
      $query = "insert into new_account_creation(date, account_manager, company,potential, contact_person, contact_number, billing_name, billing_address, type_of_org, pan_no, demo_time, device_price, device_price_vat, device_price_total, device_rent_Price, device_rent_service_tax, DTotalREnt, mode_of_payment, rent_payment, vehicle_type, immobilizer, ac_on_off, account_type, email_id, user_name, user_password, sales_manager, dimts,rent_status, dimts_fee, rent_month, new_acc_salescomment, branch_id, panic_button, advance_inst, ignition, temperature)
      values('".$date."','".$account_manager."','".$company."','".$potential."','".$contact_person."','".$contact_number."','".$billing_name."','".$billing_address."','".$type_of_org."','".$pan_no."','".$demo."','".$device_price."','".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."','".$TxtDTotalREnt."','".$mode_of_payment."','".$rent_payment."','".$vehicle_type."','".$immobilizer."','".$ac_on_off."','".$account_type."','".$email_id."','".$user_name."','".$user_password."','".$sales_manager."','".$dimts."','".$rent_status."','".$dimts_fee."','".$rent_month."','".$new_acc_salescomment."','".$_POST["branch_id"]."','".$panic_button."','".$advance_inst."','".$ignition."','".$temperature."')";
		
		
		if(mysql_query($query))
		{
			$result["message"] = "Data successfully Insert.";
		}
     }
	 
	 echo json_encode($result);

}

?>