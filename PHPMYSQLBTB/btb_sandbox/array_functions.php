<?php
    $numbers = array(1, 2, 3, 4, 5, 6);
    echo "<pre>";
    print_r($numbers);
    echo "</pre>";

//shifts first element out of an array and returns it
$a = array_shift($numbers);
echo "a: " . $a . "<br>";
echo "<pre>";
    print_r($numbers);
    echo "</pre>";

//prepends an element to an array and returns the element count
$b = array_unshift($numbers, 'first');
echo "b: " . $b . "<br>";
echo "<pre>";
    print_r($numbers);
    echo "</pre>";

//pops last element out of an array
$c = array_pop($numbers);
echo "c: " . $c . "<br>";
echo "<pre>";
    print_r($numbers);
    echo "</pre>";

//pushes an element onto the end of an array, returns the element count
$d = array_push($numbers, 'last');
echo "d: " . $d . "<br>";
echo "<pre>";
    print_r($numbers);
    echo "</pre>";

?>