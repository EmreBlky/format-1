<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/

$user_name=$_POST["main_user_id"];
 ?> 

<div class="top-bar">
<h1>Upload Chasis No Images</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<form action="pdf.php" method="post" enctype="multipart/form-data" name="myForm">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
	  <tr>
            <td>
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
					{
			?>
            
             <option name="main_user_id" value="<?=$main_user_id[$u]['name']?>">
        <?php echo $main_user_id[$u]['name']; ?>				</option>
				  <?php 
								} 
 
  ?>
</select>                </td>
        </tr>
		<tr>
		<td> Copy of Chasis No 1</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file1" type="file" />
		</tr>
		
        <tr>
	   <td class="submit">
           <input id="Button1" type="submit" name="submit" value="submit" runat="server" />
		   </tr>
    </table>
	</form>
   </div>
 
<?php
include("../include/footer.php"); ?>

<?php
$file_ext2='.doc';


//?heck that we have a file
if((!empty($_FILES["uploaded_file1"])) && ($_FILES['uploaded_file1']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file1']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
   if ((($ext == "pdf") || ($ext == "doc") || ($ext == "xls")) && (($_FILES["uploaded_file1"]["type"] == "application/pdf") || ($_FILES["uploaded_file1"]["type"] == "application/doc") || ($_FILES["uploaded_file1"]["type"] == "application/excel")) &&
    ($_FILES["uploaded_file1"]["size"] < 50000000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/PDFExcel/'.$user_name.''.$file_ext2;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file1']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file1"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}
?>