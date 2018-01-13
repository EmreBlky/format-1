<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

$ClientDetails = select_query("select Userid,UserName from addclient where sys_active=1 order by UserName");

$SalesPersion = select_query("select id,name from sales_person where active=1 order by name");

$CollectionAgent = select_query("select id,name from collection_agent where is_active=1 order by name");


if(isset($_GET["AddRecd"]) && $_GET["AddRecd"]="true" )
{
	$client_name = $_GET['client'];
	$company_name = $_GET['company'];
	$sales_manager = $_GET['manager'];
	$collection_agent = $_GET['agent'];
	
	$pending_amount_data = select_query("select * from debtor_pending_billing where client_id='".$client_name."' and (device_amount_pending > 0 or rent_amount_pending > 0 or accessory_amount_pending > 0 or yearly_rent > 0) order by year desc,month desc");
	
	//echo "<pre>";print_r($pending_amount_data);die;
	
}


if(isset($_POST["submit"]))
{
	//echo "<pre>";print_r($_POST);die;	
	
	$client_name = $_POST["client_name"];
	$company_name = $_POST["company_name"];
	$sales_manager = $_POST["sales_manager"];
	$collection_agent = $_POST["collection_agent"];
	$discounting_amount = $_POST["discounting_amount"];
	$checkbox_loop = $_POST["checkbox_loop"];
	
	$no_of_select_chkbox=0;
	
	for($j=0;$j<=$checkbox_loop;$j++)
	{
		if(isset($_POST[$j]))
		{
			$no_of_select_chkbox++;
			
			$selectMonth['month'][] = (isset($_POST[$j])) ? trim($_POST[$j])  : "";
			$selectType['type'][] = (isset($_POST['confirm_type'][$j])) ? trim($_POST['confirm_type'][$j])  : "";
		}
	}
	
	//echo "<pre>";print_r($selectMonth['month']);die;
	
	$discountValue = $discounting_amount/$no_of_select_chkbox;
	
	for($st=0;$st<count($selectMonth['month']);$st++)
	{
		
		$array = explode("-",$selectMonth['month'][$st]);
		
		$changeyear  = $array[0];
		$changeMonth = $array[1];
		$changetype  = $array[2];
		
		//echo "SELECT * FROM debtor_pending_billing WHERE client_id='".$client_name."' AND `month`='".$array[1]."' AND `year`='".$array[0]."'";
		
		$pndg_query = select_query("SELECT * FROM debtor_pending_billing WHERE client_id='".$client_name."' AND `month`='".$array[1]."' 
									AND `year`='".$array[0]."'");
		
		$pending_history = array('client_id' => $pndg_query[0]['client_id'], 'company_name' => $pndg_query[0]['company_name'], 
		'sales_manager' => $pndg_query[0]['sales_manager'], 'collection_agent' => $pndg_query[0]['collection_agent'], 
		'month' =>  $pndg_query[0]['month'], 'year' =>  $pndg_query[0]['year'], 'yearly_rent' => $pndg_query[0]['yearly_rent'],
		'device_amount_pending' =>  $pndg_query[0]['device_amount_pending'], 'rent_amount_pending' =>  $pndg_query[0]['rent_amount_pending'], 
		'accessory_amount_pending' =>  $pndg_query[0]['accessory_amount_pending'], 'req_time' =>  $pndg_query[0]['req_time']);
		
		$pending_insert_query = insert_query('internalsoftware.debtor_pending_history', $pending_history);
		
		
		
		if($pndg_query[0]['device_amount_pending'] > 0 && $selectType['type'][$st] == "Device")
		{
			$device_amount_pending = $pndg_query[0]['device_amount_pending'] - $discountValue;				
		} 
		else { $device_amount_pending = $pndg_query[0]['device_amount_pending']; }
			
			
		if($pndg_query[0]['rent_amount_pending'] > 0 && $selectType['type'][$st] == "Rent")
		{
			$rent_amount_pending = $pndg_query[0]['rent_amount_pending'] - $discountValue;				
		} 
		else { $rent_amount_pending = $pndg_query[0]['rent_amount_pending']; }
			
		
		if($pndg_query[0]['yearly_rent'] > 0 && $selectType['type'][$st] == "Rent")
		{
			$yr_amount_pending = $pndg_query[0]['yearly_rent'] - $discountValue;				
		} 
		else { $yr_amount_pending = $pndg_query[0]['yearly_rent']; }	
		
			
		if($pndg_query[0]['accessory_amount_pending'] > 0 && $selectType['type'][$st] == "Accessory")
		{
			$accessory_amount_pending = $pndg_query[0]['accessory_amount_pending'] - $discountValue;				
		} 
		else { $accessory_amount_pending = $pndg_query[0]['accessory_amount_pending']; }
			
			
			
		$update_pending = array('device_amount_pending' =>  $device_amount_pending, 'rent_amount_pending' =>  $rent_amount_pending, 
		'accessory_amount_pending' => $accessory_amount_pending, 'yearly_rent' => $yr_amount_pending, 'req_time' =>  date("Y-m-d H:i:s"));
		
		$condition2 = array('id' => $pndg_query[0]['id']);
	
		update_query('internalsoftware.debtor_pending_billing', $update_pending, $condition2);
	
		
		$recd_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
				'collection_agent' => $collection_agent, 'month' =>  $array[1], 'year' =>  $array[0], 
				'device_amount_recd' =>  0, 'rent_amount_recd' =>  0, 
				'accessory_amount_recd' =>  0, 'discounting' =>  $discountValue, 'discounting_type' => $selectType['type'][$st], 
				'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
				
		$history_insert_query = insert_query('internalsoftware.debtor_received_history', $recd_history);
		
		
		$recd_query = select_query("SELECT * FROM debtor_received_billing WHERE client_id='".$client_name."' AND `month`='".$array[1]."' 
									AND `year`='".$array[0]."'");
		if(count($recd_query)>0)
		{
			$final_discount = $recd_query[0]['discounting'] + $discountValue;
			$discounting_type = $selectType['type'][$st].'-'.$recd_query[0]['discounting_type'];
			
			$update_discount = array('discounting' => $final_discount, 'discounting_type' => $discounting_type, 
			'received_time' => date("Y-m-d H:i:s"));
			$condition3 = array('id' => $recd_query[0]['id']);
			update_query('internalsoftware.debtor_received_billing', $update_discount, $condition3);
			
		}
		else
		{
			$debtor_history = array('client_id' => $client_name, 'company_name' => $company_name, 'sales_manager' => $sales_manager, 
				'collection_agent' => $collection_agent, 'month' =>  $array[1], 'year' =>  $array[0], 
				'device_amount_recd' =>  0, 'rent_amount_recd' =>  0, 
				'accessory_amount_recd' =>  0, 'discounting' =>  $discountValue, 'discounting_type' => $selectType['type'][$st], 
				'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
				
			$insert_query = insert_query('internalsoftware.debtor_received_billing', $debtor_history);
		}
		
	}
	
	//die;
		
	//$Msg = "Discounting Successfully Updated.";
	echo "<script>alert('Discounting Successfully Updated.');</script>";
	
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
	   if(document.getElementById("Txtdiscounting_amount").value == "")
	   {
		  alert("Please Enter Discount Amount");
		  document.getElementById("Txtdiscounting_amount").focus();
		  return false;
	   }
	   
	   var Dtable = document.getElementById('checkbox_loop');
	   var DrowCount = Dtable.value;
	   //console.log(DrowCount);
	   
	   var fcounter = 0; var countCheck = 0;
	   for(var m=0; m<DrowCount; m++)
	   {
		   var confirm_type = 'confirm_type'+fcounter;
		   var checkbox = m;
		   
		   if(document.getElementById(checkbox).checked == false)
		   {			   
			   countCheck++;
		   }
		   
		   if(countCheck == DrowCount)
		   {
			    alert("Please Select at leaste one checkbox.");
				return false;
		   }
		   
		   if(document.getElementById(checkbox).checked == true)
		   {
			   if(document.getElementById(confirm_type).value=="")
			   {
				  alert("Please Select Discount Type of Selected Checkbox.");
				  document.getElementById(confirm_type).focus();
				  return false;
			   }
		   }
		   
		  fcounter++;
	   }
	   
	   
	}


	function CheckUncheck(field){
		
		if(document.getElementById("all_check").checked == true){
			
				 for (var i=0;i<field;i++) 
				 {
					 document.getElementById(i).checked = true;
				 }
		  }
		   else{
				 for (var i=0;i<field;i++) 
				 {
					 document.getElementById(i).checked = false;
				 }
			}
	}

</script>
    
    
	<div class="top-bar">
        <h1>Discounting </h1>
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
                    <td colspan="2"><input type="text" name="company_name" id="TxtCompany" readonly value="<?=$company_name;?>"/></td>
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
				<tr>
                    <td>Discounting Amount:*</td>
                    <td colspan="2"><input type="text" name="discounting_amount" id="Txtdiscounting_amount" value=""/></td>
                </tr>
	       	<!--</table>
            <table style="padding-left:100px;width:700px;" cellspacing="1" cellpadding="1">-->
                <tr>
                    <td>All </td>
                    <td colspan="2">
                    	<input type="checkbox" name="all_check" id="all_check" onchange="CheckUncheck('<?=count($pending_amount_data);?>');"/>
                    	<input type="hidden" name="checkbox_loop" id="checkbox_loop" value="<?=count($pending_amount_data);?>" /></td>
                </tr>
               
			<?   
				for($i=0;$i<count($pending_amount_data);$i++)
				 {
					$month_pending = date('M',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));
					$pending_date = date('Y-m',strtotime($pending_amount_data[$i]['year'].'-'.$pending_amount_data[$i]['month']));
					
					if($pending_amount_data[$i]['device_amount_pending'] > 0) {
						$device_pending = $pending_date.'-Device-'.$pending_amount_data[$i]['device_amount_pending'].',';
					} else { $device_pending = '';}
					if($pending_amount_data[$i]['rent_amount_pending'] > 0) {
						$rent_pending = $pending_date.'-Rent-'.$pending_amount_data[$i]['rent_amount_pending'].',';
					} else { $rent_pending = '';}
					if($pending_amount_data[$i]['accessory_amount_pending'] > 0) {
						$accessory_pending = $pending_date.'-Accessory-'.$pending_amount_data[$i]['accessory_amount_pending'];
					} else { $accessory_pending = '';}
					if($pending_amount_data[$i]['yearly_rent'] > 0) {
						$yearly_pending = $pending_date.'-Yearly Rent-'.$pending_amount_data[$i]['yearly_rent'];
					} else { $yearly_pending = '';}
					
				?>	
                 <tr>
                	<td>&nbsp;</td>				  
                  	<td colspan="2"><input type="checkbox" name='<?=$i;?>' id='<?=$i;?>' value='<?=$device_pending.' '.$rent_pending.' '.$accessory_pending.' '.$yearly_pending;?>'/>&nbsp;<?=$device_pending.' '.$rent_pending.' '.$accessory_pending.' '.$yearly_pending;?>
                    	<select name="confirm_type[]" id="confirm_type<?=$i;?>">
					    	<option value="">Select</option>					    	
						    <option value="Device">Device</option>
                            <option value="Rent">Rent</option>
                            <option value="Accessory">Accessory</option>
					    </select>
                    </td>
				 </tr>
                <?
                  }
		 
				?>
		  		
			<tr><td colspan="3">&nbsp;</td></tr>

            <tr>
               <td>&nbsp;</td>
                <td colspan="2"><button type="submit" name="submit" id="button1" onClick="validate()">Submit</button>
                	<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_client_debtor.php' " /></td>
            </tr>
          </table>
		</form>						    
	</div>
<?php include("../include/footer.php"); ?>