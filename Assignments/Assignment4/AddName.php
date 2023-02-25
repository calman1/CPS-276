<?php
    static $result = array();
    if(isset($_POST['submit'])) {
        require_once "Class.php";
        $Addname = new Nameform($_POST["names"]);
        $namelist=$_POST["namelist"];
        if(!empty($namelist))
        $result = $Addname->Set_Name($namelist);
    }
    else if(isset($_POST['reset'])) {
        $_POST=array();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Names</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <main class="container">
        <h1>Add Names</h1>
</main>
<div class="container">
    <div class="col">
    <form action="" method="POST">
        <input class="btn btn-primary" type="submit" name="submit" value="Add Name">
        <input class="btn btn-primary" type="reset" name="reset" value="Clear Name">
        <div class="form-group">
             <label for="EnterName" class="form-label">Enter Names: </label>
                <input type="text" class="form-control" name="namelist" id="EnterName">
</div>
<div class="form-group">
    <label for="textareaName" class="form-label">List of Names: </label>
    <textarea style="height: 500px;" class="form-control" id="names" name="names">
        <?php $i=0;
        while($i<count($result)){
            echo $result[$i++]."\n";
        }
        ?></textarea>
        </div>
    </form>
    </div>
<  </body>
</html>