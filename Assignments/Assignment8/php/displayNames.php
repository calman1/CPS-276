<?php

require_once "../classes/Pdo_methods.php";
$pdo = new PdoMethods();

$sql = "SELECT name FROM names ORDER BY name ASC";

$results = $pdo->selectNotBinded($sql);

if($results === 'error'){
    $response = (object)[
        'masterstatus' => 'error',
        'msg' => "Error retrieving names"
    ];

    echo json_encode($response);

} else{

    $displayNames = "";
    foreach($results as $name){
        $displayNames .= '<p>'.implode($name).'</p>';
    }

    $response = (object)[
        'masterstatus' => 'success',
        'names' => $displayNames
    ];

    echo json_encode($response);

}

?>