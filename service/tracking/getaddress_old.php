<?php
error_reporting(0);
include('cls_xml2array.php');
class master{

	function getLatLong($cityId) {

		$q 			= 	$cityId; 		
		$q			=	urlencode($q);
		
		$myFile 	= "http://maps.google.com/maps/geo?&output=csv&key=ABQIAAAAwD1OcmHTblldNGP57EK8YxQ_l8EwNPU4bdnDEeXzK6YpAOnXfhRrQvVMZyjHiVEPm5Qm6QIN1sSFmw&q=".$q; 
		
		$xml		=	@file_get_contents($myFile);

	
		return $xml ; // 0=>lat 1=>lng 2=>extra parameter not for use.
	
	}


		function getAddress($latlng ) {

		$q 			= 	$latlng; 		
		$q			=	urlencode($q);
		
		$myFile 	= "http://maps.google.com/maps/geo?&output=xml&key=ABQIAAAAwD1OcmHTblldNGP57EK8YxQ_l8EwNPU4bdnDEeXzK6YpAOnXfhRrQvVMZyjHiVEPm5Qm6QIN1sSFmw&q=".$q; 
		
		$xml		=	@file_get_contents($myFile);
		$converter 	= new Xml2Array();
		$converter->setXml($xml);
		$xml_array = $converter->get_array();



		
		if($xml_array['kml']['Response']['Placemark'][0] ==''){
		
			$lat_lng 	=	($xml_array['kml']['Response']['Placemark']['address']['#text']);
		}else {
		
					$lat_lng 	=	($xml_array['kml']['Response']['Placemark'][0]['address']['#text']);
	
		}		
	
	
		return $lat_lng ; // 0=>lat 1=>lng 2=>extra parameter not for use.
	
	}

}




$obj=new master();


$latlng=$_GET['latlng'];
$address=$_GET['address'];

	if($latlng!=""){
		echo	$obj->getAddress($latlng);
	}
	else{
		echo	$obj->getLatLong($address);
	}
//

?>