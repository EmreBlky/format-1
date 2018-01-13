<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
 


$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
	$result=mysql_fetch_array(mysql_query("select * from discount_details where id=$id"));	
	}
?> 

<div class="top-bar">
<h1>Discounting</h1>
</div>
<div class="table"> 

<?

for ($i=0; $i<count($_REQUEST['mode']);$i++) {
$month=implode(',',$_REQUEST['mode']);
 }
 
 if(isset($_POST["submit"]))
{
 
	
	
$date = $_POST["date"];
$account_manager = $_POST["account_manager"];
$main_user_id = $_POST["main_user_id"];
$company = $_POST["company"];
$tot_no_of_vehicles = $_POST["tot_no_of_vehicles"];
$discountFor = $_POST["discountFor"];
$DiscountMth = $month;
$TxtReason = $_POST["TxtReason"]; 
$Service_action = $_POST["Service_action"]; 
  $repair_comment = $_POST['repair_comment'];
  $payment_status=$_POST["payment_status"];
 $discount_repair_cost=$_POST["discount_repair_cost"];
  $discount_issue=$_POST["discount_issue"];

$number="";
$veh_for_discount=0;
for($j=0;$j<=$tot_no_of_vehicles;$j++)
	{
		if(isset($_POST[$j]))
			{
			$veh_for_discount++;
		$numbe1=(isset($_POST[$j])) ? trim($_POST[$j])  : "";
		$number .=$numbe1.",";
			}
	}
	   $veh_num=substr($number,0,-1);

if($number=="") {
$veh_num_edit=$result['reg_no'];
}
else {
$veh_num_edit=$veh_num;
}

if($veh_for_discount=="") {
$veh_for_discount_edit=$result['no_of_vehcile'];
}
else {
$veh_for_discount_edit=$veh_for_discount;
}



if($result['rent_device']=='Rent') {
$Discount_Amount = $_POST["discount_Amount_rent"]; 
$after_discount = $_POST["after_discount_rent"]; 
$before_discount = $_POST["before_discount_rent"]; 
}
elseif($result['rent_device']=='Device') {
$Discount_Amount = $_POST["discount_Amount_device"]; 
$after_discount = $_POST["after_discount_device"]; 
$before_discount = $_POST["before_discount_device"]; 
}
else {
$Discount_Amount = $_POST["discount_repair_cost"]; 
}
 if($action=='edit')
	{
	
	$query="update discount_details set date='".$date."',acc_manager='".$account_manager."',client='".$company."',user='".$main_user_id."',total_no_of_vehicles='".$tot_no_of_vehicles."',reason='".$TxtReason."',repair_comment='".$repair_comment."' where id=$id";
 
 
 
 $query;
 mysql_query($query);
echo "<script>document.location.href ='list_discounting.php'</script>";
	}
  
}
?>
<script type="text/javascript">
function validateForm()
{
 
 
  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
   if(document.myForm.DiscountMth.value=="")
  {
  alert("please Choose Discount Month") ;
  document.myForm.DiscountMth.focus();
  return false;
  }  
if(document.myForm.Discount_Amount.value=="")
  {
  alert("please Enter Discount Amount") ;
  document.myForm.Discount_Amount.focus();
  return false;
  }  
   if(document.myForm.after_discount.value=="")
  {
  alert("please Enter Amount After Discount") ;
  document.myForm.after_discount.focus();
  return false;
  }  
if(document.myForm.before_discount.value=="")
  {
  alert("please Enter Amount Before Discount") ;
  document.myForm.before_discount.focus();
  return false;
  }  
   var main_user_id=document.forms["myForm"]["TxtReason"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Enter Reason");
			  return false;
			  }
 
 var main_user_id=document.forms["myForm"]["Service_action"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Enter Service Action");
			  return false;
			  }
 

  
  }
  
  function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}

