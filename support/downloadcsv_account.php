<?php
 include("../connection.php");

if($_GET["csv"]=="true")
{ 
 //$userId=$_GET["id"];
$name = $_GET["name"];
$branch = $_GET["branch"];
$datefrom = $_GET["datefrom"];
$dateto = $_GET["dateto"];

	 $MergevehicleArray=array();
     //$qrycsv="SELECT * FROM branch_repiar_report where request_by='".$name."' order by id ASC"; 
	  $qrycsv = "SELECT * FROM branch_account_report where $branch and request_date>='".$datefrom."' and request_date<='".$dateto."' order by id ASC ";								
					
			
			$query = select_query($qrycsv);
			
			//while($row=mysql_fetch_array($query)) 
			for($i=0;$i<count($query);$i++)
				{ 
				
				$vehicleArray=array (
					'request_date' => $query[$i]['request_date'],
					'clients' => $query[$i]['clients'],
					'expected_ammount' => $query[$i]['expected_ammount'],
					'received_ammount' => $query[$i]['received_ammount'],
					'day_total' => $query[$i]['day_total']);
				array_push($MergevehicleArray,$vehicleArray);
				}
		

 
 error_reporting(E_ALL); 
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

//if (PHP_SAPI == 'cli')
	//die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'C:/xampp/htdocs/user/PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
//$ShowDat=date('d-M-Y',$date);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '') 	
			->setCellValue('B1', 'Account Payment') 	
			->setCellValue('C1', '') 	;
			
			
			/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Repair');*/
			
					     			
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Date')
            ->setCellValue('B2', 'Client Name')
			->setCellValue('C2', 'Expected Ammount')
			->setCellValue('D2', 'Received Ammount')
			->setCellValue('E2', 'Day Total');
 
 $i=3;            
 foreach($MergevehicleArray as $row)
	{

/*if($row['request_date']!="")
		{*/
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $row['request_date'])
			->setCellValue('B'.$i, $row['clients'])
			->setCellValue('C'.$i, $row['expected_ammount'])
			->setCellValue('D'.$i, $row['received_ammount'])
			->setCellValue('E'.$i, $row['day_total']) ;
			  
			$i++;
	//}
	}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Account Payment');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
/*header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');*/

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(__DOCUMENT_ROOT.'/support/excel/'.$name.'-account-report-'.date('Y-m-d').'.xls');

  

 header("location:"."excel/".$name."-account-report-".date('Y-m-d').".xls");
}
?>