<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];


?>
<div class="top-bar">
<h1>Device Commands</h1>
</div>
<div class="table"> 

    <?php
 $veh_reg=$_POST["veh_reg_replce"];
 $device_imei=$_POST["replaceDeviceIMEI"]; 
 $device_mobile=$_POST["Devicemobile"]; 
 $port_change=$_POST["port_change"]; 
 $device_model=$_POST["device_model"]; 

/*if($device_model=='pointer') {

apn_change=
41_c_ reliance string
02 F0 FF 05 00 00 01 07 72 63 6F 6D 6E 65 74 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 04 00 00 00 00
31_o_ reliance string
02 F0 FF 05 00 00 01 07 72 63 6F 6D 6E 65 74 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 01 2E DF EE E7

41_c_ Airtel
02 F0 FF 05 00 00 01 0E 61 69 72 74 65 6C 67 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 04 00 00 00 00
31_0_ Airtel
02 F0 FF 05 00 00 01 0E 61 69 72 74 65 6C 67 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 01 2E DF EE E7

31_o_ vodafone
02 F0 FF 05 00 00 01 03 77 77 77 6D 6E 65 74 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 01 2E DF EE E7
41_c_vodafone
02 F0 FF 05 00 00 01 03 77 77 77 6D 6E 65 74 70 72 73 2E 
03 FF FF 63 6F 6D 00 00 00 00 00 00 00 00 00 00 00 00 00 
04 03 00 00 00 3E 65 73 CB 05 00 E8 03 04 04 00 00 00 00


}
elseif($device_model=='visiontek') {
reset=*777#001#
backlog *222#001#

airtel=*999#001#airtelgprs.com#
reliance=*999#001#rcomnet#
vodo=*999#001#www#


}
elseif($device_model=='teltonika') {
reset=opa opa cpurest
immobilizer=
}
elseif($device_model=='atlanta') {
apn_chnge=
reset=
}*/



?>
    <script type="text/javascript">
      function port_change()
			{
   }
   function immobilize()
			{
   }
   function apn_change()
			{
   }
   function reset_device()
			{
   }
   function backlog()
			{
   }
   
   </script>
   
</div>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
 <div align="right">
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
 </div>

 <form name="myForm" action="" onSubmit="return validateForm()" method="post">
   <table width="548" cellpadding="5" cellspacing="5" style=" padding-left: 100px;width: 500px;">
     <tr>
       <td width="171"> User Name</td>
       <h2></h2>
       <td width="144"><select name="main_user_id" id="main_user_id"  onchange="showUserreplace(this.value,'ajaxdatareplace'); getCompanyName(this.value,'Company');">
           <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
           <?php
			$data = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($i=0;$i<count($data);$i++)
			{
			?>
           <option   value="<?=$data[$i]['user_id']?>" <? if($result['user_id']==$data[$i]['user_id']) {?> selected="selected" <? } ?>> <?php echo $data[$i]['name']; ?> </option>
           <?php 
			} 
			?>
         </select>       </td>
     </tr>
     <tr>
       <td> Vehicle No</td>
       <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> -->
           <div id="ajaxdatareplace">
             <?=$result['veh_reg']?>
         </div></td>
     </tr>
     <tr>
       <td><label for="DeviceIMEI"  id="lblDeviceImei">Device IMEI</label></td>
       <td><input type="text" name="replaceDeviceIMEI" id="replaceDeviceIMEI" readonly value=""/></td>
     </tr>
     <tr>
       <td><label  id="lbDlDate">Device Sim Number</label></td>
       <td><input type="text" name="Devicemobile" id="Devicemobile" readonly value=""/></td>
     </tr>
     <tr>
       <td> Device Model</td>
       <td><select name="device_model" id="device_model" >
           <option value="" name="device_model" id="device_model">-- Select One --</option>
           <option value="pointer">Pointer</option>
           <option value="visiontek">Visiontek</option>
           <option value="teltonika">Teltonika</option>
           <option value="atlanta">Atlanta</option>
         </select>       </td>
     </tr>
     <tr>
       <td><label  id="lbDlDate">Changed to Port</label></td>
       <td><select name="port_change" id="port_change" >
           <option value="" name="port_change" id="port_change">-- Select One --</option>
           <option value="14005">14005</option>
           <option value="14002">14002</option>
           <option value="14000">14000</option>
           <option value="13999">13999</option>
           <option value="13998">13998</option>
           <option value="36000">36000</option>
       </select></td>
     </tr>
     <tr>
       <td></td>
     </tr>
     <tr>
       <td><input type="button" name="port_change" value="Port change" onclick="return port_change()"  /></td>
       <td>
          <div align="center">
             <input type="button" name="immobilize" value="Immobilize" onclick="return immobilize()"  />
             </div></td><td width="181"><div align="left">
           <input type="button" name="apn_change" value="APN Change" onclick="return apn_change()"  />
       </div></td>
     </tr>
     <tr>
       <td><input type="button" name="reset_device" value="Reset Device" onclick="return reset_device()" /></td>
       <td>
          <div align="center">
             <input type="button" name="backlog" value="Backlog clear" onclick="return backlog()" />
             </div></td></tr>
   </table>
 </form>
</div>
 
<?php
include("../include/footer.php"); ?>
