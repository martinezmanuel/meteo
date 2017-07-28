<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_e4-Bl7aMEIRG-JCtow4gHaRosE9TTxY&callback=initMap"
        async defer></script>
</head>
<script type="text/javascript">
function submit() {
  var address = document.getElementById("street_id").value + " " + document.getElementById("code_id").value + " " + document.getElementById("city_name").value;
  geocoding(address);
}

function geocoding(address) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      var gps_id = results[0].geometry.location.lat()+','+results[0].geometry.location.lng();
  
          var geocodingresult = document.getElementById('geocodingresult');
          geocodingresult.innerHTML = "The geocoding is: latlng " + gps_id ;
    } 
    else {
      var geocodingresult = document.getElementById('geocodingresult');
          geocodingresult.innerHTML = "Error result when geocoding the address " + address;
      }
  });
}

</script>
</head>
<body>

<center>
Please input an address:
<input type="text" name="street" id="street_id" size="40">
<input type="text" name="code" id="code_id" size="40">
<input type="text" name="city" id="city_name" size="40">
<button onclick="submit();">Go</button>
<div id="geocodingresult"></div>
</center>


<!--
<body onload="initialize()" >
  <div >
    Adresse : <input id="street1_id" type="text" value=""> 
    ville:   <input id="city_name" type="text" value="">
    cp:   <input id="code_id" type="text" value="">
    Lat,Lng :  <input id="gps_id" type="text" value="">  
  <input type="button" value="Geocoder" onclick="codeAddress()">
  </div>
-->
</body>
</html>
