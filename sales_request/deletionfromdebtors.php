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
		$result = select_query("select * from del_form_debtors where id=$id");	
	}
?> 

<div class="top-bar">
<h1>Delete from debtors</h1>
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
	$date_of_creation=$_POST["date_of_creation"];
	$sales_comment = $_POST['sales_comment'];
	$payment_status=$_POST["payment_status"];
	$sales_manager=$_POST["sales_manager"];
	$device_remove_status=$_POST["deviceremove"];
	if($device_remove_status=="Y"){
	$no_of_devices_removed=$_POST["no_of_devices_removed"];
	}
	else{
	$no_of_devices_removed="0";	
	}
	$reason=$_POST["reason"];

 
if($action=='edit')
	{
	
 $query="update del_form_debtors set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicle='".$tot_no_of_vehicles."',date_of_creation='".$date_of_creation."',device_remove_status='".$device_remove_status."',no_of_devices_removed='".$no_of_devices_removed."',reason='".$reason."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."',del_debtors_status=1 where id=$id";
 

 mysql_query($query);
echo "<script>document.location.href ='list_deletion_from_debtors.php'</script>";
	}
  else
  {
 
    $query="INSERT INTO `del_form_debtors` ( `date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `date_of_creation`, `total_no_of_vehicle`, `reason`,`device_remove_status`,`no_of_devices_removed`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."', '".$main_user_id."', '".$date_of_creation."', '".$tot_no_of_vehicles."', '".$reason."','".$device_remove_status."','".$no_of_devices_removed."');";


 mysql_query($query);
echo "<script>document.location.href ='list_deletion_from_debtors.php'</script>";
//header('location: sales_request.php');
}}

