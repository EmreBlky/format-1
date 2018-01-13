<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

$action = $_GET['action'];
$id = $_GET['id'];
$page = $_POST['page'];
if($action=='edit' or $action=='editp')
{
	$result = select_query("select * from new_account_creation where id=$id");   
	
	$ModelData = select_query("select * from new_account_model_master where is_active='0' and new_account_reqid='".$id."' ");
	$modelcount = count($ModelData);
	$toolk=explode('#',$result[0]['accessories_tollkit']);
	//echo "<pre>";print_r($ModelData);die;
}
?>

<div class="top-bar">
  <h1>New account creation</h1>
</div>
<div class="table">
<?php
 $device_price = 0;
 $device_price_vat = 0;
 $device_price_total = 0;
 $device_rent_Price = 0;
 $device_rent_service_tax = 0;
 $TxtDTotalREnt = 0;

if(isset($_POST["submit"]) && $_POST["submit"]=="submit")
{
    //echo "<pre>";print_r($_POST);die;
	
	$action = $_POST['action'];
    $id = $_POST["id"];
    $date = date("Y-m-d H:i:s");
	$account_manager = $_SESSION['user_name'];
	//$sales_manager = $_POST["sales_manager"];
	$collection_manager = $_POST["collection_manager"];
    $company = (isset($_POST["company"])) ? trim($_POST["company"]): "";    
    $potential = (isset($_POST["potential"])) ? trim($_POST["potential"]): "";
	$type_of_org = (isset($_POST["type_of_org"])) ? trim($_POST["type_of_org"]): "";
	$pan_no = (isset($_POST["pan_no"])) ? trim($_POST["pan_no"]): "";
	$client_gst_no = (isset($_POST["client_gst_no"])) ? trim($_POST["client_gst_no"]): "";
    $contact_person = (isset($_POST["contact_person"])) ? trim($_POST["contact_person"]): "";
    $contact_number = (isset($_POST["contact_number"])) ? trim($_POST["contact_number"]): "";
    $billing_name = (isset($_POST["billing_name"])) ? trim($_POST["billing_name"]): "";
    $billing_address = (isset($_POST["billing_address"])) ? trim($_POST["billing_address"]): "";
	
    $dimts = (isset($_POST["dimts"])) ? trim($_POST["dimts"]): "";
    $dimts_fee = (isset($_POST["dimts_fee"])) ? trim($_POST["dimts_fee"]): "";
    $vehicle_type = (isset($_POST["vehicle_type"])) ? trim($_POST["vehicle_type"]): "";
    $immobilizer = (isset($_POST["immobilizer"])) ? trim($_POST["immobilizer"]): "";
    $ac_on_off = (isset($_POST["ac_on_off"])) ? trim($_POST["ac_on_off"]): "";
	$vehicle_warranty = (isset($_POST["vehicle_warranty"])) ? trim($_POST["vehicle_warranty"]): "";
	$client_state = (isset($_POST["State"])) ? trim($_POST["State"]): "";
    $email_id = (isset($_POST["email_id"])) ? trim($_POST["email_id"]): "";
    $user_name = (isset($_POST["user_name"])) ? trim($_POST["user_name"]): "";
    $user_password = (isset($_POST["user_password"])) ? trim($_POST["user_password"]): "";
    //$new_acc_salescomment = (isset($_POST["new_acc_salescomment"])) ? trim($_POST["new_acc_salescomment"]): ""; 
	
	$acess_selection = $_POST['access_radio'];
    if($acess_selection=='yes')
    {
      for($i=0;$i<count($_POST['accessories']);$i++)
      {
        $accessories_tollkit.=$_POST['accessories'][$i]."#";
        $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
      }
    }
   else
   {
      $accessories_tollkits="";
   }
 
  	if($sales_manager=="") {
    	$sales_manager_edit = $result[0]['sales_manager'];
    } else {
   	 $sales_manager_edit = $sales_manager;
    }
     
	if($action=='edit')
	{
		$query="update new_account_creation set company='".$company."', potential='".$potential."', client_gst_no='".$client_gst_no."', 
				type_of_org='".$type_of_org."', pan_no='".$pan_no."', contact_person='".$contact_person."', contact_number='".$contact_number."', 
				billing_name='".$billing_name."', billing_address='".$billing_address."', dimts='".$dimts."', dimts_fee='".$dimts_fee."', 
				vehicle_type='".$vehicle_type."', immobilizer='".$immobilizer."', ac_on_off='".$ac_on_off."',  email_id='".$email_id."', 
				user_name='".$user_name."', user_password='".$user_password."', collection_manager='".$collection_manager."', 
				vehicle_warranty='".$vehicle_warranty."', client_state='".$client_state."', acess_selection='".$acess_selection."', 
				accessories_tollkit='".$accessories_tollkits."'  where id=$id";
		
		select_query($query);

		$deleted_query = select_query("DELETE FROM `internalsoftware`.`new_account_model_master` WHERE is_active='0' and new_account_reqid=$id");
		
		for($ar=0;$ar<count($_POST["device_type"]);$ar++)
		{
			$device_type = (isset($_POST["device_type"][$ar])) ? trim($_POST["device_type"][$ar]): "";
			$modelno = (isset($_POST["model_no"][$ar])) ? trim($_POST["model_no"][$ar]): "";
			$account_type = (isset($_POST["account_type"][$ar])) ? trim($_POST["account_type"][$ar]): "";
			$mode_of_payment = (isset($_POST["mode_of_payment"][$ar])) ? trim($_POST["mode_of_payment"][$ar]): "";
			$rent_month = (isset($_POST["rent_month"][$ar])) ? trim($_POST["rent_month"][$ar]): "";
			
			$device_price = (isset($_POST["device_price"][$ar])) ? trim($_POST["device_price"][$ar]): 0;
			$device_price_vat = (isset($_POST["device_price_vat"][$ar])) ? trim($_POST["device_price_vat"][$ar]): 0;
			$device_price_total = (isset($_POST["device_price_total"][$ar])) ? trim($_POST["device_price_total"][$ar]): 0;
			
			if($ar == 0){
				$device_statuscash = (isset($_POST["device_statuscash"])) ? trim($_POST["device_statuscash"]): "";		
				$rent_status_cash = (isset($_POST["rent_status_cash"])) ? trim($_POST["rent_status_cash"]): "";
			}else{
				$device_statuscash = (isset($_POST["device_statuscash".$ar])) ? trim($_POST["device_statuscash".$ar]): "";		
				$rent_status_cash = (isset($_POST["rent_status_cash".$ar])) ? trim($_POST["rent_status_cash".$ar]): "";
			}
			
			$rent_Price = (isset($_POST["rent_Price"][$ar])) ? trim($_POST["rent_Price"][$ar]): 0;
			$rent_service_tax = (isset($_POST["rent_service_tax"][$ar])) ? trim($_POST["rent_service_tax"][$ar]): 0;
			$TxtDTotalREnt = (isset($_POST["TxtDTotalREnt"][$ar])) ? trim($_POST["TxtDTotalREnt"][$ar]): 0;
			
			$foc_reason = (isset($_POST["foc_reason"][$ar])) ? trim($_POST["foc_reason"][$ar]): "";
			$testing_time = (isset($_POST["testing_time"][$ar])) ? trim($_POST["testing_time"][$ar]): "";
			$demo_time = (isset($_POST["demo_time"][$ar])) ? trim($_POST["demo_time"][$ar]): "";	
			
			$addModel = "insert into new_account_model_master(new_account_reqid, date, device_type, device_model, account_type, mode_of_payment, 				
				rent_month, device_price, device_status, device_price_vat, device_price_total, device_rent_Price, rent_status, 
				device_rent_service_tax, DTotalREnt, demo_time, foc_reason, testing_time) values('".$id."','".$date."','".$device_type."',
				'".$modelno."','".$account_type."','".$mode_of_payment."','".$rent_month."','".$device_price."','".$device_statuscash."',
				'".$device_price_vat."','".$device_price_total."','".$rent_Price."','".$rent_status_cash."','".$rent_service_tax."',
				'".$TxtDTotalREnt."','".$demo_time."','".$foc_reason."','".$testing_time."')";
			
			select_query($addModel);
				
		}		
		
		echo "<script>document.location.href ='accountcreation.php'</script>";
	}
	else if($action=='editp')
	{
		$query="update new_account_creation set sales_manager='".$account_manager."', company='".$company."', potential='".$potential."', 
				type_of_org='".$type_of_org."', pan_no='".$pan_no."', contact_person='".$contact_person."', contact_number='".$contact_number."', 
				billing_name='".$billing_name."', billing_address='".$billing_address."', dimts='".$dimts."', dimts_fee='".$dimts_fee."', 
				vehicle_type='".$vehicle_type."', immobilizer='".$immobilizer."', ac_on_off='".$ac_on_off."',  email_id='".$email_id."', 
				user_name='".$user_name."', user_password='".$user_password."', collection_manager='".$collection_manager."', 
				vehicle_warranty='".$vehicle_warranty."', client_state='".$client_state."', acess_selection='".$acess_selection."', 
				accessories_tollkit='".$accessories_tollkits."', client_gst_no='".$client_gst_no."'  where id=$id";
		
		select_query($query);
				
		echo "<script>document.location.href ='accountcreation.php'</script>";
	}
	else
	{
		/*$query = "insert into new_account_creation(date, account_manager, sales_manager, collection_manager, company, potential, type_of_org, 
				pan_no, contact_person, contact_number, billing_name, billing_address, dimts, dimts_fee, vehicle_type, immobilizer, ac_on_off, 
				email_id, user_name, user_password, new_acc_salescomment, branch_id) values('".$date."','".$account_manager."',
				'".$sales_manager."','".$collection_manager."','".$company."','".$potential."','".$type_of_org."','".$pan_no."',
				'".$contact_person."','".$contact_number."','".$billing_name."','".$billing_address."','".$dimts."','".$dimts_fee."',
				'".$vehicle_type."','".$immobilizer."','".$ac_on_off."','".$email_id."','".$user_name."','".$user_password."',
				'".$new_acc_salescomment."','".$_SESSION['BranchId']."')";
		
		$getValue = select_query($query);*/
		
		$insert_accountCreation = array('date' => $date, 'account_manager' => $account_manager, 'sales_manager' => $account_manager, 
			'collection_manager' => $collection_manager, 'company' =>  $company, 'potential' =>  $potential, 'type_of_org' =>  $type_of_org, 
			'pan_no' =>  $pan_no, 'contact_person' =>  $contact_person, 'contact_number' =>  $contact_number, 'billing_name' =>  $billing_name, 
			'billing_address' =>  $billing_address, 'dimts' =>  $dimts, 'dimts_fee' =>  $dimts_fee, 'vehicle_type' =>  $vehicle_type,
			'immobilizer' =>  $immobilizer, 'ac_on_off' =>  $ac_on_off, 'email_id' =>  $email_id, 'user_name' => $user_name, 
			'user_password' => $user_password, 'branch_id' =>  $_SESSION['BranchId'], 'vehicle_warranty' => $vehicle_warranty, 
			'client_state' => $client_state, 'acess_selection' => $acess_selection, 'accessories_tollkit' => $accessories_tollkits,
			'client_gst_no'=> $client_gst_no  );
				
		$Insert_data = insert_query('internalsoftware.new_account_creation', $insert_accountCreation);
		$lastInsert = $Insert_data;
		
		for($ar=0;$ar<count($_POST["device_type"]);$ar++)
		{
			$device_type = (isset($_POST["device_type"][$ar])) ? trim($_POST["device_type"][$ar]): "";
			$modelno = (isset($_POST["model_no"][$ar])) ? trim($_POST["model_no"][$ar]): "";
			$account_type = (isset($_POST["account_type"][$ar])) ? trim($_POST["account_type"][$ar]): "";
			$mode_of_payment = (isset($_POST["mode_of_payment"][$ar])) ? trim($_POST["mode_of_payment"][$ar]): "";
			$rent_month = (isset($_POST["rent_month"][$ar])) ? trim($_POST["rent_month"][$ar]): "";
			
			$device_price = (isset($_POST["device_price"][$ar])) ? trim($_POST["device_price"][$ar]): 0;
			$device_price_vat = (isset($_POST["device_price_vat"][$ar])) ? trim($_POST["device_price_vat"][$ar]): 0;
			$device_price_total = (isset($_POST["device_price_total"][$ar])) ? trim($_POST["device_price_total"][$ar]): 0;
			
			if($ar == 0){
				$device_statuscash = (isset($_POST["device_statuscash"])) ? trim($_POST["device_statuscash"]): "";		
				$rent_status_cash = (isset($_POST["rent_status_cash"])) ? trim($_POST["rent_status_cash"]): "";
			}else{
				$device_statuscash = (isset($_POST["device_statuscash".$ar])) ? trim($_POST["device_statuscash".$ar]): "";		
				$rent_status_cash = (isset($_POST["rent_status_cash".$ar])) ? trim($_POST["rent_status_cash".$ar]): "";
			}
			
			$rent_Price = (isset($_POST["rent_Price"][$ar])) ? trim($_POST["rent_Price"][$ar]): 0;
			$rent_service_tax = (isset($_POST["rent_service_tax"][$ar])) ? trim($_POST["rent_service_tax"][$ar]): 0;
			$TxtDTotalREnt = (isset($_POST["TxtDTotalREnt"][$ar])) ? trim($_POST["TxtDTotalREnt"][$ar]): 0;
			
			$foc_reason = (isset($_POST["foc_reason"][$ar])) ? trim($_POST["foc_reason"][$ar]): "";
			$testing_time = (isset($_POST["testing_time"][$ar])) ? trim($_POST["testing_time"][$ar]): "";
			$demo_time = (isset($_POST["demo_time"][$ar])) ? trim($_POST["demo_time"][$ar]): "";	
			
	   		$addModel = "insert into new_account_model_master(new_account_reqid, date, device_type, device_model, account_type, mode_of_payment, 				
				rent_month, device_price, device_status, device_price_vat, device_price_total, device_rent_Price, rent_status, 
				device_rent_service_tax, DTotalREnt, demo_time, foc_reason, testing_time) values('".$lastInsert."','".$date."','".$device_type."',
				'".$modelno."','".$account_type."','".$mode_of_payment."','".$rent_month."','".$device_price."','".$device_statuscash."',
				'".$device_price_vat."','".$device_price_total."','".$rent_Price."','".$rent_status_cash."','".$rent_service_tax."',
				'".$TxtDTotalREnt."','".$demo_time."','".$foc_reason."','".$testing_time."')";
			
			select_query($addModel);
					
		}		

		echo "<script>document.location.href ='accountcreation.php'</script>";
	
	}

}

