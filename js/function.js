var Path="http://203.115.101.54/format_testing/";
//var Path="http://localhost/format/";

var $s = jQuery.noConflict();

function Show_record(RowId,tablename,DivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=getrowSales",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 data:"RowId="+RowId+"&tablename="+tablename,
		success:function(msg){
			
		  
		document.getElementById("popup1").innerHTML = msg;
						
		}
	});
}


 function Show_reset_pwd(reset_pwd,DivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"popup.php?action=getreset_pwd",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 data:"reset_pwd="+reset_pwd,
		success:function(msg){
			
		  
		document.getElementById("popup1").innerHTML = msg;
						
		}
	});
}


function toggle_visibility(id) {
	if(id=='TxtSeparate')
		{
		var e = document.getElementById('TxtMainUser');
		 e.style.display = 'none';
		}
		else
		{
       var e = document.getElementById(id);
       
          e.style.display = 'block';
		  
		  }
		
    }		

function showUser(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=getdata",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}

function getClientPrice(user_id,paymentmode,device,rent,payment,AccPrice,AccRent)
{
 //alert(user_id);
 $s.ajax({
    type:"GET",
    url:"userInfo.php?action=pricing",
    data:"user_id="+user_id,
    beforeSend: function(msg){
     $s("#showrslt").hide();
    },
    success:function(msg){
     //alert(msg);
     $s("#showrslt").show();
     document.getElementById('price_check').style.display = "block";
     var spl = msg.split('##');
     
     if(spl[0] == 'Cheque')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Device Price Without Tax';
      document.getElementById(rent).innerHTML = spl[2] + ' - Rent Price Without Tax';
      document.getElementById(payment).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2];   
     }
     else if(spl[0] == 'Cash')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Cash Device Price';
      document.getElementById(rent).innerHTML = spl[2] + ' - Cash Rent Price';
      document.getElementById(payment).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
     }
     else if(spl[0] == 'Lease')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Lease Amount';
      document.getElementById(payment).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
      //document.getElementById("ModePay_lease").value="chk";
     }
     else if(spl[0] == 'Demo')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Demo Days';
      document.getElementById(payment).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
     }
     else if(spl[0] == 'Crack')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Crack Device Price';
      document.getElementById(rent).innerHTML = spl[2] + ' - Rent Price Without Tax';
      document.getElementById(ModePay).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
     }
     else if(spl[0] == 'FOC' || spl[0] == 'Trip Based')
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Device Price Without Tax';
      document.getElementById(rent).innerHTML = spl[2] + ' - Rent Price Without Tax';
      document.getElementById(ModePay).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
     }
     else
     {
      document.getElementById(paymentmode).innerHTML = spl[0] + ' - Payment Mode';
      document.getElementById(device).innerHTML = spl[1] + ' - Device Price Without Tax';
      document.getElementById(rent).innerHTML = spl[2] + ' - Rent Price Without Tax';
      document.getElementById(ModePay).value = spl[0];
      document.getElementById(AccPrice).value = spl[1];
      document.getElementById(AccRent).value = spl[2]; 
     }
     
     
   }
  });
}


function showUserddl(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=getdataddl",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}


function DetailVehicle(value,user_Id)
{
	var rootdomain="http://"+window.location.hostname
	var loadstatustext="<img src='"+rootdomain+"/images/icons/other/waiting.gif' />"
	document.getElementById("DetailVehicle").innerHTML=loadstatustext; 

$s.ajax({
		type:"GET",
		url:Path +"userInfo.php?action=DetailVehicle",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 data:"RowId="+value+"&user_Id="+user_Id,
		success:function(msg){
			 
		document.getElementById("DetailVehicle").innerHTML = msg;
						
		}
	});
}

function showDeleteImei(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=ReInstalltion",
		data:"user_id="+user_id,
		success:function(msg){
			
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}


 function showUserreplace(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=getdatareplce",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}


function gettotal_veh_byuser(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=total",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		
		document.getElementById(setDivId).value = msg;
						
		}
	});
}


function getCompanyName(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=companyname",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		 beforeSend: function(msg){
		  	$s("#button1").prop('disabled', true);
		  },
		success:function(msg){
			
		 $s("#button1").prop('disabled', false);
		 document.getElementById(setDivId).value = msg;
						
		}
	});
}


function getInstallermobile(inst_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=installermobile",
 
		data:"inst_id="+inst_id,
		success:function(msg){
			
		 
		document.getElementById(setDivId).value = msg;
						
		}
	});
}

