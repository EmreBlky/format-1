<?php
 include("../connection.php"); 
 
 $headers = apache_request_headers();

foreach ($headers as $header => $value) {
        if($header=="INTERNALTRACEMATE")
        {
                $httpHeader=$value;
        }
 }
if($httpHeader!="APIapiTRACEMATE")
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
        $result["parent_id"] = "";
        $result["track_id"] = "";
        $result["message"] = "Username and Password should be filled";
        
    }
    else
    {
        $user_name = addslashes($_POST['user_name']);
        $password = addslashes($_POST['password']);
        
        $login_query = select_query("SELECT * FROM login_user WHERE user_name='".$user_name."' and password='".$password."' ");
        
        if(count($login_query)>0)
        {
            $result["status"]=true;
            $result["username"] = $login_query[0]["user_name"];
            $result["BranchId"] = $login_query[0]["branch_id"];
            $result["parent_id"] = $login_query[0]["parent_id"];
            $result["track_id"] = $login_query[0]["id"];
            $result["message"]="Username or password is correct";
            //print_r($dbselect);
        
        }
        else
        {
            $result["status"] = false;
            $result["username"] = "";
            $result["BranchId"] = "";
            $result["parent_id"] = "";
            $result["track_id"] = "";
            $result["message"]="Username and Password Not Valid";
        }
    }
    
    echo json_encode($result);
    
}
?>