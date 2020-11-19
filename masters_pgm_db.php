<?php

$servername = "localhost";
$database = "higher_education_universities";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

//$score_rank = array();

$col_name = $_GET['id'];
echo "<h1> Details for ".$col_name."</h1>";
$sql = "SELECT program_name, program_type, tution_1_currency, tution_1_money, tuition_price_specification, ielts_score, structure, city, academic_req FROM master_pgm where university_name='$col_name'";
$result = $conn->query($sql);

if($result) {


echo "<table>
        <th> Programme </th>
        <th> IELTS score </th>
        <th>Tution</th>
        <th colspan='2'>Courses offered</th>
        <th>City</th>
        <th>Academic Requirements</th>
        ";
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //array_push($score_rank, $row['Score_Rank']);
    //<td colspan='2'>".$row['structure']."</td>
    //$courses = trim($row['structure'], "[]'");
    //echo $courses;
    $courses = explode('\', \'',trim($row['structure'], "[]'"));
    if(count($courses)<=1) {
      $courses =array('To be updated');
    }

    $cities = explode('\', \'',trim($row['city'], "[]'"));
    if(count($cities)<1) {
      $cities =array('To be updated');
    }


    echo "<tr>
            <td>".$row['program_type']." - ".$row["program_name"]."</td>
            <td>".$row["ielts_score"]."</td>
            <td>".$row['tuition_price_specification']."  ".$row["tution_1_money"]." ".$row["tution_1_currency"]."</td>
            <td colspan='2'> <ul>"."<li>".implode('</li><li>', $courses)."</li>"."</ul></td>
            <td> <ul>"."<li>".implode('</li><li>', $cities)."</li>"."</ul></td>
            <td>".substr($row['academic_req'],98,-21)."</td>
          </tr>";
/*
    echo "Programme name: ".$row["program_name"]."  Type: ".$row['program_type'];
    echo "<br>";
    echo "tution cost: ".$row["tution_1_money"]." ".$row["tution_1_currency"]. "  ".$row['tuition_price_specification'];
    echo "<br>";
    echo "IELTS score required: ".$row["ielts_score"];
    echo "<br>";
    echo "Courses offered: ". $row['structure'];
    echo "<br>";
    echo "City:  ".$row['city'];
    echo "<br>";
    echo "<br>";
    echo "<br>";
    */
  }
  $result -> free_result();
}
echo "</table>";
}
else {
  echo "<br>";
  echo 'No data';
}



?>
