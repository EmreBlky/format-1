<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from deactivate_sim where id=$id");	
	}

?>

<div class="top-bar">
  <h1>SIM Deactivate</h1>
</div>
<div class="table">
  <?
if(isset($_POST["submit"]))
{ 

 
$date=$_POST["date"];
$acc_manager=$_POST["account_manager"];
$client=$_POST["company"];
$user_id=$_POST["main_user_id"];
$veh_reg=$_POST["veh_reg"];
$device_imei=$_POST["DeviceIMEI"];
$Devicemobile=$_POST["Devicemobile"]; 
$OwnerShip=$_POST["ps_of_ownership"];
$Location=$_POST["ps_of_location"];
$Payment=$_POST["payment"];
$Reason=$_POST["reason"];
$Txtrdd_date=$_POST["rdd_date"];
 $service_comment=$_POST["service_comment"];
    $sales_manager=$_POST["sales_manager"];  

 
  if($veh_reg=="") {
$veh_reg_edit=$result[0]['vehicle'];
}
else {
$veh_reg_edit=$veh_reg;
}

 
  if($action=='edit')
	{
	
 $query="update deactivate_sim set date='".$date."',acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',vehicle='".$veh_reg_edit."',device_imei='".$device_imei."' ,device_sim='".$Devicemobile."',ps_of_location='".$Location."',ps_of_ownership='".$OwnerShip."',change_date='".$Txtrdd_date."',reason='".$Reason."',service_comment='".$result[0]["service_comment"]."<br/>".date("Y-m-d")." - " .$service_comment."' where id=$id";
  mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_deactivate_sim.php'</script>";
}

 else {
 
    $query="INSERT INTO deactivate_sim (date,acc_manager,sales_manager,client, user_id, vehicle, device_imei, device_sim, ps_of_location, ps_of_ownership,change_date, reason) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$veh_reg."','".$device_imei."','".$Devicemobile."','".$Location."','".$OwnerShip."','".$Txtrdd_date."','".$Reason."')";
 mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_deactivate_sim.php'</script>";
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
     function validateForm()
{
 
 
  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("Please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
   if(document.myForm.TxtLocation.value=="")
  {
  alert("Please Enter Location") ;
  document.myForm.TxtLocation.focus();
  return false;
  }  
 
  if(document.myForm.TxtOwnerShip.value=="")
  {
  alert("Please Choose Ownership") ;
  document.myForm.TxtOwnerShip.focus();
  return false;
  }
  if(document.myForm.TxtPayment.value=="")
  {
  alert("Please Choose Payment Status") ;
  document.myForm.TxtPayment.focus();
  return false;
  }

	if(document.myForm.rdd_date.value=="")
	{
  	alert("Please Enter Date") ;
  	document.myForm.rdd_date.focus();
  	return false;
  	}
	if(document.myForm.TxtReason.value=="")
	{
  	alert("Please Enter Reason") ;
  	document.myForm.TxtReason.focus();
  	return false;
	}
			} 

      
    </script>
  <form name="myForm" action="" onSubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
    <tr>
      <td>Date</td>
      <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
    </tr>
    <tr>
      <td>Account Manager</td>
      <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
    </tr>
    <tr>
      <td>Sales Manager</td>
      <td><select name="sales_manager" id="sales_manager">
          <option value="" >-- select one --</option>
          <?php
        $sales_manager = select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
        //while($data=mysql_fetch_array($query)) 
		for($s=0;$s<count($sales_manager);$s++)
        {
        ?>
          <option name="sales_manager" value="<?=$sales_manager[$s]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$s]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$s]['name']; ?> </option>
          <?php 
        } 
        ?>
        </select></td>
    </tr>
    <tr>
      <td> Client User Name</td>
      <td><select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');getCompanyName(this.value,'TxtCompany');">
          <option value="" >-- Select One --</option>
          <?php
        $main_user_iddata = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
        //while ($data=mysql_fetch_assoc($main_user_iddata))
		for($u=0;$u<count($main_user_iddata);$u++)
        {
        ?>
          <option name="main_user_id" value="<?=$main_user_iddata[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_iddata[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_iddata[$u]['name']; ?> </option>
          <?php 
        } 
        
        ?>
        </select></td>
    </tr>
    <tr>
      <td> Company Name</td>
      <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['client']?>" readonly /></td>
    </tr>
    <tr>
      <td> Registration No</td>
      <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
        
        <div id="ajaxdata">
          <?=$result[0]['vehicle']?>
        </div></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
      <td><input type="text" name="DeviceIMEI" id="TxtDeviceIMEI" value="<?=$result[0]['device_imei']?>" readonly/></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device SIM Number</label></td>
      <td><input type="text" name="Devicemobile" id="Devicemobile" value="<?=$result[0]['device_sim']?>" readonly/></td>
    </tr>
    <tr>
      <td><h2>Present Status 0f Device</h2></td>
      <td></td>
    </tr>
    <tr>
      <td class="style2"> OwnerShip</td>
      <td><select name="ps_of_ownership" id="TxtOwnerShip" >
          <option value="" name="ps_of_ownership" id="TxtOwnerShip">-- Select One --</option>
          <option value="Client Device" <? if($result[0]['ps_of_ownership']=='Client Device') {?> selected="selected" <? } ?> >Client Device</option>
          <option value="Gtrac Device" <? if($result[0]['ps_of_ownership']=='Gtrac Device') {?> selected="selected" <? } ?> >Gtrac Device</option>
        </select></td>
    </tr>
    <tr>
      <td><label  id="lbDlDate">Date</label></td>
      <td><input type="text" name="rdd_date" id="datepicker" value="<?=$result[0]['change_date']?>" /></td>
    </tr>
    <tr>
      <td><label  id="lblReason">Reason</label></td>
      <td><textarea rows="5" cols="25"  type="text" name="reason" id="TxtReason" ><?=$result[0]['reason']?>
</textarea></td>
    </tr>
    <?php 
		if($action=='edit') {
		?>
    <tr>
      <td class="style2"> Service Comment</td>
      <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><?=$result[0]['service_comment']?>
</textarea></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="button1" value="submit"  />
        <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deactivate_sim.php' " /></td>
    </tr>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
