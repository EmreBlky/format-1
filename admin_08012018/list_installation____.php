<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/

if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

?>
<script>

// function stockView(row_id,tableName,popdiv)
// {
//     //alert(popdiv);
//     //var stockView=popdiv;
//     $.ajax({
//     type:"GET",
//     url:"userInfo.php?action=stockView",
//     data:"row_id="+row_id+"&popdiv="+popdiv,
//     success:function(msg){
//       alert(msg);
//       location.reload(true);    
//     }
//   });
  
// }

// function stockView(RowId,tablename,DivId)
// {
//   //alert(DivId);
//   //return false;
//     $.ajax({
//     type:"GET",
//     url:"userInfo_stock.php?action=getrowSales",
//     //data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
//      data:"RowId="+RowId+"&tablename="+tablename,
//     success:function(msg){
//        alert(msg);
//      // $('#popup1').html(msg);
//     document.getElementById(DivId).innerHTML = msg;
            
//       }
//     });
// }


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

// function addComment1(row_id,retVal1)
// {
//    var retVal = confirm("Do you want Eligibility");
//   if( retVal == true )
//   {
//      $.ajax({
//       type:"GET",
//       url:"stockView.php?action=Installationapprove",
//       data:"row_id="+row_id+"&comment="+retVal1,
//       success:function(msg){
//        //alert(msg);
//       document.getElementById('popup1').innerHTML = msg;
//       //location.reload(true);    
//       }
//     });
//   }
	
  
// }
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

// function Show_record1(RowId,tablename,DivId)
// {
//   //alert(tablename);
//   //return false;
//   $( "#loadingmessage" ).show();
// $.ajax({
//     type:"GET",
//     url:"userInfo.php?action=getrowSales",
//     //data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
//      data:"RowId="+RowId+"&tablename="+tablename,
//     success:function(msg){
//       //alert(msg);
//       $( "#loadingmessage" ).hide();
//     document.getElementById(DivId).innerHTML = msg;
            
//     }
//   });
// }


// function Show_record_eligiblity(row_id,retVal1)
// {
//   //alert(retVal1);
  
//   $.ajax({
//       type:"GET",
//       url:"userInfo.php?action=eligibility",
//       data:"row_id="+row_id+"&comment="+retVal1,
//       success:function(msg){
//         alert(msg);
//         //location.reload(true);
//         //document.getElementById("popup3").innerHTML = msg;
//       }
//     });
// }

