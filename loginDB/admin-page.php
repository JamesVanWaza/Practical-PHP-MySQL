<?php
session_start();

if (!isset($_SESSION['user_level']) or ($_SESSION['user_level']) != 1) {
    header('Location: login.php');
    exit();
}

include '../html5req.php';

echo '<h2 class="text-center">Welcome to the Admin Page ';
if (isset($_SESSION['fname'])) {
    echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>
<h3>You have permission to:</h3>
<p>&#9632; Use the View members button to see a table of registered members</p>
<p>&#9632; Use the Search button to locate a particular member</p>
<p>&#9632; Use the Addresses button to locate a member's address and phone number</p>
