<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

$ClientDetails = select_query("select Userid,UserName from addclient where sys_active=1 order by UserName");

$SalesPersion = select_query("select id,name from sales_person where active=1 order by name");

$CollectionAgent = select_query("select id,name from collection_agent where is_active=1 order by name");

$monthNo = 10;

if(isset($_POST["submit"]))
{
	//echo "<pre>";print_r($_POST);die;	
	
	$client_name = $_POST["client_name"];
	$company_name = $_POST["company_name"];
	$sales_manager = $_POST["sales_manager"];
	$collection_agent = $_POST["collection_agent"];
	$monthNo = $_POST["monthNo"];
	
	for($n=0;$n<$monthNo;$n++)
	{
		
		if($_POST["device"][$n] != "" || $_POST["rent"][$n] != "" || $_POST["accessory"][$n] !="")
		{
		
			$monthyear = explode(",",$_POST["date"][$n]);
			
			$month_array = array( array("January" => "1"), array("February" => "2"), array("March" => "3"), array("April" => "4"), array("May" => "5"), array("June" => "6"), array("July" => "7"), array("August" => "8"), array("September" => "9"), array("October" => "10"), array("November" => "11"), array("December" => "12"));
			
			foreach($month_array as $keyval)
			{
				if(array_key_exists($monthyear[0], $keyval))
				{
					
					$monthValue[$n]['month'] = $keyval[$monthyear[0]];
					
				}
				
			}
			
			
			if($_POST["device"][$n] !=''){$post_device = $_POST["device"][$n];}
			else{$post_device = 0;}
			
			if($_POST["rent"][$n] !=''){$post_rent = $_POST["rent"][$n];}
			else{$post_rent = 0;}
			
			if($_POST["accessory"][$n] !=''){$post_accessory = $_POST["accessory"][$n];}
			else{$post_accessory = 0;}
			
			$data_exist_query = select_query("select * from debtor_pending_billing where client_id='".$client_name."' and `month`='".$monthValue[$n]['month']."' AND `year`='".$monthyear[1]."'");
			
			//echo "<pre>";print_r($data_exist_query);die;	
			
			if(count($data_exist_query) > 0)
			{
				$pending_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
				'collection_agent' => $collection_agent, 'month' =>  $monthValue[$n]['month'], 'year' =>  $monthyear[1], 
				'yearly_rent' => $data_exist_query[0]['yearly_rent'], 'device_amount_pending' =>  $data_exist_query[0]['device_amount_pending'],
				'rent_amount_pending' =>  $data_exist_query[0]['rent_amount_pending'], 
				'accessory_amount_pending' =>  $data_exist_query[0]['accessory_amount_pending'], 'req_time' =>  $data_exist_query[0]['req_time']);
			
				$pending_insert_query = insert_query('internalsoftware.debtor_pending_history', $pending_history);
				
				if($data_exist_query[0]['yearly_rent'] != '' && $data_exist_query[0]['yearly_rent'] > '0.00' && $data_exist_query[0]['rent_amount_pending'] == '0.00')
				{
					$update_pending = array('device_amount_pending' => $post_device, 'yearly_rent' => $post_rent, 
								  'accessory_amount_pending' => $post_accessory, 'req_time' =>  date("Y-m-d H:i:s"));
				}
				else
				{
								
					$update_pending = array('device_amount_pending' => $post_device, 'rent_amount_pending' => $post_rent, 
								  'accessory_amount_pending' => $post_accessory, 'req_time' =>  date("Y-m-d H:i:s"));
				}
				
				$condition2 = array('id' => $data_exist_query[0]['id']);
			
				update_query('internalsoftware.debtor_pending_billing', $update_pending, $condition2);
				
			}
			else
			{
			
				$debtor_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
					'collection_agent' => $collection_agent, 'month' =>  $monthValue[$n]['month'], 'year' =>  $monthyear[1], 
					'device_amount_pending' =>  $post_device, 'rent_amount_pending' =>  $post_rent, 
					'accessory_amount_pending' =>  $post_accessory, 'yearly_rent' => 0, 'req_time' =>  date("Y-m-d H:i:s"));
					
				$insert_query = insert_query('internalsoftware.debtor_pending_billing', $debtor_history);
			
			}
			
			 
		
		}
		
	}
	
	//$Msg = "Data Successfully Insert.";
	echo "<script>alert('Data Successfully Insert.');</script>";
	
	echo "<script>window.close();</script>";
	/*header("location:list_client_debtor.php");*/
	
}
 
