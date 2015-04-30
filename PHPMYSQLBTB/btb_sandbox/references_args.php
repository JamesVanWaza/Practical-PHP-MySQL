<?php
    include_once('html5req.php');
    function ref_test(&$var){
        //when the & is used the var and a are the same - the number becomes 10
        $var = $var * 2;
    }
    $a = 10;
ref_test($a);
echo $a;
   

?>