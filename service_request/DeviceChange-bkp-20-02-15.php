<?php

include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");

include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");

 

$action=$_GET['action'];

$id=$_GET['id'];

$page=$_POST['page'];

if($action=='edit' or $action=='editp')

	{

	$result=mysql_fetch_array(mysql_query("select * from device_change where id=$id"));	

	}

?> 



<div class="top-bar">

<h1>Device Change</h1>

</div>

<div class="table"> 

<?php

$billing_amt=0;

$reason=0;



if(isset($_POST["submit"]))

{ 

$date=$_POST["date"];

$acc_manager=$_POST["account_manager"];

$client=$_POST["company"];

$user_id=$_POST["main_user_id"];

$device_model=$_POST["Device_model"];

$veh_reg=$_POST["veh_reg"];

$device_imei=$_POST["TxtDeviceIMEI"];

$Devicemobile=$_POST["Devicemobile"]; 

$date_of_install=$_POST["date_of_install"]; 

$Device_type=$_POST["Device_type"];



$rdd_device_model=$_POST["rdd_device_model"];

 

$rdd_device_imei=$_POST["rdd_device_imei"];

$rdd_device_id=$_POST["device_id"];

$rdddevice_imei=$_POST["device_imei"];

$rddDevicemobile=$_POST["rddDevicemobile"];

 

$replace_user_id=$_POST["replace_user_id"];

$ReplaceCompany=$_POST["ReplaceCompany"];

$replaceDevice_model=$_POST["replaceDevice_model"];

$replaceDeviceIMEI=$_POST["replaceDeviceIMEI"]; 

//$ReplaceCompany=$_POST["replaceDevicemobile"];

 $replaceDevicemobile=$_POST["replaceDevicemobile"];

 $replacedate_of_install=$_POST["replacedate_of_install"];

 

 $veh_reg_replce=$_POST["veh_reg_replce"];

$TxtReason=$_POST["TxtReason"];

$Txtrdd_date=$_POST["rdd_date"];

    $sales_manager=$_POST["sales_manager"];  



$billing=$_POST["billing"];

$payment_status=$_POST["payment_status"];

$billing1=$_POST["billing1"];



if($Device_type=='New') {

	$billing_amount=$_POST["billing_amount_new"];

}



else if($Device_type=='Old') {

	$billing_amount=$_POST["billing_amount_old"];



}



$service_comment=$_POST["service_comment"];



 if($veh_reg=="") {

$veh_reg_edit=$result['reg_no'];

}

else {

$veh_reg_edit=$veh_reg;

}



 if($veh_reg_replce=="") {

$veh_reg_replce_edit=$result['rdd_reg_no'];

}

else {

$veh_reg_replce_edit=$veh_reg_replce;

}





if($action=='edit')

	{

	

	if($Device_type=="New")

 {  

	$query="update device_change set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',device_model='".$device_model."',device_imei='".$device_imei."',reg_no='".$veh_reg_edit."',date_of_install='".$date_of_install."',mobile_no='".$Devicemobile."',rdd_device_model='".$rdd_device_model."',rdd_device_id='".$rdd_device_id."',rdd_device_imei='".$rdd_device_imei."',rdd_device_type='".$Device_type."',rdd_date='".$Txtrdd_date."',rdd_reason='".$TxtReason."',billing='".$billing."',billing_amount='".$billing_amount."' where id=$id";

 

 }

 else

 {  

 

 $query="update device_change set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',device_model='".$device_model."',device_imei='".$device_imei."',reg_no='".$veh_reg_edit."',date_of_install='".$date_of_install."',mobile_no='".$Devicemobile."',rdd_device_type='".$Device_type."',rdd_username='".$replace_user_id."',rdd_companyname='".$ReplaceCompany."',rdd_device_model='".$replaceDevice_model."',rdd_device_imei='".$replaceDeviceIMEI."',rdd_reg_no='".$veh_reg_replce_edit."',rdd_device_mobile_num='".$replaceDevicemobile."',rdd_date_replace='".$replacedate_of_install."',rdd_date='".$Txtrdd_date."',rdd_reason='".$TxtReason."',billing='".$billing1."',billing_amount='".$billing_amount."' where id=$id";

 }

 $query;

 mysql_query($query);

echo "<script>document.location.href ='list_device_change.php'</script>";

	}

  else

  {



 if($Device_type=="New")

 { 

  $query="INSERT INTO `device_change` (`date`,acc_manager, `sales_manager`, `client`, `user_id`, `device_model`, `device_imei`, `reg_no`, `date_of_install`, `mobile_no`, `rdd_device_model`, `rdd_device_imei`,`rdd_device_id`,`rdd_date`, `rdd_reason`,`rdd_device_type`,billing,billing_amount) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$device_model."','".$device_imei."','".$veh_reg."','".$date_of_install."','".$Devicemobile."','".$rdd_device_model."','".$rdd_device_imei."','".$rdd_device_id."','".$Txtrdd_date."','".$TxtReason."','".$Device_type."','".$billing."','".$billing_amount."')";

 

 }

 else

 {  

 $query="INSERT INTO `device_change` (`date`, acc_manager,`sales_manager`, `client`, `user_id`, `device_model`, `device_imei`, `reg_no`, `date_of_install`, `mobile_no`, `rdd_username`, `rdd_companyname`, `rdd_device_model`, `rdd_device_imei`, `rdd_reg_no`,`rdd_device_mobile_num`,`rdd_date_replace`,`rdd_date`, `rdd_reason`,rdd_device_type,billing,billing_amount) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$device_model."','".$device_imei."','".$veh_reg."','".$date_of_install."','".$Devicemobile."','".$replace_user_id."','".$ReplaceCompany."','".$replaceDevice_model."','".$replaceDeviceIMEI."','".$veh_reg_replce."','".$replaceDevicemobile."','".$replacedate_of_install."','".$Txtrdd_date."','".$TxtReason."','".$Device_type."','".$billing1."','".$billing_amount."')";

 }

 



 mysql_query($query);

//echo "record saved";

 echo "<script>document.location.href ='list_device_change.php'</script>";

}

}





