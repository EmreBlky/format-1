

<? 
$vehId=intval($_GET['name']);
$link = mysql_connect('gtracservicedb.db.5296103.hostedresource.com', 'gtracservicedb', 'eevPriyambada0'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gtracservicedb');
$query="SELECT veh_reg FROM vehicles WHERE user_id='$vehId'";
$result=mysql_query($query);

?>
<select name="vehicle[]" id="vehicle">
<option>Select Vehicle</option>


<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['veh_reg']?>><?=$row['veh_reg']?></option>
<? } ?>
</select>
