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
<h2 class="text-center">These are the registered users</h2>
<?php
/*This script retrieves all the records from the users table*/
require 'mysqli-connect.php'; /*Connect to the database*/

/*Make the Query*/
$q = "SELECT CONCAT(lname, ', ', fname) AS name,
	DATE_FORMAT(registration_date, '%M %D, %Y') AS regdat FROM admintable
	ORDER BY registration_date ASC";
$result = @mysqli_query($dbcon, $q); //Run the query

if ($result) {
	//If it ran OK, display thr records
	/*Table Header*/
	echo '<table>
<tr><td><b>Full Names</b></td><td><b>Date Registered</b></td></tr>';
// Fetch and print all the records:

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '<tr><td>' . $row['name'] . '</td><td>' . $row['regdat'] . '</td></tr>';}
	echo '</table>'; // Close the table so that it is ready for displaying.
	mysqli_free_result($result); // Free up the resources.
} else {
	/*If if did not run OK*/
	echo "<p class='alert-box alert round'>The current users could not be retrieved. We apologize for any inconvience.</p>";

	/*Debug Message*/
	echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
} //End of if ($result)
mysqli_close($dbcon); //Close the databse function
?>
