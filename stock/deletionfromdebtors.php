<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_stock.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_stock.php");*/

 $action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
	$result=mysql_fetch_array(mysql_query("select * from del_form_debtors where id=$id"));	
	}
?> 

<div class="top-bar">
<h1>Delete from debtors</h1>
</div>
<div class="table"> 

<?


 
$temprary= 'checked';
$permanent = 'unchecked';
if(isset($_POST["submit"]))
{
$date=$_POST["date"];
$acc_manager=$_POST["account_manager"];
$company=$_POST["company"];
$main_user_id=$_POST["main_user_id"];
$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
$date_of_creation=$_POST["date_of_creation"];
//$stock_comment = $_POST['stocks_comment'];
$payment_status=$_POST["payment_status"];
$sales_manager=$_POST["sales_manager"];
$device_remove_status=$_POST["deviceremove"];
$reason=$_POST["reason"];

$no_devices_removed=$_POST["no_devices_removed"];

for($N=1;$N<=$no_devices_removed;$N++)
	{
	$deviceIMEI=(isset($_POST["DeviceIMEI$N"])) ? trim($_POST["DeviceIMEI$N"])  : "";
	$other_deviceIMEI=$_REQUEST["otherDeviceIMEI$N"];
	$clientlist=(isset($_POST["userRecord$N"])) ? trim($_POST["userRecord$N"])  : "";
	$devicelocation=(isset($_POST["devicelocation$N"])) ? trim($_POST["devicelocation$N"])  : "";
  
 if(($deviceIMEI!="" or $other_deviceIMEI!="" ) && $clientlist!="")
   {
	 $query="INSERT INTO `stock_del_form_debtors` ( `del_debtors_id`,`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `date_of_creation`, `total_no_of_vehicle`, `reason`,`device_remove_status`,`no_device_removed`,`imei_of_removel_devices`,`other_imei_removed`,`client`,`device_location`) VALUES ('".$id."','".$date."','".$acc_manager."','".$sales_manager."','".$company."', '".$main_user_id."', '".$date_of_creation."', '".$tot_no_of_vehicles."', '".$reason."','".$device_remove_status."','".$no_devices_removed." device removed"."','".$deviceIMEI."','".$other_deviceIMEI."','".$clientlist."','".$devicelocation."');";

 	mysql_query($query) or die(mysql_error());
	}
  }
	
	 $query1="update del_form_debtors set no_device_removed='".$no_devices_removed." device removed"."' where id=$id";
	mysql_query($query1) or die(mysql_error());
	echo "<script>document.location.href ='list_deletion_from_debtors.php'</script>";
}

