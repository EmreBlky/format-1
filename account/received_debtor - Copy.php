<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

$ClientDetails = select_query("select Userid,UserName from addclient where sys_active=1 order by UserName");

$SalesPersion = select_query("select id,name from sales_person where active=1 order by name");

$CollectionAgent = select_query("select id,name from collection_agent where is_active=1 order by name");

$monthNo = 4;

if(isset($_GET["AddRecd"]) && $_GET["AddRecd"]="true" )
{
	$client_name = $_GET['client'];
	$company_name = $_GET['company'];
	$sales_manager = $_GET['manager'];
	$collection_agent = $_GET['agent'];
	
	
	
}


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
		$monthyear = explode(",",$_POST["date"][$n]);
		
		$month_array = array( array("January" => "01"), array("February" => "02"), array("March" => "03"), array("April" => "04"), array("May" => "05"), array("June" => "06"), array("July" => "07"), array("August" => "08"), array("September" => "09"), array("October" => "10"), array("November" => "11"), array("December" => "12"));
		
		foreach($month_array as $keyval)
		{
			if(array_key_exists($monthyear[0], $keyval))
			{
				
				$monthValue[$n]['month'] = $keyval[$monthyear[0]];
				
			}
			
		}
		
		
		$debtor_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
			'collection_agent' => $collection_agent, 'month' =>  $monthValue[$n]['month'], 'year' =>  $monthyear[1], 
			'device_amount_recd' =>  $_POST["device"][$n], 'rent_amount_recd' =>  $_POST["rent"][$n], 
			'accessory_amount_recd' =>  $_POST["accessory"][$n], 'discounting' =>  '0', 
			'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
			
		$insert_query = insert_query('internalsoftware.debtor_received_billing', $debtor_history);
		
		$Msg = "Data Successfully Insert.";
	
	}
	
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
	   
	}

// Add Text Boxes
	
	$(document).ready(function(){
		
			$("#AddMultiCol").html("");
			var myArray = new Array();
			
			var number = 2;
			
			var monthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			var today = new Date();
			var currentMonth = today.getMonth();
			var i;
			
			for(var i =0; i < number; i++){
				
				var newMonth = currentMonth - i;
				var newYear = newMonth > 11 ? today.getFullYear() + 1: today.getFullYear();
				newMonth = newMonth > 11? (newMonth - 12): newMonth;
			
				var newDate = new Date(newYear, newMonth, '1');
				
				myArray = "<tr><td><input type='text' class='form-control' name='date[]' readonly='readonly' id='monthdate+i' + i + value="+ monthNames[newDate.getMonth()] + ',' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='device[]' id='device+i'+ i + /> <input type='text' class='form-control' name='rent[]'  id='rent+i' + i + /> <input type='text' class='form-control' name='accessory[]'  id='accessory+i' + i + /> </td></tr>";
			
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
				
				myArray = "<tr><td><input type='text' class='form-control' name='date[]' readonly='readonly' id='monthdate+i' + i + value="+ monthNames[newDate.getMonth()] + ',' + newDate.getFullYear() +" /> <input type='text' class='form-control' name='device[]' id='device+i'+ i + /> <input type='text' class='form-control' name='rent[]'  id='rent+i' + i + /> <input type='text' class='form-control' name='accessory[]'  id='accessory+i' + i + /> </td></tr>";
			
			   $("#AddMultiCol").append(myArray);
			}
		
			
		
		});
	});

</script>
    
    
	<div class="top-bar">
        <h1>Received Amount </h1>
    </div>
    <div class="table"> 
    
		<form method="post" name="add_record" id="add_recordid" onsubmit="return validateForm()">
        
			<table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">
	        	<tr>
	  	  	    	<td>Cleint Name</td>
				    <td colspan="2">
					    <select name="client_name" id="client_name" class="drp50" onchange="getCompanyName(this.value,'TxtCompany');">
						    <option role="presentation" required value="0">Select</option>
					    	<?php 
					    		for($cl=0;$cl<count($ClientDetails);$cl++) {
					    	?>
					      		<option role="presentation" value="<?php echo $ClientDetails[$cl]['Userid']; ?>" <? if($client_name==$ClientDetails[$cl]['Userid']){ echo "Selected"; }?>><?php echo $ClientDetails[$cl]['UserName']; ?></option>
					      	<?php } ?>
					    </select>
					</td>
				</tr>
                <tr>
                    <td>Company Name:*</td>
                    <td><input type="text" name="company_name" id="TxtCompany" readonly value="<?=$company_name;?>"/></td>
                </tr>
				<tr>
	  	  	    	<td>Sales Manager</td>
				    <td colspan="2">
					    <select name="sales_manager" id="sales_manager" class="drp50">
					    	<option role="presentation" required value="0">Select</option>
					    	<?php 
					    		for($sl=0;$sl<count($SalesPersion);$sl++) {
					    	?>
						      <option role="presentation" required value="<?php echo $SalesPersion[$sl]['id']; ?>" <? if($sales_manager==$SalesPersion[$sl]['id']){ echo "Selected"; }?>><?php echo $SalesPersion[$sl]['name']; ?></option>
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
							  <option role="presentation" required value="<?php echo $CollectionAgent[$ca]['id']; ?>" <? if($collection_agent==$CollectionAgent[$ca]['id']){ echo "Selected"; }?>><?php echo $CollectionAgent[$ca]['name']; ?></option>
							<?php }  ?> 
					    </select>
					</td>
				</tr>
				<!--<tr>
	  	  	    	<td>No. of Month</td>
				    <td colspan="2">
					    <select	id="btAdd" name="monthNo" class="drp50">
					    	<?php for($i=0;$i<=24;$i++){ 
					    		//$month=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
					    	?>
					    	<?php 
					    		if($i==0){
					    	?>		
					    	<option role="presentation" value="0">Select</option>
					    	<?php 
					    		}
					    		else
					    		{
					    	?>
					    	<option value="<?php echo $i;?>" role="presentation" <? if($monthNo==$i){ echo "Selected"; }?>><?php echo $i; ?></option>
					    	<?php 
					    		} 
					    	}
					    	?>
					    </select>
					</td>
				</tr>-->
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