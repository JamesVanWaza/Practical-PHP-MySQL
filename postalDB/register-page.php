<?php include 'nav.php';
// This script performs an INSERT query that adds a record to the users table.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	#1

	$errors = array(); // Initialize an error array.
	//Check for a title:
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter your title';
	} else {
		$title = mysqli_real_escape_string($dbcon, trim($_POST['title']));
	}

	// Was the first name entered?
	if (empty($_POST['fname'])) {
		$errors[] = 'You did not enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}
	// Check for a last name
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}
	// Was an email address entered?
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}
	// Check for a password and match it against the confirmation password                                                  #2

	if (!empty($_POST['psword1'])) {
		if ($_POST['psword1'] != $_POST['psword2']) {
			$errors[] = 'Your two passwords did not match.';
		} else {
			$p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	/*Adding a secret username*/
	if (empty($_POST['uname'])) {
		$errors[] = 'You forgot to enter your secret username.';
	} else {
		//$uname = mysqli_real_escape_string($dbcon, trim($_POST['email']));
		$uname = trim($_POST['uname']);
	}

	/*Check for a membership class*/
	if (empty($_POST['class'])) {
		$errors[] = 'You forgot to enter your membership class.';
	} else {
		//$uname = mysqli_real_escape_string($dbcon, trim($_POST['email']));
		$class = trim($_POST['class']);
	}

	/*Check for address1*/
	if (empty($_POST['addr1'])) {
		$errors[] = 'You forgot to enter your first address.';
	} else {
		$ad1 = mysqli_real_escape_string($dbcon, trim($_POST['addr1']));
	}

	/*Check for address2*/
	if (!empty($_POST['addr2'])) {
		$ad2 = mysqli_real_escape_string($dbcon, trim($_POST['addr2']));
	} else {
		$ad2 = NULL;
	}

	/*Check for city*/
	if (empty($_POST['city'])) {
		$errors[] = 'You forgot to enter your City.';
	} else {
		$cty = mysqli_real_escape_string($dbcon, trim($_POST['city']));
	}

	/*Check for county*/
	if (empty($_POST['county'])) {
		$errors[] = 'You forgot to enter your county.';
	} else {
		$cnty = mysqli_real_escape_string($dbcon, trim($_POST['county']));
	}

	/*Check for the post code*/
	if (empty($_POST['pcode'])) {
		$errors[] = 'You forgot to enter your post code.';
	} else {
		$pcode = mysqli_real_escape_string($dbcon, trim($_POST['pcode']));
	}

	/*Check for the phone number*/
	if (!empty($_POST['phone'])) {
		$ph = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
	} else {
		$ph = NULL;
	}

//Start of the SUCCESSFUL SECTION. i.e all the fields were filled out
	if (empty($errors)) {
		// If no problems encountered, register user in the database

		require 'mysqli-connect.php'; // Connect to the database.

// Make the query

		$q = "INSERT INTO postaldb (user_id, title, fname, lname, email, psword, uname, registration_date, class, addr1, addr2, city, county, pcode, phone, paid)
VALUES (' ', '$title', '$fn', '$ln', '$e', SHA1('$p'),  '$uname', NOW(), '$class', '$ad1', '$ad2', '$cty', '$cnty', '$pcode', '$ph', '$pd')";

		$result = @mysqli_query($dbcon, $q); // Run the query.

		if ($result) {
			// If it ran OK.

			header("Location: register-thanks.php");

			exit();

//End of SUCCESSFUL SECTION
		} else {
			// If the form handler or database table contained errors

// Display any error message
			echo '<h2>System Error</h2>
<p class="alert-box alert round">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
// Debug the message:
			echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		}// End of if clause ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		include 'footer.php';
		exit();
	} else {
		// Display the errors
		echo '<h2>Error!</h2>
        <p class="alert-box alert round">The following error(s) occurred:<br>';
		foreach ($errors as $msg) {
			// Print each error.                             #12
			echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
	}// End of if (empty($errors)) IF.
}// End of the main Submit conditional.
?>
<h2>Membership Registration</h2>
<p>
  <b>Membership classes: </b> Standard 1 year: 30, Standard 5 years: 125, Armed Forces 1 year: 5
  <br>
  <b>Under 21 one year: 2 &nbsp; Other: If you can't afford 30 please give what you can</b>
</p>
<!--display the form on the screen-->
<form action="register-page.php" method="post">
  <div class="row"><!--Beginning of First Row-->
    <div class="large-4 medium-4 small-12 columns">
      <label>Title
        <input id="title" type="text" name="title" size="30" maxlength="30" placeholder="Title" value="<?php if (isset($_POST['title'])) {
	echo $_POST['title'];
}
?>" />
      </label>
    </div>
  	<div class="large-4 medium-4 small-12 columns">
      <label>First Name
        <input id="fname" type="text" name="fname" size="30" maxlength="30" placeholder="First Name" value="<?php if (isset($_POST['fname'])) {
	echo $_POST['fname'];
}
?>"/>
      </label>
    </div>
     <div class="large-4 medium-4 small-12 columns">
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
    <div class="large-6 medium-6 small-12 columns">
      <label>Secret Username
        <input id="uname" type="text" name="uname" size="40" maxlength="40" placeholder="Secret Name" value="<?php if (isset($_POST['uname'])) {
	echo $_POST['uname'];
}
?>"/>
      </label>
    </div>
    <!--The pulldown menu-->
    <div class="large-6 medium-6 small-12 columns">
      <br><label for="class">Membership Class</label></br>
      <select name="class" id="#">
        <option value="">--Select--</option>
        <option value="30"<?php if (isset($_POST['class']) AND ($_POST['class'] == '30')) {
	echo ' selected="selected"';
}
?>>Standard 1 year 30</option>
        <option value="125"<?php if (isset($_POST['class']) AND ($_POST['class'] == '125')) {
	echo ' selected="selected"';
}
?>>Standard 5 years 125</option>
        <option value="5"<?php if (isset($_POST['class']) AND ($_POST['class'] == '5')) {
	echo ' selected="selected"';
}
?>>Armed Forces 1 year 5</option>
        <option value="2"<?php if (isset($_POST['class']) AND ($_POST['class'] == '2')) {
	echo ' selected="selected"';
}
?>>Under 22 1 year 2**</option>
        <option value="15"<?php if (isset($_POST['class']) AND ($_POST['class'] == '15')) {
	echo ' selected="selected"';
}
?>>Minimum 1 year 15</option>
      </select>
    </div>

      <div class="large-6 medium-6 small-12 columns">
        <label>First Address
          <input id="addr1" type="text" name="addr1" size="30" maxlength="30" placeholder="First Address" value="<?php if (isset($_POST['addr1'])) {
	echo $_POST['addr1'];
}
?>"/>
        </label>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <label> Second Address
          <input id="addr2" type="text" name="addr2" size="30" maxlength="30" placeholder="Second Address" value="<?php if (isset($_POST['addr2'])) {
	echo $_POST['addr2'];
}
?>"/>
        </label>
      </div>

      <div class="large-6 medium-6 small-12 columns">
        <label>City
          <input id="city" type="text" name="city" size="30" maxlength="30" placeholder="City" value="<?php if (isset($_POST['city'])) {
	echo $_POST['city'];
}
?>"/>
        </label>
      </div>

      <div class="large-6 medium-6 small-12 columns">
        <label>County
          <input id="county" type="text" name="county" size="30" maxlength="30" placeholder="County" value="<?php if (isset($_POST['county'])) {
	echo $_POST['county'];
}
?>"/>
        </label>
      </div>

      <div class="large-6 medium-6 small-12 columns">
        <label>Post Code
          <input id="pcode" type="text" name="pcode" size="30" maxlength="30" placeholder="Post Code" value="<?php if (isset($_POST['pcode'])) {
	echo $_POST['pcode'];
}
?>"/>
        </label>
      </div>

      <div class="large-6 medium-6 small-12 columns">
        <label>Telephone
          <input id="phone" type="text" name="phone" size="30" maxlength="30" placeholder="Telephone" value="<?php if (isset($_POST['phone'])) {
	echo $_POST['phone'];
}
?>"/>
        </label>
      </div>

      <div class="large-12 small-12 columns">
  	     <input type="submit" id="submit" name="submit" class="button [radius round]" value="Register">
      </div>
    </div><!--End of Third Row-->
</form>
