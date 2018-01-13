<?php
error_reporting(0);
include ('../connection.php');
include ('../Pagination.php');
$Pagination = new Pagination(100, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("SELECT * FROM new_device_addition LIMIT $start,$end");   
  //$sql="select * from new_device_addition";
 // $search=mysql_query($sql);

  ?>