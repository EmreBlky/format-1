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
<div class="top-bar"> <a href="km_alerts.php" class="button">ADD NEW </a>
  <h1>KM Alerts</h1>
</div>
<div class="table">
  <?php
 
//$num=mysql_num_rows(mysql_query("SELECT * FROM new_account_creation order by id DESC"));
 
$query = select_query("SELECT * FROM transfer_the_vehicle where acc_manager='".$_SESSION['user_name']."' order by id DESC");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Company</th>
        <th>Main User Id</th>
        <th>Total No Of Vehicles</th>
        <th>Potential</th>
        <th>Contact Person</th>
        <th>Contact Number</th>
        <th>Type Of alerts</th>
        <th>Via Sms/Mail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!=""){ echo 'style="background-color:Blue"';} ?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <td><?php echo $query[$i]["company"];?></td>
        <td><?php echo $query[$i]["main_user_id"];?></td>
        <td><?php echo $query[$i]["total_no_of_vehicles"];?></td>
        <td><?php echo $query[$i]["potential"];?></td>
        <td><?php echo $query[$i]["contact_person"];?></td>
        <td><?php echo $query[$i]["contact_number"];?></td>
        <td><?php echo $query[$i]["types_of_alert"];?></td>
        <td><?php echo $query[$i]["via_sms_mail"];?></td>
      </tr>
      <?php  }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup_content"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>
<?php
include('lock.php');
//error_reporting(0);
include ('connection.php');
  
 // $sql="select * from km_alerts";
 // $search=mysql_query($sql);

  ?>
