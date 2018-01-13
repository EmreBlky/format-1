 <?
 include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<div class="top-bar">
<h1> Check Data By IMEI</h1>
 
                </div>


<div style="padding-left:5px;padding-top:5px"> 
<script src="../../js/ajax.js"></script>
<?php //include('top-header.php'); ?>
<script>
function filetime(file,service_id){

	ajaxpage_get('filetime.php?qry=testimonials&file='+file+'&service_id='+service_id,'filetime','');


}
</script>
<?php
$username=trim($_POST['TxtImei']);

$searchtype=$_POST['searchtype'];
if($searchtype==""){
	$userCheck='  checked="checked"';
}
elseif($searchtype=="imei"){
	$imeiCheck='  checked="checked"';
}
elseif($searchtype=="user"){
	$userCheck='  checked="checked"';
}
?>
<script>
function submitme(){
//alert("hi");
if(document.getElementById('searchtype1').checked==true){
document.form1.action='debug.php';
}
document.form1.submit();
//document.form1.action='debug.php';
return false;
}
</script>
<form method="post" action="" onsubmit="return submitme();" name="form1">
  <input type="text" name="TxtImei" id="TxtImei" value="<?=$_POST['TxtImei'];?>" onkeyup="return countChar(this.value);">
<input type="radio" name="searchtype" id="searchtype2" value="imei"   checked="checked" style="display:none" />
<input type="submit" name="submit" value="submit">&nbsp;&nbsp;<!-- <a href='data-error-log/26-07-13.txt' target='_blank'>Last Vehcile Erros</a> -->
</form>
<br/><br/><br/><br/>

<?php
						
							if($searchtype!="imei"){
									if($username!=""){
										$userData=select_query_live("select id,phone_number from users where sys_username='".$username."'");
										$userId=$userData[0]['id'];
										$userPhoneNumber=$userData[0]['phone_number'];
									
									
									
											if($userId==""){
												$userId="2143";
											}
		
												$qry="select services.id,veh_reg,adddate(latest_telemetry.gps_time,INTERVAL 19800 second) as lastcontact,round(gps_speed*1.609,0) as speed,round(gps_orientation,1) as bearing,  case when tel_ignition=true then true else false end as aconoff , geo_street as street, geo_town as town,geo_country as country,veh_reg as reg, latest_telemetry.gps_latitude as lat,latest_telemetry.gps_longitude as lng ,devices.imei,mobile_simcards.mobile_no from services
												join latest_telemetry on latest_telemetry.sys_service_id=services.id
												join devices on devices.id=services.sys_device_id
												join mobile_simcards on mobile_simcards.id=devices.sys_simcard
												 where services.id in 
																(select distinct sys_service_id from group_services where active=true and sys_group_id in (
																select sys_group_id from group_users where sys_user_id=(".$userId.")))";
									
										$data=select_query_live($qry);
									
										echo "UserId= ".$userId."<br>";
										echo "Phone Number= ".$userPhoneNumber."<br>";
										echo "Total Vehicles :". count($data);
										maketablefordata($data);
									}
							}
							else{

								$imei=$username;
								if($imei!=""){
									CheckForImei($imei);
								
								}
							
							}
			

					function DateMysqlToTimestamp($md) {
							 $v = mktime ( substr($md, 11, 2) , substr($md, 14, 2), substr($md, 17, 2) , substr($md, 5, 2) , substr($md, 8, 2) , 
							substr($md, 0, 4)); 
							 return $v; 
					} 


function maketablefordata($data){

echo "<table border='1' width='100%'>";
		echo "<tr>";
		$tempdata=$data[0];
		foreach($tempdata as $key=>$value){
			echo "<td>";
			echo $key;
			echo "</td>";
		}
		echo "</tr>";

echo "</table>";
echo "<div style='height:500px;overflow:scroll;'>";
echo "<table width='100%'>";
	
for($dataCount=0;$dataCount<count($data);$dataCount++){

	?>
	<?php
							$hourDiff= (DateMysqlToTimestamp(date('Y-m-d H:i:s'))-DateMysqlToTimestamp($data[$dataCount]['lastcontact']))/3600;
							if($hourDiff>2){
								$hourDiff="<div style='color:#ffffff'><b>$hourDiff</b></div>";

															echo "<tr bgcolor=#00CCFF>";
							}
							else{
									echo "<tr bgcolor=#ECECF0>";
							}



?>


	<td>
	<?=$data[$dataCount]['id'];?>
	</td>
	<td>
	<?=$data[$dataCount]['veh_reg'];?>
	</td>
	<td>
	<?php echo $hourDiff; ?>
	<?=$data[$dataCount]['lastcontact'];?>
	</td>
	<td>
	<?=$data[$dataCount]['speed'];?>
	</td>
	<td>
	<?=$data[$dataCount]['bearing'];?>
	</td>
	<td>
	<?=$data[$dataCount]['aconoff'];?>
	</td>
	<td>
	<?=$data[$dataCount]['street'];?>
	</td>
	<td>
	<?=$data[$dataCount]['town'];?>
	</td>
	<td>
	<?=$data[$dataCount]['country'];?>
	</td>
	<td>
	<?=$data[$dataCount]['reg'];?>
	</td>
	<td>
	<?=$data[$dataCount]['lat'];?>
	</td>
	<td>
	<?=$data[$dataCount]['lng'];?>
	</td>
<!-- 	<td onclick="filetime('<?php echo $data[$dataCount]['imei'].".mtx"; ?>',<?php echo $data[$dataCount]['id']; ?>)"> -->
	<td>
	<?=$data[$dataCount]['imei'];?>
	</td>
	<td>
	<?=$data[$dataCount]['mobile_no'];?>
	</td>
	</tr>
	<?php
	
}
	return;


echo "</table>";	
echo "</div>";
}
						function CheckForImei($imei){
									$file=$imei.".csv";
									$file1=$imei.".txt";
							


		
											$i=0;
											while($i<4){

//												$folder=((date('d')/1)-$i).(date('m')/1).date('Y');

												$timestamp=DateMysqlToTimestamp(date('Y-m-d H:i:s'))-(86400)*($i);
												$d= date('d',$timestamp)/1;
												$m= date('m',$timestamp)/1;
												$y= date('Y',$timestamp)/1;
												$folder= $d.$m.$y;

												 
												

												
												$time=@filemtime($path);

												
															 										 
													 
														  $path="C:\ProcessingTest\\fleeteye\\".$folder."\\".$file."";
														$errorFileFolder="C:\ProcessingTest\\fleeteye\\";
														$time=@filemtime($path);
															 
														if($time==""){
															//echo "File Not Exists For ".((date('d')/1)-$i)."-".(date('m')/1)."-".date('Y');
															echo "File Not Exists For ".$d."-".$m."-".$y;
															echo "<br>";
															if($i==3){
																exit;
															}
														}
														else{
															 
															
															$errorFile=$errorFileFolder.$folder."\\InsertionFailedLog_".$imei.".txt"."";
															break;
														}
														$i++;

											}


//									$time=$time+19800;
									
									$time=date("Y/m/d H:i:s",$time);
									echo $tempHTML.= "File Modified Time=<b>".$time."</b><br>";

									$fp=fopen($path,'r');
 
									$filedatatext=fread($fp,filesize($path));

									$fp=@fopen($errorFile,'r');
									$errorFiledata=@fread($fp,filesize($path));
 
	
	$fp=fopen($path,'r');
 
      $filedata=fread($fp,filesize($path));
	  ?>

	 
<textarea cols="150" rows="20" wrap="hard"><?=$filedata?></textarea>

 
						<?}?>
						

 


</form>

</body>
</html>