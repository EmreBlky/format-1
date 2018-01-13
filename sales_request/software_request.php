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

$action = $_GET['action'];
$id = $_GET['id'];
$page = $_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result=select_query("select * from software_request where id=$id");	
	}
?>

<div class="top-bar">
  <h1>Software Request</h1>
</div>
<div class="table">
  <?
for ($i=0; $i<count($_REQUEST['mode']);$i++) {
$alert=implode(',',$_REQUEST['mode']);
 }
 
 for ($i=0; $i<count($_REQUEST['report']);$i++) {
$report=implode(',',$_REQUEST['report']);
 }
 

if(isset($_POST["submit"]))
{
	$date=$_POST["date"];
	$acc_manager=$_POST["account_manager"];
	$company=$_POST["company"];
	$main_user_id=$_POST["main_user_id"];
	$tot_no_of_vehicles=$_POST["tot_no_of_vehicles"];
	$potential=$_POST["potential"]; 
	$GoogleMap=$_POST["GoogleMap"];
	$admin=$_POST["admin"];
	$types_of_alert=$alert;
	$sales_manager=$_POST["sales_manager"];
	
	$rs_others=$_POST["rs_others"];
	$Customize_report=$_POST["Customize_report"];
	$alert_contactNum=$_POST["alert_contactNum"];
	$ContactNUm=$_POST["ContactNUm"];
	$sales_comment = $_POST['sales_comment'];
	$payment_status=$_POST["payment_status"];

	if($types_of_alert=="") {
	$types_of_alert_edit=$result[0]['alert'];
	}
	else {
	$types_of_alert_edit=$alert;
	}
	
	if($report=="") {
	$report_edit=$result[0]['reports'];
	}
	else {
	$report_edit=$report;
	}

 if($action=='edit')
	{
	
	$query="update software_request set acc_manager='".$acc_manager."',sales_manager='".$sales_manager."',main_user_id='".$main_user_id."',company='".$company."',total_no_of_vehicles='".$tot_no_of_vehicles."',potential='".$potential."',rs_customize_report='".$Customize_report."',rs_others='".$rs_others."',reports='".$report_edit."',alert='".$types_of_alert_edit."',alert_contact='".$alert_contactNum."',client_contact_num='".$ContactNUm."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$sales_comment."',software_status=1 where id=$id";
 
 //client_contact_num='".$ContactNUm."'
 
 mysql_query($query);
echo "<script>document.location.href ='list_software_request.php'</script>";
	}
  else
  { 
	$query="INSERT INTO `software_request` (`date`, `acc_manager`,`sales_manager`, `company`, `main_user_id`, `total_no_of_vehicles`, `potential`, `rs_google_map`, `rs_customize_report`, `rs_admin`, alert,reports,`rs_others`,`alert_contact`, `client_contact_num`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$company."','".$main_user_id."','".$tot_no_of_vehicles."','".$potential."','".$GoogleMap."','".$Customize_report."','".$admin."','".$types_of_alert."','".$report."','".$rs_others."','".$alert_contactNum."','".$ContactNUm."');";
	
	mysql_query($query);
	//header('location: sales_request.php');
	echo "<script>document.location.href ='list_software_request.php'</script>";
 }
}

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
	 
	 var main_user_id=document.forms["myForm"]["main_user_id"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Select Username");
	  return false;
	  } 
	var potential=document.forms["myForm"]["TxtPotential"].value;
	if (potential==null || potential=="")
	  {
	  alert("Enter Potential");
	  return false;
	  }
	  
	 var ContactNUm=document.myForm.ContactNUm.value;
	 if (ContactNUm==null || ContactNUm=="")
	  {
	  alert("Enter Client Contact Number");
	  return false;
	  }
	  
      if(ContactNUm!="")
		{
			var length=ContactNUm.length;
			
			if(length < 9 || length > 15 || ContactNUm.search(/[^0-9\-()+]/g) != -1 )
			{
			alert('Please enter valid mobile number');
			document.myForm.ContactNUm.focus();
			document.myForm.ContactNUm.value="";
			return false;
			}
		}
		
		var sales_comment=document.forms["myForm"]["TxtSalesComment"].value;
		if (sales_comment==null || sales_comment=="")
		{
		alert("Enter Sales Comment");
		return false;
		}
	 /* var main_user_id=document.forms["myForm"]["TxtOther"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Enter Alert Info");
	  return false;
	  }
	  var main_user_id=document.forms["myForm"]["Customize_report"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Enter Customize Report");
	  return false;
	  }
	  var main_user_id=document.forms["myForm"]["alert_contactNum"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Enter Alert contact Number");
	  return false;
	  }
		
	  
	  var main_user_id=document.forms["myForm"]["ContactNUm"].value;
	if (main_user_id==null || main_user_id=="")
	  {
	  alert("Enter client no.");
	  return false;
	  }*/
	 
	}

