<?php
session_start();

if (!isset($_SESSION['user_level']) or ($_SESSION['user_level']) != 1) {
	header('Location: login.php');
	exit();
}

include 'header-members.php';

echo '<h2 class="text-center">Welcome to the Admin Page ';
if (isset($_SESSION['fname'])) {
	echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>

<?php include 'footer.php';?>