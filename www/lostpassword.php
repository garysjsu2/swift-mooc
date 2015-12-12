<?php
/**
 * File: lostpassword.php
 * @author Khan Ly <khantly@yahoo.com>
 * @copyright (c) 2015 Khan Ly. All rights reserved.
 */
include("header.php");
include("config.php");
?>

<?php

if (!isset($_POST['submit'])) {
?>
	
	
<h4>Lost Password?</h4>

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
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" value="Login" class="btn btn-default">Send Password</button>
    </div>
  </div>
</form>
	
  </td>
</tr>
</table>	
	
<?php
} else {

	$email = $_POST['email'];

     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
 
	$sql = "SELECT * from users WHERE email = '{$email}' LIMIT 1";
	$result = $conn->query($sql);
	if (!$result->num_rows == 1) {
		echo "<p>Invalid email and/or email not found.</p>";
                echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
	} else {
                        $row = $result->fetch_assoc();
                        $to = $row['email'];
                        $subject = "Retrieve Password!";
         
                        $message = $row['firstname'] . " " . $row['lastname'] . "\r\n";
                        $message .= "Email: " . $row['email'] . "\r\n";
                        $message .= "Password: " . $row['password'] . "\r\n";
         
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
         
                        mail($to,$subject,$message,$header);
                        echo "Password Sent!";
	}
     } else {
       echo "Invalid email format"; 
       echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
     }
    
}
?>

<?php
include("footer.php");
?>		