<h1>Date Time Formatting</h1>
<?php
//See http://php.net/manual/en/function.strftime.php
include_once('html5req.php');
date_default_timezone_set('America/New_York');
$timestamp = time();
echo strftime("The Date Today is %m/%d/%y");
?>