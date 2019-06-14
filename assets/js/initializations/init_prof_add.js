var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};
function initialize() {
    var complete_address = document.getElementById('complete_address');
    var autocomplete = new google.maps.places.Autocomplete(complete_address);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('user_lat').value = place.geometry.location.lat();
        document.getElementById('user_lng').value = place.geometry.location.lng();
        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
        // console.log('Address Comps')
        // console.log(place.address_components);
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            console.log('Address Loops')
            console.log(place.address_components[i][componentForm[addressType]])
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
                $('#'+addressType).removeAttr('disabled');
            }
        }

    });
}
google.maps.event.addDomListener(window, 'load', initialize); 

jQuery(function($){
    var input = $('[type=tel]')
    input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
    input.bind('country.mobilePhoneNumber', function(e, country) {
      $('.country').text(country || '')
    })
});