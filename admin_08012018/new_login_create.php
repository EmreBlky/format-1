<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/


$Header="Create SSE Login";

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];

if($action=='edit')
    {
        $Header="Edit SSE Login";
        $result = select_query("SELECT * FROM servicelogin_user where id=$id");   
   
    }?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">
  <?php 
if(isset($_POST['submit']))
{
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email_id'];
    $branch = $_POST['branch_id'];
    $status = $_POST['status'];
   
    if($action=='edit')
    {
         $query = "UPDATE servicelogin_user SET    user_name ='".$username."',password ='".$password."',email ='".$email."' , isadmin ='".$status."',branch_id ='".$branch."'
        WHERE    id = '".$id."' ;";
       
     $execute = mysql_query($query);
     header("location:list_add_sse.php");

    }
    else
    {
   
         $query = "INSERT INTO servicelogin_user(`user_name`,`password`,`email`,`parent_id`,`isadmin`,`branch_id`) VALUES('".$username."','".$password."','".$email."','1','1','".$branch."')";
       
     $execute = mysql_query($query);
     header("location:list_add_sse.php");

    }
   
}

?>
  <script type="text/javascript">

function ValidatForm()
{
 
  if(document.form1.user_name.value=="")
  {
  alert("Please Enter User name") ;
  document.form1.user_name.focus();
  return false;
  }
  if(document.form1.password.value=="")
  {
  alert("Please Enter password") ;
  document.form1.password.focus();
  return false;
  }
  if(document.form1.email_id.value=="")
  {
  alert("Please Email Id") ;
  document.form1.email_id.focus();
  return false;
  }
  if(document.form1.branch_id.value=="")
  {
  alert("Please Select Branch") ;
  document.form1.branch_id.focus();
  return false;
  }

 
}

</script>
  <form method="post" action="" name="form1" onSubmit="return ValidatForm();">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td height="32" align="right">User Name:*</td>
        <td><input type="text" name="user_name" id="user_name" value="<?=$result[0]['user_name']?>" style="width:147px" /></td>
      </tr>
      <tr>
        <td height="32" align="right">Password:*</td>
        <td><input type="text" name="password" id="password" value="<?=$result[0]['password']?>" style="width:147px" /></td>
      </tr>
      <tr>
        <td height="32" align="right">Email Id:*</td>
        <td><input type="text" name="email_id" id="email_id" value="<?=$result[0]['email']?>" style="width:147px" /></td>
      </tr>
      <tr>
        <td height="32" align="right">Branch:*</td>
        <td><select name="branch_id" id="branch_id">
            <option value="">--Select Branch--</option>
            <?
                    $barnch_data = select_query("select id,branch_name from gtrac_branch where id not in(4,5) order by id asc");
                   
                    //while($barnch_data=mysql_fetch_array($barnch_query)) 
					for($j=0;$j<count($barnch_data);$j++)
					{
                     ?>
            <option value="<?=$barnch_data[$j]['id']?>"<? if($result[0]['branch_id']==$barnch_data[$j]['id']) {?> selected="selected" <? } ?> >
            <?=$barnch_data[$j]['branch_name']?>
            </option>
            <? } ?>
          </select>
      </tr>
      <?php if($action=='edit'){?>
      <tr>
        <td height="32" align="right">Status:*</td>
        <td><select name="status" id="status">
            <option value="">--Select Status--</option>
            <option value="1"<? if($result[0]['isadmin']==1) {?> selected="selected" <? } ?>>Active</option>
            <option value="0"<? if($result[0]['isadmin']==0) {?> selected="selected" <? } ?>>Deactive</option>
          </select>
      </tr>
      <?php } ?>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_add_sse.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?
include("../include/footer.php");

?>
