<?php

require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "SELECT * FROM names order by name;";

$records = $pdo->selectNotBinded($sql);

if($records == "error"){
    $response = (object)[
        "masterstatus" => "error",
        "msg" => "Could not get names."
    ];
    echo json_encode($response);
} else{
    $list = "";
    foreach($records as $name)
    {
        $list .= "<p>" .implode($name). "</p>";
    }
    response = (object)[
        "masterstatus" => "success",
        "names" => $list
    ];
    echo json_encode($response);
}

?>