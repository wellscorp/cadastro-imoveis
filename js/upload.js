$().ready(function(){
	


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
	var x= markers[0].position['k']
	console.log(markers[0].position['B']);
	var y= markers[0].position['B'];
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


// ---------------------------------------------------------------------------------------------------------------



	function inicio(){
		
		//$("input[name=transferir]").click(function(){

			//var dir= $("input[name=diretorio]").val();
			//var dir= $("input[name=file]").val();
			//var dir= document.getElementById("file"); 
			//var a=String.fromCharCode(92);
			//console.log(a);
			//dir = dir.split(a);
			//console.log(dir[2]);

			//if(dir=="")		alert("Diretório não especificado!");
			//else{
				//console.log(dir);

				$.ajax({
					type: "POST",
					//data: {flag: 10, dir:dir},
					data: {flag: 2},
					url: "logic.php",
					datatype: "html",
					success: function(result, status){
						console.log(result);
						/*
						if(result== '-3' || result== '-4'){
							alert("Arquivo invalido!");
							window.open("../pags/inicio.php","_self");

						}else{
							if(result== '-1'){							
								$.ajax({
									type: "POST",
									data: {flag: 0},
									url: "logic.php",
									datatype: "html",
									success: function(result, status){
										console.log(result);
										//alert("Informações transferidas com sucesso!");
										if(confirm("Informações transferidas com sucesso! \nDeseja imprimir relatório?") == true){
											$("#load").show();
											$.ajax({
												type: "POST",
												data: {flag: 4, log:''},
												url: "logic.php",
												datatype: "html",
												success: function(result, status){
													console.log(result);
													window.open("../relatorios/notas.php","_blank");
													
												},
												complete: function(result){
													console.log(status);
												}
											});	
										}else 	window.open("../pags/inicio.php","_self");;
									},
									complete: function(result){
										console.log(status);
									}
								});	
							}else{
								if(result== '-2'){
									alert("TODOS REGISTROS JÁ EXISTEM (REPETIDOS)!") 
									window.open("../pags/inicio.php","_self");

								}else{
									var x;
									result= result.split("-");
									if(confirm("Registros já existentes: "+result[0]+". \nRegistros novos: "+result[1]+". \nDeseja transferir registros novos?")== true){
										x="Transferir!";
										$.ajax({
											type: "POST",
											data: {flag: 0},
											url: "logic.php",
											datatype: "html",
											success: function(result, status){
												console.log(result);
												if(confirm("Informações transferidas com sucesso! \nDeseja imprimir relatório?") == true){
													$.ajax({
														type: "POST",
														data: {flag: 4, log:''},
														url: "logic.php",
														datatype: "html",
														success: function(result, status){
															console.log(result);
															window.open("../pags/inicio.php","_self")
															window.open("../relatorios/notas.php","_blank");
														},
														complete: function(result){
															console.log(status);
														}
													});	
												};
											},
											complete: function(result){
												console.log(status);
											}
										});
									}
									else{
										x= "Não transferir!";
										window.open("../pags/inicio.php","_self")
									}
									console.log(x);
								}
							}
						}
						*/
					},
					complete: function(result){
						console.log(status);
					}
				});		
			//}
		//});
	};
	

	inicio();
})