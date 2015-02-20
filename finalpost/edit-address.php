<?php
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: header-members.php");
	exit();
}
?>
<h2>Edit an Address or Phone number</h2>
<?php
// After clicking the Edit link in the register_found_record.php page. This editing interface appears
// Look for a valid user ID, either through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
	// From view-users.php
	$id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
	// Form submission.
	$id = $_POST['id'];
} else {
	// No valid ID, kill the script.
	// No valid ID, kill the script.
	echo "<p class='alert-box alert round'>This page has been accessed in error</p>";
	include 'footer.php';
	exit();
}
require 'mysqli-connect.php';
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();
	// Look for the first title:
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter the title.';
	} else {
		$title = mysqli_real_escape_string($dbcon, trim($_POST['title']));
	}
	// Look for the first name:
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter the first name.';
	} else {
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}
	// Look for the last name:
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter the last name.';
	} else {
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}
	// Look for the 1st address:
	if (empty($_POST['addr1'])) {
		$errors[] = 'You forgot to enter the first address.';
	} else {
		$addr1 = mysqli_real_escape_string($dbcon, trim($_POST['addr1']));
	}
	// Look for address 2:
	if (!empty($_POST['addr2'])) {
		$addr2 = mysqli_real_escape_string($dbcon, trim($_POST['addr2']));
	} else {
		$addr2 = NULL;
	}
	// Look for the city:
	if (empty($_POST['city'])) {
		$errors[] = 'You forgot to change the city.';
	} else {
		$city = mysqli_real_escape_string($dbcon, trim($_POST['city']));
	}
	// Look for the county:
	if (empty($_POST['county'])) {
		$errors[] = 'You forgot to change the county.';
	} else {
		$county = mysqli_real_escape_string($dbcon, trim($_POST['county']));
	}
	// Look for the post code
	if (empty($_POST['pcode'])) {
		$errors[] = 'You forgot to enter the post code.';
	} else {
		$pcode = mysqli_real_escape_string($dbcon, trim($_POST['pcode']));
	}
	// Look for the phone number:
	if (!empty($_POST['phone'])) {
		$phone = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
	} else {
		$phone = NULL;}
	if (empty($errors)) {
		// If everything's OK.
		//  make the query
		$q = "SELECT user_id FROM postaldb WHERE lname='$ln' AND user_id != $id";
		$result = @mysqli_query($dbcon, $q);
		if (mysqli_num_rows($result) == 0) {
			// Make the update query:
			$q = "UPDATE postaldb SET title='$title', fname='$fn', lname='$ln', addr1='$addr1', addr2='$addr2', city='$city', county='$county', pcode='$pcode', phone='$phone' WHERE user_id=$id LIMIT 1";
			$result = @mysqli_query($dbcon, $q);
			if (mysqli_affected_rows($dbcon) == 1) {
				// If it ran OK.
				// Echo a message if the edit was satisfactory:
				echo '<h3>The user has been edited.</h3>';
			} else {// Echo a message if the query failed.
				echo '<p class="alert-box alert round">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
			//} else { // Already registered.
			//echo '<p class="error">The email address has already been registered.</p>';
		}
	} else {
		// Display the errors.
		echo '<p class="alert-box alert round">The following error(s) occurred:<br>';
		foreach ($errors as $msg) {
			// Echo each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	}// End of if (empty($errors))section.
}// End of the conditionals
// Select the user's information:
$q = "SELECT title, fname, lname, addr1, addr2, city, county, pcode, phone FROM postaldb WHERE user_id=$id";
$result = @mysqli_query($dbcon, $q);
if (mysqli_num_rows($result) == 1) {
	// Valid user ID, display the form.
	// Get the user's information:
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	// Create the form:
	echo '<form action="edit-address.php" method="post">
<div class="row">
<div class="large-4 medium-4 small-12 columns">
  <label for="title">Title:</label><input id="title" type="text" name="title" size="30" maxlength="30" value="' . $row[0] . '">
</div>
<div class="large-4 medium-4 small-12 columns">
  <label for="fname">First Name:</label><input id="fname" type="text" name="fname" size="30" maxlength="30" value="' . $row[1] . '">
</div>
<div class="large-4 medium-4 small-12 columns">
  <label for="lname">Last Name:</label><input id="lname" type="text" name="lname" size="30" maxlength="40" value="' . $row[2] . '">
</div>
</div>
<div class="row">
<div class="large-6 medium-6 small-12 columns">
  <label for="addr1">Address:</label><input id="addr1" type="text" name="addr1" size="30" maxlength="50" value="' . $row[3] . '">
</div>
<div class="large-6 medium-6 small-12 columns">
  <label for="addr2">Address:</label><input id="addr2"type="text" name="addr2" size="30" maxlength="50" value="' . $row[4] . '">
</div>
</div>
<div class="row">
<div class="large-3 medium-3 small-12 columns">
  <label for="city">City:</label><input id="city" type="text" name="city" size="30" maxlength="30" value="' . $row[5] . '">
</div>
<div class="large-3 medium-3 small-12 columns">
  <label for="county">County:</label><input id="county"type="text" name="county" size="30" maxlength="30" value="' . $row[6] . '">
</div>
<div class="large-3 medium-3 small-12 columns">
  <label for="pcode">Post Code:</label><input id="pcode"type="text" name="pcode" size="15" maxlength="15" value="' . $row[7] . '">
</div>
<div class="large-3 medium-3 small-12 columns">
  <label for="phone">Phone:</label><input id="phone"type="text" name="phone" size="15" maxlength="15" value="' . $row[8] . '">
</div>
<input class="button [radius round]" id="submit" type="submit" name="submit" value="Edit">
<input type="hidden" name="id" value="' . $id . '">
</div>
</form>';
} else {
	// The user could not be validated
	echo '<p class="alert-box alert round">This page has been accessed in error.</p>';
}
mysqli_close($dbcon);
include 'footer.php';
?>
