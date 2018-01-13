<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support_admin.php');


if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

?>
<script>
function ConfirmDelete(row_id)
{
   var retVal1 = prompt("No. of Approve Device : ", "Enter Digits Only");
	
	if (retVal1)
	{
		if (retVal1 >= 0 && retVal1 != "")
		{
			addComment1(row_id,retVal1);
			return true;
		}
		else
		{
			 alert("Please Enter Digits Only");
			 false;
		}
	}
	else
	{
		//alert("Please Enter Digits Only");
		return false;
	}
}

function addComment1(row_id,retVal1)
{
	
$.ajax({
		type:"GET",
		url:"userInfo.php?action=Installationapprove",
		data:"row_id="+row_id+"&comment="+retVal1,
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
		url:"userInfo.php?action=InstallationadminComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			  //alert(msg);
		 
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
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Installation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
 if($_POST["Showrequest"]==1)
 {
	  /*$WhereQuery=" where installation_status=5 and (branch_id=1 or inter_branch=1)";*/
	  $WhereQuery=" where installation_status=5 and approve_status=1 and branch_id!=1 and inter_branch=0";
 }
 else if($_POST["Showrequest"]==2)
 {
	 /*$WhereQuery=" where (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery="where branch_id!=1 and inter_branch=0";
 }
 else if($_POST["Showrequest"]==3)
 {
	 /*$WhereQuery=" where approve_status=1 and installation_status IN(1,9) and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where approve_status=1 and installation_status IN(1,9) and branch_id!=1 and inter_branch=0";
 }
 else if($_POST["Showrequest"]==4)
 {
	 /*$WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null and branch_id!=1 and inter_branch=0";
 }
 else
 { 
	  
	 /*$WhereQuery=" where installation_status=8 and approve_status=0 and (branch_id=1 or inter_branch=1) and (admin_comment is null or sales_comment!='') ";*/
	 $WhereQuery=" where installation_status=8 and approve_status=0 and branch_id!=1 and inter_branch=0 and (admin_comment is null or sales_comment!='') ";
  
 }
  
$query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation_request ". $WhereQuery."  order by id DESC ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Request Date</th>
        <th>Sales Person</th>
        <th>Client</th>
        <th>No. Of Vehicle</th>
        <th>Device Price</th>
        <th>Rent Price</th>
        <th>mode of payment</th>
        <th>Model</th>
        <th>Time</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
	$sales = select_query("select name from sales_person where id='".$query[$i]['sales_person']."' ");
?>
      <tr align="center" <? if($query[$i]["approve_status"]==1 && $query[$i]["installation_status"]!=5){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#F2F5A9"';}elseif($query[$i]["installation_status"]==5){ echo 'style="background-color:#99FF66"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["req_date"];?></td>
        <td><?php echo $sales[0]['name'];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
			$rowuser=select_query($sql);
		?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["no_of_vehicals"];?></td>       
        <td><?php echo $query[$i]['device_price_total'];?></td> 
        <td><?php echo $query[$i]["DTotalREnt"];?></td>  
        <td><?php echo $query[$i]["mode_of_payment"];?></td>     
        <td><?php echo $query[$i]["model"];?></td>
        <td><?php echo $query[$i]["time"];?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          |
          <? if($query[$i]["approve_status"]==1){?>
          Approved
          <?}else{?>
          <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Approve</a>
          <?}?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php }?></td>
      </tr>
      <?php }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>
