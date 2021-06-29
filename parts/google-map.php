<?php $location = get_field('g_map', 'option');
if (!empty($location)) { ?>
	<div id="map" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"
	     data-marker="<?php the_field('marker', 'option'); ?>"></div>
<?php } ?>
<script>
    var map;
    var styles = [];
    function initMap() {
      $map = document.getElementById('map');
      var latLng = new google.maps.LatLng($map.getAttribute('data-lat'), $map.getAttribute('data-lng'));
      map = new google.maps.Map($map, {
                        center: latLng,
                        styles: styles,
                        zoom: 16,
                    });
      var marker = new google.maps.Marker({
                        position: latLng,
                        icon: $map.getAttribute('data-marker'),
                        map: map,
      });
    }
</script>
<style>
	#map {
		height: 500px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php the_field( 'map_api_key', 'option' ) ?>&callback=initMap"
        async
        defer></script>

<?php /*get_template_part( 'parts/google-map'); */?>
