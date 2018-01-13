<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/

$row_id=$_GET["row_id"];
$comment=addslashes($_GET["comment"]); 

if(isset($_GET['action']) && $_GET['action']=='DeactivateSim_changeclose')
{
  
    $Updateapprovestatus="update Sim  set active_status=0,DeadRemarks='".date("Y-m-d H:i:s")." - " .$comment."' where sim_id=".$row_id;
       
     mssql_query($Updateapprovestatus);
     //echo "Comment Added Successfully";
   
 }
?>
<script>
function ConfirmApprove(row_id)
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
        url:"inventory_list_deactivate_sim.php?action=DeactivateSim_changeclose",
          
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
  <select name="Showrequest" id="Showrequest" onChange="form.submit();" >
  <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        </select>
        </form>
        </div>
                    <h1>Deactivate Sim</h1>
                   
                    <div style="float:center">
                      <div align="center"><br/>
                         <a href="list_deactivate_sim.php">Deactivate Sim Format
                         <? $total_pending = select_query("SELECT COUNT(*) as total FROM deactivate_sim where ((approve_status=0 or approve_status=1) and final_status!=1 and close_date is null and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");
       					 ?>
                         (
                         <?=$total_pending[0]['total']?>
                         )</a> | <a href="inventory_list_deactivate_sim.php">Deactivate Sim Inventory
                         <? $sql_pending=mssql_query("SELECT COUNT(*) FROM Sim WHERE flag=3 and sim_status=92 and active_status = '1' and status=0");
       
        				$row_pending=mssql_fetch_array($sql_pending);?>
                         (
                         <?=$row_pending[0]?>
                         )</a>
 


                        <br/>
                      </div>
                  </div>  
                </div>
                  <div class="top-bar">
                <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>             
                </div>
                <br/>
                <div style="float:right";><a href="reportfiles/deactivate_sim_excel.xls">Create Excel</a><br/></div>
                <div class="table">
<?php 
 
$query = mssql_query("select * from sim WHERE flag=3 and sim_status=92 and active_status = '1' and status=0");  

?>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
    <tr>
        <th>SL.No</th>
        <th>Remove Date</th>
        <th>SIM No</th>
        <th>Mobile No</th>
        <th>Oprator</th>
        <th>Recived Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
 
<?php
$excel_data.='<table cellpadding="5" cellspacing="5" border="1"><thead><tr><td colspan="7" align="center"><strong>Deactivate Sim Report</strong></td></tr><tr><td colspan="7"></td></tr><tr><th width="5%">SL.No</th><th width="10%">Remove Date </th><th width="10%">SIM No </th><th width="10%">Mobile No</th><th width="10%">Oprator</th><th width="10%">Recived Date </th></tr></thead><tbody>';

$i=1;
while($rec_data=mssql_fetch_array($query))
{
?>
<tr align="center">
 
    <td><?php echo $i; ?></td>
    <td><?php echo $rec_data["SimRemoveDate"];?></td>
    <td><?php echo $rec_data["sim_no"];?></td>
    <td><?php echo $rec_data["phone_no"];?></td>
    <td><?php echo $rec_data["operator"];?></td>
    <td><?php echo $rec_data["rec_date"];?></td>
    <td>
    <a href="#" onclick="return ConfirmApprove(<?php echo $rec_data["sim_id"];?>);"  >Comment</a>
     </td>
</tr>
<?php $i++;

    $excel_data.="<tr><td width='5%'>".$i."</td><td width='10%'>".$rec_data["SimRemoveDate"]."</td><td width='10%'>".$rec_data["sim_no"]."</td><td width='10%'>".$rec_data["phone_no"]."</td><td width='10%'>".$rec_data["operator"]."</td><td width='10%'>".$rec_data["rec_date"]."</td></tr>";

    }
     $excel_data.='</tbody></table>';
?>
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

unlink(__DOCUMENT_ROOT.'/account/reportfiles/deactivate_sim_excel.xls');
$filepointer=fopen(__DOCUMENT_ROOT.'/account/reportfiles/deactivate_sim_excel.xls','w');
fwrite($filepointer,$excel_data);
fclose($filepointer);

include("../include/footer.php"); ?>