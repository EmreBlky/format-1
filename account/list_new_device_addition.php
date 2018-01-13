<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');
 
/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

?>
<script>
function ConfirmDelete(row_id)
{
  var x = confirm("Are you sure you want to Approve?");
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
        url:"userInfo.php?action=new_device_additionapprove",
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
        url:"userInfo.php?action=new_device_additionadminComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
             alert(msg);
             
         
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
  addComment1(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment1(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=newdeviceadditionbackComment",
          
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
      <select name="Showrequest" id="Showrequest" onChange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="1" <? if($_POST['Showrequest']==1){ echo "Selected"; }?>>No Billing</option>
        <option value="2" <? if($_POST['Showrequest']==2){ echo "Selected"; }?>>Billing</option>
        <option value="" <? if($_POST['Showrequest']==''){ echo "Selected" ;}?>>All</option>
      </select>
    
  </div>
  <h1>New Device Addition List</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>

<table cellspacing="5" cellpadding="5">
	<tr><td>Filter By Client:</td>
    <td><select name="client_list" id="client_list">
               <option value="" >-- Select One --</option>
            <?php
            $sql_client=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_parent_user=1 AND sys_active=1 ORDER BY `name` asc");
			for($u=0;$u<count($sql_client);$u++)
            {
            ?>
           		 <option   value ="<?php echo $sql_client[$u]['user_id'] ?>" <? if($_POST['client_list']==$sql_client[$u]['user_id']){ echo 'Selected'; }?>> <?php echo $sql_client[$u]['name']; ?> </option>
            <?php
            }
            ?></select></td>
  	</tr>
    </table>

	<table cellspacing="5" cellpadding="5">
	<tr>
                 <td >From Date</td>
                  <td><input type="text" name="FromDate" id="FromDate" value="<? echo $_POST['FromDate'];?>"/></td>
                    
                  <td>To Date</td>
                  <td><input type="text" name="ToDate" id="ToDate"  value="<? echo $_POST['ToDate'];?>" /></td>
					<td align="center"> <input type="submit" name="add" value="submit" /></td>   
	</tr>
	</table>
</form>
</div>
<div class="table">
<?php
if(($_POST['FromDate']=='') && ($_POST['ToDate']==''))
{
	 /*$time2= $_POST['FromDate']; 
 	 $time2=$_POST['ToDate']; */
}
else
{
	$time1=date("Y-m-d H:i:s",strtotime($_POST['FromDate']." 00:00:00"));
	$time2=date("Y-m-d H:i:s",strtotime($_POST['ToDate']." 23:59:59"));
}
if(isset($_POST['add']))
{
	if($_POST["Showrequest"]==1)
	{ 
		if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery=" where (billing='No' or billing_if_old_device='No') and final_status=1 and  user_id='".$_POST['client_list']."' ";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery=" where (billing='No' or billing_if_old_device='No') and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and (billing='No' or billing_if_old_device='No') and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery=" where (billing='No' or billing_if_old_device='No') and final_status=1 order by date DESC limit 500";
		}

	}
	else if($_POST["Showrequest"]==2)
	{
		if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='') )";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery=" where ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')) and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and (((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))) and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery=" where ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')) order by date DESC limit 500";
		}
	}
	else
	{
		if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery="where final_status=1 and  user_id='".$_POST['client_list']."'";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery="where final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery="where user_id='".$_POST['client_list']."' and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery="where final_status=1 order by date DESC limit 500";
		}
	}
}
else if($_POST["Showrequest"]==1)
{
  	    if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and (billing='No' or billing_if_old_device='No') and final_status=1";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery=" where (billing='No' or billing_if_old_device='No') and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and (billing='No' or billing_if_old_device='No') and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery=" where (billing='No' or billing_if_old_device='No') and final_status=1 order by date DESC limit 500";
		}

}
else if($_POST["Showrequest"]==2)
{
    	if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='') )";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery=" where ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')) and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery=" where user_id='".$_POST['client_list']."' and (((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))) and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery=" where ((billing='Yes' or billing_if_old_device='Yes') and final_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')) order by date DESC limit 500";
		}
}
else
{ 
	    if(isset($_POST['client_list']) && !empty($_POST['client_list']) && !isset($time1) && empty($time1) && !isset($time2) && empty($time2) )
		{
			$WhereQuery="where final_status=1 and  user_id='".$_POST['client_list']."'";
		}
		else if(isset($time1) && !empty($time1) && isset($time2) && !empty($time2) && !isset($_POST['client_list']) && empty($_POST['client_list']))
		{
			$WhereQuery="where final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else if(isset($_POST['client_list']) && !empty($_POST['client_list']) && isset($time1) && !empty($time1) && isset($time2) && !empty($time2))
		{
			$WhereQuery="where user_id='".$_POST['client_list']."' and final_status=1 and date>='".$time1."' AND date<='".$time2."'";
		}
		else
		{
			$WhereQuery="where final_status=1 order by date DESC limit 500";
		}
}
//echo "SELECT * FROM new_device_addition ". $WhereQuery.""; 
$query = select_query("SELECT * FROM new_device_addition ". $WhereQuery."");
//print_r($_post); die;
//echo "<pre>";print_r($query);die;
?>
  
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr> 
        <!--<th>SL.No</th>-->
        <th>Date</th>
        <!--<th>Sales Manager</th>-->
        <th>Client</th>
        <th>Company Name</th>
        <th>IMEI</th>
        <th>Device Model</th>
        <th>Vehicles No</th>
        <!--<th>OLD Vehicles No</th>-->
        <th>NEW Vehicles No</th>
        <th>Device Type</th>
        <th>Billing</th>
        <th>No Billing Reason</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
 <?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 && $query[$i]["service_comment"]==""){ echo 'style="background-color:#F2F5A9"';}?> > 
        
        <!--<td><?php echo $i+1;?></td>-->
        <td><?php echo $query[$i]["date"];?></td>
        <!--<td><?php echo $query[$i]["sales_manager"];?></td>-->
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
    $rowuser=select_query($sql);
    ?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["device_imei"];?></td>
        <td><?php echo $query[$i]["device_model"];?></td>
        <td><?php echo $query[$i]["vehicle_no"];?></td>
        <? $vehicleno = preg_replace("/[^a-z0-9_-]+/i",'', $query[$i]["vehicle_no"]);
       $old_veh = str_replace('-','', $vehicleno);
    $sql="select old_reg_no,new_reg_no from vehicle_no_change  where user_id='".$query[$i]["user_id"]."' and old_reg_no like '%".$old_veh."%' order by date desc";
    $rowvehHistory=select_query($sql);
    if(count($rowvehHistory)>0)
     {
    ?>
        <!--<td><?php //echo $rowvehHistory[0]["old_reg_no"];?></td>-->
        <td><?php echo $rowvehHistory[0]["new_reg_no"];?></td>
        <?
    }
    else
    {?>
        <td><?php echo "----";?></td>
        <? }?>
        <td><?php echo $query[$i]["device_type"];?></td>
        <? /*if($query[$i]["device_type"]=='New'){
    $billing_status=$query[$i]["billing"];
    }
    else{
    $billing_status=$query[$i]["billing_if_old_device"];
    }*/
        ?>
        <td style="background-color:#8CEAEA"><?php echo $query[$i]["billing"]; ?></td>
        <td style="background-color:#8CEAEA"><?php echo $query[$i]["billing_if_no_reason"];?></td>
        <td><a href="#" onClick="Show_record(<?php echo $query[$i]["id"];?>,'new_device_addition','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          
          <!--| <a href="#" onClick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>-->
          
          <? 
    if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"] ){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
      </tr>
      <?php  }?>
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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type="text/javascript">
var j = jQuery.noConflict();
j(function() 
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });

j( "#ToDate" ).datepicker({ dateFormat: "yy-mm-dd" });

});

    </script> 
<?php
include("../include/footer.php"); ?>