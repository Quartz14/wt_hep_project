<?php include_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>HigherEduGuide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> </head>

<body>
<div id="myNav" class="overlay container">
        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="hep_home.html">HigherEduGuide.com</a>
                    </div>

                    <ul class="nav navbar-nav navbar-right navbar-header">

                        <li>

                            <a onclick="closeNav()">
                                <span class="glyphicon glyphicon-remove"></span>

                            </a>
                        </li>
                    </ul>

                </div>

            </nav>
        </div>
        <!--        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>-->
        <div class="overlay-content">
            <a href="hep_home.html">Home</a>
            <a href="map.php">Universities</a>
            <a href="hep_logout.php">Logout</a>
           
        </div>
    </div>
  
    <div id="main">

        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">HigherEduGuide.com</a>

                    </div>

                    <ul class="nav navbar-nav navbar-right navbar-header">

                        
                        <li>

                            <a onclick="openNav()">
                                <span class="glyphicon glyphicon-menu-hamburger"></span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class=" hamb">

                    <!--                <a onclick="openNav()">-->
                    <button data-toggle="collapse" data-target="#navres">

                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </button>

                </div>

            </nav>

        </div>

        <div id="navres" class="collapse">
            <ul class="nav nav-stacked">
                <li class="active"><a href="hep_home.html">Home</a></li>
                <li><a href="map.php">Universities</a></li>
                <li><a href="hep_logout.php">Logout</a></li>
            </ul>

        </div>

    <?php

    if (!isset($_COOKIE['sid'])){
      echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
    else{      

     echo "<div class='profile-image'>";
      $sql = "SELECT fname,lname FROM student_register WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc())
      {
        echo"<h1>Welcome"." ".$row['fname']." ".$row['lname']."!</h1>";
      }

     echo "</div><div class='profile-content'><div class='container'><div class='row'>";
     echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 general'>";
     $sql = "SELECT du,foi,cgpa FROM student_register WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc())
      {
        echo"<h3>Interested in"." ".$row['foi']."</h3>";
        echo"<h3>".$row['du']." "."aspirant"."</h3>";
        echo"<h3>CGPA :"." ".$row['cgpa']."</h3>";
      }
     echo"</div></div></div>";
      echo "</div><div class='profile-content'><div class='container'><div class='row'>";
      $sql = "SELECT favorite_course FROM student_favorites WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
  // output data of each row
  echo"<div class='col-md-6 col-sm-12 col-xs-12'>
                        <div class='info'>
                            <section>";
  echo "<h3> Your Favorite Programmes</h3>";
  echo "<form action='profile_fav_delete.php' method='GET'>";
  echo "<ul>";
  while($row = $result->fetch_assoc()) {
    //echo "course: " . $row["favorite_course"]. "<br>";
    $email = str_replace(' ','!',$row['favorite_course']);


    echo "<li class='courses'><input name='delete[]' value= ". $email ." type='checkbox'><label  class='strikethrough'>".$row["favorite_course"]."</label></li>";

  }
  echo "<ul>";
  echo "<br><button type='submit'>Delete selected from favorites</button> </form></section></div></div>";
} else {
  echo "<h3>No favorite programmes added yet.</h3>";
}

echo "<div class='col-md-6 col-sm-12 col-xs-12'><div class='info'><section>";

$query = "SELECT University from deadlines";
$result = mysqli_query($conn,$query);
echo "<h5>Select a university to see application deadlines</h5>";
echo "<form method='post'>";
echo "<div class='select'>";
echo "<select name='University'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['University'] ."'>" . $row['University'] ."</option>";
}
echo "</select></div>";
echo "<button type='submit' name='submit_dates'> Get application deadlines </button> </form>";
if(isset($_POST['University'])) {
  $coll = $_POST['University'];


$sql = "SELECT Deadline, Deadline_fa FROM deadlines WHERE University='$coll' ";
$result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
      echo "<br><h4 class='deadline'>Deadline with financial aid: ".$row['Deadline_fa']."</h4>";
      echo "<h4 class='deadline'>Regular Deadline: ".$row['Deadline']."</h4><br>";
  }

}
echo "</section></div></div>";

$conn->close();
}

 ?>
        </div>
    </div>
</div>



    <script>
        function openNav() {
            document.getElementById("myNav").style.height = "100%";

        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }

        function openSearch() {
            document.getElementById("search").style.height = "100px";
        }

        function closeSearch() {
            document.getElementById("search").style.height = "0%";
        }

        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>
</html>