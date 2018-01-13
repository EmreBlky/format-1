<?php
include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");

if($_SESSION['user_name']=='jaipurrequest') {
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");
}
else{
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service_support.php");
} 


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
	if($month=="") {
	$DiscountMth=$result['mon_of_dis_in_case_of_rent'];
	}
	else {
	$DiscountMth = $month;
	}
	$TxtReason = $_POST["TxtReason"]; 
	$Service_action = $_POST["Service_action"]; 
	$sales_comment = $_POST['sales_comment'];
	$payment_status=$_POST["payment_status"];
	
	$sales_manager=$_POST["sales_manager"];
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
	$veh_for_discount_edit=$_POST['no_veh'];
	/*if($veh_for_discount=="") {no_veh
	$veh_for_discount_edit=$result['no_of_vehcile'];
	}
	else {
	$veh_for_discount_edit=$veh_for_discount;
	}*/


	if($discountFor == 'Rent') {
		 $Discount_Amount = $_POST["discount_Amount_rent"]; 
		 $after_discount = $_POST["after_discount_rent"]; 
		 $before_discount = $_POST["before_discount_rent"]; 
	}
	elseif($discountFor == 'Device') {
		 $Discount_Amount = $_POST["discount_Amount_device"]; 
		 $after_discount = $_POST["after_discount_device"]; 
		 $before_discount = $_POST["before_discount_device"]; 
	}
	else {
		$Discount_Amount=$_POST["discount_repair_cost"];
	}

 if($action=='edit')
	{
	
	 $query="update discount_details set acc_manager='".$account_manager."',sales_manager='".$sales_manager."',client='".$company."',user='".$main_user_id."',total_no_of_vehicles='".$tot_no_of_vehicles."',rent_device='".$discountFor."',mon_of_dis_in_case_of_rent='".$DiscountMth."' ,dis_amt='".$Discount_Amount."',reason='".$TxtReason."',amt_rec_after_dis='".$after_discount."',sales_comment='".$result["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."',amt_before_dis='".$before_discount."',reg_no='".$veh_num_edit."',no_of_vehicle='".$veh_for_discount_edit."',discount_issue='".$discount_issue."',discount_status=1 where id=$id";
 
 mysql_query($query);
echo "<script>document.location.href ='list_discounting.php'</script>";
	}
  else
  {

      $query="INSERT INTO `discount_details` (`date`, `acc_manager`, `sales_manager`,`client`, `user`, `total_no_of_vehicles`,reg_no,no_of_vehicle, `rent_device`, `mon_of_dis_in_case_of_rent`, `dis_amt`, `reason`, `amt_rec_after_dis`, `amt_before_dis`, `service_action`,discount_issue) VALUES ('".$date."','".$account_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$veh_num."','".$veh_for_discount."','".$discountFor."','".$DiscountMth."','".$Discount_Amount."','".$TxtReason."','".$after_discount."','".$before_discount."','".$Service_action."','".$discount_issue."')";
 
 mysql_query($query);
 echo "<script>document.location.href = 'list_discounting.php'</script>";
//@header('location: sales_request.php');
}
}
?>
<script type="text/javascript">
function validateForm()
{
	if(document.myForm.sales_manager.value=="")
	{
		alert("please Select Sales Person Name") ;
		document.myForm.sales_manager.focus();
		return false;
	}
	if(document.myForm.TxtMainUserId.value=="")
	{
		alert("please Select Client Name") ;
		document.myForm.TxtMainUserId.focus();
		return false;
	}
	if(document.getElementById('rent_id').checked == false && document.getElementById('device_id').checked == false && document.getElementById('repair_cost_id').checked == false)
	{
		alert("please Select Discount For");
		return false;
	}
	if(document.getElementById('rent_id').checked == true)
	{
		if(document.myForm.before_discount_rent.value=="")
		{
			alert("please Enter Amount before discount");
			return false;
		}
		if(document.myForm.discount_amount_rent.value=="")
		{
			alert("please Enter Discounted Amount");
			return false;
		}
	}
	if(document.getElementById('device_id').checked == true)
	{
		if(document.myForm.before_discount_device.value=="")
		{
			alert("please Enter Amount before discount");
			return false;
		}
		if(document.myForm.Discount_Amount_device.value=="")
		{
			alert("please Enter Discounted Amount");
			return false;
		}
	}
	if(document.getElementById('repair_cost_id').checked == true)
	{
		if(document.myForm.discount_repair_cost.value=="")
		{
			alert("please Enter Discount for Reapir Cost");
			return false;
		}
	}
	if(document.myForm.discount_issue.value=="")
	{
		alert("please Select Discounting Issue") ;
		document.myForm.discount_issue.focus();
		return false;
	}  
	var reason=document.forms["myForm"]["TxtReason"].value;
	if (reason==null || reason=="")
	{
		alert("Enter Reason");
		return false;
	}  
  var sales_comment=document.forms["myForm"]["TxtSalesComment"].value;
	if (sales_comment==null || sales_comment=="")
	{
		alert("Enter Sales Comment");
		return false;
	} 
  
}
  
