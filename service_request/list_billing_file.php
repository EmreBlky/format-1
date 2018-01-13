<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

$ftp_server = 'ftp.gpsindelhi.com';
$ftp_user_name = 'itglobal';
$ftp_user_pass = '1TGl0b4lCon5ulT';


$branchid = $_SESSION['BranchId'];

if($branchid == 2)
{
	$branch = 'mu';	
}
else if($branchid == 3)
{
	$branch = 'jp';	
}
else if($branchid == 6)
{
	$branch = 'ab';	
}
else if($branchid == 7)
{
	$branch = 'kk';	
}
else
{
	$branch = ' ';	
}


function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
		$colarr[$col] = array();
		foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	}

	$eval = 'array_multisort(';
	
	foreach ($cols as $col => $order) {
		$eval .= '$colarr[\''.$col.'\'],'.$order.',';
	}

	$eval = substr($eval,0,-1).');';
	eval($eval);
	$ret = array();
	foreach ($colarr as $col => $arr) {
		foreach ($arr as $k => $v) {
			$k = substr($k,1);
			if (!isset($ret[$k])) $ret[$k] = $array[$k];
			$ret[$k][$col] = $array[$k][$col];
		}
	}
	return $ret;

} 

$conn_id = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

//$arr= ftp_nlist($conn_id,"/www.gpsindelhi.com/web/$branch");

$list = ftp_rawlist($conn_id, "/www.gpsindelhi.com/web/".$branch);

$results = array();
foreach ($list as $line) {
    list($perms, $links, $user, $group, $size, $d1, $d2, $d3, $name) =
        preg_split('/\s+/', $line, 9);
    $stamp = strtotime(implode(' ', array($d1, $d2, $d3)));
	$updatetime = date('Y-m-d', $stamp);
    $results[] = array('name' => $name, 'timestamp' => $updatetime);
}


$data2 = array_msort($results, array('timestamp'=>SORT_DESC));


foreach($data2 as $val)
	{
		$data[] = $val;
	}

//echo "<pre>";print_r($data);die;
//var_dump($arr);


?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();
j(function() 
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });


});

</script>

<div class="top-bar">
  <div align="center"> </div>
  <h1>Download Client Bill File</h1>
  <br/>
 
 <?php 
 
 for($i=0;$i<count($data);$i++)
{
   /*echo '<a href="'.$value.'">'.basename($value).'</a>';*/
  
   echo '<a href="ftp://ftp.gpsindelhi.com/www.gpsindelhi.com/web/'.$branch.'/'.$data[$i]['name'].'" target="_blank" style="display: inline-block; margin-top: 20px; font-size: 13px;"><b>Download file - '.$data[$i]['name'].' - '.$data[$i]['timestamp'].' </b></a>';
   
         echo '<br/>';
}

ftp_close($conn_id);

 
                 


?>
</div>
<?php
include("../include/footer.php"); ?>