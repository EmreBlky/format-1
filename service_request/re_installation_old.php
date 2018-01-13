<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
?>

<script type="text/javascript">

var jq = $.noConflict();

jq(document).ready(function(){

  jq('#no_of_installation').change(function() {
    jq("#textA").html("");
    var number = jq("#no_of_installation").val();
    //alert(number)

    if(number > 0){
      jq("#status").show();

      var user_id = jq("#main_user_id").val();
      //alert(user_id)
      jq.ajax({
        type:"GET",
        url:"userInfo.php?action=getAllImei",
        data:"userId="+user_id,
        success:function(msg){
          //alert(msg)
         var deviceImei = JSON.parse(msg)
         var imeiNumber = [];
         //alert(deviceImei[0].imei)
         for(var i=0;i<deviceImei.length;i++){

          //alert(deviceImei[i].imei)

          imeiNumber.push(deviceImei[i].imei)
                
         }

         var num = String(imeiNumber).split(',')
         var option = "<option value=''>Select Imei No</option>"
         for(var a = 0; a < num.length; a++) {
          
          option += "<option value='"+num[a]+"'>"+num[a]+"</option>"
          
         }
         for(var i =1; i <= number; i++){

            var age1 = `<tr><td><select name='imei[]' style="width:150px" onchange="devicestatus(this.value,'txtDeviceStatus${i}')">${option}</select></td><td><input type='text' style="width:145px" name='txtDeviceStatus[]' id='txtDeviceStatus${i}'></td></tr>`;
            jq("#textA").append(age1);

          }
        }
      });


      
    }    
  });

  jq("#hide").click(function(){
      jq("#acn").hide();
  });
  jq("#show").click(function(){
      jq("#acn").show();
  });

  jq(document).click(function(){
        jq("#ajax_response").fadeOut('slow');
    });
    jq("#Zone_area").focus();
    var offset = jq("#Zone_area").offset();
    var width = jq("#Zone_area").width()-2;
    jq("#ajax_response").css("left",offset);
    jq("#ajax_response").css("width","15%");
    jq("#ajax_response").css("z-index","1");
    jq("#Zone_area").keyup(function(event){
         //alert(event.keyCode);
         var keyword = jq("#Zone_area").val();
         if(keyword.length)
         {
             if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
             {
                 jq("#loading").css("visibility","visible");
                 jq.ajax({
                   type: "POST",
                   url: "load_zone_area.php",
                   data: "data="+keyword,
                   success: function(msg){   
                    if(msg != 0)
                      jq("#ajax_response").fadeIn("slow").html(msg);
                    else
                    {
                      jq("#ajax_response").fadeIn("slow");   
                      jq("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
                    }
                    jq("#loading").css("visibility","hidden");
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
                      jq("li").each(function(){
                         if(jq(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = jq("li[class='selected']");
                        sel.next().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        jq("li:first").addClass("selected");
                     }
                 break;
                 case 38:
                 {
                      found = 0;
                      jq("li").each(function(){
                         if(jq(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = jq("li[class='selected']");
                        sel.prev().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        jq("li:last").addClass("selected");
                 }
                 break;
                 case 13:
                    jq("#ajax_response").fadeOut("slow");
                    jq("#Zone_area").val(jq("li[class='selected'] a").text());
                 break;
                }
             }
         }
         else
            jq("#ajax_response").fadeOut("slow");
    });
    jq("#ajax_response").mouseover(function(){
        jq(this).find("li a:first-child").mouseover(function () {
              jq(this).addClass("selected");
        });
        jq(this).find("li a:first-child").mouseout(function () {
              jq(this).removeClass("selected");
        });
        jq(this).find("li a:first-child").click(function () {
              jq("#Zone_area").val(jq(this).text());
              jq("#ajax_response").fadeOut("slow");
        });
    });
    // $('#accessories').multiselect({
    // columns: 1,
    // placeholder: 'Select Accessories',
    // search: true,
    // selectAll: true

    // });
    // $('#accessories').multiselect({
    // columns: 1,
    // placeholder: 'Select Accessories'
    // });

    jQuery('#accessories').multiselect({
    columns: 1,
    placeholder: 'Select Accessories',
    search: true
    });

    jq('#example').dataTable({
                "aaSorting": [[ 7, "desc" ]]
    });

     jq(function () {
             
            jq("#datetimepicker").datetimepicker({});
            jq("#datetimepicker1").datetimepicker({});
            jq("#datetimepicker2").datetimepicker({});
            jq("#datetimepicker3").datetimepicker({});
        });



});

function devicestatus(imei,setDivId){
  jq.ajax({
      type:"GET",
      url:"userinfo.php?action=imeistatus",
      data:"imeiNo="+imei,
      success:function(msg){
        document.getElementById(setDivId).value = msg;
      }
  });
}

function deviceImeiStatus(imeistatus){
  if(imeistatus == "Deleted"){
   jq.ajax({
        type:"GET",
        url:"userInfo.php?action=getAllImei",
        data:"userId="+user_id,
        success:function(msg){
          //alert(msg)
         var deviceImei = JSON.parse(msg)
         var imeiNumber = [];
         //alert(deviceImei[0].imei)
         for(var i=0;i<deviceImei.length;i++){

          //alert(deviceImei[i].imei)

          imeiNumber.push(deviceImei[i].imei)
                
         }

         var num = String(imeiNumber).split(',')
         var option = "<option value=''>Select Imei No</option>"
         for(var a = 0; a < num.length; a++) {
          
          option += "<option value='"+num[a]+"'>"+num[a]+"</option>"
          
         }
         for(var i =1; i <= number; i++){

            var age1 = `<tr><td><select name='imei[]' style="width:150px" onchange="devicestatus(this.value,'txtDeviceStatus${i}')">${option}</select></td><td><input type='text' style="width:145px" name='txtDeviceStatus[]' id='txtDeviceStatus${i}'></td></tr>`;
            jq("#textA").append(age1);

          }
        }
      });

  }
}

function vehicleType(radioValue)
{
  //alert(radioValue)
   if(radioValue=="Bus")
    {
        document.getElementById('standard').style.display = "block";
        document.getElementById('deviceMdl').style.display = "block";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
    }
    else if(radioValue=="Car")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('deviceMdl').style.display = "block";
        document.getElementById('actype').style.display = "block";
    }
    else if(radioValue=="Tempo")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";    
    }
    else if(radioValue=="Truck")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "block";
        document.getElementById('actype').style.display = "none";
    }
    else if(radioValue=="Trailer")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "block";
    }
    else if(radioValue=="Machine")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('MachineType').style.display = "block";
    }
    else if(radioValue=="Bike")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
    }
    else
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('deviceMdl').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
    }
   
}

function standardType(radioValue){

  //alert(radioValue)
  if(radioValue=="Delux")
      {
          document.getElementById('actype').style.display = "block";
          document.getElementById('deviceMdl').style.display = "block";
          document.getElementById('TruckType').style.display = "none";
      }
      else if(radioValue=="Non-Delux")
      {
          document.getElementById('actype').style.display = "none";
          document.getElementById('deviceMdl').style.display = "block";
          document.getElementById('TruckType').style.display = "none";
      }
      else
      {
          document.getElementById('actype').style.display = "none";
          document.getElementById('deviceMdl').style.display = "none";
          document.getElementById('TruckType').style.display = "none";
      }


}

/*Start auto ajax value load code*/
var jq = $.noConflict();
jq(document).ready(function(){
    

});
/* End auto ajax value load code*/
</script>
<?php
$Header="Re-Installation";
$date=date("Y-m-d H:i:s");
$account_manager=$_SESSION['username'];
?>

<div class="top-bar">
  <h1><?php echo  $Header;?></h1>
</div>
<div class="table">

<?php


if(isset($_POST['submit']))
{ 
    //echo "<pre>";print_r($_POST);die;

    $date=date("Y-m-d H:i:s");
    $account_manager=$_SESSION['username'];
    $sales_person=trim($_POST['sales_person']);
    $sales_manager = select_query("select id as sales_id from sales_person where name='".$sales_person."' limit 1");
    $sales_person_id=$sales_manager[0]['sales_id'];
    $main_user_id=$_POST['main_user_id'];
    $company=$_POST['company'];
    $imei=$_POST['imei'];
    //print_r($imei);die();
    //$no_of_vehicals=$_POST['no_of_vehicals'];
    $no_of_vehicals=$_POST['no_of_installation'];
    $deviceStatus=$_POST['txtDeviceStatus'];
    $status=$_POST['status'];
    $deviceType=$_POST['deviceType'];
    //$location=$_POST['location'];
    $model=$_POST['model'];
    $accessories=$_POST['accessories'];
    $inter_branch_loc=$_POST['inter_branch_loc'];
    $cnumber=$_POST['cnumber'];
    $alt_cont_number=$_POST['acnumber'];
    $designation=$_POST['designation'];
    $contact_person=$_POST['contact_person'];
    $contact_number = $_POST['contact_number'];
    $atime_status=$_POST['atime_status'];
    $back_reason=$_POST['back_reason'];
    $branch_type = $_POST['inter_branch'];
    $instal_reinstall = "re_install";
    $accessories_tollkit = $_POST['accessories'];
    $veh_type = $_POST['veh_type'];


    $accessories_tollkit="";
   

    for($i=0;$i<count($_POST['accessories']);$i++)
    {
      $accessories_tollkit.=$_POST['accessories'][$i]."#";
      $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
    }

    // echo $accessories_tollkits; die;
    $veh_type=$_POST['veh_type'];
    $del_nodelux=$_POST['standard'];
    $actype=$_POST['actype'];
    $TruckType=$_POST['TruckType'];
    $TrailerType=$_POST['TrailerType'];
    $MachineType=$_POST['MachineType'];
    $billing = $_POST['billing'];
    //$delnoDelux = $_POST['delnoDelux'];
    $luxury = $_POST['lux'];
    //$acess_selection = $_POST['access_radio'];

    
    

    if($instal_reinstall == "re_install")
    {
        $installation_status=1;
    }
    
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
    }
    else{
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
              
              $sql="INSERT INTO installation_request(`req_date`, `request_by`, sales_person, `user_id`, `company_name`, no_of_vehicals, device_status, location,model,time, contact_number, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','".$no_of_vehicals."','".$status."','".$location."','".$model."', '".$time."', '".$contact_number."',1,'".$contact_person."','".$veh_type."','".$required."',
              '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
              '".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."')";
              
                 
      
               $execute=mysql_query($sql);

               $insert_id = mysql_insert_id();

              if($installation_status == 1)
              {
                //echo $no_of_vehicals;die;
                for($N=0;$N<$no_of_vehicals;$N++)
                { 
                    $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, device_imei, device_status, imei_status, location,model,time, contact_number,installed_date, status, contact_person, veh_type, required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, designation, device_type, alter_contact_no, accessories_tollkit, billing, TrailerType, TruckType, MachineType, actype, standard, alt_cont_person, alt_designation, acess_selection) VALUES('".$insert_id."','".$date."',
                    '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','".$no_of_vehicals."','".$imei[$N]."','".$status."','".$deviceStatus[$N]."','".$location."','".$model."','".$time."',
                    '".$contact_number."',now(),1,'".$contact_person[$N]."','".$veh_type."','".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."',
                    '".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation[$N]."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."')";

                   $execute_inst=mysql_query($installation);
                }

                //echo $installation; die;
              
             }
           
             header("location:installation.php");
      }
           
        if($atime_status=="Between")
        {
            $time=$_POST['time1'];
            $totime=$_POST['totime'];
           
            //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
             $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, device_status, location,model, 
             time,totime,contact_number, installed_date, status, contact_person, veh_type, 
             required,branch_id, installation_status,Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."',
             '".$no_of_vehicals."','".$location."','".$model."','".$time."','".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."','".$required."',
             '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
             '".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."')";
             //echo $sql; die;
             
                 
                   $execute=mysql_query($sql);
                   $insert_id = mysql_insert_id();   

                  if($installation_status == 1)
                  {

                      for($N=1;$N<=$no_of_vehicals;$N++)
                      {
                          $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`,no_of_vehicals,device_imei,device_status,imei_status, location,model,time, totime,contact_number,installed_date, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`,
                           branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection) VALUES('".$insert_id."','".$date."',
                           '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
                           '".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."'  ,
                           ".$required."','".$_SESSION['BranchId']."',
                           '".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."'
                           )";
                   
                          $execute_inst=mysql_query($installation);
                      }  
                      //echo $installation; die;   
                }
             header("location:installation.php");
        }
    }
}
?>


