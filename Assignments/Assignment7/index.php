<?php
if(count($_POST) > 0) {
    require_once 'FileUpload.php';
    $file = new FileUpload();
    $output = $file->addFile();
}else {
    $output = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  
    <title>Uploading Files</title>
</head>
<body>
    
<div id="wrapper" class="container">
        <h1>File Upload</h1>

    <form method="POST" action="index.php">


    <div class ="form-row">

        <p><a href = "list.php">Show File List</a></p>

    </div>

    <div class = "form-row">
        <p><?php echo $output ?></p>
    </div>

    <div class="form-row">  
        <label for="names">File Name</label>
        <input type="text" class="form-control" name= "fileName" id="fileName">
    </div>

    <div class="form-row">
        <input type="file" class="form-group" name="file" id="file" />
    </div>

    <div class="form-row">
        <input type="submit" class="btn btn-primary" name="upload" value="Upload File">
    </div>

</div>


</body>
</html>