?>
<script type="text/javascript">

function trim(inputString){
		 inputString=inputString.replace(/^\s+/g,"");
		 inputString=inputString.replace(/\s+$/g,"");
		 return inputString;
	}

function is_email(email) {
	if(!email.match(/^[A-Za-z0-9\._\-+]+@[A-Za-z0-9_\-+]+(\.[A-Za-z0-9_\-+]+)+$/))
		return false;
	else
		return true;
}
	
function Check()
{
  /*if(document.myForm.sales_manager.value=="")
  {
      alert("Please Select Sales Manager") ;
      document.myForm.sales_manager.focus();
      return false;
  }*/
  if(document.myForm.collection_manager.value=="")
  {
      alert("Please Select Collection Manager") ;
      document.myForm.collection_manager.focus();
      return false;
  }
  if(document.myForm.TxtCompany.value=="")
  {
      alert("Please Enter Company Name") ;
      document.myForm.TxtCompany.focus();
      return false;
  } 
  if(document.myForm.TxtPotentail.value=="")
  {
      alert("Please Enter Potential") ;
      document.myForm.TxtPotentail.focus();
      return false;
  } 
  if(document.myForm.TxtContactPerson.value=="")
  {
      alert("Please Enter Contact Person") ;
      document.myForm.TxtContactPerson.focus();
      return false;
  }
  if(document.myForm.TxtContactNumber.value=="")
  {
      alert("Please Enter Contact No. ") ;
      document.myForm.TxtContactNumber.focus();
      return false;
  }
  var TxtContactNumber=document.myForm.TxtContactNumber.value;
  if(TxtContactNumber!="")
  {
    var length=TxtContactNumber.length;
   
        if(length < 10 || length > 15 || TxtContactNumber.search(/[^0-9\-()+]/g) != -1 )
        {
            alert('Please enter valid mobile number');
            document.myForm.TxtContactNumber.focus();
            document.myForm.TxtContactNumber.value="";
            return false;
        }
   }
  if(document.myForm.TxtEmailId.value=="")
  {
        alert("Please Enter Customer E-mail ID") ;
        document.myForm.TxtEmailId.focus();
        return false;
  }
  if(document.myForm.TxtEmailId.value != "") 
  {
	if(is_email(document.myForm.TxtEmailId.value) == false) 
	{
		alert("Please Enter valid Customer Email ID");
		document.myForm.TxtEmailId.focus();
		return false;
	}
  }
  if(document.myForm.TxtUserName.value=="")
  {
	alert("Please Enter Customer Username") ;
	document.myForm.TxtUserName.focus();
	return false;
  }
  if(document.myForm.TxtUserPass.value=="")
  {
	alert("Please Enter Customer Password") ;
	document.myForm.TxtUserPass.focus();
	return false;
  }
  if(document.myForm.TxtBillingName.value=="")
  {
      alert("Please Enter Billing name") ;
      document.myForm.TxtBillingName.focus();
      return false;
  }
  if(document.myForm.TxtBillingAdd.value=="")
  {
	  alert("Please Enter Billing Address") ;
	  document.myForm.TxtBillingAdd.focus();
	  return false;
  }
  
  var Dtable = document.getElementById('dataTable');
  var DrowCount = Dtable.rows.length;
  //console.log(DrowCount);
  
  for(var m=0; m<DrowCount; m++)
  {
	  if(m == 0)
		{
     	    var fcounter = 0;
			var fTxtDeviceType = 'TxtDeviceType';
			var fmodel_no = 'model_no';
			var fTxtAccountType = 'TxtAccountType';
			var fmode_of_payment = 'mode_of_payment';
			var fTxtRentPlan = 'TxtRentPlan';
			
			var fdevicePrice = 'TxtDPrice';
			var fdevice_statuscash = 'device_statuscash';
			var fdevice_statuscash2 = 'device_statuscash_two';
			var frentPrice = 'TxtDRent';
			var frent_status_cash = 'rent_status_cash';
			var frent_status_cash2 = 'rent_status_cash_two';
			
			var fdemo = 'demo_time';
			var ffoc = 'foc_reason';
			var ftesting = 'testing_time';
		}
		else
		{
			var fTxtDeviceType = 'TxtDeviceType'+fcounter;
			var fmodel_no = 'model_no'+fcounter;
			var fTxtAccountType = 'TxtAccountType'+fcounter;
			var fmode_of_payment = 'mode_of_payment'+fcounter;
			var fTxtRentPlan = 'TxtRentPlan'+fcounter;
			
			var fdevicePrice = 'TxtDPrice'+fcounter;
			var fdevice_statuscash = 'device_statuscash'+fcounter;
			var fdevice_statuscash2 = 'device_statuscash_two'+fcounter;
			var frentPrice = 'TxtDRent'+fcounter;
			var frent_status_cash = 'rent_status_cash'+fcounter;
			var frent_status_cash2 = 'rent_status_cash_two'+fcounter;
			
			var fdemo = 'demo_time'+fcounter;
			var ffoc = 'foc_reason'+fcounter;
			var ftesting = 'testing_time'+fcounter;
		}
	
	//console.log('Loop-'+m);
	//console.log('counter-'+fcounter);
	
	  if(document.getElementById(fTxtDeviceType).value=="")
	  {
		  alert("Please Select Device Type") ;
		  document.getElementById(fTxtDeviceType).focus();
		  return false;
	  }
	  if(document.getElementById(fmodel_no).value=="")
	  {
		  alert("Please Select Device Model") ;
		  document.getElementById(fmodel_no).focus();
		  return false;
	  }
	 
	  var AccountType = document.getElementById(fTxtAccountType).value;
	  if(AccountType == "")
	  {
		  alert("Please Select Account Type") ;
		  document.getElementById(fTxtAccountType).focus();
		  return false;
	  }
	  
 	  if(AccountType=="Lease" || AccountType=="Paid" || AccountType=="Crack" || AccountType=="Trip Based" || AccountType=="POC(Paid Demo)")
	  {
	  	  var ModePayment = document.getElementById(fmode_of_payment).value;
		  var Plan = document.getElementById(fTxtRentPlan).value;
		  
		  if(ModePayment == "")
		  {
			  alert("Please Select Payment Mode") ;
			  document.getElementById(fmode_of_payment).focus();
			  return false;
		  }
		  if(Plan == "")
		  {
			  alert("Please Select Billing Plan") ;
			  document.getElementById(fTxtRentPlan).focus();
			  return false;
		  }
		  
		  /*if(ModePayment == "CashClient" && Plan != "")
		  {
			  if(document.getElementById(fdevicePrice).value=="")
			  {
				  alert("Please Enter Device Price") ;
				  document.getElementById(fdevicePrice).focus();
				  return false;
			  }
			  if(document.getElementById(frentPrice).value=="")
			  {
				  alert("Please Enter Rent Price") ;
				  document.getElementById(frentPrice).focus();
				  return false;
			  }
			  
		  }*/
		  if((ModePayment == "Billed" || ModePayment == "CashClient") && Plan != "")
		  {
			  if(document.getElementById(fdevicePrice).value=="")
			  {
				  alert("Please Enter Device Price") ;
				  document.getElementById(fdevicePrice).focus();
				  return false;
			  }
			  
			  var device_status_chked = document.getElementById(fdevice_statuscash).checked;
			  var device_status_chked1 = document.getElementById(fdevice_statuscash2).checked;
			  
			  if(device_status_chked  == false && device_status_chked1  == false)
			  {
					alert("please Select Device Price Excluding/Including.");
					return false;
			  }
		 
			  if(document.getElementById(frentPrice).value=="")
			  {
				  alert("Please Enter Rent Price") ;
				  document.getElementById(frentPrice).focus();
				  return false;
			  }
			  
			  var rent_status_chked = document.getElementById(frent_status_cash).checked;
			  var rent_status_chked1 = document.getElementById(frent_status_cash2).checked;
				
			  if(rent_status_chked  == false && rent_status_chked1  == false)
			  {
					alert("please Select Rent Price Excluding/Including.");
					return false;
			  }
		  }
		  
	  }
	  
	  if(AccountType=="Demo")
	  {
	  	  if(document.getElementById(fdemo).value=="")
		  {
			  alert("Please Select Demo Days") ;
			  document.getElementById(fdemo).focus();
			  return false;
		  }
		  
	  }
	  
	  if(AccountType=="Foc")
	  {
		  if(document.getElementById(ffoc).value=="")
		  {
			  alert("Please Enter FOC Reason") ;
			  document.getElementById(ffoc).focus();
			  return false;
		  }
	  }
	  
	  if(AccountType=="InternalTesting")
	  {
		  if(document.getElementById(ftesting).value=="")
		  {
			  alert("Please Select Testing Days") ;
			  document.getElementById(ftesting).focus();
			  return false;
		  }
	  }
	  
	  m=m+2;
	  fcounter++;
	  
  }
	   
    if(document.myForm.TxtVehicleType.value=="")
    {
        alert("Please Select Vehicle type") ;
        document.myForm.TxtVehicleType.focus();
        return false;
    }
	if(document.myForm.TxtVehicleWarranty.value=="")
    {
        alert("Please Select Device Warranty") ;
        document.myForm.TxtVehicleWarranty.focus();
        return false;
    }
	if(document.myForm.TxtState.value=="")
    {
        alert("Please Select State") ;
        document.myForm.TxtState.focus();
        return false;
    }
	
	
  var acc = document.myForm.acc.value;
  if(acc==null || acc=="")
  {
      alert("Please Select Accessories Button") ;
      return false;
  }
  if(document.myForm.access_radio.value == 'yes')
  {

	 var accessories = document.getElementsByName("accessories[]");
	 var acc_len = $('[name="accessories[]"]:checked').length;
	
	if(acc_len == '' || acc_len == '0')
	{
	  alert('Please Select Atleast One Accessories');
	  return false;
	
	}

  }
	
	
   
}

 

