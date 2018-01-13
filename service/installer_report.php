<?

include("include/header.inc.php");

include ("config.php");





if(isset($_POST['submit']))

{

$Installername=$_POST['inst_name'];

$FromDate=$_POST['Fromdate'];

$ToDate=$_POST['Todate'];

$job=$_POST['job'];



 



if($job=='service')

	{

$Result_service = mysql_query("SELECT * FROM `services` where `time`>='".$FromDate."' and `time` <='".$ToDate."' and `inst_name`='".$Installername."'");

	}

	else

	{

$Result_service = mysql_query("SELECT *,client as name FROM `installation`  where `time`>='".$FromDate."' and `time` <='".$ToDate."' and `inst_name`='".$Installername."'");



	} 

} 



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>



<link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />

<link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />

<link rel="stylesheet" type="text/css" media="all" href="js/calendar/calendar-win2k-1.css" title="win2k-1" />

<script type="text/javascript" src="js/calendar/calendar.js"></script>

<script type="text/javascript" src="js/calendar/calendar-en.js"></script>

<script type="text/javascript" src="js/calendar/calendar-setup.js"></script> 

 

</head>



<body>

<form method="post" action="" name="form1" >

<!-- -->



<table width="100%"  >

<tr>

<td  align="right">Installer Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<?php 

$query="SELECT inst_id,inst_name FROM installer";

$result=mysql_query($query);



?> 

<? $name1=$rows['inst_name']; ?> 

<td><select name="inst_name" style="width:147px" ><option value="0">Select Name</option>

<? while($row=mysql_fetch_array($result)) { ?>

<option value=<?=$row['inst_name']?><? if($name1==$row['inst_name']) { ?> selected <? }?>><?=$row['inst_name']?></option>

<? } ?>

</select>

</td>

 





<td   align="right">From Date:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td>

<input type="text" name="Fromdate" id="Fromdate" value="<?if(isset($_POST["Fromdate"])){echo $_POST["Fromdate"];}?>" style="width:147px" autocomplete="off"/> 		

</td>

 

<td  align="right">To Date:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td>

<input type="text" name="Todate" id="Todate" value="<?if(isset($_POST["Todate"])){ echo $_POST["Todate"];}?>" style="width:147px" autocomplete="off"/> 		

</td>



<td  align="right">

 <Input type = 'Radio' Name ='job' value= 'service' >Service</td>

<td><Input type = 'Radio' Name ='job' value= 'installer'  >Installation</td>

<td>

<input type="submit" name="submit" value="submit" align="right" />	

</td>

</tr>

</table>

<br/><br/>

<table width="100%" border="1" cellspacing="5" cellpadding="5">

<tr>

	<td > <font color="red" style="font-weight:bold">Number Of Records : <? if(isset($Result_service))

	{  echo $_POST['inst_name'] ." -- " . $_POST['job'] ." -- " .mysql_num_rows($Result_service);

	}?> </font></td>

</tr>

</table>

<br/><br/>

<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter">



<thead>

<tr align="Center">

<th width="11%" align="center"><font color="#0E2C3C">

<b>Location </b></font></th> <th width="11%" align="center">

<font color="#0E2C3C"><b>Time</b></font></th> <th width="11%" align="center">

<font color="#0E2C3C"><b>Installer Name</b></font></th>

<th width="11%" align="center">

<font color="#0E2C3C"><b>Client Name</b></font></th>
<th width="11%" align="center">

<font color="#0E2C3C"><b>No.of Vehicle</b></font></th>
<th width="11%" align="center">

<font color="#0E2C3C"><b>Vehicle Regno.</b></font></th>



</tr></thead><tbody>





  <?php 

  if(isset($Result_service))

  {

    while ($row = mysql_fetch_array($Result_service)) {

	 

    ?>  

	<tr align="Center">

	 

		<td width="10%" align="center">&nbsp;<?php echo $row['location'];?></td>

		 

		<td width="12%" align="center">&nbsp;<?php echo $row['time'];?></td>

		<td width="12%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>

		<td width="12%" align="center">&nbsp;<?php echo $row['name'];?></td>
		
		
		
		<td width="12%" align="center">&nbsp;<?php echo $row['no_of_vehicals'];?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		

		 

		

	</tr>

		<?php  

    }

  }

	 

    ?>



	<tr><td colspan="9" align="center"></td></tr> </tbody>

</table>



</form>

</body>

</html><!-- <div id="pagination" class="pager">

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

        <br/><br/> -->

<?

include("include/footer.inc.php");



?>



<script type="text/javascript">

    var maxDays = 31;

    

    function ctl07_cjr_reportRangesetDateRange(rangeName){

        var today = new Date();                    

                                      

        var start_field = document.getElementById("Notwoking");

		

        var end_field = document.getElementById("atime");

        

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

        inputField     :    "Fromdate",   // id of the input field

        ifFormat       :    "%Y-%m-%d %H:%M",       // format of the input field

        showsTime      :    true,

        timeFormat     :    "24",

        firstDay       :    1

    });

    Calendar.setup({

        inputField     :    "Todate",

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

