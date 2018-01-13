<?php 
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');
 
$action = $_GET['action'];
$id = $_GET['id'];
$page = $_POST['page'];
if($action=='edit')
{
	$result = select_query("select * from new_account_creation where id=$id");   
	
	$ModelData = select_query("select * from new_account_model_master where is_active='0' and new_account_reqid='".$id."' ");
	$modelcount = count($ModelData);
	//echo "<pre>";print_r($ModelData);die;
}
else
{
	$result = select_query("select * from new_account_creation where id=$id");   
}
//echo "<pre>";print_r($result);die;
?>

<div class="top-bar">
  <h1>Add Model</h1>
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
	
	if($action=='edit')
	{
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
	
		echo "<script>document.location.href ='accountcreation_request.php'</script>";
	}
	else
	{
	
		$chk_model = select_query("SELECT * FROM `internalsoftware`.`new_account_model_master` WHERE new_account_reqid=$id");
		
		if(count($chk_model)>0)
		{
			$update_model = array('is_active' => 1);
			$condition = array('new_account_reqid' => $id);	
			update_query('internalsoftware.new_account_model_master', $update_model, $condition);
		}
		
		$update_accountCreation = array('approve_status' => 0, 'approve_date' => NULL, 'model_status' => 1);
		$condition2 = array('id' => $id);			
		$Insert_data = update_query('internalsoftware.new_account_creation', $update_accountCreation, $condition2);
	
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
	
		echo "<script>document.location.href ='accountcreation_request.php'</script>";
	}

}

?>
<script type="text/javascript">

