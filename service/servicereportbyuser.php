<? include("include/header.inc.php");include("config.php");
$name=(isset($_POST["name"]));
 ?>

 
 <form action="exportservice.php" method="POST" name="name">
 <h2 align="center">&nbsp;</h2>
 <h2 align="center"> <strong><u>Services Report</u></strong></h2>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <table border="0px" align="center">
 <tr>
 <td width="117"><strong>User Name : </strong></td>
 


 <td width="127">
 <select name="name" id="name">
<?php 
 
$sql1=mysql_query("SELECT name FROM users");
while ($data=mysql_fetch_assoc($sql1))
  {
    ?>
    <option name="drop1" checked value ="<?php echo $data['name'] ?>" >
    <?php echo $data['name']; ?>
    </option>
  <?php 
  } 
   
  ?>
</select>
</td>
</tr>
<tr>
 <td><input name="submit" type="submit" value="submit" id="submit" /></td>


</tr> 

</table></form>
 

