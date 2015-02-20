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
<h2 class="text-center">Search Result</h2>
<?php
// This code retrieves particular records from the users table
require 'mysqli-connect.php'; // Connect to the database

echo "<p>" . "If no record is shown, this is because you had an incorrect or missing entry in the search form" . "<br>" . "Click the back button on the browser and try again" . "</p>";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fname = mysqli_real_escape_string($dbcon, $fname);
$lname = mysqli_real_escape_string($dbcon, $lname);
/*The query retrieves all the James Smith in the database*/
$q = "SELECT lname, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id
FROM admintable
WHERE lname='$lname'AND fname='$fname'
ORDER BY registration_date ASC ";
$result = @mysqli_query($dbcon, $q); // Run the query
if ($result) {
	// If it ran, display the records
	// Display the table headings
	echo '<table>
<tr><td><b>Edit</b></td>
<td><b>Delete</b></td>
<td><b>Last Name</b></td>
<td><b>First Name</b></td>
<td><b>Email</b></td>
<td><b>Date Registered</b></td>
</tr>';
// Fetch and display the records
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '<tr>
    <td><a href="edit-user.php?id=' . $row['user_id'] . '">Edit</a></td>
    <td><a href="delete-user.php?id=' . $row['user_id'] . '">Delete</a></td>
    <td>' . $row['lname'] . '</td>
    <td>' . $row['fname'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['regdat'] . '</td>
    </tr>';
	}
	echo '</table>'; // Close the table
	mysqli_free_result($result); // Free up the resources
} else {
	// If it did not run properly
	// Message
	echo '<p class="alert-box alert round">The current users could not be retrieved. We apologize for any inconvenience.</p>';
// Debugging message
	echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
}// End of if ($result). Now display the figure for total number of records/members
?>
