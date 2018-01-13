<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");

include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/

   
   
    $id=$_GET['id'];
   
    $page=$_POST['page'];
   
   
   
    $result = select_query("select * from deactivation_of_account where id=$id");   
   
    $user_id = $result[0]["user_id"];
   
   
   
    $mysql_sim_query = select_query_live("SELECT services.id,veh_reg,devices.imei,mobile_simcards.mobile_no FROM matrix.services
   
    LEFT JOIN matrix.devices ON devices.id=services.sys_device_id LEFT JOIN matrix.mobile_simcards
   
    ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN
   
    (SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE AND sys_group_id IN
   
    (SELECT sys_group_id FROM matrix.group_users WHERE sys_user_id='".$user_id."'))") ;
   
   
   
    $ab = count($mysql_sim_query);
   
   

?>

<div class="top-bar">
  <h1>Deactivation of Sim</h1>
</div>
<div class="table">
  <?



$main_user= 'checked';

$separate = 'unchecked';

if(isset($_POST["submit"]))

{

    $date=$_POST["date"];

    $account_manager=$_POST["account_manager"];

    $sales_manager=$_POST["sales_manager"];

    $tot_no_of_sim=$_POST["tot_no_of_vehicles"]; 

    $company=$_POST["company"]; 

    $user_id = $result[0]["user_id"];

   

     $tot_no_of_sim=(isset($_POST["tot_no_of_vehicles"])) ? trim($_POST["tot_no_of_vehicles"]): "";

   

    //$number="";

    //$no_of_sim=0;

    for($j=0;$j<$ab;$j++)

        {

            if(isset($_POST[$j]))

                {

                //$no_of_sim++;

                $numbe1=(isset($_POST[$j])) ? trim($_POST[$j])  : "";

                $val = explode("-",$numbe1);

               

                $insert_query="INSERT INTO deactivate_sim (date,acc_manager,sales_manager,client, user_id, vehicle, device_imei, device_sim, reason,ps_of_ownership,approve_status) VALUES ('".$date."','".$account_manager."','".$sales_manager."','".$company."','".$user_id."','".$val[2]."','".$val[1]."','".$val[0]."','Deactivate Sim','client office','1')";

               

                mysql_query($insert_query);

               

                //print_r($val);

                //$number .=$numbe1.",";

                }

        }

          // $sim_num=substr($number,0,-1);

     

        

    $acc_query="update deactivation_of_account set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=$id";

 

    mysql_query($acc_query);

echo "<script>document.location.href ='list_deactivate_of_account.php'</script>";

   

 }



?>
  <script type="text/javascript">





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
        <td>Account Manager</td>
        <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?=$result[0]['acc_manager']?>"/></td>
      </tr>
      <tr>
        <td>Sales Manager</td>
        <td><input type="text" name="sales_manager" id="TxtSalesManager" readonly value="<?=$result[0]['sales_manager']?>"/></td>
      </tr>
      <tr>
        <td> Company Name</td>
        <td><input type="text" name="company" id="TxtCompany" value="<?=$result[0]['company']?>" readonly /></td>
      </tr>
      <tr>
        <td> Total No Of Vehicle</td>
        <td><input type="text" name="tot_no_of_vehicles" id="TxtTotalVehicle" value="<?=$result[0]['total_no_of_vehicles']?>" readonly /></td>
      </tr>
      <tr>
        <td> SIM to Deactivate</td>
        <td><table border="0" style="width:50%;">
            <tr>
              <td>All</td>
              <td><input type="checkbox" name="all_check" id="all_check" onchange="CheckUncheck(<?=$ab?>)" style="width=20px;"/></td>
            </tr>
            <tr>
              <?php //$i=0;

                    //while($row = mysql_fetch_array($mysql_sim_query))
                    for($j=0;$j<count($mysql_sim_query);$j++)
                    {

                        if($j%3==0) { ?>
            </tr>
            <tr>
              <?php } ?>
              <td><?php echo $mysql_sim_query[$j]['mobile_no']."->".$mysql_sim_query[$j]['imei'];?></td>
              <td><input type="checkbox" name="<?=$j?>" id="<?=$j?>" value="<?=$mysql_sim_query[$j]['mobile_no']."-".$mysql_sim_query[$j]['imei']."-".$mysql_sim_query[$j]['veh_reg'];?>" style="width=20px;"/></td>
              <?php } ?>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2" class="submit"><input type="submit" name="submit" id="button1" value="Submit"  />
          <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_deactivate_of_account.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<?php

include("../include/footer.php"); ?>