<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/
 

?>
<script>
function ConfirmPaymentClear(row_id)
{
  var x = confirm("All payment cleared?");
  if (x)
  {
  PaymentClear(row_id);
      return ture;
  }
  else
    return false;
}

function PaymentClear(row_id)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=NoBillPaymentClear",
         data:"row_id="+row_id,
        success:function(msg){
         
        location.reload(true);        
        }
    });
}

function ConfirmPaymentPending(row_id)
{
   var retVal = prompt("Pending Amount : ", "Pending Amount");
  if (retVal)
  {
  PaymentPending(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function PaymentPending(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=NoBillPaymentPending",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
              
        location.reload(true);        
        }
    });
}

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
        url:"userInfo.php?action=no_billsclose",
         data:"row_id="+row_id,
        success:function(msg){
         
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
        url:"userInfo.php?action=nobillbackComment",
          
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
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>No Bill</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FFC184;font-weight:bold;">Light Brown:</font> Back from Account</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
if($_POST["Showrequest"]==1)
 {
      $WhereQuery=" where approve_status=1 and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
     //$WhereQuery=" where approve_status=0 ";
     $WhereQuery=" ";
 }
  else if($_POST["Showrequest"]==3)
 {
     $WhereQuery=" where approve_status=1 and final_status!=1";
 }
 else if($_POST["Showrequest"]==4)
 {
     $WhereQuery=" where (total_pending!='' or account_comment!='' or forward_back_comment!='') and approve_status=0 and final_status=0";
 } 
 else
 { 
     /*$WhereQuery=" where (no_bill_issue='Client Side Issue' or no_bill_issue='Cracked Device' or software_comment!='' or service_comment!='') and (approve_status=0 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";*/
     
      $WhereQuery=" where (((approve_status=0 and (no_bill_issue IN('Cracked Device','Device On Demo') or service_comment!='' or software_comment!='') and total_pending is null and account_comment is null) or approve_status=1) and final_status!=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
 }
  
 
$query = select_query("SELECT * FROM no_bills  ". $WhereQuery." order by id desc ");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Client</th>
        <th>Vehicle Number</th>
        <th>No Bill For</th>
        <th>Reason</th>
        <th>View Detail</th>
        <th>Close</th>
      </tr>
    </thead>
    <tbody>
      <?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#D462FF"';}/*elseif($query[$i]["total_pending"]!="" && $query[$i]["account_comment"]=="" && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#FFC184"';}*/elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';}elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <? if($query[$i]["acc_manager"]=='saleslogin') {
$account_manager=$query[$i]["sales_manager"]; 
}
else {
$account_manager=$query[$i]["acc_manager"]; 
}

?>
        <td><?php echo $account_manager;?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["client"];
    $rowuser=select_query($sql);

            ?>
        <td><?php echo $query[$i]["company_name"];?></td>
        <td><?php echo $query[$i]["veh_no_bill"];?></td>
        <td><?php echo $query[$i]["rent_device"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'no_bills','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          | <a href="#" onclick="return ConfirmPaymentClear(<?php echo $query[$i]["id"];?>);"  >Payment Clear</a> | <a href="#" onclick="return ConfirmPaymentPending(<?php echo $query[$i]["id"];?>);"  >Pending</a>
          <? 
if( $query[$i]["forward_back_comment"]=="" && ($query[$i]["forward_req_user"]=="sarvesh" || $query[$i]["forward_req_user"]=="praveen")){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
        <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){
        if( $query[$i]["approve_status"]==1 && ($query[$i]["final_status"]==0)){   
      ?>
          <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Done</a>
          <?php }} ?></td>
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