function calculatediscount(price)
{
   
document.getElementById('after_discount').value=document.getElementById('before_discount').value - document.getElementById('Discount_Amount').value;
//alert(result);

}

function RentDeviceDiv(radioValue)
{
	
	 
 if(radioValue=="Rent")
	{
	document.getElementById('sub3').style.display = "none";
	document.getElementById('sub1').style.display = "block";
     document.getElementById('sub4').style.display = "none";

	}
	else if(radioValue=="Device")
	{

	document.getElementById('sub3').style.display = "block";
	document.getElementById('sub1').style.display = "none";
	document.getElementById('sub4').style.display = "none";

	}
	else
	{
    document.getElementById('sub1').style.display = "none";
    document.getElementById('sub4').style.display = "block";
	document.getElementById('sub3').style.display = "none";
	
	} 
	
}



  </script>

 
    
 <form name="myForm" action="" onSubmit="return validateForm()" method="post">
 

    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

         <tr>
            <td width="233">Date</td>
            <td width="230">
           <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
        </tr>

		<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
        </tr>
               <tr>
            <td>
                Client User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id=mysql_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			while ($data=mysql_fetch_assoc($main_user_id))
					{
			?>
            
           <option name="main_user_id" value="<?=$data['user_id']?>" <? if($result['user']==$data['user_id']) {?> selected="selected" <? } ?> >
        <?php echo $data['name']; ?>
					</option>
				  <?php 
								} 
 
  ?>
</select>




                </td>
        </tr>


		 <tr>
            <td>
                Company Name</td>
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result['client']?>" readonly />
                </td>
        </tr>
 <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result['total_no_of_vehicles']?>" />            </td>
        </tr>
       <tr>
<td>
 Vehicle for discount</td>
<td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> <div id="ajaxdata">
<?=$result['reg_no']?>
</div> 

</td>
</tr>

		  <tr>
        <td>
        <label for="DtInstallation" id="lblDtInstallation">Discount For</label></td>
        <td>
        <input type="checkbox" name="discountFor" value="Rent" onChange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Rent"){echo "checked=\"checked\""; }?>>Rent<br>
<input type="checkbox" name="discountFor" value="Device" onChange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Device"){echo "checked=\"checked\""; }?>>Device
<br>
<input type="checkbox" name="discountFor" value="Repair Cost" onChange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Repair Cost"){echo "checked=\"checked\""; }?>>Repair Cost </td>
        </tr>
   </table>
   
  <div id="sub1" style="display:none">
<table width="550" border="0" align="center">
  <tr>
    <td width="82"><input type="checkbox" name="mode[]" id="1" value="Jan"  onClick="setVisibility('sub3', 'block');"; >Jan</td>
    <td width="82"><input type="checkbox" name="mode[]" id="2" value="Feb"  onClick="setVisibility('sub3', 'block');"; >Feb</td>
    <td width="82"><input type="checkbox" name="mode[]" id="3" value="Mar"  onClick="setVisibility('sub3', 'block');"; >Mar</td>
    <td width="82"><input type="checkbox" name="mode[]" id="4" value="Apr"  onClick="setVisibility('sub3', 'block');"; >Apr</td>
    <td width="82"><input type="checkbox" name="mode[]" id="5" value="May"  onClick="setVisibility('sub3', 'block');"; >May</td>
    <td width="82"><input type="checkbox" name="mode[]" id="6" value="Jun"  onClick="setVisibility('sub3', 'block');"; >Jun</td>
		 
   
  </tr>
  <tr>
	<td><input type="checkbox" name="mode[]" id="7" value="Jul"  onClick="setVisibility('sub3', 'block');"; >Jul</td>
	<td><input type="checkbox" name="mode[]" id="8" value="Aug"  onClick="setVisibility('sub3', 'block');"; >Aug</td>
	<td><input type="checkbox" name="mode[]" id="9" value="Sep"  onClick="setVisibility('sub3', 'block');"; >Sep</td>
	<td><input type="checkbox" name="mode[]" id="10" value="Oct"  onClick="setVisibility('sub3', 'block');"; >Oct</td>
	<td><input type="checkbox" name="mode[]" id="11" value="Nov"  onClick="setVisibility('sub3', 'block');"; >Nov</td>
	<td><input type="checkbox" name="mode[]" id="12" value="Dec"  onClick="setVisibility('sub3', 'block');"; >Dec</td>
  </tr>
