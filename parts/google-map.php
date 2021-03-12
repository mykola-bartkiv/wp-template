<?php $location = get_field('g_map', 'option');
if (!empty($location)) { ?>
	<div id="map" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"
	     data-marker="<?php the_field('marker', 'option'); ?>"></div>
<?php } ?>
<script>
    var map;
    var styles = [];
    function initMap() {
        $marker = $('#map');
        var latLng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
        var mouseScroll = $(window).width() > 960;
        map = new google.maps.Map(document.getElementById('map'), {
            center: latLng,
            styles: styles,
            zoom: 13,
            scrollwheel: mouseScroll
        });
        var marker = new google.maps.Marker({
            position: latLng,
            icon: $marker.attr('data-marker'),
            map: map
        });
    }
</script>
<style>
	#map {
		height: 500px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtvdPQ8vmyust3oQPrnEBS5hS1RshvRCk&callback=initMap"
        async
        defer></script>

<?php /*get_template_part( 'parts/google-map'); */?>
