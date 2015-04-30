<?php
include_once('html5req.php');
class Person {
    
}

$classes = get_declared_classes();
foreach($classes as $class){
    echo $class . "<br>";
}
?>