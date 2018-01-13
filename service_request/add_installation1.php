<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<link  href="<?php echo __SITE_URL;?>/css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">


/*Start auto ajax value load code*/

$(document).ready(function(){
    $(document).click(function(){
        $("#ajax_response").fadeOut('slow');
    });
    $("#Zone_area").focus();
    var offset = $("#Zone_area").offset();
    var width = $("#Zone_area").width()-2;
    $("#ajax_response").css("left",offset);
    $("#ajax_response").css("width","15%");
    $("#ajax_response").css("z-index","1");
    $("#Zone_area").keyup(function(event){
         //alert(event.keyCode);
         var keyword = $("#Zone_area").val();
         if(keyword.length)
         {
             if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
             {
                 $("#loading").css("visibility","visible");
                 $.ajax({
                   type: "POST",
                   url: "load_zone_area.php",
                   data: "data="+keyword,
                   success: function(msg){   
                    if(msg != 0)
                      $("#ajax_response").fadeIn("slow").html(msg);
                    else
                    {
                      $("#ajax_response").fadeIn("slow");   
                      $("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
                    }
                    $("#loading").css("visibility","hidden");
                   }
                 });
             }
             else
             {
                switch (event.keyCode)
                {
                 case 40:
                 {
                      found = 0;
                      $("li").each(function(){
                         if($(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $("li[class='selected']");
                        sel.next().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $("li:first").addClass("selected");
                     }
                 break;
                 case 38:
                 {
                      found = 0;
                      $("li").each(function(){
                         if($(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $("li[class='selected']");
                        sel.prev().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $("li:last").addClass("selected");
                 }
                 break;
                 case 13:
                    $("#ajax_response").fadeOut("slow");
                    $("#Zone_area").val($("li[class='selected'] a").text());
                 break;
                }
             }
         }
         else
            $("#ajax_response").fadeOut("slow");
    });
    $("#ajax_response").mouseover(function(){
        $(this).find("li a:first-child").mouseover(function () {
              $(this).addClass("selected");
        });
        $(this).find("li a:first-child").mouseout(function () {
              $(this).removeClass("selected");
        });
        $(this).find("li a:first-child").click(function () {
              $("#Zone_area").val($(this).text());
              $("#ajax_response").fadeOut("slow");
        });
    });
});
/* End auto ajax value load code*/
</script>
<?php
$Header="New Installation";

$date=date("Y-m-d H:i:s");
$account_manager=$_SESSION['username'];
/*$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $Header="Edit Installation";
        $result=mysql_fetch_array(mysql_query("select * from installation where id=$id and branch_id=".$_SESSION['BranchId']));   
       
        $Zone_area = $result["Zone_area"];
        $area = mysql_fetch_array(mysql_query("SELECT id,`name` FROM re_city_spr_1 WHERE id='".$Zone_area."'"));
        //$_POST["time"]=$result['time'];
    }*/
   
?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">
<?


if(isset($_POST['submit']))
{	
	print_r($_POST);die;
	

	//echo "<pre>";print_r($_POST);die;
    $date=date("Y-m-d H:i:s");

    $account_manager=$_SESSION['username'];
    $sales_person=$_POST['sales_person'];

	
    $main_user_id=$_POST['main_user_id'];
    $company=$_POST['company'];
    $no_of_vehicals=$_POST['no_of_vehicals'];
    //$location=$_POST['location'];
    $model=$_POST['model'];
    $cnumber=$_POST['cnumber'];
    $contact_person=$_POST['contact_person'];
    $atime_status=$_POST['atime_status'];
    $back_reason=$_POST['back_reason'];

    $branch_type = $_POST['inter_branch'];
    $instal_reinstall = $_POST['instal_reinstall'];

	

 
	if($branch_type == "Samebranch" && $instal_reinstall == "installation")
    {
        $installation_status=8;
    }
    elseif($branch_type == "Interbranch" && $instal_reinstall == "installation")
    {
        $installation_status=8;
    }
	 elseif($instal_reinstall == "re_install")
    {
        $installation_status=1;
    }
    else
	  {
        $installation_status=8;
    }
       


   
    $veh_type=$_POST['veh_type'];

    $Zone_data = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE `name`='".$_POST['Zone_area']."'");
    $zone_count = count($Zone_data);
    
    if($zone_count > 0)
    {
        $Area = $Zone_data[0]["id"];
        $errorMsg = "";
    }
    else
    {
        $errorMsg = "Please Select Type View Listed Area. Not Fill Your Self.";
    }

    if($branch_type == "Interbranch"){
        $city=$_POST['inter_branch_loc'];
        $location="";
    }else{
        $city=0;
        $location=$_POST['location'];
    }

    $required=$_POST['required'];
        if($required=="") { $required="normal"; }
       
        $datapullingtime=$_POST['datapullingtime'];


    if($errorMsg=="")   
    { 
		
	
			if($atime_status=="Till")
			{
			
			        $time=$_POST['time'];  
              
              $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, 
      			  location,model,time, contact_number,installed_date, status, contact_person, veh_type,comment,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', 
      			  '".$company."','".$no_of_vehicals."','".$location."','".$model."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$veh_type."','".$comment."',".$required."',
      			  '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
      			  '".$instal_reinstall."')";
                 	 	//print_r($sql);
			
               $execute=mysql_query($sql);
               $insert_id = mysql_insert_id();   
              if($installation_status == 1)
              {
                for($N=1;$N<=$no_of_vehicals;$N++)
                {	
                    $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
          					no_of_vehicals, location,model,time, contact_number,installed_date, status, contact_person, veh_type, required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, 
          					branch_type, instal_reinstall) VALUES('".$insert_id."','".$date."',
          					'".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
          					'".$cnumber."',now(),1,'".$contact_person."','".$veh_type."','".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."',
          					'".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."')";
                   
                    $execute_inst=mysql_query($installation);
                }
             }
           
             header("location:installation.php");
      }
           
        if($atime_status=="Between")
        {
            $time=$_POST['time1'];
            $totime=$_POST['totime'];
           
                //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
             $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals,location,model, 
      			 time,totime,contact_number, installed_date, status, contact_person, veh_type, 
      			 required,branch_id, installation_status,Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."',
      			 '".$no_of_vehicals."','".$location."','".$model."','".$time."','".$totime."','".$cnumber."',now(),1,'".$contact_person."',".$veh_type."','".$required."',
      			 '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
      			 '".$instal_reinstall."')";
      			 
                 
                   $execute=mysql_query($sql);
                   $insert_id = mysql_insert_id();   

                  if($installation_status == 1)
                  {

                      for($N=1;$N<=$no_of_vehicals;$N++)
                      {
                          $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
                					no_of_vehicals, location,model,time, totime,contact_number,installed_date, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`,
                					 branch_type, instal_reinstall) VALUES('".$insert_id."','".$date."',
                					 '".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
                					 '".$totime."','".$cnumber."',now(),1,'".$contact_person."','".$veh_type."'  ,
                					 ".$required."','".$_SESSION['BranchId']."',
                					 '".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."',
                					 )";
                   
                          $execute_inst=mysql_query($installation);
                      }     
                }
             header("location:installation.php");
        }
	
		if($atime_status=="Till")
			{
			  $time=$_POST['time'];
               //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
              $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, 
			  location,model,time, contact_number,installed_date, status, contact_person,veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, 
			 ) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', 
			  '".$company."','".$no_of_vehicals."','".$location."','".$model."','".$time."','".$cnumber."',now(),1,'".$contact_person."','".$veh_type."','".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
			  '".$instal_reinstall."')";
             $execute=mysql_query($sql);
             $insert_id = mysql_insert_id();   
            if($installation_status == 1)
            {
                for($N=1;$N<=$no_of_vehicals;$N++)
                {
                    $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
					no_of_vehicals, location,model,time, contact_number,installed_date, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, 
					branch_type, instal_reinstall) VALUES('".$insert_id."','".$date."',
					'".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
					'".$cnumber."',now(),1,'".$contact_person."','".$veh_type."',".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."',
					'".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."')";
                     print_r($installation); 
                    $execute_inst=mysql_query($installation);
                }
            }
           
             header("location:installation.php");
        }
           
        if($atime_status=="Between")
        {
            $time=$_POST['time1'];
            $totime=$_POST['totime'];
               
            //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
             $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals,location,model, 
			 time,totime,contact_number, installed_date, status, contact_person, veh_type, 
			 required,branch_id, installation_status,Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall) VALUES('".$date."','".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."',
			 '".$no_of_vehicals."','".$location."','".$model."','".$time."','".$totime."','".$cnumber."',now(),1,'".$contact_person."','".$veh_type."',,'".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
			 '".$instal_reinstall."')";
           
             $execute=mysql_query($sql);
             $insert_id = mysql_insert_id();   

            if($installation_status == 1)
            {

                for($N=1;$N<=$no_of_vehicals;$N++)
                {	 
                    $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
					no_of_vehicals, location,model,time, totime,contact_number,installed_date, status, contact_person,veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`,
					 branch_type, instal_reinstall) VALUES('".$insert_id."','".$date."',
					 '".$account_manager."','".$sales_person."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
					 '".$totime."','".$cnumber."',now(),1,'".$contact_person."','".$veh_type."','".$required."','".$_SESSION['BranchId']."',
					 '".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."')";
                   
                    $execute_inst=mysql_query($installation);
                }     
            }
             header("location:installation.php");
        }         
      }
}
?>
  <script type="text/javascript">
var mode;
function req_info()
{
  
  var instal_reinstall=document.forms["form1"]["instal_reinstall"].value;
  if (instal_reinstall==null || instal_reinstall=="")
  {
	alert("Please Select Job") ;
	return false;
  }

  if(document.form1.sales_person.value=="")
  {
	alert("Please Select Sales Person Name") ;
	document.form1.sales_person.focus();
	return false;
  }
  if(document.form1.main_user_id.value=="")
  {
	alert("Please Select Client Name") ;
	document.form1.main_user_id.focus();
	return false;
  }
  if(document.form1.no_of_vehicals.value=="")
  {
	alert("Please Select No Of Installation") ;
	document.form1.no_of_vehicals.focus();
	return false;
  }
  
 if(document.form1.Zone_area.value=="")
  {
  alert("Please Select Area") ;
  document.form1.Zone_area.focus();
  return false;
  }
 
    var barnch=document.forms["form1"]["inter_branch"].value;
    if (barnch==null || barnch=="")
    {
        alert("Please Select Branch") ;
        return false;
    }
  
    var location=document.forms["form1"]["location"].value;
    if ((location==null || location=="") && barnch=="Samebranch")
    {
        alert("Please Enter location");
        document.form1.location.focus();
        return false;
    }
    var interbranch=document.forms["form1"]["inter_branch_loc"].value;
    if ((interbranch==null || interbranch=="") && barnch=="Interbranch")
    {
        alert("Please select branch location");
        document.form1.inter_branch_loc.focus();
        return false;
    }

    if(document.form1.model.value=="")
      {
      alert("Please Enter Model") ;
      document.form1.model.focus();
      return false;
      }
                
    var timestatus=document.forms["form1"]["atime_status"].value;
    if (timestatus==null || timestatus=="")
      {
          alert("Please select Availbale Time");
          document.form1.atime_status.focus();
          return false;
      }
 
    var tilltime=document.forms["form1"]["datetimepicker"].value;
    if(timestatus == "Till" && (tilltime==null || tilltime==""))
    {
        alert("Please select Time");
        document.form1.datetimepicker.focus();
        return false;
    }
  
    var betweentime=document.forms["form1"]["datetimepicker1"].value;
    var betweentime2=document.forms["form1"]["datetimepicker2"].value;
    if(timestatus == "Between" && (betweentime==null || betweentime==""))
    {
        alert("Please select From Time");
        document.form1.datetimepicker1.focus();
        return false;
    }
  
    if(timestatus == "Between" && (betweentime2==null || betweentime2==""))
    {
        alert("Please select To Time");
        document.form1.datetimepicker2.focus();
        return false;
    }
  
    if(document.form1.cnumber.value=="")
    {
    alert("Please Enter Contact No.") ;
    document.form1.cnumber.focus();
    return false;
    }
    var cnumber=document.form1.cnumber.value;
    if(cnumber!="")
        {
    var lenth=cnumber.length;
  
        if(lenth < 10 || lenth > 12 || cnumber.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.form1.cnumber.focus();
        document.form1.cnumber.value="";
        return false;
        }
     }
    if(document.form1.contact_person.value=="")
    {
        alert("Please Enter Contact Persion") ;
        document.form1.contact_person.focus();
        return false;
    }
  
    if(document.form1.veh_type.value=="")
    {
        alert("Please Select Vehicle Type") ;
        document.form1.veh_type.focus();
        return false;instal_reinstall
    }
   if(document.form1.price_diff_chkbox.checked==true)
   {
		if(document.form1.TxtAccountType.value=="")
		 {
			alert("Please Select Account Type") ;
			document.form1.TxtAccountType.focus();
			return false;
		}
   
 
 		if(document.form1.TxtAccountType.value=="Paid")
		{
			if(document.form1.mode_of_payment1.value=="")
			 {
				alert("Please mode of Payment") ;
				document.form1.mode_of_payment1.focus();
				return false;
			}
		}
		if(document.form1.TxtAccountType.value=="Lease")
		{
			if(document.form1.mode_of_payment1.value=="")
			 {
				alert("Please mode of Payment") ;
				document.form1.mode_of_payment1.focus();
				return false;
			}
		}

  		if(document.form1.TxtAccountType.value=="Crack")
		{
			if(document.form1.mode_of_payment1.value=="")
			 {
				alert("Please mode of Payment") ;
				document.form1.mode_of_payment1.focus();
				return false;
			}
		}
		
		if(document.form1.TxtAccountType.value=="Demo")
		{
			if(document.form1.demo_time.value=="")
			{
				alert("Please Enter Demo Time ") ;
				document.form1.demo_time.focus();
				return false;
			}
		}
		
		
	
	 	if(document.form1.TxtAccountType.value=="Foc")
   		 {
			if(document.form1.foc_reason.value=="")
			{
				alert("Please Give FOC reason") ;
				document.form1.foc_reason.focus();
				return false;
			}
		}
		
		if(document.form1.TxtAccountType.value=="Paid" || document.form1.TxtAccountType.value=="Lease"|| document.form1.TxtAccountType.value=="Crack")
    	{
			
			if(document.form1.mode_of_payment1.value=="Cheque")
			{
				if(document.form1.TxtDPrice.value=="")
				{
					alert("Please Enter Device Price") ;
					document.form1.TxtDPrice.focus();
					return false;
				}
		   
				if(document.form1.TxtDRent.value=="")
				{
					alert("Please Enter Rent") ;
					document.form1.TxtDRent.focus();
					return false;
				}   
			}
			
			
    	  	if(document.form1.mode_of_payment1.value=="Cash")
    		{
			 	 if(document.form1.TxtDPricecash.value=="")
			 	 {
					  alert("Please Enter Device Price") ;
					  document.form1.TxtDPricecash.focus();
					  return false;
				  }
				  if(document.form1.TxtDRentCash.value=="")
			 	  {
					  alert("Please Enter Rent") ;
					  document.form1.TxtDRentCash.focus();
					  return false;
			 	  }
			}
   
			if(document.form1.TxtRentPlan.value=="")
			 {
				alert("Please Choose Rent Plan") ;
				document.form1.TxtRentPlan.focus();
				return false;
			 }
			
    	}
    	
	}
      
}
   
function setVisibility(id, visibility)
{
    document.getElementById(id).style.display = visibility;
}

function TillBetweenTime(radioValue)
{
 if(radioValue=="Till")
    {
    document.getElementById('TillTime').style.display = "block";
    document.getElementById('BetweenTime').style.display = "none";
    }
    else if(radioValue=="Between")
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "block";
    }
    else
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "none";
    }
   
}

function TillBetweenTime12(radioValue)
{
 if(radioValue=="Till")
    {
    document.getElementById('TillTime').style.display = "block";
    document.getElementById('BetweenTime').style.display = "none";
    }
    else if(radioValue=="Between")
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "block";
    }
    else
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "none";
    }
   
}

function StatusBranch(radioValue)
{
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation').style.display = "block";
        document.getElementById('samebranchid').style.display = "none";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('samebranchid').style.display = "block";
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
        document.getElementById('samebranchid').style.display = "none";
    }
   
}           

