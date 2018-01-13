<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/

?> 

<div class="top-bar">
<h1>Add Topic</h1>
</div>
<div class="table"> 

<?

if(isset($_POST["submit"]))
{
  
	$req_date = date("Y-m-d H:i:s");
	$topic_name = $_POST["topic_name"];
	$admin_comment = $_POST["admin_comment"];
	

	$query="INSERT INTO `ad_rd_conversion` (`req_date`, `topic_name`,`admin_comment`, `status`) VALUES ('".$req_date."','".$topic_name."','".$admin_comment."','1')";
	
	
	mysql_query($query);
	echo "<script>document.location.href = 'list_rdconversion.php'</script>";
	
  
}
?>


 
<script type="text/javascript">
  function validateForm()
		{
			var topic_name=document.forms["myForm"]["topic_name"].value;
			if (topic_name==null || topic_name=="")
			  {
			  alert("Please Enter Topic Name");
			  return false;
			  }
			  
		   var comment=document.forms["myForm"]["admin_comment"].value;
			if (comment==null || comment=="")
			  {
			  alert("Please Enter Comment");
			  return false;
			  }
		}
			
 </script>

 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

         <tr>
            <td>Topic Name</td>
            <td><input type="text" name="topic_name" id="topic_name" value="" /></td>
        </tr>

		<tr>
            <td>Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="admin_comment" id="admin_comment" ></textarea></td>
        </tr> 
	
        <tr>
        	<td class="submit" colspan="2"><input type="submit" name="submit" id="button1" value="submit" onclick="return Check();"/>
				   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_rdconversion.php' " /></td>

        </tr>
    </table>
	
</form>
 
</div>  
<?php
include("../include/footer.php"); ?>
