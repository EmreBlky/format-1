<?php
include("../connection.php");

$headers = apache_request_headers();

foreach ($headers as $header => $value) {
        if($header=="INTERNALGTRAC")
        {
                $httpHeader=$value;
        }
 }
if($httpHeader!="APIapiGTRACgtrac")
{
        die();
}



if(isset($_POST))
{
    $date = date("Y-m-d H:i:s");
    $assign_to = $_POST["assign_to"];;
    $text_msg = $_POST['comment'];
	$request_persion = $_POST['request_persion'];
	
	$task = array('assign_to' => $assign_to, 'comment' => $text_msg, 'date_time' => $date, 'request_persion' => $request_persion);
		
	$execute = insert_query('internalsoftware.tbl_new_task', $task);
	
	if($execute)
	{
		$result["status"] = true;
		$result["message"] = "Data successfully Insert.";
	}
	else
	{
		$result["status"] = false;	
		$result["message"] = "Data Not Insert.";	
	}
                
               
    echo json_encode($result);
	
}
?>
 