<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

?>
<script>
 
function ConfirmUserActivate(row_id)
{
   var retVal = prompt("Write Activate Comment : ", "Comment");
  if (retVal)
  {
  ActivateUser(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function ActivateUser(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=ActivateUserAccount",
        data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
         
        location.reload(true);       
        }
    });
}

function ConfirmDeactivateUser(row_id)
{
   var retVal = prompt("Write Deactivate Comment : ", "Comment");
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
        url:"userInfo.php?action=deactivateUserAccount",
          
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>All</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Activate</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>Deactivate </option>
      </select>
    </form>
  </div>
  <h1>Users Account List</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Deactivate Users</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Activate Users.</div>
</div>
<div class="table">
  <?php

if($_POST["Showrequest"]==1)
 {
      $WhereQuery=" where sys_active=1";
 }
 else if($_POST["Showrequest"]==2)
 {
     $WhereQuery="where sys_active=0 ";
 }
 else
 {
     $WhereQuery=" ";
 }
 

$query_rslt = select_query_live_con("SELECT *, case when sys_active=true then true else false end as active FROM matrix.users ".$WhereQuery." order by sys_username");  

 
/*$query = mysql_query("SELECT *, case when sys_active=true then true else false end as active FROM matrix.users order by sys_username");   */

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>Users</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>Phone No</th>
        <th>Billing Amount</th>
        <th>update Bill</th>
        <th>Activate</th>
        <th>Deactivate</th>
      </tr>
    </thead>
    <tbody>
      <?php

//while($row=mysql_fetch_array($query))
for($j=0;$j<count($query_rslt);$j++)
{
   
?>
      <tr align="center" <? if( $query_rslt[$j]["active"]==false   ){ echo 'style="background-color:#D462FF"';} elseif($query_rslt[$j]["active"]==true ){ echo 'style="background-color:#8BFF61"';}?> >
        <td><?php echo $j+1;?></td>
        <td><?php echo $query_rslt[$j]["sys_username"];?></td>
        <td><?php echo $query_rslt[$j]["company"];?></td>
        <td><?php echo $query_rslt[$j]["address"];?></td>
        <td><?php echo $query_rslt[$j]["mobile_number"];?></td>
        <td><?php echo $query_rslt[$j]["price_per_unit"];?></td>
        <td><a href="update_billamount.php?id=<?php echo $query_rslt[$j]["id"];?>&user=<?php echo $query_rslt[$j]["sys_username"];?>" target="_blank">UpdateBill</a></td>
        <td><?php if( $query_rslt[$j]["active"]==false  ){ ?>
          <a href="#" onclick="return ConfirmUserActivate(<?php echo $query_rslt[$j]["id"];?>);"  >Activate</a>
          <?php }else{?>
          Activate
          <?php } ?></td>
        <td><?php if( $query_rslt[$j]["active"]==true  ){ ?>
          <a href="#" onclick="return ConfirmDeactivateUser(<?php echo $query_rslt[$j]["id"];?>);"  >Deactivate</a>
          <?php }else{?>
          Deactivate
          <?php } ?></td>
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