/******** Select All Check box function ********/

function showAccess(radioValue)
{
  //alert(radioValue)
   if(radioValue=="yes")
    {
        document.getElementById('accessTable').style.display = "block";
    }
    else if(radioValue=="no")
    {
        document.getElementById('accessTable').style.display = "none";
    }
    else
    {
        document.getElementById('accessTable').style.display = "none";
    }
   
}

function selectAllAccessory(source) {
    var checkboxes = document.getElementsByName('accessories[]');
    for(var i in checkboxes)
      checkboxes[i].checked = source.checked;
  }

/********End Select All Check box function ********/

function DimtsPayment(radioValue1)
{
    if(radioValue1=="Yes")
    {
        document.getElementById('DimtsCase').style.display = "block";
    }
    else
    {
        document.getElementById('DimtsCase').style.display = "none";
    }
}

function DevicePriceView(dPrice,deviceVal,dStatus,dStatustwo,dTax,dTotal,dName,dAcType,dPayment,dPlan)
{	
	var deviceModel = document.getElementById(dName).value;
	var actype = document.getElementById(dAcType).value;
	var payment = document.getElementById(dPayment).value;
	var plan = document.getElementById(dPlan).value;
	//console.log(dPrice+'-'+deviceModel+'-'+actype+'-'+payment+'-'+plan);
	
	if(deviceModel != '')
	{
		if((actype == 'Paid' || actype == 'POC(Paid Demo)') && (payment == 'Billed' || payment == 'CashClient'))
		{
			if(deviceModel == 79 && dPrice<5000)
			{
				document.getElementById(dStatus).disabled=true;
				document.getElementById(dStatustwo).disabled=true;
				
				document.getElementById(dStatus).checked=false;
				document.getElementById(dStatustwo).checked=false;
				document.getElementById(dTax).value = '';
				document.getElementById(dTotal).value = '';
				document.getElementById(deviceVal).value = '';
				alert('Pointer Model Price Never Less than 5000 RS.');
				return false;
			}
			else if(deviceModel != 79 && dPrice<4000)
			{
				document.getElementById(dStatus).disabled=true;
				document.getElementById(dStatustwo).disabled=true;
				
				document.getElementById(dStatus).checked=false;
				document.getElementById(dStatustwo).checked=false;
				document.getElementById(dTax).value = '';
				document.getElementById(dTotal).value = '';
				document.getElementById(deviceVal).value = '';
				alert('All Model Price Never Less than 4000 RS.');
				return false;
			}
			else
			{
				document.getElementById(dStatus).disabled=false;
				document.getElementById(dStatustwo).disabled=false;
				
				document.getElementById(dStatus).checked=false;
				document.getElementById(dStatustwo).checked=false;
				document.getElementById(dTax).value = '';
				document.getElementById(dTotal).value = '';
			}
		}
		else
		{
			document.getElementById(dStatus).checked=false;
			document.getElementById(dStatustwo).checked=false;
			document.getElementById(dTax).value = '';
			document.getElementById(dTotal).value = '';
		}
	}
	else
	{
		document.getElementById(dStatus).checked=false;
		document.getElementById(dStatustwo).checked=false;
		document.getElementById(dTax).value = '';
		document.getElementById(dTotal).value = '';
		
		document.getElementById(deviceVal).value = '';
		alert('Please Select Device Model Name.');
		return false;
	}
}

/*function DevicePriceCashView(dPrice,deviceVal,dName,dAcType,dPayment,dPlan)
{	
	var deviceModel = document.getElementById(dName).value;
	var actype = document.getElementById(dAcType).value;
	var payment = document.getElementById(dPayment).value;
	var plan = document.getElementById(dPlan).value;
	//console.log(dPrice+'-'+deviceModel+'-'+actype+'-'+payment+'-'+plan);
	
	if(deviceModel != '')
	{
		if((actype == 'Paid' || actype == 'POC(Paid Demo)') && payment == 'CashClient')
		{
			if(deviceModel == 79 && dPrice<5000)
			{
				document.getElementById(deviceVal).value = '';
				alert('Pointer Model Price Never Less than 5000 RS.');
				return false;
			}
			else if(deviceModel != 79 && dPrice<4000)
			{
				document.getElementById(deviceVal).value = '';
				alert('All Model Price Never Less than 4000 RS.');
				return false;
			}
		}
	}
	else
	{
		document.getElementById(deviceVal).value = '';
		alert('Please Select Device Model Name.');
		return false;
	}
}*/

function DeviceRentView(rPrice,rentVal,rStatus,rStatustwo,rTax,rTotal,dName,rAcType,rPayment,rPlan)
{	
	var deviceModel = document.getElementById(dName).value;
	var actype = document.getElementById(rAcType).value;
	var payment = document.getElementById(rPayment).value;
	var plan = document.getElementById(rPlan).value;
	//console.log(rPrice+'-'+deviceModel+'-'+actype+'-'+payment+'-'+plan);
	
	if(deviceModel != '')
	{
		if((actype == 'Paid' || actype == 'POC(Paid Demo)') && (payment == 'Billed' || payment == 'CashClient'))
		{
			if(rPrice<250)
			{
				document.getElementById(rStatus).disabled=true;
				document.getElementById(rStatustwo).disabled=true;
				
				document.getElementById(rStatus).checked=false;
				document.getElementById(rStatustwo).checked=false;
				document.getElementById(rTax).value = '';
				document.getElementById(rTotal).value = '';
				document.getElementById(rentVal).value = '';
				alert('Rent Price Never Less than 250 RS.');
				return false;
			}
			else
			{
				document.getElementById(rStatus).disabled=false;
				document.getElementById(rStatustwo).disabled=false;
				
				document.getElementById(rStatus).checked=false;
				document.getElementById(rStatustwo).checked=false;
				document.getElementById(rTax).value = '';
				document.getElementById(rTotal).value = '';
			}
		}
		else
		{
			document.getElementById(rStatus).checked=false;
			document.getElementById(rStatustwo).checked=false;
			document.getElementById(rTax).value = '';
			document.getElementById(rTotal).value = '';
		}
	}
	else
	{
		document.getElementById(rStatus).checked=false;
		document.getElementById(rStatustwo).checked=false;
		document.getElementById(rTax).value = '';
		document.getElementById(rTotal).value = '';
		
		document.getElementById(rentVal).value = '';
		alert('Please Select Device Model Name.');
		return false;
	}
}

/*function DeviceRentCashView(rPrice,rentVal,dName,rAcType,rPayment,rPlan)
{	
	var deviceModel = document.getElementById(dName).value;
	var actype = document.getElementById(rAcType).value;
	var payment = document.getElementById(rPayment).value;
	var plan = document.getElementById(rPlan).value;
	//console.log(rPrice+'-'+deviceModel+'-'+actype+'-'+payment+'-'+plan);
	
	if(deviceModel != '')
	{
		if((actype == 'Paid' || actype == 'POC(Paid Demo)') && payment == 'CashClient')
		{
			if(rPrice<250)
			{
				document.getElementById(rentVal).value = '';
				alert('Rent Price Never Less than 250 RS.');
				return false;
			}
		}
	}
	else
	{
		document.getElementById(rentVal).value = '';
		alert('Please Select Device Model Name.');
		return false;
	}
}*/

function calculateDeviceTotal(value,dStatus,Dprice,Dtax,Dtotal,Dplan,DAcType,dName)
{
    //console.log(value+'-'+Dprice+'-'+Dtax+'-'+Dtotal);
	var price = document.getElementById(Dprice).value;
	var plan = document.getElementById(Dplan).value;
	var actype = document.getElementById(DAcType).value;
	var deviceStatus = document.getElementById(dStatus).value;
	var deviceModel = document.getElementById(dName).value;
	
	var deviceTax = document.getElementById(Dtax).value;
	var deviceTotal = document.getElementById(Dtotal).value;
			
	var vatp = 18;
	
	if(actype == 'Lease')
	{
		if(price != '')
		{
			if(value == 'Excluding')
			{
				if(deviceTax == '' && deviceTotal == '')
				{
					var vat = parseInt(price * vatp / 100);
					document.getElementById(Dtax).value = vat;
					document.getElementById(Dtotal).value = ((parseFloat(price)+ parseFloat(vat)) * plan);
				}
				else
				{
					document.getElementById(Dprice).value = '';
					document.getElementById(dStatus).checked=false;
					document.getElementById(Dtax).value = '';
					document.getElementById(Dtotal).value='';
				}
			}
			else if(value == 'Including')
			{
				if(deviceTax == '' && deviceTotal == '')
				{
					var amount = (price * 100 / 118).toFixed(2);
					var vat = (amount * vatp / 100).toFixed(2);
					var final_amount = parseFloat(amount)+ parseFloat(vat);
					document.getElementById(Dtax).value = vat;
					document.getElementById(Dprice).value = amount;
					document.getElementById(Dtotal).value = Math.round(final_amount);
				}
				else
				{
					document.getElementById(Dprice).value = '';
					document.getElementById(dStatus).checked=false;
					document.getElementById(Dtax).value = '';
					document.getElementById(Dtotal).value='';
				}
			}
						
		}
		else
		{
			alert("Kindly Enter Device price.");
			document.getElementById(dStatus).checked=false;
			
		}
	}
	else if(actype == 'Paid' || actype == 'POC(Paid Demo)')
	{
		if(price != '')
		{
			if(deviceModel == 79 && price>=5000)
			{
				if(value == 'Excluding')
				{
					if(deviceTax == '' && deviceTotal == '')
					{	
						var vat = parseInt(price * vatp / 100);
						document.getElementById(Dtax).value = vat;
						document.getElementById(Dtotal).value = parseFloat(price)+ parseFloat(vat);
					}
					else
					{
						document.getElementById(Dprice).value = '';
						document.getElementById(dStatus).checked=false;
						document.getElementById(Dtax).value = '';
						document.getElementById(Dtotal).value='';
					}
				}
				else if(value == 'Including')
				{
					if(deviceTax == '' && deviceTotal == '')
					{
						var amount = (price * 100 / 118).toFixed(2);
						var vat = (amount * vatp / 100).toFixed(2);
						var final_amount = parseFloat(amount)+ parseFloat(vat);
						if(amount>=5000)
						{
							document.getElementById(Dtax).value = vat;
							document.getElementById(Dprice).value = amount;
							document.getElementById(Dtotal).value = Math.round(final_amount);
						}
						else
						{
							alert('Including Device Price Never Less than 5900 RS.');
							document.getElementById(dStatus).checked=false;
							document.getElementById(Dtax).value = '';
							document.getElementById(Dtotal).value='';
						}
					}
					else
					{
						document.getElementById(Dprice).value = '';
						document.getElementById(dStatus).checked=false;
						document.getElementById(Dtax).value = '';
						document.getElementById(Dtotal).value='';
					}
				}
			}
			else if(deviceModel != 79 && price>=4000)
			{
				if(value == 'Excluding')
				{
					if(deviceTax == '' && deviceTotal == '')
					{
						var vat = parseInt(price * vatp / 100);
						document.getElementById(Dtax).value = vat;
						document.getElementById(Dtotal).value = parseFloat(price)+ parseFloat(vat);
					}
					else
					{
						document.getElementById(Dprice).value = '';
						document.getElementById(dStatus).checked=false;
						document.getElementById(Dtax).value = '';
						document.getElementById(Dtotal).value='';
					}
					
				}
				else if(value == 'Including')
				{
					if(deviceTax == '' && deviceTotal == '')
					{
						var amount = (price * 100 / 118).toFixed(2);
						var vat = (amount * vatp / 100).toFixed(2);
						var final_amount = parseFloat(amount)+ parseFloat(vat);
						if(amount>=4000)
						{
							document.getElementById(Dtax).value = vat;
							document.getElementById(Dprice).value = amount;
							document.getElementById(Dtotal).value = Math.round(final_amount);
						}
						else
						{
							alert('Including Device Price Never Less than 4720 RS.');
							document.getElementById(dStatus).checked=false;
							document.getElementById(Dtax).value = '';
							document.getElementById(Dtotal).value='';
						}
					}
					else
					{
						document.getElementById(Dprice).value = '';
						document.getElementById(dStatus).checked=false;
						document.getElementById(Dtax).value = '';
						document.getElementById(Dtotal).value='';
					}
				}
			}
		}
		else
		{
			alert("Kindly Enter Device price.");	
			document.getElementById(dStatus).checked=false;
		}
	}
	else
	{	
		if(price != '')
		{
			if(value == 'Excluding')
			{
				if(deviceTax == '' && deviceTotal == '')
				{
					var vat = parseInt(price * vatp / 100);
					document.getElementById(Dtax).value = vat;
					document.getElementById(Dtotal).value = parseFloat(price)+ parseFloat(vat);
				}
				else
				{
					document.getElementById(Dprice).value = '';
					document.getElementById(dStatus).checked=false;
					document.getElementById(Dtax).value = '';
					document.getElementById(Dtotal).value='';
				}
			}
			else if(value == 'Including')
			{
				if(deviceTax == '' && deviceTotal == '')
				{
					var amount = (price * 100 / 118).toFixed(2);
					var vat = (amount * vatp / 100).toFixed(2);
					var final_amount = parseFloat(amount)+ parseFloat(vat);
					document.getElementById(Dtax).value = vat;
					document.getElementById(Dprice).value = amount;
					document.getElementById(Dtotal).value = Math.round(final_amount);
				}
				else
				{
					document.getElementById(Dprice).value = '';
					document.getElementById(dStatus).checked=false;
					document.getElementById(Dtax).value = '';
					document.getElementById(Dtotal).value='';
				}
			}
		}
		else
		{
			alert("Kindly Enter Device price.");	
			document.getElementById(dStatus).checked=false;
		}
	}
   
}

