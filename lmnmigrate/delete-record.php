<?php
  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);
?>
<?php include('nav.php'); ?>
<?php
  session_start();
  if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)) {
    header("Location: login.php");
    exit();
  }
?>
<h2 class="text-center">Delete a Record</h2>
<?php
  /*Check for a valid user ID, through GET or POST*/
  if ((isset($_GET['id'])) &&(is_numeric($_GET['id']))) {//From view-users.php
    $id = $_GET['id'];
  }
  elseif ((isset($_POST['id'])) &&(is_numeric($_POST['id']))) {
    /*Form submission*/
    $id = $_POST['id'];
  }
  else{
    echo "<p class='alert-box alert round'>This page has been accessed in error</p>";
    include ('footer.php');
    exit();
  }
  require ('mysqli-connect.php');
  /*Has the form been submitted?*/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['sure'] == 'Yes') { //Delete the Record
      //Make the query
      $q = "DELETE FROM logindb WHERE user_id = $id LIMIT 1";
      $result = @mysqli_query ($dbcon, $q); // Run the query.
      if (mysqli_affected_rows($dbcon) == 1) {
        /*Display a message*/
        echo "<h3>The record has been deleted</h3>";
      }
      else {
        /*Echo a message if the query failed*/
        echo '<p class="alert-box alert round">The user could not be edited due to a system error<br>We apoligize for any inconvience</p>'; /*Error message*/
        echo "<p>" . mysqli_error($dbcon). '<br>Query: ' .$q.  "</p>"; //Debugging message
      }
    }
    else {
     //If the query failed to run
      echo "<h3>The user has NOT been deleted</h3>";
    }
  }
  else{//Display the form
    //Retrieve the members data
    $q = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_id=$id";
    $result = @mysqli_query ($dbcon, $q);
  }

//Select the record
$q = "SELECT fname, lname, email FROM logindb WHERE user_id=$id";
$result = @mysqli_query($dbcon, $q);
  if (mysqli_affected_rows($dbcon) == 1) {//Valid user ID, show the form
    /*Get the Members data*/
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    /*Display the name of the meber being deleted*/
    echo "<h3>Are you sure you want to permanently delete $row[0]?</h3>";

    /*Display the delete page*/
    echo '<form action="delete-record.php" method="post">
    <div class="row">
      <div class="large-6 medium-6 small-12 columns">
        <label>
          <input id="submit-yes" type="submit" name="sure" value="Yes">
        </label>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <label>
         <input id="submit-no" type="submit" name="sure" value="No">
        </label>
      </div>
      <div class="large-6 medium-6 small-12 columns">
        <label>
         <input type="hidden" name="id" value="' . $id '">
        </label>
      </div>
    </form>';
  }
  else {
    /*Not a valid member's ID*/
    echo '<p class="alert-box alert round">This page has been accessed in error</p>'; /*Error message*/
    echo "<p>" . mysqli_error($dbcon). '<br>Query: ' .$q.  "</p>"; //Debugging message
  }//End of main conditional section
mysqli_close($dbcon);
include ('footer.php');
?>
