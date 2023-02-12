<?php

for ($i = 1; $i < 5; $i++){
    echo $i . "<br>";
    for ($j = 1; $j < 6; $j++){
    echo "&nbsp;&nbsp;&nbsp;&nbsp;".$j."<br>";
    }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Nested Loop</title>
</head>
<body class="container">
    <?php  
      echo "&nbsp;&nbsp;&nbsp;&nbsp;".$j."<br>";  
    ?>
</body>
</html>