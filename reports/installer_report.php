<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_report.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_report.php");*/

$query = select_query("select * from installer where is_delete=1 and branch_id=1 order by inst_name asc");

?>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();
j(function()
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });

j( "#ToDate" ).datepicker({ dateFormat: "yy-mm-dd" });

});

</script>
 

<div class="top-bar">
   
    <h1>Installer Report</h1>
     
</div>

<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">

    <tr>
        <td>
            <input type="radio" name="job" id="service" value="Service" <? if($_POST["job"]=="Service") echo "checked"?> />Service
            <input type="radio" name="job" id="installation" value="Installation" <? if($_POST["job"]=="Installation") echo "checked"?>/>Installation
        </td>
        <td><input type="submit" name="submit" value="Current"  /></td>
        <td><input type="submit" name="submit" value="Today"  /></td>
        <td><input type="submit" name="submit" value="Yesterday"  /></td>
    </tr>
 
</table>
</form>
</div>
<div class="table">
  
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
    <?php if($_POST["submit"] == "Current")
       { ?>
          <tr>
            <th>Sl No.</th>
            <th>Installer Name </th>
            <th>Client </th>
            <th>Location</th>
            <th>Installtion/Service Status</th>
        </tr>
      <?php } else { ?>
      <tr>
            <th>Sl No.</th>
            <th>Installer Name </th>
            <th>Client </th>
            <th>Location</th>
            <th>Installtion/Service Status</th>
            <th>Total</th>       
        </tr>
       <?php } ?>
    </thead>
    <tbody>
  
    <?php
    $i=1;
    $j=1;
    $k=1;
   //while($row=mysql_fetch_array($query))
   for($ins=0;$ins<count($query);$ins++)
    {
      $Inst_id=$query[$ins]['inst_id'];
     
     if($_POST["submit"] == "Current")
       {
                  $CurrentJobService = select_query("select installer.inst_id,installer.inst_name,services.id as id,services.company_name as company_name,services.user_id as user_id,services.service_status,services.request_by,services.Zone_area as Zone_area,services.job_type as job_type, re_city_spr_1.name as area,services.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join services on installer.inst_id=services.inst_id  left join re_city_spr_1 on services.Zone_area=re_city_spr_1.id left join zone on re_city_spr_1.id_region=zone.id WHERE services.job_type=1 AND services.inst_id=".$Inst_id." AND services.service_status=2 AND services.atime>='".date("Y-m-d")." 00:00:00' AND services.atime<='".date("Y-m-d")." 23:59:59' ORDER BY services.req_date DESC LIMIT 1");   
               
                //$CurrentJobService = mysql_fetch_array($currentservice);
                $countservice = count($CurrentJobService);
                               
                  $CurrentJobInstallation = select_query("select installer.inst_id,installer.inst_name,installation.id as id,installation.company_name as company_name,installation.user_id as user_id,installation.installation_status ,installation.request_by,installation.Zone_area as Zone_area,installation.job_type as job_type, re_city_spr_1.name as area,installation.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join installation on installer.inst_id=installation.inst_id  left join re_city_spr_1 on installation.Zone_area=re_city_spr_1.id  left join zone on re_city_spr_1.id_region=zone.id WHERE installation.job_type=1 AND installation.inst_id=".$Inst_id." AND installation.installation_status=2 AND installation.time>='".date("Y-m-d")." 00:00:00' AND installation.time<='".date("Y-m-d")." 23:59:59' ORDER BY installation.req_date DESC LIMIT 1");
               
                //$CurrentJobInstallation = mysql_fetch_array($CurrentInstallation);
                $CountInstallation = count($CurrentJobInstallation);

               
                if($countservice == 0 && $CountInstallation == 0)
                {
                    $CurrentJobService = select_query("select installer.inst_id,installer.inst_name,services.id as id,services.company_name as company_name,services.user_id as user_id,services.service_status,services.request_by,services.Zone_area as Zone_area,services.job_type as job_type, re_city_spr_1.name as area,services.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join services on installer.inst_id=services.inst_id  left join re_city_spr_1 on services.Zone_area=re_city_spr_1.id left join zone on re_city_spr_1.id_region=zone.id WHERE services.job_type=1 AND services.inst_id=".$Inst_id." AND services.service_status!=2 AND services.atime>='".date("Y-m-d")." 00:00:00' AND services.atime<='".date("Y-m-d")." 23:59:59' ORDER BY services.req_date DESC LIMIT 1");         
                }
               
                $user_name_ser = select_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='".$CurrentJobService[0]["user_id"]."'");
               
                if($CurrentJobService[0]["service_status"]=="3"  || $CurrentJobService[0]["service_status"]=="4")
                {
                    $service_status="Back to Service";
                }
                else if($CurrentJobService[0]["service_status"]=="5" || $CurrentJobService[0]["service_status"]=="6")
                {
                    $service_status="Closed Service";
                }
                else if($CurrentJobService[0]["service_status"]=="2")
                {
                    $service_status="Assigned Service";
                }
         
               
                if($CountInstallation == 0 && $countservice == 0)
                {
                    $CurrentInstallation = select_query("select installer.inst_id,installer.inst_name,installation.id as id,installation.company_name as company_name,installation.user_id as user_id,installation.installation_status ,installation.request_by,installation.Zone_area as Zone_area,installation.job_type as job_type, re_city_spr_1.name as area,installation.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join installation on installer.inst_id=installation.inst_id  left join re_city_spr_1 on installation.Zone_area=re_city_spr_1.id  left join zone on re_city_spr_1.id_region=zone.id WHERE installation.job_type=1 AND installation.inst_id=".$Inst_id." AND installation.installation_status!=2 AND installation.time>='".date("Y-m-d")." 00:00:00' AND installation.time<='".date("Y-m-d")." 23:59:59' ORDER BY installation.req_date DESC LIMIT 1");
                }
               
                $user_name_inst = select_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='".$CurrentJobInstallation[0]["user_id"]."'");
               
                if($CurrentJobInstallation[0]["installation_status"]=="3"  || $CurrentJobInstallation[0]["installation_status"]=="4")
                {
                    $inst_status="Back to Installation";
                }
                else if($CurrentJobInstallation[0]["installation_status"]=="5" || $CurrentJobInstallation[0]["installation_status"]=="6")
                {
                    $inst_status="Closed Installation";
                }
                else if($CurrentJobInstallation[0]["installation_status"]=="2")
                {
                    $inst_status="Assigned Installation";
                }
             
        if($CurrentJobService[0]['inst_name'] != "" || $CurrentJobInstallation[0]['inst_name'] != "" )
        {     
            if($CurrentJobInstallation[0]["user_id"] != "")
            {
    ?> 
        <tr align="Center" >
            <td><?php echo $j; ?></td>
            <td>&nbsp;<?php echo $CurrentJobInstallation[0]['inst_name'];?></td>
            <td>&nbsp;<?php if($CurrentJobInstallation[0]["company_name"] == ''){echo $user_name_inst[0]['sys_username'];}else{echo $CurrentJobInstallation[0]["company_name"];}?></td>   
            <td>&nbsp;<?php if($CurrentJobInstallation[0]["location"] != ""){echo $CurrentJobInstallation[0]["location"];}else {echo $CurrentJobInstallation[0]["area"];}?></td>
            <td>&nbsp;<?php echo $inst_status;?></td>
        </tr>
        <?php } else { ?>
        <tr align="Center" >
            <td><?php echo $j; ?></td>
            <td>&nbsp;<?php echo $CurrentJobService[0]['inst_name'];?></td>
            <td>&nbsp;<?php if($CurrentJobService[0]["company_name"] == ''){echo $user_name_ser[0]['sys_username'];}else{echo $CurrentJobService[0]["company_name"];}?></td>   
            <td>&nbsp;<?php if($CurrentJobService[0]["location"] != ""){echo $CurrentJobService[0]["location"];}else{echo $CurrentJobService[0]["area"];}?></td>
            <td>&nbsp;<?php echo $service_status; ?></td>
        </tr>
    <?php } $j++; }
      }
        if($_POST["submit"] == "Today")
       {
           if($_POST["job"]=="Service")
          {
                  $CurrentJobService = select_query("select installer.inst_id,installer.inst_name,services.id as id,services.company_name as company_name,services.user_id as user_id,services.service_status,services.request_by,services.Zone_area as Zone_area,services.job_type as job_type, re_city_spr_1.name as area,services.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join services on installer.inst_id=services.inst_id  left join re_city_spr_1 on services.Zone_area=re_city_spr_1.id left join zone on re_city_spr_1.id_region=zone.id WHERE services.inst_id=".$Inst_id." AND services.atime>='".date("Y-m-d")." 00:00:00' AND services.atime<='".date("Y-m-d")." 23:59:59' ORDER BY services.req_date DESC");         
               
              $company="";$location=""; $total=0;$installer_name="";$service_status="";
             
              //while($row_service = mysql_fetch_array($CurrentJobService))
			  for($jbs=0;$jbs<count($CurrentJobService);$jbs++)
              {
                  $user_name_ser = select_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='".$CurrentJobService[$jbs]["user_id"]."'");
                  if($CurrentJobService[$jbs]['company_name'] == "")
                  {
                    $company.= $user_name_ser[0]['sys_username']."</br>"; 
                  }
                  else
                  {
                      $company.= $CurrentJobService[$jbs]['company_name']."</br>";
                  }
                  if($CurrentJobService[$jbs]['location']!=""){
                      $location.= $CurrentJobService[$jbs]['location']."</br>";
                  } else {
                      $location.= $CurrentJobService[$jbs]['area']."</br>";
                  }
                  $installer_name = $CurrentJobService[$jbs]['inst_name'];
                  if($CurrentJobService[$jbs]["service_status"]=="3"  || $CurrentJobService[$jbs]["service_status"]=="4")
                    {
                        $service_status.="Back to Service"."</br>";
                    }
                    else if($CurrentJobService[$jbs]["service_status"]=="5" || $CurrentJobService[$jbs]["service_status"]=="6")
                    {
                        $service_status.="Closed Service"."</br>";
                    }
                    else if($CurrentJobService[$jbs]["service_status"]=="2")
                    {
                        $service_status.="Assigned Service"."</br>";
                    }
                  if($installer_name != "")
                  {
                      $total = $total+1;
                  }
              }
             
          }
          else
          {
                  $CurrentJobInstallation = select_query("select installer.inst_id,installer.inst_name,installation.id as id,installation.company_name as company_name,installation.user_id as user_id,installation.installation_status ,installation.installation_made,installation.Zone_area as Zone_area,installation.job_type as job_type, re_city_spr_1.name as area,installation.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join installation on installer.inst_id=installation.inst_id  left join re_city_spr_1 on installation.Zone_area=re_city_spr_1.id  left join zone on re_city_spr_1.id_region=zone.id WHERE installation.inst_id=".$Inst_id." AND installation.time>='".date("Y-m-d")." 00:00:00' AND installation.time<='".date("Y-m-d")." 23:59:59' ORDER BY installation.req_date DESC");
             
              $company="";$location="";    $total_inst="";$installer_name="";$inst_status= "";
             
             //while($row_installation = mysql_fetch_array($CurrentJobInstallation))
			 for($jbin=0;$jbin<count($CurrentJobInstallation);$jbin++)
              {
                  $user_name_inst = select_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='".$CurrentJobInstallation[$jbin]["user_id"]."'");
                  if($CurrentJobInstallation[$jbin]['company_name'] == "")
                  {
                    $company.= $user_name_inst[0]['sys_username']."</br>"; 
                  }
                  else
                  {
                    $company.= $CurrentJobInstallation[$jbin]['company_name']."</br>";
                  }
                  if($CurrentJobInstallation[$jbin]['location']!=""){
                      $location.= $CurrentJobInstallation[$jbin]['location']."</br>";
                  }else {
                      $location.= $CurrentJobInstallation[$jbin]['area']."</br>";
                  }
                  $total_inst.= $CurrentJobInstallation[$jbin]['installation_made']."</br>";
                  $installer_name = $CurrentJobInstallation[$jbin]['inst_name'];
                  if($CurrentJobInstallation[$jbin]["installation_status"]=="3"  || $CurrentJobInstallation[$jbin]["installation_status"]=="4")
                    {
                        $inst_status.="Back to Installation"."</br>";
                    }
                    else if($CurrentJobInstallation[$jbin]["installation_status"]=="5" || $CurrentJobInstallation[$jbin]["installation_status"]=="6")
                    {
                        $inst_status.="Closed Installation"."</br>";
                    }
                    else if($CurrentJobInstallation[$jbin]["installation_status"]=="2")
                    {
                        $inst_status.="Assigned Installation"."</br>";
                    }
                    else if($CurrentJobInstallation[$jbin]["installation_status"]=="1")
                    {
                        $inst_status.="Not Assigned Installation"."</br>";
                    }
              }
             
          }
     
    ?> 

<?php if($_POST["job"]=="Service")
      {
          if($installer_name != "" ){
    ?>
        <tr align="Center" >
            <td><?php  echo $k;?></td>
               <td>&nbsp;<?php echo $row['inst_name'];?></td>
            <td>&nbsp;<?php echo $company;?></td>   
            <td>&nbsp;<?php echo $location;?></td>
            <td>&nbsp;<?php echo $service_status;?></td>
            <td>&nbsp;<?php echo $total;?></td>
         </tr>
        <?php $k++; }
        }
        else {
             if($installer_name != "" ){
        ?>
        <tr align="Center" >
            <td><?php echo $k;?></td>
               <td>&nbsp;<?php echo $row['inst_name'];?></td>
            <td>&nbsp;<?php echo $company;?></td>
            <td>&nbsp;<?php echo $location;?></td>
            <td>&nbsp;<?php echo $inst_status;?></td>
            <td>&nbsp;<?php echo $total_inst;?></td>
         </tr>
        <?php $k++;} }?>       
   
   
<?php }
       
      if($_POST["submit"] == "Yesterday")
       {
          if($_POST["job"]=="Service")
          {
                  $YestJobService = select_query("select installer.inst_id,installer.inst_name,services.id as id,services.company_name as company_name,services.user_id as user_id,services.service_status,services.request_by,services.Zone_area as Zone_area,services.job_type as job_type, re_city_spr_1.name as area,services.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join services on installer.inst_id=services.inst_id  left join re_city_spr_1 on services.Zone_area=re_city_spr_1.id left join zone on re_city_spr_1.id_region=zone.id WHERE services.inst_id=".$Inst_id." AND services.atime>='".date("Y-m-d",strtotime('-1 days'))." 00:00:00' AND services.atime<='".date("Y-m-d",strtotime('-1 days'))." 23:59:59' ORDER BY services.req_date DESC");         
             
              $company="";$location="";$total=0;$yest_installer_name="";$yest_service_status="";
             
              //while($yest_row_service = mysql_fetch_array($YestJobService))
			  for($ys=0;$ys<count($YestJobService);$ys++)
              {
                  $user_name_ser = select_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='".$YestJobService[$ys]["user_id"]."'");
                  if($YestJobService[$ys]['company_name'] == "")
                  {
                    $company.= $user_name_ser[0]['sys_username']."</br>"; 
                  }
                  else
                  {
                      $company.= $YestJobService[$ys]['company_name']."</br>";
                  }
                  if($YestJobService[$ys]['location']!=""){
                    $location.= $YestJobService[$ys]['location']."</br>";
                  }else {
                      $location.= $YestJobService[$ys]['area']."</br>";
                  }
                  $yest_installer_name = $YestJobService[$ys]['inst_name'];
                  if($YestJobService[$ys]["service_status"]=="3"  || $YestJobService[$ys]["service_status"]=="4")
                    {
                        $yest_service_status.="Back to Service"."</br>";
                    }
                    else if($YestJobService[$ys]["service_status"]=="5" || $YestJobService[$ys]["service_status"]=="6")
                    {
                        $yest_service_status.="Closed Service"."</br>";
                    }
                    else if($YestJobService[$ys]["service_status"]=="2")
                    {
                        $yest_service_status.="Assigned Service"."</br>";
                    }
                  if($yest_installer_name != "" )
                  {
                      $total = $total+1;
                  }
              }
          }
          else
          {
                  $YestJobInstallation = select_query("select installer.inst_id,installer.inst_name,installation.id as id,installation.company_name as company_name,installation.user_id as user_id,installation.installation_status ,installation.installation_made,installation.Zone_area as Zone_area,installation.job_type as job_type, re_city_spr_1.name as area,installation.location as location,re_city_spr_1.id_region,zone.name as zone from installer  left join installation on installer.inst_id=installation.inst_id  left join re_city_spr_1 on installation.Zone_area=re_city_spr_1.id  left join zone on re_city_spr_1.id_region=zone.id WHERE installation.inst_id=".$Inst_id." AND installation.time>='".date("Y-m-d",strtotime('-1 days'))." 00:00:00' AND installation.time<='".date("Y-m-d",strtotime('-1 days'))." 23:59:59' ORDER BY installation.req_date DESC");
                 
              $company="";$location="";    $total_inst="";$yest_installer_name="";$yest_inst_status="";
             
             //while($YestJobInstallation[$yins] = mysql_fetch_array($YestJobInstallation))
			 for($yins=0;$yins<count($YestJobInstallation);$yins++)
              {
                  $user_name_inst = select_query("SELECT UserName AS sys_username FROM addclient WHERE Userid='".$YestJobInstallation[$yins]["user_id"]."'");
                  if($YestJobInstallation[$yins]['company_name'] == "")
                  {
                    $company.= $user_name_inst[0]['sys_username']."</br>"; 
                  }
                  else
                  {
                    $company.= $YestJobInstallation[$yins]['company_name']."</br>";
                  }
                  if($YestJobInstallation[$yins]['location']!=""){   
                    $location.= $YestJobInstallation[$yins]['location']."</br>";
                  }else{
                     $location.= $YestJobInstallation[$yins]['area']."</br>";
                  }
                  $total_inst.= $YestJobInstallation[$yins]['installation_made']."</br>";
                  $yest_installer_name = $YestJobInstallation[$yins]['inst_name'];
                  if($YestJobInstallation[$yins]["installation_status"]=="3"  || $YestJobInstallation[$yins]["installation_status"]=="4")
                    {
                        $yest_inst_status.="Back to Installation"."</br>";
                    }
                    else if($YestJobInstallation[$yins]["installation_status"]=="5" || $YestJobInstallation[$yins]["installation_status"]=="6")
                    {
                        $yest_inst_status.="Closed Installation"."</br>";
                    }
                    else if($YestJobInstallation[$yins]["installation_status"]=="2")
                    {
                        $yest_inst_status.="Assigned Installation"."</br>";
                    }
                    else if($YestJobInstallation[$yins]["installation_status"]=="1")
                    {
                        $yest_inst_status.="Not Assigned Installation"."</br>";
                    }
              }
          }
     
    ?> 

<?php if($_POST["job"]=="Service")
      {
          if($yest_installer_name != "" )
          {
    ?>
        <tr align="Center" >
            <td><?php echo $i; ?></td>       
             <td>&nbsp;<?php echo $row['inst_name'];?></td>
            <td>&nbsp;<?php echo $company;?></td>   
            <td>&nbsp;<?php echo $location;?></td>
            <td>&nbsp;<?php echo $yest_service_status;?></td>
            <td>&nbsp;<?php echo $total;?></td>
         </tr>
        <?php $i++;}
        }
        else
        {
            if($yest_installer_name != "" )
              {
        ?>
        <tr align="Center" >
            <td><?php echo $i; ?></td>       
              <td>&nbsp;<?php echo $row['inst_name'];?></td>
            <td>&nbsp;<?php echo $company;?></td>
            <td>&nbsp;<?php echo $location;?></td>
            <td>&nbsp;<?php echo $yest_inst_status;?></td>
            <td>&nbsp;<?php echo $total_inst;?></td>
        </tr>
        <?php $i++;} }?>       

<?php }           
    }
     
    ?>
</table>
    
   <div id="toPopup">
       
        <div class="close">close</div>
           <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup1" style ="height:100%;width:100%"> <!--your content start-->
           

 
        </div> <!--your content end-->
   
    </div> <!--toPopup end-->
   
    <div class="loader"></div>
       <div id="backgroundPopup"></div>
</div>
 
 
 
<?
include("../include/footer.php");

?>