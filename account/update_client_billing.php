<?php
ini_set('max_execution_time', 150);
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');


$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];

if($action=='edit')
    {
        $user_result = select_query_live_con("SELECT * FROM matrix.users where id='".$id."'"); 
				
		$active_query = select_query_live_con("SELECT count(*) as total_vehicle FROM matrix.group_services WHERE active=1 AND 
		sys_group_id in(SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$id."')");
		
		$device_result = select_query("SELECT * FROM new_account_creation where user_name='".$user_result[0]['sys_username']."'"); 
		
    }

//echo "<pre>";print_r($user_result);die; 

?> 

<div class="top-bar">
    <h1>User Details Update </h1>
</div>
<div class="table"> 
 

<?php
 $device_price = 0;
 $device_price_vat = 0;
 $device_price_total = 0;
 $device_rent_Price = 0;
 $device_rent_service_tax = 0;
 $TxtDTotalREnt = 0;

if(isset($_POST["submit"]))
{ 
	//print_r($_POST);die;
	
    $end_date = date("Y-m-d H:i:s");
    $user_id = $_POST['user_id'];
	$dimts = $_POST["dimts"];
	if($dimts == "yes"){ $dimts_val = 1;}else{ $dimts_val = 0;}
    $creation_date = $_POST["creation_date"];
    $account_type = $_POST["account_type"];
	
	if($account_type == "Lease" || $account_type == "Paid" || $account_type == "Crack")
	{	
		$rent_plan = $_POST["rent_plan"];	
		$mode_of_payment = (isset($_POST["mode_of_payment"])) ? trim($_POST["mode_of_payment"]): "";
		
		if($mode_of_payment=="CashClient")
		{
			$device_price_total = (isset($_POST["device_price_total1"])) ? trim($_POST["device_price_total1"]): 0;
			$TxtDTotalREnt = (isset($_POST["TxtDTotalREnt1"])) ? trim($_POST["TxtDTotalREnt1"]): 0;
	   
		}
		else if($mode_of_payment=="Billed")
		{
			$device_price = (isset($_POST["device_price"])) ? trim($_POST["device_price"]): 0;
			$device_price_vat = (isset($_POST["device_price_vat"])) ? trim($_POST["device_price_vat"]): 0;
			$device_price_total = (isset($_POST["device_price_total"])) ? trim($_POST["device_price_total"]): 0;
			$device_rent_Price = (isset($_POST["device_rent_Price"])) ? trim($_POST["device_rent_Price"]): 0;
			$device_rent_service_tax = (isset($_POST["device_rent_service_tax"])) ? trim($_POST["device_rent_service_tax"]): 0;
			$TxtDTotalREnt = (isset($_POST["TxtDTotalREnt"])) ? trim($_POST["TxtDTotalREnt"]): 0;
	   
		}  
		
	}
	else if($account_type == "Demo")
	{
		$demo_time = $_POST["demo_time"];
		$rent_plan = '0';
		$mode_of_payment = '';
		$foc_reason = '';
	}
	
	else if($account_type == "Foc")
	{
		$foc_reason = $_POST["foc_reason"];
		$rent_plan = '0';
		$mode_of_payment = '';
		$demo_time = '';
	}
	else 
	{
		$foc_reason = '';
		$rent_plan = '0';
		$mode_of_payment = '';
		$demo_time = '';
	}
	
	$tot_no_of_veh = $_POST["total_veh"]; 
	$rent_vehicle_wise = $_POST["rent_vehicle_wise"];
	
	for($j=0;$j<=$tot_no_of_veh;$j++)
		{
			if(isset($_POST[$j]))
				{
					$numbe1 = (isset($_POST[$j])) ? trim($_POST[$j])  : "";
					/*$number .=$numbe1.",";*/
					
					$checkarray[] = $numbe1;
				}
		}
	
	//print_r($checkarray);die;
	/*$veh_num = substr($number,0,-1);*/
	
	
	
	
	$group_user_id = select_query_live_con("SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$user_id."'");
    
    $group_id =  $group_user_id[0]['sys_group_id'];
	
	
	/*$client_veh_details = select_query_live_con("select services.id, devices.imei  from matrix.services join matrix.devices on 
	devices.id=services.sys_device_id where services.id in (select distinct sys_service_id from matrix.group_services where active=true 
	and sys_group_id = '".$group_id."' )");*/
	
	$client_veh_details = select_query_live_con("SELECT tbl_history_devices.*,veh_reg,devices.imei FROM matrix.tbl_history_devices LEFT JOIN 
						  matrix.services ON 
 						  tbl_history_devices.sys_service_id=services.id JOIN matrix.devices ON devices.id=services.sys_device_id    
 						  HAVING tbl_history_devices.sys_group_id='".$group_id."' ORDER BY add_date ASC");
	
    $total_vehicle = count($client_veh_details);
	
	$user_chk = select_query("SELECT * FROM internalsoftware.user_payment_history where user_id='".$user_id."'");
	
	if(count($user_chk)>0)
	{
		$Update_bill = array('is_current_status' => 0, 'end_date' =>  $end_date);
		$condition = array('user_id' => $user_id, 'is_current_status' => 1);		
		update_query('internalsoftware.user_payment_history', $Update_bill, $condition);
		
		
		$user_payment_history = array('user_id' => $user_id, 'group_id' => $group_id, 'dimts' => $dimts_val, 'device_price' => $device_price, 
		'device_price_vat' =>  $device_price_vat, 'device_price_total' =>  $device_price_total, 'rent_price' =>  $device_rent_Price, 
		'rent_service_tax' =>  $device_rent_service_tax, 'rent_price_total' =>  $TxtDTotalREnt, 'start_date' =>  date("Y-m-d H:i:s"), 
		'end_date' =>  '0000-00-00 00:00:00', 'mode_of_payment' =>  $mode_of_payment, 'account_type' =>  $account_type, 
		'rent_plan' =>  $rent_plan, 'remarks' =>  'Request genrated by System', 'is_current_status' =>  1, 'demo_time' =>  $demo_time, 
		'foc_reason' =>  $foc_reason, 'crackdevice_price' => 0, 'newdevice_rent_plan' => $rent_plan, 'updatetime' =>  date("Y-m-d H:i:s"));
				
		$Insert_msg = insert_query('internalsoftware.user_payment_history', $user_payment_history);
		
		
		for($k=0;$k<$total_vehicle;$k++)
		{	
			
			if(in_array($client_veh_details[$k]['sys_service_id'], $checkarray))
			{
				$vehicle_billing_history = array('device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_vehicle_wise, 'update_time' =>  date("Y-m-d H:i:s"));
				
				$vehicle_billing_insert = array('group_id' => $group_id, 'vehicle_id' => $client_veh_details[$k]['sys_service_id'], 
				'device_imei' =>  $client_veh_details[$k]['imei'], 'device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_vehicle_wise, 'bill_start_date' => $client_veh_details[$k]['add_date'], 
				'update_time' =>  date("Y-m-d H:i:s"));
			}
			else
			{
				$vehicle_billing_history = array('device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_plan, 'update_time' =>  date("Y-m-d H:i:s"));
				
				$vehicle_billing_insert = array('group_id' => $group_id, 'vehicle_id' => $client_veh_details[$k]['sys_service_id'], 
				'device_imei' =>  $client_veh_details[$k]['imei'], 'device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_plan, 'bill_start_date' => $client_veh_details[$k]['add_date'], 
				'update_time' =>  date("Y-m-d H:i:s"));
			}
			
			$vehicle_chk = select_query("SELECT * FROM internalsoftware.vehicle_billing_history where vehicle_id='".$client_veh_details[$k]['sys_service_id']."'");
			
			if(count($vehicle_chk)>0)
			{
				$condition1 = array('vehicle_id' => $client_veh_details[$k]['sys_service_id']);	
					
				update_query('internalsoftware.vehicle_billing_history', $vehicle_billing_history, $condition1);
			
			}
			else
			{
				
				insert_query('internalsoftware.vehicle_billing_history', $vehicle_billing_insert);
				
			}
			
			
		}
		
	}
	else
	{
		$user_payment_history = array('user_id' => $user_id, 'group_id' => $group_id, 'dimts' => $dimts_val, 'device_price' => $device_price, 
		'device_price_vat' =>  $device_price_vat, 'device_price_total' =>  $device_price_total, 'rent_price' =>  $device_rent_Price, 
		'rent_service_tax' =>  $device_rent_service_tax, 'rent_price_total' =>  $TxtDTotalREnt, 'start_date' =>  $creation_date, 
		'end_date' =>  '0000-00-00 00:00:00', 'mode_of_payment' =>  $mode_of_payment, 'account_type' =>  $account_type, 
		'rent_plan' =>  $rent_plan, 'remarks' =>  'Request genrated by System', 'is_current_status' =>  1, 'demo_time' =>  $demo_time, 
		'foc_reason' =>  $foc_reason, 'crackdevice_price' => 0, 'newdevice_rent_plan' => $rent_plan, 'updatetime' =>  date("Y-m-d H:i:s"));
		
		$Insert_msg =insert_query('internalsoftware.user_payment_history', $user_payment_history);
		
		for($k=0;$k<$total_vehicle;$k++)
		{
			
			if(in_array($client_veh_details[$k]['sys_service_id'], $checkarray))
			{
				$vehicle_billing_history = array('group_id' => $group_id, 'vehicle_id' => $client_veh_details[$k]['sys_service_id'], 
				'device_imei' =>  $client_veh_details[$k]['imei'], 'device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_vehicle_wise, 'bill_start_date' => $client_veh_details[$k]['add_date'], 
				'update_time' =>  date("Y-m-d H:i:s"));
			}
			else
			{
				$vehicle_billing_history = array('group_id' => $group_id, 'vehicle_id' => $client_veh_details[$k]['sys_service_id'], 
				'device_imei' =>  $client_veh_details[$k]['imei'], 'device_price' =>  $device_price, 'rent_price' =>  $device_rent_Price,  
				'mode_of_payment' =>  $mode_of_payment, 'rent_plan' =>  $rent_plan, 'bill_start_date' => $client_veh_details[$k]['add_date'], 
				'update_time' =>  date("Y-m-d H:i:s"));
			}
				
			insert_query('internalsoftware.vehicle_billing_history', $vehicle_billing_history);
		}
		
		
	}
	
	
	
	
    
	if($Insert_msg)
	{
		
		$read_status = array('read_status' => 1);
		$condition2 = array('id' => $user_id);		
		update_query_live_con('matrix.users', $read_status, $condition2);
		
		//echo "Data Update Successfully.";
		echo "<script>alert('Data Update Successfully.');</script>";
	}
	
	 echo "<script>window.close();</script>";
    /*echo "<script>document.location.href ='list_billing_process.php'</script>";*/
   

}
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>

function AccountSelection(Value)
{
    //alert(Value);
	if(Value=="Lease")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		var mode = document.getElementById('mode_of_payment').value;
		
		if(mode == 'CashClient')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Billed')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
		
    }
    else if(Value=="Paid")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		var mode = document.getElementById('mode_of_payment').value;
		
		if(mode == 'CashClient')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Billed')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
    }
	else if(Value=="Demo")
    {
		document.getElementById('demo_id').style.display = "block";
        document.getElementById('foc_id').style.display = "none";
		document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }
	else if(Value=="Foc")
    {
        document.getElementById('foc_id').style.display = "block";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }
	else if(Value=="Crack")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		var mode = document.getElementById('mode_of_payment').value;
		
		if(mode == 'CashClient')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Billed')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
    }   
    else  
    {
        document.getElementById('Billed_id').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
    }
}

function PaymentProcessBYCash(radioValue)
{
    if(radioValue=="CashClient")
    {
        document.getElementById('ChequeCase').style.display = "none";
        document.getElementById('CashCase').style.display = "block";
    }
    else if(radioValue=="Billed")
    {
        document.getElementById('ChequeCase').style.display = "block";
        document.getElementById('CashCase').style.display = "none";
    }
   
    else  
    {
        document.getElementById('ChequeCase').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
    }
}

function validateForm()
{
	var account_val = document.myForm.TxtAccountType.value;
	
	if(account_val == "")
	{
	  alert("Please Choose Account Type") ;
	  document.myForm.TxtAccountType.focus();
	  return false;
	}
	
	if(account_val == "Lease")
    {
		   if(document.myForm.rent_plan.value=="")
			{
			  alert("Please Choose Rent Plan") ;
			  document.myForm.rent_plan.focus();
			  return false;
			}
		   
		   if(document.myForm.mode_of_payment.value=="")
			{
			  alert("Please Choose Mode") ;
			  document.myForm.mode_of_payment.focus();
			  return false;
			}
		 
		 
			if(document.myForm.mode_of_payment.value=="CashClient")
			{
				  if(document.myForm.TxtDPricecash.value=="")
				  {
					  alert("Please Enter Device Price") ;
					  document.myForm.TxtDPricecash.focus();
					  return false;
				  }
				  if(document.myForm.TxtDRentCash.value=="")
				  {
					  alert("Please Enter Rent") ;
					  document.myForm.TxtDRentCash.focus();
					  return false;
				  }
			}
		   
			if(document.myForm.mode_of_payment.value=="Billed")
			{
		   
				if(document.myForm.TxtDPrice.value=="")
				{
					alert("Please Enter Device Price") ;
					document.myForm.TxtDPrice.focus();
					return false;
				}
			   
				if(document.myForm.TxtDRent.value=="")
				{
					alert("Please Enter Rent") ;
					document.myForm.TxtDRent.focus();
					return false;
				}   
			}
    }
	
	if(account_val == "Paid")
    {
		    if(document.myForm.rent_plan.value=="")
			{
			  alert("Please Choose Rent Plan") ;
			  document.myForm.rent_plan.focus();
			  return false;
			}
		   
		   if(document.myForm.mode_of_payment.value=="")
			{
			  alert("Please Choose Mode") ;
			  document.myForm.mode_of_payment.focus();
			  return false;
			}
		 
		 
			if(document.myForm.mode_of_payment.value=="CashClient")
			{
				  if(document.myForm.TxtDPricecash.value=="")
				  {
					  alert("Please Enter Device Price") ;
					  document.myForm.TxtDPricecash.focus();
					  return false;
				  }
				  if(document.myForm.TxtDRentCash.value=="")
				  {
					  alert("Please Enter Rent") ;
					  document.myForm.TxtDRentCash.focus();
					  return false;
				  }
			}
		   
			if(document.myForm.mode_of_payment.value=="Billed")
			{
		   
				if(document.myForm.TxtDPrice.value=="")
				{
					alert("Please Enter Device Price") ;
					document.myForm.TxtDPrice.focus();
					return false;
				}
			   
				if(document.myForm.TxtDRent.value=="")
				{
					alert("Please Enter Rent") ;
					document.myForm.TxtDRent.focus();
					return false;
				}   
			}
    }
	
	if(account_val == "Crack")
    {
		    if(document.myForm.rent_plan.value=="")
			{
			  alert("Please Choose Rent Plan") ;
			  document.myForm.rent_plan.focus();
			  return false;
			}
		   
		   if(document.myForm.mode_of_payment.value=="")
			{
			  alert("Please Choose Mode") ;
			  document.myForm.mode_of_payment.focus();
			  return false;
			}
		 
		 
			if(document.myForm.mode_of_payment.value=="CashClient")
			{
				  if(document.myForm.TxtDPricecash.value=="")
				  {
					  alert("Please Enter Device Price") ;
					  document.myForm.TxtDPricecash.focus();
					  return false;
				  }
				  if(document.myForm.TxtDRentCash.value=="")
				  {
					  alert("Please Enter Rent") ;
					  document.myForm.TxtDRentCash.focus();
					  return false;
				  }
			}
		   
			if(document.myForm.mode_of_payment.value=="Billed")
			{
		   
				if(document.myForm.TxtDPrice.value=="")
				{
					alert("Please Enter Device Price") ;
					document.myForm.TxtDPrice.focus();
					return false;
				}
			   
				if(document.myForm.TxtDRent.value=="")
				{
					alert("Please Enter Rent") ;
					document.myForm.TxtDRent.focus();
					return false;
				}   
			}
    }
	
	if(account_val == "Demo")
	{
		if(document.myForm.demo_time.value=="")
		{
			alert("Please Enter Demo Days") ;
			document.myForm.demo_time.focus();
			return false;
		}
	}
	
	if(account_val == "Foc")
	{
		if(document.myForm.foc_reason.value=="")
		{
			alert("Please Enter FOC Reason") ;
			document.myForm.foc_reason.focus();
			return false;
		}
	}
	
	if(document.myForm.TxtVehicleId.value!="")
	{
	   if(document.myForm.rent_vehicle_wise.value=="")
		{
			alert("Please Choose Vehicle Rent Plan") ;
			document.myForm.rent_vehicle_wise.focus();
			return false;
		}
	}
	
		
}


function calculatetotal(price)
{
    var vatp = 18;
   
    document.getElementById('TxtDVat').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotal').value=parseInt(price)+parseInt(document.getElementById('TxtDVat').value);
    //alert(result);
}

function calculaterent(price)
{
    var vatp = 18;
   
    document.getElementById('TxtDServiceTax').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotalREnt').value=parseInt(price)+parseInt(document.getElementById('TxtDServiceTax').value);
    //alert(result);

}

function CheckUncheck(field){
	
    if(document.getElementById("all_check").checked == true){
		
             for (var i=0;i<field;i++) 
			 {
             	 document.getElementById(i).checked = true;
			 }
      }
       else{
	         for (var i=0;i<field;i++) 
			 {
	         	 document.getElementById(i).checked = false;
			 }
		}
}
</script>
    
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

   <table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">

         <tr>
            <td>User Name </td>
            <td><input type="text" value="<?=$user_result[0]['sys_username'];?>" readonly="readonly"/>
                <input type="hidden" name="user_id" id="user_id" value="<?=$user_result[0]['id'];?>"  /></td>
        </tr>
        <tr>
            <td>Company Name</td>
            <td><input type="text" value="<?=$user_result[0]['company'];?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td>Device Price</td>
            <td><input type="text"  value="<?=$device_result[0]['device_price_total'];?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td>Rent</td>
            <td><input type="text" value="<?=$user_result[0]['price_per_unit'];?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td>Total Vehicle</td>
            <td><input type="text" value="<?=$active_query[0]['total_vehicle'];?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td>Dimts</td>
            <td><input type="checkbox" name="dimts" id="dimts" value="yes" <?php if($user_result[0]['dimts']=="yes")echo "checked";?> /> Yes</td>
        </tr>
        <tr>
            <td>Creation date</td>
            <td><input type="text" name="creation_date" id="creation_date" value="<?=$user_result[0]['sys_added_date'];?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td><label for="Account_Type" id="lblAccountType">Account Type</label></td>
            <td><select name="account_type" id="TxtAccountType"  style="width:150px" onchange="AccountSelection(this.value)">
                <option value="">-- select one --</option>
                <option value="Lease">Lease</option>
                <option value="Paid">Paid</option>
                <option value="Demo">Demo</option>
                <option value="Foc">FOC</option>
                <option value="Crack">Crack</option>
                <option value="InternalTesting">Internal Testing</option>
              </select></td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:40px"><!-- Bill request-->
          
          <table id="Billed_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                  <td><label for="rent_month1" id="rent_month1">Rent Plan</label></td>
                  <td><select name="rent_plan" id="rent_plan" >
                      <option value="">-- Select One --</option>
                      <option value="1">Monthly</option>
                      <option value="3">Quarterly</option>
                      <option value="6">HalfYearly</option>
                      <option value="12">Yearly</option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="Modof_payment"  id="lblModPayment">Mode Of Payment</label></td>
                <td><select name="mode_of_payment" id="mode_of_payment" onchange="PaymentProcessBYCash(this.value)" style="width:150px">
                    <option value="" >-- select one --</option>
                    <option value="CashClient">Cash Client</option>
                    <option value="Billed"> Billed</option>
                  </select></td>
           </tr>
           </table>
        </td>
       </tr>
              
       <tr>
        <td colspan="2" align="left" style="padding-left:40px"><!-- Cheque request-->
          
          <table  id="ChequeCase"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
              <td><label for="price" id="lblDprice">Device Price</label></td>
              <!--<td><input type="value" name="device_price" id="TxtDPrice" value=""  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculatetotal(this.value);"/></td>-->
              <td><input type="value" name="device_price" id="TxtDPrice" value=""  onblur="calculatetotal(this.value);"/></td>
            </tr>
            <tr>
              <td><label for="vat" id="lblDvat">Vat(18%)</label></td>
              <td><input type="value" name="device_price_vat" id="TxtDVat" value="" readonly /></td>
            </tr>
            <tr>
              <td><label for="total" id="lblDTotal">Total</label></td>
              <td><input type="value" name="device_price_total" id="TxtDTotal" value="" readonly /></td>
            </tr>
            <tr>
              <td><label for="rent" id="lblDRent">Rent</label></td>
              <!--<td><input type="value" name="device_rent_Price" id="TxtDRent" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculaterent(this.value);"/></td>-->
              <td><input type="value" name="device_rent_Price" id="TxtDRent" value="" onblur="calculaterent(this.value);"/></td>
            </tr>
            <tr>
              <td><label for="service_tax" id="lblDServiceTax">Service Tex(18%)</label></td>
              <td><input type="value" name="device_rent_service_tax" id="TxtDServiceTax" value="" readonly /></td>
            </tr>
            <tr>
              <td><label for="TxtDTotalREnt" id="lblDrentTotal">Total Rent</label></td>
              <td><input type="value" name="TxtDTotalREnt" id="TxtDTotalREnt" value="" readonly /></td>
            </tr>           
          </table></td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:70px"><!-- Cash request-->
        	<table  id="CashCase"    style="width:100%;display:none;border:1"  cellspacing="5" cellpadding="0">
            <tr>
              <td><label for="price" id="lblDprice">Device Price</label></td>
              <td><input type="value" name="device_price_total1" id="TxtDPricecash" value=""   /></td>
            </tr>
            <tr>
              <td><label for="rent" id="lblDRent">Rent</label></td>
              <td><input type="value" name="TxtDTotalREnt1" id="TxtDRentCash" value="" /></td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
        <td colspan="2" align="left" style="padding-left:40px"><!-- Demo request-->
          
          <table id="demo_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                  <td><label for="demotime" id="demotime">Demo Time</label></td>
                  <td><select name="demo_time" id="demo_time" >
                      <option value="">-- Select One --</option>
					<?php for($d=1;$d<=30;$d++) {?>
                      <option value="<?=$d;?>"><? echo $d.' Days';?></option>
					<?php } ?>
                    </select></td>
            </tr>
            
           </table>
        </td>
       </tr>
      
      <tr>
        <td colspan="2" align="left" style="padding-left:40px"><!-- FOC request-->
          
          <table id="foc_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                  <td><label for="focreason" id="focreason">Foc Reason</label></td>
                  <td><input type="text" name="foc_reason" id="foc_reason" value="" /></td>
            </tr>
            
           </table>
        </td>
       </tr>
       <tr>
            <td>
                Vehicle selection
            </td>
            <td>
            	<select name="vehicle_id" id="TxtVehicleId"  onchange="showUser(this.value,'ajaxdata');">
           		 <option value="">-- Select One --</option>
                 <option value="<?=$user_result[0]['id'];?>">Vehicle wise Billing</option>
                 </select>
            </td>
        </tr>
        <tr>
              <td><label for="rent_vehicle_wise" id="rent_vehicle_wise">Vehicle Rent Plan</label></td>
              <td><select name="rent_vehicle_wise" id="rent_vehicle_wise" >
                  <option value="">-- Select One --</option>
                  <option value="1">Monthly</option>
                  <option value="3">Quarterly</option>
                  <option value="6">HalfYearly</option>
                  <option value="12">Yearly</option>
                </select></td>
        </tr>
        <tr>
            <td colspan="2">
             <div id="ajaxdata">
				<?=$result[0]['transfer_from_reg_no']?>
                </div> 
            
            </td>
        </tr>
        
        
        
        <tr><td colspan="2" align="center"> <input type="submit" name="submit" value="submit"  />
                   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_billing_process.php' " /></td>

        </tr>

     </table>
      </form>
   </div>
 
<?php
include("../include/footer.php"); ?>

