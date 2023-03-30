<?php

require_once "../classes/Pdo_methods.php";

$data = json_decode($_POST[$data]);
$name = $data->name;
$nameR = esplode(" ", $name);
$name = "{$nameR[1]}, {$nameR[0]}";

$pdo = new PdoMethods();

$sql = "INSERT INTO names (name) VALUES (:name)";

$bindings = [
    [":name", $name, "str"],
];

$records = $pdo->otherBinded($sql, $bindings);
if($records === "error"){
    $response = (object)[
        "masterstatus" => "error",
        "msg" => "could not add name to database"
    ];
    echo json_encode($response);
} else{
    $response = (object)[
        "masterstatus" => "success",
        "msg" => "$name added"
    ];
    echo json_encode($response);
}

?>