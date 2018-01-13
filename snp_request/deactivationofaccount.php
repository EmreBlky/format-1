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
		$result = select_query("select * from deactivation_of_account where id=$id");	
	}
?>

<div class="top-bar">
  <h1>Deactivation Of Account</h1>
</div>
<div class="table">
  <?


 
$temprary= 'checked';
$permanent = 'unchecked';
$tot_no_of_vehicles=0;
if(isset($_POST["submit"]))
{
	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$company=$_POST["company"];
	$main_user_id=$_POST["main_user_id"];
	$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
	
	$device_remove_status=$_POST["deviceremove"];
	if($device_remove_status=="Y"){
	$no_of_removed_devices=$_POST["no_of_removed_devices"];
	}
	else{
	$no_of_removed_devices="0";	
	}
	
	$alert_date=$_POST["alert_date"];
	
	$selected_radio=$_POST['deactivateStatus'];
	
	$DeleteFromDebtors=$_POST['DeleteFromDebtors'];
	
	$sales_comment = $_POST["sales_comment"];

	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];
	
	$reason=$_POST["reason"];


if($action=='edit')
	{
	if($result[0]['deactivate_temp']=='Permanent')
	{ 
		$query="update deactivation_of_account set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',device_remove_status='".$device_remove_status."',no_of_removed_devices='".$no_of_removed_devices."',deactivate_temp='".$selected_radio."',reason='".$reason."',delete_form_debtors='".$DeleteFromDebtors."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."',deactivation_status=1 where id=$id";
	 }
	 else if($result[0]['deactivate_temp']=='temporary')
	  {
	 	$query="update deactivation_of_account set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',device_remove_status='".$device_remove_status."',no_of_removed_devices='".$no_of_removed_devices."',deactivate_temp='".$selected_radio."',reason='".$reason."',alert_date='".$alert_date."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."',deactivation_status=1 where id=$id";
	 }
	 
	
	 mysql_query($query);
	echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
	}
  else
  {

if($selected_radio=='Permanent')
{ 
   $query="INSERT INTO `deactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,no_of_removed_devices,deactivate_temp,`reason`,delete_form_debtors) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$no_of_removed_devices."','".$selected_radio."','".$reason."','".$DeleteFromDebtors."')";
}
else {
$query="INSERT INTO `deactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`device_remove_status`,no_of_removed_devices,deactivate_temp,`reason`,alert_date) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$device_remove_status."','".$no_of_removed_devices."','".$selected_radio."','".$reason."','".$alert_date."')";

}
mysql_query($query);
 echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";
//header('location: sales_request.php');
}
}
?>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
  <script type="text/javascript">
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

