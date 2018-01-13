<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");*/

if($_SESSION['user_name']=='saleslogin' || $_SESSION['user_name']=='asaleslogin' || $_SESSION['user_name']=='jsaleslogin' || $_SESSION['user_name']=='msaleslogin' || $_SESSION['user_name']=='ksaleslogin') 
{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
}
else{
	include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
	/*include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu.php");*/
}

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $result = select_query("select * from start_gps where id=$id");    
    }
?>

<div class="top-bar">
  <h1>Start GPS</h1>
</div>
<div class="table">
  <?

if(isset($_POST["submit"]))
{
  
    $date = $_POST["date"];
    $account_manager = $_POST["account_manager"];
    $main_user_id = $_POST["main_user_id"];
    $company = $_POST["company"];
    $tot_no_of_vehicles = $_POST["tot_no_of_vehicles"];
    $ps_of_location = $_POST["ps_of_location"];
    $ps_of_ownership = $_POST["ps_of_ownership"];
    $reason = $_POST["reason"];
    //$sales_action = $_POST["sales_action"]; 
    $sales_comment = $_POST["sales_comment"];
    $sales_manager=$_POST["sales_manager"];
    
    $tot_no_of_vehicles=(isset($_POST["tot_no_of_vehicles"])) ? trim($_POST["tot_no_of_vehicles"]): "";
    $number="";
    $no_of_start_gps_veh=0;
    for($j=0;$j<=$tot_no_of_vehicles;$j++)
        {
            if(isset($_POST[$j]))
                {
                $no_of_start_gps_veh++;
            $numbe1=(isset($_POST[$j])) ? trim($_POST[$j])  : "";
            $number .=$numbe1.",";
                }
        }
       $veh_num=substr($number,0,-1);

    if($number=="") {
    $veh_num_edit=$result[0]['reg_no'];
    }
    else {
    $veh_num_edit=$veh_num;
    }
    
    if($no_of_start_gps_veh=="") {
    $no_of_start_gps_veh_edit=$result[0]['start_no_of_vehicle'];
    }
    else {
    $no_of_start_gps_veh_edit=$no_of_start_gps_veh;
    }
 

if($action=='edit')
    {
    
         $query="update start_gps set acc_manager='".$account_manager."',sales_manager='".$sales_manager."',client='".$main_user_id."',company='".$company."',tot_no_of_vehicle='".$tot_no_of_vehicles."',start_no_of_vehicle='".$no_of_start_gps_veh_edit."',reg_no='".$veh_num_edit."',ps_of_ownership='".$ps_of_ownership."',reason='".$reason."',sales_comment='".$result[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$sales_comment."',start_gps_status=1 where id=$id";
 

        mysql_query($query);
        echo "<script>document.location.href ='list_start_gps.php'</script>";
    }
  else
  {

         $query="INSERT INTO `start_gps` (`date`, `acc_manager`,`sales_manager`, `client`,`company`, `tot_no_of_vehicle`, `start_no_of_vehicle`, `reg_no`, `ps_of_ownership`, `reason`) VALUES ('".$date."','".$account_manager."','".$sales_manager."','".$main_user_id."','".$company."','".$tot_no_of_vehicles."','".$no_of_start_gps_veh."','".$veh_num."','".$ps_of_ownership."','".$reason."')";
    
    
        mysql_query($query);
        echo "<script>document.location.href = 'list_start_gps.php'</script>";
    
  }
  
}
?>
  <script type="text/javascript">
  function validateForm()
        {
            var sales_manager=document.forms["myForm"]["sales_manager"].value;
            if (sales_manager==null || sales_manager=="")
              {
              alert("Please select Sales Person");
              return false;
              }
              
             var main_user_id=document.forms["myForm"]["TxtMainUserId"].value;
            if (main_user_id==null || main_user_id=="")
              {
              alert("Please select Client User Name");
              return false;
              }
              
             /* var main_user_id=document.forms["myForm"]["ps_of_location"].value;
            if (main_user_id==null || main_user_id=="")
              {
              alert("Enter Location");
              return false;
              }*/

              var Ownership=document.forms["myForm"]["TxtOwnerShip"].value;
            if (Ownership==null || Ownership=="")
              {
              alert("Enter Ownership");
              return false;
              }

              var reason=document.forms["myForm"]["TxtReason"].value;
            if (reason==null || reason=="")
              {
              alert("Enter Reason");
              return false;
              }

               var sales_action=document.forms["myForm"]["TxtSalesComment"].value;
            if (sales_action==null || sales_action=="")
              {
              alert("Enter sales Comment");
              return false;
              }
            }
            

function CheckUncheck(field){
    
    if(document.getElementById("all_check").checked == true){
        
             for (var i=0;i<field;i++) 
             {
                  document.getElementById(i).checked = true;
             }
      }
       else{
             for (var i=0;i<field;i++) 
             {
                  document.getElementById(i).checked = false;
             }
        }
}

    </script>
  <form name="myForm" action="" onsubmit="return validateForm()" method="post">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td>Date</td>
        <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:i:s")?>" /></td>
      </tr>
      <tr>
        <td>Request By</td>
        <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['user_name'];?>"/></td>
      </tr>
      <?php 
        //if($_SESSION['user_name']=='saleslogin') {
        ?>
      <tr>
        <td>Sales Manager</td>
        <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
            <?php
                $sales_manager = select_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
                //while ($data=mysql_fetch_assoc($sales_manager))
				for($i=0;$i<count($sales_manager);$i++)
                {
                ?>
            <option name="sales_manager" value="<?=$sales_manager[$i]['name']?>" <? if($result[0]['sales_manager']==$sales_manager[$i]['name']) {?> selected="selected" <? } ?> > <?php echo $sales_manager[$i]['name']; ?> </option>
            <?php 
                } 
                ?>
          </select></td>
      </tr>
      <?php //} ?>
      <tr>
        <td> Client User Name</td>
        <td><select name="main_user_id" id="TxtMainUserId"  onchange="showUser(this.value,'ajaxdata');gettotal_veh_byuser(this.value,'TxtTotalVehicle');getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
            $main_user_id = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
            //while ($data=mysql_fetch_assoc($main_user_id))
			for($u=0;$u<count($main_user_id);$u++)
                    {
            ?>
            <option name="main_user_id" value="<?=$main_user_id[$u]['user_id']?>" <? if($result[0]['client']==$main_user_id[$u]['user_id']) {?> selected="selected" <? } ?> > <?php echo $main_user_id[$u]['name']; ?> </option>
            <?php 
                                } 
         
          ?>
          </select></td>
      </tr>
      <tr>
        <td> Company Name</td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>" readonly /></td>
      </tr>
      <tr>
        <td> Total No Of Vehicle</td>
        <td><input type="value" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['tot_no_of_vehicle']?>"  readonly/></td>
      </tr>
      <tr>
        <td> Vehicle to Start GPS</td>
        <td><div id="ajaxdata">
            <?=$result[0]['reg_no']?>
          </div></td>
      </tr>
      <tr>
        <td><br />
          <h1>Present Status Of</h1></td>
        <br />
      </tr>
      <tr>
        <td class="style2"> OwnerShip</td>
        <td><select name="ps_of_ownership" id="TxtOwnerShip" >
            <option value="" name="ps_of_ownership" id="TxtOwnerShip">-- Select One --</option>
            <option value="Client Device" <? if($result[0]['ps_of_ownership']=='Client Device') {?> selected="selected" <? } ?> >Client Device</option>
            <option value="Gtrac Device" <? if($result[0]['ps_of_ownership']=='Gtrac Device') {?> selected="selected" <? } ?> >Gtrac Device</option>
          </select></td>
      </tr>
      <tr>
        <td class="style3"> Reason</td>
        <td><textarea rows="5" cols="25"  type="text" name="reason" id="TxtReason" ><?=$result[0]['reason']?>
</textarea></td>
      </tr>
      <?php 
        if($action=='edit') {
        ?>
      <tr>
        <td class="style2"> Sales Comment</td>
        <td><textarea rows="5" cols="25"  type="text" name="sales_comment" id="TxtSalesComment" ></textarea></td>
      </tr>
      <?php } ?>
      <tr>
        <td class="submit" colspan="2"><input type="submit" name="submit" id="button1" value="submit" onclick="return Check();"/>
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_start_gps.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php
include("../include/footer.php"); ?>
