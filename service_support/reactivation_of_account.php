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
	$result=mysql_fetch_array(mysql_query("select * from reactivation_of_account where id=$id"));	
	}
?> 

<div class="top-bar">
<h1>Reactivation Of Account</h1>
</div>
<div class="table"> 

<?

$tot_no_of_vehicles=0;
if(isset($_POST["submit"]))
{
	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$company=$_POST["company"];
	$main_user_id=$_POST["main_user_id"];
	$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
	$reactivate_account_status=$_POST["reactivate_account"];
	$sales_comment = $_POST["sales_comment"];
	$sales_manager=$_POST["sales_manager"];
	$reason=$_POST["reason"];


	if($action=='edit')
	{
	
		$query="update reactivation_of_account set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',reactivate_account_status='".$reactivate_account_status."',reason='".$reason."',sales_comment='".$result["sales_comment"]."<br/>".date("Y-m-d")." - " .$sales_comment."',reactivation_status=1 where id=$id";
		
		
		mysql_query($query);
		echo "<script>document.location.href ='list_reactivate_of_account.php'</script>";
	}
	 else
	  {
	
		$query="INSERT INTO `reactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`reactivate_account_status`,`reason`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$reactivate_account_status."','".$reason."')";
		
		mysql_query($query) or die(mysql_error());
		echo "<script>document.location.href ='list_reactivate_of_account.php'</script>";
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

			//date,account_manager,main_user_id,company,tot_no_of_vehicles,tot_no_of_vehicles,contact_number,name,req_sub_user_pass,billing_separate,billing_name,reason
	  var main_user_id=document.forms["myForm"]["main_user_id"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Select Username");
	  return false;
	  }

	var main_user_id=document.forms["myForm"]["reason"].value;
	if (main_user_id==null || main_user_id=="")
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
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId"  onchange="gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
 
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id=mysql_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
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
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result['company']?>"  readonly />
                </td>
        </tr>

		  <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result['total_no_of_vehicles']?>"  readonly />
                </td>
        </tr>
        <tr>
            <td>Reactivate Account</td>
            <td>

             <Input type = 'Radio' Name ='reactivate_account' value= 'Y' <?php if($result['reactivate_account_status']=="Y"){echo "checked=\"checked\""; }?> >Yes
            
            <Input type = 'Radio' Name ='reactivate_account' value= 'N' <?php if($result['reactivate_account_status']=="N"){echo "checked=\"checked\""; }?> >No</td>
        </tr>
        
   </table>
       

		
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
	
        <tr>
            <td width="173" class="style2">
                Reason</td>
            <td width="290">
          <Textarea rows="5" cols="23" type="text" name="reason" id="TxtReason"><?=$result['reason']?></textarea></td>
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
		
		<td class="submit"><input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();"/>
	<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_reactivate_of_account.php' " /></td>
		</tr>
     </table>
    </form>
	 </div>
 
<?php
include("include/footer.php"); ?>

   
	 
  