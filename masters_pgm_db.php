<?php include_once 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles_details.css">
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
<style>
.fa {
  font-size: 30px;
  cursor: pointer;
  user-select: none;
  color:black;
}

.fa:hover {
  color: red;
}
</style>

  </head>
  <body>
    Filter: <input type="text" id = "filter_course" name="filter_course" placeholder="Enter course of intrest">
    Display favorites: <input type="button" name="fav" value="add to favorites" onclick="get_fav()">



    <script>

    $(document).ready(function() {
      $("#filter_course").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#courses tr").filter(function() {
          $(this).toggle($(this).find('td:first').text().toLowerCase().indexOf(value)>-1)
        });
      });
    });


    function myFunction(x) {
      if(x.style.color == "tomato") {
        x.style.color = "black";
      } else {
        x.style.color = "tomato";
      }

    }



    function get_fav() {
      var fav_program = [];
      //console.log('inside get_fav function');
      $('#courses tr').filter(function() {
        //console.log('inside tr filter');
        if($(this).find('td:eq(1) i.fa').css( "color" )!='rgb(0, 0, 0)') {
          //var color2 = $( this ).css( "color" );
          //console.log('color: red '+color2);
          course_name =$(this).find('td:eq(0)').text();
          if(course_name.length>0) {
            //console.log(course_name);
            fav_program.push(course_name);
          }

        }
        //return $(this).find('td').css('color') == 'black';
      })
      console.log(fav_program);
      console.log("-------------------------------------");
      var catt = 'cat';
      <?php $cat = "dog"; ?>;
      $.ajax({
        url: './profile_fav.php/',

                    method: "GET",

                    data: {'cat' : fav_program},

                    success: function(data, url)
                    {
                        alert("success!");
                        //window.location.href = this.url;
                        //window.location.href = 'profile_fav.php';
                    }
                });
    }

    </script>







  </body>
</html>


<?php








if (!isset($_COOKIE['sid'])){
  echo '<p class="login"> Please <a href="hep_login.php">log in</a> to access this page';}
else{
  $query = "select username from student_register where sid='" . $_COOKIE['sid'] ."'";
  $data = mysqli_query($conn,$query) or die(mysql_error());
  $row = mysqli_fetch_array($data);
  echo('<p><a href="profile.php">Profile</a></p>');
  echo '<a href="hep_logout.php">Log Out (' . $_COOKIE['username'] . ')</a><br>';
  echo "<a href='map.php'>go to map</a><br>";
  echo "<a href='hep_home.html'>Home</a><br>";
  //echo '<p>"Welcome ".$farmer_name.</p>';





//$score_rank = array();

$col_name = $_GET['id'];
echo "<h1> Details for ".$col_name."</h1>";
$sql = "SELECT program_name, program_type, tution_1_currency, tution_1_money, tuition_price_specification, ielts_score, structure, city, academic_req FROM master_pgm where university_name='$col_name'";
$result = $conn->query($sql);

if($result) {


echo "<table id=courses>
        <th> Programme </th>
        <th> Like </th>
        <th> IELTS score </th>
        <th>Tution</th>
        <th colspan='2'>Courses offered</th>
        <th>City</th>
        <th>Academic Requirements</th>
        ";
echo "<tbody>";
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
            <td>".$row['program_type']." - ".$row['program_name']."</td>
            <td><i onclick=myFunction(this) class='fa fa-heart'> </i> </td>
            <td>".$row["ielts_score"]."</td>
            <td>".$row['tuition_price_specification']."  ".$row["tution_1_money"]." ".$row["tution_1_currency"]."</td>
            <td colspan='2'> <ul>"."<li>".implode('</li><li>', $courses)."</li>"."</ul></td>
            <td> <ul>"."<li>".implode('</li><li>', $cities)."</li>"."</ul></td>
            <td>".substr($row['academic_req'],98,-21)."</td>
          </tr>";
/*
    echo "Programme name: ".$row["program_name"]."  Type: ".$row['program_type'];
    <?php echo(json_encode($row[program_name]));?>
    <td><i onclick='like_button(this)' class='fa fa-thumbs-up'></i></td>
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
    <script>
    function like_button(x) {
      //x.classList.toggle("fa-thumbs-down");
      if (document.heart.src=='icons/heart-regular.svg'){
        document.heart.src='icons/heart-solid.svg';}
      else if (document.heart.src=='icons/heart-solid.svg'){
        document.heart.src='icons/heart-regular.svg';
      }
      //x.css("color", "green");

    }

    </script>
    */
  }
  $result -> free_result();
}
echo "</tbody>";
echo "</table>";
}
else {
  echo "<br>";
  echo 'No data';
}
}


?>