function StatusBranch12(radioValue)
{
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation').style.display = "block";
        document.getElementById('samebranchid').style.display = "none";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('samebranchid').style.display = "block";
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
        document.getElementById('samebranchid').style.display = "none";
    }
   
}  

function set_Price()
{
	    var pricechange = document.getElementById('price_diff_chkbox').checked;

		if(pricechange == true)
		{		
	    	document.getElementById('type_of_account').style.display = "block";
		}
		else
		{
			document.getElementById('type_of_account').style.display = "none";
			document.getElementById('Billed_id').style.display = "none";
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
			document.getElementById('demo_id').style.display = "none";
			document.getElementById('foc_id').style.display = "none";
			document.getElementById('TxtAccountType').value = "";
			document.getElementById('mode_of_payment1').value = "";
			document.getElementById('TxtDPricecash').value = "";
			document.getElementById('TxtDRentCash').value = "";
			document.getElementById('rent_month').value = "";
			document.getElementById('TxtDPrice').value = "";
			document.getElementById('TxtDVat').value = "";
			document.getElementById('TxtDTotal').value = "";
			document.getElementById('TxtDRent').value = "";
			document.getElementById('TxtDServiceTax').value = "";
			document.getElementById('TxtDTotalREnt').value = "";
			document.getElementById('rent_status').value = "";
			document.getElementById('rent_month1').value = "";
			document.getElementById('demotime').value = "";
			document.getElementById('foc_reason').value = "";
			document.getElementById('rent_month').value = "";
			document.getElementById('rent_plan').value = ""; 
		}
}
function AccountSelection(Value)
{		
			document.getElementById('mode_of_payment1').value = "";
			document.getElementById('TxtDPricecash').value = "";
			document.getElementById('TxtDRentCash').value = "";
			document.getElementById('rent_month').value = "";
			document.getElementById('rent_month1').value = "";
			document.getElementById('TxtDPrice').value = "";
			document.getElementById('TxtDVat').value = "";
			document.getElementById('TxtDTotal').value = "";
			document.getElementById('TxtDRent').value = "";
			document.getElementById('TxtDServiceTax').value = "";
			document.getElementById('TxtDTotalREnt').value = "";
			document.getElementById('rent_status').value = "";
			document.getElementById('demotime').value = "";
			document.getElementById('foc_reason').value = "";
			document.getElementById('rent_plan').value = ""; 
			var mode = document.getElementById('mode_of_payment1').value;
		if(Value=="Lease")
		{
			document.getElementById('Billed_id').style.display = "block";
			document.getElementById('foc_id').style.display = "none";
			document.getElementById('demo_id').style.display = "none";
		if(mode == 'Cash')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Cheque')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
    }
    else if(Value=="Paid")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		var mode = document.getElementById('mode_of_payment1').value;
		if(mode == 'Cash')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Cheque')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
		
    }
	else if(Value=="Demo")
    {
		document.getElementById('demo_id').style.display = "block";
        document.getElementById('foc_id').style.display = "none";
		document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }
	else if(Value=="Foc")
    {
        document.getElementById('foc_id').style.display = "block";
		document.getElementById('demo_id').style.display = "none";
	    document.getElementById('Billed_id').style.display = "none";
		document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
    }
	else if(Value=="Crack")
    {
        document.getElementById('Billed_id').style.display = "block";
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
		var mode = document.getElementById('mode_of_payment1').value;
		if(mode == 'Cash')
		{
			document.getElementById('CashCase').style.display = "block";
			document.getElementById('ChequeCase').style.display = "none";
		}
		else if(mode == 'Cheque')
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "block";
		}
		else
		{
			document.getElementById('CashCase').style.display = "none";
			document.getElementById('ChequeCase').style.display = "none";
		}
		
    }   
    else  
    {
        document.getElementById('Billed_id').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
		document.getElementById('ChequeCase').style.display = "none";
		
		document.getElementById('foc_id').style.display = "none";
		document.getElementById('demo_id').style.display = "none";
    }

}

