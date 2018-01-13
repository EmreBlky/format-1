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
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value=4 <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="3" <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Back Installation</option>
        <option value="5" <?if($_POST['Showrequest']==5){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <a href="new_installation.php" class="button">ADD NEW </a>
  <h1>New Installation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from Installation</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
$sales = select_query("select id from sales_person where name='".$_SESSION['user_name']."' ");


$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }
   
  if($mode=='close')
    {
     
        $query = select_query("SELECT * FROM installation where (installation_status='5') and sales_person='".$sales[0]['id']."' order by id desc");
       
    }
    else if($mode=='new')
    {         
         if($_POST["Showrequest"]==1)
         {
              $WhereQuery=" where (installation_status=5) and sales_person='".$sales[0]['id']."'";
         }
         else if($_POST["Showrequest"]==2)
         {
             $WhereQuery=" where sales_person='".$sales[0]['id']."'";
         }
         else if($_POST["Showrequest"]==3)
         {
             $WhereQuery=" where (installation_status=3 or installation_status=6) and sales_person='".$sales[0]['id']."'";
         }
         else if($_POST["Showrequest"]==4)
         {
             $WhereQuery=" where approve_status=1 and installation_status=1 and sales_person='".$sales[0]['id']."'";
         }
         else if($_POST["Showrequest"]==5)
         {
             $WhereQuery=" where sales_comment!='' and sales_person='".$sales[0]['id']."'";
         }
          else
         {
             
             $WhereQuery=" where ((installation_status=1 or installation_status=2 or installation_status=7 or installation_status=8 or installation_status=9) or (admin_comment!='' and sales_comment is null)) and sales_person='".$sales[0]['id']."'";
         
         }
         
        $query = select_query("SELECT * FROM installation_request ". $WhereQuery."  order by id DESC ");
   
    }
?>
  <div style="float:right"><a href="list_new_installation.php?mode=new">New</a> | <a href="list_new_installation.php?mode=close">Closed</a></div>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Company</th>
        <th>No of Installation</th>
        <th>Device Model</th>
        <th>Vehicle Type</th>
        <th>Payment Status</th>
        <th>Installation Done Today</th>
        <!--  <th>Billing Name</th>
            <th>Billing Address</th>
            <th>price</th>
            <th>vat</th>
            <th>total</th>
            <th>rent</th>
            <th>service tax</th>
            <th>mode of payment</th> --> 
        <!-- <th>Vehicle type</th> --> 
        <!--  <th>Immobilizer (Y/N)</th>
            <th>AC (ON/OFF)</th>
            <th>E_mail ID</th> 
            <th>User Name</th>
            <th>Password</th>-->
        <th>View Detail</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
	 // echo "<pre>";print_r($query);die;
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["installation_status"]==3){ echo 'style="background-color:#68C5CA"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["installation_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#F2F5A9"';} elseif($query[$i]["installation_status"]==5){ echo 'style="background-color:#99FF66"';}?> >
      
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["req_date"];?></td>
        <td><?php echo $query[$i]["company_name"];?></td>
        <td><?php echo $query[$i]["no_of_vehicals"];?></td>
        <td><?php echo $query[$i]["model"];?></td>
        <td><?php echo $query[$i]["veh_type"];?>
        <td><?php echo $query[$i]["payment_req"];?></td>
        <td><?php echo $query[$i]["installation_made"];?></td>
        <!--  <td><?php echo $query[$i]["billing_name"];?></td>
    <td><?php echo $query[$i]["billing_address"];?></td>
    <td><?php echo $query[$i]["device_rent_price"];?></td>
    <td><?php echo $query[$i]["device_rent_vat"];?></td>
    <td><?php echo $query[$i]["device_rent_total"];?></td>
    <td><?php echo $query[$i]["device_rent_rent"];?></td>
    <td><?php echo $query[$i]["device_rent_service_tax"];?></td>
    <td><?php echo $query[$i]["mode_of_payment"];?></td> --> 
        <!-- <td><?php echo $query[$i]["vehicle_type"];?></td> --> 
        <!-- <td><?php echo $query[$i]["immobilizer"];?></td>
    <td><?php echo $query[$i]["ac_on_off"];?></td>
    <td><?php echo $query[$i]["email_id"];?></td>
    <td><?php echo $query[$i]["user_name"];?></td>
    <td><?php echo $query[$i]["user_password"];?></td> -->
        <td align="center"><? if($mode=='close') {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a>
          <? } else {?>
          <a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation_request','popup1'); " class="topopup">View Detail</a>
          <? } ?></td>
        <td><?php if($query[$i]["approve_status"]!=1){?>
          <a href="new_installation.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a> 
          <!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>-->
          
          <?php } ?></td>
      </tr>
      <?php }?>
  </table>
  <div id="toPopup" >
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1" > <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>