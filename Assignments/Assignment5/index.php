<?php
    require_once 'directories.php';
    $addedContent = new Directories();
    $messageAboutFile = $addedContent->executeButtonClick();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>File and Directories</title>
</head>
<body>
    <main class="container">
        <form action="index.php" method="post"> 
            <h1>Files and Directories</h1>
            <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.<p>
            <?php echo $messageAboutFile ?>
          
            <div class="form-group">
                <label for="Folder Name" >Folder Name:</label>
                <input type="text" class="form-control" id="FolderN" name="FolderN">
            </div>
          
            <div class="form-group">
                <label for="File Content">File Content:</label>
                <textarea class="form-control" id="FileC" name="FileC" rows="22" ></textarea>
            </div>
          
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit"/>
            </div>
        </form>
    </main>
</body>
</html>
