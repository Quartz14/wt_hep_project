<?php
if (!isset($_COOKIE['sid'])){
  echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page<br>';
echo "<a href='hep_home.html'>Home</a>";}
else{

  echo'    
    <div id="main">

        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="mapnav" href="hep_home.html">HIGHEREDUGUIDE.COM</a>

                    </div>

                    <ul class="nav navbar-nav navbar-right navbar-header">

                        <li class="nav-item dropdown" >
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <span class="glyphicon glyphicon-menu-hamburger"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding:10px;">
                                <a style="margin:10px;border:transparent;border-radius: 0px;width:100%;" class="dropdown-item" href="hep_home.html">Home</a>
                                 <div class="dropdown-divider"></div>
                                <a style="margin:10px;border:transparent;border-radius: 0px;width:100%;" class="dropdown-item" href="profile.php">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a style="margin:10px;border:transparent;border-radius: 0px;width:100%;" class="dropdown-item" href="hep_logout.php">Logout</a>
                                </div>
                        </li>

                    </ul>
                </div>
                <div class=" hamb">
                    <button data-toggle="collapse" data-target="#navres">

                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </button>

                </div>

            </nav>

        </div>

        <div id="navres" class="collapse">
            <ul class="nav nav-stacked">
                <li><a href="hep_home.html">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="hep_logout.php">Logout</a></li>
            </ul>

        </div>';

  include_once 'college_db.php';
  include_once 'map_form.php';
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>Map</title>
    <style>
      #map {
        position: absolute;
        top: 45%;
        bottom: 0;
        left:50%;
        right:0;
        width:50%;
        height: 100%;
      }
    </style>
  </head>
  <body>
      <div class="container-fluid">
      <div class="row">
        <div id="map"></div>
      </div>
    </div>


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

     <script>


        


        function openNav() {
            document.getElementById("myNav").style.height = "100%";

        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }

        
    </script>

  </body>
</html>
