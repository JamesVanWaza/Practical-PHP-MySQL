<?php
    class Example {
        public $a = 1;
        protected $b = 2;
        private $c = 3;
        
        function show_abc(){
            echo $this->a;
            echo $this->b;
            echo $this->c;
        }
        
        public function hello_everyone(){
            return "Hello Everyone";
        }
        
        protected function hello_family(){
            return "Hello family";
        }
        
        private function hello_me(){
            return "Hello me";
        }
        
        //public by default
        function hello(){
            $output = $this->hello_everyone();
            $output .= $this->hello_family();
            $output .= $this->hello_me();
            return $output;
        }
             
    }

$example = new Example();
echo "public a: {$example->a}<br>";

//Will Return an error by default
//echo "protected b: {$example->b}<br>";

//Will Return an error by default
//echo "private c: {$example->c}<br>";
$example->show_abc();
echo '<br>';
echo "hello everyone: {$example->hello_everyone()}<br>";
echo '<br>';
//Returns an error by default
//echo "hello family: {$example->hello_family()}<br>";

//Returns an error by default
//echo "hello me: {$example->hello_me()}<br>";
//

echo $example->hello() . '<br>';
?>