$( "#datepickercheque" ).datepicker({ dateFormat: "yy-mm-dd" });

});
function validateForm()
{

	var sales_manager=document.forms["myForm"]["sales_manager"].value;
	if (sales_manager==null || sales_manager=="")
	  {
	  alert("Select Sales Person");
	  return false;
	  }
	var main_user_id=document.forms["myForm"]["main_user_id"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Select Username");
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
			
function Status(radioValue)
{
 if(radioValue=="Permanent")
	{
	document.getElementById('temporarysat').style.display = "none";
	document.getElementById('Permanentsat').style.display = "block";
	document.getElementById('temporarysat1').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";

	}
	else if(radioValue=="temporary")
	{

	document.getElementById('temporarysat').style.display = "block";
	document.getElementById('Permanentsat').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";
	document.getElementById('temporarysat1').style.display = "none";
	}
	else
	{
	document.getElementById('temporarysat1').style.display = "none";
	document.getElementById('Permanentsat').style.display = "none";
	document.getElementById('Permanentsat1').style.display = "none";
	document.getElementById('temporarysat1').style.display = "none";
	} 
	
}

function Statuschange(radioValue1)
{
 //alert(radioValue);
 if(radioValue1=="Y")
	{
	//document.getElementById('devicerecord1').style.display = "none";
	document.getElementById('devicerecord').style.display = "block";

	}
	else
	{
	document.getElementById('devicerecord').style.display = "none";
	document.getElementById('devicerecord1').style.display = "none";
	} 
	
}				
    </script>
  <form name="myForm" action="" onsubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td>Date</td>
        <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
      </tr>
      <tr>
        <td>Account Manager</td>
        <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
      </tr>
      <?php 
		//if($_SESSION['user_name']=='saleslogin') {
		?>
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
            <option name="sales_manager" value="<?=$sales_manager[$i]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$i]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$i]['name']; ?> </option>
            <?php 
        } 
        ?>
          </select></td>
      </tr>
      <?php //} ?>
      <tr>
        <td> User Name</td>
        <td><select name="main_user_id" id="TxtMainUserId"  onchange="gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($c=0;$c<count($main_user_id);$c++)
					{
			?>
            <option name="main_user_id" value="<?=$main_user_id[$c]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$c]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$c]['name']; ?> </option>
            <?php 
								} 
 
  ?>
          </select></td>
      </tr>
      <tr>
        <td> Company Name</td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>"  readonly /></td>
      </tr>
      <tr>
        <td> Total No Of Vehicle</td>
        <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_vehicles']?>"  readonly /></td>
      </tr>
      <tr>
        <td>Device Removed</td>
        <td><Input type = 'Radio' Name ='deviceremove'    value= 'Y' <?php if($result[0]['device_remove_status']=="Y"){echo "checked=\"checked\""; }?> onchange="Statuschange(this.value)">
          Yes
          <Input type = 'Radio' Name ='deviceremove'    value= 'N' <?php if($result[0]['device_remove_status']=="N"){echo "checked=\"checked\""; }?> onchange="Statuschange(this.value)" >
          No</td>
      </tr>
      <tr>
        <td colspan="2"><?php if($result[0]['device_remove_status']=="Y") { ?>
          <table  id="devicerecord1" style=";width: 300px; border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td width="300px"> No of Removed Device</td>
              <td><select name="no_of_removed_devices" id="no_of_removed_devices">
                  <option value="">-- Select One --</option>
                  <option value ="1"<?php if($result[0]['no_of_removed_devices']=='1'){ echo "selected=selected";} ?>>1</option>
                  <option value ="2"<?php if($result[0]['no_of_removed_devices']=='2'){ echo "selected=selected";} ?>>2</option>
                  <option value ="3"<?php if($result[0]['no_of_removed_devices']=='3'){ echo "selected=selected";} ?>>3</option>
                  <option value ="4"<?php if($result[0]['no_of_removed_devices']=='4'){ echo "selected=selected";} ?>>4</option>
                  <option value ="5"<?php if($result[0]['no_of_removed_devices']=='5'){ echo "selected=selected";} ?>>5</option>
                  <option value ="6"<?php if($result[0]['no_of_removed_devices']=='6'){ echo "selected=selected";} ?>>6</option>
                  <option value ="7"<?php if($result[0]['no_of_removed_devices']=='7'){ echo "selected=selected";} ?>>7</option>
                  <option value ="8"<?php if($result[0]['no_of_removed_devices']=='8'){ echo "selected=selected";} ?>>8</option>
                  <option value ="9"<?php if($result[0]['no_of_removed_devices']=='9'){ echo "selected=selected";} ?>>9</option>
                  <option value ="10"<?php if($result[0]['no_of_removed_devices']=='10'){ echo "selected=selected";} ?>>10</option>
                  <option value ="11"<?php if($result[0]['no_of_removed_devices']=='11'){ echo "selected=selected";} ?>>11</option>
                  <option value ="12"<?php if($result[0]['no_of_removed_devices']=='12'){ echo "selected=selected";} ?>>12</option>
                  <option value ="13"<?php if($result[0]['no_of_removed_devices']=='13'){ echo "selected=selected";} ?>>13</option>
                  <option value ="14"<?php if($result[0]['no_of_removed_devices']=='14'){ echo "selected=selected";} ?>>14</option>
                  <option value ="15"<?php if($result[0]['no_of_removed_devices']=='15'){ echo "selected=selected";} ?>>15</option>
                  <option value ="16"<?php if($result[0]['no_of_removed_devices']=='16'){ echo "selected=selected";} ?>>16</option>
                  <option value ="17"<?php if($result[0]['no_of_removed_devices']=='17'){ echo "selected=selected";} ?>>17</option>
                  <option value ="18"<?php if($result[0]['no_of_removed_devices']=='18'){ echo "selected=selected";} ?>>18</option>
                  <option value ="19"<?php if($result[0]['no_of_removed_devices']=='19'){ echo "selected=selected";} ?>>19</option>
                  <option value="20"<?php if($result[0]['no_of_removed_devices']=='20'){ echo "selected=selected";} ?>>20</option>
                  <option value ="21"<?php if($result[0]['no_of_removed_devices']=='21'){ echo "selected=selected";} ?>>21</option>
                  <option value ="22"<?php if($result[0]['no_of_removed_devices']=='22'){ echo "selected=selected";} ?>>22</option>
                  <option value ="23"<?php if($result[0]['no_of_removed_devices']=='23'){ echo "selected=selected";} ?>>23</option>
                  <option value ="24"<?php if($result[0]['no_of_removed_devices']=='24'){ echo "selected=selected";} ?>>24</option>
                  <option value ="25"<?php if($result[0]['no_of_removed_devices']=='25'){ echo "selected=selected";} ?>>25</option>
                  <option value ="26"<?php if($result[0]['no_of_removed_devices']=='26'){ echo "selected=selected";} ?>>26</option>
                  <option value ="27"<?php if($result[0]['no_of_removed_devices']=='27'){ echo "selected=selected";} ?>>27</option>
                  <option value ="28"<?php if($result[0]['no_of_removed_devices']=='28'){ echo "selected=selected";} ?>>28</option>
                  <option value ="29"<?php if($result[0]['no_of_removed_devices']=='29'){ echo "selected=selected";} ?>>29</option>
                  <option value ="30"<?php if($result[0]['no_of_removed_devices']=='30'){ echo "selected=selected";} ?>>30</option>
                  <option value ="31"<?php if($result[0]['no_of_removed_devices']=='31'){ echo "selected=selected";} ?>>31</option>
                  <option value ="32"<?php if($result[0]['no_of_removed_devices']=='32'){ echo "selected=selected";} ?>>32</option>
                  <option value ="33"<?php if($result[0]['no_of_removed_devices']=='33'){ echo "selected=selected";} ?>>33</option>
                  <option value ="34"<?php if($result[0]['no_of_removed_devices']=='34'){ echo "selected=selected";} ?>>34</option>
                  <option value ="35"<?php if($result[0]['no_of_removed_devices']=='35'){ echo "selected=selected";} ?>>35</option>
                  <option value ="36"<?php if($result[0]['no_of_removed_devices']=='36'){ echo "selected=selected";} ?>>36</option>
                  <option value ="37"<?php if($result[0]['no_of_removed_devices']=='37'){ echo "selected=selected";} ?>>37</option>
                  <option value ="38"<?php if($result[0]['no_of_removed_devices']=='38'){ echo "selected=selected";} ?>>38</option>
                  <option value ="39"<?php if($result[0]['no_of_removed_devices']=='39'){ echo "selected=selected";} ?>>39</option>
                  <option value="40"<?php if($result[0]['no_of_removed_devices']=='40'){ echo "selected=selected";} ?>>40</option>
                </select></td>
            </tr>
          </table>
          <? } ?>
          <table  id="devicerecord" style="width: 270px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td width="300px" > No of Removed Device</td>
              <td ><select name="no_of_removed_devices" id="no_of_removed_devices">
                  <option value="">-- Select One --</option>
                  <option value ="1"<?php if($result[0]['no_of_removed_devices']=='1'){ echo "selected=selected";} ?>>1</option>
                  <option value ="2"<?php if($result[0]['no_of_removed_devices']=='2'){ echo "selected=selected";} ?>>2</option>
                  <option value ="3"<?php if($result[0]['no_of_removed_devices']=='3'){ echo "selected=selected";} ?>>3</option>
                  <option value ="4"<?php if($result[0]['no_of_removed_devices']=='4'){ echo "selected=selected";} ?>>4</option>
                  <option value ="5"<?php if($result[0]['no_of_removed_devices']=='5'){ echo "selected=selected";} ?>>5</option>
                  <option value ="6"<?php if($result[0]['no_of_removed_devices']=='6'){ echo "selected=selected";} ?>>6</option>
                  <option value ="7"<?php if($result[0]['no_of_removed_devices']=='7'){ echo "selected=selected";} ?>>7</option>
                  <option value ="8"<?php if($result[0]['no_of_removed_devices']=='8'){ echo "selected=selected";} ?>>8</option>
                  <option value ="9"<?php if($result[0]['no_of_removed_devices']=='9'){ echo "selected=selected";} ?>>9</option>
                  <option value ="10"<?php if($result[0]['no_of_removed_devices']=='10'){ echo "selected=selected";} ?>>10</option>
                  <option value ="11"<?php if($result[0]['no_of_removed_devices']=='11'){ echo "selected=selected";} ?>>11</option>
                  <option value ="12"<?php if($result[0]['no_of_removed_devices']=='12'){ echo "selected=selected";} ?>>12</option>
                  <option value ="13"<?php if($result[0]['no_of_removed_devices']=='13'){ echo "selected=selected";} ?>>13</option>
                  <option value ="14"<?php if($result[0]['no_of_removed_devices']=='14'){ echo "selected=selected";} ?>>14</option>
                  <option value ="15"<?php if($result[0]['no_of_removed_devices']=='15'){ echo "selected=selected";} ?>>15</option>
                  <option value ="16"<?php if($result[0]['no_of_removed_devices']=='16'){ echo "selected=selected";} ?>>16</option>
                  <option value ="17"<?php if($result[0]['no_of_removed_devices']=='17'){ echo "selected=selected";} ?>>17</option>
                  <option value ="18"<?php if($result[0]['no_of_removed_devices']=='18'){ echo "selected=selected";} ?>>18</option>
                  <option value ="19"<?php if($result[0]['no_of_removed_devices']=='19'){ echo "selected=selected";} ?>>19</option>
                  <option value="20"<?php if($result[0]['no_of_removed_devices']=='20'){ echo "selected=selected";} ?>>20</option>
                  <option value ="21"<?php if($result[0]['no_of_removed_devices']=='21'){ echo "selected=selected";} ?>>21</option>
                  <option value ="22"<?php if($result[0]['no_of_removed_devices']=='22'){ echo "selected=selected";} ?>>22</option>
                  <option value ="23"<?php if($result[0]['no_of_removed_devices']=='23'){ echo "selected=selected";} ?>>23</option>
                  <option value ="24"<?php if($result[0]['no_of_removed_devices']=='24'){ echo "selected=selected";} ?>>24</option>
                  <option value ="25"<?php if($result[0]['no_of_removed_devices']=='25'){ echo "selected=selected";} ?>>25</option>
                  <option value ="26"<?php if($result[0]['no_of_removed_devices']=='26'){ echo "selected=selected";} ?>>26</option>
                  <option value ="27"<?php if($result[0]['no_of_removed_devices']=='27'){ echo "selected=selected";} ?>>27</option>
                  <option value ="28"<?php if($result[0]['no_of_removed_devices']=='28'){ echo "selected=selected";} ?>>28</option>
                  <option value ="29"<?php if($result[0]['no_of_removed_devices']=='29'){ echo "selected=selected";} ?>>29</option>
                  <option value ="30"<?php if($result[0]['no_of_removed_devices']=='30'){ echo "selected=selected";} ?>>30</option>
                  <option value ="31"<?php if($result[0]['no_of_removed_devices']=='31'){ echo "selected=selected";} ?>>31</option>
                  <option value ="32"<?php if($result[0]['no_of_removed_devices']=='32'){ echo "selected=selected";} ?>>32</option>
                  <option value ="33"<?php if($result[0]['no_of_removed_devices']=='33'){ echo "selected=selected";} ?>>33</option>
                  <option value ="34"<?php if($result[0]['no_of_removed_devices']=='34'){ echo "selected=selected";} ?>>34</option>
                  <option value ="35"<?php if($result[0]['no_of_removed_devices']=='35'){ echo "selected=selected";} ?>>35</option>
                  <option value ="36"<?php if($result[0]['no_of_removed_devices']=='36'){ echo "selected=selected";} ?>>36</option>
                  <option value ="37"<?php if($result[0]['no_of_removed_devices']=='37'){ echo "selected=selected";} ?>>37</option>
                  <option value ="38"<?php if($result[0]['no_of_removed_devices']=='38'){ echo "selected=selected";} ?>>38</option>
                  <option value ="39"<?php if($result[0]['no_of_removed_devices']=='39'){ echo "selected=selected";} ?>>39</option>
                  <option value="40"<?php if($result[0]['no_of_removed_devices']=='40'){ echo "selected=selected";} ?>>40</option>
                </select></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
      <tr>
        <td class="style2"><h1>Deactivate</h1></td>
        <td><Input type = 'Radio' Name ='deactivateStatus'    value= 'temporary' <?php if($result[0]['deactivate_temp']=="temporary"){echo "checked=\"checked\""; }?>
            onchange="Status(this.value)"
            >
          Temporary
          <Input type = 'Radio' Name ='deactivateStatus'    value= 'Permanent' <?php if($result[0]['deactivate_temp']=="Permanent"){echo "checked=\"checked\""; }?>
            onchange="Status(this.value)"
            >
          Permanent</td>
      </tr>
      <?php if($result[0]['deactivate_temp']=="temporary") { ?>
      <table  id="temporarysat1" align="center"  style="width: 250px; border:1" cellspacing="5" cellpadding="5">
        <tr>
          <td><label  id="lbDlDate">Alert Date</label></td>
          <td><input type="text" name="alert_date" id="datepicker" value="<?=$result[0]['alert_date']?>" /></td>
        </tr>
      </table>
      <? } ?>
      <table  id="temporarysat"  align="center"  style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
        <tr>
          <td><label  id="lbDlDate">Alert Date</label></td>
          <td><input type="text" name="alert_date" id="datepicker" value="<?=$result[0]['alert_date']?>" /></td>
        </tr>
      </table>
      <?php if($result[0]['deactivate_temp']=="Permanent") { ?>
      <table  id="Permanentsat1" align="center"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">
        <tr>
          <td><Input type = 'Radio' Name ='DeleteFromDebtors'    value= 'Yes' <?php if($result[0]['delete_form_debtors']=="Yes"){echo "checked=\"checked\""; }?> />
            Delete From Debtors </td>
        </tr>
      </table>
      <? } ?>
      <table  id="Permanentsat" align="center"   style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
        <tr>
          <td><Input type = 'Radio' Name ='DeleteFromDebtors'    value= 'Yes' <?php if($result[0]['delete_form_debtors']=="Yes"){echo "checked=\"checked\""; }?> />
            Delete From Debtors </td>
        </tr>
      </table>
      <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
        <tr>
          <td width="173" class="style2"> Reason</td>
          <td width="290"><Textarea rows="5" cols="23" type="text" name="reason" id="TxtReason"><?=$result[0]['reason']?>
</textarea></td>
        </tr>
        <?php 
		if($action=='edit') {
		?>
        <tr>
          <td class="style2"> Sales Comment</td>
          <td><textarea rows="5" cols="25"  type="text" name="sales_comment" id="TxtSalesComment" ><? //$result[0]['sales_comment']?>
</textarea></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="submit"><input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();"/>
            <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deactivate_of_account.php' " /></td>
        </tr>
      </table>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
