<?php
   class Beverage {
       public $name;
   } 

$a = new Beverage();
$a->name = 'coffee';
$b = $a; // always a reference with objects
$b->name = 'tea';
echo $a->name;

echo "<br>";
//Clone 
$c = clone $a;
$c->name = 'orange juice';
echo $a->name;
?>