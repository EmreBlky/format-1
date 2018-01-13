<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_report.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_report.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/

$total_device=0;
$year = date("Y");

 if($_POST["submit"] == "Jan")
 {
     $year = $_POST["year"];
     $month = "January Month";
     $from = $year."-01-01 00:00:00";
     $to = $year."-01-31 23:59:59";
       
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }

elseif($_POST["submit"] == "Feb")
 {
     $year = $_POST["year"];
     $month = "February Month";
     $from = $year."-02-01 00:00:00";
     $to = $year."-02-28 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "March")
 {
     $year = $_POST["year"];
     $month = "March Month";
     $from = $year."-03-01 00:00:00";
     $to = $year."-03-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "April")
 {
     $year = $_POST["year"];
     $month = "April Month";
     $from = $year."-04-01 00:00:00";
     $to = $year."-04-30 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from." and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "May")
 {
     $year = $_POST["year"];
     $month = "May Month";
     $from = $year."-05-01 00:00:00";
     $to = $year."-05-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "June")
 {
     $year = $_POST["year"];
     $month = "June Month";
     $from = $year."-06-01 00:00:00";
     $to = $year."-06-30 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "July")
 {
     $year = $_POST["year"];
     $month = "July Month";
     $from = $year."-07-01 00:00:00";
     $to = $year."-07-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "Aug")
 {
     $year = $_POST["year"];
     $month = "August Month";
     $from = $year."-08-01 00:00:00";
     $to = $year."-08-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "Sep")
 {
     $year = $_POST["year"];
     $month = "September Month";
     $from = $year."-09-01 00:00:00";
     $to = $year."-09-30 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "Oct")
 {
     $year = $_POST["year"];
     $month = "October Month";
     $from = $year."-10-01 00:00:00";
     $to = $year."-10-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "Nov")
 {
     $year = $_POST["year"];
     $month = "November Month";
     $from = $year."-11-01 00:00:00";
     $to = $year."-11-30 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }
 
elseif($_POST["submit"] == "Dec")
 {
     $year = $_POST["year"];
     $month = "December Month";
     $from = $year."-12-01 00:00:00";
     $to = $year."-12-31 23:59:59";
   
    $query = mssql_query( "select device_type,item_name,count(*) as 'Count' from device left join item_master on item_master.item_id=device.device_type  where recd_date >='".$from."' and recd_date <='".$to."' group by device_type,item_name");
 }

elseif($_POST["submit"] == "Installer Report")
 {

    /*$inventory_query_status = mssql_query("select device_type,dispatch_branch,item_name,device_status.status as status,count(device.device_status) as Number,device.device_status,
    ChallanDetail.InstallerID from device left join item_master on item_master.item_id=device.device_type left join device_status on device_status.status_sno=device.device_status
    left join ChallanDetail on ChallanDetail.deviceid=device.device_id where device_status in (63,64,96) and recd_date >='2015-01-01 00:00:00' and recd_date <='".date("Y-m-d H:i:s")."' and currentrecord=1 group by device_type,item_name,device_status.status,dispatch_branch,ChallanDetail.InstallerID,device.device_status ");*/
   
    $inventory_query_status = mssql_query("select dispatch_branch,device_status.status as status,count(device_status.status) as Number,device.device_status ,
    ChallanDetail.InstallerID from device left join item_master on item_master.item_id=device.device_type left join device_status on device_status.status_sno=device.device_status
    left join ChallanDetail on ChallanDetail.deviceid=device.device_id where device_status in (63,64,96) and recd_date >='2015-01-01 00:00:00' and
    recd_date <='".date("Y-m-d H:i:s")."' and currentrecord=1 group by device_status.status,dispatch_branch,ChallanDetail.InstallerID,device.device_status");
   
    while($row_inventory_status = mssql_fetch_array($inventory_query_status))
    {
        $total_device=$total_device+$row_inventory_status['Number'];
        $inventory_row_data[] = $row_inventory_status;
    }
   
 }

?>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();

</script>
 

<div class="top-bar">
   
    <h1><?=$month." "?>Device Details</h1>
     
</div>

<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">

    <tr>
        <td><select name="year" id="year_is">
                <option value="">Select Year</option>
                <option value="2012" <? if($year=='2012') {?> selected="selected" <? } ?>>2012</option>
                <option value="2013" <? if($year=='2013') {?> selected="selected" <? } ?>>2013</option>
                <option value="2014" <? if($year=='2014') {?> selected="selected" <? } ?>>2014</option>
                <option value="2015" <? if($year=='2015') {?> selected="selected" <? } ?>>2015</option>
                <option value="2016" <? if($year=='2016') {?> selected="selected" <? } ?>>2016</option>
                <option value="2017" <? if($year=='2017') {?> selected="selected" <? } ?>>2017</option>
                <option value="2018" <? if($year=='2018') {?> selected="selected" <? } ?>>2018</option>
                <option value="2019" <? if($year=='2019') {?> selected="selected" <? } ?>>2019</option>
                <option value="2020" <? if($year=='2020') {?> selected="selected" <? } ?>>2020</option>
            </select>
        </td>
        <td><input type="submit" name="submit" value="Jan"  /></td>
        <td><input type="submit" name="submit" value="Feb"  /></td>
        <td><input type="submit" name="submit" value="March"  /></td>
        <td><input type="submit" name="submit" value="April"  /></td>
        <td><input type="submit" name="submit" value="May"  /></td>
        <td><input type="submit" name="submit" value="June"  /></td>
        <td><input type="submit" name="submit" value="July"  /></td>
        <td><input type="submit" name="submit" value="Aug"  /></td>
        <td><input type="submit" name="submit" value="Sep"  /></td>
        <td><input type="submit" name="submit" value="Oct"  /></td>
        <td><input type="submit" name="submit" value="Nov"  /></td>
        <td><input type="submit" name="submit" value="Dec"  /></td>

    </tr>
    <tr>
        <td colspan="7" align="center"><input type="submit" name="submit" value="Installer Report"  /></td>
         <td colspan="3" align="right">Total Device Installed - </td>
        <td colspan="3" align="left"><?=$total_device;?></td>
    </tr>
 
</table>
</form>
</div>
<div class="table">
  
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
    <?php if($_POST["submit"] == "Installer Report"){?>
          <tr>
            <th>Branch </th>
            <th>Installer</th> 
            <th>Total No of Devices</th>
            <th>Imei No</th>
        </tr>
       <?php } else{ ?>
       <tr>
            <th>Device Modal </th>
            <th>Total No</th> 
            <th>Device Details</th>
        </tr>
       <?php } ?>
    </thead>
    <tbody>
  
    <?php
if($_POST["submit"] == "Installer Report")
{
    for($i=0;$i<count($inventory_row_data);$i++)
    {
       
        $branch_id = $inventory_row_data[$i]['dispatch_branch'];
        $Number = $inventory_row_data[$i]['Number'];
        $inst_id = $inventory_row_data[$i]['InstallerID'];
               
        if($branch_id==1){$branch = "Delhi";}
        elseif($branch_id==2){$branch = "Mumbai";}
        elseif($branch_id==3){$branch = "Jaipur";}
        elseif($branch_id==4){$branch = "Sonipath";}
        elseif($branch_id==5){$branch = "Kanpur";}
        elseif($branch_id==6){$branch = "Ahmedabad";}
        elseif($branch_id==7){$branch = "kolkata";}
       
        if($inst_id != "")
        {           
            $installer_query = mysql_fetch_array(mysql_query("SELECT inst_name FROM installer WHERE inst_id='".$inst_id."'"));
            $inst_name = $installer_query['inst_name'];
           
            $imei_sub_query = mssql_query("select device_imei,ChallanDetail.InstallerID,item_name  from device left join ChallanDetail on ChallanDetail.deviceid=device.device_id left join item_master on item_master.item_id=device.device_type where device.dispatch_branch='".$branch_id."' and recd_date >='2015-01-01 00:00:00' and recd_date <='".date("Y-m-d H:i:s")."' and device.device_status='".$inventory_row_data[$i]['device_status']."' and ChallanDetail.InstallerID='".$inst_id."' and currentrecord=1");
           
        }
        else
        {
            $imei_sub_query = mssql_query("select device_imei,ChallanDetail.InstallerID,item_name  from device left join ChallanDetail on ChallanDetail.deviceid=device.device_id left join item_master on item_master.item_id=device.device_type where device.dispatch_branch='".$branch_id."' and recd_date >='2015-01-01 00:00:00' and recd_date <='".date("Y-m-d H:i:s")."' and device.device_status='".$inventory_row_data[$i]['device_status']."' and ChallanDetail.InstallerID is null and currentrecord=1");
        }
       
        $imei_details ="";
        while($inventory_row=mssql_fetch_array($imei_sub_query))
            {
                $imei_details.= $inventory_row['device_imei']."(".$inventory_row['item_name']."),";
            }
           
            $imei_rslt=substr($imei_details,0,strlen($imei_details)-1);
    ?> 

    <tr align="Center" >
   
        <td><?php echo $branch;?></td>
        <td><?php echo $inst_name;?></td>
        <td><?php echo $Number;?></td>
        <td><?php echo $imei_rslt;?></td>
    
    </tr>
<?php
    }

}
else
{
     
   while($row=mssql_fetch_array($query))
    {
        $client_query = mssql_query("select item_name,count(*) as total,dispatch_branch from device left join item_master on item_master.item_id=device.device_type
              where item_name='".$row['item_name']."' and recd_date >='".$from."' and recd_date <='".$to."' group by item_name,dispatch_branch");
       
        $client_name ="";
        while($client_row=mssql_fetch_array($client_query))
            {
                $branch_id = $client_row['dispatch_branch'];
                if($branch_id==1){$branch = "Delhi";}
                elseif($branch_id==2){$branch = "Mumbai";}
                elseif($branch_id==3){$branch = "Jaipur";}
                elseif($branch_id==4){$branch = "Sonipath";}
                elseif($branch_id==5){$branch = "Kanpur";}
                elseif($branch_id==6){$branch = "Ahmedabad";}
                elseif($branch_id==7){$branch = "kolkata";}
                else{$branch = "Delhi Stock";}
                $client_name.= $branch."(".$client_row['total']."),";
            }
           
            $client_rslt=substr($client_name,0,strlen($client_name)-1);
       
    ?> 

    <tr align="Center" >
   
        <td>&nbsp;<?php echo $row['item_name'];?></td>
         <td>&nbsp;<?php echo $row['Count'];?></td>     
        <td>&nbsp;
        <a onclick="window.open(this.href); return false;" href="device_popup.php?device=<?=$row["device_type"]?>&from=<?=date("Y-m-d",strtotime($from))?>&to=<?=date("Y-m-d",strtotime($to))?>" ><?php echo $client_rslt;?></a>
         </td>
    
    </tr>
        <?php 
    //$i++;
    }
}
    ?>
</table>
    
   <div id="toPopup">
       
        <div class="close">close</div>
           <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup1" style ="height:100%;width:100%"> <!--your content start-->
           

 
        </div> <!--your content end-->
   
    </div> <!--toPopup end-->
   
    <div class="loader"></div>
       <div id="backgroundPopup"></div>
</div>
 
 
 
<?
include("../include/footer.php")

?>