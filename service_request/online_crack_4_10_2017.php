<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<link  href="<?php echo __SITE_URL;?>/css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo __SITE_URL;?>/js/Interbranchjquery.multiselect.css" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.css"/>
<script src="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.full.js"></script>

<script src="<?php echo __SITE_URL;?>/js/jquery.min.js"></script>
<!-- <script src="<?php echo __SITE_URL;?>/js/jquery.multiselect.js"></script> -->
<script type="text/javascript">

$(document).ready(function(){
    $("#hide").click(function(){
        $("#acn").hide();
    });
    $("#show").click(function(){
        $("#acn").show();
    });

});
function selectAllAccessory(source) {
    var checkboxes = document.getElementsByName('accessories[]');
    for(var i in checkboxes)
      checkboxes[i].checked = source.checked;
  }
  
  
  var counter = 1;
  
  function addRow(tableID) 
  {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
            
    if(rowCount>1)
    {
      alert("No more than 2 contact Details fills");
      return false;
    }
    
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    //console.log('colCount'+colCount2);
   //alert(colCount);
    
    
    for(var i=0; i<colCount; i++) 
    {

      var newcell = row.insertCell(i);
      
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
       //alert(newcell.innerHTML);
      //console.log('childnode'+newcell.childNodes[0]);
      //console.log(newcell.childNodes[0].type);
      switch(i) {
        case 0:
          newcell.childNodes[0].selectedIndex = 0;
          newcell.childNodes[0].id = 'designation' + counter ;  
    
          break;
        case 2:
         
          newcell.childNodes[0].id = 'contact_person' + counter ;
          //alert(newcell.childNodes[0].id);
          break;
        case 4:
          
          newcell.childNodes[0].id = 'contact_number' + counter ;
              //alert(newcell.childNodes[0].id);
          break;
      }
      
    }
    
    counter++;
  }
 // function deleteRow(tableID) {
 //      try {
 //      var table = document.getElementById(tableID);
 //      var rowCount = table.rows.length;

 //      for(var i=0; i<rowCount; i++) {
 //        var row = table.rows[i];
 //        var chkbox = row.cells[0].childNodes[0];
 //        if(null != chkbox && true == chkbox.checked) {
 //          if(rowCount <= 1) {
 //            alert("Cannot delete all the rows.");
 //            break;
 //          }
 //          table.deleteRow(i);
 //          rowCount--;
 //          i--;
 //        }


 //      }
 //      }catch(e) {
 //        alert(e);
 //      }
 //    }
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


// function addRow(tableID) 
//   {
//     document.getElementById('dataTable1').style.display = "block";
//   }

// function deleteRow(tableID) 
//   {
//     document.getElementById('dataTable1').style.display = "none";
//   }
function vehicleType(radioValue)
{
  // alert(radioValue)
   if(radioValue=="Bus")
    {
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('standard').style.display = "block";
        document.getElementById('lux').style.display = "none";
    }
    else if(radioValue=="Car")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "block";
    }
    else if(radioValue=="Tempo")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('actype').style.display = "block";
    }
    else if(radioValue=="Truck")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('TruckType').style.display = "block";
    }
    else if(radioValue=="Trailer")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('TrailerType').style.display = "block";
    }
    else if(radioValue=="Machine")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('MachineType').style.display = "block";
    }
    else if(radioValue=="Bike")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "none";
    }
    else
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        //document.getElementById('deviceMdl').style.display = "none";
    }
   
}

function standardType(radioValue)
{

   document.getElementById('actype').style.display = "block";

}
function aclux(radioValue)
{

  //alert(radioValue)
  
          document.getElementById('actype').style.display = "block";
          //document.getElementById('deviceMdl').style.display = "block";

}


/*Start auto ajax value load code*/
 var $s = jQuery.noConflict();
