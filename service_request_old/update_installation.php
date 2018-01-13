<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<link  href="../css/auto_dropdown.css" rel="stylesheet" type="text/css" />
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
<?
$Header="Edit Installation";
$account_manager=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $Header="Edit Installation";
        $result = select_query("select * from installation_request where id=$id and branch_id=".$_SESSION['BranchId']);   
       
        $Zone_area = $result[0]["Zone_area"];
        $area = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE id='".$Zone_area."'");
    }?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">
  <?
if(isset($_POST['submit']))
{
    $sales_person=$_POST['sales_person'];
    $main_user_id=$_POST['main_user_id'];
    $company=$_POST['company'];
    $model=$_POST['model'];
    $cnumber=$_POST['cnumber'];
    $contact_person=$_POST['contact_person'];
    $atime_status=$_POST['atime_status'];
    $comment=$_POST['comment'];
    $veh_type=$_POST['veh_type'];
    $immobilizer_type=$_POST['immobilizer_type'];
    $payment_req=$_POST['payment_req'];
    $dimts=$_POST['dimts'];
    if($dimts=="") { $dimts="no"; }
    $demo=$_POST['demo'];
    if($demo=="") { $demo="no"; }
    $required=$_POST['required'];
    if($required=="") { $required="normal"; }
    $IP_Box=$_POST['IP_Box'];
    $installation_status = $_POST['installation_status'];
   
    $fuel_sensor=$_POST['fuel_sensor'];
    $bonnet_sensor=$_POST['bonnet_sensor'];
    $rfid_reader=$_POST['rfid_reader'];
    $speed_alarm=$_POST['speed_alarm'];
    $door=$_POST['door'];
    $temperature=$_POST['temperature'];
    $duty_box=$_POST['duty_box'];
    $panic_button=$_POST['panic_button'];

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
   
   
    if($_POST['location'] == "")
    {
        $location="";
    }
    else
    {
        $location=$_POST['location'];
    }
   


    if($errorMsg=="")   
    {           
        if($atime_status=="Till")
        {
            $time=$_POST['time'];
           
            $sql="update installation_request set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."', atime_status='".$atime_status."', model='".$model."', contact_number='".$cnumber."' , contact_person='".$contact_person."',Zone_area='".$Area."', location='".$location."', dimts='".$dimts."',demo='".$demo."',veh_type='".$veh_type."', comment='".$comment."', immobilizer_type='".$immobilizer_type."',payment_req='".$payment_req."',required='".$required."',IP_Box='".$IP_Box."',fuel_sensor='".$fuel_sensor."',bonnet_sensor='".$bonnet_sensor."',rfid_reader='".$rfid_reader."',speed_alarm='".$speed_alarm."',door_lock_unlock='".$door."',temperature_sensor='".$temperature."',duty_box='".$duty_box."',panic_button='".$panic_button."' where id=$id";       
            $execute=mysql_query($sql);
           
            $installation=mysql_query("update installation set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',atime_status='".$atime_status."', model='".$model."', contact_number='".$cnumber."' ,contact_person='".$contact_person."',Zone_area='".$Area."', location='".$location."',  dimts='".$dimts."',demo='".$demo."',veh_type='".$veh_type."', comment='".$comment."', immobilizer_type='".$immobilizer_type."',payment_req='".$payment_req."',required='".$required."',IP_Box='".$IP_Box."',fuel_sensor='".$fuel_sensor."',bonnet_sensor='".$bonnet_sensor."',rfid_reader='".$rfid_reader."',speed_alarm='".$speed_alarm."',door_lock_unlock='".$door."',temperature_sensor='".$temperature."',duty_box='".$duty_box."',panic_button='".$panic_button."' where inst_req_id=$id");
                       
            /*echo "<script>document.location.href ='installation.php'</script>";*/
         }
         if($atime_status=="Between")
         {
            $time=$_POST['time1'];
            $totime=$_POST['totime'];
           
            $sql="update installation_request set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',totime='".$totime."',atime_status='".$atime_status."', model='".$model."', contact_number='".$cnumber."' ,contact_person='".$contact_person."',Zone_area='".$Area."', location='".$location."',  dimts='".$dimts."',demo='".$demo."',veh_type='".$veh_type."', comment='".$comment."', immobilizer_type='".$immobilizer_type."',payment_req='".$payment_req."',required='".$required."',IP_Box='".$IP_Box."',fuel_sensor='".$fuel_sensor."',bonnet_sensor='".$bonnet_sensor."',rfid_reader='".$rfid_reader."',speed_alarm='".$speed_alarm."',door_lock_unlock='".$door."',temperature_sensor='".$temperature."',duty_box='".$duty_box."',panic_button='".$panic_button."' where id=$id";       
            $execute=mysql_query($sql);
           
            $installation=mysql_query("update installation set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',totime='".$totime."',atime_status='".$atime_status."', model='".$model."', contact_number='".$cnumber."' ,contact_person='".$contact_person."',Zone_area='".$Area."', location='".$location."',  dimts='".$dimts."',demo='".$demo."',veh_type='".$veh_type."', comment='".$comment."', immobilizer_type='".$immobilizer_type."',payment_req='".$payment_req."',required='".$required."',IP_Box='".$IP_Box."',fuel_sensor='".$fuel_sensor."',bonnet_sensor='".$bonnet_sensor."',rfid_reader='".$rfid_reader."',speed_alarm='".$speed_alarm."',door_lock_unlock='".$door."',temperature_sensor='".$temperature."',duty_box='".$duty_box."',panic_button='".$panic_button."' where inst_req_id=$id");
           
            /*echo "<script>document.location.href ='installation.php'</script>";*/
          }
         
        if($installation_status == '7')
        {
            $update_query = mysql_query("update installation_request set installation_status=8 where id=$id");
            //$update_query = mysql_query("update installation set installation_status=1 where inst_req_id=$id");
        }
       
        echo "<script>document.location.href ='installation.php'</script>";
    }
   
}

