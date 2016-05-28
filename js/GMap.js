/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




/* global google */


/*var coords;
 
 $(document).ready(function () {
 if (navigator.geolocation) {
 navigator.geolocation.getCurrentPosition(initMap);
 }
 else {
 error("Geo Location is not supported");
 }
 });/*
 function displayMap(){
 if (navigator.geolocation) {
 navigator.geolocation.getCurrentPosition(initMap);
 }
 else {
 error("Geo Location is not supported");
 }
 }*/



/*
 * function to draw the current location of the map
 * 
 */


var url = "http://166.62.103.147/~ashesics/class2016/beatrice_migaliza/MyRide/public_html/PHP/";

function initMap() {
    
    var ashesi = new google.maps.LatLng(5.644487,-0.1514627999998);
    var destination_place_id = null;
    var origin_place_id = null;
    var travel_mode = google.maps.TravelMode.DRIVING;
    var options = {
        zoom: 17,
	//center:google.maps.LatLng(5.7593,-0.2201),
        scrollwheel: true,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        }
    };

    var map = new google.maps.Map(document.getElementById('MapCanvas'), options);
    /**
     * try geolocation and center the current position of a place
     */
    
    if(navigator.geolocation){
        browserSupportFlag = true;
        var lati;
        var long;
        navigator.geolocation.getCurrentPosition(function(position){
            var initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            lati = position.coords.latitude;
            long = position.coords.longitude;
            map.setCenter(initialLocation);

            var personIcon = new google.maps.MarkerImage("image/personP.png", null, null, null, new google.maps.Size(70, 70));
  
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lati,long),
        map: map,
        title: "Your are here",
        icon: personIcon
    });
         
        },function(){
            handleNoGeolocation(browserSupportFlag);
        });
        
        

        
    }//browser doesn't support geolocation
    else{
        browserSupportFlag = false;
        handleNoGeolocation(browserSupportFlag);
    }
    
    /**
     * function to handle no geolocation 
     * 
     */
    function handleNoGeolocation(errorLog){
        if(errorLog=== true){
            //alert("geolocation service failed");
            initialLocation=ashesi;
        }
        map.setCenter(initialLocation);
    }
    
    
    

    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();

    /*
     * function to place buses on the map
     * @param {type} directionsService
     * @param {type} directionsDisplay
     * @returns {undefined}
     */

    /*function traceBusOnMap() {
        var theURL = url + "request.php?cmd=2";
        var obj = sendRequest(theURL);

        if (obj.result === 1) {
            $.each(obj.coordinates, function (i, coordinates) {
                var bus = coordinates.Bus_name;
                var longitude = coordinates.lon;
                var latitude = coordinates.lat;

                var info = '<div id="content">' + '<div id="siteNotice">' + '<div class="row">' + '<p> <b>Bus Name: ' + bus
                        + '</b></p><p><b> From: ' + '</b></p><p><b>To: ' + '</b><p><b>Next Bus Stop: ' + '</b></p><p><b>Capacity: ' + '</b></p></div>' + '</div></div>';


                var infowindow = new google.maps.InfoWindow({
                    content: info
                });

                var busIcon = new google.maps.MarkerImage("images/logo.png", null, null, null, new google.maps.Size(20, 20));


                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: busIcon,
                    title: bus
                });

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });

            });
        }

    }
    traceBusOnMap();*/
  /*  window.setInterval(function () {
        traceBusOnMap();
    }, 500);*/




    /*function displayBusStops() {
        var theUrl = url + "request.php?cmd=5";
        var object = sendRequest(theUrl);

        if (object.result === 1) {
            var buses = [];
            $.each(object.busStops, function (i, busStops) {
                var latitude = busStops.Latitude;
                var longitude = busStops.Longitude;
                var stopName = busStops.Bus_Stop_Name;
                var busNames = busStops.Bus_Name;

                buses[i] = busNames;

                var info = '<div id="content">' + '<div id="siteNotice">' + '<div class="row">' + '<p> <b>Bus Stop Name: ' + stopName
                        + '</b></p></div></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: info
                });

                var busIcon = new google.maps.MarkerImage("images/busStopI.png", null, null, null, new google.maps.Size(30, 30));

                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: busIcon,
                    title: stopName
                });
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
            });


        }
    }

    displayBusStops();*/

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    var origin = document.getElementById('start');
    var destination = document.getElementById('destination');
    var traficButton = document.getElementById('trafficstatus');
    var floatButton = document.getElementById('mobileShow');


    // push the destination input text box on the map
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination);
    map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(traficButton);
    map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(floatButton);
    


   //s google.maps.event.addDomListener(document.getElementById('trafficstatus'), 'click', diplayTafficStatus);

    //add autocompletion on the search text
    var origin_autocomplete = new google.maps.places.Autocomplete((origin));
    origin_autocomplete.bindTo('bounds', map);
    var destination_autoComplete = new google.maps.places.Autocomplete(destination);
    destination_autoComplete.bindTo('bounds', map);


    /**
     * function to fit the viewport on the screen
     * @param {type} map
     * @param {type} place
     * @returns {undefined}
     */
    function expandviewport(map, place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    }

    /*
     * eventlistener for any change carried on on the map
     */

    origin_autocomplete.addListener('place_changed', function () {
        //alert("at origin autocomplete");
        var place = origin_autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("contained no geometry");
            return;
        }
        expandviewport(map, place);

        /* if the place has geometry store its place id and route it if there is the other place id */
        origin_place_id = place.place_id;
        route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);
    });

    destination_autoComplete.addListener('place_changed', function () {
        //alert("at destination autocomplete");
        var place = destination_autoComplete.getPlace();
        if (!place.geometry) {
            window.alert("Contained no geometry");
            return;
        }
        expandviewport(map, place);

        /* if the place has geometry, store it and route it and route it if there is the other place id */
        destination_place_id = place.place_id;
        route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);

    });


    /**
     * function to draw the route from origin to destination 
     * @param {type} origin_place_id
     * @param {type} destination_place_id
     * @param {type} travel_mode
     * @param {type} directionsService
     * @param {type} directionsDisplay
     * @returns {undefined}
     */
    function route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay) {
        if (!origin_place_id || !destination_place_id) {
            return;
        }

        directionsService.route({
            origin: {'placeId': origin_place_id},
            destination: {'placeId': destination_place_id},
            travelMode: travel_mode},
        function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
            else {
                window.alert('request failed');
            }
        });
    }



    /**
     * function to display traffic status
     * @returns {undefined}
     */
   /* function diplayTafficStatus() {
        var theUrlTraffic = url + "request.php?cmd=18";
        var objectjam = sendRequest(theUrlTraffic);
        if (objectjam.result === 1) {
            $.each(objectjam.jam, function (i, jam) {
                var jamStatus = jam.jam_statement;
                var longitude = jam.longitude;
                var latitude = jam.latitude;
                
                var info = '<div id="content">' + '<div id="siteNotice">' + '<div class="row">' + '<p> <b>Bus Stop Name: ' + jamStatus
                        + '</b></p></div></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: info
                });

                var jamIcon = new google.maps.MarkerImage("images/trafficcolored.png", null, null, null, new google.maps.Size(30, 30));

                var marker1 = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: jamIcon,
                    title: jamStatus
                });
                
                marker1.addListener('click', function () {
                    infowindow.open(map, marker);
                });

            });

        }
        else {
            Materialize.toast(objectjam.message, 4000, 'rounded');
        }
        var theUrlAccident = url + "request.php?cmd=19";
        var objectAccident = sendRequest(theUrlAccident);
        if (objectAccident.result === 1) {
            $.each(objectAccident.accident, function (i, accident) {
                var accidentStatement = accident.Update_Statement;
                var longitude = accident.longitude;
                var latitude = accident.Latitude;

                var accidentIcon = new google.maps.MarkerImage("images/trafficcolored.png", null, null, null, new google.maps.Size(30, 30));

                var marker2 = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: accidentIcon,
                    title: accidentStatement
                });
            });
        }
        else {
            Materialize.toast(objectAccident.message, 4000, 'rounded');
        }

    }*/


}

/*
 * function to send request
 * @param {type} directionsService
 * @param {type} directionsDisplay
 * @returns {undefined}
 */
function sendRequest(u) {
    console.log(u);
    var obj = $.ajax({url: u, async: false});
    var result = $.parseJSON(obj.responseText);
    return result;
}

/**
 * function to trigger the modal form
 */



