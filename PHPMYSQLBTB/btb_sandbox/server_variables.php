<h1>Server Variables</h1>
<?php
include_once('html5req.php');
echo "<h2>Server details: </h2>";
echo "SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "SERVER_ADDR: " . $_SERVER['SERVER_ADDR'] . "<br>";
echo "SERVER_PORT: " . $_SERVER['SERVER_PORT'] . "<br>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>Page details: </h2>";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "<br>";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
?>