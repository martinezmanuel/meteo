  
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
  
/* Fonction d'initialisation de la map appelée au chargement de la page  */
  function initMap() {
    var latlng = new google.maps.LatLng(48.8566667, 1.52620509);
    var myOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
  }
  /* Fonction chargée de géocoder l'adresse  */
  function codeAddress(geocoder, resultsMap) {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address + ' France'}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var coords = results[0].geometry.location
        map.setCenter(coords);
        var marker = new google.maps.Marker({
          map: map,
          position: coords
        });
        document.getElementById('latlng').value = coords.lat()+','+coords.lng();
        codeLatLng(coords.lat()+','+coords.lng(), geocoder);
      } else {
        alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
      }
    });
  }
  /* Fonction de géocodage inversé (en fonction des coordonnées de l'adresse)  */
  function codeLatLng(input, geocoder) {
    var latlngStr = input.split(",",2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          map.setZoom(11);
          marker = new google.maps.Marker({
            position: latlng,
            map: map
          });
          var elt = results[0].address_components;
          for(i in elt){
            if(elt[i].types[0] == 'postal_code')
            document.getElementById('cp').value = elt[i].long_name;
            if(elt[i].types[0] == 'locality')
            document.getElementById('address').value = elt[i].long_name;
            if(elt[i].types[0] == 'administrative_area_level_2')
            document.getElementById('dpt').value = elt[i].long_name;
            if(elt[i].types[0] == 'country')
            document.getElementById('pays').value = elt[i].long_name;
          }
          infowindow.setContent(results[0].formatted_address);
          infowindow.open(map, marker);
          map.setCenter(latlng);
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
  function retrieve(){
    var input = document.getElementById("latlng").value;
    codeLatLng(input);
  }
</script>
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col_centered"> 
    <input id="address" type="textbox" value="Chartres, FR">     
    <input id="latlng" type="text" value="lat,lng">
    <input type="button" value="Obtenir les coordonnées" onclick="codeAddress()">  
</div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_e4-Bl7aMEIRG-JCtow4gHaRosE9TTxY&callback=initMap"
        async defer></script>