function getTransferCompanyName(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=companyname",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		 
		document.getElementById(setDivId).value = msg;
						
		}
	});
}


function getCreationDate(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=creationdate",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		 
		document.getElementById(setDivId).value = msg;
						
		}
	});
}


function getdeviceImei(veh_reg,divDeviceIMEI)
{
 
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=deviceImei",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"veh_reg="+veh_reg,
		success:function(msg)
		{
		  
		 
		document.getElementById(divDeviceIMEI).value = msg;
						
		}
	});
}

function getdevicemobile(veh_reg,divDeviceMobile)
{
  
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=deviceMobile",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"veh_reg="+veh_reg,
		success:function(msg)
		{
		 
		 
		document.getElementById(divDeviceMobile).value = msg;
						
		}
	});
}


function getInstaltiondate(veh_reg,Divdate_of_install)
{
	//alert(user_id);
	//return false;
$s.ajax({
		type:"GET",
		url:"userInfo.php?action=Instaltiondate",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"veh_reg="+veh_reg,
		success:function(msg){
			
		 
		document.getElementById(Divdate_of_install).value = msg;
						
		}
	});
}

function ExistUserChk(name,setDivId)
{
	//alert(name);
   $s.ajax({
		type:"GET",
		url:"userInfo.php?action=checkUser",
		data:"user_id="+name,
		beforeSend: function(msg){
		  	$s("#button1").prop('disabled', true);
		  },
		success:function(msg){
			
			var tmparr = msg;
            var str_length = tmparr.length;
			//alert(str_length);
			if(str_length >= 11)
			{
				document.getElementById(setDivId).innerHTML = "User ("+name+") Already Exists!!";
				document.getElementById("TxtUserName").value = '';
			}
			else
			{
				document.getElementById(setDivId).innerHTML = '';
			}
			
			$s("#button1").prop('disabled', false);
						
		}
	});
}

function getSalesPersonName(user_id,setDivId)
{
	//alert(user_id);
	//return false;
	$s.ajax({
		type:"GET",
		url:"userInfo.php?action=salespersonname",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		 beforeSend: function(msg){
		  	$s("#button1").prop('disabled', true);
		  },
		success:function(msg){
			//alert(msg)
			
		 $s("#button1").prop('disabled', false);
		 document.getElementById(setDivId).value = msg;
						
		}
	});
}

function getdevicetype(user_id,setDivId)
{
	//alert(user_id);
	//return false;
	$s.ajax({
		type:"GET",
		url:"userInfo.php?action=deviceName",
		data:"user_id="+user_id,
		 beforeSend: function(msg){
		  	$s("#button1").prop('disabled', true);
		  },
		success:function(msg){
			//alert(msg);
			 $s("#button1").prop('disabled', false);
		var obj = JSON.parse(msg);

		var options = '';

		//var options1 = '';
		 options += '<option value="">Select</option>';
		for(var i = 0; i < obj.length;  i++){
		  options += '<option value="' + obj[i].dev_type_id + '">' + obj[i].deviceType + '</option>';
		}

		// for(var i = 0; i < obj.length;  i++){
		//   options1 += '<option value="' + i + '">' + obj[i].modelName + '</option>';;
		// }

		document.getElementById(setDivId).innerHTML = options;
		//document.getElementById(setDivId1).innerHTML = options1;
		}
	});
}

function getModelName(dev_type,setDivId)
{

		var user_id = document.getElementById('main_user_id').value;
		//alert(dev_type);
	$s.ajax({
		type:"GET",
		url:"userInfo.php?action=modelname",
		data:"dev_type="+dev_type+'&user_id='+user_id,
		 beforeSend: function(msg){
		  	$s("#button1").prop('disabled', true);
		  },
		success:function(msg){
		//alert(msg);
			 $s("#button1").prop('disabled', false);
		var obj = JSON.parse(msg);

		var options = '';

		// options += '<option value="">Select</option>';
		for(var i = 0; i < obj.length;  i++){
		  options += '<option value="' + obj[i].model_id + '">' + obj[i].model_name + '</option>';
		}

		// for(var i = 0; i < obj.length;  i++){
		//   options1 += '<option value="' + i + '">' + obj[i].modelName + '</option>';;
		// }

		document.getElementById(setDivId).innerHTML = options;
		//document.getElementById(setDivId1).innerHTML = options1;
		}
	});
}
 



 