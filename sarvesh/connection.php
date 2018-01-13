<?php
$cn=mysql_connect("collectiondb.db.5296103.hostedresource.com","collectiondb","Collection#123");
if(!$cn)
{
die('could not connect' . mysql_error());
}
mysql_select_db("collectiondb", $cn);
?>