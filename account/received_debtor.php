<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

$ClientDetails = select_query("select Userid,UserName from internalsoftware.addclient where sys_active=1 order by UserName");

$SalesPersion = select_query("select id,name from internalsoftware.sales_person where active=1 order by name");

$CollectionAgent = select_query("select id,name from internalsoftware.collection_agent where is_active=1 order by name");


if(isset($_REQUEST["AddRecd"]) && $_REQUEST["AddRecd"]="true" )
{
	$client_name = $_REQUEST['client'];
	$company_name = $_REQUEST['company'];
	$sales_manager = $_REQUEST['manager'];
	$collection_agent = $_REQUEST['agent'];
	
	$device_recd = $_REQUEST['device_recd'];
	$rent_recd = $_REQUEST['rent_recd'];
	$month_year = $_REQUEST['month_year'];
	
	$pending_amount_data = select_query("select * from internalsoftware.debtor_pending_billing where client_id='".$client_name."' 
							and (device_amount_pending > 0 or rent_amount_pending > 0 or accessory_amount_pending > 0 or yearly_rent > 0) 
							order by year desc,month desc");
	
	//echo "<pre>";print_r($pending_amount_data);die;
	
}


if(isset($_POST["submit"]))
{
	//echo "<pre>";print_r($_POST);die;	
	
	$client_name = $_POST["client_name"];
	$company_name = $_POST["company_name"];
	$sales_manager = $_POST["sales_manager"];
	$collection_agent = $_POST["collection_agent"];
	$monthNo = count($_POST["date"]);
	
	//echo "<pre>";print_r($monthNo);die;	
	
	for($n=0;$n<$monthNo;$n++)
	{		
		
		if($_POST["device"][$n] != "" || $_POST["rent"][$n] != "" || $_POST["accessory"][$n] !="")
		{
			
			
			$monthyear = explode(",",$_POST["date"][$n]);
			
			$month_array = array( array("January" => "1"), array("February" => "2"), array("March" => "3"), array("April" => "4"), 
			array("May" => "5"), array("June" => "6"), array("July" => "7"), array("August" => "8"), array("September" => "9"), 
			array("October" => "10"), array("November" => "11"), array("December" => "12"));
			
			foreach($month_array as $keyval)
			{
				if(array_key_exists($monthyear[0], $keyval))
				{
					
					$monthValue[$n]['month'] = $keyval[$monthyear[0]];
					
				}
				
			}			
			
		
		
			$pndg_query = select_query("SELECT * FROM internalsoftware.debtor_pending_billing WHERE client_id='".$client_name."' AND 
						`month`='".$monthValue[$n]['month']."' AND `year`='".$monthyear[1]."'");
		
			
			$pending_history = array('client_id' => $pndg_query[0]['client_id'], 'company_name' => $pndg_query[0]['company_name'], 
			'sales_manager' => $pndg_query[0]['sales_manager'], 'collection_agent' => $pndg_query[0]['collection_agent'], 
			'month' =>  $pndg_query[0]['month'], 'year' =>  $pndg_query[0]['year'], 'yearly_rent' => $pndg_query[0]['yearly_rent'], 
			'device_amount_pending' =>  $pndg_query[0]['device_amount_pending'], 'rent_amount_pending' =>  $pndg_query[0]['rent_amount_pending'], 
			'accessory_amount_pending' =>  $pndg_query[0]['accessory_amount_pending'], 'req_time' =>  $pndg_query[0]['req_time']);
			
			$pending_insert_query = insert_query('internalsoftware.debtor_pending_history', $pending_history);
		
		
		
			if($pndg_query[0]['device_amount_pending'] > 0 && $_POST["device"][$n] != "")
			{
				$device_amount_pending = $pndg_query[0]['device_amount_pending'] - $_POST["device"][$n];				
			} 
			else if($pndg_query[0]['device_amount_pending'] < 0 && $_POST["device"][$n] != "") 
			{
				$device_amount_pending = $pndg_query[0]['device_amount_pending'] + $_POST["device"][$n];
			} 
			else { $device_amount_pending = $pndg_query[0]['device_amount_pending']; }
			
			
			if($pndg_query[0]['rent_amount_pending'] > 0 && $_POST["rent"][$n] != "")
			{
				$rent_amount_pending = $pndg_query[0]['rent_amount_pending'] - $_POST["rent"][$n];				
			} 
			else if($pndg_query[0]['rent_amount_pending'] < 0 && $_POST["rent"][$n] != "") 
			{
				$rent_amount_pending = $pndg_query[0]['rent_amount_pending'] + $_POST["rent"][$n];
			} 
			else { $rent_amount_pending = $pndg_query[0]['rent_amount_pending']; }
			
			
			if($pndg_query[0]['yearly_rent'] > 0 && $pndg_query[0]['rent_amount_pending'] == 0 && $_POST["rent"][$n] != "")
			{
				$yr_amount_pending = $pndg_query[0]['yearly_rent'] - $_POST["rent"][$n];				
			} 
			else { $yr_amount_pending = $pndg_query[0]['yearly_rent']; }
			
			
			
			if($pndg_query[0]['accessory_amount_pending'] > 0 && $_POST["accessory"][$n] != "")
			{
				$accessory_amount_pending = $pndg_query[0]['accessory_amount_pending'] - $_POST["accessory"][$n];				
			} 
			else if($pndg_query[0]['accessory_amount_pending'] < 0 && $_POST["accessory"][$n] != "")
			{
				$accessory_amount_pending = $pndg_query[0]['accessory_amount_pending'] + $_POST["accessory"][$n];
			}
			else { $accessory_amount_pending = $pndg_query[0]['accessory_amount_pending']; }
			
			
			
			$update_pending = array('device_amount_pending' =>  $device_amount_pending, 'rent_amount_pending' =>  $rent_amount_pending, 
			'accessory_amount_pending' => $accessory_amount_pending, 'yearly_rent' => $yr_amount_pending, 'req_time' =>  date("Y-m-d H:i:s"));
			
			$condition2 = array('id' => $pndg_query[0]['id']);
		
			update_query('internalsoftware.debtor_pending_billing', $update_pending, $condition2);
			
			if($_POST["device"][$n] !=''){$post_device = $_POST["device"][$n];}
			else{$post_device = 0;}
			
			if($_POST["rent"][$n] !=''){$post_rent = $_POST["rent"][$n];}
			else{$post_rent = 0;}
			
			if($_POST["accessory"][$n] !=''){$post_accessory = $_POST["accessory"][$n];}
			else{$post_accessory = 0;}
			
			
			$recd_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
					'collection_agent' => $collection_agent, 'month' =>  $monthValue[$n]['month'], 'year' =>  $monthyear[1], 
					'device_amount_recd' =>  $post_device, 'rent_amount_recd' =>  $post_rent, 
					'accessory_amount_recd' =>  $post_accessory, 'discounting' =>  '0', 
					'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
					
			$history_insert_query = insert_query('internalsoftware.debtor_received_history', $recd_history);
				
			
			$recd_query = select_query("SELECT * FROM internalsoftware.debtor_received_billing WHERE client_id='".$client_name."' AND 
						  `month`='".$monthValue[$n]['month']."'  AND `year`='".$monthyear[1]."'");
			
			if(count($recd_query)>0)
			{
				$final_device_amount_recd = $recd_query[0]['device_amount_recd'] + $post_device;
				$final_rent_amount_recd = $recd_query[0]['rent_amount_recd'] + $post_rent;
				$final_accessory_amount_recd = $recd_query[0]['accessory_amount_recd'] + $post_accessory;
				
				$update_discount = array('device_amount_recd' => $final_device_amount_recd, 'rent_amount_recd' => $final_rent_amount_recd, 
					'accessory_amount_recd' => $final_accessory_amount_recd, 'received_time' => date("Y-m-d H:i:s"));
					
				$condition3 = array('id' => $recd_query[0]['id']);
				
				update_query('internalsoftware.debtor_received_billing', $update_discount, $condition3);
				
			}
			else
			{
				$debtor_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
					'collection_agent' => $collection_agent, 'month' =>  $monthValue[$n]['month'], 'year' =>  $monthyear[1], 
					'device_amount_recd' =>  $post_device, 'rent_amount_recd' =>  $post_rent, 
					'accessory_amount_recd' =>  $post_accessory, 'discounting' =>  '0', 
					'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
					
				$insert_query = insert_query('internalsoftware.debtor_received_billing', $debtor_history);
				
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
	   
	}

</script>
    
    
	<div class="top-bar">
        <h1>Received Amount </h1>
    </div>
    <div class="table"> 
    
		<form method="post" name="add_record" id="add_recordid" onsubmit="return validateForm()" autocomplete="off">
        
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
				
	       	</table>
            <table class="tb" style="padding-left:103px;">
                
            </table>
            <table style="padding-left:100px;width:700px;" cellspacing="5" cellpadding="5">
				<tr>
	  	  	    	<th style="min-width: 130px;text-align:left;">Pending Amount</th>
                    <th>Date</th>
				    <th>Device</th>
				    <th>Rent</th>
                    <th>Accessory</th>
				</tr>
                <?
                
					for($i=0;$i<count($pending_amount_data);$i++)
					{
						$month_pending = date('M',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));
						$pending_date = date('F,Y',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));
						
						if($pending_amount_data[$i]['device_amount_pending'] > 0) {
							$device_pending = '('.$month_pending.')Device-'.$pending_amount_data[$i]['device_amount_pending'].',';
						} else { $device_pending = '';}
						if($pending_amount_data[$i]['rent_amount_pending'] > 0) {
							$rent_pending = '('.$month_pending.')Rent-'.$pending_amount_data[$i]['rent_amount_pending'].',';
						} else { $rent_pending = '';}
						if($pending_amount_data[$i]['accessory_amount_pending'] > 0) {
							$accessory_pending = '('.$month_pending.')Accessory-'.$pending_amount_data[$i]['accessory_amount_pending'];
						} else { $accessory_pending = '';}
						if($pending_amount_data[$i]['yearly_rent'] > 0) {
							$yearly_pending = '('.$month_pending.')Yearly Rent-'.$pending_amount_data[$i]['yearly_rent'];
						} else { $yearly_pending = '';}
						
						if($month_year == $pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month'])
						{
							$device_recd = $_REQUEST['device_recd'];
							$rent_recd = $_REQUEST['rent_recd'];
							$accessory_recd = '0.00';
						}
						else
						{
							$device_recd = '';
							$rent_recd = '';
							$accessory_recd = '';
						}
						
				?>	
                <tr>
                	<td style="color:#F00"><?=$device_pending.' '.$rent_pending.' '.$accessory_pending.' '.$yearly_pending;?></td>
                    <td><input type='text' class='form-control' name='date[]'  readonly='readonly' id='monthdate' value='<?=$pending_date;?>' /></td>
                	<td> <input type='text' class='form-control' name='device[]'  id='device' value='<?=$device_recd?>' /></td>
                    <td> <input type='text' class='form-control' name='rent[]'  id='rent' value='<?=$rent_recd?>' /></td>
                    <td> <input type='text' class='form-control' name='accessory[]'  id='accessory' value='<?=$accessory_recd?>' /></td>
                </tr>	
						
				<?		
					}
				
				
				?>
                
                <!--<div id="AddMultiCol" style="padding-left:103px;"></div>-->

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