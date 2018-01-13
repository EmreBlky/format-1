<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/


if($_POST["submit"] == "Submit")
{    
    $user_name = $_POST["client_name"];
    $branch = $_POST["branch"];
    
    
    $current_date_time = date('Y-m-d H:i:s');
    $current_date = explode(" ",$current_date_time);
    $current_time = explode(":",$current_date[1]);
    $time = $current_time[0].'_'.$current_time[1].'_'.$current_time[2];
    //echo '<pre>'; print_r($current_time);die;
    
    if($user_name != "" && $branch != "")
    {
        $error_msg = " ";
    }
    else
    {
        $error_msg = "Pelese select Branch and Client Name";    
    }
    
    if($error_msg == " ")
    {
            
        if($_FILES["uploaded_file1"]['name'] != '')
        {
            $file1 = $user_name.'_'.$current_date[0].'_'.$time.'_'.$_FILES["uploaded_file1"]['name'];
        
        }
        else
        {
            $file1 = '';
        }
        
        if($_FILES["uploaded_file2"]['name'] != '')
        {
            $file2 = $user_name.'_'.$current_date[0].'_'.$time.'_'.$_FILES["uploaded_file2"]['name'];
        
        }
        else
        {
            $file2 = '';
        }    
        
        if($_FILES["uploaded_file3"]['name'] != '')
        {
            $file3 = $user_name.'_'.$current_date[0].'_'.$time.'_'.$_FILES["uploaded_file3"]['name'];
        
        }
        else
        {
            $file3 = '';
        }
        
        $insert_query = mysql_query("INSERT INTO billing_file_data_tbl(user_id, branch_id, uploadfile1, uploadfile2, uploadfile3, insert_date) 
                VALUES('".$user_name."','".$branch."','".$file1."','".$file2."','".$file3."','".$current_date[0]."')") or die(mysql_error());
        
        if((!empty($_FILES["uploaded_file1"])) && ($_FILES['uploaded_file1']['error'] == 0)) {
          //Check if the file is pdf and it's size is less than 350Kb
          
          $filename = basename($_FILES['uploaded_file1']['name']);
          $ext = substr($filename, strrpos($filename, '.') + 1);
          
          if (($ext == "pdf") && ($_FILES["uploaded_file1"]["size"] < 500000000)) {
            //Determine the path to which we want to save this file
              //$newname = 'C:/xampp/htdocs/format/Billing_data/'.$user_name.'_'.$current_date.'_'.$filename;          
              $newname = 'C:/xampp/htdocs/format/account/Billing_data/'.$user_name.'_'.$current_date[0].'_'.$time.'_'.$filename;
              //Check if the file with the same name is already exists on the server
              
              if (!file_exists($newname)) {
                //Attempt to move the uploaded file to it's new place
                 //echo '<pre>'; print_r($_FILES); echo '</pre>';
                if ((move_uploaded_file($_FILES['uploaded_file1']['tmp_name'],$newname))) {
                   echo "It's done! The file has been saved as: ".$newname;
                }
                 else {
                   echo "Error: A problem occurred during file upload!";
                }
              } 
              else {
                 echo "Error: File ".$_FILES["uploaded_file1"]["name"]." already exists";
              }
          } 
          else {
             echo "Error: Only .pdf File under 350Kb are accepted for upload";
          }
        } 
        else {
          "Error: No file uploaded";
        }
        
        //?heck that we have a file
        if((!empty($_FILES["uploaded_file2"])) && ($_FILES['uploaded_file2']['error'] == 0)) {
          //Check if the file is JPEG image and it's size is less than 350Kb
          $filename = basename($_FILES['uploaded_file2']['name']);
          $ext = substr($filename, strrpos($filename, '.') + 1);
         if (($ext == "pdf") && ($_FILES["uploaded_file_2"]["size"] < 500000000)) {     
            //Determine the path to which we want to save this file
                $newname = 'C:/xampp/htdocs/format/account/Billing_data/'.$user_name.'_'.$current_date[0].'_'.$time.'_'.$filename;
              //Check if the file with the same name is already exists on the server
              if (!file_exists($newname)) {
                //Attempt to move the uploaded file to it's new place
                if ((move_uploaded_file($_FILES['uploaded_file2']['tmp_name'],$newname))) {
                   echo "It's done! The file has been saved as: ".$newname;
                } else {
                   echo "Error: A problem occurred during file upload!";
                }
              } else {
                 echo "Error: File ".$_FILES["uploaded_file2"]["name"]." already exists";
              }
          } else {
             echo "Error: Only .pdf images under 350Kb are accepted for upload";
          }
        } else {
          "Error: No file uploaded";
        }
        
        
        //?heck that we have a file
        if((!empty($_FILES["uploaded_file3"])) && ($_FILES['uploaded_file3']['error'] == 0)) {
          //Check if the file is JPEG image and it's size is less than 350Kb
          $filename = basename($_FILES['uploaded_file3']['name']);
          $ext = substr($filename, strrpos($filename, '.') + 1);
          if (($ext == "pdf") && ($_FILES["uploaded_file_3"]["size"] < 500000000)) {     
            //Determine the path to which we want to save this file
               $newname = 'C:/xampp/htdocs/format/account/Billing_data/'.$user_name.'_'.$current_date[0].'_'.$time.'_'.$filename;
              //Check if the file with the same name is already exists on the server
              if (!file_exists($newname)) {
                //Attempt to move the uploaded file to it's new place
                if ((move_uploaded_file($_FILES['uploaded_file3']['tmp_name'],$newname))) {
                   echo "It's done! The file has been saved as: ".$newname;
                } else {
                   echo "Error: A problem occurred during file upload!";
                }
              } else {
                 echo "Error: File ".$_FILES["uploaded_file3"]["name"]." already exists";
              }
          } else {
             echo "Error: Only .pdf images under 350Kb are accepted for upload";
          }
        } else {
          "Error: No file uploaded";
        }
        
    
        
    }
    else
    {
         $error_msg;    
    }


}

?>

<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
        var xmlhttp=false;    
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {        
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
             
        return xmlhttp;
    }
    
    function getClient(branchID) {        
        
        var strURL="selectclient.php?branch="+branchID;
        var req = getXMLHTTP();
        
        if (req) {
            
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {                        
                        document.getElementById('clientdiv').innerHTML=req.responseText;                        
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }                
            }            
            req.open("GET", strURL, true);
            req.send(null);
        }        
    }
    
