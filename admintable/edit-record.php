<?php
ob_start();
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
include '../html5req.php';
ob_end_flush();
?>
<h2 class="text-center">Edit a Record</h2>
<?php
// After clicking the Edit link in the found_record.php page, the editing interface appears
// The code looks for a valid user ID, either through GET or POST                          #1
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
	// From view-users.php
	$id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
	// Form submission
	$id = $_POST['id'];
} else {
	// If no valid ID, stop the script
	echo "<p class='alert-box alert round'>This page has been accessed in error</p>";
	exit();
}
require 'mysqli-connect.php';
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();
// Look for the first name
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter the first name.';
	} else {
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}
	// Look for the last name
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter the last name.';
	} else {
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}
// Look for the email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter the email address.';
	} else {
		$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}
	if (empty($errors)) {
		// If everything is OK, make the update query
		// Check that the email is not already in the users table
		$q = "UPDATE admintable SET fname='$fn', lname='$ln', email='$e' WHERE user_id=$id LIMIT 1";
		$result = @mysqli_query($dbcon, $q);
		if (mysqli_affected_rows($dbcon) == 1) {
			// If it ran OK
			// Echo a message if the edit was satisfactory
			echo '<div data-alert class="alert-box success radius">
  <i class="fa fa-check fa-2x"> Success !</i>
  <br>
  <h3 class="text-center">The user has been edited.</h3>
  <a href="#" class="close">&times;</a>
</div>';
			exit();
		} else { // Echo a message if the query failed
			echo "<p class='alert-box alert round'>The user could not be edited due to a system error. We apologize for any inconvenience.</p>"; // Error message.
			echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	} else {
		// If the email address is already registered
		echo "<p class='alert-box alert round'>The email address has already been registered.</p>";
	}
} else {
	// Display the errors.
	echo '<p class="alert-box alert round">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		// Echo each error.
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';

} // End of if (empty($errors))section
// Select the record

$q = "SELECT fname, lname, email FROM admintable WHERE user_id=$id";
$result = @mysqli_query($dbcon, $q);
if (mysqli_num_rows($result) == 1) {
	// Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
// Create the form
	echo '<form action="edit-record.php" method="post">
<div class="row">
  <div class="large-6 medium-6 small-12 columns">
  <label for="fname">First Name
  <input id="fname" type="text" name="fname" size="30" maxlength="40" value="' . $row[0] . '">
  </label>
  </div>
  <div class="large-6 medium-6 small-12 columns">
  <label for="lname">Last Name
    <input id="fname" type="text" name="fname" size="30" maxlength="40" value="' . $row[1] . '">
  </label>
  </div>
<div class="large-12 medium-12 small-12 columns">
  <label for="email">Email Address
    <input id="fname" type="text" name="fname" size="30" maxlength="50" value="' . $row[2] . '">
  </label>
  </div>
  <div class="large-6 medium-6 small-12 columns">
    <input id="submit" type="submit" name="submit" value="Edit" class="button [radius round]">
  <input type="hidden" name="id" value="' . $id . '" />
  </div>
</div>
</form>';
} else {
	// The record could not be validated
	echo "<p class='alert-box alert round'>This page has been accessed in error</p>";
}
mysqli_close($dbcon);
?>3
