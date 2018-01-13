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
              
                 $zone_name = select_query("SELECT id, name FROM re_city_spr_1 ORDER BY name");
              
              for($i=0;$i<count($zone_name);$i++)
              {            
                      
                 $arr=array (
                   'Zone_id'=> $zone_name[$i]["id"] ,
                   'ZoneName' => $zone_name[$i]["name"],
                                  
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