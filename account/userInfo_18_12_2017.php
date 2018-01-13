<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/private/master.php');

include("C:/xampp/htdocs/send_alert/class.phpmailer.php");
include("C:/xampp/htdocs/send_alert/class.smtp.php");

$masterObj = new master();

$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$comment=addslashes($_GET["comment"]);
$_GET['action'];
  
 
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

if(isset($_GET['action']) && $_GET['action']=='companyname')
{
	 
	$sql="select `group`.name as company from matrix.group_users left join matrix.`group` on group_users.sys_group_id=`group`.id where group_users.sys_user_id=".$q;

	$row=select_query_live_con($sql);

	echo $row[0]["company"];
}

if(isset($_GET['action']) && $_GET['action']=='pending_debtor')
{
	 
	$pending_amount_data = select_query("select * from debtor_pending_billing where client_id='".$q."' and (device_amount_pending > 0 or rent_amount_pending > 0 or accessory_amount_pending > 0) order by year,month desc");
	
	$temp='[';
	
	if(count($pending_amount_data) > 0)
	{
		
		for($i=0;$i<count($pending_amount_data);$i++)
		{
			$month_pending = date('F',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));
			$year_pending = date('Y',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));			
			
			
			$temp.='{"id":"'.$pending_amount_data[$i]['id'].'", "client_id":"'.$pending_amount_data[$i]['client_id'].'", "company_name":"'.$pending_amount_data[$i]['company_name'].'",  "sales_manager":"'.$pending_amount_data[$i]['sales_manager'].'", "collection_agent":"'.$pending_amount_data[$i]['collection_agent'].'", "month":"'.$month_pending.'", "year":"'.$year_pending.'", "device_amount_pending":"'.$pending_amount_data[$i]['device_amount_pending'].'", "rent_amount_pending":"'.$pending_amount_data[$i]['rent_amount_pending'].'", "accessory_amount_pending":"'.$pending_amount_data[$i]['accessory_amount_pending'].'", "req_time":"'.$pending_amount_data[$i]['req_time'].'"},';
			
			
			
		}
		
		
       $temp=substr($temp,0,strlen($temp)-1);
		
	}
	
	$temp.=']';
	
	echo $temp;
	
}


/*if(isset($_GET['action']) && $_GET['action']=='deletionclose')
{
    $Updateapprovestatus="update deletion  set sim_to_be_deactivate='Yes', close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}*/

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

/*if(isset($_GET['action']) && $_GET['action']=='sim_changeclose')
{
    $Updateapprovestatus="update sim_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}*/

/*if(isset($_GET['action']) && $_GET['action']=='deactivate_simclose')
{
    $Updateapprovestatus="update deactivate_sim set close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}*/