function Check()
{  
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
				document.getElementById(dStatus).disabled=false;
				document.getElementById(dStatustwo).disabled=false;
				
				document.getElementById(dStatus).checked=false;
				document.getElementById(dStatustwo).checked=false;
				document.getElementById(dTax).value = '';
				document.getElementById(dTotal).value = '';
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
	
	if(deviceModel == '')
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
				document.getElementById(rStatus).disabled=false;
				document.getElementById(rStatustwo).disabled=false;
				
				document.getElementById(rStatus).checked=false;
				document.getElementById(rStatustwo).checked=false;
				document.getElementById(rTax).value = '';
				document.getElementById(rTotal).value = '';
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
	
	if(deviceModel == '')
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
		alert('You Can Not Select More Same Model with Same Account.');
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

function AccountSelectionEdit(actype,setDivId,setotherDivId,setPayment,RentPlan,loopval)
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
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
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
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
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
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[0]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[0]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
						otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[0]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[0]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[0]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[0]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
					}
					else
					{			
						newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[0]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[0]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[0]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[0]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
						
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[1]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[1]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[1]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[1]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[1]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[1]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[1]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[1]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[1]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[1]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[2]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[2]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[2]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[2]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[2]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[2]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[2]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[2]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[2]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[2]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[3]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[3]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[3]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[3]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[3]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[3]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[3]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[3]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[3]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[3]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[4]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[4]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[4]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[4]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[4]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[4]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[4]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[4]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[4]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[4]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[5]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[5]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[5]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[5]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[5]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[5]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[5]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[5]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[5]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[5]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[6]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[6]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[6]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[6]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[6]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[6]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[6]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[6]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[6]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[6]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[7]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[7]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[7]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[7]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[7]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[7]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[7]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[7]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[7]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[7]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[8]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[8]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[8]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[8]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[8]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[8]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[8]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[8]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[8]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[8]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price'];?>" placeholder="Device Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[9]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[9]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
							otherDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="rent_Price[]" id="'+rentPrice+'" style="width:150px" value="<?=$ModelData[9]['device_rent_Price'];?>" placeholder="Rent" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DeviceRentView(this.value,'+fnrentPrice+','+fnrent_status_cash+','+fnrent_status_cash2+','+fnrentServiceTax+','+fnrentTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /></td><td><Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash+'" value= "Excluding" onchange="calculateRent(this.value,'+fnrent_status_cash+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+rent_status_cash+'" id="'+rent_status_cash2+'" value= "Including" onchange="calculateRent(this.value,'+fnrent_status_cash2+','+fnrentPrice+','+fnrentServiceTax+','+fnrentTotal+','+fnplan+','+fnaccountType+');"<? if($ModelData[9]['rent_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="rent_service_tax[]" id="'+rentServiceTax+'" value="<?=$ModelData[9]['device_rent_service_tax'];?>" readonly placeholder="Service Tax" style="width:150px" /></td><td><input type="value" name="TxtDTotalREnt[]" id="'+rentTotal+'" value="<?=$ModelData[9]['DTotalREnt'];?>" readonly placeholder="Total Rent" style="width:150px" /><input type="hidden" name="foc_reason[]" /><input type="hidden" name="testing_time[]" /><input type="hidden" name="demo_time[]" /></td></tr>';
						}
						else
						{			
							newDiv.innerHTML += '<tr><td>&nbsp;</td><td><input type="value" name="device_price[]" id="'+devicePrice+'" style="width:150px" value="<?=$ModelData[9]['device_price'];?>" placeholder="Device + Rent Price" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="DevicePriceView(this.value,'+fndevicePrice+','+fndevice_statuscash+','+fndevice_statuscash2+','+fndeviceVat+','+fndeviceTotal+','+fnDevicetype+','+fnaccountType+','+fnpayment+','+fnplan+')" /> </td><td><Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash+'" value= "Excluding" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Excluding"){echo "checked=\"checked\"";}?>/> Excluding <Input type="radio" Name ="'+device_statuscash+'" id="'+device_statuscash2+'" value= "Including" onchange="calculateDeviceTotal(this.value,'+fndevice_statuscash2+','+fndevicePrice+','+fndeviceVat+','+fndeviceTotal+','+fnplan+','+fnaccountType+','+fnDevicetype+');"<? if($ModelData[9]['device_status']=="Including"){echo "checked=\"checked\"";}?>/> Including</td><td><input type="value" name="device_price_vat[]" id="'+deviceVat+'" value="<?=$ModelData[9]['device_price_vat'];?>" readonly style="width:150px" placeholder="TAX" /></td><td><input type="value" name="device_price_total[]" id="'+deviceTotal+'" value="<?=$ModelData[9]['device_price_total'];?>" readonly style="width:150px" placeholder="Total Device Price" /></td></tr>';
							
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

  <form action="client_model_add.php" method="post" name="myForm" onsubmit="return Check()" autocomplete="off">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr> 
        <td colspan="2">
          <input type="hidden" name="action" id="action" value="<?=$action;?>"/>
          <input type="hidden" name="id" id="id" value="<?=$id;?>"/></td>
      </tr>
      
      </table>
      
      <table style=" padding-left: 100px;width: 800px;" cellspacing="5" cellpadding="5">
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
      <tr>
        <td></td>
        <td class="submit"><input id="button1" type="submit" name="submit" value="submit" runat="server" />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'accountcreation_request.php'" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); 

if($action=='edit'){
	
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
	<script>AccountSelectionEdit('<?=$ModelData[$gm]['account_type'];?>','billdetails','billdetails_other','mode_of_payment','TxtRentPlan''TxtDeviceType','model_no','');</script>	
    <script>BillingPlanEdit('<?=$ModelData[$gm]['rent_month'];?>','billdetails','billdetails_other','mode_of_payment','TxtAccountType','');</script>
	
	<?php }else{ ?>
	
	<script>DeviceSelectionEdit(<?=$ModelData[$gm]['device_type'];?>,'model_no<?=$gm;?>','<?=$ModelData[$gm]['device_model'];?>');</script>	  
	<script>AccountSelectionEdit('<?=$ModelData[$gm]['account_type'];?>','billdetails<?=$gm;?>','billdetails_other<?=$gm;?>','mode_of_payment<?=$gm;?>','TxtRentPlan<?=$gm;?>','TxtDeviceType<?=$gm;?>','model_no<?=$gm;?>','<?=$gm;?>');</script>
    <script>BillingPlanEdit('<?=$ModelData[$gm]['rent_month'];?>','billdetails<?=$gm;?>','billdetails_other<?=$gm;?>','mode_of_payment<?=$gm;?>','TxtAccountType<?=$gm;?>','<?=$gm;?>');</script>
	
	<?php } ?>
     
	  
	 
<?php 
	}
	
}
?>
	