function setVisibility(id, visibility) {
	document.getElementById(id).style.display = visibility;
}

function calculatediscount(price)
{
	document.getElementById('after_discount_rent').value=document.getElementById('before_discount_rent').value - document.getElementById('discount_amount_rent').value;
	//alert(result);
}
function calculatediscount1(price)
{
	document.getElementById('after_discount_device').value=document.getElementById('before_discount_device').value - document.getElementById('Discount_Amount_device').value;
	//alert(result);
}

function RentDeviceDiv(radioValue)
{
	
	 
 if(radioValue=="Rent")
	{
	document.getElementById('sub3').style.display = "none";
	document.getElementById('sub1').style.display = "block";
	document.getElementById('sub2').style.display = "block";
    document.getElementById('sub4').style.display = "none";

	}
	else if(radioValue=="Device")
	{

	document.getElementById('sub3').style.display = "block";
	document.getElementById('sub1').style.display = "none";
	document.getElementById('sub2').style.display = "none";
	document.getElementById('sub4').style.display = "none";

	}
	else
	{
    document.getElementById('sub1').style.display = "none";
    document.getElementById('sub4').style.display = "block";
	document.getElementById('sub2').style.display = "none";
	document.getElementById('sub3').style.display = "none";
	
	} 
	
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
        </tr> <?php 
		//if($_SESSION['user_name']=='saleslogin') {
		?>
		<tr>
            <td>Sales Manager</td>
            <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
              <?php
        $sales_manager=mysql_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
        while ($data=mysql_fetch_assoc($sales_manager))
        {
        ?>
        
        <option name="sales_manager" value="<?=$data['name']?>" <? if($result['sales_manager']==$data['name']) {?> selected="selected" <? } ?> >
        <?php echo $data['name']; ?>
        </option>
        <?php 
        } 
        ?>
          
            </select> 
            </td>
        </tr>
		<?php //} ?>
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
            <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result['total_no_of_vehicles']?>" />            
            	<input type="hidden" name="no_veh" id="Txtno_veh" value="<?=$result['no_of_vehicle']?>" />
            </td>
        </tr>
       <tr>
<td>
 Vehicle for discount</td>
<td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 
<div id="ajaxdata"><?=$result['reg_no']?></div> 

</td>
</tr>

		  <tr>
        <td>
        	<label for="DtInstallation" id="lblDtInstallation">Discount For</label>
        </td>
        <td>
            <input type="radio" name="discountFor" id="rent_id" value="Rent" onchange="RentDeviceDiv(this.value)" <?php if($result['rent_device']=="Rent"){echo "checked=\"checked\""; }?>/>Rent 
            <input type="radio" name="discountFor" id="device_id" value="Device" onchange="RentDeviceDiv(this.value)" <?php if($result['rent_device']=="Device"){echo "checked=\"checked\""; }?>/>Device
            <input type="radio" name="discountFor" id="repair_cost_id" value="Repair Cost" onchange="RentDeviceDiv(this.value)" <?php if($result['rent_device']=="Repair Cost"){echo "checked=\"checked\""; }?>/>Repair Cost
        </td>
        <!--<td>
        <input type="checkbox" name="discountFor" value="Rent" id="rent_id" onchange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Rent"){echo "checked=\"checked\""; }?>>Rent<br>
<input type="checkbox" name="discountFor" value="Device" id="device_id" onchange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Device"){echo "checked=\"checked\""; }?>>Device
<br>
<input type="checkbox" name="discountFor" value="Repair Cost" id="repair_cost_id" onchange="RentDeviceDiv(this.value)"  <?php if($result['rent_device']=="Repair Cost"){echo "checked=\"checked\""; }?>>Repair Cost </td>-->
        </tr>
   </table>
   
  <div id="sub1" style="display:none">
