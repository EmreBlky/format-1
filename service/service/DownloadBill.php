<?
include("include/header.inc.php");
include ("config.php");
$FolderName=$_SESSION['branch_name'];
 
 $dir = __DOCUMENT_ROOT."bill/".$FolderName."/".strtolower(date("F", strtotime("-1 month")))."/";

 
$DownloadDir="http://gpsindelhi.com/service/bill/".$FolderName."/".strtolower(date("F", strtotime("-1 month")))."/";
$dh = opendir($dir);
 // $download= '<a class="orange" title="Dowload Bill" href="'.$DownloadDir.'">Download </a>';
 
while (($file = readdir($dh)) !== false) 
	{

if(strlen($file)>=5)
	{
  $download .= '<a class="orange" title="Dowload Bill" href="'.$DownloadDir.$file.'"> '.$file.' </a><br/><br/>';
}

 }

closedir($dh);
  


?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

 
<tr>
<td width="24%" height="29" align="right" ><b>Download Bill</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2"> <br>
</td>
</tr> 
 
<tr>
<td width="24%" height="29" align="right" ></td>

 <td colspan="3"><? echo $download;?><br>
</td>
</tr> 
</table>