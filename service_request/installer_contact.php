<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$result = select_query("select * from installer where inst_id=$id");	
	}
?> 

<div class="top-bar">
<h1>Installer Form</h1>
</div>
<div class="table"> 
<?php


if(isset($_POST["submit"]))
{ 
$date=$_POST["date"];
$installerName=$_POST["installer_name"];
$address=$_POST["TxtAddress"];
$email=$_POST["TxtEmail"];
$Installermobile=$_POST["Installermobile"]; 
$Branch=$_POST["Branch"];

 if($action=='edit')
	{
	
 $query="update installer set inst_name='".$installerName."',address='".$address."',email='".$email."',installer_mobile='".$Installermobile."',branch_id='".$Branch."',created_date='".$date."' where id=$id";
 
 
 
  mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_installer.php'</script>";
}

 else {
 
  
 
   $query="INSERT INTO `installer` (`inst_name`, `address`, `email`, `installer_mobile`, `branch_id`, `created_date`) VALUES('".$installerName."','".$address."','".$email."','".$Installermobile."','".$Branch."','".$date."')";
 
 
 mysql_query($query);
//echo "record saved";
 echo "<script>document.location.href ='list_installer.php'</script>";
}
}

?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	  <script>

function validateForm()
{
 
 
  if(document.myForm.Txtinstallername.value=="")
  {
  alert("please Enter Installer Name") ;
  document.myForm.Txtinstallername.focus();
  return false;
  }  
   if(document.myForm.TxtAddress.value=="")
  {
  alert("please Enter Address") ;
  document.myForm.TxtAddress.focus();
  return false;
  }  
 if(document.myForm.TxtEmail.value=="")
  {
  alert("please Enter E-mail") ;
  document.myForm.TxtEmail.focus();
  return false;
  }
  if(document.myForm.Installermobile.value=="")
  {
  alert("please Enter Installer Number") ;
  document.myForm.Installermobile.focus();
  return false;
  }
   var Installermobile=document.myForm.Installermobile.value;
  if(Installermobile!="")
        {
	var length=Installermobile.length;
	
        if(length < 9 || length > 15 || Installermobile.search(/[^0-9\-()+]/g) != -1 )
        {
        alert('Please enter valid mobile number');
        document.myForm.Installermobile.focus();
        document.myForm.Installermobile.value="";
        return false;
        }
        }
  if(document.myForm.Branch.value=="")
  {
  alert("please Choose Branch") ;
  document.myForm.Branch.focus();
  return false;
  }
  
			} 

      </script> 
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

   <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

         <p>&nbsp;</p>
         <tr>
            <td>Date</td>
            <td>
                <input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
        </tr>

		<td>
        Installername Name</td>
        <td>
          <input type="text" name="installer_name" id="Txtinstallername" value="<?=$result[0]['inst_name']?>"/>
        </td>
        </tr>
        
        
        <tr>
        <td>
       Address</td>
        <td><textarea rows="5" cols="20"  type="text" name="TxtAddress" id="TxtAddress" ><?=$result[0]['address']?></textarea>
        </td>
        </tr>
       
        <tr>
        <td>
        Email</td>
		<td>
        <input type="text" name="TxtEmail" id="TxtEmail" value="<?=$result[0]['email']?>"/></td>
        </tr>
        
        <tr>
        <td>
        Installer Contact Number</td>
        <td>
        <input type="text" name="Installermobile" id="Installermobile" value="<?=$result[0]['installer_mobile']?>"/></td>
        </tr>
       
        
            <tr>
            <td>
            <label for="Branch" id="Branch">Branch</label></td>
            <td>
            <select name="Branch" id="Branch">
            <option value="" >-- Select One --</option>
            <?php
            $branch=mysql_query("SELECT * FROM gtrac_branch");
            //while ($data=mysql_fetch_assoc($main_user_id))
			for($i=0;$i<count($branch);$i++)
            {
            ?>
            
            <option name="main_user_id" value="<?=$branch[$i]['id']?>" <? if($result[0]['branch_id']==$branch[$i]['id']) {?> selected="selected" <? } ?> >
        <?php echo $branch[$i]['branch_name']; ?>
        </option>
            <?php 
            } 
            
            ?>
            </select></td>
            </tr>
            <tr>
           
             
            
    <tr><td colspan="2" align="center"> <input type="submit" name="submit" value="submit"  /></td></tr>

     
  </form>
</div>
 
<?php
include("../include/footer.php"); ?>
