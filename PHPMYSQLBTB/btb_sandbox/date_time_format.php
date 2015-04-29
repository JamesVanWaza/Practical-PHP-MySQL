<h1>Date Time Formatting</h1>
<?php
//See http://php.net/manual/en/function.strftime.php
include_once('html5req.php');
date_default_timezone_set('America/New_York');
$timestamp = time();
echo strftime("The Date Today is %m/%d/%y") . "<br>";

/**
 * Removes zeros from strings 
 */
function strip_zeros_from_date($marked_string=""){
    //remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    
    //remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

echo strip_zeros_from_date(strftime("The Date Today without zeros in the date is *%m/*%d/%y", $timestamp));

echo "<hr>";
// Created DateTime Accepted by MySQLi
$dt = time();
$mysqli_datetime = strftime("%Y-%m-%d %H:%M:%S");
echo $mysqli_datetime;
?>