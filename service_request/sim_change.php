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
		$result = select_query("select * from sim_change where id=$id");	
	}
?>

<div class="top-bar">
  <h1>Mobile Number Change</h1>
</div>
<div class="table">
  <?php



if(isset($_POST["submit"]))
{ 
 
$date=$_POST["date"];
$acc_manager=$_POST["account_manager"];
$client=$_POST["company"];
$user_id=$_POST["main_user_id"];
$veh_reg=$_POST["veh_reg"];
$Devicemobile=$_POST["Devicemobile"];
$New_Sim_num=$_POST["New_Sim_num"];
$rdd_date=$_POST["rdd_date"];
$TxtReason=$_POST["TxtReason"];  
$service_comment=$_POST["service_comment"];  
    $sales_manager=$_POST["sales_manager"];  

 if($veh_reg=="") {
$veh_reg_edit=$result[0]['reg_no'];
}
else {
$veh_reg_edit=$veh_reg;
}
  
  if($action=='edit')
	{
	
 $query="update sim_change set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',reg_no='".$veh_reg_edit."',old_sim='".$Devicemobile."',new_sim='".$New_Sim_num."',sim_change_date='".$rdd_date."',reason='".$TxtReason."' where id=$id";
  mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_sim_change.php'</script>";
}

 else {
 
  
   $query="INSERT INTO `sim_change` (`date`,acc_manager, `sales_manager`, `client`, `user_id`, `reg_no`, `old_sim`, `new_sim`, sim_change_date,`reason`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$veh_reg."','".$Devicemobile."','".$New_Sim_num."','".$rdd_date."','".$TxtReason."')";
 
 mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_sim_change.php'</script>";
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
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
   
    if(document.myForm.New_Sim_num.value=="")
  {
  alert("please Enter New SIM no.") ;
  document.myForm.New_Sim_num.focus();
  return false;
  }
  var New_Sim_num=document.myForm.New_Sim_num.value;
  if(New_Sim_num!="")
        {
	var length=New_Sim_num.length;
	
        if(length < 9 || length > 15 || New_Sim_num.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.myForm.New_Sim_num.focus();
        document.myForm.New_Sim_num.value="";
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
    <tr>
      <td>Sales Manager</td>
      <td><select name="sales_manager" id="sales_manager">
          <option value="" >-- select one --</option>
          <?php
        $sales_manager=mysql_query("SELECT name FROM sales_person where branch_id=".$_SESSION['BranchId']);
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
      <td><select name="main_user_id" id="TxtMainUserId"  onchange="
        showUser(this.value,'ajaxdata'); 
        getCompanyName(this.value,'TxtCompany');">
          <option value="">-- Select One --</option>
          <?php
		// where branch_id=".$_SESSION['BranchId']."
        $main_user_id=mysql_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` ASC");
        //while ($data=mysql_fetch_assoc($main_user_iddata))
		for($u=0;$u<count($main_user_id);$u++)
        {
        ?>
          <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$u]['name']; ?> </option>
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
          <?=$result[0]['reg_no']?>
        </div></td>
    </tr>
    <tr>
      <td><label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
      <td><input type="text" name="Devicemobile" id="Devicemobile" value="<?=$result[0]['old_sim']?>" readonly/></td>
    </tr>
    <tr>
      <td><label  id="lbDlDate">New SIM No</label></td>
      <td><input type="text" name="New_Sim_num" id="New_Sim_num" value="<?=$result[0]['new_sim']?>"/></td>
    </tr>
    <tr>
      <td><label  id="lbDlDate">Date</label></td>
      <td><input type="text" name="rdd_date" id="datepicker" value="<?=$result[0]['sim_change_date']?>" /></td>
    </tr>
    <tr>
      <td><label  id="lblReason">Reason</label></td>
      <td><textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result[0]['reason']?>
</textarea></td>
    </tr>
    <?php 
		//if($action=='edit') {
		?>
    <!--<tr>
            <td class="style2">
                Service Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ><?=$result[0]['service_comment']?></textarea>
                </td>
        </tr>-->
    <?php //} ?>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" value="submit"  />
        <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_sim_change.php' " /></td>
    </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
