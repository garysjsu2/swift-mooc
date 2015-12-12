<?php
/**
 * File: register.php
 * @author Khan Ly <khantly@yahoo.com>
 * @copyright (c) 2015 Khan Ly. All rights reserved.
 */
include("header.php");
include("config.php");
?>

<h4>Register</h4>

<?php
function clean_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if (isset($_POST['submit'])) {

  if (empty($_POST["firstname"])) {
    echo "First Name is required.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  } else {
    $firstname = clean_input($_POST["firstname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
       echo "First Name: Only letters and white space allowed."; 
       echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
       $firstname = "";
       exit();
     }
  }

  if (empty($_POST["lastname"])) {
    echo "Last Name is required.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  } else {
    $lastname = clean_input($_POST["lastname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
       echo "Last Name: Only letters and white space allowed."; 
       echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
       $lastname = "";
       exit();
     }
  }

  if (empty($_POST["email"])) {
    echo "Email is required.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  } else {
    $email = clean_input($_POST["email"]);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       echo "Invalid email format"; 
       echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
       $email = "";
       exit();
     }
  }

  if (empty($_POST["password"])) {
    echo "Password is required.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  } else {
    $password = clean_input($_POST["password"]);
  }

  if (empty($_POST["password2"])) {
    echo "Confirm Password is required.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  } else {
    $password2 = clean_input($_POST["password2"]);
  }

  if ($_POST["password"] != $_POST["password2"]) {
    echo "Password mismatched.";
    echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
    exit();
  }

	# check if username and email exist else insert
	$exists = 0;
	$result = $conn->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");

	if ($result->num_rows == 1) {
		$exists = 1;

	}

	if ($exists == 1) {
		echo "Email already exists.";
                echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
                exit();
	} else {
		$sql = "INSERT INTO users (`id`, `firstname`, `lastname`, `email`, `password`) 
				VALUES (NULL, '{$firstname}', '{$lastname}', '{$email}', '{$password}')";
 
echo $firstname;
echo $lastname;
echo $email;
echo $password;


		if ($conn->query($sql)) {
			echo "<p>Registered successfully!</p>";
            
                        $result = $conn->query("SELECT * from users WHERE email = '{$email}' LIMIT 1");
                        
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $_SESSION["logged"] = TRUE;
                            $_SESSION["id"] = $row['id'];
                            $_SESSION["firstname"] = $row['firstname'];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["email"] = $row['email'];
                        }

                        $to = $row['email'];
                        $subject = "Welcome to MOOC Mashup!";
         
                        $message = "Welcome " . $row['firstname'] . " " . $row['lastname'] . "\r\n";
                        $message .= "Email: " . $row['email'] . "\r\n";
                        $message .= "Password: " . $row['password'] . "\r\n";
         
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                        mail($to,$subject,$message,$header);
?>
<script type="text/javascript">
<!--
window.location = "profile.php"
//-->
</script>
<?php
                        exit();
		} else {
			echo "<p>Registered failed!</p>";
                        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\"> redo</a>";
                        exit();
                }
	}

}
include("register.inc.php");
?>

<?php
include("footer.php");
?>		