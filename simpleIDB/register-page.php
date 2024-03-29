<?php
ob_start();
require 'mysqli-connect.php'; // Connect to the db.
include 'nav.php';
// This script is a query that INSERTs a record in the users table.
// Check that form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array(); // Initialize an error array.
	// Check for a first name:
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = trim($_POST['fname']);
	}
	// Check for a last name:
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = trim($_POST['lname']);
	}
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['psword1'])) {
		if ($_POST['psword1'] != $_POST['psword2']) {
			$errors[] = 'Your two password did not match.';
		} else {
			$p = trim($_POST['psword1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	if (empty($errors)) {
		// If everything's OK.

		// Make the query:
		$q = "INSERT INTO users (user_id, fname, lname, email, psword, registration_date)
        VALUES (`user_id`, '$fn', '$ln', '$e', SHA1('$p'), NOW() )";
		$result = @mysqli_query($dbcon, $q); // Run the query.
		if ($result) {
			// If it ran OK.
			// header ("Location: register-thanks.php");- Line of code not working
			echo '<div data-alert class="alert-box success radius">
  				<i class="fa fa-check fa-2x"> Success !</i>
  				<br>
  				<p class="text-center">Your Registration has been submitted successfully. </p>
  				<a href="#" class="close">&times;</a>
				</div>';
			exit();
			ob_end_flush();
			// Print a message:
			//echo '<h2 class="text-center">Thank you!</h2>
			//<p>You are now registered. In Chapter 12 you will actually be able to log in!</p><p><br></p>';
		} else {
			// If it did not run OK.
			// Public message:
			echo '<h2 class="text-center">System Error</h2>
            <div data-alert class="alert-box alert round">
			<p class="text-center">You could not be registered due to a system error. We apologize for any inconvenience.<a href="#" class="close">&times;</a></p></div>';
			// Debugging message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		} // End of if ($r) IF.
		mysqli_close($dbcon); // Close the database connection.
		exit();
	} else {
		// Report the errors.
		//header ("location: register-page.php");
		echo '<h2 class="text-center">Error!</h2>
		  <div data-alert class="alert-box alert round">
            <p class="text-center">The following error(s) occurred:<br>
               <a href="#" class="close">&times;</a>';
		foreach ($errors as $msg) {
			// Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><h3 class="text-center">Please try again.</h3><p><br></p></div>';
	} // End of if (empty($errors)) IF.
} // End of the main Submit conditional.
?>
<h2 class="text-center">Register</h2>
<!--display the form on the screen-->
<form action="register-page.php" method="post">
  <div class="row"><!--Beginning of First Row-->
  	<div class="large-6 medium-6 small-12 columns">
      <label>First Name
        <input id="fname" type="text" name="fname" size="30" maxlength="30" placeholder="First Name" value="<?php if (isset($_POST['fname'])) {
	echo $_POST['fname'];
}
?>"/>
      </label>
    </div>

     <div class="large-6 medium-6 small-12 columns">
      <label>Last Name
        <input id="lname" type="text" name="lname" size="40" maxlength="40" placeholder="Last Name" value="<?php if (isset($_POST['lname'])) {
	echo $_POST['lname'];
}
?>"/>
      </label>
    </div>
  </div><!--End of First Row-->
  <div class="row"><!--Beginning of Second Row-->
    <div class="large-12 small-12 columns">
      <label>Email
         <input id="email" type="email" name="email" size="50" maxlength="50" placeholder="Email" value="<?php if (isset($_POST['email'])) {
	echo $_POST['email'];
}
?>"/>
      </label>
    </div>
  </div><!--End of Second Row-->
  <div class="row"><!--Beginning of Third Row-->
    <div class="large-6 medium-6 small-12 columns">
      <label>Password
        <input id="psword1" type="password" name="psword1" size="12" maxlength="12" placeholder="Password" value="<?php if (isset($_POST['psword1'])) {
	echo $_POST['psword1'];
}
?>"/>
      </label>
    </div>

    <div class="large-6 medium-6 small-12 columns">
      <label>Confirm Password
        <input id="psword2" type="password" name="psword2" size="12" maxlength="12" placeholder="Confirm Password" value="<?php if (isset($_POST['psword2'])) {
	echo $_POST['psword2'];
}
?>"/>
      </label>
      </div>

      <div class="large-12 small-12 columns">
  	   <input type="submit" id="submit" name="submit" class="button [radius round]" value="Register">
      </div>
    </div><!--End of Third Row-->
</form>
<?php require 'footer.php';?>