<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");*/

if($_SESSION['user_name']=='saleslogin' || $_SESSION['user_name']=='asaleslogin' || $_SESSION['user_name']=='jsaleslogin' || $_SESSION['user_name']=='msaleslogin' || $_SESSION['user_name']=='ksaleslogin') 
{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
}
else{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/
}

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from sub_user_creation where id=$id");	
	}?>

<div class="top-bar">
  <h1>Sub User Creation</h1>
</div>
<div class="table">
  <?

if(isset($_POST["submit"]))
{

	//date,account_manager,main_user_id,company,tot_no_of_vehicles,tot_no_of_vehicles,contact_number,name,req_sub_user_pass,billing_separate,billing_name,reason

	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$company=$_POST["company"];
	$main_user_id=$_POST["main_user_id"];
	$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
	$contact_person=$_POST["contact_person"];
	$contact_number=$_POST["contact_number"];
	$name=$_POST["name"];
	$req_sub_user_pass=$_POST["req_sub_user_pass"];
	$reg_no_of_vehicle_to_move=$_POST["tot_no_of_vehicles"];
	
	$billing_separate=$_POST["billing_separate"];
	$billing_main_user=$_POST["billing_name"];
	$billing_separate_address=$_POST["user_address"];
	$reason=$_POST["reason"];
	$sales_comment = $_POST["sales_comment"];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];
	
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
	$veh_num_edit=$result[0]['reg_no_of_vehicle_to_move'];
	}
	else {
	$veh_num_edit=$veh_num;
	}
	
	if($no_of_veh_move=="") {
	$no_of_veh_move_edit=$result[0]['no_vehicle_move'];
	}
	else {
	$no_of_veh_move_edit=$no_of_veh_move;
	}
	
if($action=='edit')
	{
	
		$query="update sub_user_creation set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',main_user_id='".$main_user_id."',company='".$company."',tot_no_of_vehicles='".$tot_no_of_vehicles."', contact_person='".$contact_person."',contact_number='".$contact_number."',name='".$name."',req_sub_user_pass='".$req_sub_user_pass."',reg_no_of_vehicle_to_move='".$veh_num_edit."', no_vehicle_move='".$no_of_veh_move_edit."', billing_separate='".$billing_separate."', billing_name='".$billing_main_user."', billing_address='".$billing_separate_address."', reason='".$reason."', sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$sales_comment."', sub_user_status=1 where id=$id";
 

 mysql_query($query);
echo "<script>document.location.href ='list_sub_user_creation.php'</script>";
	}
  else
  {
 
   $query="insert into sub_user_creation(date,acc_manager,`sales_manager`,company,main_user_id,tot_no_of_vehicles,contact_person,contact_number,name,req_sub_user_pass,reg_no_of_vehicle_to_move,no_vehicle_move,billing_separate,billing_name,billing_address,reason)values('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$contact_person."','".$contact_number."','".$name."','".$req_sub_user_pass."','".$veh_num."','".$no_of_veh_move."','".$billing_separate."','".$billing_main_user."','".$billing_separate_address."','".$reason."')";

 mysql_query($query);

 echo "<script>document.location.href='list_sub_user_creation.php'</script>";
}
}
?>
  <script type="text/javascript">
