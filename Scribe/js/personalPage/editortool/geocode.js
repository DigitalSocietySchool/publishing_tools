
var map,autocomplete,marker,locationData;
function initialize(){
  //basic options for the map
  var defaultBonds=new google.maps.LatLngBounds(
  new google.maps.LatLng(-33.8902, 151.1759),
  new google.maps.LatLng(-33.8474, 151.2631));
 
  myCenter=new google.maps.LatLng(52.367274, 4.857759);
  var options={ 
  	//bounds: defaultBonds,
  	center:myCenter,
    zoom:9,
    mapTypeId:google.maps.MapTypeId.ROADMAP
    };
  
  map=new google.maps.Map(document.getElementById("googleMap"),options); //we create the map
  
  //MARKER
  marker = new google.maps.Marker({
  position: myCenter,
  title:'Click to zoom',
  animation:google.maps.Animation.BOUNCE
  });
  
  //AUTOCOMPLETE
  var input=document.getElementById('pac-input');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  autocomplete=new google.maps.places.Autocomplete(input,options);
  
  //here we put the listeners for each one
  google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
  google.maps.event.addListener(map, 'click',function(event){
  	placeMarker(event.latLng);
  });
  google.maps.event.addListener(marker,'click',function() {
  map.setZoom(9);
  map.setCenter(marker.getPosition());
  });
  
 }
 
 //it is important to call initialize only when the down is ready
 google.maps.event.addDomListener(window,"load",initialize);
 
 function onPlaceChanged() {
  var place = autocomplete.getPlace();
  if (place.geometry) {
    map.panTo(place.geometry.location);
    map.setZoom(15);
  } else {
    document.getElementById('pac-input').placeholder = 'Enter a city';
  }
}
 
 function placeMarker(location){
 	locationData=location;
 	marker.setMap(null);
 	marker=new google.maps.Marker({
    position: location,
    map: map,
  });
  	var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
 }
 
 
 //Add new location
 
 $("#addNewLocation").click(function(){
 	var place=document.getElementById("pac-input").value;
 	$("<button></button>").html(place+ "&nbsp; <span class='glyphicon glyphicon-remove'></span>").addClass("btn").appendTo(".recommendedTags");
 	//+ ";nbsp <span class='glyphicon glyphicon-remove'></span>"
 });
