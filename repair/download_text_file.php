<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
?> 
 
<div class="top-bar">
<h1>Download Text File</h1>
</div>
<div class="table"> 

<?
if(isset($_POST['submit']))
{  
	
	$timestamp = $_POST['date'];
	
	$d= date('d',strtotime($timestamp))/1;
	$m= date('m',strtotime($timestamp))/1;
	$y= date('Y',strtotime($timestamp))/1;
	$folder= $d.$m.$y;
	
	$imei = $_POST['imei_no'];
	$file=$imei.".csv";
	$file1 = $imei.".txt";
	$selecttype=$_POST['selecttype'];
	
	if($selecttype=='AEM')
	{
		$path="C:\ProcessingTest\AEM\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\AEM\\".$folder."\\".$file."";												
	     //$path = $folder."/".$file."";
		 //$path1 = $folder."/".$file1."";	
	}
	if($selecttype=='Argus')
	{
		$path="C:\ProcessingTest\Argus\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\Argus\\".$folder."\\".$file1."";	
	}
	if($selecttype=='Atlanta')
	{											 
	 
		$path="C:\ProcessingTest\Atlanta\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\Atlanta\\".$folder."\\".$file1."";
		//$path = $folder."/".$file."";
		//$path1 = $folder."/".$file1."";
		$time=@filemtime($path);
		$time1=@filemtime($path1);
		if($time=="" || $time1=="")
		{
			$path="C:\ProcessingTest\Atlanta\\".$folder."\\ ".$file."";
			$path1="C:\ProcessingTest\Atlanta\\".$folder."\\ ".$file1."";
			//$path = $folder."/ ".$file."";
			//$path1 = $folder."/ ".$file1."";
		}
	}
	if($selecttype=='atlanta_vts3mini')
	{
		$path="C:\ProcessingTest\atlanta_vts3mini\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\atlanta_vts3mini\\".$folder."\\".$file1."";
	}
	if($selecttype=='AVL')
	{
		$path="C:\ProcessingTest\AVL\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\AVL\\".$folder."\\".$file1."";
	}
	if($selecttype=='BSTPL')
	{
		$path="C:\ProcessingTest\BSTPL\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\BSTPL\\".$folder."\\".$file1."";
	}
	if($selecttype=='BSTPLBSTPLITG')
	{
		$path="C:\ProcessingTest\BSTPLBSTPLITG\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\BSTPLBSTPLITG\\".$folder."\\".$file1."";
	}
	if($selecttype=='EIT')
	{
		$path="C:\ProcessingTest\EIT\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\EIT\\".$folder."\\".$file1."";
	}
	if($selecttype=='FastTrac')
	{
		$path="C:\ProcessingTest\FastTrac\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\FastTrac\\".$folder."\\".$file1."";
	}
	if($selecttype=='fleeteye')
	{
		$path="C:\ProcessingTest\\fleeteye\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\\fleeteye\\".$folder."\\".$file1."";
	}
	if($selecttype=='fleeteyeBSTPLITG')
	{
		$path="C:\ProcessingTest\\fleeteyeBSTPLITG\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\\fleeteyeBSTPLITG\\".$folder."\\".$file1."";
	}
	if($selecttype=='GeoTracker')
	{
		$path="C:\ProcessingTest\GeoTracker\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\GeoTracker\\".$folder."\\".$file1."";
	}
	if($selecttype=='K10')
	{
		$path="C:\ProcessingTest\K10\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\K10\\".$folder."\\".$file1."";
	}
	if($selecttype=='pointer')
	{
		$path="L:\back usb drive\CoreDataAfterMarch\pointer\\".$folder."\\".$file."";
		$path1="L:\back usb drive\CoreDataAfterMarch\pointer\\".$folder."\\RawData_".$file1."";
	}
	if($selecttype=="Securitarian")
	{
		$path="C:\ProcessingTest\Securitarian\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\Securitarian\\".$folder."\\".$file1."";
	}
	if($selecttype=='TelTonika')
	{
		$path="C:\ProcessingTest\TelTonika\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\TelTonika\\".$folder."\\".$file1."";
	}
	if($selecttype=='TrakM8')
	{
		$path="C:\ProcessingTest\TrakM8\\".$folder."\\".$file."";
		$path1="C:\ProcessingTest\TrakM8\\".$folder."\\".$file1."";
	}
	
	if(!file_exists($path) && !file_exists($path1)){
?>
    <div style="float:right;font-weight:bold;color:#F00">
        <?php echo "I'm sorry, the file doesn't seem to exist.";?>
    </div>

<?php } 
	else{
?>
    <div style="float:right;font-weight:bold">
        <?php 
			   if(file_exists($path)){
				echo ' <a href="download_txt.php?filename='.$path.'" class="links">Download CSV File</a>';
			   }
			   if(file_exists($path1)){
				echo '<br/> <a href="download_txt.php?filename='.$path1.'" class="links">Download Text File</a>';
			   }
		?>
    </div>
<?php	
	}
}
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	var j = jQuery.noConflict();
	j(function() 
	{
		j( "#date" ).datepicker({ dateFormat: "yy-mm-dd" });
		
	});

