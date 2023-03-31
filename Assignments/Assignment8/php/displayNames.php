<?php
    require '../classes/Pdo_methods.php';
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM names";
    $records = $pdo->selectNotBinded($sql);
    if($records == 'error') {
        $response = (object) [
            'masterstatus' => 'error',
            'msg' => "Error retrieving the names",
          ];
          echo json_encode($response);
    }else {
        $list = '<div>';
        foreach ($records as $row) {
            $list .= '<p>'.$row['name'].'</p>';
        }
		$list .= '</div>';
        $response = (object) [
            'masterstatus' => 'success',
            'names' => $list,
        ];
        echo json_encode($response);
    }
    
?>