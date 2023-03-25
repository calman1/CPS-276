<?php
require_once 'ListFiles.php';
$fileList = new listFile();
$output = $fileList->getFile();


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  
    <title>File List</title>
</head>
<body>
<div id="wrapper" class="container">
        <h1>List Files</h1>

    <form method="POST" action="list.php">


    <div class ="form-row">

        <p><a href = "index.php">Add File</a></p>

    </div>
        <?php echo $output?>

</body>
</html>