?>

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$Msg. "</p>" ; ?>

<style>
.tb tr th {
    width: 137px !important;
}
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">

// Validation Dropdown Boxes

	function validateForm()
	{
	   if(document.getElementById("client_name").value == "0")
	   {
		  alert("Please select Cleint Name");
		  document.getElementById("client_name").focus();
		  return false;
	   }
	   if(document.getElementById("sales_manager").value == "0")
	   {
		  alert("Please select Sales Manager");
		  document.getElementById("sales_manager").focus();
		  return false;
	   }
	   if(document.getElementById("collection_agent").value == "0")
	   {
		  alert("Please select Collection Agent");
		  document.getElementById("collection_agent").focus();
		  return false;
	   }
	   if(document.getElementById("btAdd").value == "0")
	   {
		  alert("Please select Number of Month");
		  document.getElementById("btAdd").focus();
		  return false;
	   }
	}
	
	
	function getPendingDebtor(user_id)
	{
		//alert(user_id);
		$.ajax({
				type:"GET",
				url:"userInfo.php?action=pending_debtor",
				//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
				data:"user_id="+user_id,
				 beforeSend: function(msg){
					$("#button1").prop('disabled', true);
				  },
				success:function(msg){
					//alert(msg);
				 $("#button1").prop('disabled', false);
				 
				 	
					var tempArr = $.parseJSON(msg) ;
                        var arr = [] ;

                        for (elem in tempArr) {
                                arr.push(tempArr[elem]) ;
                        }
						
                        $('#sales_manager').val(arr[0]['sales_manager']);
						$('#collection_agent').val(arr[0]['collection_agent']);
						
						for(var j =0 ; j < arr.length ; j++ ) {
							
                                if(arr[j]['id'] != '') {
									
                                        var tmpid = arr[j]['month'] + '_' + arr[j]['year'];
										var device_val = arr[j]['device_amount_pending'];
                                        var rent_val = arr[j]['rent_amount_pending'];
										var accessory_val = arr[j]['accessory_amount_pending'];
										var yearly_val = arr[j]['yearly_rent'];
                                        //var poi = arr[i]['poi'] ;
										var renttotal = +rent_val + +yearly_val;
										
                                        var device_id = 'device'+tmpid ;
                                        var rent_id = 'rent'+tmpid ;
										var accessory_id = 'accessory'+tmpid ;

                                        $('#'+device_id).val(device_val);
										$('#'+rent_id).val(renttotal);
                                        $('#'+accessory_id).val(accessory_val);
                                }
                        }//End for
					
				 
				 //document.getElementById(setDivId).value = msg;
								
				}
			});
	}
	
	

// Add Text Boxes
	
	$(document).ready(function(){
		
			$("#AddMultiCol").html("");
			var myArray = new Array();
			
			var number = 10;
			
			var monthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			var today = new Date();
			var currentMonth = today.getMonth();
			var i;
			
			for(var i =0; i < number; i++){
				
				var newMonth = currentMonth - i;
				var newYear = newMonth > 11 ? today.getFullYear() + 1: today.getFullYear();
				newMonth = newMonth > 11? (newMonth - 12): newMonth;
			
				var newDate = new Date(newYear, newMonth, '1');
				
				myArray = "<tr><td><input type='text' class='form-control' name='date[]'  readonly='readonly' id=monthdate"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" value="+ monthNames[newDate.getMonth()] + ',' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='device[]'  id=device"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='rent[]'   id=rent"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='accessory[]'   id=accessory"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> </td></tr>";
			
			   $("#AddMultiCol").append(myArray);
			}

		
		
		$('#btAdd').change(function() {
		
			$("#AddMultiCol").html("");
			var myArray = new Array();
			
			var number = $("#btAdd").val();
			
			var monthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			var today = new Date();
			var currentMonth = today.getMonth();
			var i;
			
			for(var i =0; i < number; i++){
				
				var newMonth = currentMonth - i;
				var newYear = newMonth > 11 ? today.getFullYear() + 1: today.getFullYear();
				newMonth = newMonth > 11? (newMonth - 12): newMonth;
			
				var newDate = new Date(newYear, newMonth, '1');
				
				myArray = "<tr><td><input type='text' class='form-control' name='date[]'  readonly='readonly' id=monthdate"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" value="+ monthNames[newDate.getMonth()] + ',' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='device[]'  id=device"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='rent[]'   id=rent"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='accessory[]'   id=accessory"+ monthNames[newDate.getMonth()] + '_' + newDate.getFullYear() +" /> </td></tr>";
			
			   $("#AddMultiCol").append(myArray);
			}
		
			
		
		});
	});

