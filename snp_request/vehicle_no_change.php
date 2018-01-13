<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_snp.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_snp.php");*/ 
 
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from vehicle_no_change where id=$id");	
	}
?>

<div class="top-bar">
  <h1>Vehicle Number Change</h1>
</div>
<div class="table">
  <?php


if(isset($_POST["submit"]))
{ 
 
	$date=date("Y-m-d H:i:s");
	$acc_manager=$_SESSION['user_name'];
	$client=$_POST["company"];
	$user_id=$_POST["main_user_id"];
	$veh_reg=$_POST["veh_reg"];
	$New_Veh_num=$_POST["New_Veh_num"];
	$rdd_date=$_POST["rdd_date"];
	$TxtReason= $_POST["vehicle_change_reason"];
	$Client_request=$_POST["TxtReason_comment"];  
	$service_comment=$_POST["service_comment"];  
	$payment_status=$_POST["payment_status"];
	
	$sales_manager=$_POST["sales_manager"];  
	
	$billing=$_POST["billing"];
 
	if($billing=="No")
	{
	$reason=$_POST["billing_reason"];  
	}
	
	 if($veh_reg=="") {
	$veh_reg_edit=$result[0]['old_reg_no'];
	}
	else {
	$veh_reg_edit=$veh_reg;
	}

 
  if($action=='edit')
	{
	
		$query="update vehicle_no_change set sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',old_reg_no='".$veh_reg_edit."',new_reg_no='".$New_Veh_num."',numberchange_date='".$rdd_date."',reason='".$TxtReason."',billing='".$billing."',billing_reason='".$reason."',vehicle_reason='".$Client_request."' where id=$id";
		
		mysql_query($query);
		echo "<script>document.location.href ='list_vehicle_no_change.php'</script>";
   }

 else {
 

   //echo $query="INSERT INTO `vehicle_no_change` (`date`, `acc_manager`,`client`,`user_id`,`old_reg_no`,`new_reg_no`,`numberchange_date`,`reason`,`billing`,`billing_amt`,`billing_reason`) VALUES ('".$date."','".$acc_manager."','".$client."','".$user_id."','".$veh_reg."','".$New_Veh_num."','".$rdd_date."','".$TxtReason."','".$billing."','".$billing_amt."','".$reason."')";
 
		$query="INSERT INTO `vehicle_no_change` (`date`,acc_manager, `sales_manager`,`client`, `user_id`, `old_reg_no`, `new_reg_no`, `numberchange_date`, `reason`, `billing`,`billing_reason`,`vehicle_reason`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$veh_reg."','".$New_Veh_num."','".$rdd_date."','".$TxtReason."','".$billing."','".$reason."','".$Client_request."')";
		
		mysql_query($query) ;
		echo "<script>document.location.href ='list_vehicle_no_change.php'</script>";
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
 if(document.myForm.sales_manager.value=="")
  {
  alert("please Select Sales Manager") ;
  document.myForm.sales_manager.focus();
  return false;
  }  
  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  } 
  if(document.myForm.New_Veh_num.value=="")
  {
  alert("please Enter New Vehicle no.") ;
  document.myForm.New_Veh_num.focus();
  return false;
  }

  var billing = document.myForm.billing[0].checked;
  var billing1 = document.myForm.billing[1].checked;
  if(billing  == false && billing1  == false)
  {
	 alert("please Select Billing");
	 return false;
   }

  if(billing1 == true && document.myForm.billing_reason.value=="")
  {   
      alert("please Enter Billing Reason") ;
      document.myForm.billing_reason.focus();
      return false;
   }

  if(document.myForm.rdd_date.value=="")
  {
  alert("please Enter Date") ;
  document.myForm.rdd_date.focus();
  return false;
  }
  if(document.myForm.vehicle_change_reason.value=="")
  {
  alert("please Select Vehicle No Change Reason") ;
  document.myForm.vehicle_change_reason.focus();
  return false;
  }
  if(document.myForm.vehicle_change_reason.value=="Client Request")
  {
	  if(document.myForm.TxtReason_comment.value=="")
	  {
	  alert("please Enter Client Request Comment") ;
	  document.myForm.TxtReason_comment.focus();
	  return false;
	  }
  }
} 
			
function Status(radioValue)
{
    if(radioValue=="No")
    {

		document.getElementById('No').style.display = "block";
		/*document.getElementById('Yes1').style.display = "none";
		document.getElementById('No1').style.display = "none";
		document.getElementById('Yes1').style.display = "none";*/
    }
    else
    {
		document.getElementById('No').style.display = "none";
		/*document.getElementById('Yes1').style.display = "none";
		document.getElementById('Yes1').style.display = "none";
		document.getElementById('No1').style.display = "none";*/
    }
   
}  

function Status12(radioValue)
{
   if(radioValue=="No")
    {
	    document.getElementById('No').style.display = "block";
    }
    else
    {
	    document.getElementById('No').style.display = "none";
    }
   
}
 

function RequestComment(radioValue1)
{
	if(radioValue1=="Client Request")
    {
	    document.getElementById('ClientRequest').style.display = "block";
    }
    else
    {
		document.getElementById('ClientRequest').style.display = "none";
    }
} 

function RequestComment12(radioValue1)
{
	if(radioValue1=="Client Request")
	{
		document.getElementById('ClientRequest').style.display = "block";
	}
	else
	{
		document.getElementById('ClientRequest').style.display = "none";
	}
}  