function calculateRent(value,rStatus,Rprice,Rtax,Rtotal,Rplan,DAcType)
{
    //console.log(value+'-'+Rprice+'-'+Rtax+'-'+Rtotal);
	var price = document.getElementById(Rprice).value;
	var plan = document.getElementById(Rplan).value;
	var actype = document.getElementById(DAcType).value;
	var rentStatus = document.getElementById(rStatus).value;
	
	var rentTax = document.getElementById(Rtax).value;
	var rentTotal = document.getElementById(Rtotal).value;

	var taxp = 18;
	
	if(price != '')
	{
		if(actype == 'Paid')
		{
			if(price>=250)
			{
				if(value == 'Excluding')
				{
					if(rentTax == '' && rentTotal == '')
					{
						var tax = parseInt(price * taxp / 100);
						document.getElementById(Rtax).value = tax;
						document.getElementById(Rtotal).value = ((parseFloat(price)+ parseFloat(tax)) * plan);
					}
					else
					{
						document.getElementById(Rprice).value = '';
						document.getElementById(rStatus).checked=false;
						document.getElementById(Rtax).value = '';
						document.getElementById(Rtotal).value='';
					}
				}
				else if(value == 'Including')
				{
					if(rentTax == '' && rentTotal == '')
					{
						var amount = (price * 100 / 118).toFixed(2);
						var tax = (amount * taxp / 100).toFixed(2);
						var final_rent_amount = ((parseFloat(amount)+ parseFloat(tax)) * plan);
						if(amount>=250)
						{
							document.getElementById(Rtax).value = tax;
							document.getElementById(Rprice).value = amount;
							document.getElementById(Rtotal).value = Math.round(final_rent_amount);
						}
						else
						{
							alert('Including Rent Price Never Less than 295 RS.');
							document.getElementById(rStatus).checked=false;
							document.getElementById(Rtax).value = '';
							document.getElementById(Rtotal).value='';
						}
					}
					else
					{
						document.getElementById(Rprice).value = '';
						document.getElementById(rStatus).checked=false;
						document.getElementById(Rtax).value = '';
						document.getElementById(Rtotal).value='';
					}
				}
			}
			else
			{
				alert('Rent Price Never Less than 250 RS.');
				document.getElementById(rStatus).checked=false;
				document.getElementById(Rtax).value = '';
				document.getElementById(Rtotal).value='';
			}
		}
		else
		{
			if(value == 'Excluding')
			{
				if(rentTax == '' && rentTotal == '')
				{
					var tax = parseInt(price * taxp / 100);
					document.getElementById(Rtax).value = tax;
					document.getElementById(Rtotal).value = ((parseFloat(price)+ parseFloat(tax)) * plan);
				}
				else
				{
					document.getElementById(Rprice).value = '';
					document.getElementById(rStatus).checked=false;
					document.getElementById(Rtax).value = '';
					document.getElementById(Rtotal).value='';
				}
			}
			else if(value == 'Including')
			{
				if(rentTax == '' && rentTotal == '')
				{
					var amount = (price * 100 / 118).toFixed(2);
					var tax = (amount * taxp / 100).toFixed(2);
					var final_rent_amount = ((parseFloat(amount)+ parseFloat(tax)) * plan);
					document.getElementById(Rtax).value = tax;
					document.getElementById(Rprice).value = amount;
					document.getElementById(Rtotal).value = Math.round(final_rent_amount);
				}
				else
				{
					document.getElementById(Rprice).value = '';
					document.getElementById(rStatus).checked=false;
					document.getElementById(Rtax).value = '';
					document.getElementById(Rtotal).value='';
				}
			}
		}
	}
	else
	{
		alert("Kindly Enter Rent price.");	
		document.getElementById(rStatus).checked=false;
		//return false;
	}

}

function DeviceSelection(deviceId,setDivId,setsecondDivId,setotherDivId,rentPlan,modelName)
{
	//alert(modelName);
	var newDiv; var otherDiv;
	
	newDiv = document.getElementById(setsecondDivId);
	otherDiv = document.getElementById(setotherDivId);
	newDiv.innerHTML = '';
	otherDiv.innerHTML = '';
	document.getElementById(rentPlan).value  = "";
	
    $.ajax({
		type:"GET",
		url:"userInfo.php?action=getmodel",
		data:"user_id="+deviceId+"&model="+modelName,
		beforeSend: function(msg)
		{
			document.getElementById(setDivId).disabled=true;
			document.getElementById(setDivId).value = '';
		},
		success:function(msg){
			document.getElementById(setDivId).disabled=false;
			document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}

function DeviceSelectionEdit(deviceId,setDivId,modelName)
{
    $.ajax({
		type:"GET",
		url:"userInfo.php?action=getmodel",
		data:"user_id="+deviceId+"&model="+modelName,
		success:function(msg){
			document.getElementById(setDivId).disabled=false;
			document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}

function PaymentPlan(value,setDivId,setotherDivId,RentPlan,loopval)
{
	var newDiv; var otherDiv;
	
	newDiv = document.getElementById(setDivId);
	otherDiv = document.getElementById(setotherDivId);
	newDiv.innerHTML = '';
	otherDiv.innerHTML = '';
	
	if(value != '')
	{
		document.getElementById(RentPlan).disabled=false;
		document.getElementById(RentPlan).value  = "";
	}
	else
	{
		document.getElementById(RentPlan).disabled=true;		
	}
}

function ValidateSameModel(value,cdType,cdModel,cdAcType)
{
	var arr = []; var a = [];
	while (a.length > 0) {
		a.pop();
	} // Fastest
	var cdevice = document.getElementById(cdType).value;
	var cmodel = document.getElementById(cdModel).value;
	var cactype = document.getElementById(cdAcType).value;
	//console.log(value+'-'+cdevice+'-'+cmodel+'-'+cactype);
	a.push(cdevice+'-'+cmodel+'-'+cactype);

	var Dtable = document.getElementById('dataTable');
	var DrowCount = Dtable.rows.length;
	//console.log(DrowCount);
	
	for(var m=0; m<DrowCount; m++)
	{
		if(m == 0)
		{
     	    var fcounter = 0;
			var dType = 'TxtDeviceType';
			var dModel = 'model_no';
			var dAcType = 'TxtAccountType';			
		}
		else
		{
			var dType = 'TxtDeviceType'+fcounter;
			var dModel = 'model_no'+fcounter;
			var dAcType = 'TxtAccountType'+fcounter;
		}
		
		var device = document.getElementById(dType).value;
		var model = document.getElementById(dModel).value;
		var actype = document.getElementById(dAcType).value;
		//console.log(value+'-'+device+'-'+model+'-'+actype);
		arr.push(device+'-'+model+'-'+actype);	
		
	   m=m+2;
	  fcounter++;
	}
	
	var countMatched = 0,countNotMatched = 0;
	for(var index=0;index<arr.length;index++)
    {
      if(arr[index] == a[0]){
        countMatched++;
	  }      
    }
    //console.log(countMatched );
	
	if(countMatched>1)
	{
		alert('You Can Not Select Same Model with Same Account.');
		document.getElementById(cdAcType).value  = "";
	}
		
}

function AccountSelection(actype,setDivId,setotherDivId,setPayment,RentPlan,cdType,cdModel,loopval)
{ 	
	//console.log(actype+'-'+setDivId+'-'+setotherDivId+'-'+setPayment+'-'+RentPlan+'-'+loopval);
	var newDiv; var otherDiv; var lpno='';
	
	newDiv = document.getElementById(setDivId);
	otherDiv = document.getElementById(setotherDivId);
	newDiv.innerHTML = '';
	otherDiv.innerHTML = '';
	
	if(loopval == '')
	{
		var fnfoc = 'foc_reason';
		var fntest = 'testing_time';
		var fndemo = 'demo_time';
		var device_statuscash = 'device_statuscash';
		var rent_status_cash = 'rent_status_cash';
		
		if(actype == 'Foc')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else if(actype == 'Demo')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else if(actype == 'InternalTesting')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else
		{
			document.getElementById(setPayment).style.display = "block";
			document.getElementById(RentPlan).style.display = "block";
			document.getElementById(setPayment).value  = "";
			document.getElementById(RentPlan).value  = "";
			document.getElementById(RentPlan).disabled=true;
		}		
	}
	else
	{
		var fnfoc = 'foc_reason'+loopval;
		var fntest = 'testing_time'+loopval;
		var fndemo = 'demo_time'+loopval;
		var device_statuscash = 'device_statuscash'+loopval;
		var rent_status_cash = 'rent_status_cash'+loopval;
			
		if(actype == 'Foc')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
					
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else if(actype == 'Demo')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else if(actype == 'InternalTesting')
		{
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
		}
		else
		{
			document.getElementById(setPayment).style.display = "block";
			document.getElementById(RentPlan).style.display = "block";
			document.getElementById(setPayment).value  = "";
			document.getElementById(RentPlan).value  = "";
			document.getElementById(RentPlan).disabled=true;
		}
		
	}
	
	var arr = []; var a = [];
	while (a.length > 0) {
		a.pop();
	} // Fastest
	var cdevice = document.getElementById(cdType).value;
	var cmodel = document.getElementById(cdModel).value;
	//console.log(value+'-'+cdevice+'-'+cmodel+'-'+cactype);
	a.push(cdevice+'-'+cmodel+'-'+actype);

	var Dtable = document.getElementById('dataTable');
	var DrowCount = Dtable.rows.length;
	//console.log(DrowCount);
	
	for(var m=0; m<DrowCount; m++)
	{
		if(m == 0)
		{
     	    var fcounter = 0;
			var dType = 'TxtDeviceType';
			var dModel = 'model_no';
			var dAcType = 'TxtAccountType';			
		}
		else
		{
			var dType = 'TxtDeviceType'+fcounter;
			var dModel = 'model_no'+fcounter;
			var dAcType = 'TxtAccountType'+fcounter;
		}
		
		var device = document.getElementById(dType).value;
		var model = document.getElementById(dModel).value;
		var actype = document.getElementById(dAcType).value;
		//console.log(value+'-'+device+'-'+model+'-'+actype);
		arr.push(device+'-'+model+'-'+actype);	
		
	   m=m+2;
	  fcounter++;
	}
	
	var countMatched = 0,countNotMatched = 0;
	for(var index=0;index<arr.length;index++)
    {
      if(arr[index] == a[0]){
        countMatched++;
	  }      
    }
    //console.log(countMatched );
	
	if(countMatched>1)
	{
		alert('You Can Not Select More Same Model with Same Account.');
		document.getElementById(cdModel).value  = "";
	}
	
}

function AccountSelectionEdit(actype,setDivId,setotherDivId,setPayment,RentPlan,cdType,cdModel,loopval)
{ 	
	//console.log(actype+'-'+setDivId+'-'+setotherDivId+'-'+setPayment+'-'+RentPlan+'-'+loopval);
	var newDiv; var otherDiv; var lpno='';
	
	newDiv = document.getElementById(setDivId);
	otherDiv = document.getElementById(setotherDivId);
	
	if(loopval == '')
	{
		var fnfoc = 'foc_reason';
		var fntest = 'testing_time';
		var fndemo = 'demo_time';
		var device_statuscash = 'device_statuscash';
		var rent_status_cash = 'rent_status_cash';
		
		if(actype == 'Foc')
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[0]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
								
		}
		else if(actype == 'Demo')
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[0]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			
		}
		else if(actype == 'InternalTesting')
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
			document.getElementById(setPayment).style.display = "none";
			document.getElementById(RentPlan).style.display = "none";
			
			newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[0]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			
		}
		else
		{
			document.getElementById(setPayment).style.display = "block";
			document.getElementById(RentPlan).style.display = "block";
			
		}		
	}
	else
	{
		var fnfoc = 'foc_reason'+loopval;
		var fntest = 'testing_time'+loopval;
		var fndemo = 'demo_time'+loopval;
		var device_statuscash = 'device_statuscash'+loopval;
		var rent_status_cash = 'rent_status_cash'+loopval;
			
		if(loopval == 1)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[1]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[1]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[1]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 2)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[2]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[2]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[2]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 3)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[3]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[3]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[3]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 4)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[4]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[4]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[4]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 5)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[5]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[5]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[5]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 6)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[6]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[6]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[6]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 7)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[7]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[7]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[7]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 8)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[8]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[8]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[8]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}
		else if(loopval == 9)
		{
			if(actype == 'Foc')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
						
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="text" name="foc_reason[]" id="'+fnfoc+'" value="<?=$ModelData[9]['foc_reason'];?>" placeholder="Foc Reason" style="width:150px" /><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="testing_time[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'Demo')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="demo_time[]" id="'+fndemo+'" style="width:150px"><option value="">-- Select Demo --</option> <?php for($d=1;$d<=30;$d++) {?> <option value="<?=$d;?>"<? if($ModelData[9]['demo_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option> <?php } ?> </select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else if(actype == 'InternalTesting')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				document.getElementById(setPayment).style.display = "none";
				document.getElementById(RentPlan).style.display = "none";
				
				newDiv.innerHTML += '<tr><td>&nbsp;</td><td><select name="testing_time[]" id="'+fntest+'" style="width:150px" ><option value="">-- Select Testing Days --</option><?php for($d=1;$d<=30;$d++) {?><option value="<?=$d;?>"<? if($ModelData[9]['testing_time']==$d){?> selected="selected"<?}?>><? echo $d.' Days';?></option><?php } ?></select><input type="hidden" name="device_price[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price_total[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="rent_Price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="TxtDTotalREnt[]" /><input type="hidden" name="foc_reason[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
			}
			else
			{
				document.getElementById(setPayment).style.display = "block";
				document.getElementById(RentPlan).style.display = "block";
			}
		}			
		
	}
	
}

