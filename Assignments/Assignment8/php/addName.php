<?php
    require '../classes/Pdo_methods.php';
    $pdo = new PdoMethods();
    $sql = "INSERT INTO names (name) VALUES (:name)";
    $data = json_decode($_POST['data']);
    list($first, $last) = explode(' ', $data->name);
    $newName = $last.', '.$first;
    $bindings = [
	    [':name',$newName,'str'],
	];
    $result = $pdo->otherBinded($sql, $bindings);
    if($result === 'error'){
		$response = (object) [
            'masterstatus' => 'error',
            'msg' => "Error adding name",
        ];
        echo json_encode($response);
	}
    else {
		$response = (object) [
            'masterstatus' => 'success',
            'msg' => "Name successfully added to database",
          ];
          echo json_encode($response);
	}

?>