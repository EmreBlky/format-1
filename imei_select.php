<?php
$conn=mysqli_connect("203.115.101.30","attendantapp","attendantapp","inventory");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
		$sno=stripslashes($_POST["sno"]); 
		$sql="select device_imei from inventory.device where device_sno='".$sno."' ";
		//echo mysqli_query($conn,$sql);
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));;
		while ($row=mysqli_fetch_array($result)) {
         $imei_no=$row['device_imei'];
		    
		
}



	
}
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto+Slab);
* {
/* With these codes padding and border does not increase it's width and gives intuitive style.*/

-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}
body {
margin:0;
padding:0;
font-family: 'Roboto Slab', serif;
}
div#envelope{
width: 55%;
margin: 10px 30% 10px 25%;
padding:10px 0;
border: 2px solid gray;
border-radius:10px;
}
form{
width:70%;
margin:4% 15%;
}
header{
background-color: #4180C5;
text-align: center;
padding-top: 12px;
padding-bottom: 8px;
margin-top: -11px;
margin-bottom: -8px;
border-radius: 10px 10px 0 0;
color: aliceblue;
}

/* Makes responsive fields. Sets size and field alignment.*/
input[type=text]{
margin-bottom: 20px;
margin-top: 10px;
width:100%;
padding: 15px;
border-radius:5px;
border:1px solid #7ac9b7;
}
input[type=submit]
{
margin-bottom: 20px;
width:100%;
padding: 15px;
border-radius:5px;
border:1px solid #7ac9b7;
background-color: #4180C5;
color: aliceblue;
font-size:15px;
cursor:pointer;
}
#submit:hover
{
background-color: black;
}
textarea{
width:100%;
padding: 15px;
margin-top: 10px;
border:1px solid #7ac9b7;
border-radius:5px;
margin-bottom: 20px;
resize:none;
}
input[type=text]:focus,textarea:focus {
border-color: #4697e4;
}

</style>

<!DOCTYPE html>
<html>
<head>
<title>Imei Select Form</title>
<link rel="stylesheet" type="text/css" href="responsiveform.css">
<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="responsiveform1.css" />
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="responsiveform2.css" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="responsiveform3.css" />
</head>
<body>
<div id="envelope">
<form action="" method="post">
<header>
<h2>Imei Select Form</h2>
<p>This is my form. Fill it out. It's Awesome.</p>
</header>
</br>
<label>Device Sno</label>
<input name="sno" value="<?php if(isset($imei_no)){echo $sno;}else{} ?>"" type="text">
<label>Device Imei</label>
<input name="imei" value="<?php  if(isset($imei_no)){ echo $imei_no;}else{} ?>" type="text">
<input id="submit" type="submit" value="Show Imei">
</form>
</div>
</body>
</html>