<?php
ob_start();
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
include 'nav.php';
ob_end_flush();
?>
<h2>Edit an Address or Phone number</h2>
<?php
/*After clicking the Edit Link found-record.php page, the editing interface appears*/
/*The code looks for a valid user ID, either through GET or POST*/
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
//From view-users.php
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
	$errors = array();

	/*Look for the first name*/
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter the first name.';
	} else {
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}

	/*Look for the last name*/
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}

	/*Look for the email address*/
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}
if (empty($errors)) { // If everything's OK.
    //  make the query
        $q = "SELECT user_id FROM finalpost WHERE lname='$ln' AND user_id != $id";
    $result = @mysqli_query($dbcon, $q);
    if (mysqli_num_rows($result) == 0) {
    // Make the update query:
      $q = "UPDATE finalpost SET title='$title', fname='$fn', lname='$ln', addr1='$addr1', addr2='$addr2', city='$city', county='$county', pcode='$pcode', phone='$phone' WHERE user_id=$id LIMIT 1";
      $result = @mysqli_query ($dbcon, $q);
      if (mysqli_affected_rows($dbcon) == 1) { // If it ran OK.
      // Echo a message if the edit was satisfactory:
        echo '<h3>The user has been edited.</h3>';
            } else { // Echo a message if the query failed.
        echo '<p class="alert-box alert round">The user could not be edited due to a system error<br>We apoligize for any inconvience</p>'; // Public message.
        echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
      }
      //} else { // Already registered.
      //echo '<p class="error">The email address has already been registered.</p>';
    }
    }else {
	//Display the errors
	echo '<p class="alert-box alert round">The following errors occured:<br>';
	foreach ($errors as $msg) {
		/*Echo each error*/
		echo "- $msg<br>\n";
	}
	echo '</p><p>Please try again</p>'; /*Error message*/
	echo "<p>" . mysqli_error($dbcon) . '<br>Query: ' . $q . "</p>"; //Debugging message
}//End of if(empty($errors)) section

//Select the record
$q = "SELECT title, fname, lname, addr1, addr2, city, county, pcode, phone FROM finalpost WHERE user_id=$id";
$result = @mysqli_query($dbcon, $q);
if (mysqli_num_rows($result) == 1) {
	/*Valid user ID, display the form
	and get the user's information
	 */
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	/*Create the Form*/
	echo '<form action="edit-record.php" method="post">
  <div class="row">
    <div class="large-6 medium-6 small-12 columns">
      <label>First Name
        <input id="fname" type="text" name="fname" size="30" maxlength="30" placeholder="First Name" value=" ' . $row[0] . '"/>
      </label>
    </div>
     <div class="large-6 medium-6 small-12 columns">
      <label>Last Name
        <input id="lname" type="text" name="lname" size="40" maxlength="40" placeholder="Last Name" value=" ' . $row[1] . '"/>
      </label>
    </div>
  </div><!--End of First Row-->
  <div class="row"><!--Beginning of Second Row-->
    <div class="large-12 small-12 columns">
      <label>Email
         <input id="email" type="email" name="email" size="50" maxlength="50" placeholder="Email" value=" ' . $row[2] . '"/>
      </label>
    </div>
      <div class="large-12 small-12 columns">
    <input type="submit" id="submit" name="submit" class="button [radius round]" value="Edit">
    <br><input type="hidden" name="id" value="' . $id . '">
  </div>
    </div><!--End of Third Row-->
</form>';
} else {
	/*The record could not be validated*/
	echo '<p class="alert-box alert round">This page has been accessed in error';
}
mysqli_close($dbcon);
include 'footer.php';
?>