</script>  


<form name="text_file" action="" method="post">
	<table border="0" cellpadding="2" cellspacing="5">    
       <tr>
       	<td colspan="5">&nbsp;</td>
       </tr>
        <tr>
        	<td>IMEI - </td>
            <td><input type="text" name="imei_no" id="imei_no" value="<?php echo $_POST["imei_no"]?>" /></td>
            <td><select name="selecttype">
                    <option id="AEM" value="AEM" <?php if($selecttype==AEM){ ?> selected="selected" <?php } ?>>AEM</option>
                    <option id="Argus" value="Argus" <?php if($selecttype==Argus){ ?> selected="selected" <?php } ?>>Argus</option>
                    <option id="Atlanta" value="Atlanta" <?php if($selecttype==Atlanta){ ?> selected="selected" <?php } ?>>Atlanta</option>
                    <option id="atlanta_vts3mini" value="atlanta_vts3mini" <?php if($selecttype==atlanta_vts3mini){ ?> selected="selected" <?php } ?>>Atlanta vts3 mini</option>
                    <option id="AVL" value="AVL" <?php if($selecttype==AVL){ ?> selected="selected" <?php } ?>>AVL</option>
                    <option id="BSTPL" value="BSTPL" <?php if($selecttype==BSTPL){ ?> selected="selected" <?php } ?>>BSTPL</option>
                    <option id="BSTPLBSTPLITG" value="BSTPLBSTPLITG" <?php if($selecttype==BSTPLBSTPLITG){ ?> selected="selected" <?php } ?>>BSTPLBSTPLITG</option>
                    <option id="EIT" value="EIT" <?php if($selecttype==EIT){ ?> selected="selected" <?php } ?>>EIT</option>
                    <option id="FastTrac" value="FastTrac" <?php if($selecttype==FastTrac){ ?> selected="selected" <?php } ?>>FastTrac</option>
                    <option id="fleeteye" value="fleeteye" <?php if($selecttype==fleeteye){ ?> selected="selected" <?php } ?>>Fleeteye</option>
                    <option id="fleeteyeBSTPLITG" value="fleeteyeBSTPLITG" <?php if($selecttype==fleeteyeBSTPLITG){ ?> selected="selected" <?php } ?>>Fleeteye BSTPLITG</option>
                    <option id="GeoTracker" value="GeoTracker" <?php if($selecttype==GeoTracker){ ?> selected="selected" <?php } ?>>GeoTracker</option>
                    <option id="K10" value="K10" <?php if($selecttype==K10){ ?> selected="selected" <?php } ?>>K10</option>
                    <option id="pointer" value="pointer" <?php if($selecttype==pointer){ ?> selected="selected" <?php } ?>>Pointer</option>
                    <option id="Securitarian" value="Securitarian" <?php if($selecttype==Securitarian){ ?> selected="selected" <?php } ?>>Securitarian</option>
                    <option id="TelTonika" value="TelTonika" <?php if($selecttype==TelTonika){ ?> selected="selected" <?php } ?>>TelTonika</option>
                    <option id="TrakM8" value="TrakM8" <?php if($selecttype==TrakM8){ ?> selected="selected" <?php } ?>>TrakM8</option>
                 </select>
             </td>
            <td> Date - </td>
            <td><input type="text" name="date" id="date" value="<?php echo  $_POST["date"]?>"/> </td>
            <td><input type="submit" name="submit" id="submit" value="submit" /></td>
        </tr>
    </table>
</form>
</div>

<?
include("../include/footer.php");

?>
