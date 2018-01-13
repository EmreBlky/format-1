<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/

if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

?>

 <script>
function ConfirmDelete(row_id)
{
  var x = confirm("Are you sure you want to Close this?");
  if (x)
  {
  approve(row_id);
      return ture;
  }
  else
    return false;
}

function approve(row_id)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=devicechangeapprove",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}
function backComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=supportComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 
		 
		location.reload(true);		
		}
	});
}
</script>
 <div class="top-bar">
                    <a href="km_alerts.php" class="button">ADD NEW </a>
                    <h1>KM Alerts</h1>
					  
                </div>
                
                <div class="table">
<?php
 
//$num=mysql_num_rows(mysql_query("SELECT * FROM new_account_creation order by id DESC"));
 
$query = mysql_query("SELECT * FROM transfer_the_vehicle  where approve_status=1 and final_status!=1   order by id DESC");

?>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>SL.No</th>
<th>Date</th>
  <th>Account Manager</th>
  <th>Company</th>
  <th>Main User Id</th>
  <th>Total No Of Vehicles</th>
  <th>Potential</th>
  <th>Contact Person</th>
  <th>Contact Number</th>
  <th>Type Of alerts</th>
  <th>Via Sms/Mail</th>
		</tr>
	</thead>
	<tbody>


 
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr align="center" <? if( $row["support_comment"]!=""){ echo 'style="background-color:red"';} ?> >

<td><?php echo $i ?></td>
  <td><?php echo $row["date"];?></td>
  <td><?php echo $row["acc_manager"];?></td>
  <td><?php echo $row["company"];?></td>
  <td><?php echo $row["main_user_id"];?></td>
  <td><?php echo $row["total_no_of_vehicles"];?></td>
  <td><?php echo $row["potential"];?></td>
  <td><?php echo $row["contact_person"];?></td>
  <td><?php echo $row["contact_number"];?></td>
  <td><?php echo $row["types_of_alert"];?></td>
  <td><?php echo $row["via_sms_mail"];?></td>    

</tr> <?php $i++; }?>
</table>
     
    <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
<?php
include("../include/footer.php"); ?>



<?php
include('lock.php');
//error_reporting(0);
include ('connection.php');
  
 // $sql="select * from km_alerts";
 // $search=mysql_query($sql);

  ?>

 
