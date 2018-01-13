<?php
session_start();
include("../connection.php");
if(isset($_REQUEST["id"]))
{
	  $id=$_REQUEST["id"];
	  $req_id=$_REQUEST["req_id"];

}


 
 if(isset($_POST['submit']))
{
	 
   $requested_user=$_POST['requested_user'];
   $forward_comment=$_POST['forward_comment'];
 
  if($req_id=='1')
  {
		$data_query = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM device_change  where id=$id";
	    $row=select_query($data_query);
		
		if($row[0]["forward_req_user"] == "")
		{
			$query1="update device_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			 mysql_query($query1);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('device_change','".$id."','".$row[0]["forward_req_user"]."','".$row[0]["forward_comment"]."','".$row[0]["forward_back_comment"]."')");

			$query1="update device_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query1);
			echo "Request forwarded successfully";
		}
   }
  elseif($req_id=='2')
 {
		$data_query2 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM new_device_addition where id=$id";
	    $row2=select_query($data_query2);
		
		if($row2[0]["forward_req_user"] == "")
		{
			$query2="update new_device_addition set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query2);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query2 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('new_device_addition','".$id."','".$row2[0]["forward_req_user"]."','".$row2[0]["forward_comment"]."','".$row2[0]["forward_back_comment"]."')");

			$query1="update new_device_addition set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query1);
			echo "Request forwarded successfully";
		}
		
 }
 elseif($req_id=='3')
 {
		
		$data_query3 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM vehicle_no_change where id=$id";
	    $row3=select_query($data_query3);
		
		if($row3[0]["forward_req_user"] == "")
		{
			$query3="update vehicle_no_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			 mysql_query($query3);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('vehicle_no_change','".$id."','".$row3[0]["forward_req_user"]."','".$row3[0]["forward_comment"]."','".$row3[0]["forward_back_comment"]."')");

			$query3="update vehicle_no_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query3);
			echo "Request forwarded successfully";
		}

}
 elseif($req_id=='4')
 {
		$data_query4 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM sim_change where id=$id";
	    $row4=select_query($data_query4);
		
		if($row4[0]["forward_req_user"] == "")
		{
			$query4="update sim_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query4);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query4 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('sim_change','".$id."','".$row4[0]["forward_req_user"]."','".$row4[0]["forward_comment"]."','".$row4[0]["forward_back_comment"]."')");

			$query4="update sim_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query4);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='5')
 {
		$data_query5 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM device_lost where id=$id";
	    $row5=select_query($data_query5);
		
		if($row5[0]["forward_req_user"] == "")
		{
			$query5="update device_lost set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query5);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query5 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('device_lost','".$id."','".$row5[0]["forward_req_user"]."','".$row5[0]["forward_comment"]."','".$row5[0]["forward_back_comment"]."')");

			$query5="update device_lost set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query5);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='6')
 {
		$data_query6 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM deletion where id=$id";
	    $row6=select_query($data_query6);
		
		if($row6[0]["forward_req_user"] == "")
		{
			$query6="update deletion set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query6);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query6 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('deletion','".$id."','".$row6[0]["forward_req_user"]."','".$row6[0]["forward_comment"]."','".$row6[0]["forward_back_comment"]."')");

			$query6="update deletion set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query6);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='7')
 {
		$data_query7 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM deactivate_sim where id=$id";
	    $row7=select_query($data_query7);
		
		if($row7[0]["forward_req_user"] == "")
		{
			$query7="update deactivate_sim set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query7);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query7 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('deactivate_sim','".$id."','".$row7[0]["forward_req_user"]."','".$row7[0]["forward_comment"]."','".$row7[0]["forward_back_comment"]."')");

			$query7="update deactivate_sim set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query7);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='8')
 {
		$data_query8 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM dimts_imei where id=$id";
	    $row8=select_query($data_query8);
		
		if($row8[0]["forward_req_user"] == "")
		{
			$query8="update dimts_imei set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query8);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query8 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('dimts_imei','".$id."','".$row8[0]["forward_req_user"]."','".$row8[0]["forward_comment"]."','".$row8[0]["forward_back_comment"]."')");

			$query8="update dimts_imei set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query8);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='9')
 {
		$data_query9 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM new_account_creation where id=$id";
	    $row9=select_query($data_query9);
		
		if($row9[0]["forward_req_user"] == "")
		{
			$query9="update new_account_creation set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query9);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query9 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('new_account_creation','".$id."','".$row9[0]["forward_req_user"]."','".$row9[0]["forward_comment"]."','".$row9[0]["forward_back_comment"]."')");

			$query9="update new_account_creation set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query9);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='10')
 {
		$data_query10 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM stop_gps where id=$id";
	    $row10=select_query($data_query10);
		
		if($row10[0]["forward_req_user"] == "")
		{
			$query10="update stop_gps set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query10);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query10 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('stop_gps','".$id."','".$row10[0]["forward_req_user"]."','".$row10[0]["forward_comment"]."','".$row10[0]["forward_back_comment"]."')");

			$query10="update stop_gps set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query10);
			echo "Request forwarded successfully";
		}
		
}
 elseif($req_id=='11')
 {
		$data_query11 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM sub_user_creation where id=$id";
	    $row11=select_query($data_query11);
		
		if($row11[0]["forward_req_user"] == "")
		{
			$query11="update sub_user_creation set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query11);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query11 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('sub_user_creation','".$id."','".$row11[0]["forward_req_user"]."','".$row11[0]["forward_comment"]."','".$row11[0]["forward_back_comment"]."')");

			$query11="update sub_user_creation set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query11);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='12')
 {
		$data_query12 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM deactivation_of_account where id=$id";
	    $row12=select_query($data_query12);
		
		if($row12[0]["forward_req_user"] == "")
		{
			$query12="update deactivation_of_account set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query12);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query12 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('deactivation_of_account','".$id."','".$row12[0]["forward_req_user"]."','".$row12[0]["forward_comment"]."','".$row12[0]["forward_back_comment"]."')");

			$query12="update deactivation_of_account set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query12);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='13')
 {
		$data_query13 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM del_form_debtors where id=$id";
	    $row13=select_query($data_query13);
		
		if($row13[0]["forward_req_user"] == "")
		{
			$query13="update del_form_debtors set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query13);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query13 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('del_form_debtors','".$id."','".$row13[0]["forward_req_user"]."','".$row13[0]["forward_comment"]."','".$row13[0]["forward_back_comment"]."')");

			$query13="update del_form_debtors set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query13);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='14')
 {
		$data_query14 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM discount_details where id=$id";
	    $row14=select_query($data_query14);
		
		if($row14[0]["forward_req_user"] == "")
		{
			$query14="update discount_details set forward_by='".$_SESSION["user_name"]."', forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query14);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query14 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_by, forward_req_user, forward_comment, forward_back_comment)
            VALUES('discount_details','".$id."','".$_SESSION["user_name"]."',".$row14[0]["forward_req_user"]."','".$row14[0]["forward_comment"]."','".$row14[0]["forward_back_comment"]."')");

			$query14="update discount_details set forward_by='".$_SESSION["user_name"]."', forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query14);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='15')
 {
		$data_query15 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM no_bills where id=$id";
	    $row15=select_query($data_query15);
		
		if($row15[0]["forward_req_user"] == "")
		{
			$query15="update no_bills set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query15);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query15 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('no_bills','".$id."','".$row15[0]["forward_req_user"]."','".$row15[0]["forward_comment"]."','".$row15[0]["forward_back_comment"]."')");

			$query15="update no_bills set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query15);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='16')
 {
		$data_query16 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM software_request where id=$id";
	    $row16=select_query($data_query16);
		
		if($row16[0]["forward_req_user"] == "")
		{
			$query16="update software_request set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query16);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query16 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('software_request','".$id."','".$row16[0]["forward_req_user"]."','".$row16[0]["forward_comment"]."','".$row16[0]["forward_back_comment"]."')");

			$query16="update software_request set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query16);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='17')
 {
		$data_query17 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM transfer_the_vehicle where id=$id";
	    $row17=select_query($data_query17);
		
		if($row17[0]["forward_req_user"] == "")
		{
			$query17="update transfer_the_vehicle set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query17);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query17 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('transfer_the_vehicle','".$id."','".$row17[0]["forward_req_user"]."','".$row17[0]["forward_comment"]."','".$row17[0]["forward_back_comment"]."')");

			$query17="update transfer_the_vehicle set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query17);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='18')
 {
		$data_query18 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM imei_change where id=$id";
	    $row18=select_query($data_query18);
		
		if($row18[0]["forward_req_user"] == "")
		{
			$query18="update imei_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query18);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query18 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('imei_change','".$id."','".$row18[0]["forward_req_user"]."','".$row18[0]["forward_comment"]."','".$row18[0]["forward_back_comment"]."')");

			$query18="update imei_change set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query18);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='19')
 {
		$data_query19 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM reactivation_of_account where id=$id";
	    $row19=select_query($data_query19);
		
		if($row19[0]["forward_req_user"] == "")
		{
			$query19="update reactivation_of_account set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query19);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query19 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('reactivation_of_account','".$id."','".$row19[0]["forward_req_user"]."','".$row19[0]["forward_comment"]."','".$row19[0]["forward_back_comment"]."')");

			$query19="update reactivation_of_account set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query19);
			echo "Request forwarded successfully";
		}
		
}
elseif($req_id=='20')
 {
		$data_query20 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM renew_dimts_imei where id=$id";
	    $row20=select_query($data_query20);
		
		if($row20[0]["forward_req_user"] == "")
		{
			$query20="update renew_dimts_imei set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query20);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query20 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('renew_dimts_imei','".$id."','".$row20[0]["forward_req_user"]."','".$row20[0]["forward_comment"]."','".$row20[0]["forward_back_comment"]."')");

			$query20="update renew_dimts_imei set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query20);
			echo "Request forwarded successfully";
		}
		
 }
elseif($req_id=='21')
 {
		$data_query21 = "SELECT id,forward_req_user,forward_comment,forward_back_comment FROM start_gps where id=$id";
	    $row21=select_query($data_query21);
		
		if($row21[0]["forward_req_user"] == "")
		{
			$query21="update start_gps set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."' where id=$id";
			mysql_query($query21);
			echo "Request forwarded successfully";
		}
		else{
			
			$inser_query21 = mysql_query("INSERT INTO forward_req_history(table_name, table_row_id, forward_req_user, forward_comment, forward_back_comment)
            VALUES('start_gps','".$id."','".$row21[0]["forward_req_user"]."','".$row21[0]["forward_comment"]."','".$row21[0]["forward_back_comment"]."')");

			$query21="update start_gps set forward_req_user='".$requested_user."',forward_comment='".$forward_comment."',forward_back_comment='' where id=$id";
			 mysql_query($query21);
			echo "Request forwarded successfully";
		}
		
  }

}

 
?>

 <html>
<head>
 
</head>
<body>


<? if(!isset($_REQUEST["view"]) && $_REQUEST["view"]!=true)
{?>

<form name="forwardrequest" method="post" action="forwardrequest.php?id=<?echo $_REQUEST["id"]?>&req_id=<?echo$_REQUEST["req_id"]?>">



<table border="0" cellspacing="5" cellpadding="5" align="left">
 <tr><td>Forward request to</td></tr>
<tr>
 <td>
  <select name="requested_user" id="requested_user" width="150px">
        <option value="" >-- Select One --</option>
        <option value="pallavi" >Pallavi</option>
         <option value="ragini" >Ragini</option>
          <option value="rajeshree" >Rajeshree</option>
        <?php
        /*$main_city=mysql_query(" select login_name from requested_users where active_status=1 order by login_name");
        while($data=mysql_fetch_assoc($main_city))
        {*/
			  ?>
        
       <!-- <option value ="<?php //echo $data['login_name'] ?>"  <?echo $selected;?>>-->
        <?php //echo $data['login_name']; ?>
        <!--</option>-->
        <?php 
        //} 
        
        ?>
        </select>
 </td>
 </tr>
 <tr><td><textarea rows="3" cols="25" name="forward_comment" id="forward_comment"></textarea></td></tr>
 <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>

<?  
}
 
?>
</body>
</html>