function BillingPlan(planId,setDivId,setotherDivId,setPayment,accountType,loopval)
{
	//alert(setPayment);
	var newDiv; var otherDiv; var payment; var account;
	
	newDiv = document.getElementById(setDivId);
	otherDiv = document.getElementById(setotherDivId);
	payment = document.getElementById(setPayment).value;
	account = document.getElementById(accountType).value;
	
	//console.log(account);
	
	if(loopval == '')
	{
		var devicePrice = 'TxtDPrice';
		var device_statuscash = 'device_statuscash';
		var device_statuscash2 = 'device_statuscash_two';
		var deviceVat = 'TxtDVat';
		var deviceTotal = 'TxtDTotal';
		var rentPrice = 'TxtDRent';
		var rent_status_cash = 'rent_status_cash';
		var rent_status_cash2 = 'rent_status_cash_two';
		var rentServiceTax = 'TxtDServiceTax';
		var rentTotal = 'TxtDTotalREnt';
		
		var fndevicePrice = "'TxtDPrice'";
		var fndeviceVat = "'TxtDVat'";
		var fndeviceTotal = "'TxtDTotal'";
		var fnrentPrice = "'TxtDRent'";
		var fnrentServiceTax = "'TxtDServiceTax'";
		var fnrentTotal = "'TxtDTotalREnt'";
		
		var fnplan = "'TxtRentPlan'";
		var fnaccountType = "'TxtAccountType'";
		var fnpayment = "'mode_of_payment'";
		var fndemo = 'demo_time';
		
		var fnDevicetype = "'TxtDeviceType'";
		var fndevice_statuscash = "'device_statuscash'";
		var fndevice_statuscash2 = "'device_statuscash_two'";
		var fnrent_status_cash = "'rent_status_cash'";
		var fnrent_status_cash2 = "'rent_status_cash_two'";
		
		if(planId != null && planId != '')
		{
			if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				
				if(payment == 'Billed' || payment == 'CashClient')
				{			
					if(planId == 1)
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					
				}
				/*else if(payment == 'CashClient')
				{
					if(planId == 1)
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
					}
					else
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
					}
				}*/
			}
		
		}
		else
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
		}
	}
	else
	{
		var devicePrice = 'TxtDPrice'+loopval;
		var device_statuscash = 'device_statuscash'+loopval;
		var device_statuscash2 = 'device_statuscash_two'+loopval;
		var deviceVat = 'TxtDVat'+loopval;
		var deviceTotal = 'TxtDTotal'+loopval;
		var rentPrice = 'TxtDRent'+loopval;
		var rent_status_cash = 'rent_status_cash'+loopval;
		var rent_status_cash2 = 'rent_status_cash_two'+loopval;
		var rentServiceTax = 'TxtDServiceTax'+loopval;
		var rentTotal = 'TxtDTotalREnt'+loopval;
		
		var fndevicePrice = "'TxtDPrice"+loopval+"'";
		var fndeviceVat = "'TxtDVat"+loopval+"'";
		var fndeviceTotal = "'TxtDTotal"+loopval+"'";
		var fnrentPrice = "'TxtDRent"+loopval+"'";
		var fnrentServiceTax = "'TxtDServiceTax"+loopval+"'";
		var fnrentTotal = "'TxtDTotalREnt"+loopval+"'";
		
		var fnplan = "'TxtRentPlan"+loopval+"'";
		var fnaccountType = "'TxtAccountType"+loopval+"'";
		var fnpayment = "'mode_of_payment"+loopval+"'";
		var fndemo = 'demo_time'+loopval;
				
		var fnDevicetype = "'TxtDeviceType"+loopval+"'";
		var fndevice_statuscash = "'device_statuscash"+loopval+"'";
		var fndevice_statuscash2 = "'device_statuscash_two"+loopval+"'";
		var fnrent_status_cash = "'rent_status_cash"+loopval+"'";
		var fnrent_status_cash2 = "'rent_status_cash_two"+loopval+"'";
		
		if(planId != null && planId != '')
		{
			if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				
				if(payment == 'Billed' || payment == 'CashClient')
				{			
					if(planId == 1)
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					
				}
				/*else if(payment == 'CashClient')
				{
					if(planId == 1)
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
					}
					else
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
					}
				}*/
			}
		
		}
		else
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
		}
		
	}
	
}

