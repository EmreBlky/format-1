<?php
include("../connection.php");
$myfilename=$_GET['filename'];
$filepath = __DOCUMENT_ROOT."/Pancard/".$myfilename;
//echo $_SERVER['DOCUMENT_ROOT'];
if (file_exists($filepath)) {
//download application
   header("Content-Type: application/force-download");
   //the filename will be given below
   header("Content-Disposition:filename=\"$myfilename\"");
//open file in binary mode   
$my_file = fopen($filepath, 'rb');
//output data
   fpassthru($my_file);
//close file
   fclose($my_file);
}
?>

