<?php
session_start();
include("../connection.php");

if(isset($_REQUEST["id"]))
{

	$id=$_REQUEST["id"];
	$branch_id=$_REQUEST["branch_id"];
	$deviceModel=$_REQUEST["deviceModel"];

  if($branch_id==0){
      $branch_id=1;
  }      
      
    // $sqlModel=select_query("SELECT device_model FROM device_model where id='".$deviceModel."' "); 
    // $modelName = $sqlModel[0]['device_model'];
     /*$sqlModel=select_query("SELECT item_name FROM $internalsoftware.item_master where item_id='".$deviceModel."'");
     $modelName = $sqlModel[0]['item_name'];*/



    $query = "SELECT * FROM $internalsoftware.admin_stock_view where dispatch_branch='".$branch_id."'";
    //echo $query; die;
    $row=select_query($query);
    //print_r($row);

    //echo $row[0]['device_model'];die;


?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  th{
        white-space: nowrap;
        text-align: center;
        font-size: 15px;

  }
  td{
    font-size: 12px;
  }
  
  </style>

<div class="container">
  <h2 align="center">Stock Details</h2>
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Device Type</th>
        <th>Device Model</th>
        <th>FFC Device</th>
        <th>New Device</th>
        <th>Total Device</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php for($i=0;$i<count($row);$i++) { 

        //echo $deviceModel;
        //echo $row[$i]['device_type_id'];die;
        //echo $row[$i]['device_model'];die;
        ?>  
      <tr <?php if($deviceModel == $row[$i]['device_type_id']){ echo "style='background-color:#f4aa42'"; }else{ echo "style=''"; } ?> >
        <td><?php echo $row[$i]['device_type']?></td>
        <td><?php echo $row[$i]['device_model']?></td>
        <td><?php echo $row[$i]['ffc_device']?></td>
        <td><?php echo $row[$i]['new_device']?></td>
        <td><?php echo $row[$i]['total_device']?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>  

<?php } ?>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>
