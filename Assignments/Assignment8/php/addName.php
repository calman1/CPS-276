<?php
require_once '../classes/Pdo_methods.php';

/* GET NAME TO BE ADDED TO DB */
$data = json_decode($_POST['data']);
$name = $data->name;

/* SWITCH FIRST AND LAST NAME, AND CONCATENATE INTO ONE STRING */
$nameArr = explode(" ", $name);
$name = $nameArr[1].", ".$nameArr[0];

/* GET A PDO OBJECT */
$pdo = new PdoMethods();

/* CONSTRUCT OUR SQL AND BIND OUR VARIABLES */
$sql = "INSERT INTO names (name) VALUES (:name)";
$bindings = [[':name',$name,'str'],];

/* EXECUTE OUR INSERT STATEMENT */
$records = $pdo->otherBinded($sql,$bindings);

if ($records === "error") {
    $response = (object) ['masterstatus' => 'error', 'msg'=>'Could not insert records into database.'];
    echo json_encode($response);
}
else {
    $response = (object) ['masterstatus' => 'success', 'msg'=>"Name has been added"];
    echo json_encode($response);
}

/*
$response = (object) ['masterstatus' => 'success', 'msg'=>$name];
echo json_encode($response);
*/

?>