</script>
  <form name="myForm" action="" onsubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      
      <!--<tr>
            <td>Date</td>
            <td>
                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
        </tr>

		<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
        </tr>-->
      <tr>
        <td>Sales Manager</td>
        <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
            <?php
        $sales_manager = select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
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
      <tr>
        <td> Client User Name</td>
        <td><select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');getCompanyName(this.value,'TxtCompany');">
            <option value=""  >-- Select One --</option>
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
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['client']?>" readonly /></td>
      </tr>
      <tr>
        <td> Registration No</td>
        <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
          
          <div id="ajaxdata">
            <?=$result[0]['old_reg_no']?>
          </div></td>
      </tr>
      <tr>
        <td><label  id="lbDlDate">New Registration No</label></td>
        <td><input type="text" name="New_Veh_num" id="New_Veh_num" value="<?=$result[0]['new_reg_no']?>"/></td>
      </tr>
      <tr>
        <td class="style2"> Billing</td>
        <td><Input type = 'radio' Name ='billing' id="billing" value= 'Yes' <?php if($result[0]['billing']=="Yes"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)" >
          Yes
          <Input type = 'radio' Name ='billing' id="billing" value= 'No' <?php if($result[0]['billing']=="No"){echo "checked=\"checked\""; }?>
                    onchange="Status(this.value)" >
          No </td>
      </tr>
      <tr>
        <td colspan="2"><?php //if($result[0]['billing']=="No") { ?>
          
          <!-- <table  id="No1" align="center"  style="width: 200px; border:1" cellspacing="5" cellpadding="5">

	<tr>
	<td> <label  id="lbDlBilling">Reason</label></td>
			  <td> <input type="text" name="billing_reason" id="Billingreason1"  value="<?=$result[0]['billing_reason']?>" /></td>
			  </tr></table>-->
          
          <? //} ?>
          <table  id="No" align="center"   style="padding-left: 50px;width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td><label  id="lbDlBilling">Reason</label></td>
              <td><input type="text" name="billing_reason" id="Billingreason1" value="<?=$result[0]['billing_reason']?>" /></td>
            </tr>
          </table></td>
      </tr>
      <!--</table>
			  
			  
			     <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">-->
      
      <tr>
        <td width="176"><label  id="lbDlDate">Date</label></td>
        <td width="287"><input type="text" name="rdd_date" id="datepicker" value="<?=$result[0]['numberchange_date']?>"/></td>
      </tr>
      <tr>
        <td><label  id="lblVehicleReason">Vehicle No Change Reason</label></td>
        <td><select name="vehicle_change_reason" id="vehicle_change_reason" onchange="RequestComment(this.value)">
            <option value="">Select Reason</option>
            <option value="Temperory no to Permanent no" <? if($result[0]['reason']=="Temperory no to Permanent no") {?> selected="selected" <? } ?> >Temperory no to Permanent no</option>
            <option value="Personal no to Commercial no" <? if($result[0]['reason']=="Personal no to Commercial no") {?> selected="selected" <? } ?> >Personal no to Commercial no</option>
            <option value="Commercial no to Personal no" <? if($result[0]['reason']=="Commercial no to Personal no") {?> selected="selected" <? } ?> >Commercial no to Personal no</option>
            <option value="For Warranty Renewal Purpose" <? if($result[0]['reason']=="For Warranty Renewal Purpose") {?> selected="selected" <? } ?>>For Warranty Renewal Purpose</option>
            <option value="Wrong Vehicle no" <? if($result[0]['reason']=="Wrong Vehicle no") {?> selected="selected" <? } ?> >Wrong Vehicle no</option>
            <option value="Sold Vehicle no" <? if($result[0]['reason']=="Sold Vehicle no") {?> selected="selected" <? } ?> >Sold Vehicle no</option>
            <option value="Vehicle is on standing mode" <? if($result[0]['reason']=="Vehicle is on standing mode") {?> selected="selected" <? } ?> >Vehicle is on standing mode</option>
            <option value="Accidental Vehicle" <? if($result[0]['reason']=="Accidental Vehicle") {?> selected="selected" <? } ?> >Accidental Vehicle</option>
            <option value="DIMST Fitness Purpose" <? if($result[0]['reason']=="DIMST Fitness Purpose") {?> selected="selected" <? } ?>>DIMST Fitness Purpose</option>
            <option value="Client Request" <? if($result[0]['reason']=="Client Request") {?> selected="selected" <? } ?>>Client Request</option>
            <option value="Device of deleted vehicle (DIMTS PURPOSE)​ installed" <? if($result[0]['vehicle_reason']=="Device of deleted vehicle (DIMTS PURPOSE)​ installed") {?> selected="selected" <? } ?>>Device of deleted vehicle (DIMTS PURPOSE)​ installed</option>
          </select></td>
      </tr>
      <tr>
        <td colspan="2"><table id="ClientRequest"  style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="0">
            <tr>
              <td><label  id="lblReason">Clent Request Comment</label></td>
              <td><textarea rows="5" cols="25"  type="text" name="TxtReason_comment" id="TxtReason_comment" ><?=$result[0]['vehicle_reason']?>
</textarea></td>
            </tr>
          </table></td>
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
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_vehicle_no_change.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php include("../include/footer.php"); ?>
<script>Status12("<?=$result[0]['billing'];?>");RequestComment12("<?=$result[0]['reason'];?>");</script>