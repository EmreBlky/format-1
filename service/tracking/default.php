<?php
include('../inc/sessionstart.php');
include('../inc/connect.php');
include('../inc/functions.php');
include('../inc/check_user.php');


$p=safe($_GET['p']);
$s=safe($_GET['s']);




//exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example: Simple Map</title>
<link id="masterStyleSheet" rel="stylesheet" href="Skins/Default/StyleSheet.css" /><link rel="stylesheet" href="js/tracking/aqtree3clickable.css" />
 <script type="text/javascript">
	function stopError() {
		return true;  
	}
	window.onerror = stopError;
    </script>
 <style type="text/css">
    .style1 {background-color:#000000;color:#ffffff;border:1px #000000 solid;}
    </style>
  </head>
<body id="mainBody" class=" yui-skin-sam" style=" margin-top: 0; margin-left: 0; margin-right: 0">
<?php
include('default_header_link.php');
?>

<?php
	if($p=="reports"){

		if($s=="journey"){
			include("journey.php");
			exit;
		}
	}

?>
    <?=key?>

	
	<script src='js/DOMDisplay.js'></script>
	<script src='js/MapIcon.js'></script>
	<script src='js/elabel.js'></script>
	<script src='../js/ajax.js'></script>
    <script type="text/javascript">
		var selectedVehiclesJson='';
		var zoomCheck=true;
		var map;
		var markers;
		var mapIcon=new MapIcon();

	document.write('<div id="map" style="width: '+parseInt(screen.width-300)+'px; height: '+parseInt(screen.height)+'px"></div>');



 function display(){
		setTimeout(function(){display()}, 5000);
		if(top.redrawMap==false){
			return false;
		}
		map.clearOverlays();
		var activeItems = top.vehicles.selectedIds;
		var  response=eval("(" + top.Selected_Vehicles_Json + ")");
		
		if(top.Selected_Vehicles_Json!="[]" && response.markers.length>0){

			for(i=0;i<response.markers.length;i++){
				a=response.markers[i].lat;
			}


	
	
	var Initialpoint = new GLatLng(response.markers[0].lat,response.markers[0].lon);
    map.panTo(Initialpoint); 
     
    var points = new Array();
    var bounds = new GLatLngBounds();
			map.clearOverlays();
    for(var j = 0; j < response.markers.length; j++)
    {
        var lat = response.markers[j].lat;        
        var lng = response.markers[j].lon;
        var point = new GLatLng(lat,lng);
        points[j] = point;
        var desc = response.markers[j].desc;
        var iconURL = mapIcon.getIcon(response.markers[j].iconUrl,response.markers[j].bearing);
		
        bounds.extend(point);            
        var marker = createMarker(point,desc,iconURL);                  
        map.addOverlay(marker);  
        //markers[j]=marker;                      
        var label = new ELabel(point, '<div style="text-align:center;white-space:nowrap;background-color:#F9F3B5;color:#000000;font-size:10px;">'+desc.substring(0,13)+'</div>',"style1", new GSize(15,0), 0 );           
        map.addOverlay(label);         
//         labels[j]=label;
//
			
    }

	var url='getVehcles.php?show=poilist';	
	var	jsonPOIData=ajaxpage_post(url,'loading','','',1);    
	alert(jsonPOIData);
	response=eval("(" + jsonPOIData + ")");
    for(var j = 0; j < response.markers.length; j++)
    {
		alert(response.markers.length);
		/*try
				{
					if(response.markers[j].poiPolygonPoints.length>0)
					{
						 ///section to plot POI POlygon
						  var points = [];
						  for (var i = 0; i < response.markers[j].poiPolygonPoints.length; i++) {
							bounds.extend(point);     
							points.push(new GLatLng(response.markers[j].poiPolygonPoints[i].lat,response.markers[j].poiPolygonPoints[i].long));
						}
						  points.push(points[0]);   // Close the polygon
						  map.addOverlay(new GPolygon(points, lineColor, lineWeight, lineOpacity, fillColor, fillOpacity));
						  ////////
					}					
				}
				catch(e)
				{

				}*/
    }
				
	   if(zoomCheck){
		var zoomlevel=map.getBoundsZoomLevel(bounds);
			if (zoomlevel>15){
				 zoomlevel=15; 
			 }
		 map.setZoom(zoomlevel-1);
		 map.setCenter(bounds.getCenter());  
	   }
	}

	top.redrawMap=false;
 }

function createMarker(point, title, IconUrl) { 
      //IconUrl='images/icons/vehicles/21.png';
    var Icon = new GIcon();
    Icon.image = IconUrl;
    Icon.shadow = '';
    Icon.iconSize = getIconSize(IconUrl);
    Icon.shadowSize = new GSize(0, 0);
    Icon.iconAnchor = new GPoint(20, 25);
    Icon.infoWindowAnchor = new GPoint(5, 1);
 
    var marker = new GMarker(point,Icon);
  
// GEvent.addListener(marker, "mouseover", function() {
//  marker.openInfoWindowHtml('<div style="width:250px;">' + title + '<hr>Lat: ' + point.y + '<br>Lon: ' + point.x + '</div>');
// });
 return marker;
}

function getIconSize(url)
{
    var newImg = new Image();
    newImg.src = url;
    var height = newImg.height;
    var width = newImg.width;
    
    var size = new GSize(width, height);

    return size;
}

setTimeout(function(){display()}, 5000);

	</script>

<script>


 if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(28.969700808694157,76.75598145), 6);
		map.addControl(new GMapTypeControl());

        map.setUIToDefault();
      }








// Auto Zoom 



function MyPane1() {}
MyPane1.prototype = new GControl;
MyPane1.prototype.initialize = function(map) {
  var me = this;
  me.panel = document.createElement("div");
  me.panel.style.width = "100px";
  me.panel.innerHTML ="<table class=dataTable cellpadding=0 cellspacing=0 border=0><tr><th style=\"color:White\"><a onclick=\"ZoomAdjust4();\">"+
  "<div style=\"color:White\" id=\"ZoomSet\">Auto Zoom ON </div>"+
  "</a></th></tr></table>";
  map.getContainer().appendChild(me.panel);
  return me.panel;
};


MyPane1.prototype.getDefaultPosition = function() {
  return new GControlPosition(
      G_ANCHOR_TOP_LEFT, new GSize(100, 10));
      //Should be _ and not &#95;
};


MyPane1.prototype.getPanel = function() {
  return me.panel;
}


JourneyPaneControl=new MyPane1();
map.addControl(JourneyPaneControl);
function ZoomAdjust4()
{
  if(zoomCheck)
  {
    document.getElementById('ZoomSet').innerHTML="Auto Zoom OFF";
    //alert("false");
    zoomCheck=false;
  }
  else
  {
    document.getElementById('ZoomSet').innerHTML="Auto Zoom ON";
    //alert("false");
    zoomCheck=true;
  }
  
}
</script>


  </body>
</html>