</table></div>


 <div id="sub2" style="display:none">

<table width="36%" border="0" cellpadding="0" cellspacing="" align="center">
<tr>
            <td class="style2">
                Amount before discount</td>
            <td>
              <div align="left">
                <input type="text" name="before_discount_rent" id="before_discount_rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
               </div></td>
        </tr>
<tr>
            <td width="50%" class="style2">
                Discounted Amount</td>
    <td width="50%">
      <div align="left">
        <input type="text" name="discount_Amount_rent" id="Discount_Amount_rent_rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onBlur="calculatediscount(this.value);"/>
    </div></td>
  </tr>
        
           <tr>
            <td class="style2">
               Amount received after discount</td>
            <td>
              <div align="left">
                <input type="text" name="after_discount_rent" id="after_discount_rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  />
               </div></td>
        </tr>
        
           
</table>

</div> 
 

<div id="sub4" style="display:none">

<table width="36%" border="0" cellpadding="0" cellspacing="" align="center">
            <td width="50%" class="style2">
                Discount for Reapir Cost</td>
    <td width="50%">
      <div align="left">
        <input type="text" name="discount_repair_cost" id="discount_repair_cost"/>
    </div></td>
  </tr>
   
</table>

</div> 
   
   <div id="sub3" style="display:none">
<table width="36%" border="0" cellpadding="0" cellspacing="" align="center">
<tr>
            <td class="style2">
                Amount before discount
</td>
            <td><input type="text" name="before_discount_device" id="before_discount_device"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
             </td>
        </tr>
<tr>
            <td width="50%" class="style2">
                Discounted Amount</td>
            <td width="50%"><input type="text" name="discount_Amount_device" id="Discount_Amount_device" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onBlur="calculatediscount(this.value);"/>
    </td>
  </tr>
        
           <tr>
            <td class="style2">
               Amount received after discount
</td>
            <td><input type="text" name="after_discount_device" id="after_discount_device" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
             </td>
        </tr>
        
           
    
</table>

</div>
   
   
   
   
        <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5"> 
		
       <tr>
	    <td>
       Issue for Discounting</td><td>
		<select name="discount_issue" id="discount_issue" >
  <option value="" name="discount_issue" id="discount_issue">-- Select One --</option>
 <option value="Software Issue" <? if($result['discount_issue']=='Software Issue') {?> selected="selected" <? } ?> >Software Issue</option>
  <option value="Service Issue" <? if($result['discount_issue']=='Service Issue') {?> selected="selected" <? } ?> >Service Issue</option>
      <option value="Repair Cost Issue" <? if($result['discount_issue']=='Repair Cost Issue') {?> selected="selected" <? } ?> >Repair Cost Issue</option>
  <option value="Client Side Issue" <? if($result['discount_issue']=='Client Side Issue') {?> selected="selected" <? } ?> >Client Side Issue</option>
   
</select>
</td>
</tr>
        <tr>
            <td width="232" class="style3">
                Reason</td>
            <td width="231">
			 <textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result['reason']?></textarea>
			
          </td>
        </tr>
        
        
             
   <tr>
            <td class="style2">
                Repair Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="repair_comment" id="Txtrepair_comment" ><?=$result['repair_comment']?></textarea>
                </td>
        </tr>
		
        <tr><td></td>
        <td class="submit"><input type="submit" name="submit" id="button1" value="submit" onClick="return Check();"/>
	      <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_discounting.php' " /></td>

        </tr>
    </table>
	</div>
</form>
 
  
 