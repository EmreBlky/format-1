<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

$user_id=$_POST["main_user_id"];
$ext1='pancard.jpg';
$ext2='addproof.jpg';

 $file_name1=''.$user_id.'_'.$ext1;
 $file_name2=''.$user_id.'_'.$ext2;


?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <tr>
            <td>
                User Name</td>
            <td>

<select name="main_user_id" id="TxtMainUserId">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
			$main_user_id = select_query_live("SELECT id as user_id, sys_username as name FROM matrix.users where branch_id=".$_SESSION['BranchId']." order by name asc");
			//while ($data=mysql_fetch_assoc($main_user_id))
			for($i=0;$i<count($main_user_id);$i++)
					{
			?>
             <option name="main_user_id" value="<?=$main_user_id[$i]['name']?>" >
        <?php echo $main_user_id[$i]['name']; ?>				</option>
				  <?php 
								} 
 
  ?>
</select>                </td>
  </tr>
<input type="submit" name="file1" value="Pan Card" />
<input type="submit" name="file2" value ="Address Proof"/>
<input type="hidden" name="getfile" value =""/>
</form>

<?php if($_POST["file1"]){
 $filename=$file_name1;
echo '<a href="'.__SITE_URL.'/account/download.php?filename='.$filename.'"><b><strong><strong><strong>Download file!</strong></strong></strong></b></a>';
}
else if($_POST["file2"]){
 $filename=$file_name2;
echo '<a href="'.__SITE_URL.'/account/download.php?filename='.$filename.'"><b><strong><strong><strong>Download file!</strong></strong></strong></b></a>';
}
?>
