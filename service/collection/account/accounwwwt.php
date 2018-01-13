<?php
 include("dbcon.php");

if(isset($_GET["userid"]) && $_GET["userid"]!="" )
{
	$User_Id= $_GET["userid"];
}
 if(isset($_POST["submit"]))
 {
   


	 if($_POST["submit"]=="Payment")
	 {
		 $calling_status="1";
		 //user_id,calling_date,calling_status,payment_recdate,paymentby,amount_rec,cheque_no,coment_bycalling,comment_byaccounts
  
	 }
	 else if($_POST["submit"]=="Further calling")
	 {
		 $calling_status="0";
	 }
	 $coment_bycalling=$_POST["TxtComment"];

 
	 mysql_query("insert into user_paymentstatus(user_id,calling_date,calling_status,coment_bycalling) values('".$User_Id."','".date("d-m-y h:m")."','".$calling_status."','".$coment_bycalling."')");
		echo $login_attempt_id=mysql_insert_id();

	   
 }
 
		 

?>
<style>
body,td{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
</style>
<html>
<head>
</head>
<body>


<form name="form1" method="post" action="add_collectioncomment.php?userid=<? echo  $_GET["userid"] ?>">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="3" align="center"><strong>Add Comment</strong></td>

  </tr>
    <tr>
    <td colspan="3" align="left" style="color:red">
	<?php
	if($error!=""){
	echo "".$error."<br><br>";
	}
	?>
	
	</td>

  </tr>
  <tr>
    <td width="57%">Comment</td>
    <td width="1%">:</td>
    <td width="42%">
	<textarea rows="4" cols="20" name="TxtComment">
 </textarea> </td>
  </tr>
  <!--<tr>
    <td>Old Password</td>
    <td>:</td>
    <td><input type="password" name="password" id="password" value=""></td>
  </tr>-->
   
  <tr>
    <td><input type="submit" name="submit" value="Payment"></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Further calling"></td>
  </tr>
</table>
</form>
</body>
</html>