function BillingPlanEdit(planId,setDivId,setotherDivId,setPayment,accountType,loopval)
{
	//alert(setPayment);
	var newDiv; var otherDiv; var payment; var account;
	
	newDiv = document.getElementById(setDivId);
	otherDiv = document.getElementById(setotherDivId);
	payment = document.getElementById(setPayment).value;
	account = document.getElementById(accountType).value;
	
	//console.log(account);
	
	if(loopval == '')
	{
		var devicePrice = 'TxtDPrice';
		var device_statuscash = 'device_statuscash';
		var device_statuscash2 = 'device_statuscash_two';
		var deviceVat = 'TxtDVat';
		var deviceTotal = 'TxtDTotal';
		var rentPrice = 'TxtDRent';
		var rent_status_cash = 'rent_status_cash';
		var rent_status_cash2 = 'rent_status_cash_two';
		var rentServiceTax = 'TxtDServiceTax';
		var rentTotal = 'TxtDTotalREnt';
		
		var fndevicePrice = "'TxtDPrice'";
		var fndeviceVat = "'TxtDVat'";
		var fndeviceTotal = "'TxtDTotal'";
		var fnrentPrice = "'TxtDRent'";
		var fnrentServiceTax = "'TxtDServiceTax'";
		var fnrentTotal = "'TxtDTotalREnt'";
		
		var fnplan = "'TxtRentPlan'";
		var fnaccountType = "'TxtAccountType'";
		var fnpayment = "'mode_of_payment'";
		var fndemo = 'demo_time';
		
		var fnDevicetype = "'TxtDeviceType'";
		var fndevice_statuscash = "'device_statuscash'";
		var fndevice_statuscash2 = "'device_statuscash_two'";
		var fnrent_status_cash = "'rent_status_cash'";
		var fnrent_status_cash2 = "'rent_status_cash_two'";
		
		if(planId != null && planId != '')
		{
			if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
				
				if(payment == 'Billed' || payment == 'CashClient')
				{			
					if(planId == 1)
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[0]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[0]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[0]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[0]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[0]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[0]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[0]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[0]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[0]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[0]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					
				}
				/*else if(payment == 'CashClient')
				{
					if(planId == 1)
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[0]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
					}
					else
					{
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[0]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
					}
				}*/
			}
		
		}
		else
		{
			newDiv.innerHTML = '';
			otherDiv.innerHTML = '';
		}
	}
	else
	{
		var devicePrice = 'TxtDPrice'+loopval;
		var device_statuscash = 'device_statuscash'+loopval;
		var device_statuscash2 = 'device_statuscash_two'+loopval;
		var deviceVat = 'TxtDVat'+loopval;
		var deviceTotal = 'TxtDTotal'+loopval;
		var rentPrice = 'TxtDRent'+loopval;
		var rent_status_cash = 'rent_status_cash'+loopval;
		var rent_status_cash2 = 'rent_status_cash_two'+loopval;
		var rentServiceTax = 'TxtDServiceTax'+loopval;
		var rentTotal = 'TxtDTotalREnt'+loopval;
		
		var fndevicePrice = "'TxtDPrice"+loopval+"'";
		var fndeviceVat = "'TxtDVat"+loopval+"'";
		var fndeviceTotal = "'TxtDTotal"+loopval+"'";
		var fnrentPrice = "'TxtDRent"+loopval+"'";
		var fnrentServiceTax = "'TxtDServiceTax"+loopval+"'";
		var fnrentTotal = "'TxtDTotalREnt"+loopval+"'";
		
		var fnplan = "'TxtRentPlan"+loopval+"'";
		var fnaccountType = "'TxtAccountType"+loopval+"'";
		var fnpayment = "'mode_of_payment"+loopval+"'";
		var fndemo = 'demo_time'+loopval;
				
		var fnDevicetype = "'TxtDeviceType"+loopval+"'";
		var fndevice_statuscash = "'device_statuscash"+loopval+"'";
		var fndevice_statuscash2 = "'device_statuscash_two"+loopval+"'";
		var fnrent_status_cash = "'rent_status_cash"+loopval+"'";
		var fnrent_status_cash2 = "'rent_status_cash_two"+loopval+"'";
		
		if(loopval == 1)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[1]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[1]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[1]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[1]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[1]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[1]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[1]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[1]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[1]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[1]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[1]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[1]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 2)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[2]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[2]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[2]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[2]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[2]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[2]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[2]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[2]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[2]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[2]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[2]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[2]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 3)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[3]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[3]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[3]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[3]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[3]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[3]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[3]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[3]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[3]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[3]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[3]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[3]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 4)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[4]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[4]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[4]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[4]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[4]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[4]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[4]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[4]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[4]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[4]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[4]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[4]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 5)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[5]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[5]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[5]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[5]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[5]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[5]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[5]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[5]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[5]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[5]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[5]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[5]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 6)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[6]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[6]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[6]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[6]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[6]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[6]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[6]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[6]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[6]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[6]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[6]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[6]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 7)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[7]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[7]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[7]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[7]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[7]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[7]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[7]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[7]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[7]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[7]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[7]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[7]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 8)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[8]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[8]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[8]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[8]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[8]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[8]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[8]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[8]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[8]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[8]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[8]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[8]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		}
		else if(loopval == 9)
		{
			if(planId != null && planId != '')
			{
				if(account == 'Lease'  || account == 'Paid' ||  account == 'POC(Paid Demo)' || account == 'Crack' || account == 'Trip Based')
				{
					newDiv.innerHTML = '';
					otherDiv.innerHTML = '';
					
					if(payment == 'Billed' || payment == 'CashClient')
					{			
						if(planId == 1)
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[9]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[9]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[9]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[9]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[9]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[9]['device_price_vat'];?>" readonly style="width:150px" placeholder="Tax" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[9]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[9]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[9]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[9]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						
					}
					/*else if(payment == 'CashClient')
					{
						if(planId == 1)
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price_total'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[9]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';				
						}
						else
						{
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price_total[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price_total'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceCashView(this.value,'+fndevicePrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[9]['DTotalREnt'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentCashView(this.value,'+fnrentPrice+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /><input type="hidden" name="device_price_vat[]" /><input type="hidden" name="device_price[]" /><input type="hidden" name="rent_service_tax[]" /><input type="hidden" name="rent_Price[]" /><Input type="hidden" Name ="'+device_statuscash+'" value= "" /> <Input type="hidden" Name ="'+rent_status_cash+'" value= ""  /></td></tr>';
						}
					}*/
				}
			
			}
			else
			{
				newDiv.innerHTML = '';
				otherDiv.innerHTML = '';
			}
		
		}
		
	}
	
}
</script>

<SCRIPT language="javascript">
	
	var counter = 1;
	
	function addRow(tableID) 
	{
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
						
		if(rowCount>27){
			alert("Only 10 Model allow");
			return false;
		}
		
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		//console.log('colCount'+colCount2);
		
		var tableRef = document.getElementById(tableID).getElementsByTagName('tbody')[0];
		var colCount2   = tableRef.insertRow(tableRef.rows.length);
		colCount2.id = 'billdetails' + counter;
		var newcell2  = colCount2.insertCell(0);
		
		var colCount3   = tableRef.insertRow(tableRef.rows.length);
		colCount3.id = 'billdetails_other' + counter;
		var newcell3  = colCount3.insertCell(0);
		
		for(var i=0; i<colCount; i++) {

			var newcell	= row.insertCell(i);
			
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//console.log('childnode'+newcell.childNodes[0]);
			//console.log(newcell.childNodes[0].type);
			switch(i) {
				
				case 1:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtDeviceType' + counter ;	
					newcell.childNodes[0].setAttribute("onchange","DeviceSelection(this.value,'model_no"+counter+"','billdetails"+counter+"','billdetails_other"+counter+"','TxtRentPlan"+counter+"','')");					
					break;
				case 2:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'model_no' + counter ;
					newcell.childNodes[0].setAttribute("onchange","ValidateSameModel(this.value,'TxtDeviceType"+counter+"','model_no"+counter+"','TxtAccountType"+counter+"')");
					newcell.childNodes[0].setAttribute('disabled', 'disabled');
					break;
				case 3:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtAccountType' + counter ;
					newcell.childNodes[0].setAttribute("onchange","AccountSelection(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','mode_of_payment"+counter+"','TxtRentPlan"+counter+"','TxtDeviceType"+counter+"','model_no"+counter+"','"+counter+"')");
					break;
				case 4:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'mode_of_payment' + counter ;
					newcell.childNodes[0].setAttribute("onchange","PaymentPlan(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','TxtRentPlan"+counter+"','"+counter+"')");
					newcell.childNodes[0].style.display = 'block';
					break;
				case 5:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtRentPlan' + counter ;
					newcell.childNodes[0].setAttribute("onchange","BillingPlan(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','mode_of_payment"+counter+"','TxtAccountType"+counter+"','"+counter+"')");
					newcell.childNodes[0].style.display = 'block';
					newcell.childNodes[0].setAttribute('disabled', 'disabled');
					break;
			}
			
		}
		
		counter++;
	}
	
	function deleteRow(tableID) {
	  try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			
			if(rowCount <= 3) {
				alert("Cannot delete all the rows.");
				return false;
			}
			if(rowCount > 3) {
				var row = table.rows[rowCount-1];
				table.deleteRow(rowCount-1);
				table.deleteRow(rowCount-2);
				table.deleteRow(rowCount-3);
				rowCount = rowCount-3;
				counter--;
			}
		}
	  catch(e) {
			//alert(e);
		}
	}
	
	/*function deleteRow(tableID) {
	  try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
								
				if(null != chkbox && true == chkbox.checked) {
					if(i == 0) {
						alert("Cannot delete First rows.");
						break;
					}
					if(rowCount <= 3) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i+2);
					table.deleteRow(i+1);
					table.deleteRow(i);
					rowCount-3;
					i--;
					counter--;
					
				}
	
			}
		}
	  catch(e) {
			//alert(e);
		}
	}*/
	
	function addRowEdit(tableID,device_type,account_type,mode_of_payment,rent_month) 
	{
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
						
		if(rowCount>27){
			alert("Only 10 Model allow");
			return false;
		}
		
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		//console.log('colCount'+colCount2);
		
		var tableRef = document.getElementById(tableID).getElementsByTagName('tbody')[0];
		var colCount2   = tableRef.insertRow(tableRef.rows.length);
		colCount2.id = 'billdetails' + counter;
		var newcell2  = colCount2.insertCell(0);
		
		var colCount3   = tableRef.insertRow(tableRef.rows.length);
		colCount3.id = 'billdetails_other' + counter;
		var newcell3  = colCount3.insertCell(0);
		
		for(var i=0; i<colCount; i++) {

			var newcell	= row.insertCell(i);
			
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//console.log('childnode'+newcell.childNodes[0]);
			//console.log(newcell.childNodes[0].type);
			switch(i) {
				
				case 1:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtDeviceType' + counter ;	
					newcell.childNodes[0].setAttribute("onchange","DeviceSelection(this.value,'model_no"+counter+"','billdetails"+counter+"','billdetails_other"+counter+"','mode_of_payment"+counter+"','TxtRentPlan"+counter+"','')");	
					newcell.childNodes[0].value = device_type;				
					break;
				case 2:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'model_no' + counter ;
					newcell.childNodes[0].setAttribute("onchange","ValidateSameModel(this.value,'TxtDeviceType"+counter+"','model_no"+counter+"','TxtAccountType"+counter+"')");
					break;
				case 3:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtAccountType' + counter ;
					newcell.childNodes[0].setAttribute("onchange","AccountSelection(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','mode_of_payment"+counter+"','TxtRentPlan"+counter+"','TxtDeviceType"+counter+"','model_no"+counter+"','"+counter+"')");
					newcell.childNodes[0].value = account_type;
					break;
				case 4:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'mode_of_payment' + counter ;
					newcell.childNodes[0].style.display = 'block';
					newcell.childNodes[0].setAttribute("onchange","PaymentPlan(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','TxtRentPlan"+counter+"','"+counter+"')");
					newcell.childNodes[0].value = mode_of_payment;
					break;
				case 5:
					newcell.childNodes[0].selectedIndex = 0;
					newcell.childNodes[0].id = 'TxtRentPlan' + counter ;
					newcell.childNodes[0].setAttribute("onchange","BillingPlan(this.value,'billdetails"+counter+"','billdetails_other"+counter+"','mode_of_payment"+counter+"','TxtAccountType"+counter+"','"+counter+"')");
					newcell.childNodes[0].style.display = 'block';
					newcell.childNodes[0].value = rent_month;
					break;				
			}
			
		}
		
		counter++;
	}

