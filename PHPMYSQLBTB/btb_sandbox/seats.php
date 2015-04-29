<?php
    $a = 'Kevin';
    $b = 'Mary';
    $c = 'Joe';
    $d = 'Larry';
    $e = 'Audrey';

    $students = array('a', 'c', 'e');
    foreach($students as $seat) {
        // When using a single $ the values being returned will be a, c, e
        // When using two $$ the values being returned will be 'Kevin', 'Joe', 'Audrey'
        echo $$seat . "<br>";
    }
?>