<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
		<?php include_once 'college_db.php';?>
    <?php include_once 'map_form.php'; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <meta charset="utf-8">
    <title>Map</title>
    <style>
      #map {
        position: absolute;
        top: 300px;
        bottom: 0;
        left:500px;
        right:0;
      }

    </style>
  </head>
  <body>
    <div id="map"></div>

    <script>

    function create_map()  {

      console.log('<?php echo json_encode($database);?>');

        var college_names = <?php echo json_encode($college_list); ?>;
        var college_lats = <?php echo json_encode($lats); ?>;
        var college_lgns = <?php echo json_encode($longs); ?>;
        var score_rank = <?php echo json_encode($score_rank); ?>;
        console.log(college_names.length);


          var map = L.map('map').setView([0,0], 3);
          L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=87ir7YbEZdEsuLeu67xR', {
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
          }).addTo(map);

          var collegeicon = L.icon({
            iconUrl: 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Science-University-icon.png',
            iconSize: [20,20],
            popupAnchor: [0,-13]
          })

          var i;
          console.log("Number of colleges shown:" + college_names.length);
          for (i = 0; i < college_names.length; i++) {
            //[parseFloat(college_lats[i])+Math.random(), parseFloat(college_lgns[i])+Math.random()];

            college_marker = [parseFloat(college_lats[i]), parseFloat(college_lgns[i])];
            var marker = L.marker(college_marker, {icon:collegeicon}).addTo(map);
            console.log(college_names[i] +"  " +college_marker);
            marker.bindPopup(college_names[i] + "<br> Rank: " +score_rank[i]+ "<br>"+
          "<a href='masters_pgm_db.php?id="+college_names[i]+"'>Details</a>" )
          };
        }

      create_map();
    </script>
  </body>
</html>
