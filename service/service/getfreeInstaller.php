<?
include ("config.php");

mysql_query("update installer set status=0 where inst_name='".$_GET['name']."'");
?>