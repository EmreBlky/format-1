<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_repair.php");*/
?> 
 
<div class="top-bar">
<h1>Show CSV File</h1>
</div>
<div class="table"> 

<?php
	
$path="L:/back usb drive/CoreDataAfterMarch/Pointer/14005/1692014";
//$path="C:/xampp/htdocs/format/repair/1592014";

if ($handle = @opendir($path) or die("Unable to open $path")) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'csv')
        {
            $thelist .= '<li>'.$file.'</li>';
        }
    }
    closedir($handle);
}
	

?>
<P>List of files:</p>
<ul>
	<P><? echo $thelist;?></p>
</ul>

</div>

<?
include("../include/footer.php");

?>
