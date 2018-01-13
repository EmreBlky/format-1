<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/
 
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
    	$result=select_query("select * from installation_request where id=$id");   
    }
?>

<div class="top-bar">
<h1>New Installation</h1>
</div>
<div class="table">
<?php

if(isset($_POST["submit"]))
{
 
   if($_SESSION['BranchId']==1){
        $account_manager= "saleslogin";
    }
    elseif($_SESSION['BranchId']==2){
        $account_manager= "msaleslogin";
    }
    elseif($_SESSION['BranchId']==3){
        $account_manager= "jsaleslogin";
    }
    elseif($_SESSION['BranchId']==6){
        $account_manager= "asaleslogin";
    }
    elseif($_SESSION['BranchId']==7){
        $account_manager= "ksaleslogin";
    }
 
  $date=$_POST["date"];
  $sales_manager=$_POST["account_manager"];
  $main_user_id=$_POST["main_user_id"];
  $potential=$_POST["potential"];
  $device_model=$_POST["device_model"];
  $vehicle_type=$_POST["vehicle_type"];
   
  $query=select_query("select id from sales_person where name='$sales_manager'");
  //while($sales=mysql_fetch_array($query))
  for($j=0;$j<count($query);$j++)
  {
    $sales_person = $query[$j]['id'];
  }
 
  $company=$_POST["company"];
  $sales_comment = $_POST["sales_comment"];
  $no_of_inst=$_POST["no_of_inst"];
  $payment=$_POST["payment"];
  $contact_person=$_POST["contact_person"];
  $contact_number=$_POST["contact_number"];
  $immobilizer=$_POST['immobilizer'];
  $ac_on_off=$_POST["ac_on_off"];
  $dimts=$_POST["dimts"];
    
    if($action=='edit')
        {
       
        $query="update installation_request set user_id='".$main_user_id."',company_name='".$company."',contact_person='".$contact_person."',contact_number='".$contact_number."',no_of_vehicals='".$no_of_inst."',model='".$device_model."',payment_req='".$payment."',veh_type='".$vehicle_type."',immobilizer_type='".$immobilizer."',ac_on_off='".$ac_on_off."',dimts='".$dimts."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d")." - " .$sales_comment."' where id=$id";
    
     mysql_query($query);
    echo "<script>document.location.href ='list_new_installation.php'</script>";
        }
      else
      {
         $query="insert into installation_request(req_date, request_by,sales_person,user_id, company_name,no_of_vehicals,model, veh_type,payment_req, installed_date,contact_person, contact_number, immobilizer_type, ac_on_off, installation_status, status, branch_id, dimts, branch_type, instal_reinstall, genrate_req_by) values('".$date."','".$account_manager."','".$sales_person."','".$main_user_id."','".$company."','".$no_of_inst."','".$device_model."','".$vehicle_type."','".$payment."',now(),'".$contact_person."','".$contact_number."','".$immobilizer."','".$ac_on_off."',7,1,'".$_SESSION['BranchId']."','".$dimts."','Samebranch','installation','".$_SESSION['user_name']."')";
    
      mysql_query($query);
     echo "<script>document.location.href ='list_new_installation.php'</script>";
     }
 
}

?>
    <script type="text/javascript">
         function Check() {
 
  if(document.myForm.TxtContactPerson.value=="")
  {
  alert("Please Enter Contact Person") ;
  document.myForm.TxtContactPerson.focus();
  return false;
  }
  if(document.myForm.TxtContactNumber.value=="")
  {
  alert("Please Enter Contact No. ") ;
  document.myForm.TxtContactNumber.focus();
  return false;
  }
   var TxtContactNumber=document.myForm.TxtContactNumber.value;
  if(TxtContactNumber!="")
        {
    var length=TxtContactNumber.length;
   
        if(length < 9 || length > 15 || TxtContactNumber.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.myForm.TxtContactNumber.focus();
        document.myForm.TxtContactNumber.value="";
        return false;
        }
        }
    if(document.myForm.TxtVehicleType.value=="")
    {
      alert("Please Enter Vehicle type") ;
      document.myForm.TxtVehicleType.focus();
      return false;
      }
            }
    </script>
    