?>





 

    

	

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	  <script>

$(function() {

$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });



$( "#datepickercheque" ).datepicker({ dateFormat: "yy-mm-dd" });



});



function NewOldDeviceDiv(radioValue)

{

	

	 

 if(radioValue=="New")

	{

	document.getElementById('NewDevice').style.display = "block";

	document.getElementById('OldDevice').style.display = "none";

	document.getElementById('NewDevice1').style.display = "none";

	document.getElementById('OldDevice1').style.display = "none";



	}

	else if(radioValue=="Old")

	{

	document.getElementById('NewDevice').style.display = "none";

	document.getElementById('OldDevice').style.display = "block";

	document.getElementById('NewDevice1').style.display = "none";

	document.getElementById('OldDevice1').style.display = "none";

	}

	else

	{

	document.getElementById('NewDevice').style.display = "none";

	document.getElementById('OldDevice').style.display = "none";

	document.getElementById('NewDevice1').style.display = "none";

	document.getElementById('OldDevice1').style.display = "none";

	} 

	

}







function validateForm()

{

 

 

  if(document.myForm.TxtMainUserId.value=="")

  {

  alert("please choose Client Name") ;

  document.myForm.TxtMainUserId.focus();

  return false;

  }  

  

 if(document.myForm.Device_type.value=="")

  {

  alert("please Enter Replace With") ;

  document.myForm.Device_type.focus();

  return false;

  }

  

 if(document.myForm.Device_type.value=="New")

 {

	  

	  if(document.myForm.rdd_device_model.value=="")

	  {

	  alert("please Enter New Device Model") ;

	  document.myForm.rdd_device_model.focus();

	  return false;

	  }

	  if(document.myForm.TxtDModelNo.value=="")

	  {

	  alert("please Enter New Device Id") ;

	  document.myForm.TxtDModelNo.focus();

	  return false;

	  }

	  if(document.myForm.rdd_device_imei.value=="")

	  {

	  alert("please Enter New Device Imei") ;

	  document.myForm.rdd_device_imei.focus();

	  return false;

	  }

	  var billing_chk = document.myForm.billing[0].checked;

	  var billing_chk1 = document.myForm.billing[1].checked;

	  if(billing_chk  == false && billing_chk1  == false)

	  {

	     alert("please Select Billing");

	     return false;

	   }

	  if(billing_chk  == true && document.myForm.billing_amount.value=="")

	  {

	     alert("please Enter New Device Amount");

		 document.myForm.billing_amount.focus();

	     return false;

	   }

	  /*if(document.myForm.rddDevicemobile.value=="")

	  {

	  alert("please Enter Mobile No.") ;

	  document.myForm.rddDevicemobile.focus();

	  return false;

	  }

	  var rddDevicemobile=document.myForm.rddDevicemobile.value;

	  if(rddDevicemobile!="")

		{

		var length=rddDevicemobile.length;

		

			if(length < 9 || length > 15 || rddDevicemobile.search(/[^0-9\-()+]/g) != -1 )

			{

				alert('Please enter valid mobile number');

				document.myForm.rddDevicemobile.focus();

				document.myForm.rddDevicemobile.value="";

				return false;

			}

		}*/



 }



 else if(document.myForm.Device_type.value=="Old")

 { 

  	 if(document.myForm.replace_user_id.value=="")

		{

		alert("please Enter User Name") ;

		document.myForm.replace_user_id.focus();

		return false;

		}

	 if(document.myForm.replaceDevice_model.value=="")

	  {

	  alert("please Enter Device Model") ;

	  document.myForm.replaceDevice_model.focus();

	  return false;

	  }	

	 var billing1_chk = document.myForm.billing1[0].checked;

	  var billing1_chk1 = document.myForm.billing1[1].checked;

	  if(billing1_chk  == false && billing1_chk1  == false)

	  {

	     alert("please Select Billing");

	     return false;

	   }

	  if(billing1_chk  == true && document.myForm.billing_amount1.value=="")

	  {

	     alert("please Enter Device Amount");

		 document.myForm.billing_amount1.focus();

	     return false;

	   }	

		

 }	

	

	if(document.myForm.rdd_date.value=="")

	{

	alert("please Enter Date") ;

	document.myForm.rdd_date.focus();

	return false;

	}

	if(document.myForm.TxtReason.value=="")

	{

	alert("please Enter Reason") ;

	document.myForm.TxtReason.focus();

	return false;

	}

}



 function StatusValue(radioValue)

	{

	 if(radioValue=="Yes")

		{

		document.getElementById('amount_show').style.display = "block";

		document.getElementById('amount_show1').style.display = "none";

	

		}

		else if(radioValue=="No")

		{

	

		document.getElementById('amount_show').style.display = "none";

		document.getElementById('amount_show1').style.display = "none";

		}

		else

		{

		document.getElementById('amount_show').style.display = "none";

		document.getElementById('amount_show1').style.display = "none";

		} 

		

	} 

