<?php
    require '../classes/Pdo_methods.php';
    $pdo = new PdoMethods();
    $sql = "DELETE FROM names";
    $result = $pdo->otherNotBinded($sql);
    if($result == 'error') {
        $response = (object) [
            'masterstatus' => 'error',
            'msg' => 'There was an error deleting the names',
          ];
          echo json_encode($response);
    }else {
        $response = (object) [
            'masterstatus' => 'success',
            'msg' => 'Successfully deleted all names',
          ];
          echo json_encode($response);
    }
?>