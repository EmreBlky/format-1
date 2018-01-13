 function Show_record(RowId,tablename,DivId)
{
	//alert(user_id);
	//return false;
$.ajax({
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
$.ajax({
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
$.ajax({
		type:"GET",
		url:"userInfo.php?action=getdata",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		
		document.getElementById(setDivId).innerHTML = msg;
						
		}
	});
}

    function showUserddl(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$.ajax({
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
$.ajax({
		type:"GET",
		url:Path +"userInfo.php?action=DetailVehicle",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 data:"RowId="+value+"&user_Id="+user_Id,
		success:function(msg){
			 
		document.getElementById("DetailVehicle").innerHTML = msg;
						
		}
	});
}




 function showUserreplace(user_id,setDivId)
{
	//alert(user_id);
	//return false;
$.ajax({
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
$.ajax({
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
$.ajax({
		type:"GET",
		url:"userInfo.php?action=companyname",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"user_id="+user_id,
		success:function(msg){
			
		 
		document.getElementById(setDivId).value = msg;
						
		}
	});
}


function getInstallermobile(inst_id,setDivId)
{
	//alert(user_id);
	//return false;
$.ajax({
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
$.ajax({
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
$.ajax({
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
$.ajax({
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
$.ajax({
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
$.ajax({
		type:"GET",
		url:"userInfo.php?action=Instaltiondate",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		data:"veh_reg="+veh_reg,
		success:function(msg){
			
		 
		document.getElementById(Divdate_of_install).value = msg;
						
		}
	});
}

 



 