if(isset($_GET['action']) && $_GET['action']=='simchangebackComment')
{
    
        $query = "SELECT forward_back_comment FROM sim_change  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update sim_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
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

    $Updateapprovestatus="update renew_dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsclose')
{
    $Updateapprovestatus="update del_form_debtors  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
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

if(isset($_GET['action']) && $_GET['action']=='stopgpsbackComment')
{
    
        $query = "SELECT forward_back_comment FROM stop_gps  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update stop_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='startgpsbackComment')
{
    
    $query = "SELECT forward_back_comment FROM start_gps  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update start_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='subusercreationbackComment')
{
    
        $query = "SELECT forward_back_comment FROM sub_user_creation  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update sub_user_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='deactivateaccountbackComment')
{
    
        $query = "SELECT forward_back_comment FROM deactivation_of_account  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update deactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='ReactivateaccountbackComment')
{
    
        $query = "SELECT forward_back_comment FROM reactivation_of_account  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update reactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deletefromdebtorsbackComment')
{
    
        $query = "SELECT forward_back_comment FROM del_form_debtors  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update del_form_debtors set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='nobillbackComment')
{
    
        $query = "SELECT forward_back_comment FROM no_bills  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update no_bills set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='discountingbackComment')
{
    
      $query = "SELECT forward_back_comment FROM discount_details  where id=".$row_id;
      $row=select_query($query);

    $Updateapprovestatus="update discount_details set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='softwarerequestbackComment')
{
    
        $query = "SELECT forward_back_comment FROM software_request  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update software_request set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='transferthevehiclebackComment')
{
    
        $query = "SELECT forward_back_comment FROM transfer_the_vehicle  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update transfer_the_vehicle set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
  if(isset($_GET['action']) && $_GET['action']=='NobillACk')
{
      $Updateapprovestatus="update no_bills  set account_comment='Acknowledged' , final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully Acknowledged";
     
}    
 
   if(isset($_GET['action']) && $_GET['action']=='DiscountingACk')
{
      $Updateapprovestatus="update discount_details  set account_comment='Acknowledged' , final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully Acknowledged";
     
}    

  if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsACk')
{
      $Updateapprovestatus="update del_form_debtors  set account_comment='Acknowledged' , final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully Acknowledged";
     
}    

if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentPending')
{

    $query = "SELECT payment_status FROM dimts_imei  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update dimts_imei  set payment_status='".$row[0]["payment_status"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
      //$Updateapprovestatus="update dimts_imei  set payment_status='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

if(isset($_GET['action']) && $_GET['action']=='RenewDimts_imeiPaymentPending')
{

    $query = "SELECT payment_status FROM renew_dimts_imei  where id=".$row_id;
    $row=select_query($query);
 
    $Updateapprovestatus="update renew_dimts_imei set payment_status='".$row[0]["payment_status"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentClear')
{
     
        $Updateapprovestatus="update dimts_imei  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

if(isset($_GET['action']) && $_GET['action']=='RenewDimts_imeiPaymentClear')
{
     
        $Updateapprovestatus="update renew_dimts_imei set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

if(isset($_GET['action']) && $_GET['action']=='ActivateUserAccount')
{
        $query = "SELECT acc_reason,again_activate_date,sys_username,company FROM matrix.users where id=".$row_id;
        $row=select_query_live($query);
        
		$data1 = array('active' => '1');
		$condition = array('sys_user_id' => $row_id);
		
		update_query_live_con('matrix.group_users', $data1, $condition);
		update_query_live('matrix.group_users', $data1, $condition);
		
        //$activate_user = update_query_live("update matrix.group_users set active=1 where group_users.sys_user_id='".$row_id."'");
        
        /*$Updateapprovestatus="update matrix.users set sys_active=1,acc_reason='".$row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -" .$comment." ,Act. By-".$_SESSION['user_name']."',again_activate_date='".$row[0]["again_activate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name']."'  where id=".$row_id;
        mysql_query($Updateapprovestatus);*/
		
		$Updateapprovestatus = array('sys_active' => '1', 'acc_reason' => $row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -".$comment." Act. By-".$_SESSION['user_name'], 'again_activate_date' => $row[0]["again_activate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name'] );
		$condition2 = array('id' => $row_id);
		
		update_query_live_con('matrix.users', $Updateapprovestatus, $condition2);
		update_query_live('matrix.users', $Updateapprovestatus, $condition2);
    
        $Subject="Activate G-Trac Account of this Client - ".$row[0]["sys_username"];
 
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port 
        $mail->Username   = "info@g-trac.in";  // GMAIL username
        $mail->Password   = "info@123456";            // GMAIL password
        $mail->From       = "info@g-trac.in";
        $mail->FromName   = "G-trac";
        $mail->Subject    = $Subject;
        //$mail->Body       = $message;                      //HTML Body
        $mail->AltBody    = ""; //Text Body
        $mail->WordWrap   = 50; // set word wrap
        
        $textTosend.='Dear Sir,<br>';
        $textTosend.='<br>Praveen Yadav Activate G-Trac Client login Account.<br><br>';
        $textTosend.='User:- '.$row[0]["sys_username"];
        $textTosend.='<br>Company Name:- '.$row[0]["company"];
        //$textTosend.='<br>Activate Date:- '.date("Y-m-d");
        
        //$mail->AddAddress("harish@g-trac.in","Harish Sharma");
        $mail->AddAddress("anuj@g-trac.in","Anuj Juneja");
        $mail->AddAddress("anoop@g-trac.in","Anoop");
        $mail->AddAddress("ritesh@g-trac.in","Ritesh Kapoor");
        $mail->AddAddress("pallavi@g-trac.in","Pallavi");
        $mail->AddAddress("praveen@g-trac.in","Praveen");
        $mail->AddAddress("sarvesh@g-trac.in","Sarvesh");
            
         
        $mail->AddReplyTo("praveen@g-trac.in","Praveen Yadav"); 
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
 
	$data1 = array('active' => '0');
	$condition = array('sys_user_id' => $row_id);
	
	update_query_live_con('matrix.group_users', $data1, $condition);
	update_query_live('matrix.group_users', $data1, $condition);
			
	//$deactivate_user = mysql_query("update matrix.group_users set active=0 where group_users.sys_user_id='".$row_id."'",$dblink);
    
    /*$Updateapprovestatus="update matrix.users set acc_reason='".$row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -" .$comment." ,Dect. By-".$_SESSION['user_name']."',deactivate_date='".$row[0]["deactivate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name']."',sys_active=0 where id=".$row_id;

    mysql_query($Updateapprovestatus,$dblink);*/
	
	$Updateapprovestatus = array('sys_active' => '0', 'acc_reason' => $row[0]["acc_reason"]."<br/>".date("Y-m-d H:i:s")." -".$comment." Dect. By-".$_SESSION['user_name'], 'deactivate_date' => $row[0]["deactivate_date"]."<br/>".date("Y-m-d H:i:s")." By-".$_SESSION['user_name'] );
	$condition2 = array('id' => $row_id);
		
	update_query_live_con('matrix.users', $Updateapprovestatus, $condition2);
	update_query_live('matrix.users', $Updateapprovestatus, $condition2);
     
     $Subject="Deactivate G-Trac Account of this Client - ".$row[0]["sys_username"];
         
        $mail=new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port 
        $mail->Username   = "info@g-trac.in";  // GMAIL username
        $mail->Password   = "info@123456";            // GMAIL password
        $mail->From       = "info@g-trac.in";
        $mail->FromName   = "G-trac";
        $mail->Subject    = $Subject;
        //$mail->Body       = $message;                      //HTML Body
        $mail->AltBody    = ""; //Text Body
        $mail->WordWrap   = 50; // set word wrap
        
         
        
        $textTosend.='Dear Sir,<br>';
        $textTosend.='<br>Praveen Yadav Deactivate G-Trac Client login Account.<br><br>';
        $textTosend.='User:- '.$row[0]["sys_username"];
        $textTosend.='<br>Company Name:- '.$row[0]["company"];
        $textTosend.='<br>Reason:- '.$comment;
        //$textTosend.='<br>Deactivate Date:- '.date("Y-m-d");
        
        //$mail->AddAddress("harish@g-trac.in","Harish Sharma");
        $mail->AddAddress("anuj@g-trac.in","Anuj Juneja");
        $mail->AddAddress("anoop@g-trac.in","Anoop");
        $mail->AddAddress("ritesh@g-trac.in","Ritesh Kapoor");
        $mail->AddAddress("pallavi@g-trac.in","Pallavi");
        $mail->AddAddress("praveen@g-trac.in","Praveen");
        $mail->AddAddress("sarvesh@g-trac.in","Sarvesh");
            
         
        $mail->AddReplyTo("praveen@g-trac.in","Praveen Yadav"); 
        $mail->IsHTML(true);  
        
        $mail->Body = $textTosend;
        
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        }
}


if(isset($_GET['action']) && $_GET['action']=='tempdeactivateUserAccount')
{

	$read_status = array('read_status' => 1);
	$condition2 = array('id' => $row_id);
			
	update_query_live_con('matrix.users', $read_status, $condition2);
			
	$Updateapprovestatus = array('sys_active' => '0' );
		
	update_query_live_con('matrix.users_billing', $Updateapprovestatus, $condition2);
     
	 echo "Successfully Temporary Deactivate.";   
}

if(isset($_GET['action']) && $_GET['action']=='transferUserAccount')
{

	$read_status = array('read_status' => 1);
	$condition2 = array('id' => $row_id);
			
	update_query_live_con('matrix.users', $read_status, $condition2);
			
	$Updateapprovestatus = array('billing_company' => 'Sonipat' );
		
	update_query_live_con('matrix.users_billing', $Updateapprovestatus, $condition2);
     
	 echo "Successfully Transfer.";   
}


  if(isset($_GET['action']) && $_GET['action']=='DeactivationPaymentPending')
{

    $query = "SELECT pay_pending FROM deactivation_of_account  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update deactivation_of_account  set pay_pending='".$row[0]["pay_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

     // $Updateapprovestatus="update deactivation_of_account  set pay_pending='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='ReactivationPaymentPending')
{

    $query = "SELECT pay_pending FROM reactivation_of_account  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update reactivation_of_account set pay_pending='".$row[0]["pay_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='DeactivationPaymentClear')
{
        $Updateapprovestatus="update deactivation_of_account  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

  if(isset($_GET['action']) && $_GET['action']=='ReactivationPaymentClear')
{
        $Updateapprovestatus="update reactivation_of_account  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}        

 if(isset($_GET['action']) && $_GET['action']=='StopGpsPaymentPending')
{

    $query = "SELECT total_pending FROM stop_gps  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update stop_gps  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

      //$Updateapprovestatus="update stop_gps  set total_pending='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

 if(isset($_GET['action']) && $_GET['action']=='StartGpsPaymentPending')
{

    $query = "SELECT total_pending FROM start_gps  where id=".$row_id;
    $row=select_query($query);

    $Updateapprovestatus="update start_gps  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

if(isset($_GET['action']) && $_GET['action']=='StopGpsPaymentClear')
{
      echo $Updateapprovestatus="update stop_gps  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

if(isset($_GET['action']) && $_GET['action']=='StartGpsPaymentClear')
{
      echo $Updateapprovestatus="update start_gps  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

 if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehiclePaymentPending')
{
      
      
    $query = "SELECT total_pending FROM transfer_the_vehicle  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update transfer_the_vehicle  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
      
      //$Updateapprovestatus="update transfer_the_vehicle  set total_pending='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehiclePaymentClear')
{
        $Updateapprovestatus="update transfer_the_vehicle  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    

    
 if(isset($_GET['action']) && $_GET['action']=='DiscountingPaymentPending')
{
    $query = "SELECT total_pending FROM discount_details  where id=".$row_id;
    $row=select_query($query);
    
    $Updateapprovestatus="update discount_details  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='DiscountingPaymentClear')
{
        
        $Updateapprovestatus="update discount_details  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
        if(mysql_query($Updateapprovestatus))
        echo "Ok";
     
}    

if(isset($_GET['action']) && $_GET['action']=='discountingclose')
{
    $Updateapprovestatus="update discount_details set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='no_billsclose')
{
    $Updateapprovestatus="update no_bills  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."',req_close_by='".$_SESSION['user_name']."' where id=".$row_id;
    mysql_query($Updateapprovestatus);
}    
    
if(isset($_GET['action']) && $_GET['action']=='NoBillPaymentPending')
{
       $query = "SELECT total_pending FROM no_bills  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update no_bills  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
      
      
      //$Updateapprovestatus="update no_bills  set total_pending='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}

  if(isset($_GET['action']) && $_GET['action']=='NoBillPaymentClear')
{
      echo $Updateapprovestatus="update no_bills  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}    
    

 if(isset($_GET['action']) && $_GET['action']=='DelfromDebtorsPaymentPending')
{
      
     $query = "SELECT total_pending FROM del_form_debtors  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update del_form_debtors  set total_pending='".$row[0]["total_pending"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
      
      
      //$Updateapprovestatus="update del_form_debtors  set total_pending='".$comment."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Successfully added pending amount";
     
}
  if(isset($_GET['action']) && $_GET['action']=='DelfromDebtorsPaymentClear')
{
      
 $Updateapprovestatus="update del_form_debtors  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."'  where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Ok";
     
}        

if(isset($_GET['action']) && $_GET['action']=='DeactivatesimComment')
{
       
    $query = "SELECT account_comment FROM deactivate_sim  where id=".$row_id;
    $row=select_query($query);
 
    $Updateapprovestatus="update deactivate_sim  set final_status=1,close_date='".date("Y-m-d H:i:s")."',account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
if(isset($_GET['action']) && $_GET['action']=='DeactivatesimPermanent')
{
       
    $query = "SELECT account_comment FROM deactivate_sim_forword_account  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update deactivate_sim_forword_account  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' ,account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 } 
 
 
if(isset($_GET['action']) && $_GET['action']=='accountSimchangeComment')
{
        
        $query = "SELECT account_comment FROM sim_change  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update sim_change  set account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
        
        //$Updateapprovestatus="update sim_change set account_comment='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostPaymentClear')
{
        $Updateapprovestatus="update device_lost  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
 
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostPaymentPending')
{
      
    $query = "SELECT odd_paid_unpaid FROM device_lost  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update device_lost  set odd_paid_unpaid='".$row[0]["odd_paid_unpaid"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
      //$Updateapprovestatus="update device_lost set odd_paid_unpaid='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostComment')
{
     $query = "SELECT account_comment FROM device_lost  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update device_lost  set account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
     
     //$Updateapprovestatus="update device_lost set account_comment='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
 if(isset($_GET['action']) && $_GET['action']=='deletionPaymentClear')
{
       
       
       $Updateapprovestatus="update deletion  set odd_paid_unpaid='Payment cleared-".date("Y-m-d H:i:s")."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
 
  
if(isset($_GET['action']) && $_GET['action']=='deletionPaymentPending')
{
       
            $query = "SELECT odd_paid_unpaid FROM deletion  where id=".$row_id;
    $row=select_query($query);
 

    $Updateapprovestatus="update deletion  set odd_paid_unpaid='".$row[0]["odd_paid_unpaid"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
       //$Updateapprovestatus="update deletion set odd_paid_unpaid='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }

if(isset($_GET['action']) && $_GET['action']=='deletionComment')
{
       
    $query = "SELECT account_comment FROM deletion  where id=".$row_id;
    $row=select_query($query);


    $Updateapprovestatus="update deletion  set account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
        
        //$Updateapprovestatus="update deletion set account_comment='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
  if(isset($_GET['action']) && $_GET['action']=='DeviceChangePaymentClear')
{
        $Updateapprovestatus="update device_change  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
$data = $masterObj->getVehicleDetail($q);

if(isset($_GET['action']) && $_GET['action']=='getdata')
{
	
$ab = count($data);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");

$msg= '<table border="0" style="width:50%;">
<tr><td>All <input type="hidden" name="total_veh" value="'.count($data).'"/></td>
<td><input type="checkbox" name="all_check" id="all_check"  onchange="CheckUncheck('.$ab.');" style="width=20px;"/></td></tr><tr>';

//while($row = mysql_fetch_array($data))
for($veh=0;$veh<count($data);$veh++)
  {
    if($veh%3==0) {
    $msg .="</tr><tr>";
    }
  $msg .='<td>'.$data[$veh]['veh_reg'].'</td><td><input type="checkbox" name='.$veh.' id='.$veh.' value='.$data[$veh]['id'].' style="width=20px;"/></td>' ;
  }
 
 
  $msg .="</tr></table>";
 
  echo $msg;
}
  
if(isset($_GET['action']) && $_GET['action']=='DeviceChangePaymentPending')
{

    
    $query = "SELECT pay_status FROM device_change  where id=".$row_id;
    $row=select_query($query);


    $Updateapprovestatus="update device_change  set pay_status='".$row[0]["pay_status"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

     //$Updateapprovestatus="update device_change set pay_status='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
 }
 
 
 if(isset($_GET['action']) && $_GET['action']=='VehNoChangePaymentClear')
{
     
    /*$query = "SELECT account_comment FROM vehicle_no_change  where id=".$row_id;
    $row=select_query($query);


    $Updateapprovestatus="update vehicle_no_change  set account_comment='".$row[0]["account_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;*/
     $Updateapprovestatus="update vehicle_no_change  set account_comment='Payment cleared-".date("Y-m-d H:i:s")."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus,$dblink2))
     echo "Comment Added Successfully";
    
 }
 
 
  
if(isset($_GET['action']) && $_GET['action']=='VehNoChangePaymentPending')
{
     
    $query = "SELECT payment_status FROM vehicle_no_change  where id=".$row_id;
    $row=select_query($query);


    $Updateapprovestatus="update vehicle_no_change  set payment_status='".$row[0]["payment_status"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
     
    // $Updateapprovestatus="update vehicle_no_change set payment_status='".addslashes($comment)."' where id=".$row_id;
     if(mysql_query($Updateapprovestatus))
     echo "Comment Added Successfully";
    
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

.fix-height {
    max-height: 400px;
    overflow-y: scroll;
}
.fix-height2 {
    max-height: 400px;
    overflow-y: scroll;
}
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
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>

<tr><td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Demo Period</td><td><?echo $row[0]["demo_time"];?></td></tr>
<tr><td>Device Price </td><td><?echo $row[0]["device_price"];?></td></tr>    
<tr><td>Vat(5%) </td><td><?echo $row[0]["device_price_vat"];?></td></tr>    
<tr><td>Total </td><td><?echo $row[0]["device_price_total"];?></td></tr>    
<tr><td>Rent </td><td><?echo $row[0]["device_rent_Price"];?></td></tr>    
<tr><td>Service Tex(12.36%) </td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>    
<tr><td>Total Rent</td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<tr><td>Dimts Fee status </td><td><?echo $row[0]["dimts_fee"];?></td></tr>
<tr><td>Rent Status</td><td><?echo $row[0]["rent_status"];?></td></tr>
<tr><td>Rent Month</td><td><?echo $row[0]["rent_month"];?></td></tr>
<tr><td>Account Type</td><td><?echo $row[0]["account_type"];?></td></tr>
</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Type of Organisation</td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td>PAN No.</td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td> Copy of Pan Card</td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td>Copy of Address Proof</td><td><?echo $row[0]["address_proof"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>

<tr><td colspan="2">-------------------------------------------</td> </tr>

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

    elseIf($tablename=="new_device_addition")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);

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
<? 
if($row[0]["device_type"]=='Old' || $row[0]["device_type"]=='old') 
{
    $Deviceid=$row[0]["old_device_id"];
}
else {
    $Deviceid=$row[0]["device_id"];
}

?>

<tr><td>Device ID </td><td><? echo $Deviceid;?></td></tr>    
<tr><td>Device Mobile Number     </td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>Old Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<? /*if($row[0]["device_type"]=='New'){
$billing_status=$row[0]["billing"];
}
else{
$billing_status=$row[0]["billing_if_old_device"];
}*/
    ?>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_if_no_reason"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC      </td><td><?echo $row[0]["ac"];?></td></tr>
<tr><td>Date Of Installation    </td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
 <tr><td><strong>Process Pending</strong> </td>  <td><strong>
<?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

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
    </tr>

    
</tbody></table>
</div>
</div>
<? }
	elseif($tablename=="device_change")
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
<tr><td colspan="2">-------------------------------------------</td> </tr></table></div>

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

<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_reason"];?></td></tr>

<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr> 
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending </td>  <td><?echo $row[0]["pay_status"];?></td></tr>
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
   
   
    else If($tablename=="comment")
        {
        //"select * from comment where service_id='".$service_id."' order by date desc"
         
    ?><div > <div style=" padding-left: 50px;">
    <h1>Comment</h1> </div>
    <div class="table">
     <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
       <tr><td>  
 <?

$data = select_query_live_con("select * from matrix.comment where service_id='".$RowId."' order by date desc");
 
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


    else If($tablename=="stop_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);
    ?>
    
    <div > <div id="databox">
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
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location     </td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 <div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["stop_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["stop_gps_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
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
    </tr>
</tbody>
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
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["dimts_status"]==1)    
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["dimts_status"]==1)
    {echo "Pending Admin Approval";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["support_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Tech Support for IMEI Uplode";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
    elseif($row[0]["support_comment"]!="" && $row[0]["repair_comment"]!="" && $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
 <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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

 <tr><td colspan="2">-------------------------------------------</td> </tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["renew_dimts_status"]==2 || ( $row[0]["admin_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["renew_dimts_status"]==1){echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["renew_dimts_status"]==1)
    {echo "Pending Admin Approval";}
    elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["renew_dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["port_change_status"]=="Yes" && $row[0]["final_status"]!=1)
    {echo "Pending at Repair For Port Change";}
    elseif(($row[0]["repair_comment"]!="" || ($row[0]["port_change_status"]!="Yes" && ($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="")))&& $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

 <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<!--<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>-->
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

<tr><td>Total no of Vehicles </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicles for No Bill</td><td><?echo $row[0]["veh_no_bill"];?></td></tr>
<tr><td>No Bill For    </td><td><?echo $row[0]["rent_device"];?></td></tr> 
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td>Issue for No Bill</td><td><?echo $row[0]["no_bill_issue"];?></td></tr> 
<tr><td>Provision Bill    </td><td><?echo $row[0]["provision_bill"];?></td></tr>
<tr><td>Duration for Provision Bill    </td><td><?echo $row[0]["duration"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
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
 
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
 <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
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
<tr><td>Service Action</td><td><?echo $row[0]["service_action"];?></td></tr> 
<tr><td>Issue for Discountng</td><td><?echo $row[0]["discount_issue"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
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
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
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
    elseIf($tablename=="sub_user_creation")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);

    ?><div > <div style=" padding-left: 50px;">
    <h1>Sub User Creation
</h1> </div>
    <div class="table">
    <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
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
<tr><td>Vehicle to move     </td><td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td></tr>
<tr><td>Contact Person     </td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number     </td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Sub-User Name     </td><td><?echo $row[0]["name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["req_sub_user_pass"];?></td></tr>
<tr><td>Main User Separate</td><td><?echo $row[0]["billing_separate"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
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
    </tr>
    </table>
    </div> 
    </div> 
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

<tr><td>Veh Num</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["device_sim"];?></td></tr>
<tr><td>Present Status of Device</td><td>---------------------------</td></tr>
<tr><td>Location</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Ownership</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>SIM Status</td><td><?echo $row[0]["sim_status"];?></td></tr>
<tr><td>Change Date</td><td><?echo $row[0]["change_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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
    else If($tablename=="deactivation_of_account")
        {
         $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);


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
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>


<tr><td>Pending Amount</td>  <td><?echo $row[0]["pay_pending"];?></td></tr>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["deactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
    elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["deactivation_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["deactivation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["deactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Stock Comment</td>  <td><?echo $row[0]["no_device_removed"];?></td></tr>
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
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["reactivation_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
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
<tr><td colspan="2">-------------------------------------------</td> </tr>
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
<tr><td>Stock Comment</td>  <td><?echo $row[0]["no_device_removed"];?></td></tr>
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
    </tr><br />
</tbody>

    </table>
    </div> 
    </div> 


    <? } 
    else If($tablename=="software_request")
        {
        $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);



    ?><div > <div style=" padding-left: 50px;">
    <h1>Software Request</h1> </div>
    <div class="table">
    <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
  

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
<tr><td>Total No Of Vehicle</td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr>      
<tr><td>Potential</td><td><?echo $row[0]["potential"];?></td></tr>  

<tr><td>Requested Software:---</td><td></td></tr>      

<tr><td>Google Map</td><td><?echo $row[0]["rs_google_map"];?></td></tr>      
<tr><td>Admin </td><td><?echo $row[0]["rs_admin"];?></td></tr>     
<tr><td><tr><td>Type Of Alert</td><td><?echo $row[0]["alert"];?></td></tr>      
<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>      
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr>     
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact`"];?></td></tr>      
<tr><td>Client Contact Number </td><td><?echo $rowuser[0]["mobile_number"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>

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
<tr><td>Total No Of Vehicle </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>     
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
    </tr>
 

    </table>
    </div> 
    </div> 
    

    <?}


    else If($tablename=="imei_change")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
            $row=select_query($query);
    ?><div > <div style=" padding-left: 50px;">
    <h1>IMEI Change</h1> </div>
    <div class="table">
    <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
      
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
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

 <tr><td colspan="2">-------------------------------------------</td> </tr>

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

?></td> 
    </tr>

    
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
    <tr><td colspan="2">-------------------------------------------</td> </tr>
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
<tr><td>Stock Comment</td><td><?echo $row[0]["stock_comment"];?></td></tr>
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
<tr><td colspan="2">-------------------------------------------</td> </tr>
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

 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
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
    </tr>
 
</tbody>
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

 <tr><td colspan="2">-------------------------------------------</td> </tr>

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
<tr><td>Payment Pending </td>  <td><?echo $row[0]["payment_status"];?></td></tr>
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
 <tr><td colspan="2">-------------------------------------------</td> </tr>
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

 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
 <tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Stock Comment</td>  <td><?echo $row[0]["stock_comment"];?></td></tr>
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

?></td></tr>
</tbody>
    </table>
    </div> 
    </div> 
    <?
    }
	
	elseIf($tablename=="debtor_show")
    {
			$sql_query = select_query("select dpb.company_name, sp.name as sales_manager, ca.name as collection_agent 
			 from debtor_pending_billing as dpb left join sales_person as sp on dpb.sales_manager=sp.id left join 
			 collection_agent as ca on dpb.collection_agent=ca.id where dpb.client_id='".$RowId."' limit 1");
			
			$pndg_sub_query = select_query("select dpb.client_id,dpb.company_name, dpb.month,dpb.year, dpb.device_amount_pending, 
											dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time from 
											debtor_pending_billing as dpb where dpb.client_id='".$RowId."'");
			
			$recd_sub_query = select_query("SELECT client_id,company_name, `month`, `year`, SUM(device_amount_recd) AS device_amount_recd, 
											SUM(rent_amount_recd) AS rent_amount_recd, SUM(accessory_amount_recd) AS accessory_amount_recd,  
											SUM(discounting) AS discounting, SUM(tds_amount) AS tds_amount, received_time
											FROM debtor_received_billing WHERE client_id='".$RowId."' GROUP BY YEAR,MONTH ");


    ?>
<div id="databox">
<div class="heading">View Debtors Details</div>
<div class="dataleft">
<table cellspacing="2" cellpadding="2">
<tbody> 
<tr><td>Company Name </td> <td><?echo $sql_query[0]["company_name"];?></td></tr>
<tr><td>Account Manager</td> <td><?echo $sql_query[0]["sales_manager"];?></td></tr>
<tr><td>Collection Agent</td> <td><?echo $sql_query[0]["collection_agent"];?></td></tr>
</tbody></table>
<div class="fix-height">
<table > 
<tr><th colspan="2" align="right">Pending Debtor</th></tr>
<tbody>
<?

for($sq=0;$sq<count($pndg_sub_query);$sq++)
	{
		$monthyear = $pndg_sub_query[$sq]["year"].'-'.$pndg_sub_query[$sq]["month"];
	    $pending_month = date('F Y', strtotime($monthyear));
?>
<tr><th colspan="2" align="left"><?=$pending_month;?></th></tr>

<tr><td>Device Pending</td><td><? echo (int)$pndg_sub_query[$sq]["device_amount_pending"];?></td></tr>
<tr><td>Rent Pending</td><td><? echo (int)$pndg_sub_query[$sq]["rent_amount_pending"];?></td></tr>     
<tr><td>Accessory pending </td><td><? echo (int)$pndg_sub_query[$sq]["accessory_amount_recd"];?></td></tr>   
 
<? } ?>

</tbody></table></div></div>
 
<div class="dataright fix-height2">
<table cellspacing="2" cellpadding="2">

<? 
if(count($recd_sub_query) > 0)
{

?>
<tr><th colspan="2" align="right">Received Amount</th></tr>
<tbody>
<?

for($rs=0;$rs<count($recd_sub_query);$rs++)
	{
		$monthyear = $recd_sub_query[$rs]["year"].'-'.$recd_sub_query[$rs]["month"];
	    $pending_month = date('F Y', strtotime($monthyear));
?>
<tr><th colspan="2" align="left"><?=$pending_month;?></th></tr>

<tr><td>Device Amount Recd</td><td><? echo (int)$recd_sub_query[$rs]["device_amount_recd"];?></td></tr>
<tr><td>Rent Amount Recd</td><td><? echo (int)$recd_sub_query[$rs]["rent_amount_recd"];?></td></tr>     
<tr><td>Accessory Amount Recd </td><td><? echo (int)$recd_sub_query[$rs]["accessory_amount_recd"];?></td></tr>   
<? if((int)$recd_sub_query[$rs]["discounting"] > 0) { ?>
<tr><td>Discounting </td><td><? echo (int)$recd_sub_query[$rs]["discounting"];?></td></tr> 
<? } if((int)$recd_sub_query[$rs]["tds_amount"] > 0) {?>
<tr><td>TDS Amount </td><td><? echo (int)$recd_sub_query[$rs]["tds_amount"];?></td></tr> 
<? } ?>
<? }  ?>

   
</tbody>
<? } else { ?>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><th colspan="2" align="right">No Received Amount</th></tr>

<? } ?> 

</table>
</div>
</div>
<? }
	
	
    }
?>