<?php
    include_once('html5req.php');
    function ref_return(){
        global $a;
        $a = $a * 2;
        return $a;
    }
$a = 10;
$b = ref_return();
echo "a: {$a} / b: {$b}<br>";

function &increment(){
    static $var = 0;
    $var++;
    return $var;
}
$a =& increment();
increment();
$a++;
increment();
echo "a: {$a}<br>";
?>