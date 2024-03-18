function initMap() {
    // Initialize the map at a default position
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
        mapId: 'roadmap'
    });

    // Initialize the autocomplete functionality
    initAutocomplete();

    // Attach click event listener to the location dot button
    document.querySelector('.input-group-text .btn').addEventListener('click', locateUser);
}


// create maker function 

function createMarker(position, map, title) {
    // Assuming AdvancedMarkerElement can be initialized similarly to Marker
    // Please check the latest Google Maps JavaScript API for the correct usage
    var marker = new google.maps.marker.AdvancedMarkerElement({
        position: position,
        map: map,
        title: title
    });
    return marker;
}

function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), { types: ['geocode'] }
    );

    autocomplete.bindTo('bounds', map);

    // Initialize a marker variable outside the listener to make it accessible for repositioning.
    let marker = null;

    // Set up the place_changed event listener.
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why not give them a close-up?
        }

        // If a marker exists, set its position to the new location. If not, create a new marker.
        if (marker) {
            marker.setPosition(place.geometry.location);
        } else {
            // marker = new google.maps.Marker({
            //     map: map,
            //     position: place.geometry.location
            // });
            marker = createMarker(place.geometry.location, map, place.name);
        }

        // Update the latitude and longitude input fields
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });
}




function locateUser() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Update the map to the current location
            map.setCenter(pos);
            map.setZoom(17);
           

            // Use reverse geocoding to get the address
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': pos}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById('autocomplete').value = results[0].formatted_address;
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });

            // Place a marker on the current location
            // var marker = new google.maps.marker.AdvancedMarkerElement({
            //     position: pos,
            //     map: map,
            //     title: 'Your Location'
            // });
            createMarker(pos, map, 'Your Location');

            // Update the latitude and longitude input fields
            document.getElementById('latitude').value = pos.lat;
            document.getElementById('longitude').value = pos.lng;
        }, function() {
            window.alert('Error: The Geolocation service failed.');
        });
    } else {
        // Browser doesn't support Geolocation
        window.alert('Error: Your browser doesn\'t support geolocation.');
    }
}

// Toggle the service panel
document.getElementById('serviceRequestButton').onclick = function() {
    var servicePanel = document.getElementById('servicePanel');
    servicePanel.style.display = servicePanel.style.display === "none" ? "block" : "none";
};


function selectOption(selectedDiv) {
    // Remove 'selected' class from all options
    var options = document.querySelectorAll('.service-option .option');
    options.forEach(function(option) {
        option.classList.remove('selected');
    });

    // Add 'selected' class to the clicked option
    selectedDiv.classList.add('selected');

    // Check if the selected option is "Car Only"
    if (selectedDiv.querySelector('p').textContent === "Car Only") {
        // Show the modal with jQuery
        $("#carModal").modal('show');
    }
}