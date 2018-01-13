<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<link  href="../css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.css"/>
<script src="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.full.js"></script>
<!-- <script src="<?php echo __SITE_URL;?>/js/jquery.min.js"></script> -->
<script type="text/javascript">

/*Start auto ajax value load code*/

 var $s = jQuery.noConflict();
$s(document).ready(function(){
    $s(document).click(function(){
		$s("#ajax_response").fadeOut('slow');
	});

        $s("#ajax_response").fadeOut('slow');
});
/* End auto ajax value load code*/
</script>

<?
$Header="Edit Installation";
$account_manager=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
	{
		$Header="Edit Installation";
		$result = select_query("select * from installation where id=$id and branch_id=".$_SESSION['BranchId']);	
		
		$Zone_area = $result[0]["Zone_area"];
		$area = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE id='".$Zone_area."'");
	}?>

<div class="top-bar">
<h1><? echo $Header;?></h1>
</div>
<div class="table"> 
<?
if(isset($_POST['submit']))
{
	//echo '<pre>'; print_r($_POST); die;



	$designation=$_POST['designation'];
    $alt_designation=$_POST['designation2'];
    $contact_person=$_POST['contact_person'];
    $alt_cont_person=$_POST['contact_person2'];
    $contact_number=$_POST['contact_number'];
    $alt_cont_number=$_POST['contact_number2'];
    $branch_type = $_POST['inter_branch'];
     if($branch_type == "Interbranch"){
        $city=$_POST['inter_branch_loc'];
       // $location="";
    }else
    {
        $city=0;
        //$location=$_POST['location'];
    }
     $location=$_POST['location'];
      $location1=$_POST['inter_branch'];
      $branch_type = $_POST['inter_branch'];
    $interbranch = $_POST['inter_branch_loc'];


     $interbranch = $_POST['inter_branch_loc'];

    if($location1 == 'Interbranch'){
      $query = select_query("select city from $internalsoftware.tbl_city_name where branch_id='".$interbranch."'");
      $branchlocation = $query[0]['city'];
    }
    else
    {
      $branchLocation = "Delhi";
    }
		//echo $branchLocation; die;
	//$location=$_POST['location'];
	//$cnumber=$_POST['cnumber'];
	//$contact_person=$_POST['contact_person'];
	 $atime_status=$_POST['atime_status']; 
	 $Zone_area=$_POST['Zone_area'];
	//$Area=$_POST['Zone_area'];
	$Zone_data = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE `name`='".$Zone_area."'");
	$zone_count = count($Zone_data);
	
	if($zone_count > 0)
	{
		 $Area = $Zone_data[0]["id"];
		$errorMsg = "";
	}
	else
	{
		$errorMsg = "Please Select Type View Listed Area. Not Fill Your Self.";
	}
	
	$back_comment = $_POST['back_comment'];
	$comment = $_POST['comment'];
	
	if($_POST['location'] == "")
	{
		$location="";
	}
	else
	{
		 $location=$_POST['location'];
	}
//die;

	if($errorMsg=="")	
	{	

		if($atime_status=="Till")
		{
			$time=$_POST['time'];
				echo 'tt'; die;
			$sql="update installation set time='".$time."', atime_status='".$atime_status."', contact_number='".$contact_number."' , contact_person='".$contact_person."',Zone_area='".$Area."', location='".$branchlocation."', installation_status='2', comment='".$back_comment."<br/>".date("Y-m-d H:i:s")." - ".$comment."', alt_cont_person='".$alt_cont_person."', alt_cont_number='".$alt_cont_number."', alt_designation='".$alt_designation."', designation='".$designation."',branch_type='".$branch_type."',landmark='".$location."' where id=$id";		
			echo $sql; die;
			$execute=mysql_query($sql);
						
			echo "<script>document.location.href ='running_installation.php?for=formatrequest'</script>";
		 }
		 if($atime_status=="Between")
		 {
			$time=$_POST['time1'];
			$totime=$_POST['totime'];
			
			$sql="update installation set time='".$time."',totime='".$totime."',atime_status='".$atime_status."',contact_number='".$contact_number."' ,contact_person='".$contact_person."',Zone_area='".$Area."', location='".$branchlocation."', installation_status='2', comment='".$back_comment."<br/>".date("Y-m-d H:i:s")." - ".$comment."', alt_cont_person='".$alt_cont_person."', alt_cont_number='".$alt_cont_number."', alt_designation='".$alt_designation."', designation='".$designation."',branch_type='".$branch_type."',landmark='".$location."' where id=$id";		
			$execute=mysql_query($sql);
						
			echo "<script>document.location.href ='running_installation.php?for=formatrequest'</script>";
		  }
	}
	
}

