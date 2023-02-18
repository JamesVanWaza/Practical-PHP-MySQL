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
<h2 class="text-center">Search Results</h2>
<?php
// This script fetches selected records from the users table
require 'mysqli-connect.php'; // Connect to the database
echo '<p>If no record is shown, this is because of an incorrect or missing entry in
the search form.<br>Click the Search button and try again</p>';
$fname = $_POST['fname'];
$fname = mysqli_real_escape_string($dbcon, $fname);
$lname = $_POST['lname'];
$lname = mysqli_real_escape_string($dbcon, $lname);
$q = "SELECT title, lname, fname, addr1, addr2, city, county, pcode, phone, user_id
FROM finalpost WHERE lname='$lname' AND fname='$fname'";
$result = @mysqli_query($dbcon, $q); // Run the query
if ($result) {
	// If it ran, display the records
	// Table headings                                                                        #2
	echo '<table>
        <tr><td><b>Edit</b></td>
        <td><b>Title</b></td>
        <td><b>Last Name</b></td>
        <td><b>First Name</b></td>
        <td><b>Address 1</b></td>
        <td><b>Address 2</b></td>
        <td><b>City</b></td>
        <td><b>County</b></td>
        <td><b>Pcode</b></td>
        <td><b>Phone</b></td>
        </tr>';
// Fetch and display the records
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '<tr>
    <td><a href="edit-address.php?id=' . $row['user_id'] . '">Edit</a></td>
    <td><a href="delete-record.php?id=' . $row['user_id'] . '">Delete</a></td>
    <td>' . $row['title'] . '</td>
    <td>' . $row['lname'] . '</td>
    <td>' . $row['fname'] . '</td>
    <td>' . $row['addr1'] . '</td>
    <td>' . $row['addr2'] . '</td>
    <td>' . $row['city'] . '</td>
    <td>' . $row['county'] . '</td>
    <td>' . $row['pcode'] . '</td>
    <td>' . $row['phone'] . '</td>
    </tr>';
	}
	echo '</table>'; // Close the table
	mysqli_free_result($result); // Free up the resources
} else {
	// If it failed to run
	// Error message:
	echo '<p class="alert-box alert round">The current users could not be retrieved. We apologize for any inconvenience.</p>';
	// Debugging message:
	echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
} // End of if ($result). Now display the total number of records/members.
$q = "SELECT COUNT(user_id) FROM finalpost";
$result = @mysqli_query($dbcon, $q);
$row = @mysqli_fetch_array($result, MYSQLI_NUM);
$members = $row[0];
mysqli_close($dbcon); //Close the database connection.
echo "<p>Total membership: $members</p>";
?>
