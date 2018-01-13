<?php
ob_start();
session_start();
include("../connection.php");
  
?>
<html>
<head>
<title>jQuery add / remove textbox example</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>

<style type="text/css">
	div{
		padding:8px;
	}
</style>

</head>

<body>

<h1>jQuery add / remove textbox example</h1>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {

		if(counter>10){
				alert("Only 10 textboxes allow");
				return false;
		}
	
		var newTextBoxDiv = $(document.createElement('div'))
			 .attr("id", 'TextBoxDiv' + counter);
	
		newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
			  '<input type="text" name="textbox' + counter +
			  '" id="textbox' + counter + '" value="" >');
	
		newTextBoxDiv.appendTo("#TextBoxesGroup");
	
	
		counter++;
		
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }

	counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     
	 $("#getButtonValue").click(function () {

		var msg = '';
		for(i=1; i<counter; i++){
		  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
		}
			  alert(msg);
		 });
	 });
	 
	 
function DeviceSelection(deviceId,setDivId,modelName)
{
	//alert(modelName);
	$.ajax({
		type:"GET",
		url:"userInfo.php?action=getmodel",
		data:"user_id="+deviceId+"&model="+modelName,
		success:function(msg){
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}

</script>
</head><body>

<div id='TextBoxesGroup'>
	<div id="TextBoxDiv1">
		<!--<label>Textbox #1 : </label><input type='textbox' id='textbox1' >-->
        
        <select name="device_type" id="TxtDeviceType"  style="width:150px" onchange="DeviceSelection(this.value,'model_no','')">
            <option value="">-- select Device --</option>
            <?
            $devicetype = select_query("select * from internalsoftware.device_type where status=1");
            for($d=0;$d<count($devicetype);$d++)
            {
            ?>
           <option value="<?=$devicetype[$d]['id']?>" <? if($result[0]['device_type']==$devicetype[$d]['id']) {?> selected="selected" <? } ?> >
            <?=$devicetype[$d]['device_type']?>
            </option>
            <? } ?>
            
          </select>
        
        <span id="model_no"> </span>
        
        <select name="account_type" id="TxtAccountType"  style="width:150px" >
            <option value="">-- select one --</option>
            <option value="Lease" <? if($result[0]['account_type']=='Lease') {?> selected="selected" <? } ?>>Lease</option>
            <option value="Paid" <? if($result[0]['account_type']=='Paid') {?> selected="selected" <? } ?>>Paid</option>
            <option value="Demo" <? if($result[0]['account_type']=='Demo') {?> selected="selected" <? } ?>>Demo</option>
            <option value="Foc" <? if($result[0]['account_type']=='Foc') {?> selected="selected" <? } ?>>FOC</option>
            <option value="Crack" <? if($result[0]['account_type']=='Crack') {?> selected="selected" <? } ?>>Crack</option>
            <option value="Trip Based" <? if($result[0]['account_type']=='Trip Based') {?> selected="selected" <? } ?>> Trip Based</option>
            <option value="InternalTesting" <? if($result[0]['account_type']=='InternalTesting') {?> selected="selected" <? } ?>>Internal Testing</option>
        </select>
              
              
         <select name="mode_of_payment" id="mode_of_payment" style="width:150px">
            <option value="" >-- select one --</option>
            <option value="CashClient"<? if($result[0]['mode_of_payment']=='CashClient'){?> selected="selected"<? }?>>Cash Client</option>
            <option value="Billed" <? if($result[0]['mode_of_payment']=='Billed') {?> selected="selected" <? } ?>> Billed</option>
          </select>
        
        
        <input type="value" name="device_price" id="TxtDPrice" value="<?=$result[0]['device_price']?>" 
          placeholder="Device Price" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
          
        <input type="value" name="rent_Price" id="TxtDRent" value="<?=$result[0]['device_rent_Price']?>"  
           placeholder="Monthly Rent" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
           
         <Input type = 'Radio' Name ='rent_statuscash' id="rent_status_cash" value= 'Excluding'
			<?php if($result[0]['rent_status']=="Excluding"){echo "checked=\"checked\""; }?>/> Excluding
        <Input type = 'Radio' Name ='rent_statuscash' id="rent_status_cash" value= 'Including'
            <?php if($result[0]['rent_status']=="Including"){echo "checked=\"checked\""; }?>/> Including  
        
	</div>
</div>
<input type='button' value='Add Button' id='addButton'>
<input type='button' value='Remove Button' id='removeButton'>
<input type='button' value='Get TextBox Value' id='getButtonValue'>

</body>
</html>