</script>
    
    
	<div class="top-bar">
        <h1>Pending Debtor </h1>
    </div>
    <div class="table"> 
    
		<form method="post" name="add_record" id="add_recordid" onsubmit="return validateForm()" autocomplete="off">
        
			<table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">
	        	<tr>
	  	  	    	<td>Cleint Name</td>
				    <td colspan="2">
					    <select name="client_name" id="client_name" class="drp50" onchange="getCompanyName(this.value,'TxtCompany');getPendingDebtor(this.value);">
						    <option role="presentation" required value="0">Select</option>
					    	<?php 
					    		for($cl=0;$cl<count($ClientDetails);$cl++) {
					    	?>
					      		<option role="presentation" value="<?php echo $ClientDetails[$cl]['Userid']; ?>"><?php echo $ClientDetails[$cl]['UserName']; ?></option>
					      	<?php } ?>
					    </select>
					</td>
				</tr>
                <tr>
                    <td>Company Name:*</td>
                    <td><input type="text" name="company_name" id="TxtCompany" readonly value="<?=$result['company_name']?>"/></td>
                </tr>
				<tr>
	  	  	    	<td>Sales Manager</td>
				    <td colspan="2">
					    <select name="sales_manager" id="sales_manager" class="drp50">
					    	<option role="presentation" required value="0">Select</option>
					    	<?php 
					    		for($sl=0;$sl<count($SalesPersion);$sl++) {
					    	?>
						      <option role="presentation" required value="<?php echo $SalesPersion[$sl]['id']; ?>"><?php echo $SalesPersion[$sl]['name']; ?></option>
						    <?php }  ?>  
					    </select>
					</td>
				</tr>
				<tr>
	  	  	    	<td>Collection Agent</td>
				    <td colspan="2">
					    <select name="collection_agent" id="collection_agent" class="drp50">
					      <option role="presentation" value="0">Select</option>
                          <?php 
					    		for($ca=0;$ca<count($CollectionAgent);$ca++) {
							?>
							  <option role="presentation" required value="<?php echo $CollectionAgent[$ca]['id']; ?>"><?php echo $CollectionAgent[$ca]['name']; ?></option>
							<?php }  ?> 
					    </select>
					</td>
				</tr>
				<tr>
	  	  	    	<td>No. of Month</td>
				    <td colspan="2">
					    <select	id="btAdd" name="monthNo" class="drp50">
					    	<?php for($i=0;$i<=24;$i++){ 
					    	 
					    		if($i==0){
					    	?>		
					    	<option role="presentation" value="0">Select</option>
					    	<?php 
					    		}
					    		else
					    		{
					    	?>
					    	<option value="<?php echo $i; ?>" role="presentation" <? if($monthNo==$i){ echo "Selected"; }?>><?php echo $i; ?></option>
					    	<?php 
					    		} 
					    	}
					    	?>
					    </select>
					</td>
				</tr>
	       	</table>
            <table class="tb" style="padding-left:103px;">
                <tr>
	  	  	    	<th>Date</th>
				    <th>Device</th>
				    <th>Rent</th>
                    <th>Accessory</th>
				</tr>
            </table>
            <table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">

                <div id="AddMultiCol" style="padding-left:103px;"></div>

			</table>
            <table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">
            <tr>
               <td>
					<button type="submit" name="submit" id="button1" onClick="validate()">Submit</button>
               </td>
               <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_client_debtor.php' " /></td>
            </table>
		</form>						    
	</div>
    
    
	
<?php	
	// $start = $month = strtotime('2009-02-01');
	// $end = strtotime('2011-01-01');
	// while($month < $end)
	// {
	//      echo date('F Y', $month), PHP_EOL;
	//      $month = strtotime("+1 month", $month);
	// }
?>	
<?php include("../include/footer.php"); ?>