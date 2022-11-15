<?php $location = get_field( 'map', 'option' );
if ( ! empty( $location ) ) { ?>
    <div class="map contact-map">
        <div class="marker" data-color="#ea4335" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>">
            <span><?php echo esc_html( $location['address'] ); ?></span>
        </div>
    </div>
<?php } ?>

<?php if ( $MAP_API_KEY = get_field( 'map_api_key', 'option' ) ) : ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $MAP_API_KEY; ?>" async defer></script>
    <?php /*OR*/; ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $MAP_API_KEY; ?>"></script>
<?php endif; ?>

<script>
    //==== Map Functionality ====
    /*
    *  render_map
    *
    *  This function will render a Google Map onto the selected jQuery element
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$el (jQuery element)
    *  @return	n/a
    */

    function render_map($el) {
        // var
        var $markers = $el.find('.marker');

        // vars
        var args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        // create map
        var map = new google.maps.Map($el[0], args);

        // add a markers reference
        map.markers = [];

        // add markers
        $markers.each(function () {

            add_marker($(this), map);

        });

        // center map
        center_map(map);

    }

    /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$marker (jQuery element)
    *  @param	map (Google Map object)
    *  @return	n/a
    */

    function add_marker($marker, map) {
        // var
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        // create marker SVG
        var icon = {
            path: 'M10.1,29.4C1.6,17,0,15.8,0,11.3C0,5,5,0,11.3,0s11.3,5,11.3,11.3c0,4.6-1.6,5.8-10.1,18.1C11.9,30.2,10.7,30.2,10.1,29.4  L10.1,29.4z M11.3,15.9c2.6,0,4.7-2.1,4.7-4.7s-2.1-4.7-4.7-4.7s-4.7,2.1-4.7,4.7S8.7,15.9,11.3,15.9z',
            fillColor: $marker.attr('data-color') || '#ea4335',
            fillOpacity: 1,
            anchor: new google.maps.Point(11, 30),
            strokeWeight: 0,
            scale: 1,
        };

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icon,
        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html(),
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {

                infowindow.open(map, marker);

            });
        }

    }

    /*
    *  center_map
    *
    *  This function will center the map, showing all markers attached to this map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	map (Google Map object)
    *  @return	n/a
    */

    function center_map(map) {
        // Create map boundaries from all map markers.
        var bounds = new google.maps.LatLngBounds();
        map.markers.forEach(function (marker) {
            bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng(),
            });
        });

        // Case: Single marker.
        if (map.markers.length === 1) {
            map.setCenter(bounds.getCenter());

            // Case: Multiple markers.
        } else {
            map.fitBounds(bounds);
        }

    }

    //==== End Map Functionality ====
    
    //==== Maps Init ====
    var maps = $('.map');
    maps.length && maps.each(function () {
        render_map($(this));
    });
    //==== End Maps ====
</script>

<?php /*get_template_part( 'parts/google-map'); */ ?>
