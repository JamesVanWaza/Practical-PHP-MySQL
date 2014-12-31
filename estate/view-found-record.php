<?php include('header.php');?>
<h2>Search Result</h2>
<?php
// This code fetches a record from the estatedb table
require ('mysqli-connect.php'); // Connect to the db
$ref_num=$_POST['ref_num'];
$q = "SELECT ref_num, loctn, thumb, price, type, mini_descr, b_rooms, status
       FROM estatedb WHERE ref_num='$ref_num' ";
$result = @mysqli_query ($dbcon, $q); // Make the query.
if ($result) { // If the query ran OK, display the record
// Table header
   echo '<table>
   <tr>
     <td><b>Ref_Num</b></td>
     <td><b>Image</b></td>
     <td><b>Price</b></td>
     <td><b>Features</b></td>
     <td><b>Bedrms</b></td>
     <td><b>Status</b></td>
   </tr>';
// Fetch and display the record
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   echo '<tr>
     <td>' . $row['ref_num'] . '</td>
     <td>  <img src='.$row['thumb'] . '></td>
     <td>' . $row['price'] . '</td>
     <td>' . $row['mini_descr'] . '</td>
     <td>' . $row['b_rooms'] . '</td>
     <td>' . $row['status'] . '</td>
   </tr>';
   }
   echo '</table>'; // Close the table
   mysqli_free_result ($result); // Free up the resources
   } else { // If the query failed to run
// Error message:
   echo '<p class="alert-box alert round">The current house could not be retrieved. We apologize for any inconvenience.</p>';
// Debugging message:
   echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
   } // End of if ($result).
?>
