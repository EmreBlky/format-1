<?php
include('lock.php');
//session_start();
include("connection.php");
//print_r($_POST);
$date=(isset($_POST["date"])) ? trim($_POST["date"])  : "";
$company=(isset($_POST["company"])) ? trim($_POST["company"]): "";
$account_manager=(isset($_POST["account_manager"])) ? trim($_POST["account_manager"]): "";
$potential=(isset($_POST["potential"])) ? trim($_POST["potential"]): "";
$contact_person=(isset($_POST["contact_person"])) ? trim($_POST["contact_person"]): "";
$contact_number=(isset($_POST["contact_number"])) ? trim($_POST["contact_number"]): "";
$billing_name=(isset($_POST["billing_name"])) ? trim($_POST["billing_name"]): "";
$billing_address=(isset($_POST["billing_address"])) ? trim($_POST["billing_address"]): "";
$device_rent_price=(isset($_POST["device_rent_price"])) ? trim($_POST["device_rent_price"]): "";
$device_rent_vat=(isset($_POST["device_rent_vat"])) ? trim($_POST["device_rent_vat"]): "";
$device_rent_total=(isset($_POST["device_rent_total"])) ? trim($_POST["device_rent_total"]): "";
$device_rent_rent=(isset($_POST["device_rent_rent"])) ? trim($_POST["device_rent_rent"]): "";
$device_rent_service_tax=(isset($_POST["device_rent_service_tax"])) ? trim($_POST["device_rent_service_tax"]): "";
$mode_of_payment=(isset($_POST["mode_of_payment"])) ? trim($_POST["mode_of_payment"]): "";
$vehicle_type=(isset($_POST["vehicle_type"])) ? trim($_POST["vehicle_type"]): "";
$immobilizer=(isset($_POST["immobilizer"])) ? trim($_POST["immobilizer"]): "";
$ac_on_off=(isset($_POST["ac_on_off"])) ? trim($_POST["ac_on_off"]): "";
$email_id=(isset($_POST["email_id"])) ? trim($_POST["email_id"]): "";
$user_name=(isset($_POST["user_name"])) ? trim($_POST["user_name"]): "";
$user_password=(isset($_POST["user_password"])) ? trim($_POST["user_password"]): "";
if(isset($_POST["submit"]) && $_POST["submit"]=="submit")
{

  $query="insert into new_account_creation(date,company,account_manager,potential,contact_person,contact_number,billing_name,billing_address,device_rent_price,device_rent_vat,device_rent_total,device_rent_rent,device_rent_service_tax,mode_of_payment,vehicle_type,immobilizer,ac_on_off,email_id,user_name,user_password)values('".$date."','".$account_manager."','".$company."','".$potential."','".$contact_person."',".$contact_number.",'".$billing_name."','".$billing_address."',".$device_rent_price.",".$device_rent_vat.",".$device_rent_total.",".$device_rent_rent.",".$device_rent_service_tax.",'".$mode_of_payment."','".$vehicle_type."','".$immobilizer."','".$ac_on_off."','".$email_id."','".$user_name."','".$user_password."')";

mysql_query($query);
//echo "record saved";
header('location: sales_request.php');
}

?>