?>
<script type="text/javascript">

function req_info()
{
 
   var inter_branch=document.forms["form1"]["inter_branch"].value;
    if (inter_branch==null || inter_branch=="")
    {
      alert("Please Select Branch Button") ;
      return false;
    }

	if(document.form1.Zone_area.value=="")
	{
		alert("Please Select Area") ;
		document.form1.Zone_area.focus();
		return false;
	} 
  	
	/*var location=document.forms["form1"]["location"].value;
	if (location==null || location=="")
	{
		alert("Please Enter location");
		document.form1.location.focus();
		return false;
	}*/
	   
	var timestatus=document.forms["form1"]["atime_status"].value;
	if (timestatus==null || timestatus=="")
	  {
		  alert("Please select Availbale Time");
		  document.form1.atime_status.focus();
		  return false;
	  }
   
	var tilltime=document.forms["form1"]["datetimepicker"].value;
	if(timestatus == "Till" && (tilltime==null || tilltime==""))
	{
		alert("Please select Time");
		document.form1.datetimepicker.focus();
		return false;
	}
	
	var betweentime=document.forms["form1"]["datetimepicker1"].value;
	var betweentime2=document.forms["form1"]["datetimepicker2"].value;
	if(timestatus == "Between" && (betweentime==null || betweentime==""))
	{
		alert("Please select From Time");
		document.form1.datetimepicker1.focus();
		return false;
	}
	
	if(timestatus == "Between" && (betweentime2==null || betweentime2==""))
	{
		alert("Please select To Time");
		document.form1.datetimepicker2.focus();
		return false;
	}

	var Dtable = document.getElementById('dataTable');
  var DrowCount = Dtable.rows.length;
    //alert(DrowCount);
  for(var m=0; m<DrowCount; m++)
  {
    if(m == 0)
    {
      var fcounter = 0;
      var contact_person = 'contact_person';
      var contact_number = 'contact_number';
      var designation = 'designation';
    }
    else
    {
      var fTxtDeviceType = 'contact_person'+fcounter;
      var contact_number = 'contact_number'+fcounter;
      var designation = 'designation'+fcounter;
    }
    if(document.getElementById(designation).value=="")
    {
      alert("Please Select Designation.") ;
      document.getElementById(designation).focus();
      return false;
    }
    if(document.getElementById(contact_person).value=="")
    {
      alert("Please Write Contact Person Name.") ;
      document.getElementById(contact_person).focus();
      return false;
    }
    if(document.getElementById(contact_number).value=="")
    {
      alert("Please Write Contact Number") ;
      document.getElementById(contact_number).focus();
      return false;
    }
  }
   
  // if(document.form1.cnumber.value=="")
  // {
  // alert("Please Enter Contact No.") ;
  // document.form1.cnumber.focus();
  // return false;
  // }
 //  var cnumber=document.form1.cnumber.value;
 //  if(cnumber!="")
 //        {
	// var lenth=cnumber.length;
	
 //        if(lenth < 10 || lenth > 12 || cnumber.search(/[^0-9\-()+]/g) != -1 )
 //        {
 //        alert('Please enter valid mobile number');
 //        document.form1.cnumber.focus();
 //        document.form1.cnumber.value="";
 //        return false;
 //        }
 //     }
// if(document.form1.contact_person.value=="")
//   {
//   alert("Please Enter Contact Persion") ;
//   document.form1.contact_person.focus();
//   return false;
//   }
	
} 
/*function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}*/