<script type="text/javascript">
var mode;

function deviceStatus(device){
  if(device > 0){
    document.getElementById("status").style.display="block";
  }
}
function req_info()
{
  
  
  if(document.form1.main_user_id.value=="")
  {
  alert("Please Select Client Name") ;
  document.form1.main_user_id.focus();
  return false;
  }

  if(document.form1.TxtSalesPersonName.value=="")
  {
	alert("Please Select Sales Person Name") ;
	document.form1.TxtSalesPersonName.focus();
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
        return false;
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
  //alert(radioValue)
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
    }
   
} 

function showAccess(radioValue)
{
  //alert(radioValue)
   if(radioValue=="yes")
    {
        document.getElementById('asd').style.display = "block";
    }
    else if(radioValue=="no")
    {
        document.getElementById('asd').style.display = "none";
    }
    else
    {
        document.getElementById('asd').style.display = "none";
    }
   
}
          

function StatusBranch12(radioValue)
{
  //alert(radioValue)
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation1').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
        //document.getElementById('samebranchid').style.display = "none";
    }
   
} 

function addRow(tableID)
    {
     
      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      //alert(rowCount);
      if(rowCount>1){
      alert("No more than 2 contact Details fills");
      return false;
    }
   

      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "text":
              newcell.childNodes[0].checked = false;
              break;
          
        }
      }
    
    }
