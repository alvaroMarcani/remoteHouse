/**
 * Created by ALVARO on 8/10/2018.
 */
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(-17.413977, -66.165321),
        zoom: 6
    });
    new AutoCompleteFunction(map);
}

function AutoCompleteFunction(map) {
    this.map = map;
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');

    // console.log("autocomp");

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        dragabble:true,
        anchorPoint: new google.maps.Point(0, -29)
    });
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    autocomplete.addListener('place_changed', function () {
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
            place.formatted_address + '</div>');

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        marker.setDraggable(true);

        new autocompleteForm(place);
    });

    //Marker listener who catch new position from marker
    google.maps.event.addListener(marker, 'dragend', function()
    {
        document.getElementById('appbundle_house_latitude').value=marker.getPosition().lng();
        document.getElementById('appbundle_house_longitude').value=marker.getPosition().lat();
        // new geocodePosition(marker)
    });
}
function autocompleteForm(place) {
    // var componentForm = {
    //     street_number: 'short_name',
    //     route: 'long_name',
    //     locality: 'long_name',
    //     sublocality: 'long_name',
    //     administrative_area_level_1: 'short_name',
    //     country: 'long_name',
    //     postal_code: 'short_name'
    // };
    //
    // for (var component in componentForm) {
    //     if(document.getElementById(component)!=null){
    //         document.getElementById(component).value = '';
    //         document.getElementById(component).disabled = false;
    //     }
    // }
    //
    // // Get each component of the address from the place details
    // // and fill the corresponding field on the form.
    // for (var i = 0; i < place.address_components.length; i++) {
    //     var addressType = place.address_components[i].types[0];
    //     if (componentForm[addressType]) {
    //         var val = place.address_components[i][componentForm[addressType]];
    //         if(document.getElementById(addressType)!=null){
    //             document.getElementById(addressType).value = val;
    //         }else{
    //             console.log(addressType+" not found");
    //         }
    //
    //     }
    // }

    //Get location and set into values if DOM exists
    // if((document.getElementById('latitude')!=null)&&(document.getElementById('longitude')!=null)){
        document.getElementById('appbundle_house_latitude').value=place.geometry.location.lat();
        document.getElementById('appbundle_house_longitude').value=place.geometry.location.lng();
    // }

}

//fill data if field exists
function geocodePosition(marker) {
    var geocoder = new google.maps.Geocoder();
    var location = new google.maps.LatLng(marker.getPosition().lat(),marker.getPosition().lng() );
    geocoder.geocode({ 'location': location }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                document.getElementById('street_number').value=results[1].address_components[0].long_name;
                document.getElementById('sublocality').value=results[1].address_components[1].long_name;
                console.log(results[1].address_components[2].long_name);
                console.log(results[1].address_components[3].long_name);
            }
        }
    });
}

function loadStoredMarker($lat, $long) {
    var latLong=new google.maps.LatLng(parseFloat($long),parseFloat($lat));
    var marker2 = new google.maps.Marker({
        position: latLong,
        map: map,
        title: "Mi casa"
    });
}