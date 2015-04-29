<?php
include_once('html5req.php');
    $var = 1; 
    function test1(){
        $var = 2;
        echo $var . "<br>";
    }
    test1();
echo $var . "<br>";
?>