<?php // Turn off error reporting
error_reporting(0);
session_start();
include("../connection.php");
 
if(isset($_REQUEST["id"]))
{

  //echo '<pre>';print_r($_REQUEST); die;
    $id=$_REQUEST["id"];
    $noVehicle=$_REQUEST["noVehicle"];
	$client_id=$_REQUEST["client_id"];
    $deviceModel=$_REQUEST["deviceModel"];

    $branch_id=$_REQUEST["branch_id"];
	
	
    if($branch_id == 0){
      $branch_id=1;
    }


    $SelectedOtherModel=array();  
    //echo "select * from internalsoftware.admin_stock_view where device_type_id='".$deviceModel."' and dispatch_branch='".$branch_id."' and update_device_status='1' and total_device='".$noVehicle."'";die;
    $SelectApproveStatus=select_query("select * from admin_stock_view where device_type_id='".$deviceModel."' and dispatch_branch='".$branch_id."' and update_device_status='1'");
	
	$totalDevice = $SelectApproveStatus[0]['total_device'];
	
    //echo "<pre>";print_r($SelectApproveStatus);die;
    if(count($SelectApproveStatus)>0)
    {
      //echo "select * from $internalsoftware.admin_stock_view where dispatch_branch='".$branch_id."' and update_device_status='1' and total_device >= 1";die;
        $SelectStockView=select_query("select * from admin_stock_view where dispatch_branch='".$branch_id."' and update_device_status='1' and total_device >= 1");
       //echo "<pre>";print_r($SelectStockView);
        // if(count($SelectApproveStatus)>0)
        // {
          for($i=0;$i<count($SelectStockView);$i++)
          {
            //echo $SelectApproveStatus[0]['device_type_id'];
            //echo $SelectStockView[$i]['device_type_id'];die;
            if($SelectApproveStatus[0]['device_type_id'] != $SelectStockView[$i]['device_type_id']){
              //array_push($SelectedOtherModel, $SelectStockView[$i]['device_type_id']);

              $arr=array(
                          'total_device'    => $noVehicle,
                          'device_type_id'  => $SelectStockView[$i]["device_type_id"],
                          'device_type'     => $SelectStockView[$i]["device_type"],
                          'device_model'    => $SelectStockView[$i]["device_model"],
                          'dispatch_branch' => $SelectStockView[$i]["dispatch_branch"],
              );
              array_push($SelectedOtherModel,$arr);
            }  
          }
        //}  
         // echo "<pre>";print_r($SelectedOtherModel);
    }
    else
    {
      echo "There is no Record";
    }
}
 
/* if(isset($_POST['submit']))
{
	echo '<pre>';print_r($_POST); die;
	$support_user=$_POST['support_user'];
	$requested_user=$_POST['requested_user'];
	
	if($req_id=='1')
	{
	
		$Updateapprovestatus="update $internalsoftware.new_account_creation set approve_status=1, approve_date='".date("Y-m-d H:i:s")."', 
		support_id='".$support_user."', telecaller_name='".$requested_user."' where id=$id";
		mysql_query($Updateapprovestatus);
		echo "Successfully Approved";
		
		$query = "SELECT * FROM $internalsoftware.installation_request  where id=".$row_id;
		$row=select_query($query);
		/* if($row[0]["branch_id"]==1){*/
		//$Updateapprovestatus="update internalsoftware.installation_request set installation_status=9, approve_status=1, installation_approve='".$comment."', approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
		/*}
		else{
		$Updateapprovestatus="update installation set installation_status=1, approve_status=1, installation_approve='".$comment."', approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
		}*/
		//select_query($Updateapprovestatus);
		//echo "Successfully Approved";
	
	//}

//}*/

 
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  </head>

    <style type="text/css">
    thead{
      white-space: nowrap;
    }
    tr td{
      white-space: nowrap;
      font-size: 14px;
      text-align: center;
    }

    table td {
      border-top: none !important;
      text-align: left;
    }
    </style> 
  </head>
<body>


<? //if(!isset($_REQUEST["view"]) && $_REQUEST["view"]!=true)

