<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    </head>

    <body onload="getLocation()">

        <button onclick="getLocation()">Click me</button>
        <div id="demo"></div>
        <div id="mapid"></div>

        <style>
            #mapid { height: 390px; }
        </style>
        
        <script>
            var x = document.getElementById("demo");

            function getLocation(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                x.innerHTML = "Latitude: " + position.coords.latitude +
                    "<br>Longitude: " + position.coords.longitude;

                var url = "http://localhost/test.php?" + "lat=" + position.coords.latitude + "&lon=" + position.coords.longitude;
                var oReq = new XMLHttpRequest();
                oReq.responseType = "html";
                oReq.open("get", url, true);
                oReq.send();

                var mymap = L.map('mapid').setView([52.1071398, 5.17926159], 13);

                var lat = 52.1071398;
                var lon = 5.17926159;
                var marker = L.marker([lat, lon]).addTo(mymap);
                L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; Ieuan\'s OpenTTD World',
                    continuousWorld: true,
                    tileSize: 256,
                    maxZoom: 20
                }).addTo(mymap);
            }
        </script>   
    </body>

</html>