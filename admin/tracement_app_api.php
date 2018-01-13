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
        
        $login_query = select_query("SELECT * FROM login_user WHERE user_name='".$user_name."' and password='".$password."'");
        
        if(count($login_query)>0)
        {
              $rows=array();
              
                 $client_name = select_query("SELECT Userid, UserName, sys_parent_user, sys_active, Branch_id FROM addclient WHERE sys_active='1' AND sys_parent_user='1'");
              
              for($i=0;$i<count($client_name);$i++)
              {            
                      
                 $arr=array (
                   'Userid'=> $client_name[$i]["Userid"] ,
                   'UserName' => $client_name[$i]["UserName"],
                   'sys_parent_user' => $client_name[$i]["sys_parent_user"],
                   'sys_active' => $client_name[$i]["sys_active"],
                   'Branch_id' => $client_name[$i]["Branch_id"],                   
                   ) ;
                   
                   array_push($rows,$arr);
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
    
    echo json_encode($rows);
    
}
?>