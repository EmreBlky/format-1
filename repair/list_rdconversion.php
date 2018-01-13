<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
 

?>
<script>
function replyComment(row_id)
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
		url:"userInfo.php?action=rdconversion_addComment",
 		 
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="3" <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>R & D Conversation</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#FFFF9D;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where close_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" ";
 }
  else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where status=2 and close_status!=1";
 }
 else
 { 
	  
   $WhereQuery=" where status=1 and close_status=0";
  
 }
 
 

$query = select_query("SELECT * FROM ad_rd_conversion  ". $WhereQuery."  order by id desc ");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Topic Name</th>
        <th>Admin Comment</th>
        <th>R&D Comment</th>
        <th>closed Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if($query[$i]["close_status"]==1){ echo 'style="background-color:#99FF66"';} elseif( $query[$i]["admin_comment"]!="" && $query[$i]["status"]==1 ){ echo 'style="background-color:#FFFF9D"';} ?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["req_date"];?></td>
        <td><?php echo $query[$i]["topic_name"];?></td>
        <td><?php echo $query[$i]["admin_comment"];?></td>
        <td><?php echo $query[$i]["rd_comment"];?></td>
        <td><?php echo $query[$i]["close_date"];?></td>
        <td><!--<a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'rd_conversion','popup1'); " class="topopup">View Detail</a>-->
          
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){
            if( $query[$i]["admin_comment"]!="" && $query[$i]["status"]=="1"){ ?>
          <a href="#" onclick="return replyComment(<?php echo $query[$i]["id"];?>);"  >Reply Comment</a>
          <? } }?></td>
      </tr>
      <?php } ?>
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
