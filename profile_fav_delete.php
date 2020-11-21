<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="map.php">go to map</a><br>
    <a href="hep_home.html">Home</a><br>
    <a href="profile.php">Profile</a>
  </body>
</html>
<?php include_once 'db_connect.php';
echo "<br>";
if (!isset($_COOKIE['sid'])){
  echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
else{

  echo '<a href="hep_logout.php">Log Out (' . $_COOKIE['username'] . ')</a>';

echo "<br><br>";
 foreach($_GET['delete'] as $fcourse){
   $email = str_replace('!',' ',$fcourse);
     $sql = "DELETE FROM student_favorites WHERE sid ='". $_COOKIE['sid'] ."' and favorite_course='$email'";
     $result = $conn->query($sql);
     if(mysqli_query($conn, $sql))
     {
          echo $email. ' deleted from favorites <br>';
     }
 }
 }
?>