function TillBetweenTime(radioValue)
{
 if(radioValue=="Till")
	{
	document.getElementById('TillTime').style.display = "block";
	document.getElementById('BetweenTime').style.display = "none";
	}
	else if(radioValue=="Between")
	{
	document.getElementById('TillTime').style.display = "none";
	document.getElementById('BetweenTime').style.display = "block";
	}
	else
	{
	document.getElementById('TillTime').style.display = "none";
	document.getElementById('BetweenTime').style.display = "none";
	} 
	
}

function TillBetweenTime12(radioValue)
{
 if(radioValue=="Till")
	{
	document.getElementById('TillTime').style.display = "block";
	document.getElementById('BetweenTime').style.display = "none";
	}
	else if(radioValue=="Between")
	{
	document.getElementById('TillTime').style.display = "none";
	document.getElementById('BetweenTime').style.display = "block";
	}
	else
	{
	document.getElementById('TillTime').style.display = "none";
	document.getElementById('BetweenTime').style.display = "none";
	} 
	
}

function StatusBranch12(radioValue)
{
   if(radioValue=="Samebranch")
	{
		document.getElementById('samebranchid').style.display = "block";
	}
	else
	{
		document.getElementById('samebranchid').style.display = "none";
	} 
	
}	
</script>
<!--  <script type="text/javascript">

    	$(function () {
    		 
    		$("#datetimepicker").datetimepicker({});
			$("#datetimepicker1").datetimepicker({});
			$("#datetimepicker2").datetimepicker({});
			$("#datetimepicker3").datetimepicker({});
			
    	});

    </script> -->
	
<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