</script>
  <form name="myForm" action="" enctype="multipart/form-data" onsubmit="return validateForm()" method="post">
    <table width="589" cellpadding="5" cellspacing="5" style=" padding-left: 100px;width: 550px;">
      <tr>
        <td width="176">Date</td>
        <td width="157"><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
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
        $sales_manager=select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
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
			$main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
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
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>" readonly /></td>
      </tr>
      <tr>
        <td> Total No Of Vehicle</td>
        <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_vehicles']?>" /></td>
      </tr>
      <tr>
        <td> Potential</td>
        <td><input type="text" name="potential" id="TxtPotential" value="<?=$result[0]['potential']?>" /></td>
      </tr>
      <!--   <tr>
        <td>
            Payment Status</td>
        <td><input type="text" name="pay_status" value="Blocked" disabled="disabled" id="TxtPaymentStatus" />
        </td>
    </tr> -->
      <tr>
        <td align="right"><h2 align="left" style="font-size: 14px">Requested Alerts</h2></td>
      </tr>
      <tr>
        <td class="style1"><input type="checkbox" name="GoogleMap" value="GoogleMap" <?php if($result[0]['rs_google_map']=="GoogleMap"){echo "checked=\"checked\""; }?> />
          GoogleMap </td>
        <td class="style1"><div align="left">
            <input type="checkbox" name="admin" value="Admin link" <?php if($result[0]['rs_admin']=="Admin link"){echo "checked=\"checked\""; }?> />
            Admin Link </div></td>
        <td width="165" class="style1"><input type="checkbox" name="mode[]" id="mode" value="AC"  />
          AC Alert </td>
      </tr>
      <tr>
        <td class="style1"><input type="checkbox" name="mode[]" id="mode" value="Location"  />
          Location </td>
        <td class="style1"><div align="left">
            <input type="checkbox" name="mode[]" id="mode" value="Non Journey" />
            Non Journey </div></td>
        <td class="style1"><input type="checkbox" name="mode[]" id="mode" value="POI" />
          POI Alert </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="mode[]" id="mode" value="Document Renewal" />
          Document Renewal </td>
        <td class="style1"><div align="left">
            <input type="checkbox" name="mode[]" id="mode" value="Over Speed" />
            Over Speed </div></td>
        <td class="style1"><input type="checkbox" name="mode[]" id="mode" value="Idle Time" />
          Idle Time Alert </td>
      </tr>
      <tr>
        <td align="right"><h2 align="left" style="font-size: 14px">Requested Reports</h2></td>
      </tr>
      <tr>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="Cuurent Month"  />
          Cuurent Month </td>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="Monthly Analysis" />
          Monthly Analysis </td>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="Device Analysis" />
          Device Analysis </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="report[]" id="report" value="Performance Report" />
          Performance Report </td>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="AC Report" />
          AC Report </td>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="TollTax Report" />
          TollTax Report </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="report[]" id="report" value="Customized Journey" />
          Customized Journey </td>
        <td class="style1"><input type="checkbox" name="report[]" id="report" value="Movement status" />
          Movement status </td>
        <td class="style1">
      </tr>
      <tr>
        <td class="style1"> Other Alert/ Info</td>
        <td><input type="text" name="rs_others" id="TxtOther" value="<?=$result[0]['rs_others']?>"/></td>
      </tr>
      <tr>
        <td class="style1"> Customize Report</td>
        <td><Textarea rows="5" cols="23" type="text" name="Customize_report" id="TxtReason"><?=$result[0]['rs_customize_report']?>
</textarea></td>
      </tr>
      <tr>
        <td> Upload PDF/Excel</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input name="uploaded_file" type="file" />
      </tr>
      <tr>
        <td class="style1"> Alert Contact Number</td>
        <td><input type="text" name="alert_contactNum" id="alert_contactNum" value="<?=$result[0]['alert_contact']?>"/></td>
      </tr>
      <tr>
        <td class="style1"> Client Contact Number</td>
        <td><input type="text" name="ContactNUm" id="ContactNUm" value="<?=$result[0]['client_contact_num']?>"/></td>
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
        <td class="submit" colspan="2"><input type="submit" name="submit" id="button1" value="Submit" onclick="return Check();" />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_software_request.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); 

//Сheck that we have a file
if((!empty($_FILES["uploaded_file_add"])) && ($_FILES['uploaded_file']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file_add']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
   if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file_add"]["type"] == "image/jpeg") || ($_FILES["uploaded_file_add"]["type"] == "image/png") || ($_FILES["uploaded_file_add"]["type"] == "image/gif")) &&
    ($_FILES["uploaded_file_add"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = 'C:/xampp/htdocs/format/PDFExcel/'.$main_user_id.'_'.$file_ext2;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file_add']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file_add"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}
?>
