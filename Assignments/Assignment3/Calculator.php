<?php
class Calculator{
public function calc()
{

    if(func_num_args()<3)
    {
        return "You must enter a string and two numbers</br>";
        }
        $op=func_get_arg(0);
        $num1=func_get_arg(1);
        $num2=func_get_arg(2);
        if($op=="+")
        {
        return "The sum of the numbers is : ".($num1+$num2)."</br>";
    }
    if($op=="-")
    {
        return "The difference of the numbers : is ".($num1-$num2)."</br>";
        }
    if($op=="*")
        {
        return "The product of the numbers is : ".($num1*$num2)."</br>";
        }
    if($op=="/")
        {
    if($num2!=0)
        return "The product of the numbers is : ".($num1*$num2)."</br>";
        else return " *** Cannot divide by zero *** <br>";
        }
    }
}
?>