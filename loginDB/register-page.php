<?php
include 'header-admin.php';

/** If no problems encountered, register user in the database */
require 'mysqli-connect.php';

/**
 * This script performs an INSERT query that adds a record to the loginretest table.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); // Initialize an error array.

	// Was the first name entered?
	if (empty($_POST['fname'])) {
		$errors[] = 'You did not enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}

	// Was the last name entered?
	if (empty($_POST['lname'])) {
		$errors[] = 'You did not enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}

	// Was an email address entered?
	if (empty($_POST['email'])) {
		$errors[] = 'You did not enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}

	// Check for a password and match it against the confirmed password
	if (!empty($_POST['psword1'])) {
		if ($_POST['psword1'] != $_POST['psword2']) {
			$errors[] = 'Your two passwords did not match.';
		} else {
			$p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
		}
	} else {
		$errors[] = 'You did not enter your password.';
	}

	/** Start of the SUCCESSFUL SECTION. i.e all the fields were filled out */
	if (empty($errors)) {

		/** Make the query */
		$s = "INSERT INTO logindb (user_id, fname, lname, email, psword, registration_date)
			VALUES (`user_id`, '$fn', '$ln', '$e', SHA1('$p'), NOW())";

		$result = @mysqli_query($dbcon, $s); // Run the query.

		if ($result) {
			/** If it ran OK. */
			header("Location: register-thanks.php");
			exit();

			//End of SUCCESSFUL SECTION
		} else {
			// If the form handler or database table contained errors                       #11

			// Display any error message
			echo '<h2 class="text-center">System Error</h2>
  				<p class="alert-box alert round">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

			// Debug the message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $r . '</p>';
		} // End of if clause ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		include 'footer.php';
		exit();
	} else {
		// Display the errors
		echo '<h2 class="text-center">Error!</h2>
        <p class="alert-box alert round">The following error(s) occurred:<br>';
		foreach ($errors as $msg) {
			// Print each error.                             #12
			echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
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
  	</div>

    <div class="large-12 small-12 columns">
  		<input type="submit" id="submit" name="submit" class="button [radius round]" value="Register">
    </div><!--End of Third Row-->
</form>
<?php include 'footer.php';?>