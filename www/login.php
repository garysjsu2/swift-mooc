<?php
/**
 * File: login.php
 * @author Khan Ly <khantly@yahoo.com>
 * @copyright (c) 2015 Khan Ly. All rights reserved.
 */
include("header.php");
include("config.php");
?>

<?php

if (!isset($_POST['submit'])) {
?>
	
	
<h4>Login</h4>

<table class="table">
<tr>
  <td>

<form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="type" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" value="Login" class="btn btn-default">Login</button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <a href="lostpassword.php">Lost password?</a>
    </div>
  </div>
</form>
	
  </td>
</tr>
</table>	
	
<?php
} else {

	$email = $_POST['email'];
	$password = $_POST['password'];
 
	$sql = "SELECT * from users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<p>Logged successfully!</p>";

                            $row = $result->fetch_assoc();
                            $_SESSION["logged"] = TRUE;
                            $_SESSION["id"] = $row['id'];
                            $_SESSION["firstname"] = $row['firstname'];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["email"] = $row['email'];
                            header("location:profile.php"); 
?>
<script type="text/javascript">
<!--
window.location = "profile.php"
//-->
</script>
<?php
	} else {
		echo "<p>Invalid email and/or password</p>";
	}
}
?>
<?php
include("footer.php");
?>		