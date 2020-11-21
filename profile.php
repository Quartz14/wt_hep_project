<?php include_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>See Map</h1>
    <a href="map.php">go to map</a>
    <a href="hep_home.html">Home</a>
    <br>
    <?php

    if (!isset($_COOKIE['sid'])){
      echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
    else{

      echo '<a href="hep_logout.php">Log Out (' . $_COOKIE['username'] . ')</a>';
      //echo '<p>"Welcome ".$farmer_name.</p>';


      $sql = "SELECT favorite_course FROM student_favorites WHERE sid='" . $_COOKIE['sid'] ."'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
  // output data of each row
  echo "<br><h3> Your favorite programmes: <br></h3>";
  echo "<form action='profile_fav_delete.php' method='GET'>";
  echo "<ul>";
  while($row = $result->fetch_assoc()) {
    //echo "course: " . $row["favorite_course"]. "<br>";
    $email = str_replace(' ','!',$row['favorite_course']);


    echo "<li><input name='delete[]' value= ". $email ." type='checkbox'>".$row["favorite_course"]."</li>";

  }
  echo "<ul>";
  echo "<br><button type='submit'>Delete selected from favorites</button> </form>";
} else {
  echo "<br>No favorite programmes added yet.";
}

$query = "SELECT University from deadlines";
$result = mysqli_query($conn,$query);
echo "<br><br>Select a university to see application deadlines";
echo "<br><form method='post'>";
echo "<br><select name='University'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['University'] ."'>" . $row['University'] ."</option>";
}
echo "</select>";
echo "<button type='submit' name='submit_dates'> Get application deadlines </button> </form>";
if(isset($_POST['University'])) {
  $coll = $_POST['University'];


$sql = "SELECT Deadline, Deadline_fa FROM deadlines WHERE University='$coll' ";
$result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
      echo "<br>Deadline with financial aid: ".$row['Deadline_fa']."<br>";
      echo "Regular Deadline: ".$row['Deadline']."<br>";
  }

}


$conn->close();
}

 ?>

  </body>
</html>