function Show_record1(RowId,tablename,DivId)
{
  //alert(tablename);
  //return false;
  $( "#loadingmessage" ).show();
$.ajax({
    type:"GET",
    url:"userInfo.php?action=getrowSales",
    //data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
     data:"RowId="+RowId+"&tablename="+tablename,
    success:function(msg){
      //alert(msg);
      $( "#loadingmessage" ).hide();
    document.getElementById(DivId).innerHTML = msg;
            
    }
  });
}
function Show_record_stock(RowId,tablename,DivId,DeviceModel,DeviceType)
{
  //alert(DeviceModel);
  //return false;
  $("#loadingmessage" ).show();
$.ajax({
    type:"GET",
    url:"userInfo.php?action=getrowSales",
    //data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
     data:"RowId="+RowId+"&tablename="+tablename+"&devicemodel="+DeviceModel+"&devicetype="+DeviceType,
    success:function(msg){
      //alert(msg);
      $( "#loadingmessage" ).hide();
    document.getElementById(DivId).innerHTML = msg;
            
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
<style>
thead{
  display:table;
  width:100%;
  width:calc(100% - 20px);
}
tbody {
  height:400px;
  overflow:auto;
  overflow-x:hidden;
  display:block;
}
tbody tr {
  display:table;
  width:100%;
  table-layout:fixed;
}
</style>
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
	  $WhereQuery=" where installation_status=5 and approve_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 /*$WhereQuery=" where (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" ";
 }
 else if($_POST["Showrequest"]==3)
 {
	 /*$WhereQuery=" where approve_status=1 and installation_status IN(1,9) and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where approve_status=1 and installation_status IN(1,9)";
 }
 else if($_POST["Showrequest"]==4)
 {
	 /*$WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null and (branch_id=1 or inter_branch=1)";*/
	 $WhereQuery=" where admin_comment!='' and approve_status=0 and sales_comment is null";
 }
 else
 { 
	  
	 /*$WhereQuery=" where installation_status=8 and approve_status=0 and (branch_id=1 or inter_branch=1) and (admin_comment is null or sales_comment!='') ";*/
	 $WhereQuery=" where installation_status=8 and approve_status=0 and (admin_comment is null or sales_comment!='') ";
  
 }
  
$query = select_query("SELECT *,DATE_FORMAT(req_date,'%d %b %Y %h:%i %p') as req_date,DATE_FORMAT(time,'%d %b %Y %h:%i %p') as time FROM installation_request ". $WhereQuery."  order by id DESC ");
//echo "<pre>";print_r($query);die;
?>

  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Request Date</th>
        <th>Sales Person</th>
        <th>Client</th>
        <th>No. Of Vehicle</th>
     <!--    <th>Device Price</th>
        <th>Rent Price</th> -->
      <!--   <th>mode of payment</th> -->
        <th>Model</th>
        <th>Time</th>
        <th>View Detail</th>
            <th>Stock View</th>
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
   <!--      <td><?php echo $query[$i]['device_price_total'];?></td> 
        <td><?php echo $query[$i]["DTotalREnt"];?></td>  --> 
<!--         <td><?php echo $query[$i]["mode_of_payment"];?></td>     --> 
        <td align="center" nowrap>

          <?php 
       
             $sqlDevice=select_query("SELECT device_type FROM device_type where id='".$query[$i]["device_type"]."' "); 
             $sqlModel=select_query("SELECT device_model FROM device_model where id='".$query[$i]["model"]."' "); 
         
            echo $sqlModel[0]['device_model']."</br>";
            echo $sqlDevice[0]['device_type'];
        
          ?>

          
        </td></td>
        <td><?php echo $query[$i]["time"];?></td>
        <td><a href="#" onclick="Show_record1(<?php echo $query[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          |
          <? if($query[$i]["approve_status"]==1){?>
          Approved
          <?}else{?>
          <a href="#" class="topopup"  onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);">Approve</a>
          <?}?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);" >Back Comment</a>

          <?php }?>
        
            <td>
        <a href="#" class="topopup" onclick="Show_record_stock(<?php echo $query[$i]["id"];?>,'device','popup1','<?php echo $sqlModel[0]['device_model'];?>','<?php echo $query[$i]['inter_branch'];?>')"  >Stock View</a>
          
      </td>

      </tr>
      <?php }?>
  </table>
<!--   <div class="processing-img" id="loadingmessage">
  <img src="<?php echo __SITE_URL;?>/file/loader.gif" >
  </div> -->
  <div id="toPopup">

    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>

    <div id="popup1" align="center"> <!--your content start--> 
    
  </div>
    
  </div>


    
    <!--your content end--> 
    

  <!--toPopup end-->
  
  <div class="loader">
    
  </div>
  <div id="backgroundPopup"></div>
<script type="text/javascript">

function Show_record_stock(RowId,tablename,DivId,deviceModel,BranchId)
{
  //alert(deviceModel);
  //return false;
  $("#loadingmessage" ).show();
$.ajax({
    type:"GET",
    url:"userInfo.php?action=getrowSales&devModel="+deviceModel+"&branch="+BranchId,
    data:"RowId="+RowId+"&tablename="+tablename,
    dataType: "html",
    success:function(msg){
      //alert(msg);
      $( "#loadingmessage" ).hide();
    //  $(DivId).html(msg);
    document.getElementById(DivId).innerHTML = msg;
            
    }
  });
}

function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  //alert(input.value)

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    //td+ = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
</div>
<?php
include("../include/footer.php"); ?>