$s(document).ready(function(){
    $s(document).click(function(){
        $s("#ajax_response").fadeOut('slow');
    });
// var counter = 1;
// $s('#addRow').click(function () {
//  counter++;
//  if(counter>7)
//  {
//     alert("Maximum 7 Contact Details you choose ");
//  }
//  else
//  {
//     var newRow = jQuery('<tr><td height="32" align="right"><select><option>-- Select Designation --</option><option>Driver</option><option>supervisor</option><option>manager</option><option>senior manager</option><option>owner</option><option>sale person</option><option>others</option></select></td><td height="32" align="right">Contact Person:</td><td><input type="text" name="contact_person' +
//         counter + '" style="width:150px" /></td ><td height="32" align="right">Contact Person:</td><td> <input type="text" name="contact_number' +
//         counter + '" style="width:150px" /></td></tr>');
//       jQuery('#dataTable').append(newRow);
//   }
// });
//    $s('#delRow').click(function(){
//       //alert('tt');
//     //$s(this).closest('tr').remove();
// try {
//       var table = document.getElementById('dataTable');
//       //var user_id = document.getElementById('main_user_id').value;
//       var rowCount = table.rows.length;
//       //alert(rowCount);

//       for(var i=0; i<rowCount; i++) {
//         var row = table.rows[i];
//         var chkbox = row.cells[0].childNodes[0];
//         alert(chkbox);
//         if(null != chkbox && true == chkbox.checked) {
//           if(rowCount <= 1) {
//             alert("Cannot delete all the rows.");
//             break;
//           }
//           table.deleteRow(i);
//           rowCount--;
//           i--;
//         }


//       }
//       }catch(e) {
//         alert(e);
//       }

// });



    $s("#required").focus();

    var offset = $s("#Zone_area").offset();
    var width = $s("#Zone_area").width()-2;
    $s("#ajax_response").css("left",offset);
    $s("#ajax_response").css("width","15%");
    $s("#ajax_response").css("z-index","1");
    $s("#Zone_area").keyup(function(event){
         //alert(event.keyCode);
         var keyword = $s("#Zone_area").val();
         var city_id= $s("#inter_branch_loc").val();
         var inter_branch= $s("#inter_branch").val();
          //alert(inter_branch);
         if(city_id=='')
         {
            city_id=1;
         }
         //alert(city_id);
         if(keyword.length)
         {
             if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
             {
                 $s("#loading").css("visibility","visible");
                 $s.ajax({
                   type: "POST",
                   url: "load_zone_area.php",
                   data: "data="+keyword+"&city_id="+city_id,
                   success: function(msg){  
                  // alert(msg); 
                    if(msg != 0)
                      $s("#ajax_response").fadeIn("slow").html(msg);
                    else
                    {
                      $s("#ajax_response").fadeIn("slow");   
                      $s("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
                    }
                    $s("#loading").css("visibility","hidden");
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
                      $s("li").each(function(){
                         if($s(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $s("li[class='selected']");
                        sel.next().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $s("li:first").addClass("selected");
                     }
                 break;
                 case 38:
                 {
                      found = 0;
                      $s("li").each(function(){
                         if($s(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $s("li[class='selected']");
                        sel.prev().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $s("li:last").addClass("selected");
                 }
                 break;
                 case 13:
                    $s("#ajax_response").fadeOut("slow");
                    $s("#Zone_area").val($s("li[class='selected'] a").text());
                 break;
                }
             }
         }
         else
            $s("#ajax_response").fadeOut("slow");
    });
    $s("#ajax_response").mouseover(function(){
        $s(this).find("li a:first-child").mouseover(function () {
              $s(this).addClass("selected");
        });
        $s(this).find("li a:first-child").mouseout(function () {
              $s(this).removeClass("selected");
        });
        $s(this).find("li a:first-child").click(function () {
              $s("#Zone_area").val($s(this).text());
              $s("#ajax_response").fadeOut("slow");
        });
    });

     $s('.checkbox1').on('change', function() {
     var bool = $s('.checkbox1:checked').length === $s('.checkbox1').length;  
      $s('#acess_all').prop('checked', bool);       
       }); 
       $s('#acess_all').on('change', function() {    
       $s('.checkbox1').prop('checked', this.checked);      
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

    // $s('#accessories').multiselect({
    // columns: 1,
    // placeholder: 'Select Accessories',
    // search: true
    // });

     // $s('#acess_all').click(function(event) {
     //        if(this.checked) {
     //            // Iterate each checkbox
     //            $s('#accessories').each(function() {
     //                this.checked = true;
     //            });
     //        }
     //        else {
     //          $s('#accessories').each(function() {
     //                this.checked = false;
     //            });
     //        }
     //      });





});
/* End auto ajax value load code*/
</script>
<?php
$Header="Online Crack";

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
   //echo '<pre>'; print_r($_POST);die;
    //echo "<pre>";print_r($_POST);die;
    $date=date("Y-m-d H:i:s");
    $account_manager=$_SESSION['username'];
    $sales_person=trim($_POST['sales_person']);
    $sales_manager = select_query("select id as sales_id from sales_person where name='".$sales_person."' limit 1");
    $sales_person_id=$sales_manager[0]['sales_id'];
    $main_user_id=$_POST['main_user_id'];
    $company=$_POST['company'];
    $no_of_vehicals=$_POST['no_of_vehicals'];
    //$location=$_POST['location'];
    $model=$_POST['model'];
    $deviceType=$_POST['deviceType'];
    
    //$cnumber=$_POST['cnumber'];
     $designation=$_POST['designation'][0];
    $alt_designation=$_POST['designation'][1];
    $contact_person=$_POST['contact_person'][0];
    $alt_cont_person=$_POST['contact_person'][1];
    $contact_number=$_POST['contact_number'][0];
    $alt_cont_number=$_POST['contact_number'][1];
    $atime_status=$_POST['atime_status'];
    $back_reason=$_POST['back_reason'];
   
    $instal_reinstall = 'online_crack';
    //$instal_reinstall = 'installation';
    //$accessories_tollkit = $_POST['accessories'];
    //echo count($_POST['accessories']); die;
    $accessories_tollkit="";
    // for($i=0;$i<count($_POST['accessories']);$i++)
    // {
    //   $accessories_tollkit.=$_POST['accessories'][$i]."#";
    //   $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
    // }

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
  
    $acess_selection = $_POST['access_radio'];
    if($acess_selection='yes')
    {
      for($i=0;$i<count($_POST['accessories']);$i++)
      {
        $accessories_tollkit.=$_POST['accessories'][$i]."#";
        $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
      }
    }
   else
   {
      $accessories_tollkits="";
   }

    //$landmark=$_POST['landmark'];
    
    // if($bill=='yes')
    // {
    //   $billing=1;
    // }
    // else
    // {
    //   $billing=0;
    // }
     $branch_type = $_POST['inter_branch'];
    if($branch_type == "Samebranch" && $instal_reinstall == "installation")
    {
        $installation_status=8;
    }
    elseif($branch_type == "Interbranch" && $instal_reinstall == "installation")
    {
        $installation_status=8;
    }
    // elseif($instal_reinstall == "re_install")
    // {
    //     $installation_status=1;
    // }
    else
    {
        $installation_status=8;
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
       // $location="";
    }else{
        $city=0;
        //$location=$_POST['location'];
    }
    
    $location=$_POST['location'];
    $location1=$_POST['inter_branch'];
    $interbranch = $_POST['inter_branch_loc'];

    if($location1 == 'Interbranch'){
      $query = select_query("select city from tbl_city_name where branch_id='".$interbranch."'");
      $branchLocation = $query[0]['city'];
    }
    else{
      $branchLocation = "Delhi";
    }

    $required=$_POST['required'];
        if($required=="") { $required="normal"; }
       
        $datapullingtime=$_POST['datapullingtime'];
    if($errorMsg=="")   
    { 
      if($atime_status=="Till")
      {
      
               $time=date('Y-m-d H:i:s',strtotime($_POST['time']));  
               //echo $time; die;
              
              $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, 
              location,model,time, contact_number, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,landmark) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', 
              '".$company."','".$no_of_vehicals."','".$branchLocation."','".$model."','".$time."','".$contact_number."',1,'".$contact_person."','".$veh_type."','".$required."',
              '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
              '".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."','".$location."')";
              //echo $sql; die;
                 
      
               $execute=mysql_query($sql);
               $insert_id = mysql_insert_id();   
              if($installation_status == 1)
              {
                for($N=1;$N<=$no_of_vehicals;$N++)
                { 
                    $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
                    no_of_vehicals, location,model,time, contact_number,installed_date, status, contact_person, veh_type, required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, 
                    branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,landmark) VALUES('".$insert_id."','".$date."',
                    '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','1','".$branchLocation."','".$model."','".$time."',
                    '".$contact_number."',now(),1,'".$contact_person."','".$veh_type."','".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."',
                    '".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."','".$location."')";

                     //echo $sql; die;
                   
                    $execute_inst=mysql_query($installation);
                }
             }
           
             header("location:installation.php");
      }
           
        if($atime_status=="Between")
        {
            //$time=$_POST['time1'];
           // $totime=$_POST['totime'];
              $time=date('Y-m-d H:i:s',strtotime($_POST['time1']));  
                $totime=date('Y-m-d H:i:s',strtotime($_POST['totime']));  
           
            //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
             $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals,location,model, 
             time,totime,contact_number, installed_date, status, contact_person, veh_type, 
             required,branch_id, installation_status,Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,landmark) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."',
             '".$no_of_vehicals."','".$branchLocation."','".$model."','".$time."','".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."','".$required."',
             '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
             '".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."','".$location."')";
             //echo $sql; die;
             
                 
                   $execute=mysql_query($sql);
                   $insert_id = mysql_insert_id();   

                  if($installation_status == 1)
                  {

                      for($N=1;$N<=$no_of_vehicals;$N++)
                      {
                          $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, 
                          no_of_vehicals, location,model,time, totime,contact_number,installed_date, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`,
                           branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,landmark) VALUES('".$insert_id."','".$date."',
                           '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','1','".$branchLocation."','".$model."','".$time."',
                           '".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."'  ,
                           ".$required."','".$_SESSION['BranchId']."',
                           '".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."','".$location."'
                           )";
                   
                          $execute_inst=mysql_query($installation);
                      }  
                     // echo $installation; die;   
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
  
  // var instal_reinstall=document.forms["form1"]["instal_reinstall"].value;
  // if (instal_reinstall==null || instal_reinstall=="")
  // {
  // alert("Please Select Job") ;
  // return false;
  // }

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

  if(document.form1.sales_person.value=="")
  {
  alert("Please Select Sales Person Name") ;
  document.form1.sales_person.focus();
  return false;
  }
 
  if(document.form1.deviceType.value=="")
  {
        alert("Please Enter Model") ;
        document.form1.deviceType.focus();
        return false;
  }
  if(document.form1.model.value=="")
  {
        alert("Please Enter Model") ;
        document.form1.model.focus();
        return false;
  }
  var acc=document.forms["form1"]["acc"].value;
  if (acc==null || acc=="")
  {
      alert("Please Select Accessories Button") ;
      return false;
  }
  if(document.form1.access_radio.value == 'yes'){

  var accessories = document.getElementsByName("accessories[]");
  var acc_len = $('[name="accessories[]"]:checked').length;
    
    if(acc_len == '' || acc_len == '0')
    {
      alert('Please Select Atleast One Accessories'); 
      //document.form1.accessories.focus();
      return false; 
      
    } 

  }


  var inter_branch=document.forms["form1"]["inter_branch"].value;
  if (inter_branch==null || inter_branch=="")
  {
  alert("Please Select Branch Button") ;
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
    if (location==null || location=="")
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
      var inputTime = new Date(tilltime).getTime();  
      var time=(inputTime/(3600*1000));    
      var d = new Date(); 
      var n = d.getTime();       
      var currntTime4=(n/(3600*1000));     
      var diff=time-currntTime4;          
      if(diff<=3.80)   
      {  
          alert('Please enter 4 hour difference for available time');  
          document.form1.datetimepicker.focus();   
          return false;    
      }

 
    // var tilltime=document.forms["form1"]["datetimepicker"].value;
    // if(timestatus == "Till" && (tilltime==null || tilltime==""))
    // {
    //     alert("Please select Time");
    //     document.form1.datetimepicker.focus();
    //     return false;
    // }




  
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
    var inputTime = new Date(betweentime).getTime(); 
    var time=(inputTime/(3600*1000));
    var diff=time-currntTime4;          
    if(diff<=3.80)   
    {   
        alert('Please enter 4 hour difference for available time');     
        document.form1.datetimepicker1.focus();    
        return false;   
    }

    
   
  var Dtable = document.getElementById('dataTable');
  var DrowCount = Dtable.rows.length;
    //alert(DrowCount);
  for(var m=0; m<DrowCount; m++)
  {
    if(m == 0)
    {
      var fcounter = 0;
      var contact_person = 'contact_person';
      var contact_number = 'contact_number';
      var designation = 'designation';
    }
    else
    {
      var fTxtDeviceType = 'contact_person'+fcounter;
      var contact_number = 'contact_number'+fcounter;
      var designation = 'designation'+fcounter;
    }
    if(document.getElementById(designation).value=="")
    {
      alert("Please Select Designation.") ;
      document.getElementById(designation).focus();
      return false;
    }
    if(document.getElementById(contact_person).value=="")
    {
      alert("Please Write Contact Person Name.") ;
      document.getElementById(contact_person).focus();
      return false;
    }
    if(document.getElementById(contact_number).value=="")
    {
      alert("Please Write Contact Number") ;
      document.getElementById(contact_number).focus();
      return false;
    }
  }
    //return flase;
    if(document.form1.veh_type.value=="")
    {
        alert("Please Select Vehicle Type") ;
        document.form1.veh_type.focus();
        return false;
    }
   if(d.getHours() >= 18)
    {  
      if(d.getMinutes() > 00)      
      alert("Request raise only before 6 PM")   
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
        document.getElementById('accessTable').style.display = "block";
    }
    else if(radioValue=="no")
    {
        document.getElementById('accessTable').style.display = "none";
    }
    else
    {
        document.getElementById('accessTable').style.display = "none";
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
        document.getElementById('samebranchid').style.display = "none";
    }
   
}  

</script> 
  <!-- <script type="text/javascript">

        $(function () {
             
            $("#datetimepicker").datetimepicker({});
            $("#datetimepicker1").datetimepicker({});
            $("#datetimepicker2").datetimepicker({});
            $("#datetimepicker3").datetimepicker({});

           

        });

    </script>  -->

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

 <form method="post" action="" name="form1"   autocomplete="off" onSubmit="return req_info(); ">
    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td colspan="2"><input type="hidden" name="back_reason" id="back_reason" value="<?php echo $result['back_reason']?>"/></td>
      </tr>
      
  <!--   <tr>
        <td  align="right">Job:</td>

        <td><input type="radio" name="instal_reinstall"  value="installation" id="instal_reinstall" <?php if($result['instal_reinstall']=='installation') {echo "checked=\"checked\""; }?> />
          New
          <input type="radio" name="instal_reinstall" value="crack" id="instal_reinstall" <?php if($result['instal_reinstall']=='crack') {echo "checked=\"checked\""; }?> />
          Crack </td>
    </tr> -->
     <tr>
        <td align="right"> Client User Name:* </td>
          <td nowrap>
          <select style="width:150px;" name="main_user_id" id="main_user_id"  onchange="showUser(this.value,'ajaxdata'); getCompanyName(this.value,'TxtCompany');getSalesPersonName(this.value,'TxtSalesPersonName'); getdevicetype(this.value,'deviceType');" />
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
        <td  align="right">Billing: </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='billing' id='bill_yes' value='yes' <?php //if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> checked="checked">
          Yes
         <!--  <Input type='radio' Name ='billing' id='bill_no' value= 'no' <?php// if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>>
          No  -->
          &#160;&#160;&#160;&#160;&#160;&#160; Urgent:
       <input type="checkbox" name="required" id="required" value="urgent" <?php if($result['required']=='urgent') {?> checked="checked" <? }?> /></td>
          
      </tr>
       <tr>
        <td  align="right">Sales Person:*</td>
        <td><input type="text" name="sales_person" id="TxtSalesPersonName" readonly /></td>
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

    <tr id="deviceTyp">
        <td height="32" align="right">Device Type:*</td>
        <td>
          <select name="deviceType" value="" id="deviceType" style="width:150px" onchange="getModelName(this.value,'modelName');">
          
          </select>
        </td>
      </tr>

      <tr id="deviceMdl">
        <td height="32" align="right">Model:*</td>
        <td>
          <select name="model" id="modelName" style="width:150px">

          </select>
        </td>
    </tr>


    <tr>
        <td  align="right">Accessories:* </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='access_radio' id='acc' value= 'yes' <?php //if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="showAccess(this.value);">
          Yes
          <input type='radio' Name ='access_radio' id='acc' value= 'no' <?php// if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
          onchange="showAccess(this.value);">
          No 
        </td>
    </tr>

<!-- 
      <tr>
        <td></td>
        <td>
          <table  id="accessTable"  align="right"  style="width: 100%;display:none;border: 1px solid #000" cellspacing="5" cellpadding="5">
        </td>
      </tr>
 -->
     <!-- <tr>
        <td height="32" align="right"></td>
        <td><select name="accessories[]" multiple id="accessories" style="width:200px" onchange="();" >
            <option value="">Select Accessories</option>
            <?
            $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
            //while($data=mysql_fetch_array($query)) 
      for($v=0;$v<count($accessory_data);$v++)
      {
             ?>
            <option value="<?=$accessory_data[$v]['id']?>" ><?=$accessory_data[$v]['access_name']?>
            </option>
            <? } ?>
          </select></td>
      </tr>

      </table>
        </td>
      </tr> -->
 

      <tr>
        <td colspan="2">
          <table  id="accessTable"  align="right" style="height: 20em; width: 30em; overflow: auto;display:none;border:1px solid #000;" cellspacing="2" cellpadding="2">
          <td> <input type="checkbox" name="acess_all[]" id="acess_all" onClick="selectAllAccessory(this)"  style="width:150px;" /> Select All</td>
          <?
            $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
            //while($data=mysql_fetch_array($query)) 

          for($v=0;$v<count($accessory_data);$v++)
          {
            ?>
                <tr>

                
                  <td><input type="checkbox" name="accessories[]" id="accessories" class="checkbox1"  value="<?php echo $accessory_data[$v]['id']; ?>" style="width:150px;">
                  <?=$accessory_data[$v]['access_name']?></td>    
                </tr>
              <?php
               }
          ?>  
          
          </table>
        </td>
      </tr>



      <tr>
        <td  align="right">Branch:* </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='inter_branch' id='inter_branch' value= 'Samebranch' onchange="StatusBranch(this.value);" checked="checked">
          <?php echo $branch_data[0]["city"];?>
          <Input type='radio' Name ='inter_branch' id='inter_branch' value= 'Interbranch' 
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
        <td align="right"> LandMark:*</td>
        <td><input type="text" name="location"  id="location" value="<?=$result['location']?>" minlength="15"/></td>
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
          <table  id="TillTime" align="left" style="width:100%;display:none;margin-left:78px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">Time:*</td>
              <td><input type="text" name="time" id="datetimepicker" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
          </table>
        
          <table  id="BetweenTime" align="left" style="width:100%;display:none;margin-left:58px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">From Time:*</td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
            <tr>
              <td height="32" align="right">To Time:*</td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?=$result['totime']?>" style="width:147px"/></td>
            </tr>
          </table>
        </td>
      </tr>


     <table style="padding-left: 690px;width: 500px;" cellspacing="5" cellpadding="5">
        <tr>
          <td>
              <INPUT type="button" value="+" id='addRowss' onClick="addRow('dataTable')" />
        </td><td>
              <INPUT type="button" value="-" id='delRowss' onClick="deleteRow('dataTable')" />
          </td>
        </tr>
      </table>
      <table id="dataTable" style="padding-left: 100px;width:800px;" cellspacing="5" cellpadding="5">
       <tr>
            <td  height="32" align="right"><select name="designation[]" id="designation" style="width:150px"
            onchange="designationChange(this.value)">
                <option value="">-- Select Designation --</option>
                <option value="driver" >Driver</option>
                <option value="supervisor" >Supervisoer</option>
                <option value="manager" >Manager</option>
                <option value="senior manager" >Senior Manager</option>
                 <option value="owner">Owner</option>
                 <option value="sale person">Sale Person</option>
                 <option value="others">Others</option>
              
              </select>
            </td>
            <td height="32" align="right">Contact Person:*</td>
            <td><input type="text" name="contact_person[]" id="contact_person" value="<?=$result['contact_person']?>" style="width:147px"/>
            </td>

           <td height="32" align="right">Contact Number:*</td>
            <td><input type="text" name="contact_number[]" id="contact_number"  minlength="10" maxlength="10" value="<?=$result['contact_number']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
           </td>       
       </tr>

  </table>
  <!-- <table id="dataTable1" style="padding-left: 100px;width:800px; display:none" cellspacing="5" cellpadding="5">
       <tr>
            <td  height="32" align="right"><select name="designation1[]" id="designation1" style="width:150px"
            onchange="designationChange(this.value)">
                <option value="">-- Select Designation --</option>
                <option value="driver" >Driver</option>
                <option value="supervisor" >Supervisoer</option>
                <option value="manager" >Manager</option>
                <option value="senior manager" >Senior Manager</option>
                 <option value="owner">Owner</option>
                 <option value="sale person">Sale Person</option>
                 <option value="others">Others</option>
              
              </select>
            </td>
            <td height="32" align="right">Contact Person:*</td>
            <td><input type="text" name="contact_person1[]" id="contact_person1" value="<?=$result['contact_person']?>" style="width:147px"/>
            </td>

           <td height="32" align="right">Contact Number:*</td>
            <td><input type="text" name="contact_number1[]" id="contact_number1"  minlength="10" maxlength="10" value="<?=$result['contact_number']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
           </td>       
       </tr>

  </table>
 -->
  
      
    <table style=" padding-left: 140px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td height="32" align="right">Vehicle Type:*</td>
        <td>
          <select name="veh_type" id="veh_type" style="width:150px" onchange="vehicleType(this.value,'standard');" >
            <option value="" selected>Select your option</option>
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
         <!-- <td>
          <select name="delnoDelux" id="delnoDelux" palceholder="Vehicle Type" style="width:150px;display:none" onchange="LuxType(this.value,'actype');" >
            <option value="" selected>Select Luxury category</option>
            <option value="Luxury">Luxury</option>
            <option value="NonLuxury">Non Luxury</option>
          </select>
        </td> -->
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
<script type="text/javascript">
  
var logic = function( currentDateTime ){
  if (currentDateTime && currentDateTime.getDay() == 6){
    this.setOptions({
      minTime:'11:00'
    });
  }else
    this.setOptions({
      minTime:'8:00'
    });
};
$('#datetimepicker').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});
$('#datetimepicker1').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});

$('#datetimepicker2').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});


</script>
<script>StatusBranch12("<?=$result['branch_type'];?>");
TillBetweenTime12("<?=$result['atime_status'];?>");</script>
