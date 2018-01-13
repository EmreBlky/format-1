<?php
include("include/header.inc.php");
ob_start();
include("config.php");
if(isset($_POST['search']))
{

$name=$_POST['name'];
$dateStart=$_POST['dateStart'];
$dateEnd=$_POST['dateEnd'];
$rs = mysql_query("SELECT * FROM repai_device WHERE name='".$name."' AND date BETWEEN '".$dateStart."' AND '".$dateEnd."'");
//echo "SELECT * FROM repai_device WHERE name='".$name."' AND date BETWEEN '".$dateStart."' AND '".$dateEnd."'"; 
}
?>
<script type="text/javascript">
		$(document).ready(function(){
			

			$("#myTable").tablesorter().tablesorterPager({container: $("#pagination")});
		});
	</script>
 
     <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
<script src="../js/validation_new.js"></script>
    <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />
  
   <!-- main calendar program -->
  <script type="text/javascript" src="js/calendar/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="js/calendar/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="js/calendar/calendar-setup.js"></script>


    <!-- BEGIN - Main Content -->
	
	
	<script type="text/javascript">
	function req_info()
	{
	var name=document.getElementById(name)
  if(document.form4.name.value==0)
  {
  alert("please choose one name") ;
  document.form4.name.focus();
  return false;
  }
  if(document.form4.dateStart.value==0)
  {
  alert("please enter start date") ;
  document.form4.dateStart.focus();
  return false;
  }
  if(document.form4.dateEnd.value==0)
  {
  alert("please enter end date") ;
  document.form4.dateEnd.focus();
  return false;
  }
	}
	</script>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="form4" method="post" action="" onSubmit="return req_info();">
<table   border="0" cellpadding="0" cellspacing="0" >
<tr>
<td   height="29">Client Name*:</td>
<td  >
<?php
include("config.php");
$query="SELECT user_id,name FROM users";
$result=mysql_query($query);

?> 

 
<select name="name">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['name']?>><?=$row['name']?></option>
<? } ?>
</select></td>
<td  style="padding-bottom:5px;">
<em><?=$dateHeaderlanguage['from']?> &nbsp;&nbsp;</em>
From Date*:
<input name="dateStart" type="text" value="" id="dateStart" readonly="true" style="width:110px;" /></td>
<td   style="padding-bottom:5px; text-align:left;">
<em><?=$dateHeaderlanguage['to']?>&nbsp;&nbsp; </em>&nbsp;To Date*:
<input name="dateEnd" type="text" value="" id="dateEnd" readonly="true" style="width:110px;" /></td>
<td  ><input type="submit" name="search" value="search" /></td>
</tr>
</table>
<br /><br /><br /><br />
<table width="703" border="1" cellpadding="0" cellspacing="0" id="myTable" class="tablesorter">
<thead>
<tr align="center">
<th width="20%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
<th width="20%" align="center"><font color="#0E2C3C"><b>Vehicle No </b></font></th>
<td width="20%" align="center"><font color="#0E2C3C"><b>Repair </b></font></td>

</tr></thead><tbody>
<?php  
    while ($row = @mysql_fetch_array($rs)) {
	
    ?>  
	<tr align="Center">
	

		<td width="9%" align="center">&nbsp;<?php echo $row['name']?></td>
		<td width="6%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		<td width="6%" align="center">&nbsp;<? if($row['group2']=='int_repaired') { ?> Repair<? }  else {?>Not Repair<? }?></td>
		
		
		
	</tr>
    
		<?php  
    }
	 
    ?> </tbody>
</table>
</form>
<div id="pagination" class="pager">
			<form>
				<img src="images/sorting/first.png" class="first"/>
				<img src="images/sorting/prev.png" class="prev"/>
				<input type="text" class="pagedisplay" name="page"/>
				<img src="images/sorting/next.png" class="next"/>
				<img src="images/sorting/last.png" class="last"/>
				<select class="pagesize">
					<option selected="selected"  value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
				</select>
			</form>
		</div>
        <br/><br/>
<?
include("include/footer.inc.php");

