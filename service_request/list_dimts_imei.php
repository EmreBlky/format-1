<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
$user_id=$_POST["main_user_id"];
$ext1='pancard.jpg';
$ext2='addproof.jpg';

 $file_name1=''.$user_id.'_'.$ext1;
 $file_name2=''.$user_id.'_'.$ext2;


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
		url:"userInfo.php?action=dimts_imeiclose",
 		data:"row_id="+row_id,
		success:function(msg){
		 
		location.reload(true);		
		}
	});
}

function ConfirmReactivate(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addreasonComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addreasonComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=RenewDimtsImiei",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			// alert(msg);
		 
		location.reload(true);		
		}
	});
}

</script>
<script>
function forwardbackComment(row_id)
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
		url:"userInfo.php?action=dimtsimeibackComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 alert(msg);
			 
		 
		location.reload(true);		
		}
	});
}
</script>
<div class="top-bar">
                                      <div align="center">
 <form name="myformlisting" method="post" action="">
  <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
        
        </select>
        </form>
        </div> <a href="Dimts_imei.php" class="button">ADD NEW </a>
					  <br/>
                    <h1>Dimts Imei List</h1>
					  <br/>
                <div style="float:right";><font style="color:#6BBBE7;font-weight:bold;">Blue:</font> Back from Repair</div>
                <br/>
                <div style="float:right";><font style="color:#DA8954;font-weight:bold;">Brown:</font> Port changed</div>
                <br/>
                <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Admin</div>
                <br/>
                <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Payemnt Cleared</div>	
                <br/>
                <div style="float:right";><font style="color:#DDE362;font-weight:bold;">Yellow:</font> IEMI Uploaded</div>
                <br/>	
                <div style="float:right";><font style="color:#C0C0C0;font-weight:bold;">Pink:</font> IEMI Not Uploaded</div>	
                <br/>
                <div style="float:right";><font style="color:#CFBF7E;font-weight:bold;">Brown:</font>Admin forward request</div><br/>
                <div style="float:right";><font style="color:#AC8DCD;font-weight:bold;">Purple:</font>  Dimts Slip Done</div>	

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <tr align="right">
            <td>
                User Name</td>
            <td>

		<select name="main_user_id" id="TxtMainUserId">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($m=0;$m<count($main_user_id);$m++)
			
					{
			?>
             <option name="main_user_id" value="<?=$main_user_id[$m]['name']?>" >
       			 <?php echo $main_user_id[$m]['name']; ?>				</option>
				  <?php 
					
					} 
 
  ?>
</select>                </td>
  </tr>
<input type="submit" name="file1" value="Pan Card" />
<input type="submit" name="file2" value ="Address Proof"/>
<input type="hidden" name="getfile" value =""/>
</form>

<?php if($_POST["file1"]){
 $filename=$file_name1;
echo '<a href="'.__DOCUMENT_ROOT.'/service_request/download_client_pancard.php?filename='.$filename.'"><b>Download file!</b></a>';
}
else if($_POST["file2"]){
 $filename=$file_name2;
echo '<a href="'.__DOCUMENT_ROOT.'/service_request/download_client_addproof.php?filename='.$filename.'"><b>Download file!</b></a>';
}
?>

	  
</div>
                
                <div class="table">
                 <?php
 
   if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where (approve_status=1 or account_comment!='') and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" ";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (service_comment!='' or forward_back_comment!='') and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else
 { 
	  
	/* $WhereQuery=" where (((approve_status=0 and (service_comment is null or dimts_status=2)) or approve_status=1) and final_status!=1)  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))";*/
	 
	  $WhereQuery=" where ((approve_status=0 or approve_status=1) and final_status!=1) and (service_comment is null or dimts_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))";
	   
 }
  

$query = select_query("SELECT * FROM dimts_imei ". $WhereQuery."  order by id DESC ");

?>
              </p>
<p>&nbsp;                 </p>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
            <th>SL.No</th>
            <th>Date</th>
            <th>Sales Manager</th>
            <th>User Name</th>
            <th>Company Name</th>
            <th>Vehicle Number</th>
            <th>7 digit IMEI</th>
            <th>15 Digit IMEI</th>
            <th>Changed to Port</th>
            <th>View Detail</th>
            <th>Edit</th>
		</tr>
	</thead>
	<tbody>


 
<?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>

<tr align="center" <? if($query[$i]["final_status"]==1){ echo 'style="background-color:#AC8DCD"';}elseif($query[$i]["account_comment"]!=''){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["admin_comment"]!='' && $query[$i]["approve_status"]!=1){ echo 'style="background-color:#FF0000"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ echo 'style="background-color:#CFBF7E"';}elseif($query[$i]["repair_comment"]!=''){ echo 'style="background-color:#DA8954"';}elseif($query[$i]["port_change_reason"]!=''){ echo 'style="background-color:#6BBBE7"';}elseif($query[$i]["support_comment"]!=''){ echo 'style="background-color:#DDE362"';}elseif($query[$i]["imei_upload_reason"]!=''){ echo 'style="background-color:#C0C0C0"';}?> > 

<td><?php echo $i+1;?></td>
<td><?php echo $query[$i]["date"];?></td>
<td><?php echo $query[$i]["sales_manager"];?></td>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
<td><?php echo $rowuser[0]["sys_username"];?></td>
<td><?php echo $query[$i]["client"];?></td> 
<td><?php echo $query[$i]["veh_reg"];?></td> 
<td><?php echo $query[$i]["device_imei_7"];?></td> 
<td><?php echo $query[$i]["device_imei_15"];?></td> 
<td><?php echo $query[$i]["port_change"];?></td> 
<td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'dimts_imei','popup1'); " class="topopup">View Detail</a>
 <?php if($_POST["Showrequest"]==1 && $query[$i]["renew_status"]=='N'){?>
   | <a href="#" onclick="return ConfirmReactivate(<?php echo $query[$i]["id"];?>);"  >Renew</a>
   <? }?>
<?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){
	if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ ?>
    |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
    <?php }?>
    | <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Done</a>
    <?php } ?>
</td>
<td>
	<?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){
		if( $query[$i]["port_change_reason"]!="" or $query[$i]["payment_status"]!="" or $query[$i]["imei_upload_reason"]!="") {?>   
        <a href="Dimts_imei.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a>
    <?php }} ?>
</td>
</tr> <?php  }?>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
<?php
include("../include/footer.php"); ?>

