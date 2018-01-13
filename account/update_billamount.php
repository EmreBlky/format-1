<?php
include("../connection.php");

/*include($_SERVER["DOCUMENT_ROOT"]."/format/connection.php");*/

$id = $_GET['id'];
$sys_username = $_GET['user'];

if(isset($_POST['submit']))
{
    $key_pass = 'praveen@147258369';
    $key = $_POST['key'];
    $billing_ammount = $_POST['billing_ammount'];
   
    if($billing_ammount != '' && $key != '')
    {
   
        if($billing_ammount >= '10' && $billing_ammount < '5000')
        {   
            if($key == $key_pass)
            {
                $errorMsg = "";
            }
            else
            {
                $errorMsg = "Password Key Not Matched. Kindly check.";   
            }
        }
        else
        {
            $errorMsg = "Please select amount greater then 10 and Less then 5000.";   
        }
    }
    else
    {
        $errorMsg = "Please Enter Key & Amount Field.";   
    }
   
  if($errorMsg == "") 
 {
   //$query = "UPDATE matrix.users SET price_per_unit='".$billing_ammount."' WHERE id='".$id."'";
   //$rslt = mysql_query($query,$dblink);
   
    $data1 = array('price_per_unit' => $billing_ammount);
	$condition = array('id' => $id);

	update_query_live_con('matrix.users', $data1, $condition);
   
   //if($rslt) {
    $errorMsg = "Bill Updated Successfully.";
   //}
 }

}

?>
<?php echo "<p align='left' style='padding-left: 450px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

</head>

<body>

<form name="billing" action="" method="post">

    <table align="center" border="0" cellpadding="5" cellspacing="5">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Key : </td>
            <td><input type="password" name="key" id="key" value="" /></td>
        </tr>
        <tr>
            <td> Username :</td>
            <td><input type="text" name="user_name" id="user_name" value="<?=$sys_username;?>"/></td>
        </tr>
        <tr>
            <td> Amount :</td>
            <td><input type="text" name="billing_ammount" id="billing_ammount" value=""/></td>
        </tr>
        <tr>
            <td colspan="2" align="center"> <input type="submit" name="submit" id="submit" value="Submit"/></td>
        </tr>
    </table>
</form>

</body>
</html>