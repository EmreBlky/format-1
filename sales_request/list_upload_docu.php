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

<form action="list_upload_docu.php" method="post" enctype="multipart/form-data" name="myForm">
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
		<td> Copy of Chasis No 2</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file2" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 3</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file3" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 4</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file4" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 5</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file5" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 6</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file6" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 7</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file7" type="file" />
		</tr>
		<tr>
		<td> Copy of Chasis No 8</td>
		<td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
     <input name="uploaded_file8" type="file" />
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
$file_ext1='chasisno1.jpg';
$file_ext2='chasisno2.jpg';
$file_ext3='chasisno3.jpg';
$file_ext4='chasisno4.jpg';
$file_ext5='chasisno5.jpg';
$file_ext6='chasisno6.jpg';
$file_ext7='chasisno7.jpg';
$file_ext8='chasisno8.jpg';

if((!empty($_FILES["uploaded_file1"])) && ($_FILES['uploaded_file1']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file1']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file1"]["type"] == "image/jpeg") || ($_FILES["uploaded_file1"]["type"] == "image/png") || ($_FILES["uploaded_file1"]["type"] == "image/gif")) &&
    ($_FILES["uploaded_file1"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext1;
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

//?heck that we have a file
if((!empty($_FILES["uploaded_file2"])) && ($_FILES['uploaded_file2']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file2']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file2"]["type"] == "image/jpeg") || ($_FILES["uploaded_file2"]["type"] == "image/png") || ($_FILES["uploaded_file2"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_2"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext2;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file2']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file2"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}


//?heck that we have a file
if((!empty($_FILES["uploaded_file3"])) && ($_FILES['uploaded_file3']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file3']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file3"]["type"] == "image/jpeg") || ($_FILES["uploaded_file3"]["type"] == "image/png") || ($_FILES["uploaded_file3"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_3"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext3;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file3']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file3"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//?heck that we have a file
if((!empty($_FILES["uploaded_file4"])) && ($_FILES['uploaded_file4']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file4']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file4"]["type"] == "image/jpeg") || ($_FILES["uploaded_file4"]["type"] == "image/png") || ($_FILES["uploaded_file4"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_4"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext4;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file4']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file4"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//?heck that we have a file
if((!empty($_FILES["uploaded_file5"])) && ($_FILES['uploaded_file5']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file5']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file5"]["type"] == "image/jpeg") || ($_FILES["uploaded_file5"]["type"] == "image/png") || ($_FILES["uploaded_file5"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_5"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext5;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file5']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file5"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//?heck that we have a file
if((!empty($_FILES["uploaded_file6"])) && ($_FILES['uploaded_file6']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file6']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file6"]["type"] == "image/jpeg") || ($_FILES["uploaded_file6"]["type"] == "image/png") || ($_FILES["uploaded_file6"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_6"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext6;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file6']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file6"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//?heck that we have a file
if((!empty($_FILES["uploaded_file7"])) && ($_FILES['uploaded_file7']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file7']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file7"]["type"] == "image/jpeg") || ($_FILES["uploaded_file7"]["type"] == "image/png") || ($_FILES["uploaded_file7"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_7"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext7;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file7']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file7"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}

//?heck that we have a file
if((!empty($_FILES["uploaded_file8"])) && ($_FILES['uploaded_file8']['error'] == 0)) {
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file8']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
 if ((($ext == "jpg") || ($ext == "png") || ($ext == "gif")) && (($_FILES["uploaded_file8"]["type"] == "image/jpeg") || ($_FILES["uploaded_file8"]["type"] == "image/png") || ($_FILES["uploaded_file8"]["type"] == "image/gif")) &&    ($_FILES["uploaded_file_8"]["size"] < 500000000)) {
    //Determine the path to which we want to save this file
      $newname = __DOCUMENT_ROOT.'/ChasisNo_Image/'.$user_name.'_'.$file_ext8;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file8']['tmp_name'],$newname))) {
           echo "It's done! The file has been saved as: ".$newname;
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file8"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .jpg images under 350Kb are accepted for upload";
  }
} else {
  "Error: No file uploaded";
}
?>