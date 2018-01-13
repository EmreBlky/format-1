<?
include("include/header.inc.php");

?>
 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css.css" />

 

<script language="javascript">

$(document).ready(function(){

	//show loading bar

	function showLoader(){

		$('.search-background').fadeIn(200);

	}

	//hide loading bar

	function hideLoader(){

		$('#sub_cont').fadeIn(1500);

		$('.search-background').fadeOut(200);

	};

	

	$('#search').keyup(function(e) {

  

      if(e.keyCode == 13) {

  

      	showLoader();

		$('#sub_cont').fadeIn(1500);

		$("#content #sub_cont").load("search_account.php?val=" + $("#search").val(), hideLoader());



      }

  

      });

	  

	$(".searchBtn").click(function(){

	

		//show the loading bar

		showLoader();

		$('#sub_cont').fadeIn(1500);
		$("#content #sub_cont").load("search_account.php?val=" + $("#search").val(), hideLoader());
	});

	 showLoader();

		$('#sub_cont').fadeIn(1500);
		$("#content #sub_cont").load("search_account.php?val=" + $("#search").val(), hideLoader());

});

</script>

 
<br/>
	<div class="textBox">

        <input type="text" value="" maxlength="100" name="searchBox" id="search">

		<div class="searchBtn">

		&nbsp;

		</div>

    </div>


	 <div id="content">

		<div class="search-background">

			<label><img src="loader.gif" alt="" /></label>

		</div> 

		<div id="sub_cont">
		
 
 
		
 		</div>
 
 </div> 

 
<?
 include("include/footer.inc.php");

?>

