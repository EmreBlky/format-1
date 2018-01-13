<?php
	
	function connecttodb(){
		global $dblink;
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$databasename = "matrix";
	
		$dblink = mysql_connect($hostname,$username,$password);
		@mysql_select_db($databasename,$dblink) or die("");//die("Unable to select database  $databaseName");

	}
	
function connecttoMsSql(){

		global $dblink;
		$hostname = "203.115.101.62";
		$username = "sa";
		$password = "Gtrac@#321";
		$databasename = "Inventory";
	
		//$dblink = mysql_connect($hostname,$username,$password) or die(mysql_error());
		//@mysql_select_db($databasename,$dblink) or die("");	//die(mysql_error()."Unable to select database  $databaseName");	

//connection to the database
$dbhandle = mssql_connect($hostname, $username, $password)
  or die("Couldn't connect to SQL Server on $myServer");

//select a database to work with
$selected = mssql_select_db($databasename, $dbhandle)
  or die("Couldn't open database $myDB");



	}

 


	function connecttoibmserver(){
		global $dblink;
		$hostname = "203.115.101.62";
		$username = "global";
		$password = "123456";
		$databasename = "matrix";
	
		$dblink = mysql_connect($hostname,$username,$password) ;
		@mysql_select_db($databasename,$dblink) or die("");//die(mysql_error()."Unable to select database  $databasename");

	}
	 
	 
	
	
?>