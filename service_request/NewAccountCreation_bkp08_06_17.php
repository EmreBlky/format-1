<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
$action = $_GET['action'];
$id = $_GET['id'];
$page = $_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $result = select_query("select * from new_account_creation where id=$id");   
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
	$sales_manager = $_POST["sales_manager"];
	$collection_manager = $_POST["collection_manager"];
    $company = (isset($_POST["company"])) ? trim($_POST["company"]): "";    
    $potential = (isset($_POST["potential"])) ? trim($_POST["potential"]): "";
	$type_of_org = (isset($_POST["type_of_org"])) ? trim($_POST["type_of_org"]): "";
	$pan_no = (isset($_POST["pan_no"])) ? trim($_POST["pan_no"]): "";
	
    $contact_person = (isset($_POST["contact_person"])) ? trim($_POST["contact_person"]): "";
    $contact_number = (isset($_POST["contact_number"])) ? trim($_POST["contact_number"]): "";
    $billing_name = (isset($_POST["billing_name"])) ? trim($_POST["billing_name"]): "";
    $billing_address = (isset($_POST["billing_address"])) ? trim($_POST["billing_address"]): "";
	
	$device_type = (isset($_POST["device_type"])) ? trim($_POST["device_type"]): "";
	$modelno = (isset($_POST["modelno"])) ? trim($_POST["modelno"]): "";
	
	$account_type = (isset($_POST["account_type"])) ? trim($_POST["account_type"]): "";
    $mode_of_payment = (isset($_POST["mode_of_payment"])) ? trim($_POST["mode_of_payment"]): "";
    	
    //device_price, device_price_vat,device_price_total,device_rent_Price,device_rent_service_tax,TxtDTotalREnt
   
    if($mode_of_payment=="CashClient")
    {
        $device_price_total = (isset($_POST["device_price_totalcash"])) ? trim($_POST["device_price_totalcash"]): 0;
        $TxtDTotalREnt = (isset($_POST["TxtDTotalREntcash"])) ? trim($_POST["TxtDTotalREntcash"]): 0;
        $rent_month = (isset($_POST["rent_monthcash"])) ? trim($_POST["rent_monthcash"]): "";
   		$rent_status = (isset($_POST["rent_statuscash"])) ? trim($_POST["rent_statuscash"]): "";
    }
    elseif($mode_of_payment=="Billed")
    {
        $device_price = (isset($_POST["device_price"])) ? trim($_POST["device_price"]): 0;
        $device_price_vat = (isset($_POST["device_price_vat"])) ? trim($_POST["device_price_vat"]): 0;
        $device_price_total = (isset($_POST["device_price_total"])) ? trim($_POST["device_price_total"]): 0;
        $device_rent_Price = (isset($_POST["device_rent_Price"])) ? trim($_POST["device_rent_Price"]): 0;
        $device_rent_service_tax = (isset($_POST["device_rent_service_tax"])) ? trim($_POST["device_rent_service_tax"]): 0;
        $TxtDTotalREnt = (isset($_POST["TxtDTotalREnt"])) ? trim($_POST["TxtDTotalREnt"]): 0;
        $rent_month = (isset($_POST["rent_month"])) ? trim($_POST["rent_month"]): "";
		$rent_status = (isset($_POST["rent_status"])) ? trim($_POST["rent_status"]): "";
    }
    
	if($account_type=="Demo")
    { $demo = (isset($_POST["demo_time"])) ? trim($_POST["demo_time"]): 0; } else { $demo = ''; }
	
    if($account_type=="Foc")
    { $foc_reason = (isset($_POST["foc_reason"])) ? trim($_POST["foc_reason"]): 0; } else { $foc_reason = ''; }
	
	if($account_type=="InternalTesting")
    { $testing_time = (isset($_POST["testing_time"])) ? trim($_POST["testing_time"]): 0; } else { $testing_time = '';}
    
    $dimts = (isset($_POST["dimts"])) ? trim($_POST["dimts"]): "";
    $dimts_fee = (isset($_POST["dimts_fee"])) ? trim($_POST["dimts_fee"]): "";
    $vehicle_type = (isset($_POST["vehicle_type"])) ? trim($_POST["vehicle_type"]): "";
    //$account_type = (isset($_POST["account_type"])) ? trim($_POST["account_type"]): "";
    $immobilizer = (isset($_POST["immobilizer"])) ? trim($_POST["immobilizer"]): "";
    $ac_on_off = (isset($_POST["ac_on_off"])) ? trim($_POST["ac_on_off"]): "";
    $email_id = (isset($_POST["email_id"])) ? trim($_POST["email_id"]): "";
    $user_name = (isset($_POST["user_name"])) ? trim($_POST["user_name"]): "";
    $user_password = (isset($_POST["user_password"])) ? trim($_POST["user_password"]): "";
    //$service_comment = (isset($_POST["service_comment"])) ? trim($_POST["service_comment"]): "";
    $new_acc_salescomment = (isset($_POST["new_acc_salescomment"])) ? trim($_POST["new_acc_salescomment"]): ""; 
 
  	if($sales_manager=="") {
    	$sales_manager_edit = $result[0]['sales_manager'];
    } else {
   	 $sales_manager_edit = $sales_manager;
    }
     

	if($action=='edit')
	{
	
		$query="update new_account_creation set sales_manager='".$sales_manager_edit."', company='".$company."', potential='".$potential."', 
				type_of_org='".$type_of_org."', pan_no='".$pan_no."', contact_person='".$contact_person."', contact_number='".$contact_number."', 
				billing_name='".$billing_name."', billing_address='".$billing_address."', account_type='".$account_type."',
				mode_of_payment='".$mode_of_payment."', device_price='".$device_price."', device_price_vat='".$device_price_vat."', 
				device_price_total='".$device_price_total."', device_rent_Price='".$device_rent_Price."', 
				device_rent_service_tax='".$device_rent_service_tax."', DTotalREnt='".$TxtDTotalREnt."', rent_month='".$rent_month."',  
				rent_status='".$rent_status."', demo_time='".$demo."', foc_reason='".$foc_reason."', testing_time='".$testing_time."',
				dimts='".$dimts."', dimts_fee='".$dimts_fee."', vehicle_type='".$vehicle_type."', immobilizer='".$immobilizer."', 
				ac_on_off='".$ac_on_off."',  email_id='".$email_id."', user_name='".$user_name."', user_password='".$user_password."', 
				new_acc_salescomment='".$new_acc_salescomment."', collection_manager='".$collection_manager."',device_type='".$device_type."',
				device_model='".$modelno."'  where id=$id";
		
		select_query($query);
		
		
		echo "<script>document.location.href ='addmodel.php?for=formatrequest'</script>";
	}
	else
	{
		$query = "insert into new_account_creation(date, account_manager, sales_manager, collection_manager, company, potential, type_of_org, 
				pan_no, contact_person, contact_number, billing_name, billing_address, device_type, device_model, account_type, mode_of_payment, 				
				device_price,device_price_vat, device_price_total,device_rent_Price,device_rent_service_tax,DTotalREnt, rent_month,rent_status, 
				demo_time, foc_reason, testing_time, dimts, dimts_fee, vehicle_type, immobilizer, ac_on_off, email_id, user_name ,user_password, 
				new_acc_salescomment, branch_id) values('".$date."','".$account_manager."','".$sales_manager."','".$collection_manager."',
				'".$company."','".$potential."','".$type_of_org."','".$pan_no."','".$contact_person."','".$contact_number."',
				'".$billing_name."','".$billing_address."','".$device_type."','".$modelno."','".$account_type."','".$mode_of_payment."',
				'".$device_price."', '".$device_price_vat."','".$device_price_total."','".$device_rent_Price."','".$device_rent_service_tax."',
				'".$TxtDTotalREnt."','".$rent_month."','".$rent_status."','".$demo."','".$foc_reason."','".$testing_time."','".$dimts."',
				'".$dimts_fee."','".$vehicle_type."','".$immobilizer."','".$ac_on_off."','".$email_id."','".$user_name."','".$user_password."',
				'".$new_acc_salescomment."','".$_SESSION['BranchId']."')";
		
		select_query($query);
		
		
		echo "<script>document.location.href ='addmodel.php'</script>";
	
	}

}

