<?php
include_once('html5req.php');
class Person {
    function say_hello(){
        echo "Hello from inside a class. <br>";
    }  
}    
    //Gets the list of php default classes methods
    $methods = get_class_methods('Person');
    
    foreach($methods as $method){
        echo $method . "<br>";
    }
    
    //Finding out whether a method exists
    if(method_exists('Person', 'say_hello')){
        echo "Method does exist. <br>";
    } else {
        echo "Method does not exist";
    }

?>