function Status_old(radioValue)

{

 if(radioValue=="Yes")

	{

	document.getElementById('No').style.display = "block";

	document.getElementById('No1').style.display = "none";



	}

	else if(radioValue=="No")

	{



	document.getElementById('No').style.display = "none";

	document.getElementById('No1').style.display = "none";

	}

	else

	{

	document.getElementById('No1').style.display = "none";

	document.getElementById('No').style.display = "none";

	} 

	

}

      </script> 

 <form name="myForm" action="" onsubmit="return validateForm()" method="post">

 



   <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">



         <tr>

            <td>Date</td>

            <td>

                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>

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

        <tr>

        <td>

        Client User Name</td>

        <td> 

         

        <select name="main_user_id" id="TxtMainUserId"  onchange="

        showUser(this.value,'ajaxdata'); 

        getCompanyName(this.value,'TxtCompany');">

        <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>

        <?php

        $main_user_id=mysql_query("SELECT id as user_id, sys_username as name FROM matrix.users where sys_active=1 order by name asc");

        while ($data=mysql_fetch_assoc($main_user_id))

        {

        ?>

        

        <option name="main_user_id" value="<?=$data['user_id']?>" <? if($result['user_id']==$data['user_id']) {?> selected="selected" <? } ?> >

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

        Registration No</td>

        <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 

        <div id="ajaxdata">

        <?=$result['reg_no']?>

        </div> 

        

        </td>

        </tr>

        <tr>

        <td>

        

        <label for="DeviceMOdel" id="lblDeviceModel">Device Model</label></td>

        <td>

        <select name="Device_model" id="Device_model">

        <option value=""  >-- Select One --</option>

        <?php

        $main_user_id=mysql_query("SELECT * FROM matrix.`device_type`");

        while ($data=mysql_fetch_assoc($main_user_id))

        {

        ?>

        

         

            <option value ="<?php echo $data['device_type'] ?>" <? if($result['device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 

            <?php echo $data['device_type']; ?>

            </option>

        <?php 

        } 

        

        ?>

        </select></td>

        </tr>

        <tr>

        <td>

        <label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>

        <td>

        <input type="text" name="TxtDeviceIMEI" id="TxtDeviceIMEI"  value="<?=$result['device_imei']?>" readonly/></td>

        </tr>

        

        <tr>

        <td>

        <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>

        <td>

        <input type="text" name="Devicemobile" id="Devicemobile"  value="<?=$result['mobile_no']?>" readonly/></td>

        </tr>

       

        <tr>

        <td>

        <label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>

        <td>

        <input type="text" name="date_of_install" id="date_of_install"  value="<?=$result['date_of_install']?>" readonly/></td>

        </tr>

         



        

         

            <tr>

            <td><h2>Replaced Device Detail</h2></td>

			<td></td>

            </tr>

            

             <tr>

            <td>Replace with</td>

			<td><select name="Device_type" id="Device_type" onchange="NewOldDeviceDiv(this.value)" >

            <option value="" >-- select one --</option>

            

            <option value="New" <? if($result['rdd_device_type']=='New') {?> selected="selected" <? } ?> > New Device</option>

            <option value="Old" <? if($result['rdd_device_type']=='Old') {?> selected="selected" <? } ?> > Old Device</option>

            

            </select> 

            </td>

            </tr>

			

           

            <tr><td colspan="2" align="right">



		

            	<?php if($result['rdd_device_type']=='New'){ ?>

				

            <table  id="NewDevice1" align="center" style="width: 500px; border:1"  cellspacing="5" cellpadding="5">

            <tr>

            <td> <label id="lblDmodel">Device Model</label></td>

			<td>  <select name="rdd_device_model" id="rdd_device_model">

            <option value="" >-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT * FROM matrix.`device_type`");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

           

            <option value ="<?php echo $data['device_type'] ?>" <? if($result['rdd_device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 

            <?php echo $data['device_type']; ?>

            </option>

            <?php 

            } 

            

            ?>

            </select></td>

			</tr>

            

            <tr>

            <td> <label id="lblDmodel">Device Id</label></td>

			<td> <input type="text" name="device_id" id="TxtDModelNo" value="<?=$result['rdd_device_id']?>" /></td>

			</tr>

            

			<tr>

            <td> <label id="lblDmodel">Device IMEI</label></td>

			<td> <input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result['rdd_device_imei']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>

			</tr>

            <tr>

                <td class="style2">

                    Billing</td>

                <td>

                

                 <Input type = 'Radio' Name ='billing' id="billing"    value= 'Yes' <?php if($result['billing']=="Yes"){echo "checked=\"checked\""; }?>

                onchange="StatusValue(this.value)"

                >Yes

                

                <Input type = 'Radio' Name ='billing' id="billing"   value= 'No' <?php if($result['billing']=="No"){echo "checked=\"checked\""; }?>

                onchange="StatusValue(this.value)"

                >No</td>

            </tr>

            <tr><td colspan="2">

			<?php if($result['billing']=='Yes') { ?>

		 	<table  id="amount_show1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">



                <tr>

                      <td> <label  id="lbDlAmount">Amount</label></td>

                      <td> <input type="text" name="billing_amount_new" id="billing_amount" value="<?=$result['billing_amount']?>" /></td>

                </tr>

            </table>

		<? } ?>

		

		  <table  id="amount_show" align="left" style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">



            	<tr>

        			<td> <label  id="lbDlAmount">Amount</label></td>

                    <td> <input type="text" name="billing_amount_new" id="billing_amount" value="<?=$result['billing_amount']?>" /></td>

               </tr>

            </table>

            </td>

          </tr>

            

        </table>

		   <? } ?>

		   

		   

		   

		 <table  id="NewDevice" align="center" style="width: 500px;display:none;border:1"  cellspacing="5" cellpadding="5">

            <tr>

            <td> <label id="lblDmodel">Device Model</label></td>

			<td>  <select name="rdd_device_model" id="rdd_device_model">

            <option value="" >-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT * FROM matrix.`device_type`");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

           

            <option value ="<?php echo $data['device_type'] ?>" <? if($result['rdd_device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 

            <?php echo $data['device_type']; ?>

            </option>

            <?php 

            } 

            

            ?>

            </select></td>

			</tr>

            

            <tr>

            <td> <label id="lblDmodel">Device Id</label></td>

			<td> <input type="text" name="device_id" id="TxtDModelNo" value="<?=$result['rdd_device_id']?>" /></td>

			</tr>

            

			<tr>

            <td> <label id="lblDmodel">Device IMEI</label></td>

			<td> <input type="text" name="rdd_device_imei" id="rdd_device_imei" value="<?=$result['rdd_device_imei']?>"/></td>

			</tr>

             <tr>

            <td class="style2">

                Billing</td>

            <td>



                 <Input type = 'Radio' Name ='billing' id="billing"   value= 'Yes' <?php if($result['billing']=="Yes"){echo "checked=\"checked\""; }?>

                onchange="StatusValue(this.value)"

                >Yes

                

                <Input type = 'Radio' Name ='billing' id="billing"   value= 'No' <?php if($result['billing']=="No"){echo "checked=\"checked\""; }?>

                onchange="StatusValue(this.value)"

                >No</td>

            </tr>

            <tr><td colspan="2">

			<?php if($result['billing']=='Yes') { ?>

		 	<table  id="amount_show1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">



                <tr>

                      <td> <label  id="lbDlAmount">Amount</label></td>

                      <td> <input type="text" name="billing_amount_new" id="billing_amount" value="<?=$result['billing_amount']?>" /></td>

                </tr>

            </table>

		<? } ?>

		

		  <table  id="amount_show" align="left" style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">



            	<tr>

        			<td> <label  id="lbDlAmount">Amount</label></td>

                    <td> <input type="text" name="billing_amount_new" id="billing_amount" value="<?=$result['billing_amount']?>" /></td>

               </tr>

            </table>

            </td>

          </tr>

	  </table>

		

        </td></tr>

          

            <tr><td colspan="2" align="right">

			

		<?php if($result['rdd_device_type']=='Old'){ ?>

			

            <table  id="OldDevice1" align="center" style="width: 500px; border:1" cellspacing="5" cellpadding="5">

            <tr>

            <td>

            Client User Name</td><h2></h2>

            <td> 

            

            <select name="replace_user_id" id="replace_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'ReplaceCompany');">

            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT id as user_id, sys_username as name FROM matrix.users");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

             <option   value="<?=$data['user_id']?>" <? if($result['rdd_username']==$data['user_id']) {?> selected="selected" <? } ?> >

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

            <td><input type="text" name="ReplaceCompany" id="ReplaceCompany" value="<?=$result['rdd_companyname']?>" readonly />

            </td>

            </tr>

            

            

            

            <tr>

            <td>

            Registration No</td>

            <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 

            <div id="ajaxdatareplace">

            <?=$result['rdd_reg_no']?>

            </div> 

            

            </td>

            </tr>

            <tr>

            <td>

            <label for="DeviceMOdel" id="replacelblDeviceModel">Device Model</label></td>

            <td>

            <select name="replaceDevice_model" id="replaceDevice_model">

            <option value="" >-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT * FROM matrix.`device_type`");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

            <option v value ="<?php echo $data['device_type'] ?>" <? if($result['device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 

            <?php echo $data['device_type']; ?>

            </option>

            <?php 

            } 

            

            ?>

            </select></td>

            </tr>

            <tr>

            <td>

            <label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>

            <td>

            <input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" value="<?=$result['rdd_device_imei']?>" readonly/></td>

            </tr>

            <tr>

            <td>

            <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>

            <td>

            <input type="text" name="replaceDevicemobile" id="replaceDevicemobile" value="<?=$result['rdd_device_mobile_num']?>" readonly/></td>

            </tr>

            <tr>

            <td>

            <label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>

            <td>

            <input type="text" name="replacedate_of_install" id="replacedate_of_install" value="<?=$result['date_of_install']?>" readonly/></td>

            </tr>

			 <tr>

            <td>

                Billing</td>

            <td>



            <Input type = 'Radio' Name ='billing1' id="billing1"   value= 'Yes' <?php if($result['billing']=="Yes"){echo "checked=\"checked\""; }?> onchange="Status_old(this.value)">Yes

    

            <Input type = 'Radio' Name ='billing1'  id="billing1"  value= 'No' <?php if($result['billing']=="No"){echo "checked=\"checked\""; }?> onchange="Status_old(this.value)" />No</td>

            </tr>

            <tr><td colspan="2">

			<?php if($result['billing']=='Yes') { ?>

		 	<table  id="No1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">



                <tr>

                      <td> <label  id="lbDlAmount">Amount</label></td>

                      <td> <input type="text" name="billing_amount_old" id="billing_amount1" value="<?=$result['billing_amount']?>" /></td>

                </tr>

            </table>

		<? } ?>

		

		  <table  id="No" align="left"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">



            	<tr>

        			<td> <label  id="lbDlAmount">Amount</label></td>

                    <td> <input type="text" name="billing_amount_old" id="billing_amount1" value="<?=$result['billing_amount']?>" /></td>

               </tr>

            </table>

            </td>

          </tr>



            </table>

			

			<? } ?>

		

			<table  id="OldDevice" align="center"  style="width: 500px;display:none;border:1" cellspacing="5" cellpadding="5">

            <tr>

            <td>

            Client User Name</td><h2></h2>

            <td> 

            

            <select name="replace_user_id" id="replace_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'ReplaceCompany');">

            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT id as user_id, sys_username as name FROM matrix.users");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

             <option   value="<?=$data['user_id']?>" <? if($result['rdd_username']==$data['user_id']) {?> selected="selected" <? } ?> >

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

            <td><input type="text" name="ReplaceCompany" id="ReplaceCompany" value="<?=$result['rdd_companyname']?>" readonly />

            </td>

            </tr>

            

            

            

            <tr>

            <td>

            Registration No</td>

            <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 

            <div id="ajaxdatareplace">

            <?=$result['rdd_reg_no']?>

            </div> 

            

            </td>

            </tr>

            <tr>

            <td>

            <label for="DeviceMOdel" id="replacelblDeviceModel">Device Model</label></td>

            <td>

            <select name="replaceDevice_model" id="replaceDevice_model">

            <option value="" >-- Select One --</option>

            <?php

            $main_user_id=mysql_query("SELECT * FROM matrix.`device_type`");

            while ($data=mysql_fetch_assoc($main_user_id))

            {

            ?>

            

            <option v value ="<?php echo $data['device_type'] ?>" <? if($result['device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 

            <?php echo $data['device_type']; ?>

            </option>

            <?php 

            } 

            

            ?>

            </select></td>

            </tr>

            <tr>

            <td>

            <label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>

            <td>

            <input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" value="<?=$result['rdd_device_imei']?>" readonly/></td>

            </tr>

            <tr>

            <td>

            <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>

            <td>

            <input type="text" name="replaceDevicemobile" id="replaceDevicemobile" value="<?=$result['rdd_device_mobile_num']?>" readonly/></td>

            </tr>

            <tr>

            <td>

            <label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>

            <td>

            <input type="text" name="replacedate_of_install" id="replacedate_of_install" value="<?=$result['date_of_install']?>" readonly/></td>

            </tr>

			 <tr>

            <td class="style2">

                Billing</td>

            <td>



             <Input type = 'Radio' Name ='billing1' id="billing1"   value= 'Yes' <?php if($result['billing']=="Yes"){echo "checked=\"checked\""; }?> onchange="Status_old(this.value)">Yes

            

            <Input type = 'Radio' Name ='billing1' id="billing1"   value= 'No' <?php if($result['billing']=="No"){echo "checked=\"checked\""; }?> onchange="Status_old(this.value)">No</td>

            </tr>

            <tr><td colspan="2">

			<?php if($result['billing']=='Yes') { ?>

		 	<table  id="No1" align="left"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">



                <tr>

                      <td> <label  id="lbDlAmount">Amount</label></td>

                      <td> <input type="text" name="billing_amount_old" id="billing_amount1" value="<?=$result['billing_amount']?>" /></td>

                </tr>

            </table>

		<? } ?>

		

		  <table  id="No" align="left"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">



            	<tr>

        			<td> <label  id="lbDlAmount">Amount</label></td>

                    <td> <input type="text" name="billing_amount_old" id="billing_amount1" value="<?=$result['billing_amount']?>" /></td>

               </tr>

            </table>

            </td>

          </tr>

		

            </table>

			

            </td></tr>

             </table>

			    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">



             

              <tr><td width="276"> <label  id="lbDlDate">Date</label></td>

			  <td width="187"> <input type="text" name="rdd_date" id="datepicker" value="<?=$result['rdd_date']?>" /></td>

			  </tr>

			  

              <tr><td> <label  id="lblReason">Reason</label></td>

			  <td> <textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason"><?=$result['rdd_reason']?></textarea>

				</td>

			  </tr>

             

            <?php 

		//if($action=='edit') {

		?>

		 <!--<tr>

            <td class="style2">

                Service Comment</td>

            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment"></textarea>

                </td>

        </tr>-->

		<?php //} ?>

    <tr><td colspan="2" align="center"> <input type="submit" name="submit" value="submit"  />

					   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_device_change.php' " /></td>



	</tr>

</table>

     

	  </form>

   </div>

 

<?php

include("include/footer.php"); ?>











