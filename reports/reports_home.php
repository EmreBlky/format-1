<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header_admin_home.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header_admin_home.php");*/
 ?> 
 <style>
#left-column {
	float:left;
	padding:1px 13px 0 12px;
	width:230px;
	}
 </style>
 <div class="top-bar1">
<h1> </h1>
</div>
<div  > 
 
<table>
	<tr>
        <td><div id="left-column"><a href="reports.php" style="text-decoration:none"> <h3>Installation Reports <font color="#606060">  </font></h3></a>
           </div>
          </td>
	    <td><div id="left-column"><a href="device_details.php" style="text-decoration:none"> <h3>Device Details <font color="#606060">  </font></h3></a>
           </div>
          </td>
        <td><div id="left-column"><a href="installer_report.php" style="text-decoration:none"> <h3>Installer Report <font color="#606060">  </font></h3></a>
           </div>
          </td>
        <td><div id="left-column"><a href="client_profile.php" style="text-decoration:none"> <h3>Client Report <font color="#606060">  </font></h3></a>
           </div>
          </td>
	   <td>&nbsp;</td>
    </tr>
        
       
</table>


 
               
</div>
<?php
include("../include/footer.php"); ?>