?>
<script type="text/javascript">

function Check()
{
  if(document.myForm.sales_manager.value=="")
  {
      alert("Please Select Sales Manager") ;
      document.myForm.sales_manager.focus();
      return false;
  }
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
  
  if(document.myForm.TxtDeviceType.value=="")
  {
      alert("Please Choose Device Type") ;
      document.myForm.TxtDeviceType.focus();
      return false;
  }
  if(document.myForm.TxtDeviceType.value!="")
  {
      if(document.myForm.modelno.value=="")
	  {
		  alert("Please Choose Model No") ;
		  document.myForm.modelno.focus();
		  return false;
	  }
  }
  
  if(document.myForm.TxtAccountType.value=="")
  {
      alert("Please Choose Account Type") ;
      document.myForm.TxtAccountType.focus();
      return false;
  } 
  
  var AccountType=document.myForm.TxtAccountType.value;
  if(AccountType=="Lease" || AccountType=="Paid" || AccountType=="Crack" || AccountType=="Trip Based")
  {
	  if(document.myForm.mode_of_payment.value=="")
	  {
		  alert("Please Choose Mode of Payment.") ;
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
		  if(document.myForm.TxtRentPlancash.value=="")
		  {
			  alert("Please Enter Rent Plan") ;
			  document.myForm.TxtRentPlancash.focus();
			  return false;
		  }
		  
		  var rent_chked = document.myForm.rent_status_cash[0].checked;
          var rent_chked1 = document.myForm.rent_status_cash[1].checked;
          if(rent_chked  == false && rent_chked1  == false)
          {
			   alert("please Select Excluding/Including");
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
		if(document.myForm.TxtRentPlan.value=="")
		{
			alert("Please Enter Rent Plan") ;
			document.myForm.TxtRentPlan.focus();
			return false;
		}  
		
		var rent_chked = document.myForm.rent_status[0].checked;
		var rent_chked1 = document.myForm.rent_status[1].checked;
		if(rent_chked  == false && rent_chked1  == false)
		{
		    alert("please Select Excluding/Including");
		    return false;
		}
	}
	  
  }
  
  if(AccountType=="Demo")
  {
	  if(document.myForm.mode_of_payment.value=="")
	  {
		  alert("Please Choose Mode of Payment.") ;
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
		  if(document.myForm.TxtRentPlancash.value=="")
		  {
			  alert("Please Enter Rent Plan") ;
			  document.myForm.TxtRentPlancash.focus();
			  return false;
		  }
		  
		  var rent_chked = document.myForm.rent_status_cash[0].checked;
          var rent_chked1 = document.myForm.rent_status_cash[1].checked;
          if(rent_chked  == false && rent_chked1  == false)
          {
			   alert("please Select Excluding/Including");
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
		if(document.myForm.TxtRentPlan.value=="")
		{
			alert("Please Enter Rent Plan") ;
			document.myForm.TxtRentPlan.focus();
			return false;
		} 
		
		var rent_chked = document.myForm.rent_status[0].checked;
		var rent_chked1 = document.myForm.rent_status[1].checked;
		if(rent_chked  == false && rent_chked1  == false)
		{
		    alert("please Select Excluding/Including");
		    return false;
		} 
	}
	
	if(document.myForm.demo_time.value=="")
	{
		  alert("Please Choose Demo Time.") ;
		  document.myForm.demo_time.focus();
		  return false;
	}
  }
  
   if(AccountType=="Foc")
    {
      if(document.myForm.foc_reason.value=="")
      {
          alert("Please Enter FOC Reason.") ;
          document.myForm.foc_reason.focus();
          return false;
      }
    }
	
	if(AccountType=="InternalTesting")
    {
      if(document.myForm.testing_time.value=="")
      {
          alert("Please Choose Testing Time") ;
          document.myForm.testing_time.focus();
          return false;
      }
    }
	   
    if(document.myForm.TxtVehicleType.value=="")
    {
        alert("Please Enter Vehicle type") ;
        document.myForm.TxtVehicleType.focus();
        return false;
    }
    if(document.myForm.TxtEmailId.value=="")
    {
        alert("Please Enter E-mail ID") ;
        document.myForm.TxtEmailId.focus();
        return false;
    }
    if(document.myForm.TxtUserName.value=="")
    {
        alert("Please Enter Username") ;
        document.myForm.TxtUserName.focus();
        return false;
    }
    if(document.myForm.TxtUserPass.value=="")
    {
        alert("Please Enter Password") ;
        document.myForm.TxtUserPass.focus();
        return false;
    }
   
}


function AccountSelection(Value)
{
    //alert(Value);
	if(Value=="Lease" || Value=="Paid" || Value=="Crack" || Value=="Trip Based")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
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
		document.getElementById('Billed_id').style.display = "block";
		document.getElementById('demo_id').style.display = "block";
        document.getElementById('foc_id').style.display = "none";
		/*document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";*/
		document.getElementById('testing_id').style.display = "none";
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
	else if(Value=="Foc")
    {
        document.getElementById('foc_id').style.display = "block";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
    }
	
	else if(Value=="InternalTesting")
    {
        document.getElementById('testing_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }   
    else  
    {
        document.getElementById('Billed_id').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
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


function AccountSelectionEdit(Value,mode)
{
    //alert(mode);
	//if(Value=="Lease")
	if(Value=="Lease" || Value=="Paid" || Value=="Crack" || Value=="Trip Based")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
		
		if(mode == 'CashClient')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Billed' || mode == 'Cheque')
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
		document.getElementById('Billed_id').style.display = "block";
		document.getElementById('demo_id').style.display = "block";
        document.getElementById('foc_id').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
		
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
	else if(Value=="Foc")
    {
        document.getElementById('foc_id').style.display = "block";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
    }
	else if(Value=="InternalTesting")
    {
        document.getElementById('testing_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }   
    else  
    {
        document.getElementById('Billed_id').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		document.getElementById('testing_id').style.display = "none";
    }
}

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

function calculatetotal(price)
{
    var vatp = 5;
   
    document.getElementById('TxtDVat').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotal').value=parseInt(price)+parseInt(document.getElementById('TxtDVat').value);
    //alert(result);
}

function calculaterent(price)
{
    var vatp = 15;
   
    document.getElementById('TxtDServiceTax').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotalREnt').value=parseInt(price)+parseInt(document.getElementById('TxtDServiceTax').value);
    //alert(result);

}

function DeviceSelection(deviceId,setDivId,modelName)
{
	//alert(modelName);
    $.ajax({
		type:"GET",
		url:"userInfo.php?action=getmodel",
		data:"user_id="+deviceId+"&model="+modelName,
		success:function(msg){
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}
 
</script>

  <form action="NewAccountCreation.php" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return Check()" autocomplete="off">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr> 
        <!--<td>Date</td>-->
        <td colspan="2"><!--<input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" />-->
          
          <input type="hidden" name="action" id="action" value="<?=$action;?>"/>
          <input type="hidden" name="id" id="id" value="<?=$id;?>"/></td>
      </tr>
      
      <!--<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
        </tr>-->
      
      <tr>
        <td>Sales Manager</td>
        <td><select name="sales_manager" id="sales_manager" style="width:150px">
            <option value="" >-- select one --</option>
            <?php
                    $sales_manager = select_query("SELECT name FROM internalsoftware.sales_person where active=1 and 
													branch_id='".$_SESSION['BranchId']."' order by name ");
					for($s=0;$s<count($sales_manager);$s++)
                    {
                    ?>
            <option name="sales_manager" value="<?=$sales_manager[$s]['name']?>"<? if($result[0]['sales_manager']==$sales_manager[$s]['name']){?> selected="selected" <? }?> > <?php echo $sales_manager[$s]['name']; ?> </option>
            <?php
                    }
                    ?>
          </select></td>
      </tr>
      <tr>
        <td>Collection Manager</td>
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
        <td>Company Name</td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>"/></td>
      </tr>
      <tr>
        <td>Potential</td>
        <td><select name="potential" id="TxtPotentail" style="width:150px">
            <option value="" name="potential" id="TxtPotentail">-- Select One --</option>
            <option value="1-10" <? if($result[0]['potential']=='1-10') {?> selected="selected" <? } ?> >1-10</option>
            <option value="10-20" <? if($result[0]['potential']=='10-20') {?> selected="selected" <? } ?> >10-20</option>
            <option value="20-30" <? if($result[0]['potential']=='20-30') {?> selected="selected" <? } ?> >20-30</option>
            <option value="30-40" <? if($result[0]['potential']=='30-40') {?> selected="selected" <? } ?> >30-40</option>
            <option value="40-50" <? if($result[0]['potential']=='40-50') {?> selected="selected" <? } ?> >40-50</option>
            <option value="50-60" <? if($result[0]['potential']=='50-60') {?> selected="selected" <? } ?> >50-60</option>
            <option value="60-70" <? if($result[0]['potential']=='60-70') {?> selected="selected" <? } ?> >60-70</option>
            <option value="70-80" <? if($result[0]['potential']=='70-80') {?> selected="selected" <? } ?> >70-80</option>
            <option value="80-90" <? if($result[0]['potential']=='80-90') {?> selected="selected" <? } ?> >80-90</option>
            <option value="90-100" <? if($result[0]['potential']=='90-100') {?> selected="selected" <? } ?> >90-100</option>
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
        <td>PAN No.</td>
        <td><input type="text" name="pan_no" id="pan_no" value="<?=$result[0]['pan_no']?>" /></td>
      </tr>
      <tr>
        <td> Copy of Pan Card</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input name="uploaded_file" type="file" /></td>
      </tr>
      <tr>
        <td>Copy of Address Proof</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input name="uploaded_file_add" type="file" /></td>
      </tr>
      <tr>
        <td>Contact Person</td>
        <td><input type="text" name="contact_person" id="TxtContactPerson" value="<?=$result[0]['contact_person']?>" /></td>
      </tr>
      <tr>
        <td>Contact Number</td>
        <td><input type="value" name="contact_number" id="TxtContactNumber" value="<?=$result[0]['contact_number']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
      </tr>
      <tr>
        <td>Billing Name</td>
        <td><input type="text" name="billing_name" id="TxtBillingName" value="<?=$result[0]['billing_name']?>" /></td>
      </tr>
      <tr>
        <td>Billing Address</td>
        <td><textarea rows="4" cols="25"  name="billing_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
</textarea></td>
      </tr>
      <tr>
        <td><h1>Device Rate</h1></td>
      </tr>
            
      <tr>
            <td><label for="Account_Type" id="lblAccountType">Account Type</label></td>
            <td><select name="account_type" id="TxtAccountType"  style="width:150px" onchange="AccountSelection(this.value)">
                <option value="">-- select one --</option>
                <option value="Lease" <? if($result[0]['account_type']=='Lease') {?> selected="selected" <? } ?>>Lease</option>
                <option value="Paid" <? if($result[0]['account_type']=='Paid') {?> selected="selected" <? } ?>>Paid</option>
                <option value="Demo" <? if($result[0]['account_type']=='Demo') {?> selected="selected" <? } ?>>Demo</option>
                <option value="Foc" <? if($result[0]['account_type']=='Foc') {?> selected="selected" <? } ?>>FOC</option>
                <option value="Crack" <? if($result[0]['account_type']=='Crack') {?> selected="selected" <? } ?>>Crack</option>
                <option value="Trip Based" <? if($result[0]['account_type']=='Trip Based') {?> selected="selected" <? } ?>> Trip Based</option>
                <option value="InternalTesting" <? if($result[0]['account_type']=='InternalTesting') {?> selected="selected" <? } ?>>Internal Testing</option>
              </select></td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:40px"><!-- Bill request-->
          
          <table id="Billed_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                <td><label for="Modof_payment"  id="lblModPayment">Mode Of Payment</label></td>
                <td><select name="mode_of_payment" id="mode_of_payment" onchange="PaymentProcessBYCash(this.value)" style="width:150px">
                    <option value="" >-- select one --</option>
                    <option value="CashClient"<? if($result[0]['mode_of_payment']=='CashClient'){?> selected="selected"<? }?>>Cash Client</option>
                    <option value="Billed" <? if($result[0]['mode_of_payment']=='Billed') {?> selected="selected" <? } ?>> Billed</option>
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
              <td><input type="value" name="device_price" id="TxtDPrice" value="<?=$result[0]['device_price']?>" 
          placeholder="Device Price" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculatetotal(this.value);"/></td>
            </tr>
            <tr>
              <td><label for="vat" id="lblDvat">Vat(5%)</label></td>
              <td><input type="value" name="device_price_vat" id="TxtDVat" value="<?=$result[0]['device_price_vat']?>" readonly /></td>
            </tr>
            <tr>
              <td><label for="total" id="lblDTotal">Total</label></td>
              <td><input type="value" name="device_price_total" id="TxtDTotal" value="<?=$result[0]['device_price_total']?>" readonly /></td>
            </tr>
            <tr>
              <td><label for="rent" id="lblDRent">Rent</label></td>
              <td><input type="value" name="device_rent_Price" id="TxtDRent" value="<?=$result[0]['device_rent_Price']?>"  
           placeholder="Monthly Rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculaterent(this.value);"/></td>
            </tr>
            <tr>
              <td><label for="service_tax" id="lblDServiceTax">Service Tex(15%)</label></td>
              <td><input type="value" name="device_rent_service_tax" id="TxtDServiceTax" value="<?=$result[0]['device_rent_service_tax']?>" readonly /></td>
            </tr>
            <tr>
              <td><label for="TxtDTotalREnt" id="lblDrentTotal">Total Rent</label></td>
              <td><input type="value" name="TxtDTotalREnt" id="TxtDTotalREnt" value="<?=$result[0]['DTotalREnt']?>" readonly /></td>
            </tr> 
            <tr>
              <td><label for="TxtRentPlan" id="lblRentPlan">Rent Plan</label></td>
              <td><select name="rent_month" id="TxtRentPlan" >
                  <option value="">-- Select One --</option>
                  <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?>>Monthly</option>
                  <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?>>Quarterly</option>
                  <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?>>HalfYearly</option>
                  <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?>>Yearly</option>
                </select></td>
            </tr>
            <tr>
              <td><label for="rent_status" id="rent_status"> Rent status </label></td>
              <td><Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Excluding'
                    <?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/>
                Excluding
                <Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Including'
                    <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/>
                Including </td>
            </tr>          
          </table></td>
      </tr>
      <tr>
        <td colspan="2" align="left" style="padding-left:70px"><!-- Cash request-->
        	<table  id="CashCase"    style="width:100%;display:none;border:1"  cellspacing="5" cellpadding="0">
            <tr>
              <td><label for="price" id="lblDprice">Device Price</label></td>
              <td><input type="value" name="device_price_totalcash" id="TxtDPricecash" value="<?=$result[0]['device_price_total']?>" 
              placeholder="Device Price" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  /></td>
            </tr>
            <tr>
              <td><label for="rent" id="lblDRent">Rent</label></td>
              <td><input type="value" name="TxtDTotalREntcash" id="TxtDRentCash" value="<?=$result[0]['DTotalREnt']?>" 
             placeholder="Monthly Rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
            </tr>
            <tr>
              <td><label for="TxtRentPlan" id="lblRentPlan">Rent Plan</label></td>
              <td><select name="rent_monthcash" id="TxtRentPlancash" >
                  <option value="">-- Select One --</option>
                  <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?>>Monthly</option>
                  <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?>>Quarterly</option>
                  <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?>>HalfYearly</option>
                  <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?>>Yearly</option>
                </select></td>
            </tr>
            <tr>
              <td><label for="rent_statuscash" id="rent_statuscash"> Rent status </label></td>
              <td><Input type = 'Radio' Name ='rent_statuscash' id="rent_status_cash" value= 'Excluding'
                    <?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/> Excluding
                <Input type = 'Radio' Name ='rent_statuscash' id="rent_status_cash" value= 'Including'
                    <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/> Including
               </td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
        <td colspan="2" align="left" style="padding-left:70px"><!-- Demo request-->
          
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
        <td colspan="2" align="left" style="padding-left:70px"><!-- FOC request-->
          
          <table id="foc_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                  <td><label for="focreason" id="focreason">Foc Reason</label></td>
                  <td><input type="text" name="foc_reason" id="foc_reason" value="" /></td>
            </tr>
            
           </table>
        </td>
       </tr>
       <tr>
       
       <tr>
        <td colspan="2" align="left" style="padding-left:60px"><!-- Internal testing request-->
          
          <table id="testing_id"  style="width:100%;display:none;border:1;" cellspacing="5" cellpadding="0">
            <tr>
                  <td><label for="TestingTime" id="TestingTime">Testing Time</label></td>
                  <td><select name="testing_time" id="testing_time" >
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
        <td><label for="Vehicle_Type" id="lblVehicleType">Vehicle Type</label></td>
        <td><select name="vehicle_type" id="TxtVehicleType" style="width:150px">
            <option value="">Select Vehicle Type</option>
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
      <!--<tr>
        <td><label for="Account_Type" id="lblAccountType">Account Type</label></td>
        <td><select name="account_type" id="TxtAccountType"  style="width:150px">
            <option value="" id="TxtAccountType">-- select one --</option>
            <option value="Lease" <? if($result[0]['account_type']=='Lease') {?> selected="selected" <? } ?> id="TxtAccountType">Lease</option>
            <option value="Paid" <? if($result[0]['account_type']=='Paid') {?> selected="selected" <? } ?> id="TxtAccountType">Paid</option>
            <option value="Demo" <? if($result[0]['account_type']=='Demo') {?> selected="selected" <? } ?> id="TxtAccountType"> Demo</option>
          </select></td>
      </tr>-->
      <tr>
        <td><label for="Email_Id" id="lblEmailId">Email Id</label></td>
        <td><input type="text" name="email_id" id="TxtEmailId" value="<?=$result[0]['email_id']?>" /></td>
      </tr>
      <tr>
        <td><label for="user_name"  id="lblUserName">User Name</label></td>
        <td><input type="text" name="user_name" id="TxtUserName" value="<?=$result[0]['user_name']?>" 
        	 onchange="ExistUserChk(this.value,'newuser');"  /> <br/><span id="newuser" style="color:#FF0000;font-size:12px;"></span></td>
      </tr>
      <tr>
        <td><label for="user_Password"  id="lblUserPass"> Password</label></td>
        <td><input type="text" name="user_password" id="TxtUserPass" value="<?=$result[0]['user_password']?>"/></td>
      </tr>
      <tr>
        <td class="style2"> Comment</td>
        <td><textarea rows="3" cols="25"  type="text" name="new_acc_salescomment" id="TxtNewSalesComment" ><?=$result[0]['new_acc_salescomment']?>
</textarea></td>
      </tr>
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
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'accountcreation.php?for=formatrequest'" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
<script>AccountSelectionEdit("<?=$result[0]['account_type'].'","'.$result[0]['mode_of_payment'];?>");</script>

<?php
$file_ext1='pancard.jpg';
$file_ext2='addproof.jpg';

if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
   if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file"]["type"] == "image/jpeg") || ($_FILES["uploaded_file"]["type"] == "image/png") || ($_FILES["uploaded_file"]["type"] == "image/gif")) &&
    ($_FILES["uploaded_file"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/Pancard/'.$user_name.'_'.$file_ext1;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//Сheck that we have a file
if((!empty($_FILES["uploaded_file_add"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file_add']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file_add"]["type"] == "image/jpeg") || ($_FILES["uploaded_file_add"]["type"] == "image/png") || ($_FILES["uploaded_file_add"]["type"] == "image/gif")) &&
    ($_FILES["uploaded_file_add"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/Addressproof/'.$user_name.'_'.$file_ext2;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file_add']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file_add"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}
?>