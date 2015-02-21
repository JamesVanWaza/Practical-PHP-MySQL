<?php include 'header.php';?>
<?php include 'nav.php';?>
<?php
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
?>
<h2 class="text-center">Delete a Record</h2>
<?php
/*Check for a valid user ID, through GET or POST*/
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
//Details from view-users.php
	$id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
	/*Form submission*/
	$id = $_POST['id'];
} else {
	echo "<p class='alert-box alert round'>This page has been accessed in error</p>";
	include 'footer.php';
	exit();
}
require 'mysqli-connect.php';
/*Has the form been submitted?*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['sure'] == 'Yes') {
		/*Delete the record
		Make the query
		 */
		$q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
		$result = @mysqli_query($dbcon, $q);
		if (mysqli_affected_rows($dbcon) == 1) {
			/*If there was no problem display a message*/
			echo "<h3>The record has been deleted</h3>";
		} else {
			/*Echo a message if the query failed*/
			echo '<p class="alert-box alert round">The record could not be deleted.<br>Probably because it does not exist or due to a system error</p>'; /*Error message*/
			echo "<p>" . mysqli_error($dbcon) . '<br>Query: ' . $q . "</p>"; //Debugging message
		}
	} else {
		/*Confirmation that the record was not deleted*/
		echo "<h3>The user has not been deleted</h3>";
	}

} else {
	/*Display the form Retrieve the member's data*/
	$q = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_id=$id ";
	$result = @mysqli_query($dbcon, $q);
	if (mysqli_num_rows($result) == 1) {
		/*Valid user ID, display the form
		and get the user's information
		 */
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		/*Display the name of the member being deleted*/
		echo "<h3>Are you sure you want to permanently delete $row[0]?</h3>";

		/*Display the delete page*/
		echo '<form action="delete-record.php" method="post">
  <div class="row">
    <div class="large-6 medium-6 small-12 columns">
		<input type="submit" id="submit-yes" name="sure" value="Yes">
		<input type="submit" id="submit-no" name="sure" value="No">
		<input type="hidden" name="id" value="' . $id . '">
  	</div>
  </div></form>';
	} else {
		/*Not a Valid Member ID*/
		echo '<p class="alert-box alert round">This page has been accessed in error';
	}
	mysqli_close($dbcon);
	echo '<p>&nbsp;</p>';
	include 'footer.php';
}
?>

