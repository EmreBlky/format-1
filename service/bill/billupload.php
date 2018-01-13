<?php
include("include/header.inc.php");
include ("config.php");
//echo phpinfo();die();
 
$query="SELECT * FROM gtrac_branch";
$result=mysql_query($query);
	
	if(isset($_POST))
	{
$FolderName=$_POST["name"];
$allowedExts = array("zip", "rar", "ZIP", "RAR");
  $extension = end(explode(".", $_FILES["file"]["name"]));


//if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 20000) && in_array($extension, $allowedExts))
if ( 
in_array($extension, $allowedExts))
  {
$dir = __DOCUMENT_ROOT."bill/".$FolderName."/";
if (!file_exists($dir))
							{
							mkdir($dir, 0777);	
							chmod($dir, 0777);
							}

 
  if ($_FILES["file"]["error"] > 0)
    {
    $msg= "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists($$dir . $_FILES["file"]["name"]))
      {
      $msg= $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $dir . $_FILES["file"]["name"]);
      $msg= "Successfully uploaded ";
	  //Stored in: " . $dir . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  $msg=  "Invalid file";
  }
	}
?> 

<html>
<body>

<form action="" method="post" enctype="multipart/form-data">

<?if($msg!="")
{
echo " <p style='color:red;font-weight:bold'> ".$msg."</p>";
}?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

<tr>
<td width="24%" height="29" align="right" >Branch:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2"><select name="name" id="name"   style="width:150px">
<option value="0">Select Name</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['branch_name']?></option>
<? } ?>
</select>
</td>
</tr> 
<tr>
<td width="24%" height="29" align="right" >Filename:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td colspan="2"><input type="file" name="file" id="file"><br>
</td>
</tr> 

<tr>
<td width="24%" height="29" align="right" > </td>
<td colspan="2"><input type="submit" name="submit" value="Submit"><br>
</td>
</tr> 
</table>

 
</form>

</body>
</html> 
<?
include("include/footer.inc.php");

?>
