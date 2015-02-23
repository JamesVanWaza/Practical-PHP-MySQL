<?php include '../html5req.php';; ?>
<?php include('nav.php'); ?>
<?php
	/*This Page lets users change their password*/
	/*Was the submit button clicked*/
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'mysqli-connect.php'; //Connect to the database
		$errors = array(); //Initialize the error array
		/*Check for an email address*/
		if (empty($_POST['email'])) {
			$errors[] = 'You forgot to enter your email address';
		}
		else {
			$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
		}
		/*Check for the current password*/
		if (empty($_POST['psword'])) {
			$errors[] = 'You forgot to enter your current password';
		}
		else {
			$p = mysqli_real_escape_string($dbcon, trim($_POST['psword']));
		}
		/*Check for a new password and match against the confirmed password*/
		if (!empty($_POST['psword1'])) {
			if ($_POST['psword1'] != $_POST['psword2']) {
				$errors[] = 'Your new password did not match the confirmed passsword';
			} else {
				$np = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
			}
		}
		else {
			$errors[] = 'You forgot to enter your email address';
		}
		if (empty($errors)) { //If No Problems occured
			/*Check that the user has entered the right email address/password combination*/
			$q = "SELECT user_id FROM users WHERE(email='$e' AND psword=SHA1('$p'))";
			$result = @mysqli_query($dbcon, $q);
			$num = @mysqli_num_rows($result);
			if ($num == 1) { //Match was made
				//Get the user_id
				$row = mysqli_fetch_array($result, MYSQLI_NUM);
				// Make the Update Query:
				$q = "UPDATE users SET psword=sha1('$np') WHERE user_id=$row[0]";
				$result = @mysqli_query($dbcon, $q);
			if (mysqli_affected_rows($dbcon)==1) { //If the query ran without a problem
				//Echo a message
				echo '<h2 class="text-center">Thank You!</h2>
				<h3>Your Password has been updated</h3>';
			} else { /*If it encountered a problem
				Error Message
			*/
				echo '<h2 class="text-center">System Error</h2><p class="alert-box alert round">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
				//Debugging message
				echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
			}
			mysqli_close($dbcon); //Close the database connection
			/*Include the footer and quit the script (to not show the form)*/
			include 'footer.php';
			exit();
			}
			else { //Report the errors
				echo '<h2 class="text-center">Error!</h2>
<p class="alert-box alert round">The following error(s) occurred:<br>';
foreach ($errors as $msg) { // Print each error.                             #12
echo " - $msg<br>\n";
}
echo '<p class="alert-box alert round"><h3>Please try again.</h3><p><br></p>';
			}
		}// End of if(empty($errors))
		mysqli_close($dbcon);// Close the database connection
	}// End of main Submit conditional
?>
<h2 class="text-center">Change Your Password</h2>
<!--display the form on the screen-->
<form action="register-password.php" method="post">
	<div class="row"><!--Beginning of First Row-->
	<div class="large-6 medium-6 small-12 columns">
		<label>Email
			<input id="email" type="email" name="email" size="40" maxlength="60"placeholder="Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/>
		</label>
	</div>
	<div class="large-6 medium-6 small-12 columns">
		<label>Current Password
			<input id="psword" type="password" name="psword" size="12" maxlength="12" placeholder="Password" value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>"/>
		</label>
	</div>
</div>
</div><!--End of First Row-->
<div class="row"><!--Beginning of Second Row-->
<div class="large-6 medium-6 small-12 columns">
	<label>New Password
		<input id="psword1" type="password" name="psword1" size="12" maxlength="12" placeholder="Confirm Password" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>"/>
	</label>
</div>
<div class="large-6 medium-6 small-12 columns">
	<label>Confirm New Password
		<input id="psword2" type="password" name="psword2" size="12" maxlength="12" placeholder="Confirm Password" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>"/>
	</label>
</div>
</div><!--End of Second Row-->
<div class="row"><!--Beginning of Third Row-->
<div class="large-12 small-12 columns">
	<input type="submit" id="submit" name="submit" class="button [radius round]" value="Change Password">
</div>
</div><!--End of Third Row-->
</form>
