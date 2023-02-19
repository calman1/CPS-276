<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Calculator</title>
</head>
<?php
require_once "Calculator.php";
$Calculator = new Calculator();
echo $Calculator->calc("/", 10, 0); //will output Cannot divide by zero
echo $Calculator->calc("*", 10, 2); //will output The product of the numbers is 20
echo $Calculator->calc("/", 10, 2); //will output The division of the numbers is 5
echo $Calculator->calc("-", 10, 2); //will output The difference of the numbers is 8
echo $Calculator->calc("+", 10, 2); //will output The sum of the numbers is 12
echo $Calculator->calc("*", 10); //will output You must enter a string and two numbers
echo $Calculator->calc(10); //will output You must enter a string and two numbers
?>
</body>
</html>