<form method="POST" action="" name="myForm" onsubmit="return Check()">

    <table width="520" cellpadding="5" cellspacing="5" style=" padding-left: 100px;width: 500px;">
   
        <tr>
            <td width="114">Date</td>
            <td width="170">
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
       
        <select name="main_user_id" id="TxtMainUserId" onchange="getCompanyName(this.value,'TxtCompany');">
        <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
      <?php
            $main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 AND Branch_id=".$_SESSION['BranchId']." order by name asc");
            //while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
                    {
            ?>
        <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['user_id']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> ><?=$main_user_id[$u]['name']?>
       
       
       
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
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company_name']?>" readonly />    </td>
        </tr>

       <!-- <tr>
            <td>Potential</td>
            <td>
               <select name="potential" id="TxtPotentail" >
  <option value="" name="potential" id="TxtPotentail">-- Select One --</option>
 <option value="1-10" <? if($result[0]['potential']=='1-10') {?> selected="selected" <? } ?> >1-10</option>
  <option value="10-20" <? if($result[0]['potential']=='10-20') {?> selected="selected" <? } ?> >10-20</option>
  <option value="20-30" <? if($result[0]['potential']=='20-30') {?> selected="selected" <? } ?> >20-30</option>
   <option value="30-40" <? if($result[0]['potential']=='30-40') {?> selected="selected" <? } ?> >30-40</option>
  <option value="40-50" <? if($result[0]['potential']=='40-50') {?> selected="selected" <? } ?> >40-50</option>
  <option value="50-60" <? if($result[0]['potential']=='50-60') {?> selected="selected" <? } ?> >50-60</option>
  <option value="60-70" <? if($result[0]['potential']=='60-70') {?> selected="selected" <? } ?> >60-70</option>
  <option value="70-80" <? if($result[0]['potential']=='70-80') {?> selected="selected" <? } ?> >70-80</option>
  <option value="80-90" <? if($result[0]['potential']=='80-90') {?> selected="selected" <? } ?> >80-90</option>
   <option value="90-100" <? if($result[0]['potential']=='90-100') {?> selected="selected" <? } ?> >90-100</option>
</select>
          </td>
        </tr>-->
        <tr>
            <td>No of Installation</td>
            <td>
               <select name="no_of_inst" id="no_of_inst" >
  <option value="" name="no_of_inst" id="no_of_inst">-- Select One --</option>
 <option value="1" <? if($result[0]['no_of_vehicals']=='1') {?> selected="selected" <? } ?> >1</option>
  <option value="2" <? if($result[0]['no_of_vehicals']=='2') {?> selected="selected" <? } ?> >2</option>
  <option value="3" <? if($result[0]['no_of_vehicals']=='3') {?> selected="selected" <? } ?> >3</option>
   <option value="4" <? if($result[0]['no_of_vehicals']=='4') {?> selected="selected" <? } ?> >4</option>
  <option value="5" <? if($result[0]['no_of_vehicals']=='5') {?> selected="selected" <? } ?> >5</option>
  <option value="6" <? if($result[0]['no_of_vehicals']=='6') {?> selected="selected" <? } ?> >6</option>
  <option value="7" <? if($result[0]['no_of_vehicals']=='7') {?> selected="selected" <? } ?> >7</option>
  <option value="8" <? if($result[0]['no_of_vehicals']=='8') {?> selected="selected" <? } ?> >8</option>
  <option value="9" <? if($result[0]['no_of_vehicals']=='9') {?> selected="selected" <? } ?> >9</option>
   <option value="10" <? if($result[0]['no_of_vehicals']=='10') {?> selected="selected" <? } ?> >10</option>
</select>
          </td>
        </tr>
         <tr>
          <td>Device Model:</label></td>
        <td>
        <select name="device_model" id="device_model">
        <option value=""  >-- Select One --</option>
        <?php
       
        $device_type=select_query("SELECT * FROM `device_model`");
        //while ($data=mysql_fetch_assoc($device_type))
		for($d=0;$d<count($device_type);$d++)
        {
        ?>
      <option name="device_model" value="<?=$device_type[$d]['device_model']?>" <? if($result[0]['model']==$device_type[$d]['device_model']) {?> selected="selected" <? } ?> ><?=$device_type[$d]['device_model']?></option>
        <?php
        }
        ?>
        </select></td>
        </tr>    
        <tr>
            <td>
               <label for="Vehicle_Type" id="lblVehicleType">Vehicle Type</label></td>
            <td>
            <select name="vehicle_type" id="TxtVehicleType"  >
            <option value="" id="TxtVehicleType">-- select one --</option>
 
                <?
                $query=select_query("select * from veh_type");
                //while($data=mysql_fetch_array($query)) 
				for($v=0;$v<count($query);$v++)
				{
                 ?>
                <option value="<?=$query[$v]['veh_type']?>" <? if($result[0]['veh_type']==$query[$v]['veh_type']) {?> selected="selected" <? } ?> ><?=$query[$v]['veh_type']?></option>
                <? } ?>
 
              </select>

            </td>
        </tr>
        <tr>
            <td>
               <label for="dimtstype" id="dimtstype">Dimts Status</label></td>
            <td>
            <select name="dimts" id="dimtstype"  >
            <option value="" id="dimtstype">-- select one --</option>
 
                <option value="yes" <? if($result[0]['dimts']=='yes') {?> selected="selected" <? } ?> id="dimtstype">Yes</option>
            <option value="no" <? if($result[0]['dimts']=='no') {?> selected="selected" <? } ?> id="dimtstype">No</option>
             
 
  </select>

            </td>
        </tr>
         <tr>
            <td>Payment</td>
            <td>
                <input type="text" name="payment" id="payment" value="<?=$result[0]['payment_req']?>" /></td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>
                <input type="text" name="contact_person" id="TxtContactPerson" value="<?=$result[0]['contact_person']?>" /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td>
                <input type="value" name="contact_number" id="TxtContactNumber" value="<?=$result[0]['contact_number']?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
        </tr>
         
        <tr>
            <td>
               <label for="Imobillizer" id="lblImmobilizer">Immobilizer </label></td>
            <td>

            <Input type = 'Radio' Name ='immobilizer' id="TxtImmobilizer" value= 'Yes' <?php if($result[0]['immobilizer_type']=="Yes"){echo "checked=\"checked\""; }?>/> Yes

<Input type = 'Radio' Name ='immobilizer' value= 'No' <?php if($result[0]['immobilizer_type']=="No"){echo "checked=\"checked\""; }?>/> No
          </td>
        </tr>
        <tr>
            <td>
               <label for="AC" id="lblACStatus">AC </label></td>
            <td>
<Input type = 'Radio' Name ='ac_on_off'  id="TxtACStatus" value= 'on' <?php if($result[0]['ac_on_off']=="on"){echo "checked=\"checked\""; }?>/>Yes

<Input type = 'Radio' Name ='ac_on_off' id="TxtACStatus"  value= 'off' <?php if($result[0]['ac_on_off']=="off"){echo "checked=\"checked\""; }?>/>No
          </td>
        </tr>
       <?php
        if($action=='edit') {
        ?>
         <tr>
            <td class="style2">
                Sales Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="sales_comment" id="TxtSalesComment" ><?=$result[0]['sales_comment']?></textarea>
                </td>
        </tr>
        <?php } ?>
        <tr>
        <td></td>
       <td class="submit">
           <input id="Button1" type="submit" name="submit" value="submit" runat="server" />
           <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_new_installation.php' " /></td>
      </tr>
    </table>
  </form>
   </div>
 
<?php
include("../include/footer.php"); ?>