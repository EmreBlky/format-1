<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_admin.php");*/
 
?>

<div class="top-bar">
  <h1>SSE Login List</h1>
  <a href="new_login_create.php" class="button">ADD NEW </a> </div>
<div class="table">
  <?php
 
 $query = select_query("SELECT * FROM servicelogin_user WHERE parent_id=1 ORDER BY user_name ASC");
 
?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Password</th>
        <th>Email Id</th>
        <th>Barnch</th>
        <th>Status</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
    if($query[$i]["branch_id"]==1){ $branch = "Delhi";}
    elseif($query[$i]["branch_id"]==2){ $branch = "Mumbai";}
    elseif($query[$i]["branch_id"]==3){ $branch = "Jaipur";}
    elseif($query[$i]["branch_id"]==4){ $branch = "Sonipath";}
    elseif($query[$i]["branch_id"]==6){ $branch = "Ahmedabad";}
    elseif($query[$i]["branch_id"]==7){ $branch = "Kolkata";}

?>
      <tr align="center"> 
        
        <!--<td><?php echo $i?></td>-->
        <td><?php echo $query[$i]["user_name"];?></td>
        <td><?php echo $query[$i]["password"];?></td>
        <td><?php echo $query[$i]["email"];?></td>
        <td><?php echo $branch;?></td>
        <td><?php if($query[$i]["isadmin"]==1){echo 'Active';}else{echo 'Deactive';}?></td>
        <td><a href="new_login_create.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a></td>
      </tr>
      <?php }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>