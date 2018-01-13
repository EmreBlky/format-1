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
		$result = select_query("select * from transfer_the_vehicle where id=$id");	
	}
?> 

<div class="top-bar">
<h1>Transfer Vehicle</h1>
</div>
<div class="table"> 
<?

$main_user= 'checked';
$separate = 'unchecked';
if(isset($_POST["submit"]))
{
	$selected_radio = $_POST['billing_separate'];
	if ($selected_radio == 'main_user')
	{
	$main_user = 'checked';
	}
	else if ($selected_radio == 'separate') 
	{
	$separate = 'checked';
	}
	 //reason,billing_name,billing_separate,transfer_user_id,tot_no_of_vehicles,company,main_user_id,account_manager,date
	$date=$_POST["date"]; 
	$reason=$_POST["reason"];  
	 
	$billing_separate=$_POST["billing_separate"];  
	$transfer_user_id=$_POST["transfer_user_id"];  
	$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];  
	$company=$_POST["company"];  
	$main_user_id=$_POST["main_user_id"];  
	$account_manager=$_POST["account_manager"]; 
	$transfer_company=$_POST["Transfercompany"]; 
	$billing_main_user=$_POST["billing_name"];
	$billing_separate_address=$_POST["user_address"];
	  $sales_comment = $_POST['sales_comment'];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];
	
	 $tot_no_of_vehicles=(isset($_POST["tot_no_of_vehicles"])) ? trim($_POST["tot_no_of_vehicles"]): "";
	
	$number="";
	$no_of_stop_gps_veh=0;
	for($j=0;$j<=$tot_no_of_vehicles;$j++)
		{
			if(isset($_POST[$j]))
				{
				$no_of_stop_gps_veh++;
			$numbe1=(isset($_POST[$j])) ? trim($_POST[$j])  : "";
			$number .=$numbe1.",";
				}
		}
		   $veh_num=substr($number,0,-1);
	 
	 if($number=="") {
	$veh_num_edit=$result[0]['transfer_from_reg_no'];
	}
	else {
	$veh_num_edit=$veh_num;
	}


 if($action=='edit')
	{
	
	$query="update transfer_the_vehicle set acc_manager='".$account_manager."',sales_manager='".$sales_manager."',transfer_from_user='".$main_user_id."',transfer_from_company='".$company."',total_no_of_veh='".$tot_no_of_vehicles."',transfer_from_reg_no='".$veh_num_edit."',transfer_to_company='".$transfer_company."',billing_name='".$billing_main_user."',billing_address='".$billing_separate_address."',transfer_to_billing='".$selected_radio."',transfer_to_user='".$transfer_user_id."',reason='".$reason."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$sales_comment."',transfer_veh_status=1 where id=$id";
 

 mysql_query($query);
echo "<script>document.location.href ='list_transfer_the_vehicle.php'</script>";
	}
  else
  {


    $query="INSERT INTO `transfer_the_vehicle` (`date`, `acc_manager`,`sales_manager`, `transfer_from_company`, `transfer_from_user`,total_no_of_veh, `transfer_from_reg_no`,  `transfer_to_company`, `transfer_to_user`, `transfer_to_billing`,billing_name,billing_address,reason) VALUES ('".$date."','".$account_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$veh_num."','".$transfer_company."','".$transfer_user_id."','".$selected_radio."','".$billing_main_user."','".$billing_separate_address."','".$reason."')";
	
 mysql_query($query);
 echo "<script>document.location.href ='list_transfer_the_vehicle.php'</script>";
//header('location: sales_request.php');
}}

