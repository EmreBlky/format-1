<?php 
include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_report.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");


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
	 $from = $year."-04-01 00:00:00'";
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
 
</table>
</form>
</div>
<div class="table">
   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
      	<tr>
            <th>Device Modal </th>
            <th>Total No</th>  
            <th>Device Details</th>
		</tr>
	</thead>
	<tbody>
   
	<?php 
	//$i=1;
	 
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
				
				$client_name.= $branch."(".$client_row['total']."),";
			}
			
			$client_rslt=substr($client_name,0,strlen($client_name)-1); 
		
    ?>  

	<tr align="Center" >
    
        <td>&nbsp;<?php echo $row['item_name'];?></td>
 		<td>&nbsp;<?php echo $row['Count'];?></td>	 
        <td>&nbsp;<a href="device-iframe.php?device=<?=$row["item_name"]?>&from=<?=date("Y-m-d",strtotime($from))?>&to=<?=date("Y-m-d",strtotime($to))?>&req_id=1&height=220&width=330" class="thickbox"  >
			<?php echo $client_rslt;?></a></td>
     
	</tr>
		<?php  
    //$i++;
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
include("include/footer.php");

?>

 