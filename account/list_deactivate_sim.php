<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/

?>
<script>
/*function ConfirmDeactivate(row_id)
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
        url:"userInfo.php?action=deactivate_simclose",
         data:"row_id="+row_id,
        success:function(msg){
         
        location.reload(true);        
        }
    });
}*/
 function ConfirmDelete(row_id)
{
    
   var retVal = prompt("Write Comment : ", "");
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
        url:"userInfo.php?action=DeactivatesimComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
            //alert(msg);
         
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
        url:"userInfo.php?action=deactivatesimbackComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
            // alert(msg);
             
         
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
        <!--<option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>-->
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <!--<option value="4" <?if($_POST['Showrequest']=='4'){ echo "Selected"; }?>>Action Taken</option>-->
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Deactivate Sim</h1>
  <div style="float:center">
    <div align="center"><br/>
      <a href="list_deactivate_sim.php">Deactivate Sim Format
      <? $sql_pending = select_query("SELECT COUNT(*) as total FROM deactivate_sim where ((approve_status=0 or approve_status=1) and final_status!=1 and close_date is null and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");
        
        				?>
      (
      <?=$sql_pending[0]['total']?>
      )</a> | <a href="inventory_list_deactivate_sim.php">Deactivate Sim Inventory
      <? $sql_pending=mssql_query("SELECT COUNT(*) FROM Sim WHERE flag=3 and sim_status=92 and active_status=1 and status=0");
        
       					 $row_pending=mssql_fetch_array($sql_pending);?>
      (
      <?=$row_pending[0]?>
      )</a> <br/>
    </div>
  </div>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Account</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<br/>
<div style="float:right";><a href="reportfiles/deactivate_sim_excel.xls">Create Excel</a><br/>
</div>
<div class="table">
  <?php
if($_POST["Showrequest"]==1)
 {
      //$WhereQuery=" where approve_status=1 and final_status=1";
      $WhereQuery=" where final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
    // $WhereQuery=" where approve_status=1 ";
      $WhereQuery=" where approve_status=0 ";
 }
  /*else if($_POST["Showrequest"]==3)
 {
     $WhereQuery=" where approve_status=1 and final_status!=1";
 }
 else if($_POST["Showrequest"]==4)
 {
     $WhereQuery=" where approve_status=0 and final_status=1 and (account_comment!='' or forward_back_comment!='')";
 }*/
 else
 { 
      
    /* $WhereQuery=" where (approve_status=0 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')";*/
    
    $WhereQuery=" where ((approve_status=0 or approve_status=1) and final_status!=1 and close_date is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
  
 }
  
 
 
$query = select_query("SELECT * FROM deactivate_sim   ". $WhereQuery."  order by id desc ");   
?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>client</th>
        <th>Vehicle Number</th>
        <th>Devcie IMEI</th>
        <th>SIM No</th>
        <th>Oprator</th>
        <th>Ownership</th>
        <th>Reason</th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
$excel_data.='<table cellpadding="5" cellspacing="5" border="1"><thead><tr><td colspan="10" align="center"><strong>Deactivate Sim Report</strong></td></tr><tr><td colspan="10"></td></tr><tr><th width="5%">SL.No</th><th width="10%">Date </th><th width="10%">Account Manager </th><th width="10%">client</th><th width="10%">Vehicle Number</th><th width="10%">Devcie IMEI </th><th width="10%">SIM No </th><th width="10%">Oprator</th><th width="10%">Ownership</th><th width="10%">Reason</th></tr></thead><tbody>';


//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}elseif($query[$i]["total_pending"]!="" && $query[$i]["account_comment"]=="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';} elseif($query[$i]["final_status"]==1 ){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
        <td><?php echo $query[$i]["client"];?></td>
        <td><?php echo $query[$i]["vehicle"];?></td>
        <td><?php echo $query[$i]["device_imei"];?></td>
        <td><?php echo $query[$i]["device_sim"];?></td>
        <td><?php $oprator_name = mssql_fetch_array(mssql_query("select operator from sim where phone_no like '%".trim($query[$i]["device_sim"])."%'")); echo $oprator_name["operator"];?></td>
        <td><?php echo $query[$i]["ps_of_ownership"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td><a href="#" onClick="Show_record(<?php echo $query[$i]["id"];?>,'deactivate_sim','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <?php //if( $query[$i]["final_status"]==1 && $query[$i]["close_date"]=='' ){ ?>
          
          <!--| <a href="#" onclick="return ConfirmDeactivate(<?php //echo $query[$i]["id"];?>);"  >Done</a>-->
          
          <?php //} 
    if( $query[$i]["final_status"]!=1 && $query[$i]["account_comment"]=='' ){
    ?>
          | <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Comment</a>
          <?php }
    if( $query[$i]["forward_back_comment"]=="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"]){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <?php }}?></td>
      </tr>
      <?php 
   
    
    $excel_data.="<tr><td width='5%'>".$i."</td><td width='10%'>".$query[$i]["date"]."</td><td width='10%'>".$query[$i]["acc_manager"]."</td><td width='10%'>".$query[$i]["client"]."</td><td width='10%'>".$query[$i]["vehicle"]."</td><td width='10%'>".$query[$i]["device_imei"]."</td><td width='10%'>".$query[$i]["device_sim"]."</td><td width='10%'>".$oprator_name["operator"]."</td><td width='10%'>".$query[$i]["ps_of_ownership"]."</td><td width='10%'>".$query[$i]["reason"]."</td></tr>";
     
    }
    $excel_data.='</tbody></table>';
    ?>
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

unlink(__DOCUMENT_ROOT.'/account/reportfiles/deactivate_sim_excel.xls');
$filepointer=fopen(__DOCUMENT_ROOT.'/account/reportfiles/deactivate_sim_excel.xls','w');
fwrite($filepointer,$excel_data);
fclose($filepointer);

include("../include/footer.php"); ?>
