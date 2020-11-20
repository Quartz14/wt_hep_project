<html>
<div class="content">
<?php
include_once 'db_connect.php';
$error_msg = "";
if (!isset($_COOKIE['sid'])){
  if (isset($_POST['submit'])){


    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    echo $username;
    echo $password;


    if (!empty($username) && !empty($password)){
      $query = "select username,sid from student_register where username='$username' and password = '$password'";
      $data = mysqli_query($conn, $query);

      if (mysqli_num_rows($data) == 1){
        $row = mysqli_fetch_array($data);
        setcookie('sid', $row['sid']);
        setcookie('username', $row['username']);
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/profile.php';
        header('Location: ' . $home_url);

      }
      else{
        $error_msg = "Sorry, You have entered invalid username or password.";
        echo '<a style="color:red;" href="hep_signup.php">Not a registered user? Please register here</a><br />';
        echo $error_msg;
      }
    }
    else{
      $error_msg = "Sorry, You must enter username and password to login.";
      echo $error_msg;
      echo '<br /><a href="hep_signup.php">Not a registered user? Please register here</a><br />';

    }
  }
}

 ?>
</div>

  <head>
    <title>Higher Education Platform</title>
  </head>
  <body>
    <div class="content">
    <h3>Student Log In</h3>

       <div class="form-style-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <fieldset>
        <legend style="color:black;">Log in</legend>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>"/><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"/>
      </fieldset>
      <input type="submit" name="submit" value="Log In"/>

    </form>
  </div>
</div>
  </body>
</html>
