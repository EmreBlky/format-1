<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_snp.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_snp.php"); */
 
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
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
 $device_price=0;
 $device_price_vat=0;
 $device_price_total=0;
 $device_rent_Price=0;
 $device_rent_service_tax=0;
 $TxtDTotalREnt=0;


if(isset($_POST["submit"]) && $_POST["submit"]=="submit")
{
	$action=$_POST['action'];
	$id = $_POST["id"];
	$date=(isset($_POST["date"])) ? trim($_POST["date"])  : "";
	$company=(isset($_POST["company"])) ? trim($_POST["company"]): "";
	$account_manager=(isset($_POST["account_manager"])) ? trim($_POST["account_manager"]): "";
	$potential=(isset($_POST["potential"])) ? trim($_POST["potential"]): "";
	$contact_person=(isset($_POST["contact_person"])) ? trim($_POST["contact_person"]): "";
	$contact_number=(isset($_POST["contact_number"])) ? trim($_POST["contact_number"]): "";
	$billing_name=(isset($_POST["billing_name"])) ? trim($_POST["billing_name"]): "";
	$billing_address=(isset($_POST["billing_address"])) ? trim($_POST["billing_address"]): "";
	$mode_of_payment=(isset($_POST["mode_of_payment"])) ? trim($_POST["mode_of_payment"]): "";
	$type_of_org=(isset($_POST["type_of_org"])) ? trim($_POST["type_of_org"]): "";
	$pan_no=(isset($_POST["pan_no"])) ? trim($_POST["pan_no"]): "";
	$dimts=(isset($_POST["dimts"])) ? trim($_POST["dimts"]): "";
	
	//device_price, device_price_vat,device_price_total,device_rent_Price,device_rent_service_tax,TxtDTotalREnt
	
	if($mode_of_payment=="Cash")
	{
	$device_price_total=(isset($_POST["device_price_total1"])) ? trim($_POST["device_price_total1"]): 0;
	$TxtDTotalREnt=(isset($_POST["TxtDTotalREnt1"])) ? trim($_POST["TxtDTotalREnt1"]): 0;
	$rent_month=(isset($_POST["rent_month"])) ? trim($_POST["rent_month"]): "";
	
	}
	else if($mode_of_payment=="Cheque")
	
	{
	
	$device_price=(isset($_POST["device_price"])) ? trim($_POST["device_price"]): 0;
	$device_price_vat=(isset($_POST["device_price_vat"])) ? trim($_POST["device_price_vat"]): 0;
	$device_price_total=(isset($_POST["device_price_total"])) ? trim($_POST["device_price_total"]): 0;
	$device_rent_Price=(isset($_POST["device_rent_Price"])) ? trim($_POST["device_rent_Price"]): 0;
	$device_rent_service_tax=(isset($_POST["device_rent_service_tax"])) ? trim($_POST["device_rent_service_tax"]): 0;
	$TxtDTotalREnt=(isset($_POST["TxtDTotalREnt"])) ? trim($_POST["TxtDTotalREnt"]): 0;
	$rent_month=(isset($_POST["rent_month1"])) ? trim($_POST["rent_month1"]): "";
	
	}
	
	else if($mode_of_payment=="Demo")
	
	{
	
		$demo=(isset($_POST["Demo"])) ? trim($_POST["Demo"]): 0;
	
	}
	
	$vehicle_type=(isset($_POST["vehicle_type"])) ? trim($_POST["vehicle_type"]): "";
	$account_type=(isset($_POST["account_type"])) ? trim($_POST["account_type"]): "";
	$immobilizer=(isset($_POST["immobilizer"])) ? trim($_POST["immobilizer"]): "";
	$ac_on_off=(isset($_POST["ac_on_off"])) ? trim($_POST["ac_on_off"]): "";
	$email_id=(isset($_POST["email_id"])) ? trim($_POST["email_id"]): "";
	$user_name=(isset($_POST["user_name"])) ? trim($_POST["user_name"]): "";
	$user_password=(isset($_POST["user_password"])) ? trim($_POST["user_password"]): "";
	$service_comment=(isset($_POST["service_comment"])) ? trim($_POST["service_comment"]): "";
	$new_acc_salescomment=(isset($_POST["new_acc_salescomment"])) ? trim($_POST["new_acc_salescomment"]): "";
	
	$sales_manager=$_POST["sales_manager"];
	//device_price, device_price_vat,device_price_total,device_rent_Price,device_rent_service_tax,TxtDTotalREnt
 
 
  if($sales_manager=="") {
	$sales_manager_edit=$result[0]['sales_manager'];
	}
	else {
	$sales_manager_edit=$sales_manager;
	}
 
	$rent_status=(isset($_POST["rent_status"])) ? trim($_POST["rent_status"]): "";
	$dimts_fee=(isset($_POST["dimts_fee"])) ? trim($_POST["dimts_fee"]): "";



if($action=='edit')
	{
	
	 $query="update new_account_creation set date='".$date."',account_manager='".$account_manager."',company='".$company."',potential='".$potential."',contact_person='".$contact_person."',contact_number='".$contact_number."',billing_name='".$billing_name."' ,billing_address='".$billing_address."',type_of_org='".$type_of_org."',pan_no='".$pan_no."',demo_time='".$demo."',device_price='".$device_price."',device_price_vat='".$device_price_vat."',device_price_total='".$device_price_total."',device_rent_Price='".$device_rent_Price."',device_rent_service_tax='".$device_rent_service_tax."',DTotalREnt='".$TxtDTotalREnt."',mode_of_payment='".$mode_of_payment."',vehicle_type='".$vehicle_type."',immobilizer='".$immobilizer."',ac_on_off='".$ac_on_off."',account_type='".$account_type."',email_id='".$email_id."',user_name='".$user_name."',user_password='".$user_password."',dimts='".$dimts."',new_acc_salescomment='".$new_acc_salescomment."',sales_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d h:i:s")." - " .$service_comment."',sales_manager='".$sales_manager_edit."',rent_status='".$rent_status."',dimts_fee='".$dimts_fee."',rent_month='".$rent_month."' where id=$id";
 
 mysql_query($query);
echo "<script>document.location.href ='accountcreation.php?for=formatrequest'</script>";
	}
  else
  {
      $query="insert into new_account_creation(date,account_manager,company,potential,contact_person,contact_number,billing_name,billing_address,type_of_org,pan_no,demo_time,device_price,device_price_vat,device_price_total,device_rent_Price,device_rent_service_tax,DTotalREnt,mode_of_payment,vehicle_type,immobilizer,ac_on_off,account_type,email_id,user_name,user_password,sales_manager,dimts,rent_status,dimts_fee,rent_month,new_acc_salescomment,branch_id) 
	  values('".$date."','".$account_manager."','".$company."','".$potential."','".$contact_person."','".$contact_number."','".$billing_name."','".$billing_address."','".$type_of_org."','".$pan_no."','".$demo."',".$device_price.",".$device_price_vat.",".$device_price_total.",".$device_rent_Price.",".$device_rent_service_tax.",".$TxtDTotalREnt.",'".$mode_of_payment."','".$vehicle_type."','".$immobilizer."','".$ac_on_off."','".$account_type."','".$email_id."','".$user_name."','".$user_password."','".$sales_manager."','".$dimts."','".$rent_status."','".$dimts_fee."','".$rent_month."','".$new_acc_salescomment."','".$_SESSION['BranchId']."')";
 
	  mysql_query($query) ;
  
	 	echo "<script>document.location.href ='accountcreation.php?for=formatrequest'</script>";
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
	
        if(length < 9 || length > 15 || TxtContactNumber.search(/[^0-9\-()+]/g) != -1 )
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

 /*if(document.myForm.TxtBillingAdd.value=="")
  {
  alert("Please Enter Billing Address") ;
  document.myForm.TxtBillingAdd.focus();
  return false;
  }  */
 
  
  if(document.myForm.mode_of_payment.value=="")
  {
  alert("Please Choose Mode") ;
  document.myForm.mode_of_payment.focus();
  return false;
  }
  
  
  if(document.myForm.mode_of_payment.value=="Cash")
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
	
 if(document.myForm.mode_of_payment.value=="Cheque")

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
	
 if(document.myForm.mode_of_payment.value=="Demo")
	{
	if(document.myForm.TxtDemo.value=="")
	{
  	alert("Please Enter Demo") ;
  	document.myForm.TxtDemo.focus();
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
 
function PaymentProcessBYCash(radioValue)
{

if(radioValue=="Cash")
	{
	document.getElementById('InTaxCase1').style.display = "none";

	document.getElementById('InNoTaxCase1').style.display = "block";
		document.getElementById('Demo1').style.display = "none";

	document.getElementById('InNoTaxCase').style.display = "none";
	document.getElementById('InTaxCase').style.display = "none";
	document.getElementById('Demo').style.display = "none";
	}
	else if(radioValue=="Cheque")
	{
	document.getElementById('InTaxCase1').style.display = "block";

	document.getElementById('InNoTaxCase1').style.display = "none";
		document.getElementById('Demo1').style.display = "none";

	document.getElementById('InNoTaxCase').style.display = "none";
	document.getElementById('InTaxCase').style.display = "none";
	document.getElementById('Demo').style.display = "none";
	}
	
else if(radioValue=="Demo")	{
	document.getElementById('Demo1').style.display = "block";
	document.getElementById('InTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase').style.display = "none";
	document.getElementById('InTaxCase').style.display = "none";
	document.getElementById('Demo').style.display = "none";
	
	}
else if(radioValue=="FOC")	{
	document.getElementById('Demo1').style.display = "none";
	document.getElementById('InTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase').style.display = "none";
	document.getElementById('InTaxCase').style.display = "none";
	document.getElementById('Demo').style.display = "none";
	
	}
else if(radioValue=="Lease")	{
	document.getElementById('Demo1').style.display = "none";
	document.getElementById('InTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase1').style.display = "none";
	document.getElementById('InNoTaxCase').style.display = "none";
	document.getElementById('InTaxCase').style.display = "none";
	document.getElementById('Demo').style.display = "none";
	
	}
}

function DimtsPayment(radioValue1)
{

if(radioValue1=="Yes")
	{

	document.getElementById('DimtsCase').style.display = "block";
	}
	else if(radioValue1=="No")
	{

	document.getElementById('DimtsCase').style.display = "none";

	}

}

function calculatetotal(price)
{
 var vatp = 5;
 
 
document.getElementById('TxtDVat').value= price * vatp / 100;
document.getElementById('TxtDTotal').value=parseInt(price)+parseInt(document.getElementById('TxtDVat').value);
//alert(result);

}

function calculaterent(price)
{

var vatp = 14.50; 
 
document.getElementById('TxtDServiceTax').value= price * vatp / 100;
document.getElementById('TxtDTotalREnt').value=parseInt(price)+parseInt(document.getElementById('TxtDServiceTax').value); 


//alert(result);

}

  
    </script>
	 
<form action="NewAccountCreation.php" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return Check()">

    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
	
        <tr>
            <td>Date</td>
            <td>
                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" />
                <input type="hidden" name="action" id="action" value="<?=$action;?>"/> <input type="hidden" name="id" id="id" value="<?=$id;?>"/></td>
        </tr>

		<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
        </tr>
		
			<tr>
            <td>Sales Manager</td>
            <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
              <?php
        $sales_manager = select_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
        //while ($data=mysql_fetch_assoc($sales_manager))
        for($i=0;$i<count($sales_manager);$i++)
		{
        ?>
        
        <option name="sales_manager" value="<?=$sales_manager[$i]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$i]['name']) {?> selected="selected" <? } ?> >
        <?php echo $sales_manager[$i]['name']; ?>
        </option>
        <?php 
        } 
        ?>
          
            </select> 
            </td>
        </tr>
		
        <tr>
        <td>Company Name</td>
        
        <td>
         <input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>"/>
        </td>
        </tr>
        </td>
        </tr>
        
        <tr>
            <td>Potential</td>
            <td>
			   
			   <select name="potential" id="TxtPotentail" >
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
                </select>
			   </td>
        </tr>
		<tr>
            <td>Type of Organisation</td>
            <td>
                <select name="type_of_org" id="type_of_org" >
                    <option value="" name="type_of_org" id="type_of_org">-- Select One --</option>
                    <option value="Individual" <? if($result[0]['type_of_org']=='Individual') {?> selected="selected" <? } ?> >Individual</option>
                    <option value="Proprietorship" <? if($result[0]['type_of_org']=='Proprietorship') {?> selected="selected" <? } ?> >Proprietorship</option>
                    <option value="Partnership firm" <? if($result[0]['type_of_org']=='Partnership firm') {?> selected="selected" <? } ?> >Partnership firm</option>
                    <option value="Public " <? if($result[0]['type_of_org']=='Public ') {?> selected="selected" <? } ?> >Public</option>
                    <option value="Private limited " <? if($result[0]['type_of_org']=='Private limited') {?> selected="selected" <? } ?> >Private limited</option>
                
                </select>
			   </td>
        </tr>
		<tr>
            <td>PAN No.</td>
            <td>
                <input type="text" name="pan_no" id="pan_no" value="<?=$result[0]['pan_no']?>" /></td>
        </tr>
		<tr>
		<td> Copy of Pan Card</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file" type="file" />
		</tr>
		<tr>
		<td>Copy of Address Proof</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file_add" type="file" />
		</tr>
        <tr>
            <td>Contact Person</td>
            <td>
                <input type="text" name="contact_person" id="TxtContactPerson" value="<?=$result[0]['contact_person']?>" /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td>
                <input type="value" name="contact_number" id="TxtContactNumber" value="<?=$result[0]['contact_number']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
        </tr>
        <tr>
            <td>Billing Name</td>
            <td>
                <input type="text" name="billing_name" id="TxtBillingName" value="<?=$result[0]['billing_name']?>" /></td>
        </tr>
        <tr>
            <td>Billing Address</td>
            <td>
                
			   <textarea rows="4" cols="25"  name="billing_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
 </textarea> 
			   
			   </td>
        </tr>
        
            <tr>
            <td><h1>Device Rate</h1></td>
			
            </tr>
			<tr>
            <td>
               <label for="Modof_payment"  id="lblModPayment">Mode Of Payment</label></td>
            <td>

                <select name="mode_of_payment" id="mode_of_payment" onchange="PaymentProcessBYCash(this.value)" >
                    <option value="" >-- select one --</option>
                    
                    <option value="Cash" <? if($result[0]['mode_of_payment']=='Cash') {?> selected="selected" <? } ?>>Cash</option>
                    <option value="Cheque" <? if($result[0]['mode_of_payment']=='Cheque') {?> selected="selected" <? } ?>> Cheque</option>
                    <option value="Demo" <? if($result[0]['mode_of_payment']=='Demo') {?> selected="selected" <? } ?>> Demo</option>
                    <option value="FOC" <? if($result[0]['mode_of_payment']=='FOC') {?> selected="selected" <? } ?>> FOC</option>
                    <option value="Lease" <? if($result[0]['mode_of_payment']=='Lease') {?> selected="selected" <? } ?>> Lease</option>
                </select>
            </td>
     </tr>
           
            <tr><td colspan="2"> 
			<?php if($result[0]['mode_of_payment']=='Cheque'){ ?>
			
 			     <table  id="InTaxCase1"  style="width:500px;border:1" cellspacing="5" cellpadding="0">



			  <tr><td> <label for="price" id="lblDprice">Device Price</label></td>
			 <td> <input type="value" name="device_price" id="TxtDPrice" value="<?=$result[0]['device_price']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculatetotal(this.value);"/></td></tr>
            <tr><td> <label for="vat" id="lblDvat">Vat(5%)</label></td>
			<td> <input type="value" name="device_price_vat" id="TxtDVat" value="<?=$result[0]['device_price_vat']?>" readonly /></td></tr>
              <tr><td> <label for="total" id="lblDTotal">Total</label></td>
			  <td> <input type="value" name="device_price_total" id="TxtDTotal" value="<?=$result[0]['device_price_total']?>" readonly /></td></tr>
              <tr><td> <label for="rent" id="lblDRent">Rent</label></td>
			   <td> <input type="value" name="device_rent_Price" id="TxtDRent" value="<?=$result[0]['device_rent_Price']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculaterent(this.value);"/></td></tr>
              <tr><td> <label for="service_tax" id="lblDServiceTax">Service Tex(12.36%)</label></td>
            <td> <input type="value" name="device_rent_service_tax" id="TxtDServiceTax" value="<?=$result[0]['device_rent_service_tax']?>" readonly /></td></tr>

			<tr><td> <label for="TxtDTotalREnt" id="lblDrentTotal">Total Rent</label></td>
            <td> <input type="value" name="TxtDTotalREnt" id="TxtDTotalREnt" value="<?=$result[0]['DTotalREnt']?>" readonly /></td></tr>
         
		 <tr>
            <td>
               <label for="rent_status" id="rent_status"> Rent status </label></td>
            <td>

			<Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Excluding'
<?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/>Excluding

<Input type = 'Radio' Name ='rent_status' value= 'Including' <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/>
Including
               </td>
        </tr>
		
	
<tr><td width="128"> <label for="rent_month" id="rent_month">Rent Month</label></td>
		  <td width="355">
                <select name="rent_month1" id="rent_month1" >
                    <option value="" name="rent_month1" id="rent_month1">-- Select One --</option>
                    <option value="0" <? if($result[0]['rent_month']=='0') {?> selected="selected" <? } ?> >0</option>
                    <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?> >1</option>
                    <option value="2" <? if($result[0]['rent_month']=='2') {?> selected="selected" <? } ?> >2</option>
                    <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?> >3</option>
                    <option value="4" <? if($result[0]['rent_month']=='4') {?> selected="selected" <? } ?> >4</option>
                    <option value="5" <? if($result[0]['rent_month']=='5') {?> selected="selected" <? } ?> >5</option>
                    <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?> >6</option>
                    <option value="7" <? if($result[0]['rent_month']=='7') {?> selected="selected" <? } ?> >7</option>
                    <option value="8" <? if($result[0]['rent_month']=='8') {?> selected="selected" <? } ?> >8</option>
                    <option value="9" <? if($result[0]['rent_month']=='9') {?> selected="selected" <? } ?> >9</option>
                    <option value="10" <? if($result[0]['rent_month']=='10') {?> selected="selected" <? } ?> >10</option>
                    <option value="11" <? if($result[0]['rent_month']=='11') {?> selected="selected" <? } ?> >11</option>
                    <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?> >12</option>
                </select>
		  </td></tr>
		
		
		
  </table>
  
  <? } ?>
 
 
 <table  id="InTaxCase1"  style="width: 500px;display:none;border:1" cellspacing="5" cellpadding="0">
	  <tr><td> <label for="price" id="lblDprice">Device Price</label></td>
			 <td> <input type="value" name="device_price" id="TxtDPrice" value="<?=$result[0]['device_price']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculatetotal(this.value);"/></td></tr>
            <tr><td> <label for="vat" id="lblDvat">Vat(5%)</label></td>
			<td> <input type="value" name="device_price_vat" id="TxtDVat" value="<?=$result[0]['device_price_vat']?>" readonly /></td></tr>
              <tr><td> <label for="total" id="lblDTotal">Total</label></td>
			  <td> <input type="value" name="device_price_total" id="TxtDTotal" value="<?=$result[0]['device_price_total']?>" readonly /></td></tr>
              <tr><td> <label for="rent" id="lblDRent">Rent</label></td>
			   <td> <input type="value" name="device_rent_Price" id="TxtDRent" value="<?=$result[0]['device_rent_Price']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="calculaterent(this.value);"/></td></tr>
              <tr><td> <label for="service_tax" id="lblDServiceTax">Service Tex(14.5%)</label></td>
            <td> <input type="value" name="device_rent_service_tax" id="TxtDServiceTax" value="<?=$result[0]['device_rent_service_tax']?>" readonly /></td></tr>

			<tr><td> <label for="TxtDTotalREnt" id="lblDrentTotal">Total Rent</label></td>
            <td> <input type="value" name="TxtDTotalREnt" id="TxtDTotalREnt" value="<?=$result[0]['DTotalREnt']?>" readonly /></td></tr>
          
		 <tr>
            <td>
               <label for="rent_status" id="rent_status"> Rent status </label></td>
            <td>

			<Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Excluding' 
<?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/>Excluding

<Input type = 'Radio' Name ='rent_status' value= 'Including' 
<?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/>
Including
               </td>
        </tr>
		
		
<tr><td width="128"> <label for="rent_month" id="rent_month">Rent Month</label></td>
		  <td width="355">
            <select name="rent_month1" id="rent_month1" >
                <option value="" name="rent_month1" id="rent_month1">-- Select One --</option>
                <option value="0" <? if($result[0]['rent_month']=='0') {?> selected="selected" <? } ?> >0</option>
                <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?> >1</option>
                <option value="2" <? if($result[0]['rent_month']=='2') {?> selected="selected" <? } ?> >2</option>
                <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?> >3</option>
                <option value="4" <? if($result[0]['rent_month']=='4') {?> selected="selected" <? } ?> >4</option>
                <option value="5" <? if($result[0]['rent_month']=='5') {?> selected="selected" <? } ?> >5</option>
                <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?> >6</option>
                <option value="7" <? if($result[0]['rent_month']=='7') {?> selected="selected" <? } ?> >7</option>
                <option value="8" <? if($result[0]['rent_month']=='8') {?> selected="selected" <? } ?> >8</option>
                <option value="9" <? if($result[0]['rent_month']=='9') {?> selected="selected" <? } ?> >9</option>
                <option value="10" <? if($result[0]['rent_month']=='10') {?> selected="selected" <? } ?> >10</option>
                <option value="11" <? if($result[0]['rent_month']=='11') {?> selected="selected" <? } ?> >11</option>
                <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?> >12</option>
            </select>
		  </td></tr>
  </table>
  
</td></tr>
  <tr><td colspan="2">
<?php if($result[0]['mode_of_payment']=='Cash') {?>
  
 			     <table  id="InNoTaxCase"    style="width:500px;border:1"  cellspacing="5" cellpadding="0">
		  <tr><td> <label for="price" id="lblDprice">Device Price</label></td><td> <input type="value" name="device_price_total1" id="TxtDPricecash" value="<?=$result[0]['device_price_total']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  /></td></tr>
            
			 
              <tr><td> <label for="rent" id="lblDRent">Rent</label></td>
			   <td> <input type="value" name="TxtDTotalREnt1" id="TxtDRentCash" value="<?=$result[0]['DTotalREnt']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td></tr> 
          
		 <tr>
            <td>
               <label for="rent_status" id="rent_status"> Rent status </label></td>
            <td>

			<Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Excluding' 
			<?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/>Excluding
            
            <Input type = 'Radio' Name ='rent_status' value= 'Including' 
            <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/>
            Including
               </td>
        </tr> 
		<tr><td width="128"> <label for="rent_month" id="rent_month">Rent Month</label></td>
		  <td width="355">
            <select name="rent_month" id="rent_month" >
                <option value="" name="rent_month" id="rent_month">-- Select One --</option>
                <option value="0" <? if($result[0]['rent_month']=='0') {?> selected="selected" <? } ?> >0</option>
                <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?> >1</option>
                <option value="2" <? if($result[0]['rent_month']=='2') {?> selected="selected" <? } ?> >2</option>
                <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?> >3</option>
                <option value="4" <? if($result[0]['rent_month']=='4') {?> selected="selected" <? } ?> >4</option>
                <option value="5" <? if($result[0]['rent_month']=='5') {?> selected="selected" <? } ?> >5</option>
                <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?> >6</option>
                <option value="7" <? if($result[0]['rent_month']=='7') {?> selected="selected" <? } ?> >7</option>
                <option value="8" <? if($result[0]['rent_month']=='8') {?> selected="selected" <? } ?> >8</option>
                <option value="9" <? if($result[0]['rent_month']=='9') {?> selected="selected" <? } ?> >9</option>
                <option value="10" <? if($result[0]['rent_month']=='10') {?> selected="selected" <? } ?> >10</option>
                <option value="11" <? if($result[0]['rent_month']=='11') {?> selected="selected" <? } ?> >11</option>
                <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?> >12</option>
            </select>
		  </td></tr>
 </table>
 
 <? } ?>
 
   <table  id="InNoTaxCase1"    style="width: 500px;display:none;border:1"  cellspacing="5" cellpadding="0">
		  <tr><td> <label for="price" id="lblDprice">Device Price</label></td><td> <input type="value" name="device_price_total1" id="TxtDPricecash" value="<?=$result[0]['device_price_total']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  /></td></tr>
            
			 
              <tr><td> <label for="rent" id="lblDRent">Rent</label></td>
			   <td> <input type="value" name="TxtDTotalREnt1" id="TxtDRentCash" value="<?=$result[0]['DTotalREnt']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td></tr> 
          
		 <tr>
            <td>
               <label for="rent_status" id="rent_status"> Rent status </label></td>
            <td>

			<Input type = 'Radio' Name ='rent_status' id="rent_status" value= 'Excluding' 
			<?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/>Excluding
            
            <Input type = 'Radio' Name ='rent_status' value= 'Including' 
            <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/>
            Including
               </td>
        </tr> 
		<tr><td width="128"> <label for="rent_month" id="rent_month">Rent Month</label></td>
		  <td width="355">
            <select name="rent_month" id="rent_month" >
                <option value="" name="rent_month" id="rent_month">-- Select One --</option>
                <option value="0" <? if($result[0]['rent_month']=='0') {?> selected="selected" <? } ?> >0</option>
                <option value="1" <? if($result[0]['rent_month']=='1') {?> selected="selected" <? } ?> >1</option>
                <option value="2" <? if($result[0]['rent_month']=='2') {?> selected="selected" <? } ?> >2</option>
                <option value="3" <? if($result[0]['rent_month']=='3') {?> selected="selected" <? } ?> >3</option>
                <option value="4" <? if($result[0]['rent_month']=='4') {?> selected="selected" <? } ?> >4</option>
                <option value="5" <? if($result[0]['rent_month']=='5') {?> selected="selected" <? } ?> >5</option>
                <option value="6" <? if($result[0]['rent_month']=='6') {?> selected="selected" <? } ?> >6</option>
                <option value="7" <? if($result[0]['rent_month']=='7') {?> selected="selected" <? } ?> >7</option>
                <option value="8" <? if($result[0]['rent_month']=='8') {?> selected="selected" <? } ?> >8</option>
                <option value="9" <? if($result[0]['rent_month']=='9') {?> selected="selected" <? } ?> >9</option>
                <option value="10" <? if($result[0]['rent_month']=='10') {?> selected="selected" <? } ?> >10</option>
                <option value="11" <? if($result[0]['rent_month']=='11') {?> selected="selected" <? } ?> >11</option>
                <option value="12" <? if($result[0]['rent_month']=='12') {?> selected="selected" <? } ?> >12</option>
            </select>
		  </td></tr>
 </table>
 
 
 
 </td></tr>
 
 
  <tr><td colspan="2">
<?php if($result[0]['mode_of_payment']=='Demo') {?>
  
 			     <table  id="Demo"    style="width:500px;border:1"  cellspacing="5" cellpadding="0">
		  <tr><td width="128"> <label for="demo" id="demo">Demo</label></td>
		  <td width="355">
            <select name="Demo" id="TxtDemo" >
                <option value="" name="Demo" id="TxtDemo">-- Select One --</option>
                <option value="1 week" <? if($result[0]['demo_time']=='1 week') {?> selected="selected" <? } ?> >1 week</option>
                <option value="2 week" <? if($result[0]['demo_time']=='2 week') {?> selected="selected" <? } ?> >2 week</option>
                <option value="3 week" <? if($result[0]['demo_time']=='3 week') {?> selected="selected" <? } ?> >3 week</option>
                <option value="4 week" <? if($result[0]['demo_time']=='4 week') {?> selected="selected" <? } ?> >4 week</option>
                <option value="5 week" <? if($result[0]['demo_time']=='5 week') {?> selected="selected" <? } ?> >5 week</option>
                <option value="6 week" <? if($result[0]['demo_time']=='6 week') {?> selected="selected" <? } ?> >6 week</option>
                <option value="7 week" <? if($result[0]['demo_time']=='7 week') {?> selected="selected" <? } ?> >7 week</option>
                <option value="8 week" <? if($result[0]['demo_time']=='8 week') {?> selected="selected" <? } ?> >8 week</option>
            </select>
		   
		   </td></tr>
            
			 
           
 </table>
 
 <? } ?>
 
   <table  id="Demo1"    style="width: 500px;display:none;border:1"  cellspacing="5" cellpadding="0">
		  <tr><td width="128"> <label for="demo" id="demo">Demo</label></td>
		  
		  <td width="355">
            <select name="Demo" id="TxtDemo" >
                <option value="" name="Demo" id="TxtDemo">-- Select One --</option>
                <option value="1 week" <? if($result[0]['demo_time']=='1 week') {?> selected="selected" <? } ?> >1 week</option>
                <option value="2 week" <? if($result[0]['demo_time']=='2 week') {?> selected="selected" <? } ?> >2 week</option>
                <option value="3 week" <? if($result[0]['demo_time']=='3 week') {?> selected="selected" <? } ?> >3 week</option>
                <option value="4 week" <? if($result[0]['demo_time']=='4 week') {?> selected="selected" <? } ?> >4 week</option>
                <option value="5 week" <? if($result[0]['demo_time']=='5 week') {?> selected="selected" <? } ?> >5 week</option>
                <option value="6 week" <? if($result[0]['demo_time']=='6 week') {?> selected="selected" <? } ?> >6 week</option>
                <option value="7 week" <? if($result[0]['demo_time']=='7 week') {?> selected="selected" <? } ?> >7 week</option>
                <option value="8 week" <? if($result[0]['demo_time']=='8 week') {?> selected="selected" <? } ?> >8 week</option>
            </select>
		  </td></tr>
        </table>
 
 
 
 </td></tr>
         <tr>
            <td>
               <label for="dimts" id="dimts">Dimts</label></td>
            <td>
			<select name="dimts" id="dimts" onchange="DimtsPayment(this.value)" >
			<option value="" id="dimts">-- select one --</option>
  
    			<option value="Yes" <? if($result[0]['dimts']=='Yes') {?> selected="selected" <? } ?> id="dimts">Yes</option>
            <option value="No" <? if($result[0]['dimts']=='No') {?> selected="selected" <? } ?> id="dimts">No</option>
		  </select>

			</td>
        </tr>
        <tr>
            <td colspan="2">
                <table id="DimtsCase"  style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="0">
              <tr>
                <td>
                   <label for="dimts_fee" id="dimts_fee">Dimts Fee status </label>
                </td>
                <td>
    
                <Input type = 'Radio' Name ='dimts_fee' id="dimts_fee" value= 'Excluding' 
    <?php if($result[0]['dimts_fee']=="Excluding"){echo "checked=\"checked\""; }?>/>Excluding
    
    <Input type = 'Radio' Name ='dimts_fee' value= 'Including' 
    <?php if($result[0]['dimts_fee']=="Including"){echo "checked=\"checked\""; }?>/>
    Including
                   </td>
                  </tr>
                 </table>
             </td>
        </tr>
        <tr>
            <td>
               <label for="Vehicle_Type" id="lblVehicleType">Vehicle Type</label></td>
            <td>
			<select name="vehicle_type" id="TxtVehicleType"  >
                <option value="" id="TxtVehicleType">-- select one --</option>
                <option value="Car" <? if($result[0]['vehicle_type']=='Car') {?> selected="selected" <? } ?> id="TxtVehicleType">Car</option>
                <option value="Bus" <? if($result[0]['vehicle_type']=='Bus') {?> selected="selected" <? } ?> id="TxtVehicleType">Bus</option>
                <option value="Truck" <? if($result[0]['vehicle_type']=='Truck') {?> selected="selected" <? } ?> id="TxtVehicleType"> Truck</option>
                <option value="Trailer" <? if($result[0]['vehicle_type']=='Trailer') {?> selected="selected" <? } ?> id="TxtVehicleType"> Trailer</option>
                <option value="Tempo" <? if($result[0]['vehicle_type']=='Tempo') {?> selected="selected" <? } ?> id="TxtVehicleType"> Tempo</option>
            
            </select>

			</td>
        </tr>
        <tr>
            <td>
               <label for="Imobillizer" id="lblImmobilizer">Immobilizer </label></td>
            <td>

			<Input type = 'Radio' Name ='immobilizer' id="TxtImmobilizer" value= 'Yes'
			<?php if($result[0]['immobilizer']=="Yes"){echo "checked=\"checked\""; }?>/>Yes
            
            <Input type = 'Radio' Name ='immobilizer' value= 'No'
            <?php if($result[0]['immobilizer']=="No"){echo "checked=\"checked\""; }?>/>
            No
               </td>
        </tr>
        <tr>
            <td>
               <label for="AC" id="lblACStatus">AC </label></td>
            <td>
<?
/*$male_status = 'unchecked';
$female_status = 'unchecked';

if (isset($_POST['Submit1'])) {

$selected_radio = $_POST['gender'];

if ($selected_radio = = 'male') {

$male_status = 'checked';

}
else if ($selected_radio = = 'female') {

$female_status = 'checked';

}

}*/

?>
			<Input type = 'Radio' Name ='ac_on_off'  id="TxtACStatus" value= 'on' <?php if($result[0]['ac_on_off']=="on"){echo "checked=\"checked\""; }?>/>

<?PHP //print $male_status; ?>
Yes

<Input type = 'Radio' Name ='ac_on_off' id="TxtACStatus"  value= 'off' <?php if($result[0]['ac_on_off']=="off"){echo "checked=\"checked\""; }?>/>

<?PHP //print $female_status; ?>
No
                 </td>
        </tr>
                <tr>
            <td>
               <label for="Account_Type" id="lblAccountType">Account Type</label></td>
            <td>
			<select name="account_type" id="TxtAccountType"  >
                <option value="" id="TxtAccountType">-- select one --</option>
                <option value="Leges" <? if($result[0]['account_type']=='Leges') {?> selected="selected" <? } ?> id="TxtAccountType">Leges</option>
                <option value="Paid" <? if($result[0]['account_type']=='Paid') {?> selected="selected" <? } ?> id="TxtAccountType">Paid</option>
                <option value="Demo" <? if($result[0]['account_type']=='Demo') {?> selected="selected" <? } ?> id="TxtAccountType"> Demo</option>
 			</select>
			</td>
        </tr>

        <tr>
            <td>
               <label for="Email_Id" id="lblEmailId">Email Id</label></td>
            <td>
                <input type="text" name="email_id" id="TxtEmailId" value="<?=$result[0]['email_id']?>" /></td>
        </tr>
		<tr>
            <td>
               <label for="user_name"  id="lblUserName">User Name</label></td>
            <td>
                <input type="text" name="user_name" id="TxtUserName" value="<?=$result[0]['user_name']?>"/></td>
        </tr>
        <tr>
            <td>
               <label for="user_Password"  id="lblUserPass"> Password</label></td>
            <td>
                <input type="text" name="user_password" id="TxtUserPass" value="<?=$result[0]['user_password']?>"/></td>
        </tr>
        <tr>
            <td class="style2"> Comment</td>
            <td><textarea rows="3" cols="25"  type="text" name="new_acc_salescomment" id="TxtNewSalesComment" ><?=$result[0]['new_acc_salescomment']?></textarea>
                </td>
        </tr>
		<?php 
		if($action=='edit') {
		?>
		 <tr>
            <td class="style2">
                Back Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><?=$result[0]['service_comment']?></textarea>
                </td>
        </tr>
		<?php } ?>
        <tr><td></td>
	   <td class="submit">
           <input id="Button1" type="submit" name="submit" value="submit" runat="server" />
		   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'accountcreation.php' " /></td>
		   </tr>
    </table>
	</form>
   </div>
 
<?php
include("../include/footer.php"); ?>


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