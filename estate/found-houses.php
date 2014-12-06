<?php include("html5req.php"); ?>
<img src="" width="">
</header>
<div id="content"><!--Start of table display content-->
<h3>To arrange a viewing please use the the Contact Us button on the menu and<br>
quote the reference number</h3>
<p>
<?php
	$loctn=$_POST['loctn'];
	$price=$_POST['price'];
	$type=$_POST['type'];
	$b_rooms=$_POST['b_rooms'];
// This code retrieves all the records from the houses table
require ('mysqli-connect.php'); // Connect to the database
// Make the query
$q = "SELECT ref_num, loctn, thumb, price, mini_descr, type, b_rooms, full_spec,
status
FROM estatedb
WHERE loctn='$loctn'
AND (price <= '$price')
AND (price >= ('$price'-100000))
AND type='$type'
AND b_rooms='$b_rooms'
ORDER BY ref_num ASC ";
$result = @mysqli_query ($dbcon, $q); // Run the query
if ($result) { // If the query ran OK, display the records
// Table header
echo '<table>
<tr>
	<th><b>Ref.</b></th>
<th><b>Location</b></td>
<th><b>Thumb</b></th>
<th><b>Price</b></th>
<th><b>Features</b></th>
<th><b>Bedrms</b></th>
<th><b>Details</b></th>
<th><b>Status</b></th>
</tr>';
// Fetch and print the records
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo '<tr>
<td>' . $row['ref_num'] . '</td>
<td>' . $row['loctn'] . '</td>
<td>  <img src='.$row['thumb'] . '></td>
<td>' . $row['price'] . '</td>
<td>' . $row['mini_descr'] . '</td>
<td>' . $row['b_rooms'] . '</td>
<td>' . $row['full_spec'] . '</td>
<td>' . $row['status'] . '</td>
</tr>';
}
echo '</table>'; // Close the table
mysqli_free_result ($result); // Free up the resources
} else { // If it did not run OK
// Message
	echo '<p class="alert-box alert round">The record could not be retrieved. We apologize for any
inconvenience.</p>';
// Debugging error message
echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
} // End of if ($result). Now display the total number of records/houses
$q = "SELECT COUNT(ref_num) FROM estatedb";
$result = @mysqli_query ($dbcon, $q);
$row = @mysqli_fetch_array ($result, MYSQLI_NUM);
$houses = $row[0];
mysqli_close($dbcon); // Close the database connection
?>
<p>No houses displayed? Either we have nothing that matches your requirements at the image
moment OR<br>you may have forgotten to select ALL the search fields. Please click image
the Home Page button and try again.</p>
</div><!--End of table display content-->
<?php include("footer.php"); ?>
