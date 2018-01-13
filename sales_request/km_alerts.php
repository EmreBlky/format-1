<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/
 

if($_GET["rowid"])
{
	echo $_GET["rowid"];
} 
?> 

<div class="top-bar">
<h1>Sub User Creation</h1>
</div>
<div class="table"> 
<?


if(isset($_POST["submit"]))
{

	$date=(isset($_POST["date"])) ? trim($_POST["date"])  : "";
$company=(isset($_POST["company"])) ? trim($_POST["company"]): "";
$acc_manager=(isset($_POST["acc_manager"])) ? trim($_POST["acc_manager"]): "";
$main_user_id=(isset($_POST["main_user_id"])) ? trim($_POST["main_user_id"]): "";
$total_no_of_vehicles=(isset($_POST["total_no_of_vehicles"])) ? trim($_POST["total_no_of_vehicles"]): "";
$potential=(isset($_POST["potential"])) ? trim($_POST["potential"]): "";
$contact_person=(isset($_POST["contact_person"])) ? trim($_POST["contact_person"]): "";
$contact_number=(isset($_POST["contact_number"])) ? trim($_POST["contact_number"]): "";
$types_of_alert=(isset($_POST["types_of_alert"])) ? trim($_POST["types_of_alert"]): "";
$via_sms_mail=(isset($_POST["via_sms_mail"])) ? trim($_POST["via_sms_mail"]): "";

  $query="insert into km_alerts(date,company,acc_manager,main_user_id,total_no_of_vehicles,potential,contact_person,contact_number,types_of_alert,via_sms_mail)values('".$date."','".$acc_manager."','".$company."','".$main_user_id."','".$total_no_of_vehicles."','".$potential."','".$contact_person."',".$contact_number.",'".$types_of_alert."','".$via_sms_mail."')";

mysql_query($query);
//header('location: sales_request.php');
echo "<script>document.location.href ='sales_request.php'</script>";
}

?>

 
 
 <script>

  
  
  function toggle_visibility(id) {
	if(id=='TxtSMSMail1')
		{
		var e = document.getElementById('TxtSMSMail2');
		 e.style.display = 'none';
		}
		else
		{
       var e = document.getElementById(id);
       
          e.style.display = 'block';
		  
		  }
		
    }	
	
	
	
	 function toggle_visibility(id) {
	if(id=='TxtSMSMail3')
		{
		var e = document.getElementById('TxtSMSMail4');
		 e.style.display = 'none';
		}
		else
		{
       var e = document.getElementById(id);
       
          e.style.display = 'block';
		  
		  }
		
    }	
  
  
  </script>

    <script type="text/javascript">
        function Check() {
            var Date = document.getElementById('datepicker1');
            var AccountManager = document.getElementById('TxtAccManager');
            var Company = document.getElementById('TxtCompany');
            var MainUserId = document.getElementById('MainUserId');
            var Total = document.getElementById('TxtTotal');
            var Potential = document.getElementById('TxtPotential');
            var ContactPerson = document.getElementById('TxtContactPerson');
            var ContactNumber = document.getElementById('TxtContactNumber');
            var Type = document.getElementById('TxtType');
            var SMSMail = document.getElementById('TxtSMSMail');
            if (Date.value == '') {

                alert('Please Enter Date!!');
                return false;
            }
            else if (AccountManager.value == '') {
                alert('Please Enter Account Manager!!');
                return false;
            }
            else if (Company.value == '') {
                alert('Please Enter Company!!');
                return false;
            }
            else if (MainUserId.value == '') {
                alert('Please Enter Main User Id!!');
                return false;
            }
            else if (Total.value == '') {
                alert('Please Enter Total!!');
                return false;
            }
            else if (Potential.value == '') {
                alert('Please Enter Potential!!');
                return false;
            }
            else if (ContactPerson.value == '') {
                alert('Please Enter Contact Person!!');
                return false;
            }
            else if (ContactNumber.value == '') {
                alert('Please Enter ContactNumber!!');
                return false;
            }
            else if (Type.value == '') {
                alert('Please Enter Type of Alerts!!');
                return false;
            }
            else if (SMSMail.value == '') {
                alert('Please Enter SMS/Mail value!!');
                return false;
            }
            else {
                return true;
            }
            
        
        }
    
    </script>
 
<div align="center">
<div style="margin-left:200px;">
<form action="" method="post">
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
               <tr>
            <td>
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId"  onchange="gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			//showUser(this.value);
			$main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            
            <option name="main_user_id" value ="<?php echo $main_user_id[$u]['user_id'] ?>" >
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
            <td><input type="text" name="company" id="TxtCompany" readonly />
                </td>
        </tr>

        <tr>
            <td>
                Total No Of Vehicle</td>
            <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" />
                </td>
        </tr>

    <tr>
        <td>
            Potential</td>
        <td><input type="text" name="potential" id="TxtPotential" />
           </td>
    </tr>
    <tr>
        <td>
            Contact Person</td>
        <td><input type="text" name="contact_person" id="TxtContactPerson" />
           </td>
    </tr>
    <tr>
        <td>
            Contact Number</td>
        <td><input type="text" name="contact_number" id="TxtContactNumber" />
           </td>
    </tr>
    <tr>
        <td>
            Type Of Alert</td>
        <td>
		<select name="types_of_alert" id="TxtType" style="width:220px; height:30px;">
			<option value="" id="TxtType">-- select one --</option>
  <option value="Ac Alerts" id="TxtType">Ac Alerts</option>
  <option value="Non jurnery" id="TxtType">Non jurnery</option>
  <option value="Location Alerts" id="TxtType">Location Alerts</option>
  <option value="POI Alerts" id="TxtType">POI Alerts</option>
  <option value="Ignition Alerts" id="TxtType">Ignition Alerts</option>
  </select>
		
           </td>
    </tr>
    <tr>
       <td> <h3>
        
        Via SMS/Mail</h3></td>
    <td> If sms<input type="radio"  id="TxtSMSMail1" onclick="toggle_visibility('TxtSMSMail2');"/>
        If mail<input type="radio" id="TxtSMSMai3" onclick="toggle_visibility('TxtSMSMail4');" />
        
        <div id="TxtSMSMail2" style="display:none;"> Mobile no
	<input type="text" name="via_sms_mail" id="TxtSMSMai" value="" /></div>
        
     <div id="TxtSMSMail4" style="display:none; margin-left:13px;"> Email id
	<input type="text" name="via_sms_mail" id="TxtSMSMai" /></div>   
        
       </td>    
        
    <tr><td class="submit"> <input type="submit" id="button1" name="submit" value="Submit" onclick="return Check();" /></td></tr>
   
</table>

</form>
</div>
</body>
</html>