function validateForm()
{

	//date,account_manager,main_user_id,company,tot_no_of_vehicles,tot_no_of_vehicles,contact_number,name,req_sub_user_pass,billing_separate,billing_name,reason

	var sales_manager=document.forms["myForm"]["sales_manager"].value;
	if (sales_manager==null || sales_manager=="")
	  {
	  alert("Please select Sales Person");
	  return false;
	  }
	var main_user_id=document.forms["myForm"]["main_user_id"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Please select Client User Name");
	  return false;
	  }
   if(document.myForm.TxtContactPerson.value=="")
		{
		alert("please Enter Contact Person") ;
		document.myForm.TxtContactPerson.focus();
		return false;
		}
	  var cnt_no=document.forms["myForm"]["TxtContactNo"].value;
	if (cnt_no==null || cnt_no=="")
	  {
	  alert("Enter Contact Number");
	  return false;
	  }

	  var sub_user_id=document.forms["myForm"]["TxtRequestedSubUserName"].value;
	if (sub_user_id==null || sub_user_id=="")
	  {
	  alert("Enter Sub user name");
	  return false;
	  }

	  var sub_user_pass=document.forms["myForm"]["TxtRequestedSubUserPass"].value;
	if (sub_user_pass==null || sub_user_pass=="")
	  {
	  alert("Enter subuser password");
	  return false;
	  }
  
  if(document.myForm.TxtReason.value=="")
	{
	alert("please Enter Reason") ;
	document.myForm.TxtReason.focus();
	return false;
	}
	
	var sales_comment=document.forms["myForm"]["TxtSalesComment"].value;
	if (sales_comment==null || sales_comment=="")
	  {
	  alert("Enter Sales Comment");
	  return false;
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
      <?php //} ?>
      <tr>
        <td> User Name</td>
        <td><select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['main_user_id']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$u]['name']; ?> </option>
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
        <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['tot_no_of_vehicles']?>"  readonly/></td>
      </tr>
      <tr>
        <td> Vehicle to move</td>
        <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
          <div id="ajaxdata">
            <?=$result[0]['reg_no_of_vehicle_to_move']?>
          </div></td>
      </tr>
      <tr>
        <td> Contact Person</td>
        <td><input type="text" name="contact_person" id="TxtContactPerson" value="<?=$result[0]['contact_person']?>"  /></td>
      </tr>
      <tr>
        <td> Contact Number</td>
        <td><input type="value" name="contact_number" id="TxtContactNo" value="<?=$result[0]['contact_number']?>"  /></td>
      </tr>
      <tr>
        <td> Sub-User Name</td>
        <td><input type="text" name="name" id="TxtRequestedSubUserName" value="<?=$result[0]['name']?>"  /></td>
      </tr>
      <tr>
        <td> Password</td>
        <td><input type="text" name="req_sub_user_pass" id="TxtRequestedSubUserPass" value="<?=$result[0]['req_sub_user_pass']?>"  /></td>
      </tr>
    </table>
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
      <tr>
        <td><h1>Billing</h1></td>
      </tr>
      <tr>
        <td>Main User
          <input type="radio" style="width:10px;"  name="billing_separate" id="TxtSeparate" value="main user" onclick="toggle_visibility('TxtSeparate');"<?php if($result[0]['billing_separate']=="main user"){echo "checked=\"checked\""; }?>/>
          Separate
          <input type="radio"  style="width:10px;" name="billing_separate" id="TxtSeparate" value="separate" onclick="toggle_visibility('TxtMainUser');" <?php if($result[0]['billing_separate']=="separate"){echo "checked=\"checked\""; }?>/></td>
        <?php if($result[0]['billing_separate']=="separate") { ?>
      <tr id="new1">
        <td class="style1"><div id="TxtMainUser">Billing Name<br />
            <input type="text" name="billing_name" value="<?=$result[0]['billing_name']?>"  />
            <br />
            Billing Address<br />
            <textarea rows="4" cols="25"  name="user_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
 </textarea>
          </div></td>
      </tr>
      <? } ?>
      <tr id="new">
        <td class="style1"><div id="TxtMainUser" style="display:none;">Billing Name<br />
            <input type="text" name="billing_name" value="<?=$result[0]['billing_name']?>"  />
            <br />
            Billing Address<br />
            <textarea rows="4" cols="25"  name="user_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
 </textarea>
          </div></td>
      </tr>
        </tr>
      
    </table>
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
      <tr>
        <td width="170" class="style2"> Reason</td>
        <td width="293"><textarea rows="4" cols="25"  name="reason" id="TxtReason" />
          <?=$result[0]['reason']?>
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
        <td></td>
        <td class="submit"><input type="submit" name="submit" id="button1" value="Submit"  onclick="return Check();"/>
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_sub_user_creation.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