<form method="post" action="" name="form1" onSubmit="return req_info();">

    <table style="width: 900px;" cellspacing="2" cellpadding="3" border="1">
        <tr>
            <td width="100px"  align="right"><label  id="lbDlClient"><strong>Request By: * </strong></label></td>
            <td width="100px" align="center"> <label><strong><? echo $account_manager?></strong> </label>
            </td>
            
            <td width="100px"  align="right"><strong>Company Name*:</strong></td>
            <td width="200px" align="center"><label><strong><?=$result[0]['company_name']?></strong> </label></td>
                
            <td width="100px"  align="right"><strong>No. Of Vehicles:*</strong></td>
            <td width="100px" align="center"><label><strong><?php echo '1';?></strong> </label></td>
        </tr>
        
    </table>    
   
    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

		<tr>
            <td >&nbsp; </td>
            <td><input type="hidden" name="back_comment" id="back_comment" value="<?=$result[0]['comment']?>"/></td>
        </tr>


          <tr>
        <td  align="right">Branch:<font color="red">* </font> </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='inter_branch' id='inter_branch' value= 'Samebranch' <?php if($result[0]['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="StatusBranch(this.value);">
          <?php echo $branch_data[0]["city"];?>
          <Input type='radio' Name ='inter_branch' id='inter_branch1' value= 'Interbranch' <?php if($result[0]['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
        onchange="StatusBranch(this.value);">
          Inter Branch 
        </td>
      </tr>



        
    <!--     <tr>
            <td  align="right"> Area:*</td>
            <td> <input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area[0]["name"];?>" /> <div id="ajax_response"></div></td>
        </tr>  -->
        <!--<tr>
            <td  align="right">
           		 Area:*</td>
            <td> 
                <select name="Zone_area" id="Zone_area" >
                <option value="" >-- Select One --</option>
                <?php
                /*$main_city=mysql_query(" select id,name from re_city_spr_1 order by name asc");
                while($data=mysql_fetch_assoc($main_city))
                {
                    if($data['id']==$result[0]['Zone_area'])
                    {
                        $selected="selected";
                    }
                    else
                    {
                        $selected="";
                    }*/
                ?>
                
                <option value ="<?php //echo $data['id'] ?>"  <?echo $selected;?>>
                <?php //echo $data['name']; ?>
                </option>
                <?php 
               // } 
                
                ?>
                </select>
            
            </td>
        </tr>-->


<!-- 	   <tr>
          <td colspan="2">
                
                <table  id="samebranchid"  align="left"  style="padding-left:65px; width: 300px;display:none;border:1" cellspacing="5" cellpadding="5">
                    <tr>		
                        <td  align="right">Location:*</td>
                        <td  ><input type="text" name="location"  id="location"   style="width:147px" value="<?=$result[0]['location']?>"/></td>
                    </tr>
                </table>
            </td>
        </tr> -->
      <!--   
        <tr>
            <td align="right">Availbale Time status:*</td><td colspan="2">
                <select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
                	<option value="">Select Status</option>
                    <option value="Till" <? if($result[0]['atime_status']=='Till') {?> selected="selected" <? } ?> >Till</option>
                    <option value="Between" <? if($result[0]['atime_status']=='Between') {?> selected="selected" <? } ?> >Between</option>
                 </select>
            </td>
        </tr>

		<tr>
        	<td colspan="2" align="right">
		        
            <table  id="TillTime" align="left" style="padding-left: 80px;width: 240px;display:none;border:1"  cellspacing="5" cellpadding="5">
                    <tr>
                        <td height="32" align="right">Time:*</td>
                        <td>
                             <input type="text" name="time" id="datetimepicker" value="<?=$result[0]['time']?>" style="width:147px"/>
                               
                         </td>
                    </tr>
            </table>
         </td>
    </tr> -->

<!-- 	<tr>
    	<td colspan="2" align="right">
		        
       		 <table  id="BetweenTime" align="left" style="padding-left: 80px;width: 240px;display:none;border:1"  cellspacing="5" cellpadding="5">
                <tr>
                    <td height="32" align="right">From Time:*</td>
                    <td>
                         <input type="text" name="time1" id="datetimepicker1" value="<?=$result[0]['time']?>" style="width:147px"/>
                           
                         </td>
                </tr>
                <tr>
                    <td height="32" align="right">To Time:*</td>
                    <td>
                         <input type="text" name="totime" id="datetimepicker2" value="<?=$result[0]['totime']?>" style="width:147px"/>
                           
                         </td>
                </tr>
            </table>
         </td>
    </tr>
 -->

    
    
   <tr>
        <td colspan="2">
          <table  id="branchlocation"  align="right"  style="width: 100%;display:none;margin-right:-2%;" cellspacing="5" cellpadding="5">
            <tr>
              <td align="left" style="width: 18%;margin-right:17px;" >Branch Name:<font color="red">* </font></td>
              <td><select name="inter_branch_loc" id="inter_branch_loc" style="width:150px;">
                  <option value="" >-- Select One --</option>
                  <?php
                      $city1=select_query("select * from tbl_city_name where branch_id!='".$_SESSION['BranchId']."'");
                      //while($data=mysql_fetch_assoc($city1))
                      for($i=0;$i<count($city1);$i++)
                      {
                          if($city1[$i]['branch_id']==$result[0]['inter_branch'])
                          {
                              $selected="selected";
                          }
                          else
                          {
                              $selected="";
                          }
                      ?>
                      <option value ="<?php echo $city1[$i]['branch_id'] ?>"  <?echo $selected;?>> <?php echo $city1[$i]['city']; ?> </option>
                      <?php
                      }
                      ?>
                </select>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td  align="right"> Location:<font color="red">* </font></td>
        <td><input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area[0]["name"];?>" style="width:30%" />
          <div id="ajax_response"></div></td>
      </tr>
      
     <tr>
        <td align="right"> Area:<font color="red">* </font></td>
        <td><input type="text" name="location"  id="location" value="<?=$result[0]['landmark']?>" minlength="15" style="width:30%" /></td>
    </tr> 
      
    <tr>
        <td  align="right">Availbale Time status:<font color="red">* </font></td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <?php if($result[0]['atime_status']=='Till') {?> selected="selected" <?php } ?> >Till</option>
            <option value="Between" <?php if($result[0]['atime_status']=='Between') {?> selected="selected" <?php } ?> >Between</option>
          </select>
        </td>
    </tr>
       <tr>
      <td colspan="2">
          <table  id="TillTime" align="left" style="width:100%;display:none;margin-left:11%;"  cellspacing="5" cellpadding="5">
            <tr>
              <td align="right">Time:*</td>
              <td><input type="text" name="time" id="datetimepicker" value="<?php echo date("Y/m/d H:i",strtotime($result[0]['time']))?>" style="width:147px"/></td>
            </tr>
          </table>
          <table  id="BetweenTime" align="left" style="width:100%"  cellspacing="5" cellpadding="5">
            <tr>
              <td align="right">From Time:*</td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?php echo date("Y/m/d H:i",strtotime($result[0]['time']))?>"style="width:147px"/></td>
            </tr>
            <tr>
            <tr>
              <td align="right">To Time:*</td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?php echo date("Y/m/d H:i",strtotime($result[0]['totime']))?>" style="width:147px"/></td>
            </tr>
          </table>
        </td>
    </tr>


    <!-- <tr>
        <td height="32" align="right">Contact No.:*</td>
        <td><input type="text" name="cnumber" value="<?=$result[0]['contact_number']?>" style="width:147px"/></td>
    </tr>
    <tr>
        <td height="32" align="right">Contact Person:*</td>
        <td><input type="text" name="contact_person" value="<?=$result[0]['contact_person']?>" style="width:147px"/></td>
    </tr> -->

       <tr>
        <td align="right" valign="top">Contact Details</td>
        <td style="margin-left:20px;">
          <table cellspacing="0" cellpadding="0">
            <tr>
              <td>
                  <INPUT type="button" value="+" id='addRowss' />
              </td>
              <td>
                  <INPUT type="button" value="-" id='delRowss' />
              </td>
            </tr>
          </table>
          <table id="dataTable"  cellspacing="2" cellpadding="2">
           <tr>
                <td  height="32" align="right">
                  <select name="designation" id="designation" style="margin-left:-4px" onchange="designationChange(this.value)">
                    <option value="">-- Select Designation --</option>
                    <option value="driver" <? if($result[0]['designation']=='driver') {?> selected="selected" <? } ?> >Driver</option>
                    <option value="supervisor"  <? if($result[0]['designation']=='supervisor') {?> selected="selected" <? } ?> >supervisor</option>
                    <option value="manager"  <? if($result[0]['designation']=='manager') {?> selected="selected" <? } ?> >Manager</option>
                    <option value="senior manager"  <? if($result[0]['designation']=='senior manager') {?> selected="selected" <? } ?>  >Senior Manager</option>
                    <option value="owner"  <? if($result[0]['designation']=='owner') {?> selected="selected" <? } ?> >Owner</option>
                    <option value="sale person"  <? if($result[0]['designation']=='sale person') {?> selected="selected" <? } ?> >Sale Person</option>
                    <option value="others"  <? if($result[0]['designation']=='others') {?> selected="selected" <? } ?>>Others</option>
              
                  </select>
                </td>
                <td>
                  <input type="text" name="contact_person" id="contact_person" title="Please enter only Characters" pattern="[a-zA-Z]{3,}" value="<?=$result[0]['contact_person']?>" style="width:147px"/>
                </td>

            <td><input type="text" name="contact_number" id="contact_number" value="<?=$result[0]['contact_number']?>" minlength="10" maxlength="10"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
           </td>        
           </tr>
           <tr id="dataDesignation" <? if($result[0]['alt_designation']=='') {?> style="display:none"  <? }else { echo 'style=""'; } ?>>  
                <td  height="32" align="right">
                  <select name="designation2" id="designation2" style="margin-left:-4px"
                onchange="designationChange(this.value)">
                    <option value="">-- Select Designation --</option>
                    <option value="driver" <? if($result[0]['alt_designation']=='driver') {?> selected="selected" <? } ?> >Driver</option>
                    <option value="supervisor"  <? if($result[0]['alt_designation']=='supervisor') {?> selected="selected" <? } ?> >supervisor</option>
                    <option value="manager"  <? if($result[0]['alt_designation']=='manager') {?> selected="selected" <? } ?> >Manager</option>
                    <option value="senior manager"  <? if($result[0]['alt_designation']=='senior manager') {?> selected="selected" <? } ?>  >Senior Manager</option>
                    <option value="owner"  <? if($result[0]['alt_designation']=='owner') {?> selected="selected" <? } ?> >Owner</option>
                    <option value="sale person"  <? if($result[0]['alt_designation']=='sale person') {?> selected="selected" <? } ?> >Sale Person</option>
                    <option value="others"  <? if($result[0]['alt_designation']=='others') {?> selected="selected" <? } ?>>Others</option>
              
                  </select>
                </td>
                            <td><input type="text" name="contact_person2" id="contact_person2" placeholder="Contact Person"  pattern="[a-zA-Z]{3,}" title="Please enter only Characters" value="<?=$result[0]['alt_cont_person']?>" style="width:147px"/>
            </td>

                <td>
                  <input type="text" name="contact_number2" placeholder="Contact Number" id="contact_number2"  minlength="10" maxlength="10" value="<?=$result[0]['alter_contact_no']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
                </td>       
           </tr>
          </table>
          
        </td>
      </tr> 

    <tr>
        <td height="32" align="right">Comment:</td>
        <td><textarea rows="5" cols="25"  type="text" name="comment" id="TxtComment" ><?=$result[0]['comment']?></textarea></td>
    </tr>
    <tr>
            <td height="32" align="right"><input type="submit" name="submit" value="Update" align="right" /></td>
            <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
     </tr>
  </table>
  
	</form>
   </div>


<?
include("../include/footer.php");

?>
 <script type="text/javascript">
 
 var $t = jQuery.noConflict();


  var counter=0;

  $t("#delRowss").click(function(){
      $t("#dataDesignation").hide();
      $t("#designation2").val('');
      $t("#contact_person2").val('');
      $t("#contact_number2").val('');
      if($t("#dataDesignation").hide()){ --counter; }
      //alert(counter)
      if(counter < 0){alert("Atleast One Contact Detail Must")}

  });
  $t("#addRowss").click(function(){
      $t("#dataDesignation").show();
      if($t("#dataDesignation").show()){ ++counter; }
      if(counter > 1){alert("No More Add Contacts")}
  });


	$t("#Zone_area").focus();
	var offset = $t("#Zone_area").offset();
	var width = $t("#Zone_area").width()-2;
	$t("#ajax_response").css("left",offset); 
	$t("#ajax_response").css("width","15%");
	$t("#ajax_response").css("z-index","1");
	$t("#Zone_area").keyup(function(event){
		 //alert(event.keyCode);
		 var keyword = $t("#Zone_area").val();
		      var city_id= $t("#inter_branch_loc").val();
          var inter_branch= $t("#inter_branch").val();
            if(city_id=='')
             {
                city_id=1;
             }
		 if(keyword.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $t("#loading").css("visibility","visible");
				 $t.ajax({
				   type: "POST",
				   url: "load_zone_area.php",
				   data: "data="+keyword+"&city_id="+city_id,
				   success: function(msg){	
					if(msg != 0)
					  $t("#ajax_response").fadeIn("slow").html(msg);
					else
					{
					  $t("#ajax_response").fadeIn("slow");	
					  $t("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$t("#loading").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $t("li").each(function(){
						 if($t(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $t("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$t("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $t("li").each(function(){
						 if($t(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $t("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$t("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$t("#ajax_response").fadeOut("slow");
					$t("#Zone_area").val($t("li[class='selected'] a").text());
				 break;
				}
			 }
		 }
		 else
			$t("#ajax_response").fadeOut("slow");
	});
	$t("#ajax_response").mouseover(function(){
		$t(this).find("li a:first-child").mouseover(function () {
			  $t(this).addClass("selected");
		});
		$t(this).find("li a:first-child").mouseout(function () {
			  $t(this).removeClass("selected");
		});
		$t(this).find("li a:first-child").click(function () {
			  $t("#Zone_area").val($t(this).text());
			  $t("#ajax_response").fadeOut("slow");
		});
	});




  var logic = function( currentDateTime ){
  if (currentDateTime && currentDateTime.getDay() == 6){
    this.setOptions({
      minTime:'11:00'
    });
  }else
    this.setOptions({
      minTime:'8:00'
    });
};
$t('#datetimepicker').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});
$t('#datetimepicker1').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});

$t('#datetimepicker2').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});

function StatusBranch(radioValue)
{
  //alert(radioValue)
   if(radioValue=="Interbranch")
    {
        document.getElementById('inter_branch1').checked = true;
        document.getElementById('branchlocation').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
      document.getElementById('inter_branch').checked = true;
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
    }
   
} 

 </script>
<script>StatusBranch12("<?=$result[0]['branch_type'];?>");TillBetweenTime12("<?=$result[0]['atime_status'];?>");</script> 
 
 
 