function PaymentProcessBYCash(radioValue)
{
			document.getElementById('rent_month').value ="";
			document.getElementById('TxtDPrice').value = "";
			document.getElementById('TxtDVat').value = "";
			document.getElementById('TxtDTotal').value = "";
			document.getElementById('TxtDRent').value = "";
			document.getElementById('TxtDServiceTax').value = "";
			document.getElementById('TxtDTotalREnt').value = "";
			document.getElementById('rent_status').value = "";
			document.getElementById('rent_month1').value = "";
			document.getElementById('demotime').value = "";
			document.getElementById('foc_reason').value = "";
			document.getElementById('rent_plan').value = "";
			document.getElementById('TxtDPricecash').value = "";
			document.getElementById('TxtDRentCash').value = "";  
	
    if(radioValue=="Cash")
    {
        document.getElementById('ChequeCase').style.display = "none";
        document.getElementById('CashCase').style.display = "block";
		
    }
    else if(radioValue=="Cheque")
    {
        document.getElementById('ChequeCase').style.display = "block";
        document.getElementById('CashCase').style.display = "none";
    }
   
    else  
    {
        document.getElementById('ChequeCase').style.display = "none";
        document.getElementById('CashCase').style.display = "none";
    }
}
function calculatetotal(price)
{
    var vatp = 5;
   
    document.getElementById('TxtDVat').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotal').value=parseInt(price)+parseInt(document.getElementById('TxtDVat').value);
    //alert(result);

}

