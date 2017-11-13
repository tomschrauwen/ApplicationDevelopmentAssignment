
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" />

        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    </head>    
    <body>
        <!--<div id="locations"></div>-->
        <div id="mapid"></div>
        <p>The above map is now showing you the location of the stranger that decided to send his location</p>

<!--        <div id="location_btn" class="btn">Add current location to map!</div>
-->

        <script>
            // location tracking. waarbij locatie over interval wordt geupload en andere gebruiker locatie kan zien op map

            $(document).ready(function () {
                /*$(".btn").mouseenter(function () {
                    $(this).fadeTo('fast', 1);
                });
                $(".btn").mouseleave(function () {
                    $(this).fadeTo('fast', 0.5);
                });
                $("#location_btn").click(function () {
                    getLocation();
                });*/
            });

            var mymap = L.map('mapid').setView([52.1071398, 5.17926159], 8);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; Ieuan\'s OpenTTD World',
                continuousWorld: true,
                tileSize: 256,
                maxZoom: 20
            }).addTo(mymap);

            // the entire database table will be loaded into this
            // object array
            var locationsArray = new Array();
            var locations;
            //change of opacity in recent markers

            // Get a handle to the div in the document named "locations"
            var htmlElement = document.getElementById("locations");

            // This method will load the loactions table
            function retrieveLocations() {
                console.log("retrieve locations");

                // select_locations.php should render the locations table in
                // JSON format
            	var url="./select_locations.php";
                var oReq = new XMLHttpRequest();
                
                // if ./select_locations.php is loaded successfully
                //  this method will be called
                oReq.onload = function(){
                    // JSON can easily be parsed to a JavaScript variable

                	locations = JSON.parse(oReq.response);
                    
                    // Add the location from the JSON object to the div
                    /*locations.forEach(function(location){
                        console.log(location.lat + " " + location.lon);

                        var marker = L.marker([location.lat, location.lon]);//.addTo(mymap);
                        locationsArray.push(marker);
                        mymap.addLayer(locationsArray[i]);
                    });*/
                    emptyMap();
                    for(var i=0; i < locations.length; i++){
                        //more recent markers get a higher opacity
                        var markerOpacity = 0.4 + (0.6 / locations.length)* (i+1);
                        console.log("m o : " + markerOpacity);
                        var marker = L.marker([locations[i].lat, locations[i].lon],{opacity: markerOpacity});//.addTo(mymap);
                        locationsArray.push(marker);
                        mymap.addLayer(locationsArray[i]);
                    }

                }

                // Send the request
                oReq.open("get", url, true);
                oReq.responseType = "text";
                oReq.send();
            }

            function emptyMap(){
                console.log("empty array");
                for(i=0;i<locationsArray.length;i++) {
                    mymap.removeLayer(locationsArray[i]);
                }
            }

            // Automatically call the retrievelocations method
            document.onload = retrieveLocations();
            document.onload = setInterval(function () {
                retrieveLocations();
            }, 5000);

        </script>   
    </body>
</html>