function deleteRow(tableID) {
    try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
       // alert(rowCount); 
      
      if(rowCount <=1) {
        alert("Cannot delete all the rows.");
        return false;
      }
      if(rowCount > 1) {
        var row = table.rows[rowCount-1];
        //alert(row); 
        table.deleteRow(rowCount-1);
        // table.deleteRow(rowCount-2);
        // table.deleteRow(rowCount-3);
        rowCount = rowCount-3;
        rowCount--;
      }
    }
    catch(e) {
      alert(e);
    }
  } 

</script> 
  

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>
  
<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>
<style>
body { font-family:'Open Sans' Arial, Helvetica, sans-serif}
ul,li { margin:0; padding:0; list-style:none;}
.label { color:#000; font-size:16px;}
</style>

 <form method="post" action="" name="form1" onSubmit="return req_info();">
    <table style="padding-left: 100px;width: 600px;" cellspacing="5" cellpadding="5">
      <tr>
        <td align="right" nowrap> Client User Name:* </td>
        <td colspan="2">
          <select style="width:150px;" name="main_user_id" id="main_user_id"  onchange="showUser(this.value,'ajaxdata'); getCompanyName(this.value,'TxtCompany');
         getClientPrice(this.value,'mode_of_payment','device_price_client','rent_client','ModePay','AccPrice','AccRent');getSalesPersonName(this.value,'TxtSalesPersonName'); getdevicetype(this.value,'deviceType'); getdeletedImei(this.value,'deletedImei');" />
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
            <option value ="<?php echo $main_user_iddata[$u]['user_id'] ?>"  <?php echo $selected;?>> <?php echo $main_user_iddata[$u]['name']; ?> </option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right" nowrap>Billing:</td>
        <td colspan="2">
          <input type='radio' name ='billing' id='bill_no' value='No' checked="checked" />No 
        </td>
      </tr>
      <tr>
        <td  align="right" nowrap>Sales Person:*</td>
        <td colspan="2"><input style="width:146px" type="text" name="sales_person" id="TxtSalesPersonName" readonly /></td>
      </tr>
      <tr>
        <td  align="right" nowrap>Company Name:</td>
        <td colspan="2"><input style="width:146px" type="text" name="company" id="TxtCompany" readonly /></td>
      </tr>
      
      <tr>
        <td height="32" align="right">No. Of Installation:*</td>
        <td>
          <table>
            <tr>
              <td>
                <select name="no_of_installation" id="no_of_installation" style="width:150px">
                <option>-Select No. IMEI-</option>
                <?php for($i=1;$i<=20;$i++) { ?>  
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>  
                </select>
              </td>
              <td>
                <select name="status" id="status" style="width:150px;display:none" onchange="deviceImeiStatus(this.value)">
                  <option value="" selected>Select Device Status</option>
                  <option value="Deleted">Deleted</option>
                  <option value="Spare">Spare</option>
                </select>
              </td>
            </tr>
            <tbody id="textA"></tbody>
          </table>
        </td>
      </tr>

    <tr id="deviceTyp">
        <td height="32" align="right" nowrap>Device Type:*</td>
        <td colspan="2">
          <select name="deviceType" id="deviceType" style="width:150px" onchange="getModelName(this.value,'modelName');">
          
          </select>
        </td>
      </tr>

      <tr>
        <td height="32" align="right" nowrap>Model:*</td>
        <td colspan="2">
          <input style="width:146px" type="text" name="modelName" id="modelName" readonly />
        </td>
      </tr>



    <tr>
        <td align="right" nowrap>Accessories: </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='no' id='acc_yes' value= 'yes' <?php //if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="showAccess(this.value);">
          Yes
          <input type='radio' Name ='no' id='acc_no' value='no' onchange='showAccess(this.value);'>
          No 
        </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <table id="asd" style="display:none;">
        <tr>
          <td>
            <select name="accessories[]" multiple id="accessories" height="1" style="width:150px;margin-right:2000px;" >
             
              <?php
              $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
              //while($data=mysql_fetch_array($query)) 
              for($v=0;$v<count($accessory_data);$v++)
              {
              ?>
              <option value="<?php echo $accessory_data[$v]['id']?>" ><?php echo $accessory_data[$v]['access_name']?>
              </option>
              <?php } ?>
            </select>
          </td>
        </tr>
      </table>
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
              <td align="right" style="width: 41%;margin-right:-1px;">Branch Location:*</td>
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
                      <option value ="<?php echo $city1[$i]['branch_id'] ?>"  <?php echo $selected;?>> <?php echo $city1[$i]['city']; ?> </option>
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
        <td align="right" nowrap> Area:*</td>
        <td><input style="width:146px" type="text" name="Zone_area" id="Zone_area" value="<?php echo $area["name"];?>" />
          <div id="ajax_response"></div>
        </td>
      </tr>
      
     <tr>
        <td align="right" nowrap> LandMark:*</td>
        <td><input style="width:146px" type="text" name="location"  id="location" value="<?=$result['location']?>"/></td>
    </tr> 
      
      <tr>
        <td align="right" nowrap>Availbale Time status:*</td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <?php if($result['atime_status']=='Till') {?> selected="selected" <?php } ?> >Till</option>
            <option value="Between" <?php if($result['atime_status']=='Between') {?> selected="selected" <?php } ?> >Between</option>
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
        <td align="right" valign="top">Contact Details</td>
        <td style="margin-left:20px;">
          <table cellspacing="0" cellpadding="0">
            <tr>
              <td>
                  <INPUT type="button" value="+" id='addRowss' onClick="addRow('dataTable')" />
              </td>
              <td>
                  <INPUT type="button" value="-" id='delRowss' onClick="deleteRow('dataTable')" />
              </td>
            </tr>
          </table>
          <table id="dataTable" cellspacing="" cellpadding="">
          <tr>
            <td height="32" align="right">
              <select name="designation[]" id="designation" onchange="designationChange(this.value)" style="width:150px">
                <option value="" disable>Designation</option>
                <option value="driver" >Driver</option>
                <option value="supervisor" >Supervisoer</option>
                <option value="manager" >Manager</option>
                <option value="senior manager" >Senior Manager</option>
                <option value="owner">Owner</option>
                <option value="sale person">Sale Person</option>
                <option value="others">Others</option>
              </select>
            </td>
            <td>
              <input type="text" name="contact_person[]" id="contact_person"  placeholder="Contact Person" value="<?=$result['contact_person']?>" style="width:147px"/>
            </td>
            <td>
              <input type="text" name="contact_number[]" id="contact_number" placeholder="Contact Number"  value="<?=$result['contact_number']?>" style="width:147px"/>
            </td>       
          </tr>
        </table>

        </td>
      </tr>
      
      <tr>
        <td height="32" align="right">Vehicle Type:*</td>
        <td>
          <table>
      <tr>
        <td>
          <select name="veh_type" id="veh_type" style="width:150px" onchange="vehicleType(this.value,'standard');" >
            <option value="" selected disabled>Select your option</option>
            <option value="Car">Car</option>
            <option value="Bus">Bus</option>
            <option value="Truck">Truck</option>
            <option value="Bike">Bike</option>
            <option value="Trailer">Trailer</option>
            <option value="Tempo">Tempo</option>
            <option value="Machine">Machine</option>
          </select>
        </td>
        <td>
          <select name="TrailerType" id="TrailerType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select your category</option>
            <option value="Genset  AC Trailer">Genset  AC Trailer</option>
            <option value="Refrigerated Trailer">Refrigerated Trailer</option>
          </select>
        </td>
        <td>
          <select name="MachineType" id="MachineType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select Machine category</option>
            <option value="Vermeer Series-2">Vermeer Series-2</option>
            <option value="Ditch Witch">Ditch Witch</option>
            <option value="Halyma">Halyma</option>
            <option value="Drillto">Drillto</option>
            <option value="LCV">LCV</option>
            <option value="Oil Filtering Machine">Oil Filtering Machine</option>
            <option value="JCB">JCB</option>
            <option value="Sudhir Generator">Sudhir Generator</option>
            <option value="Container Loading Machine (Kony)">Container Loading Machine (Kony)</option>
          </select>
        </td>
        <td>
          <select name="standard" id="standard" palceholder="Vehicle Type" style="width:150px;display:none" onchange="standardType(this.value,'actype');" >
            <option value="" selected>Select Delux category</option>
            <option value="Delux">Delux</option>
            <option value="NonDelux">NonDelux</option>
          </select>
        </td>
          <td>
          <select name="lux" id="lux" style="width:150px;display:none" onchange="aclux();" >
            <option value="" selected>Select Luxury Category</option>
            <option value="luxury">Lurxury</option>
            <option value="NonLuxury">Non-Luxury</option>
          </select>
        </td>
        <td>
          <select name="TruckType" id="TruckType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select Truck Category</option>
            <option value="Refrigerated Truck">Refrigerated Truck</option>
            <option value="Pickup Van">Pickup Van</option>
          </select>
        </td>
        <td>
          <select name="actype" id="actype" style="width:150px;display:none" onchange="checkbox_lease();" >
            <option value="" disabled selected>Select AC Category</option>
            <option value="AC">AC</option>
            <option value="NonAC">Non-AC</option>
          </select>
        </td>
      </tr>
    </table>  

        </td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" id="button1" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
      </tr>
      
    </table>

  </form>
</div>
<?
include("../include/footer.php");

?>
<script>StatusBranch12("<?=$result['branch_type'];?>");TillBetweenTime12("<?=$result['atime_status'];?>");</script>
