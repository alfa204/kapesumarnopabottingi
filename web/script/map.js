var map;
var markersArray = [];
var count = 0;
var listInfoMarker = [];    //ada title, latitude, longitude

function loadmap() {
    var latlng = new google.maps.LatLng(-6.166092,106.833369);
    var mapOptions = {
        zoom: 10,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    
    //buat addMarker, kalo mouse click di map
    google.maps.event.addListener(map, 'click', function(event) {
        if (markersArray.length>0) {
            deleteOverlays();
        }
        addMarker('my location', event.latLng, true);
    });
}

/*
 * untuk menambah marker overlay (objek) yang ada pada peta
 * marker posisi lokasi objek disimpan dalam markersArray
 */
function addMarker(title, location, draggable) {
    var marker = new google.maps.Marker({
        position : location,
        title : title,
        draggable : draggable,
        map : map
    });
    
    //event buat marker yang didrag (posisi berubah)
    google.maps.event.addListener(marker, 'dragend', function(event){
        marker.setPosition(event.latLng);
        var name = marker.getTitle();
        var position = marker.getPosition();
        updateInfoMarker(name, position);
        sendLocation();
    });
    markersArray.push(marker);
    
    //setiap bikin marker, tambahkan elemen di listInfoMarker
    var latlngStr = location.toString();
    latlngStr = latlngStr.substring(1,latlngStr.length-1);
    latlngStr = latlngStr.split(",", 2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    
    addListInfoMarker(title, lat, lng);
    sendLocation();
}

/*
 * Shows any overlays currently in the array
 */
function showOverlays() {
    //alert(markersArray.length);
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(map);
        }
    }
}

/*
 * Removes the overlays from the map, but keeps them in the array
 */
function clearOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
    }
}

/*
 * Deletes all markers in the array by removing references to them
 */
function deleteOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
    count = 0;
    deleteListInfoMarker();
}

function saveMarkers() {
    form = document.getElementById('saveForm');
    var hidden = null;
    for( index in listInfoMarker ) {
        hidden = document.createElement( 'input' );
        hidden.setAttribute( 'type', 'hidden' );
        hidden.setAttribute( 'name', 'infoMarker[' + index +']' );
        hidden.setAttribute( 'value', listInfoMarker[index] );
        form.appendChild( hidden );
    }
}

/**
 * menambah info marker (title, latitude, longitude)
 * ke dalam array listInfoMarker
 */
function addListInfoMarker(title, lat, lng) {
    var infoMarker = [title, lat, lng];
    listInfoMarker.push(infoMarker);
}

function deleteListInfoMarker() {
    if (listInfoMarker) {
        listInfoMarker.length = 0;
    }
}

function updateInfoMarker(name, position) {
    var location = position.toString();
    location = location.substring(1,location.length-1);
    location = location.split(",", 2);
    var lat = parseFloat(location[0]);
    var lng = parseFloat(location[1]);
    
    //cari elemen di listInfoMarker yang name=name
    deleteListInfoMarker();
    addListInfoMarker(name, lat, lng);
}

function sendLocation() {
    $('input[name=lat_hidden]').attr('value', listInfoMarker[0][1]);
    $('input[name=lon_hidden]').attr('value', listInfoMarker[0][2]);
}