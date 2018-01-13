<?
  $conmatrix=mysqli_connect("203.115.101.62","global","123456","matrix");
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$veh_regfalse=$_GET["veh_regfalse"];
	$veh_regtrue=$_GET["veh_regtrue"];
	if($veh_regfalse!="")
	{
		$status=0;
		$veh_reg=$_GET["veh_regfalse"];
	}
	if($veh_regtrue!="")
	{
		$status=1;
		$veh_reg=$_GET["veh_regtrue"];
	}
	
	 
	mysqli_query($conmatrix,"update matrix.services set device_removed_service=$status where veh_reg='$veh_reg'");
	
	 mysqli_close($conmatrix);
	 
	 
	 header("location:newinstallation.php");
	 ?>