</script>

<style type="text/css">
<!--
.style1 {
    font-size: 24px;
    font-weight: bold;
}
.style10 {font-size: 14px}
-->
</style>

<div class="top-bar">
<h1>Upload Billing File</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="color:red;width:100%;text-align:center;font-size:12px;"><?=$error_msg?></p>

<form action="" method="post" enctype="multipart/form-data" name="form1">
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
            <td>
                Branches : 
            </td>
            <td>
                <? 
                    $query="SELECT id,branch_name FROM gtrac_branch";
                    $result=mysql_query($query);
                ?>
                <select name="branch" onChange="getClient(this.value)">
                    <option>Select Branch</option>
                    <? while($row=mysql_fetch_array($result)) { ?>
                    <option value="<?=$row['id']?>"><?=$row['branch_name']?></option>
                    <? } ?>
                </select> 
           </td>
      </tr>
      <tr>
            <td>
                Clients Name : 
            </td>
            <td>
                <div id="clientdiv">
                    <select name="client" >
                        <option>Select Branch First</option>
                    </select>
                </div> 
             </td>
        </tr>
        <tr>
        <td> Upload File 1</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="uploaded_file1" type="file" />
        </tr>
        <tr>
        <td> Upload File 2</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="uploaded_file2" type="file" />
        </tr>
        <tr>
        <td> Upload File 3</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="uploaded_file3" type="file" />
        </tr>
        
        <tr>
        <td class="submit"><input id="Button1" type="submit" name="submit" value="Submit" runat="server" />
        </tr>
    </table>
    </form>
   </div>


<?php
include("../include/footer.php"); 
?>