<?php 
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');


$year = date("Y");


 if($_POST["submit"] == "submit")
 {
	$from = $_POST["FromDate"];
	$to = $_POST["ToDate"];
	$type = $_POST["job"];
	
	if($from <= "2015-02-05" && $to <= "2015-02-05")
	{
	
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
	
	}
	else
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND inst_close_date>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='". $from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='". $from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}

	}
 }
 
 elseif($_POST["submit"] == "Today")
 {
	$from = date("Y-m-d");
	$to = date("Y-m-d");
	$type = $_POST["job"];
	
	if($from <= "2015-02-05" && $to <= "2015-02-05")
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
	}
	else
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND inst_close_date>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}

	}
  
 }
 
  elseif($_POST["submit"] == "Yesterday")
 {
	$from = date("Y-m-d", strtotime( '-1 days' ));
	$to = date("Y-m-d", strtotime( '-1 days' ));
	$type = $_POST["job"];
	
	if($from <= "2015-02-05" && $to <= "2015-02-05")
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
	}
	else
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND inst_close_date>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}

	}
 }

 elseif($_POST["submit"] == "Last 7 Days")
 {
	$from =  date("Y-m-d", strtotime( '-6 days' ));
	$to = date("Y-m-d");
	$type = $_POST["job"];

	if($from <= "2015-02-05")
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		} 
	}
	
	else
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND inst_close_date>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."'");
	
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		} 
	}
	
 }
 
 elseif($_POST["submit"] == "Last 1 Month")
 {
	$from = date("Y-m-d", strtotime( '-30 days' ));
	$to = date("Y-m-d");
	$type = $_POST["job"];

	if($from <= "2015-02-05")
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
	}
	
	else
	{
		$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND inst_close_date>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `inst_close_date`>='".$from." 00:00:00"."' AND `inst_close_date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
	}
	
 }
  
elseif($_POST["submit"] == "Jan")
 {
	 $year = $_POST["year"];
	 $month = "January Month";
	 $from = $year."-01-01";
	 $to = $year."-01-31";
	 $type = $_POST["job"];
		
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }

elseif($_POST["submit"] == "Feb")
 {
	 $year = $_POST["year"];
	 $month = "February Month";
	 $from = $year."-02-01";
	 $to = $year."-02-28";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "March")
 {
	 $year = $_POST["year"];
	 $month = "March Month";
	 $from = $year."-03-01";
	 $to = $year."-03-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "April")
 {
	 $year = $_POST["year"];
	 $month = "April Month";
	 $from = $year."-04-01";
	 $to = $year."-04-30";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "May")
 {
	 $year = $_POST["year"];
	 $month = "May Month";
	 $from = $year."-05-01";
	 $to = $year."-05-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "June")
 {
	 $year = $_POST["year"];
	 $month = "June Month";
	 $from = $year."-06-01";
	 $to = $year."-06-30";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "July")
 {
	 $year = $_POST["year"];
	 $month = "July Month";
	 $from = $year."-07-01";
	 $to = $year."-07-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "Aug")
 {
	 $year = $_POST["year"];
	 $month = "August Month";
	 $from = $year."-08-01";
	 $to = $year."-08-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "Sep")
 {
	 $year = $_POST["year"];
	 $month = "September Month";
	 $from = $year."-09-01";
	 $to = $year."-09-30";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "Oct")
 {
	 $year = $_POST["year"];
	 $month = "October Month";
	 $from = $year."-10-01";
	 $to = $year."-10-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "Nov")
 {
	 $year = $_POST["year"];
	 $month = "November Month";
	 $from = $year."-11-01";
	 $to = $year."-11-30";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
 }
 
elseif($_POST["submit"] == "Dec")
 {
	 $year = $_POST["year"];
	 $month = "December Month";
	 $from = $year."-12-01";
	 $to = $year."-12-31";
	 $type = $_POST["job"];
	
	$total_query = select_query("SELECT COUNT(device_model) AS total_device FROM new_device_addition WHERE acc_manager='triloki' AND date>='".$from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."'");
		
		if($type == "Device")
		{
			$queryRes = select_query("SELECT device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY device_model");
		}  
		else
		{
			$queryRes = select_query("SELECT `client`,device_model,COUNT(device_model) AS total FROM new_device_addition WHERE acc_manager='triloki' AND `date`>='". $from." 00:00:00"."' AND `date`<='".$to." 23:59:59"."' GROUP BY `client`,device_model");
		}
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
    
    <h1>New Installation Details</h1>
      
</div>

<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">

	<tr>
        <td >From Date</td>
        <td><input type="text" name="FromDate" id="FromDate" value="<?=$from;?>"/></td>
        
        <td>To Date</td>
        <td><input type="text" name="ToDate" id="ToDate"  value="<?=$to;?>" /></td>
        <td>
            <input type="radio" name="job" id="client" value="Client" <? if($_POST["job"]=="Client") echo "checked"?> />Client 
            <input type="radio" name="job" id="device" value="Device" <? if($_POST["job"]=="Device") echo "checked"?>/>Device
        </td>
        <td align="center"> <input type="submit" name="submit" value="submit"  /></td>
	</tr>
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
        <td colspan="12"><input type="submit" name="submit" value="Jan"  />
                    <input type="submit" name="submit" value="Feb"  />
                    <input type="submit" name="submit" value="March"  />
                    <input type="submit" name="submit" value="April"  />
                    <input type="submit" name="submit" value="May"  />
                    <input type="submit" name="submit" value="June"  />
                    <input type="submit" name="submit" value="July"  />
                    <input type="submit" name="submit" value="Aug"  />
                    <input type="submit" name="submit" value="Sep"  />
                    <input type="submit" name="submit" value="Oct"  />
                    <input type="submit" name="submit" value="Nov"  />
                    <input type="submit" name="submit" value="Dec"  />
              </td>

	</tr>
    <tr>
    	<td><input type="submit" name="submit" value="Today"  /></td>
        <td><input type="submit" name="submit" value="Yesterday"  /></td>
        <td><input type="submit" name="submit" value="Last 7 Days"  /></td>
        <td><input type="submit" name="submit" value="Last 1 Month"  /></td>
        <td align="right">Total Device Installed</td>
        <td><?=$total_query[0]['total_device'];?></td>
    </tr>
 
</table>
</form>
</div>
<div class="table">
   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
    <?php if($_POST["job"] == "Device"){?>
		<tr>
            <th>Device Modal </th>
            <th>Total No</th>  
            <th>Company Name </th>
		</tr>
      <?php } else{ ?>
      	<tr>
            <th>Company Name </th>
            <th>Device Modal </th>
            <th>Total No</th>        
		</tr>
      <?php } ?>
	</thead>
	<tbody>
   
	<?php 
	 
   //while($row=mysql_fetch_array($queryRes))
   for($i=0;$i<count($queryRes);$i++)
{
	 
    ?>  

	<tr align="Center" >
        <!--<td><?php echo $i+1; ?></td>-->
        <?php if($_POST["job"] == "Device")
			{
				if($from <= "2015-02-05" && $to <= "2015-02-05")
				{
					 $query = select_query("SELECT `client`,COUNT(`client`) AS client_total FROM new_device_addition WHERE acc_manager='triloki' AND device_model='".$queryRes[$i]['device_model']."' AND `date`>='".$from." 00:00:00' AND `date`<='".$to." 23:59:59' GROUP BY `client`");
				}
				else
				{
					$query = select_query("SELECT `client`,COUNT(`client`) AS client_total FROM new_device_addition WHERE acc_manager='triloki' AND device_model='".$queryRes[$i]['device_model']."' AND `inst_close_date`>='".$from." 00:00:00' AND `inst_close_date`<='".$to." 23:59:59' GROUP BY `client`");
				}
				
			
			$client_name ="";
			//while($client_row=mysql_fetch_array($query))
			for($k=0;$k<count($query);$k++)
			{
				$client_name.= $query[$k]['client']."(".$query[$k]['client_total']."),";
			}
			
			$client_rslt=substr($client_name,0,strlen($client_name)-1); 
				 
		?>
        <td>&nbsp;<?php echo $queryRes[$i]['device_model'];?></td>
 		<td>&nbsp;<?php echo $queryRes[$i]['total'];?></td>	 
        <td>&nbsp;<?php echo $client_rslt;?></td>
        
		<?php }else{?>
        
        <td>&nbsp;<?php echo $queryRes[$i]['client'];?></td>
        <td>&nbsp;<?php echo $queryRes[$i]['device_model'];?></td>
 		<td>&nbsp;<?php echo $queryRes[$i]['total'];?></td>	 

        <?php } ?>
     
	</tr>
		<?php  
    
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
include("../include/footer.php");

?>

 