if(count($SelectApproveStatus)>0)
{?>


  <div class="container">
    <div class="row">
      <h2 align="center">Approval Request</h2>
        
        <div id="modelSelected">
          <table class="table">
            <thead>
              <tr>
                <th>Type</th>
                <th>Model</th>
                <th>FFC</th>
                <th>NEW</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$SelectApproveStatus[0]['device_type']?></td>
                <td><?=$SelectApproveStatus[0]['device_model']?></td>
                <td><?=$SelectApproveStatus[0]['ffc_device']?></td>
                <td><?=$SelectApproveStatus[0]['new_device']?></td>
                <td><?=$SelectApproveStatus[0]['total_device']?></td>
              </tr>
            </tbody>        
          </table>
        </div>
        <div id="otherModelSelected"></div>
        <table class="table">          
            <tr>
              <td>Number of Installation: </td>
              <td><?=$noVehicle?></td>
            </tr>
             <tr>
              <td>Number of Approve: </td>
              <td>
                <input type="text" name="device_approve" id="device_approve" class="form-control" autocomplete="off">
              </td>
            </tr>
            <tr>
              <td>Approve Model: </td>
              <td>
                <select class="form-control" id="approve_model" onChange="showApproveModel(this)">
                  <option value="">Select</option>
                  <option value="0">New</option>
                  <option value="1">FFC</option>
                  <option value="2">Both</option>
                </select>
              </td>
            </tr>
        </table>
        <table class="table">    
            <tr style="display: none;" id="hidden_div1">
              <td>NEW Device</td>
              <td>
                <input type="text" name="new_device_approve" id="new_device_approve" class="form-control" style="margin-left:180px;width:200px">
              </td>
            </tr>
            <tr style="display: none;" id="hidden_div2">
              <td>FFC Device</td>
              <td>
                <input type="text" name="ffc_device_approve" id="ffc_device_approve" class="form-control" style="margin-left:185px;width:200px">
              </td>
            </tr>
          </table>
          <table class="table"> 
            <tr>
              <td class="shrinky-dinky">Other Model:</td>
              <td>
                <input type="checkbox" name="other_model" id="other_model"  value ="0" onClick="selectItem(this.checked)" /> &nbsp;
                <span style="display:none" id="approve_other_model" >
                  <select class="selectpicker" data-show-subtext="true" data-live-search="true" onChange="showOtherModel(this)" width="200px">
                    <option value="" disabled="disabled" selected>Select</option>
                    <?php 
                      for($i=0;$i<count($SelectedOtherModel);$i++){                     
                    ?>
                    <option value="<?=$SelectedOtherModel[$i]['device_type_id']."##".$SelectStockView[$i]["dispatch_branch"]."##".$id."##".$noVehicle."##".$SelectApproveStatus[0]['device_type_id']."##".$client_id; ?>"><?=$SelectedOtherModel[$i]['device_model']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </span>  
              </td>
            </tr>
            <tr>
              <td colspan="2" align="" id="btn-submit">
                <button id="availableModelSubmit" class="btn btn-default" onClick="return ConfirmDelete(<?= $id.','.$branch_id.','.$SelectApproveStatus[0]["device_parent_id"].','.$SelectApproveStatus[0]["device_type_id"].','.$noVehicle.','.$totalDevice.','.$SelectApproveStatus[0]["device_type_id"].','.$client_id?>)">Submit</button>
                <!--<input type="button" class="btn btn-default" value="Cancel" onClick="window.location.reload()">-->
              </td>
            </tr>
        </table>
    </div>
  </div>
  
<?  
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>


<script type="text/javascript">

//var jq = $.noConflict();

var Path="<?php echo __SITE_URL;?>/";

function showOtherModel(req){
  //alert(req);
  var isChecked = $("#other_model").val();
  var str = req.value;
  var res = str.split("##");
  var modelId = res[0];
  var branchId = res[1];
  var reqId = res[2];
  var noVehicle = res[3];
  var previousModel = res[4];
  var clientID = res[5];
    
  if(isChecked == 0){
	  
    $("#availableModelSubmit").show();
   
    $.ajax({
      type:"GET",
      url: "userInfo.php?action=InstallationApproveOtherModel",
      data:"modelId="+modelId+"&branchId="+branchId+"&previousModel="+previousModel+"&clientId="+clientID,
      success:function(msg){
        //alert(msg);
        msg = JSON.parse(msg);
        
        var htmlBody ='<table class="table"><thead><tr><th>Type</th><th>Model</th><th>FFC</th><th>NEW</th><th>Total</th></tr></thead><tbody><tr><td>'+msg.device_type+'</td><td>'+msg.device_model+'</td><td>'+msg.ffc_device+'</td><td>'+msg.new_device+'</td><td>'+msg.total_device+'</td></tr></tbody></table>';

        $("#otherModelSelected").html(htmlBody);
		
        var btnBody = '<button id="availableModelSubmit" class="btn btn-default" onclick="return ConfirmDelete('+reqId+','+branchId+','+msg.device_parent_id+','+msg.device_type_id+','+noVehicle+','+msg.total_device+','+msg.previousModelId+','+msg.clientId+')">Submit</button>';
        
        $("#btn-submit").html(btnBody);
       
      }
    });

  }
  else{
    $("#availableModelSubmit").hide();
   
  }
  
}

function showApproveModel(elem){
  
   if(elem.value == 2){
      document.getElementById('hidden_div1').style.display = "block";
      document.getElementById('hidden_div2').style.display = "block";
   }
   else{
      document.getElementById('hidden_div1').style.display = "none";
      document.getElementById('hidden_div2').style.display = "none";
   }    
}

function selectItem(isChecked){
  
    if(isChecked){
        document.getElementById("otherModelSelected").style.display = "block"; 
        document.getElementById('approve_other_model').style.display = "block";
        //document.getElementById('otherModelSubmit').style.display = "block";

        
    }else{
        document.getElementById("otherModelSelected").style.display = "none";
        document.getElementById('approve_other_model').style.display = "none";
        document.getElementById('availableModelSubmit').style.display = "none";
        location.reload();
        
    }
}



function ConfirmDelete(row_id,branchId,deviceType,deviceModel,noOfVehicle,totalDevice,previousModel,clientId){
  
  //alert(row_id+'-'+branchId+'-'+deviceType+'-'+deviceModel+'-'+noOfVehicle+'-'+totalDevice+'-'+previousModel)  
  //console.log(row_id+'-'+branchId+'-'+deviceType+'-'+deviceModel+'-'+noOfVehicle+'-'+totalDevice+'-'+previousModel);
 
  var approveDevice = $("#device_approve").val();
  var approveModel = $("#approve_model").val();
  var newDeviceApprove = $("#new_device_approve").val();
  var ffcDeviceApprove = $("#ffc_device_approve").val();
  var regex=/^[0-9]+$/;

  //alert(newDeviceApprove)
  //alert(totalDevice)

  if(approveDevice=='')
  {
    alert("Please Enter No of Approval Device");
    return false;
  }
  else if(approveModel=='')
  {
    alert("Please Select Approve Model");
    return false;
  }
  else if(!approveDevice.match(regex))
  {
    alert("Please Enter Digits Only");
    return false;
  }
  else if(approveDevice>noOfVehicle)
  {
	alert("Approve Device Not Greater Then Request Device.Kindly Check");
    return false;
  }
  else if(approveDevice>totalDevice)
  {
    alert("Selected Model is not Available in Stock");
    return false;
  }
  else{
    $.ajax({
      type:"GET",
      url:"userInfo.php?action=Installationapprove",
      data:"row_id="+row_id+"&comment="+approveDevice+"&branch_id="+branchId+"&deviceType="+deviceType+"&deviceModel="+deviceModel+"&noOfVehicle="+noOfVehicle+"&approveModel="+approveModel+"&newDeviceApprove="+newDeviceApprove+"&ffcDeviceApprove="+ffcDeviceApprove+"&previousModel="+previousModel+"&clientId="+clientId,
      success:function(msg){
        //alert(msg);
        if(msg.length == 0){
          parent.document.location.href = Path +"admin/list_installation.php";
        }
        else{
          alert(msg);
        }
      }
    });
  }
}
</script>
</body>

</html>
