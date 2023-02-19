<?php 
   
   class Calculator{

        function add($num1, $num2){
            if(is_int($num1) && is_int($num2)){
                return $num1 + $num2;
            }
            
        }

        function subtract($num1, $num2){
            if(is_int($num1) && is_int($num2)){
                return $num1 - $num2;
            }
        }

        function multiply($num1, $num2){
            if(is_int($num1) && is_int($num2)){
                return $num1 * $num2;
            }
            
        }

        function divide($num1, $num2){
            if(is_int($num1) && is_int($num2)){
                return $num1 / $num2;
                
            }
            
        }

        function calculate($ops, $num1 = "optional", $num2 = "optional"){

            if(is_int($num1) && is_int($num2)){
                
                if($ops === '+'){
                    
                    $val = $this->add($num1, $num2);
                    return "The sum of the numbers is $val .<br>";
                    
                }
                else if($ops === '-'){
                    
                    $val = $this->subtract($num1, $num2);
                    return "The difference of the numbers is $val .<br>";
                }
                else if($ops === '*'){
                    $val = $this->multiply($num1, $num2);
                    return "The product of the numbers is $val .<br>";
                    
                }
                else if($ops === '/'){
                    if($num2 == 0){
                        return "Can not divide by Zero. <br>";
                    }
                    $val = $this->divide($num1, $num2);
                    return "The division of the numbers is $val .<br>";
                    
                }
                else{
                    return "You must enter a string and two numbers. <br>";
                }
            }

            return "You must enter a string and two numbers <br>";

        }

    }    
?>