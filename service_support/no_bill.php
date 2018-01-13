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
	$result=mysql_fetch_array(mysql_query("select * from no_bills where id=$id"));	
	}
?> 

<div class="top-bar">
<h1>No Bill</h1>
</div>
<div class="table"> 
<?php
 

if(isset($_POST["submit"]))
{ 
	$date = $_POST["date"];
	$account_manager = $_POST["account_manager"];
	$main_user_id = $_POST["main_user_id"];
	$company = $_POST["company"];
	$Device_model = $_POST["Device_model"];
	$tot_no_of_vehicles = $_POST["tot_no_of_vehicles"];
	$TxtDeviceIMEI = $_POST["TxtDeviceIMEI"];
	$Devicemobile = $_POST["Devicemobile"];
	$nobill = $_POST["nobill"];
	$Duration = $_POST["Duration"]; 
	$TxtReason = $_POST["TxtReason"]; 
	$sales_comment = $_POST['sales_comment'];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];
	$no_bill_issue=$_POST["no_bill_issue"];
	
	$date_of_install=$_POST["date_of_install"]; 
	$provision_bill=$_POST["provision_bill"]; 
	$tot_no_of_vehicles=(isset($_POST["tot_no_of_vehicles"])) ? trim($_POST["tot_no_of_vehicles"]): "";
	$number="";
	$no_of_veh_move=0;
	for($j=0;$j<=$tot_no_of_vehicles;$j++)
	{
		if(isset($_POST[$j]))
			{
			$no_of_veh_move++;
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
	
	if($no_of_veh_move=="") {
	$veh_no_bill=$result['veh_no_bill'];
	}
	else {
	$veh_no_bill=$no_of_veh_move;
	}


 if($action=='edit')
	{
	
$query="update no_bills set date='".$date."',acc_manager='".$account_manager."',sales_manager='".$sales_manager."',client='".$main_user_id."',company_name='".$company."',tot_no_of_vehicles='".$tot_no_of_vehicles."',veh_no_bill='".$veh_no_bill."',reg_no='".$veh_num_edit."',duration='".$Duration."',rent_device='".$nobill."',provision_bill='".$provision_bill."',reason='".$TxtReason."',sales_comment='".$result["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$sales_comment."',no_bill_issue='".$no_bill_issue."',no_bill_status=1 where id=$id";
 
 mysql_query($query);
echo "<script>document.location.href ='list_no_bill.php'</script>";
	}
  else
  {


     $query="INSERT INTO `no_bills` (`date`, `acc_manager`,`sales_manager`, `company_name`, `client`, veh_no_bill,tot_no_of_vehicles, `reg_no`, `duration`, `rent_device`, `reason`, `provision_bill`,no_bill_issue) VALUES ('".$date."','".$account_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$veh_no_bill."','".$tot_no_of_vehicles."','".$veh_num."','".$Duration."','".$nobill."','".$TxtReason."','".$provision_bill."','".$no_bill_issue."')";

mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_no_bill.php'</script>";
}

 }


?>


 
    
	
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>

function validateForm()
{
  if(document.myForm.sales_manager.value=="")
  {
  alert("Please Select Sales Person") ;
  document.myForm.sales_manager.focus();
  return false;
  }  

  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please Enter Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
  
 if(document.myForm.no_bill_issue.value=="")
 {
  	alert("please select Issue for No Bill") ;
  	document.myForm.no_bill_issue.focus();
  	return false;
 }

 if(document.myForm.TxtReason.value=="")
 {
  	alert("please Enter Reason") ;
  	document.myForm.TxtReason.focus();
  	return false;
 }

 if(document.myForm.TxtSalesComment.value=="")
 {
  	alert("please Enter Sales Comment") ;
  	document.myForm.TxtSalesComment.focus();
  	return false;
 }
	
}  
			
function Status(radioValue)
{
 if(radioValue=="Yes")
	{
	document.getElementById('new').style.display = "block";
	}
	else 
	{
	document.getElementById('new').style.display = "none";
	}   }
</script>
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

    <table width="589" cellpadding="5" cellspacing="5" style=" padding-left: 100px;width: 550px;">

         <tr>
            <td>Date</td>
            <td>
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
            
           	<option name="main_user_id" value="<?=$data['user_id']?>" <? if($result['client']==$data['user_id']) {?> selected="selected" <? } ?> >
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
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result['company_name']?>" readonly />
        </td>
        </tr>
        
        <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result['tot_no_of_vehicles']?>"  readonly/>
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
        <label for="DtInstallation" id="lblDtInstallation">No Bill For</label></td>
        <td>
        <input type="checkbox" name="nobill" value="Rent" <?php if($result['rent_device']=="Rent"){echo "checked=\"checked\""; }?>/>Rent<br>
<input type="checkbox" name="nobill" value="Device" <?php if($result['rent_device']=="Device"){echo "checked=\"checked\""; }?>/>Device </td>
        </tr>
		
		</table>
   
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
           <tr>
        <td width="231">
        <label for="DtInstallation" id="lblDtInstallation">Provision Bill</label></td>
        <td width="232">
         <input type="Radio"  style="width:10px;" name="provision_bill" id="provision_bill" value="Yes"  <?php if($result['provision_bill']=="Yes"){echo "checked=\"checked\""; }?> onchange="Status(this.value)" />Yes 
		 <input type="Radio"  style="width:10px;" name="provision_bill" id="provision_bill" value="No"  <?php if($result['provision_bill']=="No"){echo "checked=\"checked\""; }?> onchange="Status(this.value)" />No 
		</td>
 <?php if($result['provision_bill']=="Yes") { ?>
	<tr id="new1">
	    <td>
        Duration for Provision Bill</td><td>
		<select name="Duration" id="Duration" >
            <option value="" name="Duration" id="Duration">-- Select One --</option>
            <option value="1 week" <? if($result['duration']=='1 week') {?> selected="selected" <? } ?> >1 week</option>
            <option value="2 week" <? if($result['duration']=='2 week') {?> selected="selected" <? } ?> >2 week</option>
            <option value="3 week" <? if($result['duration']=='3 week') {?> selected="selected" <? } ?> >3 week</option>
            <option value="4 week" <? if($result['duration']=='4 week') {?> selected="selected" <? } ?> >4 week</option>
            <option value="5 week" <? if($result['duration']=='5 week') {?> selected="selected" <? } ?> >5 week</option>
            <option value="6 week" <? if($result['duration']=='6 week') {?> selected="selected" <? } ?> >6 week</option>
            <option value="7 week" <? if($result['duration']=='7 week') {?> selected="selected" <? } ?> >7 week</option>
            <option value="8 week" <? if($result['duration']=='8 week') {?> selected="selected" <? } ?> >8 week</option>
            <option value="9 week" <? if($result['duration']=='9 week') {?> selected="selected" <? } ?> >9 week</option>
        </select>
        </td>
        </tr>
         <?php } ?>
		 <tr id="new" style="display:none">
	    <td>
       Duration for Provision Bill</td><td>
		<select name="Duration" id="Duration" >
            <option value="" name="Duration" id="Duration">-- Select One --</option>
            <option value="1 week" <? if($result['duration']=='1 week') {?> selected="selected" <? } ?> >1 week</option>
            <option value="2 week" <? if($result['duration']=='2 week') {?> selected="selected" <? } ?> >2 week</option>
            <option value="3 week" <? if($result['duration']=='3 week') {?> selected="selected" <? } ?> >3 week</option>
            <option value="4 week" <? if($result['duration']=='4 week') {?> selected="selected" <? } ?> >4 week</option>
            <option value="5 week" <? if($result['duration']=='5 week') {?> selected="selected" <? } ?> >5 week</option>
            <option value="6 week" <? if($result['duration']=='6 week') {?> selected="selected" <? } ?> >6 week</option>
            <option value="7 week" <? if($result['duration']=='7 week') {?> selected="selected" <? } ?> >7 week</option>
            <option value="8 week" <? if($result['duration']=='8 week') {?> selected="selected" <? } ?> >8 week</option>
            <option value="9 week" <? if($result['duration']=='9 week') {?> selected="selected" <? } ?> >9 week</option>
        </select>
</td>
</tr>
	</tr>
	</table>
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;">
      <tr>
	    <td>
       Issue for No Bill</td><td>
		<select name="no_bill_issue" id="no_bill_issue" >
            <option value="" name="no_bill_issue" id="no_bill_issue">-- Select One --</option>
            <option value="Software Issue" <? if($result['no_bill_issue']=='Software Issue') {?> selected="selected" <? } ?> >Software Issue</option>
            <option value="Service Issue" <? if($result['no_bill_issue']=='Service Issue') {?> selected="selected" <? } ?> >Service Issue</option>
            <option value="Client Side Issue" <? if($result['no_bill_issue']=='Client Side Issue') {?> selected="selected" <? } ?> >Client Side Issue</option>
            <option value="Device On Demo" <? if($result['discount_issue']=='Device On Demo') {?> selected="selected" <? } ?> >Device On Demo</option>
            <option value="Cracked Device" <? if($result['discount_issue']=='Cracked Device') {?> selected="selected" <? } ?> >Cracked Device</option>
            
            
           </select>
    </td>
    </tr>
              <tr><td> <label  id="lblReason">Reason</label></td>
			  <td> <textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result['reason']?></textarea>
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
            
    <tr>
	<td> <input type="submit" name="submit" value="submit"  />
	<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_no_bill.php' " /></td>
	</tr>

    </table>
	  </form>
  
 
<?php
include("include/footer.php"); ?>
