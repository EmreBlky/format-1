<?php
$myfile = fopen("http://203.115.101.54/format_testing/service_request/re_installation.php", "r") or die("Unable to open file!");
// Output one character until end-of-file
while(!feof($myfile)) {
  echo fgetc($myfile);
}
fclose($myfile);
?>