function calculaterent(price)
{
    var vatp = 15;
   
    document.getElementById('TxtDServiceTax').value= parseInt(price * vatp / 100);
    document.getElementById('TxtDTotalREnt').value=parseInt(price)+parseInt(document.getElementById('TxtDServiceTax').value);
    //alert(result);

}

/*function enableDisable() {
  if(document.form1.inter_branch.checked){
     document.form1.location.disabled = true;
  } else {
     document.form1.location.disabled = false;
  }
} */
</script> 
  <script type="text/javascript">

        $(function () {
             
            $("#datetimepicker").datetimepicker({});
            $("#datetimepicker1").datetimepicker({});
            $("#datetimepicker2").datetimepicker({});
            $("#datetimepicker3").datetimepicker({});
        });

    </script> 

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>
  
<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

 <form method="post" action="" name="form1" onSubmit="return req_info();">
    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td colspan="2"><input type="hidden" name="back_reason" id="back_reason" value="<?php echo $result['back_reason']?>"/></td>
      </tr>
      <tr>
        <td align="right">Job:*</td>
        <td nowrap>
          <input type="radio" name="instal_reinstall"  value="installation" id="instal_reinstall" <?php if($result['instal_reinstall']=='installation') {echo "checked=\"checked\""; }?> />
          Installation
          <input type="radio" name="instal_reinstall" value="re_installation" id="instal_reinstall" <?php if($result['instal_reinstall']=='re_install') {echo "checked=\"checked\""; }?> />
          Re-Installation
          <input type="radio" name="instal_reinstall"  value="crack" id="instal_reinstall" <?php if($result['instal_reinstall']=='crack') {echo "checked=\"checked\""; }?> />
          Crack
          <input type="radio" name="instal_reinstall"  value="online_crack" id="instal_reinstall" <?php if($result['instal_reinstall']=='installation') {echo "checked=\"checked\""; }?> />
          Online Crack
        </td>
      </tr>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $('#lstFruits').multiselect({
                includeSelectAllOption: true
            });
            $('#btnSelected').click(function () {
                var selected = $("#lstFruits option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
                });
                alert(message);
            });
        });
    </script>
    <select id="lstFruits" multiple="multiple">
        <option value="1">Mango</option>
        <option value="2">Apple</option>
        <option value="3">Banana</option>
        <option value="4">Guava</option>
        <option value="5">Orange</option>
    </select>
    













      <tr>
        <td align="right"> Client User Name:* </td>
        <td nowrap>
          <select style="width:150px;" name="main_user_id" id="main_user_id"  onchange="showUser(this.value,'ajaxdata'); getCompanyName(this.value,'TxtCompany');
         getClientPrice(this.value,'mode_of_payment','device_price_client','rent_client','ModePay','AccPrice','AccRent');;getSalesPersonName(this.value,'TxtSalesPersonName');" />
            <option value="" >-- Select One --</option>
            <?php

              $main_user_iddata=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
              
              for($u=0;$u<count($main_user_iddata);$u++)
              {
                if($main_user_iddata[$u]['user_id']==$result['user_id'])
                {
                  $selected="selected";
                }
                else
                {
                  $selected="";
                }
            ?>
            <option value ="<?php echo $main_user_iddata[$u]['user_id'] ?>"  <?echo $selected;?>> <?php echo $main_user_iddata[$u]['name']; ?> </option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td  align="right">Sales Person:*</td>
        <td><input type="text" name="company" id="TxtSalesPersonName" readonly value="<?=$result['company_name']?>"/></td>
      </tr>
      
      <tr>
        <td  align="right">Company Name:</td>
        <td><input type="text" name="company" id="TxtCompany" readonly value="<?=$result['company_name']?>"/></td>
      </tr>
      
      <tr>
        <td height="32" align="right">No. Of Installation:*</td>
        <td><select name="no_of_vehicals" id="no_of_vehicals" style="width:150px">
            <option value="">Select Installation</option>
            <?             
      for($inlp=1;$inlp<=50;$inlp++){
             ?>
            <option value="<?=$inlp;?>" <? if($result['no_of_vehicals']==$inlp) {?> selected="selected" <? } ?> >
            <?=$inlp?>
            </option>
            <? } ?>
          </select>
        </td>
      </tr>

      <tr>
        <td  align="right">Branch:* </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='inter_branch' id='inter_branch' value= 'Samebranch' <?php if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="StatusBranch(this.value);">
          <?php echo $branch_data[0]["city"];?>
          <Input type='radio' Name ='inter_branch' id='inter_branch' value= 'Interbranch' <?php if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
        onchange="StatusBranch(this.value);">
          Inter Branch 
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <table  id="branchlocation"  align="right"  style="width: 100%;display:none;margin-left:-6px;" cellspacing="5" cellpadding="5">
            <tr>
              <td align="right" style="width: 18%;margin-right:-1px;">Branch Location:*</td>
              <td><select name="inter_branch_loc" id="inter_branch_loc" style="width:150px;">
                  <option value="" >-- Select One --</option>
                  <?php
                      $city1=select_query("select * from tbl_city_name where branch_id!='".$_SESSION['BranchId']."'");
                      //while($data=mysql_fetch_assoc($city1))
                      for($i=0;$i<count($city1);$i++)
                      {
                          if($city1[$i]['branch_id']==$result['inter_branch'])
                          {
                              $selected="selected";
                          }
                          else
                          {
                              $selected="";
                          }
                      ?>
                      <option value ="<?php echo $city1[$i]['branch_id'] ?>"  <?echo $selected;?>> <?php echo $city1[$i]['city']; ?> </option>
                      <?php
                      }
                      ?>
                </select>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td  align="right"> Area:*</td>
        <td><input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area["name"];?>" />
          <div id="ajax_response"></div>
        </td>
      </tr>
      
     <tr>
        <td align="right"> Location:*</td>
        <td><input type="text" name="location"  id="location" value="<?=$result['location']?>"/></td>
      </tr> 
      
      
      
      <tr>
        <td height="32" align="right">Model:*</td>
        <td><select name="model" id="model" style="width:150px">
            <option value="">Select Model:*</option>
            <?
            $device_query=select_query("select * from device_model");
            
      for($j=0;$j<count($device_query);$j++)
      {
             ?>
            <option value="<?=$device_query[$j]['device_model']?>" <? if($result['model']==$device_query[$j]['device_model']) {?> selected="selected" <? } ?> > <?=$device_query[$j]['device_model']?>
            </option>
            <? } ?>
          </select>
        </td>
      </tr>
      
      <tr>
        <td align="right">Availbale Time status:*</td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <? if($result['atime_status']=='Till') {?> selected="selected" <? } ?> >Till</option>
            <option value="Between" <? if($result['atime_status']=='Between') {?> selected="selected" <? } ?> >Between</option>
          </select>
        </td>
      </tr>
      
      <tr>
        <td colspan="2">
          <table  id="TillTime" align="left" style="width:100%;display:none;margin-left:110px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">Time:*</td>
              <td><input type="text" name="time" id="datetimepicker" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
          </table>
          <table  id="BetweenTime" align="left" style="width:100%;display:none;margin-left:85px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">From Time:*</td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
            <tr>
              <td height="32" align="right">To Time:*</td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?=$result['totime']?>" style="width:147px"/></td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
        <td height="32" align="right">Contact No.:*</td>
        <td><input type="text" name="cnumber" value="<?=$result['contact_number']?>" style="width:147px"/></td>
      </tr>
      
      <tr>
        <td height="32" align="right">Contact Person:*</td>
        <td><input type="text" name="contact_person" value="<?=$result['contact_person']?>" style="width:147px"/></td>
      </tr>
      
      <tr>
        <td height="32" align="right">Vehicle Type:*</td>
        <td><select name="veh_type" id="veh_type" style="width:150px" onchange="checkbox_lease();" >
            <option value="">Select Vehicle Type:*</option>
            <?
            $query1=select_query("select * from veh_type");
            //while($data=mysql_fetch_array($query)) 
      for($v=0;$v<count($query1);$v++)
      {
             ?>
            <option value="<?=$query1[$v]['veh_type']?>" <? if($result['veh_type']==$query1[$v]['veh_type']) {?> selected="selected" <? } ?> >
            <?=$query1[$v]['veh_type']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
      


       
      
<tr>
        <td height="32" align="right"><input type="submit" name="submit" id="button1" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
      </tr>
      
    </table>
  </form>
</div>
<?php
include("../include/footer.php");

?>
<script>StatusBranch12("<?=$result['branch_type'];?>");TillBetweenTime12("<?=$result['atime_status'];?>");</script>

