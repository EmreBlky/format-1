<?php
include("../connection.php");

if($_GET["csv"]=="true")
{ 
	 //$userId=$_GET["id"];
	$name = $_GET["name"];
	$branch = $_GET["branch"];
	$datefrom = $_GET["datefrom"];
	$dateto = $_GET["dateto"];
	
	$data=array();
	
	 $qrycsv = "SELECT * FROM branch_account_report where $branch and request_date>='".$datefrom."' and request_date<='".$dateto."' order by id ASC ";	
	 $query = select_query($qrycsv);              
	
	//while($row=mysql_fetch_array($query)) 
	for($i=0;$i<count($query);$i++)
	{ 
	
		$request_date =$query[$i]['request_date'];
		$clients =$query[$i]['clients'];
		$expected_ammount=$query[$i]['expected_ammount'];
		$received_ammount=$query[$i]['received_ammount'];
		$day_total =$query[$i]['day_total'];
		

		 $arr=array (
		'request_date' => $request_date ,
		'clients'=> $clients ,
		'expected_ammount' => $expected_ammount,
		'received_ammount' => $received_ammount,
		'day_total' => $day_total ) ;
		array_push($data,$arr);
	}
// echo "<pre>";
//print_r($data);
 //echo "</pre>";

 /*$ReportDtfor="JANUARY 2014";
 $todaydate=date("01-10-2014");*/
  $reportHtmlHEADING='<TABLE cellspacing="2" cellpadding="2"   width="100%" border="0"> <tr ><td colspan="5" align="center"
  style="border:solid 1px #2A0A0A; border-right-color:#2A0A0A; border-bottom-color:#2A0A0A; text-align: center; color:#ffffff;
font-size: 14px;
margin: 1px 1px 1px 1px; background-color:#2A0A0A; padding: 5px 3px 3px 3px;  vertical-align:top;"><strong>Payment Report </strong></td></tr>
  <tr ><td colspan="5" align="center"><strong> </strong></td></tr>';

  $reportHtml='<TR style="border:solid 1px #5E610B; border-right-color:#5E610B; border-bottom-color:#5E610B; text-align: left; color:#ffffff;
font-size: 10px;
margin: 1px 1px 1px 1px; background-color:#5E610B;  vertical-align:top;"> 
<th>Date</th><th>Client Name</th><th>Expected Ammount</th><th>Received Ammount</th><th>Day Total</th>

 </TR>';

 
foreach($data as $row)
        {

          $reportHtmlTransitcontainer .='<tr><td>'.$row['request_date'].'</td><td>'.$row['clients'].'</td><td>'.$row['expected_ammount'].'</td><td>'.$row['received_ammount'].'</td><td>'.$row['day_total'].'</td> </tr>';

       }
                        
   $reportHtml1 ='</table>';

     $finalHtml =$reportHtmlHEADING.''.$reportHtml.' '.$reportHtmlTransitcontainer.$reportHtml1;


    $filepointer=fopen(__DOCUMENT_ROOT.'/support/excel/'.$name.'-account-report-'.date('Y-m-d').'.xls','w');
fwrite($filepointer,$finalHtml);
fclose($filepointer);

  

 header("location:"."excel/".$name."-account-report-".date('Y-m-d').".xls");
}

 ?>