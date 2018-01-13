<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");
include($_SERVER["DOCUMENT_ROOT"]."/service/sqlconnection.php");*/

if($_SESSION['user_name']=="ankur"){
	$branch='dispatch_branch IN (2,3,7)';	
}
else if($_SESSION['user_name']=="rakhi"){
	$branch='dispatch_branch IN (1)';
}
else if($_SESSION['user_name']=="amit"){
	$branch='dispatch_branch IN (6)';
}
else{
	$branch='dispatch_branch IN (1)';
}
 
if(isset($_POST['submit']))
{
	$date_from = $_POST['FromDate']." 00:00:00:000";
	$date_to = $_POST['ToDate']." 23:59:59:999";
				
	$inventory_query = mssql_query("SELECT b.item_name,a.dispatch_date,COUNT(a.device_id) as total FROM device a INNER JOIN item_master b ON b.parent_id = a.device_type WHERE dispatch_date >='".$date_from."' AND dispatch_date <'".$date_to."' AND $branch AND is_repaired=0 GROUP BY a.dispatch_date,b.item_name,a.device_type");
	
	
}
?> 

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();
j(function() 
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });

j( "#ToDate" ).datepicker({ dateFormat: "yy-mm-dd" });

});

</script>

<div class="top-bar">
	 
    <h1>Stock Details</h1>
    
</div>

<div class="top-bar">

<form name="myForm" action=""   method="post">

    <table cellspacing="5" cellpadding="5">
        <tr>
            <td >From Date</td>
            <td><input type="text" name="FromDate" id="FromDate" value="<?php echo $_POST["FromDate"];?>"/></td>
            
            <td>To Date</td>
            <td><input type="text" name="ToDate" id="ToDate"  value="<?php echo $_POST["ToDate"];?>" /></td>
            
            <td align="center"> <input type="submit" name="submit" value="submit"  /></td>
        </tr>
     
    </table>
</form>

</div>

<div class="top-bar">
                          
        <div class="table">

 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>SL No</th>
            <th>Date</th>
            <th>Model</th>
            <th>total</th>
                                    
        </tr>
    </thead>
    <tbody>
 
 
 
<?php 
$i=1;
while($row=mssql_fetch_array($query))
{
?>
    <tr align="center">
        <td><?php echo $i ?></td>
        <td><?php echo $row["dispatch_date"];?></td>
        <td><?php echo $row["item_name"];?></td>
        <td><?php echo $row["total"];?></td>
         
    </tr> <?php $i++; }?>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
<?php
include("../include/footer.php"); ?>


