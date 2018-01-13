<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');

$Header="Login Status";

$date=date("Y-m-d H:i:s");
$req_persion=$_SESSION['username'];
/*$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];*/

$support_query = select_query("select rfl.user_name, rfl.user_id, las.name
								from request_forward_list as rfl left join login_active_status as las
								on rfl.active_status=las.id
								where rfl.user_id='".$_SESSION['userId']."'");

?>

<div class="top-bar">
<h1><? echo $Header.' - '.$support_query[0]['name'];?></h1>
</div>
<div class="table"> 
<?
if(isset($_POST['submit']))
{
	$req_date = $_POST['req_date'];
	$req_persion = $_POST['req_persion'];
	$active_status = $_POST['active_status'];
	$reason = $_POST['reason'];
	
	if($active_status != '' && $reason != '')
	{
		
		$insert_data = array('req_date' => $req_date, 'request_by' => $req_persion, 'user_id' => $_SESSION['userId'], 
		'active_status_id' => $active_status, 'reason' => $reason);
		
		insert_query('internalsoftware.login_activety_log', $insert_data);
		
		$request_list = array('active_status' => $active_status);
		$condition = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition);
		
		echo "<script>document.location.href ='login_status_change.php'</script>";
	}
	else
	{
		$errorMsg = 'Status and Reason Fields Never Blank!';	
	}
}

?>

<?php echo "<p align='left' style='padding-left: 200px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>	

<form method="post" action="" name="form1" onSubmit="">

    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
		<tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="right">Request Date</td>
            <td>
              <input type="text" name="req_date" id="datepicker1" readonly value="<?php echo $date;?>" />
			  </td>
        </tr>

		<tr>
            <td align="right">Request By: </td>
            <td>
                <input type="text" name="req_persion" id="TxtAccManager" readonly value="<?php echo $req_persion;?>"/>
            </td>
        </tr>
        <tr>
            <td  align="right">Status:</td>
            <td>
            	<select name="active_status" id="active_status" style="width:49%;">
                 <option value="">Select Status</option>
                 <?php
				$login_status = select_query("select * from login_active_status where is_active='1'");
				
				for($i=0;$i<count($login_status);$i++)
				{
				?>            
				<option value ="<?php echo $login_status[$i]['id'] ?>"  <?echo $selected;?>>
				<?php echo $login_status[$i]['name']; ?>
				</option>
				<?php 
				} 
				
				?>
                
                </select>
            </td>
        </tr>
        
        <tr>
            <td  align="right">Reason:</td>
            <td>
                <textarea rows="5" cols="25"  type="text" name="reason" id="TxtReason" ><?php echo $result[0]['reason'];?></textarea>
            </td>
        </tr>
        <tr>
            <td height="32" align="right">
            	<input type="submit" name="submit" value="submit" align="right" />
             </td>
             <td>
             	<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'login_status_change.php' " />
             </td>
        </tr>


</table>


	</form>
   </div>

<?
include("../include/footer.inc.php");

?>
 

 
 