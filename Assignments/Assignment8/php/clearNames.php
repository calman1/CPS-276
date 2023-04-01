<?php

require_once "../classes/Pdo_methods.php";
$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names";

$results = $pdo->otherNotBinded($sql);

if($results === 'error'){
    $response = (object)[
        'masterstatus' => 'error',
        'msg' => "could not delete names"
    ];

    echo json_encode($response);

} else{
    $response = (object)[
        'masterstatus' => 'success',
        'msg' => "all names have been deleted"
    ];

    echo json_encode($response);

}



?>