?>
 
 
<script type="text/javascript">
function validateForm()
{
 
	var sales_manager=document.forms["myForm"]["sales_manager"].value;
	if (sales_manager==null || sales_manager=="")
	{
	alert("Select Sales Person Name");
	return false;
	}
	
	var main_user_id=document.forms["myForm"]["TxtMainUserId"].value;
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
 //alert(radioValue);
 if(radioValue=="Y")
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

<select name="main_user_id" id="TxtMainUserId"  onchange="gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');getCreationDate(this.value,'date_of_creation')">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            
           <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> >
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
                Company Name</td>
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>" readonly />
                </td>
        </tr>

		  <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_vehicle']?>" readonly />
                </td>
        </tr>
    <tr>
            <td>
                Date Of Creation</td>
            <td><input type="text" name="date_of_creation" id="date_of_creation" value="<?=$result[0]['date_of_creation']?>" readonly />
                </td>
        </tr>
        
        <tr>
            <td>Device Removed</td>
            <td>

             <Input type = 'Radio' Name ='deviceremove'    value= 'Y' <?php if($result[0]['device_remove_status']=="Y"){echo "checked=\"checked\""; }?> onchange="Status(this.value)">Yes
            
            <Input type = 'Radio' Name ='deviceremove'    value= 'N' <?php if($result[0]['device_remove_status']=="N"){echo "checked=\"checked\""; }?> onchange="Status(this.value)" >No</td>
        </tr>
        <tr>
        	<td colspan="2">
            	<?php if($result[0]['device_remove_status']=="Y") { ?>
		  <table  id="devicerecord1" style="width: 300px; border:1" cellspacing="5" cellpadding="5">
			<tr>
             <td width="300px"> No of Removed Device</td>
              <td>
                <select name="no_of_devices_removed" id="no_of_devices_removed">
                    <option value="">-- Select One --</option>
                     <option value ="1"<?php if($result[0]['no_of_devices_removed']=='1'){ echo "selected=selected";} ?>>1</option>
                     <option value ="2"<?php if($result[0]['no_of_devices_removed']=='2'){ echo "selected=selected";} ?>>2</option>
                     <option value ="3"<?php if($result[0]['no_of_devices_removed']=='3'){ echo "selected=selected";} ?>>3</option>
                     <option value ="4"<?php if($result[0]['no_of_devices_removed']=='4'){ echo "selected=selected";} ?>>4</option>
                     <option value ="5"<?php if($result[0]['no_of_devices_removed']=='5'){ echo "selected=selected";} ?>>5</option>
                     <option value ="6"<?php if($result[0]['no_of_devices_removed']=='6'){ echo "selected=selected";} ?>>6</option>
                     <option value ="7"<?php if($result[0]['no_of_devices_removed']=='7'){ echo "selected=selected";} ?>>7</option>
                     <option value ="8"<?php if($result[0]['no_of_devices_removed']=='8'){ echo "selected=selected";} ?>>8</option>
                     <option value ="9"<?php if($result[0]['no_of_devices_removed']=='9'){ echo "selected=selected";} ?>>9</option>
                     <option value ="10"<?php if($result[0]['no_of_devices_removed']=='10'){ echo "selected=selected";} ?>>10</option>
                     <option value ="11"<?php if($result[0]['no_of_devices_removed']=='11'){ echo "selected=selected";} ?>>11</option>
                     <option value ="12"<?php if($result[0]['no_of_devices_removed']=='12'){ echo "selected=selected";} ?>>12</option>
                     <option value ="13"<?php if($result[0]['no_of_devices_removed']=='13'){ echo "selected=selected";} ?>>13</option>
                     <option value ="14"<?php if($result[0]['no_of_devices_removed']=='14'){ echo "selected=selected";} ?>>14</option>
                     <option value ="15"<?php if($result[0]['no_of_devices_removed']=='15'){ echo "selected=selected";} ?>>15</option>
                     <option value ="16"<?php if($result[0]['no_of_devices_removed']=='16'){ echo "selected=selected";} ?>>16</option>
                     <option value ="17"<?php if($result[0]['no_of_devices_removed']=='17'){ echo "selected=selected";} ?>>17</option>
                     <option value ="18"<?php if($result[0]['no_of_devices_removed']=='18'){ echo "selected=selected";} ?>>18</option>
                     <option value ="19"<?php if($result[0]['no_of_devices_removed']=='19'){ echo "selected=selected";} ?>>19</option>
                     <option value="20"<?php if($result[0]['no_of_devices_removed']=='20'){ echo "selected=selected";} ?>>20</option>
                </select>
                </td>
			  </tr>
		</table>
		<? } ?>
            
        <table  id="devicerecord" style="width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
			<tr>
             <td width="300px" > No of Removed Device</td>
              <td >
                <select name="no_of_devices_removed" id="no_of_devices_removed">
                    <option value="">-- Select One --</option>
                     <option value ="1"<?php if($result[0]['no_of_devices_removed']=='1'){ echo "selected=selected";} ?>>1</option>
                     <option value ="2"<?php if($result[0]['no_of_devices_removed']=='2'){ echo "selected=selected";} ?>>2</option>
                     <option value ="3"<?php if($result[0]['no_of_devices_removed']=='3'){ echo "selected=selected";} ?>>3</option>
                     <option value ="4"<?php if($result[0]['no_of_devices_removed']=='4'){ echo "selected=selected";} ?>>4</option>
                     <option value ="5"<?php if($result[0]['no_of_devices_removed']=='5'){ echo "selected=selected";} ?>>5</option>
                     <option value ="6"<?php if($result[0]['no_of_devices_removed']=='6'){ echo "selected=selected";} ?>>6</option>
                     <option value ="7"<?php if($result[0]['no_of_devices_removed']=='7'){ echo "selected=selected";} ?>>7</option>
                     <option value ="8"<?php if($result[0]['no_of_devices_removed']=='8'){ echo "selected=selected";} ?>>8</option>
                     <option value ="9"<?php if($result[0]['no_of_devices_removed']=='9'){ echo "selected=selected";} ?>>9</option>
                     <option value ="10"<?php if($result[0]['no_of_devices_removed']=='10'){ echo "selected=selected";} ?>>10</option>
                     <option value ="11"<?php if($result[0]['no_of_devices_removed']=='11'){ echo "selected=selected";} ?>>11</option>
                     <option value ="12"<?php if($result[0]['no_of_devices_removed']=='12'){ echo "selected=selected";} ?>>12</option>
                     <option value ="13"<?php if($result[0]['no_of_devices_removed']=='13'){ echo "selected=selected";} ?>>13</option>
                     <option value ="14"<?php if($result[0]['no_of_devices_removed']=='14'){ echo "selected=selected";} ?>>14</option>
                     <option value ="15"<?php if($result[0]['no_of_devices_removed']=='15'){ echo "selected=selected";} ?>>15</option>
                     <option value ="16"<?php if($result[0]['no_of_devices_removed']=='16'){ echo "selected=selected";} ?>>16</option>
                     <option value ="17"<?php if($result[0]['no_of_devices_removed']=='17'){ echo "selected=selected";} ?>>17</option>
                     <option value ="18"<?php if($result[0]['no_of_devices_removed']=='18'){ echo "selected=selected";} ?>>18</option>
                     <option value ="19"<?php if($result[0]['no_of_devices_removed']=='19'){ echo "selected=selected";} ?>>19</option>
                     <option value="20"<?php if($result[0]['no_of_devices_removed']=='20'){ echo "selected=selected";} ?>>20</option>
                </select>
                </td>
			  </tr>
		</table>
            
            </td>
        </tr>
        <tr>
            <td class="style2">
                Reason</td>
            <td>
                 <Textarea rows="5" cols="23" type="text" name="reason" id="TxtReason"><?=$result[0]['reason']?></textarea></td>
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

				<td class="submit"><input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();"/>
				   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deletion_from_debtors.php' " /></td>

		</tr>
     </table>
     </form>
	 </div>
 
<?php
include("../include/footer.php"); ?>

   
	 
  