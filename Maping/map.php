<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps Latitude/Longitude Example</title>
    <!-- Replace 'YOUR_API_KEY' with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKkxmhGYxv7wYFK6sI6DXCDXi_Cvotz9A&callback=initMap" async defer></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Google Maps Latitude/Longitude Example</h1>
    <div>
        <label for="latitude">Enter Latitude:</label>
        <input type="text" id="latitude" /><br>
        <label for="longitude">Enter Longitude:</label>
        <input type="text" id="longitude" /><br>
        <button onclick="codeLatLng()">Get Location</button>
    </div>
    <div id="map"></div>
    <div id="address"></div>

    <script>
        var geocoder;
        var map;

        function initMap() {
            geocoder = new google.maps.Geocoder();
            var myLatLng = {lat: 21.1702, lng: 72.8311}; // Default to New York
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 12
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Default Location'
            });
        }

        function codeLatLng() {
            var lat = parseFloat(document.getElementById('latitude').value);
            var lng = parseFloat(document.getElementById('longitude').value);
            var latLng = { lat: lat, lng: lng };

            geocoder.geocode({ 'location': latLng }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setCenter(latLng);
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title: 'Location from Latitude/Longitude'
                        });

                        var address = results[0].formatted_address;
                        document.getElementById('address').innerHTML = 'Complete Address: ' + address;
                    } else {
                        document.getElementById('address').innerHTML = 'No results found';
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>
</body>
</html>