?>
<script type="text/javascript">
    var maxDays = 31;
    
    function ctl07_cjr_reportRangesetDateRange(rangeName){
        var today = new Date();                    
                                      
        var start_field = document.getElementById("dateStart");
		
        var end_field = document.getElementById("dateEnd");
        
        var start_s = "";   // Used to build the final start string.
        var end_s = "";     // Used to build the final end string.
        
        switch(rangeName){
            case 'today':
                today.setHours(0,0);
                start_s = today.getFullYear();
                start_s += '-';
                start_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                start_s += '-';
                start_s += ((today.getDate()) < 10) ? '0' + today.getDate() : today.getDate();
                
                break;
            case 'yesterday':
                var yesterday_t = today_t - Date.DAY;       // Yesterday at 00:00 in miliseconds.
                var yesterday = new Date(yesterday_t);      // Yesterday as a Date object.
                yesterday.setHours(0,0);
                start_s = yesterday.getFullYear();
                start_s += '-';
                start_s += ((yesterday.getMonth() + 1) < 10) ? '0' + (yesterday.getMonth() + 1) : (yesterday.getMonth() + 1);
                start_s += '-';
                start_s += ((yesterday.getDate() + 1) < 10) ? '0' + yesterday.getDate() : '0' +yesterday.getDate();
				 
                break;
            case 'last week':
                var tmpDate = new Date();
                var last_week_t = new Date();       // Last Week at 00:00 in miliseconds.
                last_week_t.setDate(tmpDate.getDate()-6);      // Last Week as a Date object.
                
                
                // build the from string.
                start_s = last_week_t.getFullYear();
                start_s += '-';
                start_s += ((last_week_t.getMonth() + 1) < 10) ? '0' + (last_week_t.getMonth() + 1) : (last_week_t.getMonth() + 1);
                start_s += '-';
                start_s += ((last_week_t.getDate() + 1) < 10) ? '0' + last_week_t.getDate() : last_week_t.getDate();
                start_s += ' 00:00';
                
                // build the to string.
                end_s = today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                end_s += '-';
                end_s += ((today.getDate() + 1) < 10) ? '0' + today.getDate() : today.getDate();
                
                break;
            case 'this month':
                // build the from string.
                start_s = today.getFullYear();
                start_s += '-';
                start_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                start_s += '-';
                start_s += '01';
                
                
                // build the to string.
                end_s = today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() + 1) < 10) ? '0' + (today.getMonth() + 1) : (today.getMonth() + 1);
                end_s += '-';
                end_s += ((today.getDate() + 1) < 10) ? '0' + today.getDate() : today.getDate();
               
                break;
            case 'last month':
                var year = (today.getMonth() == 0) ? today.getFullYear() - 1 : today.getFullYear();
                var month = ((today.getMonth() == 0) ? '12' : ((today.getMonth() < 10) ? '0' + today.getMonth() : today.getMonth()));
                var day = '01';
                            
                // build the from string.
                start_s = year;
                start_s += '-';
                start_s += month;
                start_s += '-';
                start_s += day;
                
                
                // build the to string.
                end_s = (today.getMonth() == 0) ? today.getFullYear() - 1 : today.getFullYear();
                end_s += '-';
                end_s += ((today.getMonth() == 0) ? '12' : ((today.getMonth() < 10) ? '0' + today.getMonth() : today.getMonth()));
                end_s += '-';
                end_s += getLastDayOfMonth(today.getMonth() - 1);
                
                break;
        }
        start_field.value = start_s;
        end_field.value = end_s;
    }
    Calendar.setup({
        inputField     :    "dateStart",   // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    Calendar.setup({
        inputField     :    "dateEnd",
        ifFormat       :    "%Y-%m-%d %H:%M",
        showsTime      :    true,
        timeFormat     :    "24",
        firstDay       :    1
    });
    
    function getLastDayOfMonth(month)
    {
        var result = 30;
        
        switch(month){
            case 0:
                //january
                result = '31';
                break;
            case 1:
                //February
                result = '28';
                break;
            case 2:
                //March
                result = '31';
                break;
            case 3:
                //April
                result = '30';
                break;
            case 4:
                //May
                result = '31';
                break;
            case 5:
                //june
                result = '30';
                break;
            case 6:
                //July
                result = '31';
                break;
            case 7:
                //August
                result = '31';
                break;
            case 8:
                //September
                result = '30';
                break;
            case 9:
                //October
                result = '31';
                break;
            case 10:
                //November
                result = '30';
                break;
            case 11:
                //December
                result = '31';
                break;
            }
        return result;
    }
    ctl07_cjr_reportRangesetDateRange();
</script>