?>
  <script type="text/javascript">

function req_info()
{
    if(document.form1.sales_person.value=="")
    {
    alert("Please Select sales person name") ;
    document.form1.sales_person.focus();
    return false;
    }
   
    if(document.form1.main_user_id.value=="")
    {
    alert("Please Select Client Name") ;
    document.form1.main_user_id.focus();
    return false;
    }
 
    if(document.form1.Zone_area.value=="")
    {
    alert("Please Select Area") ;
    document.form1.Zone_area.focus();
    return false;
    }
     
    /*var location=document.forms["form1"]["location"].value;
    if (location==null || location=="")
    {
        alert("Please Enter location");
        document.form1.location.focus();
        return false;
    }*/
      
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

function StatusBranch12(radioValue)
{
   if(radioValue=="Samebranch")
    {
        document.getElementById('samebranchid').style.display = "block";
    }
    else
    {
        document.getElementById('samebranchid').style.display = "none";
    }
   
}   
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
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      
      <!--<tr>
            <td align="right">Request By: * </td>
            <td>
                <input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $account_manager?>"/>
            </td>
        </tr>-->
      
      <tr>
        <td align="right">Required:</td>
        <td><input type="checkbox" name="required" id="required" value="urgent" <?php if($result[0]['required']=='urgent') {?> checked="checked" <? }?> />
          Urgent
          <input type="checkbox" name="IP_Box" id="IP_Box" value="required" <?php if($result[0]['IP_Box']=='required') {?> checked="checked" <? }?> />
          IP Box
          <input type="checkbox" name="dimts" id="dimts" value="yes" <?php if($result[0]['dimts']=="yes")echo "checked";?> />
          DIMTS </br>
          <?php if($_SESSION['BranchId'] == 1) { ?>
          <input type="checkbox" name="fuel_sensor" id="fuel_sensor" value="Yes" <?php if($result[0]['fuel_sensor']=='Yes') {?> checked="checked" <? }?> />
          Fuel Sensor
          <input type="checkbox" name="bonnet_sensor" id="bonnet_sensor" value="Yes" <?php if($result[0]['bonnet_sensor']=='Yes') {?> checked="checked" <? }?> />
          Bonnet Sensor </br>
          <input type="checkbox" name="rfid_reader" id="rfid_reader" value="Yes" <?php if($result[0]['rfid_reader']=="Yes")echo "checked";?> />
          RFID Reader
          <input type="checkbox" name="speed_alarm" id="speed_alarm" value="Yes" <?php if($result[0]['speed_alarm']=='Yes') {?> checked="checked" <? }?> />
          Speed Alarm </br>
          <input type="checkbox" name="door" id="door" value="Yes" <?php if($result[0]['door_lock_unlock']=='Yes') {?> checked="checked" <? }?> />
          Door lock/unlock circuit </br>
          <input type="checkbox" name="temperature" id="temperature" value="Yes" <?php if($result[0]['temperature_sensor']=="Yes")echo "checked";?> />
          Temperature Sensor </br>
          <input type="checkbox" name="duty_box" id="duty_box" value="Yes" <?php if($result[0]['duty_box']=='Yes') {?> checked="checked" <? }?> />
          Duty Box
          <input type="checkbox" name="panic_button" id="panic_button" value="Yes" <?php if($result[0]['panic_button']=="Yes")echo "checked";?> />
          Panic Button
          <?php } ?></td>
      </tr>
      <tr>
        <td height="32" align="right">Demo:*</td>
        <td><input type="checkbox" name="demo" id="demo" value="yes"  <? if($result[0]['demo']=="yes")echo "checked";?> />
          <input type="hidden" name="installation_status" id="installation_status" value="<?=$result[0]['installation_status']?>" /></td>
      </tr>
      <tr>
        <td align="right">Sales Person:*</td>
        <td><select name="sales_person" id="sales_person" style="width:150px">
            <option value="">Select Name</option>
            <?
            $sales_manager = select_query("select * from sales_person order by name asc");
            //while($data=mysql_fetch_array($query)) 
			for($s=0;$s<count($sales_manager);$s++)
			{
             ?>
            <option value="<?=$sales_manager[$s]['id']?>" <? if($result[0]['sales_person']==$sales_manager[$s]['id']) {?> selected="selected" <? } ?> >
            <?=$sales_manager[$s]['name']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
      <tr>
        <td  align="right"> Client User Name:*</td>
        <td><select name="main_user_id" id="main_user_id"  onchange="showUser(this.value,'ajaxdata'); getCompanyName(this.value,'TxtCompany');">
            <option value="" >-- Select One --</option>
            <?php
            $main_user_iddata = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
            //while ($data=mysql_fetch_assoc($main_user_iddata))
			for($u=0;$u<count($main_user_iddata);$u++)
            {
                if($main_user_iddata[$u]['user_id']==$result[0]['user_id'])
                {
                    $selected="selected";
                }
                else
                {
                    $selected="";
                }
            ?>
            <option   value ="<?php echo $main_user_iddata[$u]['user_id'] ?>"  <?echo $selected;?>> <?php echo $main_user_iddata[$u]['name']; ?> </option>
            <?php
            }
           
            ?>
          </select></td>
      </tr>
      <tr>
        <td  align="right"> Company Name:*</td>
        <td><input type="text" name="company" id="TxtCompany" readonly value="<?=$result[0]['company_name']?>"/></td>
      </tr>
      <tr>
        <td height="32" align="right">No. Of Vehicles:*</td>
        <td><?=$result[0]['no_of_vehicals']?></td>
      </tr>
      <tr>
        <td  align="right"> Area:*</td>
        <td><input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area["name"];?>" />
          <div id="ajax_response"></div></td>
      </tr>
      <!--<tr>
            <td  align="right">
                    Area:*</td>
            <td>
                <select name="Zone_area" id="Zone_area" >
                <option value="" >-- Select One --</option>
                <?php
                /*$main_city=mysql_query(" select id,name from re_city_spr_1 order by name asc");
                while($data=mysql_fetch_assoc($main_city))
                {
                    if($data['id']==$result[0]['Zone_area'])
                    {
                        $selected="selected";
                    }
                    else
                    {
                        $selected="";
                    }*/
                ?>
               
                <option value ="<?php //echo $data['id'] ?>"  <?echo $selected;?>>
                <?php //echo $data['name']; ?>
                </option>
                <?php
               // }
               
                ?>
                </select>
           
            </td>
        </tr>-->
      
      <tr>
        <td colspan="2"><table  id="samebranchid"  align="left"  style="padding-left:25px; width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td  align="right">Location:*</td>
              <td  ><input type="text" name="location"  id="location"   style="width:147px" value="<?=$result[0]['location']?>"/></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="32" align="right">Model:*</td>
        <td><select name="model" id="model" style="width:150px">
            <option value="">Select Model:*</option>
            <?
            $query = select_query("select * from device_model");
            //while($data=mysql_fetch_array($query)) 
			for($m=0;$m<count($query);$m++)
			{
             ?>
            <option value="<?=$query[$m]['device_model']?>" <? if($result[0]['model']==$query[$m]['device_model']) {?> selected="selected" <? } ?> >
            <?=$query[$m]['device_model']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
      <tr>
        <td align="right">Availbale Time status:*</td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <? if($result[0]['atime_status']=='Till') {?> selected="selected" <? } ?> >Till</option>
            <option value="Between" <? if($result[0]['atime_status']=='Between') {?> selected="selected" <? } ?> >Between</option>
          </select></td>
        <td colspan="2"><table  id="TillTime" align="left" style="width: 300px;display:none;border:1"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">Time:*</td>
              <td><input type="text" name="time" id="datetimepicker" value="<?=$result[0]['time']?>" style="width:147px"/></td>
            </tr>
          </table>
          <table  id="BetweenTime" align="left" style="width: 300px;display:none;border:1"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">From Time:*</td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?=$result[0]['time']?>" style="width:147px"/></td>
            </tr>
            <tr>
              <td height="32" align="right">To Time:*</td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?=$result[0]['totime']?>" style="width:147px"/></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="32" align="right">Contact No.:*</td>
        <td><input type="text" name="cnumber" value="<?=$result[0]['contact_number']?>" style="width:147px"/></td>
      </tr>
      <tr>
        <td height="32" align="right">Contact Person:*</td>
        <td><input type="text" name="contact_person" value="<?=$result[0]['contact_person']?>" style="width:147px"/></td>
      </tr>
      <tr>
        <td height="32" align="right">Vehicle Type:*</td>
        <td><select name="veh_type" id="veh_type" style="width:150px">
            <option value="">Select Vehicle Type:*</option>
            <?
        $query=mysql_query("select * from veh_type");
        while($data=mysql_fetch_array($query)) {
         ?>
            <option value="<?=$data['veh_type']?>" <? if($result[0]['veh_type']==$data['veh_type']) {?> selected="selected" <? } ?> >
            <?=$data['veh_type']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
      <tr>
        <td height="32" align="right">Comment:</td>
        <td><textarea rows="5" cols="25"  type="text" name="comment" id="TxtComment" ><?=$result[0]['comment']?>
</textarea></td>
      </tr>
      <tr>
        <td width="579" height="32" align="right">Immobilizer:*</td>
        <td width="721"><input type="radio" name="group1" value='immobilizer_type_yes' <? if($result[0]['immobilizer_type']!='')echo "checked";?> onClick="setVisibility('sub4', 'block');";>
          Yes
          <input type="radio" name="group1" value='immobilizer_type_no' <? if($result[0]['immobilizer_type']=='')echo "checked";?> onClick="setVisibility('sub4', 'none');";>
          No </td>
      </tr>
      <tr>
        <td colspan="2"><table  id="sub4"  align="left"  style="padding-left:25px; width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td  align="right">Immobilizer Type*</td>
              <td><select name="immobilizer_type" id="immobilizer_type">
                  <option value="">Select Type</option>
                  <option value="12V"<? if($result[0]['immobilizer_type']=="12V")echo "selected"?>>12V</option>
                  <option value="24V" <? if($result[0]['immobilizer_type']=="24V")echo "selected"?>>24V</option>
                </select></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td ><div align="right">Payment:*</div></td>
        <td  ><input type="radio" name="group2" value='payment_req_yes' <? if($result[0]['payment_req']!='')echo "checked";?>  onClick="setVisibility('sub3', 'block');";>
          Yes
          <input type="radio" name="group2" value='payment_req_no' <? if($result[0]['payment_req']=='')echo "checked";?>   onClick="setVisibility('sub3', 'none');";>
          No </td>
      </tr>
      <tr>
        <td colspan="2"><table  id="sub3"  align="left"  style="padding-left:25px; width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
            <tr>
              <td  align="right">Amount*:</td>
              <td  ><input type="text" name="payment_req" maxlength="500" value="<?php echo$result[0][0]['payment_req'];?>" /></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" value="Update" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?
include("../include/footer.php");

?>
<script>StatusBranch12("<?=$result[0]['branch_type'];?>");TillBetweenTime12("<?=$result[0]['atime_status'];?>");</script>