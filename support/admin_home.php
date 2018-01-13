<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header_admin_home.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header_admin_home.php");*/
 ?>

<div class="top-bar1">
  <h1> </h1>
</div>
<div  >
  <table>
    <tr>
      <td><div id="left-column"> <a href="accountcreation.php" style="text-decoration:none">
          <h3>New Account Creation <font color="#606060"> </font> </h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_device_change.php" style="text-decoration:none">
          <h3> Device Change</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_no_bill.php" style="text-decoration:none">
          <h3> NO BILLS</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_stop_gps.php" style="text-decoration:none">
          <h3>Stop GPS </h3>
          </a> </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><div id="left-column"> <a href="list_sub_user_creation.php" style="text-decoration:none">
          <h3> Sub User Creation </h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_deactivate_of_account.php" style="text-decoration:none">
          <h3>Deactivation of account</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_no_bill.php" style="text-decoration:none">
          <h3>Billing</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_delete_vehicle.php" style="text-decoration:none">
          <h3>Deletion </h3>
          </a> </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><div id="left-column"> <a href="list_new_device_addition.php" style="text-decoration:none">
          <h3> New device Addition</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_imei_change.php" style="text-decoration:none">
          <h3>IMEI Change</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_software_request.php" style="text-decoration:none">
          <h3>Software Request</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_vehicle_no_change.php" style="text-decoration:none">
          <h3> Vehicle No. Change </h3>
          </a> </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><div id="left-column"> <a href="list_sim_change.php" style="text-decoration:none">
          <h3> SIM Change</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_device_lost.php" style="text-decoration:none">
          <h3> Device Lost</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_discounting.php" style="text-decoration:none">
          <h3> Discounting</h3>
          </a> </div></td>
      <td><div id="left-column"> <a href="list_deletion_from_debtors.php" style="text-decoration:none">
          <h3> Deletion from Debtors </h3>
          </a> </div></td>
      <td width="300px">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div id="left-column"> <a href="list_transfer_the_vehicle.php" style="text-decoration:none">
          <h3> Transfer the vehicle</h3>
          </a> </div></td>
    </tr>
  </table>
</div>
<?php
include("../include/footer.php"); ?>
