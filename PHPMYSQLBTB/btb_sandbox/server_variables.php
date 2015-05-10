<h1>Server Variables</h1>
<?php
//http://php.net/manual/en/reserved.variables.server.php
include_once('html5req.php');
echo "<h2>Server details: </h2>";
echo "SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "SERVER_ADDR: " . $_SERVER['SERVER_ADDR'] . "<br>";
echo "SERVER_PORT: " . $_SERVER['SERVER_PORT'] . "<br>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>Page details: </h2>";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "<br>";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";

echo "<h2>Request details: </h2>";
echo "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "REMOTE_PORT: " . $_SERVER['REMOTE_PORT'] . "<br>";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "QUERY_STRING: " . $_SERVER['QUERY_STRING'] . "<br>";
echo "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "REQUEST_TIME: " . $_SERVER['REQUEST_TIME'] . "<br>";
echo "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
?>