?>
 
 
<script type="text/javascript">
    function validateForm()
			{

				//date,account_manager,main_user_id,company,tot_no_of_vehicles,tot_no_of_vehicles,contact_number,name,req_sub_user_pass,billing_separate,billing_name,reason
 

			 
			  var main_user_id=document.forms["myForm"]["main_user_id"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Select Username");
			  return false;
			  }
			
			var no_of_device=document.forms["myForm"]["no_devices_removed"].value;
			if (no_of_device==null || no_of_device=="")
			  {
			  alert("Select No of Removed Device");
			  return false;
			  }

			 var main_user_id=document.forms["myForm"]["reason"].value;
			if (main_user_id==null || main_user_id=="")
			  {
			  alert("Enter Reason");
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

function DetailFromDebtors(value,UserId)
{
	//alert(value);
	var rootdomain="http://"+window.location.hostname
var loadstatustext="<img src='"+rootdomain+"/images/icons/other/waiting.gif' />"
document.getElementById("DetailFromDebtors").innerHTML=loadstatustext; 
$.ajax({
		type:"GET",
		url:"userInfo.php?action=DetailFromDebtors",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 //data:"RowId="+value,
		 data:"RowId="+value+"&UserId="+UserId,
		success:function(msg){
			 
		document.getElementById("DetailFromDebtors").innerHTML = msg;
						
		}
	});
} 			

function showUser1(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=getdataDebtors",

		data:"user_id="+user_id,
		success:function(msg){
				
		document.getElementById(setDivId).value = msg;
		//alert(msg);				
		}
	});
}

 </script>
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
         <!--<tr>
            <td  colspan="2"><?=$errMSG;?></td>
         </tr>-->
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
		if($_SESSION['user_name']=='saleslogin') {
		?>
		<tr>
            <td>Sales Manager</td>
            <td><select name="sales_manager" id="sales_manager" >
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
		<?php } ?>
               <tr>
            <td>
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId"  readonly="readonly">
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
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result['company']?>" readonly />
                </td>
        </tr>

		  <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result['total_no_of_vehicle']?>" readonly />
                </td>
        </tr>
    <tr>
            <td>
                Date Of Creation</td>
            <td><input type="text" name="date_of_creation" id="date_of_creation" value="<?=$result['date_of_creation']?>" readonly />
                </td>
        </tr>
        
        <tr>
            <td>Device Removed</td>
            <td>

             <Input type = 'Radio' Name ='deviceremove'    value= 'Y' <?php if($result['device_remove_status']=="Y"){echo "checked=\"checked\""; }?>  readonly="readonly">Yes
            
            <Input type = 'Radio' Name ='deviceremove'    value= 'N' <?php if($result['device_remove_status']=="N"){echo "checked=\"checked\""; }?>  readonly="readonly">No</td>
        </tr>
        <tr>
        	<td colspan="2">
		  <table  id="devicerecord1" style="width: 300px; border:1" cellspacing="5" cellpadding="5">
			<tr>
             <td width="300px"> No of Removed Device</td>
              <td>
                <select name="no_devices_removed" id="no_devices_removed" onchange="DetailFromDebtors(this.value,<?echo $result['user_id']?>)">
                    <option value="">-- Select One --</option>
                     <option value ="0">0</option>
                     <option value ="1">1</option>
                     <option value ="2">2</option>
                     <option value ="3">3</option>
                     <option value ="4">4</option>
                     <option value ="5">5</option>
                     <option value ="6">6</option>
                     <option value ="7">7</option>
                     <option value ="8">8</option>
                     <option value ="9">9</option>
                     <option value ="10">10</option>
                     <option value ="11">11</option>
                     <option value ="12">12</option>
                     <option value ="13">13</option>
                     <option value ="14">14</option>
                     <option value ="15">15</option>
                     <option value ="16">16</option>
                     <option value ="17">17</option>
                     <option value ="18">18</option>
                     <option value ="19">19</option>
                     <option value="20">20</option>
                     <option value ="21">21</option>
                     <option value ="22">22</option>
                     <option value ="23">23</option>
                     <option value ="24">24</option>
                     <option value ="25">25</option>
                     <option value ="26">26</option>
                     <option value ="27">27</option>
                     <option value ="28">28</option>
                     <option value ="29">29</option>
                     <option value ="30">30</option>
                     <option value ="31">31</option>
                     <option value ="32">32</option>
                     <option value ="33">33</option>
                     <option value ="34">34</option>
                     <option value ="35">35</option>
                     <option value ="36">36</option>
                     <option value ="37">37</option>
                     <option value ="38">38</option>
                     <option value ="39">39</option>
                     <option value="40">40</option>
                     <option value ="41">41</option>
                     <option value ="42">42</option>
                     <option value ="43">43</option>
                     <option value ="44">44</option>
                     <option value ="45">45</option>
                     <option value ="46">46</option>
                     <option value ="47">47</option>
                     <option value ="48">48</option>
                     <option value ="49">49</option>
                     <option value ="50">50</option>
                </select>
                </td>
			  </tr>
		</table>
            
            </td>
        </tr>
        <tr>
        	<td colspan="2"> 
                <div id="DetailFromDebtors">        
                 </div>
            </td>
        </tr>
        <tr>
            <td class="style2">
                Reason</td>
            <td>
                 <Textarea rows="5" cols="23" type="text" name="reason" id="TxtReason" readonly="readonly"><?=$result['reason']?></textarea></td>
        </tr>
		<?php 
		//if($action=='edit') {
		?>
		 <!--<tr>
            <td class="style2">
                Stock Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="stocks_comment" id="TxtStockComment" ><?=$result['stock_comment']?></textarea>
                </td>
        </tr>-->
		<?php //} ?>
                <tr>

				<td class="submit"><input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();"/>
				   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deletion_from_debtors.php' " /></td>

		</tr>
     </table>
	 </div>
 
<?php
include("../include/footer.php"); ?>

   
	 
  