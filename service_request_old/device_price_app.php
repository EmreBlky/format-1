<?php
 include("../connection.php"); 
 
 $headers = apache_request_headers();

foreach ($headers as $header => $value) {
        if($header=="INTERNALGTRAC")
        {
                $httpHeader=$value;
        }
 }
if($httpHeader!="APIapiGTRACgtrac")
{
        die();
}



if($_POST)
{

    if(empty($_POST['user_name']) || empty($_POST['password']))
    {
        //echo "You did not fill out the Username and Password.";

        $result["status"] = false;
        $result["username"] = "";
        $result["BranchId"] = "";
        $result["message"] = "Username and Password should be filled";
        
    }
    else
    {
        $user_name = addslashes($_POST['user_name']);
        $password = addslashes($_POST['password']);
        $client_name = addslashes($_POST['client_name']);
        
        $login_query = select_query("SELECT * FROM login_user WHERE user_name='".$user_name."' and password='".$password."'");
        
        if(count($login_query)>0)
        {
              
              $device_result = select_query("SELECT id,device_price_total FROM new_account_creation where user_name='".$client_name."'");
              
              $rent_result = select_query_live_con("SELECT id,sys_username,price_per_unit FROM matrix.users where sys_username='".$client_name."'");
                           
              if($rent_result[0]["price_per_unit"] != '')
              {              
                  $result["device_price"] = $device_result[0]["device_price_total"];
                $result["rent_price"] = $rent_result[0]["price_per_unit"];
                $result["status"] = true;
              }
              else if($device_result[0]["device_price_total"] != '')
              {              
                  $result["device_price"] = $device_result[0]["device_price_total"];
                $result["rent_price"] = $rent_result[0]["price_per_unit"];
                $result["status"] = true;
              }
              else
              {
                $result["status"] = false;
                $result["message"] = 'No Data';                  
              }
                    
        
        }
        else
        {
            $result["status"] = false;
            $result["username"] = "";
            $result["BranchId"] = "";
            $result["message"]="Username and Password Not Valid";
        }
    }
    
    echo json_encode($result);
    
}
?>