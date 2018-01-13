<?php
include("../connection.php");

if($_GET["csv"]=="true")
{ 
 
$name = $_GET["name"];
$datefrom = $_GET["datefrom"];
$dateto = $_GET["dateto"];

	 $data=array();
     //$qrycsv="SELECT * FROM branch_repiar_report where request_by='".$name."' order by id ASC"; 
	  $qrycsv = "SELECT * FROM branch_stock_report where request_by='".$name."' and request_date>='".$datefrom."' and request_date<='".$dateto."' order by id ASC ";								
					
			
			$query = select_query($qrycsv);
			
			//while($row=mysql_fetch_array($query)) 
			for($i=0;$i<count($query);$i++)
				{ 
				
				$arr=array (
					'request_date' => $query[$i]['request_date'],
					'description' => $query[$i]['description'],
					'courier_in' => $query[$i]['courier_in'],
					'installed_out' => $query[$i]['installed_out'],
					'ffc' => $query[$i]['ffc'],
					'current_stock' => $query[$i]['current_stock']);
				array_push($data,$arr);
				}



$reportHtmlHEADING='<TABLE cellspacing="2" cellpadding="2"   width="100%" border="0"> <tr ><td colspan="6" align="center"
  style="border:solid 1px #2A0A0A; border-right-color:#2A0A0A; border-bottom-color:#2A0A0A; text-align: center; color:#ffffff;
font-size: 14px;
margin: 1px 1px 1px 1px; background-color:#2A0A0A; padding: 5px 3px 3px 3px;  vertical-align:top;"><strong>Stock Report </strong></td></tr>
  <tr ><td colspan="6" align="center"><strong> </strong></td></tr>';

  $reportHtml='<TR style="border:solid 1px #5E610B; border-right-color:#5E610B; border-bottom-color:#5E610B; text-align: left; color:#ffffff;
font-size: 10px;
margin: 1px 1px 1px 1px; background-color:#5E610B;  vertical-align:top;"> 
<th>Date</th><th>Description</th><th>Courier In</th><th>Installed Out</th><th>FFC</th><th>Current Stock</th>

 </TR>';

 
foreach($data as $row)
        {

          $reportHtmlTransitcontainer .='<tr><td>'.$row['request_date'].'</td><td>'.$row['description'].'</td><td>'.$row['courier_in'].'</td><td>'.$row['installed_out'].'</td><td>'.$row['ffc'].'</td><td>'.$row['current_stock'].'</td> </tr>';

       }
                        
   $reportHtml1 ='</table>';

     $finalHtml =$reportHtmlHEADING.''.$reportHtml.' '.$reportHtmlTransitcontainer.$reportHtml1;


    $filepointer=fopen(__DOCUMENT_ROOT.'/support/excel/'.$name.'-stock-report-'.date('Y-m-d').'.xls','w');
	fwrite($filepointer,$finalHtml);
	fclose($filepointer);

  

 header("location:"."excel/".$name."-stock-report-".date('Y-m-d').".xls");
 
}
?>