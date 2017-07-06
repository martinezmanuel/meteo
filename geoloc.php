<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_e4-Bl7aMEIRG-JCtow4gHaRosE9TTxY&callback=initMap"
        async defer></script>
<script type="text/javascript">
  var geocoder;
  
  function initialize() {
    geocoder = new google.maps.Geocoder();
  }

  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        document.getElementById('latlng').value = results[0].geometry.location.lat()+ ','+results[0].geometry.location.lng();
     
      } else {
        alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
      }
    });
  }


</script>
</head>
<body onload="initialize()" >
  <div >
    Adresse : <input id="address" type="text" value="chartres">    
    Lat,Lng :  <input id="latlng" type="text" value="">  
  <input type="button" value="Geocoder" onclick="codeAddress()">
  </div>

</body>
</html>