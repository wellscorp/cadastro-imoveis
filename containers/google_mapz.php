<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<script type="text/javascript" src="..\js/jquery.min.js" ></script>
	<script type="text/javascript" src="..\js/bootstrap.min.js"></script>
	<script type="text/javascript" src="..\js/bootstrap.js"></script>	
	<link href="..\css/bootstrap.min.css" rel="stylesheet">

<script>

// LATITUDE E LONGITUDE DA MARCAÇÃO
/*
var myCenter=new google.maps.LatLng(51.508742,-0.120850);
var maker;

function initialize()
{
	var mapProp = {
	  center:myCenter,
	  zoom:5,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);



	var marker=new google.maps.Marker({
	  position:myCenter,
	  // ANIMA A MARCAÇÃO
	  animation:google.maps.Animation.BOUNCE
	  });

	// INSERE A MARCAÇÃO
	marker.setMap(map);
	// CRIA MENSAGEM EM UM BALÃO
	var infowindow = new google.maps.InfoWindow({
	  	content:"Marcacao!"
	  });
	// EVENTO DE APARECER BALÃO AO CLICAR
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	  });

	// DELETAR MARKER
	google.maps.event.addListener(marker, "dblclick", function() {
	    map.removeOverlay(marker);
	});

	// EVENTO DE CHAMAR FUNÇÃO PARA CRIAR MARCADOR AO CLICAR NO MAPA 
	google.maps.event.addListener(map, 'click', function(event) {
	    placeMarker(event.latLng);
	});

	// FUNÇÃO PARA CRIAR UM MARCADOR ATRAVES DA LOCALIZAÇÃO DADA!
	function placeMarker(location) {
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map,
	  });

	  var infowindow = new google.maps.InfoWindow({
	    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
	  });
	  infowindow.open(map,marker);
	}


	function placeDesMaker(Location){

	}

}


google.maps.event.addDomListener(window, 'load', initialize);

function deleteMarker(){
	//clearMarkers();
	marker.setMap(null);
	//map.removeOverlay(marker);

}

*/


var map;
var markers = [];

function initialize() {
  var haightAshbury = new google.maps.LatLng(-12.259915056509431 ,-38.964385986328125);
  var mapOptions = {
    zoom: 13,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("googleMap"),
      mapOptions);

  // This event listener will call addMarker() when the map is clicked.
  google.maps.event.addListener(map, 'click', function(event) {
    addMarker(event.latLng);
  });

  // Adds a marker at the center of the map.
  addMarker(haightAshbury);
}



// Add a marker to the map and push to the array.
function addMarker(location) {
	clearMarkers();
  markers = [];
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
  console.log(markers);
}

google.maps.event.addDomListener(window, 'load', initialize);

function show(){
	console.log(markers[0].position['k']);
	x= markers[0].position['k']
	console.log(markers[0].position['B']);
	y= markers[0].position['B'];
	if(confirm("Deseja finalizar marcação?"))	window.close("../containers/google_mapz.php", "_blank");
	$.ajax({
		type: "POST",
		data: {x:x, y:y},
		url: "../logic/logic.php",
		datatype: "html",
		success: function(result, status){
			console.log(result);
		},
		complete: function(result){
			console.log(status);
		}
	});	

}





</script>
</head>

<body>
<div align="center">
	<label align="center">		Marque o local desejado e clique em "Finalizar" para encerrar a marcação.	</label>
</div>
<div id="googleMap" style="width:600px;height:380px;"></div>
<!--<input type="button" name="delete" value="delete" onClick="deleteMarkers()">-->
<!--<input type="button" name="show" value="show" onClick="show()">-->
<div align="center">
	<input type="button" name="fim" value="Finalizar" onClick="show()" align="center"  class="btn btn-primary btn-md ">
</div>
</body>
</html>

