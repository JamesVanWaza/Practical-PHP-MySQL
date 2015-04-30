<?php
include_once('html5req.php');
class Person {
    
}

//Gets the list of php default classes
$classes = get_declared_classes();
foreach($classes as $class){
    echo $class . "<br>";
}

if(class_exists("Person")){
    echo "That class has been defined. <br>";
} else {
    echo "Class not defined! <br>";
}
?>