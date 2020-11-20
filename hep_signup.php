<html>
<div class="content">
<?php
include_once 'db_connect.php';
  if (isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($conn, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($conn, trim($_POST['password2']));
    //$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    //$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    //$location = mysqli_real_escape_string($dbc, trim($_POST['location']));
    //$dob = mysqli_real_escape_string($dbc, trim($_POST['dob']));
    //$username = $_POST{'username'};
    //$password1 = $_POST{'password1'};
    //$password2 = $_POST{'password2'};
    //$name = $_POST{'name'};
    //$phone = $_POST{'phone'};
    //$location = $_POST{'location'};
    //$dob = $_POST{'dob'};




    //&& (!empty($password1))&&(!empty($password2))&&(!empty($name))&&(!empty($phone))&&(!empty($location))&&(!empty($dob))
    //&&(!empty($name))&&(!empty($phone))&&(!empty($location))&&(!empty($dob))

    if (!empty($username)&&(!empty($password1))&&(!empty($password2))){
      //echo 'inside if 2';
      $query = "Select * from student_register where username = '$username'";
      $data = mysqli_query($conn, $query);
      //echo 'executed select <br/>';
      //echo 'New users name'.$username ;
      //echo '<br/>';
      //echo 'New users birthday'.$dob;
      //echo '<br/>';
      if(mysqli_num_rows($data) == 0){
        //, fname, flocation,fphoneno,fdob ,'$name','$location','$phone','$dob'

        $query = "INSERT into student_register (username,password)values('$username',SHA('$password1'))";
        mysqli_query($conn,$query) or die("Error ");

        echo '<p> Success, Your account has been created. <a href="hep_login.php">Login</a>.</p>';
        mysqli_close($conn)

        exit();
      }
      else {
        echo '<p class="error"> An account already exists for this username, please try another username </p>';
        $username="";
      }
    }
    else {
      echo '<p class="error"> Please enter data in all fields</p>';
    }
  }
?>
</div>








<div class="content">


    <p> Please enter the following details to signup </p>

       <div class="form-style-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <fieldset>
        <legend style="color:black;">Registration Info</legend>
        <label for="username"> Username: </label>
        <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username ?>"/><br />
        <label for="password1"> Password: </label>
        <input type="password" id="password1" name="password1" /><br />
        <label for="password2"> Retype Password: </label>
        <input type="password" id="password2" name="password2" /><br />
      </fieldset>
      <input type="submit" name="submit" value="Sign up">

    </form>
  </div>
</div>
     </html>
