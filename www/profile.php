<?php
/**
 * File: index.php
 * @author Khan Ly <khantly@yahoo.com>
 */
include("header.php");
include("config.php");
?>

<?php
if(!$_SESSION["logged"]){
   header ('Location: login.php');
   exit();
}
?>

<?php


/* code for data insert */
if(isset($_POST['save']))
{

     $interest = $conn->real_escape_string($_POST['interest']);
	
	 $SQL = $conn->query("INSERT INTO user_profile (userid, interest) VALUES('" . $_SESSION["id"] . "', '$interest')");
	 
	 if(!$SQL)
	 {
		 echo $conn->error;
	 } 
}
/* code for data insert */


/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM user_profile WHERE id=".$_GET['del']);
	header("Location: index.php");
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM user_profile WHERE id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE user_profile SET interest='".$_POST['interest']."' WHERE id=".$_GET['edit']);
	header("Location: index.php");
}
if(isset($_GET['weekly']))
{
        $id = $_SESSION["id"];
        $weekly = $_GET['weekly'];
	$SQL = $conn->query("UPDATE users SET weekly='{$weekly}' WHERE id='{$id}'");
	header("Location: index.php");
}
/* code for data update */

?>

<h4>Profile Information</h4>

<table class="table table-striped table-hover">
<tr>
  <th class="info">User ID</th>
  <th class="info">First Name</th>
  <th class="info">Last Name</th>
  <th class="info">Email</th>
  <td class="info">Weekly Email</th>
</tr>
<tr>
  <td><?=$_SESSION["id"];?></td>
  <td><?=$_SESSION["firstname"];?></td>
  <td><?=$_SESSION["lastname"];?></td>
  <td><?=$_SESSION["email"];?></td>
  <td>
<?php 
$id = $_SESSION["id"];
$sql2 = $conn->query("SELECT weekly FROM users WHERE id='$id'");
$row3 = $sql2->fetch_assoc();
echo ($row3['weekly'] == 1) ? "yes" : "no";
?> 

 (<a href="?weekly=1">yes</a> | <a href="?weekly=0">no</a>)</td>
</tr>
<br />
<br />
<div id="form">
<form method="post">
<table class="table table-striped table-hover">
<tr>
  <th class="info">Interests</th>
</tr>
<tr>
<td><input type="text" name="interest" placeholder="Interest" value="<?php if(isset($_GET['edit'])) echo $getROW['interest'];  ?>" /> (Enter one interest only)</td>
</tr>
<tr>
<td>
<?php
if(isset($_GET['edit']))
{
	?>
        <button type="submit" name="update" class="btn btn-success">update</button>
	<?php
}
else
{
	?>
        <button type="submit" name="save" class="btn btn-success">save</button>
	<?php
}
?>
</td>
</tr>
</table>
</form>

<br /><br />

<table class="table table-striped table-hover">
<tr>
  <th class="info">ID</th>
  <th class="info">Interests</th>
  <th class="info"></th>
  <th class="info"></th>
</tr>
<?php
$res = $conn->query("SELECT * FROM user_profile WHERE userid = '{$_SESSION['id']}'");
while($row=$res->fetch_array())
{
	?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['interest']; ?></td>
    <td><a href="?edit=<?php echo $row['id']; ?>" onclick="return confirm('sure to edit !'); " ><button type="button" class="btn btn-warning">edit</button></a></td>
    <td><a href="?del=<?php echo $row['id']; ?>" onclick="return confirm('sure to delete !'); " ><button type="button" class="btn btn-danger">delete</button></a></td>
    </tr>
    <?php
}
?>
</table>
</div>



<?php
include("footer.php");
?>