</SCRIPT>

  <form action="NewAccountCreation.php" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return Check()" autocomplete="off">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr> 
        <!--<td>Date</td>-->
        <td colspan="2"><!--<input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" />-->
          
          <input type="hidden" name="action" id="action" value="<?=$action;?>"/>
          <input type="hidden" name="id" id="id" value="<?=$id;?>"/>
          <input type="hidden" name="account_manager" id="TxtAccManager" value="<?=$_SESSION['user_name'];?>"/></td>
      </tr>
      
      <!--<tr>
            <td>Account Manager</td>
            <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?=$_SESSION['user_name'];?>"/></td>
      </tr>-->
      
      <!--<tr>
        <td>Sales Manager</td>
        <td><select name="sales_manager" id="sales_manager" style="width:150px">
            <option value="" >-- select one --</option>
            <?php
                    /*$sales_manager = select_query("SELECT name FROM internalsoftware.sales_person where active=1 and 
													branch_id='".$_SESSION['BranchId']."' order by name ");
					for($s=0;$s<count($sales_manager);$s++)
                    {*/
                    ?>
            <option name="sales_manager" value="<? //$sales_manager[$s]['name']?>"<? //if($result[0]['sales_manager']==$sales_manager[$s]['name']){?> selected="selected" <? //}?> > <?php //echo $sales_manager[$s]['name']; ?> </option>
            <?php
                    //}
                    ?>
          </select></td>
      </tr>-->
      <tr>
        <td>Collection Manager:<font color="red">* </font></td>
        <td><select name="collection_manager" id="collection_manager" style="width:150px">
            <option value="" >-- select one --</option>
            <?php
				$collection_manager = select_query("SELECT id,name FROM internalsoftware.collection_agent where is_active=1 and 
													branch_id='".$_SESSION['BranchId']."'order by name ");
				for($cl=0;$cl<count($collection_manager);$cl++)
				{
				?>
					<option name="collection_manager" value="<?=$collection_manager[$cl]['id']?>"<? if($result[0]['collection_manager']==$collection_manager[$cl]['id']){?> selected="selected" <? }?> > <?php echo $collection_manager[$cl]['name']; ?> </option>
		<?php
				}
				?>
          </select></td>
      </tr>
      <tr>
        <td>Customer Company Name:<font color="red">* </font></td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>"/></td>
      </tr>
      <tr>
        <td>Potential:<font color="red">* </font></td>
        <td><select name="potential" id="TxtPotentail" style="width:150px">
            <option value="" name="potential" id="TxtPotentail">-- Select One --</option>
            <option value="1-20" <? if($result[0]['potential']=='1-20') {?> selected="selected" <? } ?> >1-20(C)</option>
            <option value="21-30" <? if($result[0]['potential']=='21-30') {?> selected="selected" <? } ?> >21-30(B)</option>
            <option value="31-50" <? if($result[0]['potential']=='31-50') {?> selected="selected" <? } ?> >31-50(A)</option>
            <option value="50+" <? if($result[0]['potential']=='50+') {?> selected="selected" <? } ?> >50+(A+)</option>
          </select></td>
      </tr>
      <tr>
        <td>Type of Organisation</td>
        <td><select name="type_of_org" id="type_of_org" style="width:150px">
            <option value="" name="type_of_org" id="type_of_org">-- Select One --</option>
            <option value="Individual" <? if($result[0]['type_of_org']=='Individual') {?> selected="selected" <? } ?> >Individual</option>
            <option value="Proprietorship" <? if($result[0]['type_of_org']=='Proprietorship') {?> selected="selected" <? } ?> >Proprietorship</option>
            <option value="Partnership firm" <? if($result[0]['type_of_org']=='Partnership firm') {?> selected="selected" <? } ?> >Partnership firm</option>
            <option value="Public " <? if($result[0]['type_of_org']=='Public ') {?> selected="selected" <? } ?> >Public</option>
            <option value="Private limited " <? if($result[0]['type_of_org']=='Private limited') {?> selected="selected" <? } ?> >Private limited</option>
          </select></td>
      </tr>
      <tr>
        <td>Customer PAN No.</td>
        <td><input type="text" name="pan_no" id="pan_no" value="<?=$result[0]['pan_no']?>" /></td>
      </tr>
      <tr>
        <td>Customer GST No.</td>
        <td><input type="text" name="client_gst_no" id="client_gst_no" value="<?=$result[0]['client_gst_no']?>" /></td>
      </tr>
      <!--<tr>
        <td> Copy of Pan Card</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input name="uploaded_file" type="file" /></td>
      </tr>
      <tr>
        <td>Copy of Address Proof</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input name="uploaded_file_add" type="file" /></td>
      </tr>-->
      <tr>
        <td>Contact Person:<font color="red">* </font></td>
        <td><input type="text" name="contact_person" id="TxtContactPerson" value="<?=$result[0]['contact_person']?>" /></td>
      </tr>
      <tr>
        <td>Contact Number:<font color="red">* </font></td>
        <td><input type="value" name="contact_number" id="TxtContactNumber" value="<?=$result[0]['contact_number']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
      </tr>
      <tr>
        <td>Customer Email Id:<font color="red">* </font></td>
        <td><input type="text" name="email_id" id="TxtEmailId" value="<?=$result[0]['email_id']?>" /></td>
      </tr>
      <tr>
        <td>Customer User Name:<font color="red">* </font></td>
        <td><input type="text" name="user_name" id="TxtUserName" value="<?=$result[0]['user_name']?>" 
        	 onchange="ExistUserChk(this.value,'newuser');"  /> <br/><span id="newuser" style="color:#FF0000;font-size:12px;"></span></td>
      </tr>
      <tr>
        <td>Customer Password:<font color="red">* </font></td>
        <td><input type="text" name="user_password" id="TxtUserPass" value="<?=$result[0]['user_password']?>"/></td>
      </tr>
      <tr>
        <td>Billing Name:<font color="red">* </font></td>
        <td><input type="text" name="billing_name" id="TxtBillingName" value="<?=$result[0]['billing_name']?>" /></td>
      </tr>
      <tr>
        <td>Billing Address:<font color="red">* </font></td>
        <td><textarea rows="4" cols="25"  name="billing_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
</textarea></td>
      </tr>
      </table>
      
      <table style="padding-left: 650px;width: 800px;" cellspacing="5" cellpadding="5">
        <tr>
      		<td colspan="2">
              <INPUT type="button" value="Add(+)" class="button" onClick="addRow('dataTable')" />
        
              <INPUT type="button" value="Delete(-)" class="button" onClick="deleteRow('dataTable')" />
          </td>
        </tr>
      </table>
      <table id="dataTable" style="padding-left: 100px;width: 800px;" cellspacing="5" cellpadding="5">
		<tr>
			<td><!--<INPUT type="checkbox" name="chk"/>--></td>
			<td><select name="device_type[]" id="TxtDeviceType" style="width:150px" 
            onChange="DeviceSelection(this.value,'model_no','billdetails','billdetails_other','TxtRentPlan','')" >
                <option value="">-- select Device --</option>
                <?
                $devicetype = select_query("select item_id,item_name,item_date from item_master where status=1 and parent_id=0 ORDER BY item_name");
                for($d=0;$d<count($devicetype);$d++)
                {
                ?>
               <option value="<?=$devicetype[$d]['item_id']?>"<? if($ModelData[0]['device_type']==$devicetype[$d]['item_id']){?> selected="selected"<? }?>>
                <?=$devicetype[$d]['item_name']?>
                </option>
                <? } ?>
                
              </select>
            </td>
			<td><select name="model_no[]" id="model_no" style="width:150px" disabled 
            onchange="ValidateSameModel(this.value,'TxtDeviceType','model_no','TxtAccountType');"> 
            		<option value="">-- select Model --</option>
            	</select>
            </td>
            <td><select name="account_type[]" id="TxtAccountType" style="width:150px" 
       onchange="AccountSelection(this.value,'billdetails','billdetails_other','mode_of_payment','TxtRentPlan','TxtDeviceType','model_no','')">
                <option value="">-- select Account --</option>
                <option value="Lease" <? if($ModelData[0]['account_type']=='Lease') {?> selected="selected" <? } ?>>Lease</option>
                <option value="Paid" <? if($ModelData[0]['account_type']=='Paid') {?> selected="selected" <? } ?>>Paid</option>
                <option value="Demo" <? if($ModelData[0]['account_type']=='Demo') {?> selected="selected" <? } ?>>Demo</option>
                <option value="Foc" <? if($ModelData[0]['account_type']=='Foc') {?> selected="selected" <? } ?>>FOC</option>
                 <option value="POC(Paid Demo)" <? if($ModelData[0]['account_type']=='POC(Paid Demo)') {?> selected="selected" <? } ?>>POC(Paid Demo)</option>
                <option value="Crack" <? if($ModelData[0]['account_type']=='Crack') {?> selected="selected" <? } ?>>Crack</option>
                <option value="Trip Based" <? if($ModelData[0]['account_type']=='Trip Based') {?> selected="selected" <? } ?>> Trip Based</option>
                <option value="InternalTesting" <? if($ModelData[0]['account_type']=='InternalTesting') {?> selected="selected" <? } ?>>Internal Testing</option>
              </select>
            </td>
            <td><select name="mode_of_payment[]" id="mode_of_payment" style="width:150px" 
            onChange="PaymentPlan(this.value,'billdetails','billdetails_other','TxtRentPlan','')">
                <option value="" >-- select Payment --</option>
                <option value="CashClient"<? if($ModelData[0]['mode_of_payment']=='CashClient'){?> selected="selected"<? }?>>Cash Client</option>
                <option value="Billed" <? if($ModelData[0]['mode_of_payment']=='Billed') {?> selected="selected" <? } ?>> Billed</option>
              </select>		
            </td>
            <?php if($action=='edit') {?>
            <td><select name="rent_month[]" id="TxtRentPlan"
            	onChange="BillingPlan(this.value,'billdetails','billdetails_other','mode_of_payment','TxtAccountType','')">
                  <option value="">-- Select Plan --</option>
                  <option value="1" <? if($ModelData[0]['rent_month']=='1') {?> selected="selected" <? } ?>>Monthly</option>
                  <option value="3" <? if($ModelData[0]['rent_month']=='3') {?> selected="selected" <? } ?>>Quarterly</option>
                  <option value="6" <? if($ModelData[0]['rent_month']=='6') {?> selected="selected" <? } ?>>HalfYearly</option>
                  <option value="12" <? if($ModelData[0]['rent_month']=='12') {?> selected="selected" <? } ?>>Yearly</option>
                </select>
            </td>  
             <?php }else{ ?>  
             <td><select name="rent_month[]" id="TxtRentPlan" disabled
            	onChange="BillingPlan(this.value,'billdetails','billdetails_other','mode_of_payment','TxtAccountType','')">
                  <option value="">-- Select Plan --</option>
                  <option value="1" <? if($ModelData[0]['rent_month']=='1') {?> selected="selected" <? } ?>>Monthly</option>
                  <option value="3" <? if($ModelData[0]['rent_month']=='3') {?> selected="selected" <? } ?>>Quarterly</option>
                  <option value="6" <? if($ModelData[0]['rent_month']=='6') {?> selected="selected" <? } ?>>HalfYearly</option>
                  <option value="12" <? if($ModelData[0]['rent_month']=='12') {?> selected="selected" <? } ?>>Yearly</option>
                </select>
            </td>
             <?php } ?>       
		</tr>
        <tr id="billdetails"><td></td></tr>
        <tr id="billdetails_other"><td></td></tr>
        
	</table>

      
      <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <!--<tr>
        <td><h1>Device Rate</h1></td>
      </tr>>-->
      
      <tr>
        <td><label for="dimts" id="dimts">Dimts</label></td>
        <td><select name="dimts" id="dimts" onchange="DimtsPayment(this.value)" style="width:150px">
            <option value="" id="dimts">-- select one --</option>
            <option value="Yes" <? if($result[0]['dimts']=='Yes') {?> selected="selected" <? } ?> id="dimts">Yes</option>
            <option value="No" <? if($result[0]['dimts']=='No') {?> selected="selected" <? } ?> id="dimts">No</option>
          </select></td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:40px">
          <table id="DimtsCase"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
              <td><label for="dimts_fee" id="dimts_fee">Dimts Fee status </label></td>
              <td><Input type = 'Radio' Name ='dimts_fee' id="dimts_fee" value= 'Excluding'
                    <?php if($result[0]['dimts_fee']=="Excluding"){echo "checked=\"checked\""; }?>/>
                Excluding
                <Input type = 'Radio' Name ='dimts_fee' value= 'Including'
                    <?php if($result[0]['dimts_fee']=="Including"){echo "checked=\"checked\""; }?>/>
                Including </td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><label for="Vehicle_Type" id="lblVehicleType">Vehicle Type:<font color="red">* </font></label></td>
        <td><select name="vehicle_type" id="TxtVehicleType" style="width:150px">
            <option value="">--Select Vehicle--</option>
			<?
			$veh_query = select_query("select * from veh_type");
			//while($veh_data=mysql_fetch_array($veh_query)) 
			for($i=0;$i<count($veh_query);$i++)
			{
			?>
            <option value="<?=$veh_query[$i]['veh_type']?>" <? if($result[0]['vehicle_type']==$veh_query[$i]['veh_type']) {?> selected="selected" <? } ?> >
            <?=$veh_query[$i]['veh_type']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
      
      <tr>
        <td><label for="Imobillizer" id="lblImmobilizer">Immobilizer </label></td>
        <td><Input type = 'Radio' Name ='immobilizer' id="TxtImmobilizer" value= 'Yes'
        <?php if($result[0]['immobilizer']=="Yes"){echo "checked=\"checked\""; }?>/>
          Yes
          <Input type = 'Radio' Name ='immobilizer' value= 'No'
        <?php if($result[0]['immobilizer']=="No"){echo "checked=\"checked\""; }?>/>
          No </td>
      </tr>
      <tr>
        <td><label for="AC" id="lblACStatus">AC </label></td>
        <td>
          <Input type = 'Radio' Name ='ac_on_off'  id="TxtACStatus" value= 'on' <?php if($result[0]['ac_on_off']=="on"){echo "checked=\"checked\""; }?>/>
          Yes
          <Input type = 'Radio' Name ='ac_on_off' id="TxtACStatus"  value= 'off' <?php if($result[0]['ac_on_off']=="off"){echo "checked=\"checked\""; }?>/>
          No </td>
      </tr>
      
      <tr>
        <td><label for="Vehicle_Warranty" id="lblVehicleWarranty">Device Warranty:<font color="red">* </font></label></td>
        <td><select name="vehicle_warranty" id="TxtVehicleWarranty" style="width:150px">
            <option value="">Select Warranty Period</option>
            <option value="1" <? if($result[0]['vehicle_warranty']=='1') {?> selected="selected" <? } ?> >1 Year</option>
            <option value="2" <? if($result[0]['vehicle_warranty']=='2') {?> selected="selected" <? } ?> >2 Year</option>
            <option value="3" <? if($result[0]['vehicle_warranty']=='3') {?> selected="selected" <? } ?> >3 Year</option>
            <!--<option value="4" <? if($result[0]['vehicle_warranty']=='4') {?> selected="selected" <? } ?> >4 Year</option>
            <option value="5" <? if($result[0]['vehicle_warranty']=='5') {?> selected="selected" <? } ?> >5 Year</option>-->
          </select></td>
      </tr>
      
      <tr>
        <td><label for="State" id="lblState">State:<font color="red">* </font></label></td>
        <td><select name="State" id="TxtState" style="width:150px">
                <option value="">--Select State--</option>
                <option value="Andaman and Nicobar Islands" <? if($result[0]['client_state']=='Andaman and Nicobar Islands') {?> selected="selected" <? } ?>>Andaman and Nicobar Islands</option>
                <option value="Andhra Pradesh" <? if($result[0]['client_state']=='Andhra Pradesh') {?> selected="selected" <? } ?>>Andhra Pradesh</option>
                <option value="Arunachal Pradesh" <? if($result[0]['client_state']=='Arunachal Pradesh') {?> selected="selected" <? } ?>>Arunachal Pradesh</option>
                <option value="Assam" <? if($result[0]['client_state']=='Assam') {?> selected="selected" <? } ?>>Assam</option>
                <option value="Bihar" <? if($result[0]['client_state']=='Bihar') {?> selected="selected" <? } ?>>Bihar</option>
                <option value="Chandigarh" <? if($result[0]['client_state']=='Chandigarh') {?> selected="selected" <? } ?>>Chandigarh</option>
                <option value="Chhattisgarh" <? if($result[0]['client_state']=='Chhattisgarh') {?> selected="selected" <? } ?>>Chhattisgarh</option>
                <option value="Dadra and Nagar Haveli" <? if($result[0]['client_state']=='Dadra and Nagar Haveli') {?> selected="selected" <? } ?> >Dadra and Nagar Haveli</option>
                <option value="Daman and Diu" <? if($result[0]['client_state']=='Daman and Diu') {?> selected="selected" <? } ?>>Daman and Diu</option>
                <option value="Delhi" <? if($result[0]['client_state']=='Delhi') {?> selected="selected" <? } ?>>Delhi</option>
                <option value="Goa" <? if($result[0]['client_state']=='Goa') {?> selected="selected" <? } ?>>Goa</option>
                <option value="Gujarat" <? if($result[0]['client_state']=='Gujarat') {?> selected="selected" <? } ?>>Gujarat</option>
                <option value="Haryana" <? if($result[0]['client_state']=='Haryana') {?> selected="selected" <? } ?>>Haryana</option>
                <option value="Himachal Pradesh" <? if($result[0]['client_state']=='Himachal Pradesh') {?> selected="selected" <? } ?>>Himachal Pradesh</option>
                <option value="Jammu and Kashmir" <? if($result[0]['client_state']=='Jammu and Kashmir') {?> selected="selected" <? } ?>>Jammu and Kashmir</option>
                <option value="Jharkhand" <? if($result[0]['client_state']=='Jharkhand') {?> selected="selected" <? } ?>>Jharkhand</option>
                <option value="Karnataka" <? if($result[0]['client_state']=='Karnataka') {?> selected="selected" <? } ?>>Karnataka</option>
                <option value="Kerala" <? if($result[0]['client_state']=='Kerala') {?> selected="selected" <? } ?>>Kerala</option>
                <option value="Lakshadweep" <? if($result[0]['client_state']=='Lakshadweep') {?> selected="selected" <? } ?>>Lakshadweep</option>
                <option value="Madhya Pradesh" <? if($result[0]['client_state']=='Madhya Pradesh') {?> selected="selected" <? } ?>>Madhya Pradesh</option>
                <option value="Maharashtra" <? if($result[0]['client_state']=='Maharashtra') {?> selected="selected" <? } ?>>Maharashtra</option>
                <option value="Manipur" <? if($result[0]['client_state']=='Manipur') {?> selected="selected" <? } ?>>Manipur</option>
                <option value="Meghalaya" <? if($result[0]['client_state']=='Meghalaya') {?> selected="selected" <? } ?>>Meghalaya</option>
                <option value="Mizoram" <? if($result[0]['client_state']=='Mizoram') {?> selected="selected" <? } ?>>Mizoram</option>
                <option value="Nagaland" <? if($result[0]['client_state']=='Nagaland') {?> selected="selected" <? } ?>>Nagaland</option>
                <option value="Odisha" <? if($result[0]['client_state']=='Odisha') {?> selected="selected" <? } ?>>Odisha</option>
                <option value="Puducherry" <? if($result[0]['client_state']=='Puducherry') {?> selected="selected" <? } ?>>Puducherry</option>
                <option value="Punjab" <? if($result[0]['client_state']=='Punjab') {?> selected="selected" <? } ?>>Punjab</option>
                <option value="Rajasthan" <? if($result[0]['client_state']=='Rajasthan') {?> selected="selected" <? } ?>>Rajasthan</option>
                <option value="Sikkim" <? if($result[0]['client_state']=='Sikkim') {?> selected="selected" <? } ?>>Sikkim</option>
                <option value="Tamil Nadu" <? if($result[0]['client_state']=='Tamil Nadu') {?> selected="selected" <? } ?>>Tamil Nadu</option>
                <option value="Telangana" <? if($result[0]['client_state']=='Telangana') {?> selected="selected" <? } ?>>Telangana</option>
                <option value="Tripura" <? if($result[0]['client_state']=='Tripura') {?> selected="selected" <? } ?>>Tripura</option>
                <option value="Uttar Pradesh" <? if($result[0]['client_state']=='Uttar Pradesh') {?> selected="selected" <? } ?>>Uttar Pradesh</option>
                <option value="Uttarakhand" <? if($result[0]['client_state']=='Uttarakhand') {?> selected="selected" <? } ?>>Uttarakhand</option>
                <option value="West Bengal" <? if($result[0]['client_state']=='West Bengal') {?> selected="selected" <? } ?>>West Bengal</option>
          </select></td>
      </tr>
      
      <tr>
        <td>Accessories:<font color="red">* </font></td>
        <td><input type='radio' Name ='access_radio' id='acc' value= 'yes' onchange="showAccess(this.value);" <?php if($result[0]['acess_selection']=="yes"){echo "checked=\"checked\""; }?>> Yes
          <input type='radio' Name ='access_radio' id='acc' value= 'no'  onchange="showAccess(this.value);" <?php if($result[0]['acess_selection']=="no"){echo "checked=\"checked\""; }?>> No
        </td>
    </tr>

      <tr>
        <td colspan="2">
          <table  id="accessTable"  align="left" style="overflow: auto;display:none;margin-left:115px" cellspacing="2" cellpadding="2">
          <td> <input type="checkbox" name="acess_all[]" id="acess_all" onClick="selectAllAccessory(this)" /> Select All</td>
          <?
            $accessory_data = select_query("SELECT id,items AS `access_name` FROM toolkit_access ORDER BY `access_name` asc");
			$acc_veh=array();
            $tools=array();	
			
			  for($v=0;$v<count($accessory_data);$v++)
			  {
				$acc_id[]=$accessory_data[$v]['id'];
				$acc_name[]=$accessory_data[$v]['access_name'];
				$tools[]=$toolk[$v];
			  }
			
			  for($u=0;$u<count($acc_id);$u++)
      {

          if(in_array($acc_id[$u],$tools))
            {

          ?>
              <tr>
                <td><input type="checkbox" name="accessories[]" id="accessories" class="checkbox1" value="<?php echo $acc_id[$u];?>" checked>
                <?=$acc_name[$u]?>
                </td>
              </tr>
            <?php
             }
             else
             {
            ?>  <tr>

                <td><input type="checkbox" name="accessories[]" id="accessories" class="checkbox1" value="<?php echo $acc_id[$u];   ?>">
                <?=$acc_name[$u]?></td>
              </tr>
              <?php
            }
      }?>

          </table>
        </td>
      </tr>
      
      <!--<tr>
        <td class="style2"> Comment</td>
        <td><textarea rows="3" cols="25"  type="text" name="new_acc_salescomment" id="TxtNewSalesComment" ><?=$result[0]['new_acc_salescomment']?>
</textarea></td>
      </tr>-->
      <?php
        //if($action=='edit') {
        ?>
      <!--<tr>
            <td class="style2">
                Back Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><?=$result[0]['sales_comment']?></textarea>
                </td>
        </tr>-->
      <?php //} ?>
      <tr>
        <td></td>
        <td class="submit"><input id="button1" type="submit" name="submit" value="submit" runat="server" />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'accountcreation.php'" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); 

if($action=='edit' or $action=='editp'){
	
	for($nm=1;$nm<$modelcount;$nm++)
	{
?>
	<script>addRowEdit('dataTable','<?=$ModelData[$nm]['device_type'];?>','<?=$ModelData[$nm]['account_type'];?>','<?=$ModelData[$nm]['mode_of_payment'];?>','<?=$ModelData[$nm]['rent_month'];?>');</script>
<?php
	}
	
	for($gm=0;$gm<$modelcount;$gm++)
	{
	  if($gm==0){ ?>
	
	<script>DeviceSelectionEdit(<?=$ModelData[$gm]['device_type'];?>,'model_no','<?=$ModelData[$gm]['device_model'];?>');</script>
	<script>AccountSelectionEdit('<?=$ModelData[$gm]['account_type'];?>','billdetails','billdetails_other','mode_of_payment','TxtRentPlan','TxtDeviceType','model_no','');</script>	
    <script>BillingPlanEdit('<?=$ModelData[$gm]['rent_month'];?>','billdetails','billdetails_other','mode_of_payment','TxtAccountType','');</script>
	
	<?php }else{ ?>
	
	<script>DeviceSelectionEdit(<?=$ModelData[$gm]['device_type'];?>,'model_no<?=$gm;?>','<?=$ModelData[$gm]['device_model'];?>');</script>	  
	<script>AccountSelectionEdit('<?=$ModelData[$gm]['account_type'];?>','billdetails<?=$gm;?>','billdetails_other<?=$gm;?>','mode_of_payment<?=$gm;?>','TxtRentPlan<?=$gm;?>','TxtDeviceType<?=$gm;?>','model_no<?=$gm;?>','<?=$gm;?>');</script>
    <script>BillingPlanEdit('<?=$ModelData[$gm]['rent_month'];?>','billdetails<?=$gm;?>','billdetails_other<?=$gm;?>','mode_of_payment<?=$gm;?>','TxtAccountType<?=$gm;?>','<?=$gm;?>');</script>
	
	<?php } ?>
     
	 
<?php 
	}
?>
	<script>showAccess("<?=$result[0]['acess_selection'];?>");</script>
<?php 	
}
?>