<?php
include("../connection.php");

if($_GET["csv"]=="true")
{ 

$name = $_GET["name"];
$datefrom = $_GET["datefrom"];
$dateto = $_GET["dateto"];

	 $data=array();
     //$qrycsv="SELECT * FROM branch_repiar_report where request_by='".$name."' order by id ASC"; 
	  $qrycsv = "SELECT * FROM branch_repiar_report where request_by='".$name."' and request_date>='".$datefrom."' and request_date<='".$dateto."' order by id ASC ";								
					
			
			$query = select_query($qrycsv);
			
			//while($row=mysql_fetch_array($query)) 
			for($i=0;$i<count($query);$i++)
				{ 
				
				$arr=array (
					'request_date' => $query[$i]['request_date'],
					'device_remove' => $query[$i]['device_remove'],
					'repaired_device' => $query[$i]['repaired_device'],
					'send_to_delhi' => $query[$i]['send_to_delhi'],
					'not_working' => $query[$i]['not_working'],
					'reason' => $query[$i]['reason']);
				array_push($data,$arr);
				}
		



$reportHtmlHEADING='<TABLE cellspacing="2" cellpadding="2"   width="100%" border="0"> <tr ><td colspan="6" align="center"
  style="border:solid 1px #2A0A0A; border-right-color:#2A0A0A; border-bottom-color:#2A0A0A; text-align: center; color:#ffffff;
font-size: 14px;
margin: 1px 1px 1px 1px; background-color:#2A0A0A; padding: 5px 3px 3px 3px;  vertical-align:top;"><strong>Repair Report </strong></td></tr>
  <tr ><td colspan="6" align="center"><strong> </strong></td></tr>';

  $reportHtml='<TR style="border:solid 1px #5E610B; border-right-color:#5E610B; border-bottom-color:#5E610B; text-align: left; color:#ffffff;
font-size: 10px;
margin: 1px 1px 1px 1px; background-color:#5E610B;  vertical-align:top;"> 
<th>Date</th><th>Devices Removed</th><th>Repaired Devices installed Back</th><th>Sent to Delhi for repair</th><th>Not working stock</th><th>Reason</th>

 </TR>';

 
foreach($data as $row)
        {

          $reportHtmlTransitcontainer .='<tr><td>'.$row['request_date'].'</td><td>'.$row['device_remove'].'</td><td>'.$row['repaired_device'].'</td><td>'.$row['send_to_delhi'].'</td><td>'.$row['not_working'].'</td><td>'.$row['reason'].'</td> </tr>';

       }
                        
   $reportHtml1 ='</table>';

     $finalHtml =$reportHtmlHEADING.''.$reportHtml.' '.$reportHtmlTransitcontainer.$reportHtml1;


    $filepointer=fopen(__DOCUMENT_ROOT.'/support/excel/'.$name.'-repair-report-'.date('Y-m-d').'.xls','w');
fwrite($filepointer,$finalHtml);
fclose($filepointer);

  

 header("location:"."excel/".$name."-repair-report-".date('Y-m-d').".xls");

}
?>