<?php
ob_start();
session_start();
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) {
	header("Location: login.php");
	exit();
}
include 'header-admin.php';
ob_end_flush();
?>
<h3 class="text-center">Search for a Record</h3>
<!--display the form on the screen-->
<form action="view-found-record.php" method="post">
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
     <div class="large-12 small-12 columns">
    <input type="submit" id="submit" name="submit" class="button [radius round]" value="Search">
  </div>
    </div>
  </div><!--End of First Row-->

</form>