?> 
<script type="text/javascript">
function validateForm()
{

 var sales_manager=document.forms["myForm"]["sales_manager"].value;
if (sales_manager==null || sales_manager=="")
  {
  alert("Select Sales Manager Name");
  return false;
  }
  
 var main_user_id=document.forms["myForm"]["TxtMainUserId"].value;
if (main_user_id==null || main_user_id=="")
  {
  alert("Select Username");
  return false;
  }

   var transfer_user_id=document.forms["myForm"]["TxttransferUserId"].value;
if (transfer_user_id==null || transfer_user_id=="")
  {
  alert("Select Transfer Username");
  return false;
  }
  
  var reason=document.forms["myForm"]["TxtReason"].value;
if (reason==null || reason=="")
  {
  alert("Enter reason");
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
            <td>
                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
        </tr>

		<tr>
            <td>Account Manager</td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
        </tr>
          <?php 
		//if($_SESSION['user_name']=='saleslogin') {
		?>
		<tr>
            <td>Sales Manager</td>
            <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
              <?php
        $sales_manager=select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
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
		<?php //} ?>
		   <tr>
            <td>
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            
         		<option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['transfer_from_user']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> >   <?php echo $main_user_id[$u]['name']; ?>
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
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['transfer_from_company']?>" readonly />
                </td>
        </tr>
 
        <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_veh']?>" readonly />
                </td>
        </tr>

		<tr>
<td>
 Vehicle to move</td>
<td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> <div id="ajaxdata">
<?=$result[0]['transfer_from_reg_no']?>
</div> 

</td>
</tr>
        <!-- <tr>
            <td>Paid/Unpaid</td>
            <td>
               <input type="text" name="transfer_from_paid_unpaid" value="Blocked" disabled="disabled" id="TxtPaidUnpaid" /></td>
        </tr> -->
       
            <tr>
            <td><h1>Transfer To</h1></td>
			<td></td>
            </tr>
             <tr>
            <td>
                User Name</td>
            <td>

<select name="transfer_user_id" id="TxttransferUserId" onchange="getCompanyName(this.value,'Transfercompany');">
            <option value="" >-- Select One --</option>
            <?php
			$main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            
           <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['transfer_to_user']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> >
        <?php echo $main_user_id[$u]['name']; ?>
					</option>
				  <?php 
								} 
 
  ?>
</select>



                </td>
        </tr>

		<tr>
            <td>
                Transfer Company Name</td>
            <td><input type="text" name="Transfercompany" id="Transfercompany" value="<?=$result[0]['transfer_to_company']?>" readonly />
                </td></tr>
       </table>
   
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
        <tr>
<td width="180"> <h1>Billing </h1></td>
		<td width="283">
		  <input type="radio" style="width:10px;"  name="billing_separate" id="TxtSeparate" value="main user" onclick="toggle_visibility('TxtSeparate');"<?php if($result[0]['transfer_to_billing']=="main user"){echo "checked=\"checked\""; }?>/>Main User
      	  <input type="radio"  style="width:10px;" name="billing_separate" id="TxtSeparate" value="separate" onclick="toggle_visibility('TxtMainUser');" <?php if($result[0]['transfer_to_billing']=="separate"){echo "checked=\"checked\""; }?>/> Separate
          <input type="radio" style="width:10px;"  name="billing_separate" id="TxtSeparate" value="Billing in Both" onclick="toggle_visibility('TxtSeparate');"<?php if($result[0]['transfer_to_billing']=="Billing in Both"){echo "checked=\"checked\""; }?>/>Billing in Both
		
		</td>
 <?php if($result[0]['transfer_to_billing']=="separate") { ?>
		 
	<tr id="new1">
		<td>&nbsp;</td>
		<td class="style1"><div id="TxtMainUser">Billing Name<br />
		<input type="text" name="billing_name" value="<?=$result[0]['billing_name']?>"  /><br />
				Billing Address<br />
				 <textarea rows="4" cols="25"  name="user_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
 </textarea> 
		 </div></td>
		</tr>
		
		<? } ?>
		<tr id="new">
	
		<td class="style1"><div id="TxtMainUser" style="display:none;">Billing Name<br />
		<input type="text" name="billing_name" value="<?=$result[0]['billing_name']?>"  /><br />
				Billing Address<br />
				 <textarea rows="4" cols="25"  name="user_address" id="TxtBillingAdd"><?=$result[0]['billing_address']?>
 </textarea> 
		 </div></td>
		</tr>
		
        </tr>
    </table>
    <table cellspacing="5" cellpadding="5" style=" padding-left: 100px;width: 500px;" >
	
        <tr>
            <td width="211" class="style2">
                Reason</td>
            <td width="252"> <textarea rows="4" cols="25"  name="reason" id="TxtReason" /><?=$result[0]['reason']?></textarea> 

          </td>
        </tr>
		<?php 
		if($action=='edit') {
		?>
		 <tr>
            <td class="style2">
                Sales Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="sales_comment" id="TxtSalesComment" ><? //$result[0]['sales_comment']?></textarea>
                </td>
        </tr>
		<?php } ?>
        <tr>
		<td class="submit"><input type="submit" name="submit" id="button1" value="Submit"  />
		<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_transfer_the_vehicle.php' " /></td>
		</tr>
    </table>

</form>
	 </div>
 
<?php
include("../include/footer.php"); ?>