<table width="550" border="0" align="center">
  <tr>
    <td width="82"><input type="checkbox" name="mode[]" id="1" value="Jan"  onClick="setVisibility('sub2', 'block');"; >Jan</td>
    <td width="82"><input type="checkbox" name="mode[]" id="2" value="Feb"  onClick="setVisibility('sub2', 'block');"; >Feb</td>
    <td width="82"><input type="checkbox" name="mode[]" id="3" value="Mar"  onClick="setVisibility('sub2', 'block');"; >Mar</td>
    <td width="82"><input type="checkbox" name="mode[]" id="4" value="Apr"  onClick="setVisibility('sub2', 'block');"; >Apr</td>
    <td width="82"><input type="checkbox" name="mode[]" id="5" value="May"  onClick="setVisibility('sub2', 'block');"; >May</td>
    <td width="82"><input type="checkbox" name="mode[]" id="6" value="Jun"  onClick="setVisibility('sub2', 'block');"; >Jun</td>
		 
   
  </tr>
  <tr>
	<td><input type="checkbox" name="mode[]" id="7" value="Jul"  onClick="setVisibility('sub2', 'block');"; >Jul</td>
	<td><input type="checkbox" name="mode[]" id="8" value="Aug"  onClick="setVisibility('sub2', 'block');"; >Aug</td>
	<td><input type="checkbox" name="mode[]" id="9" value="Sep"  onClick="setVisibility('sub2', 'block');"; >Sep</td>
	<td><input type="checkbox" name="mode[]" id="10" value="Oct"  onClick="setVisibility('sub2', 'block');"; >Oct</td>
	<td><input type="checkbox" name="mode[]" id="11" value="Nov"  onClick="setVisibility('sub2', 'block');"; >Nov</td>
	<td><input type="checkbox" name="mode[]" id="12" value="Dec"  onClick="setVisibility('sub2', 'block');"; >Dec</td>
  </tr>
</table></div>


 <div id="sub2" style="display:none">

<table width="36%" border="0" cellpadding="0" cellspacing="" align="center">
<tr>
            <td class="style2">
                Amount before discount</td>
            <td>
              <div align="left">
                <input type="text" name="before_discount_rent" id="before_discount_rent" value="<?=$result['amt_before_dis']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
               </div></td>
        </tr>
<tr>
            <td width="50%" class="style2">
                Discounted Amount</td>
    <td width="50%">
      <div align="left">
        <input type="text" name="discount_Amount_rent" id="discount_amount_rent" value="<?=$result['dis_amt']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onblur="calculatediscount(this.value);"/>
    </div></td>
  </tr>
        
           <tr>
            <td class="style2">
               Amount received after discount</td>
            <td>
              <div align="left">
                <input type="text" name="after_discount_rent" id="after_discount_rent" value="<?=$result['amt_rec_after_dis']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  />
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
        <input type="text" name="discount_repair_cost" id="discount_repair_cost" value="<?=$result['dis_amt']?>"/>
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
            <td><input type="text" name="before_discount_device" id="before_discount_device" value="<?=$result['amt_before_dis']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
             </td>
        </tr>
<tr>
            <td width="50%" class="style2">
                Discounted Amount</td>
            <td width="50%"><input type="text" name="discount_Amount_device" id="Discount_Amount_device" value="<?=$result['dis_amt']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onblur="calculatediscount1(this.value);"/>
    </td>
  </tr>
        
           <tr>
            <td class="style2">
               Amount received after discount
</td>
            <td><input type="text" name="after_discount_device" id="after_discount_device" value="<?=$result['amt_rec_after_dis']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
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
            <option value="Account Issue" <? if($result['discount_issue']=='Account Issue') {?> selected="selected" <? } ?> >Account Issue</option>
            <option value="Client Side Issue" <? if($result['discount_issue']=='Client Side Issue') {?> selected="selected" <? } ?> >Client Side Issue</option>
            <option value="Device On Demo" <? if($result['discount_issue']=='Device On Demo') {?> selected="selected" <? } ?> >Device On Demo</option>
   
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
        
             
    <?php 
		if($action=='edit') {
		?>
		 <tr>
            <td class="style2">
                Sales Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="sales_comment" id="TxtSalesComment" ><? //$result['sales_comment']?></textarea>
                </td>
        </tr>
		<?php } ?>
       
        <tr><td></td>
        <td class="submit"><input type="submit" name="submit" id="button1" value="submit" onclick="return Check();"/>
	      <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_discounting.php' " /></td>

        </tr>
    </table>
</form>
</div>
  
 <?php
include("include/footer.php"); ?>