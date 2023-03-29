<?php
require_once 'PdoMethods.php';

class FileUpload{

    public function addFile() {

            if($_FILES["file"]["size"] = 0) {
                return "<p>No file was uploaded</p>";
            }else if($_FILES["file"]["type"] != "application/pdf") {
                return "<p>File must be a PDF</p>";
            }else if($_FILES["file"]["size"] > 100000 ) {
                return "<p>File too big</p>";
            }else
                $pdo = new PdoMethods();

                $sql = "INSERT INTO files (file_name, file_path) VALUES (:fName, :fPath)";

                $bindings = [
                    [':fName', $_POST['fileName'], 'str'],
                    [':fPath', 'files/'.$_POST['fileName'].'.pdf', 'str']
                ];

                $results = $pdo->otherBinded($sql, $bindings);

                if($results === 'error') {
                    return "<p>An error has occured </p>";
                }else {
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], "files/".$_POST['fileName'].".pdf")){
                        return "<p>File added</p>";
                    }else {
                        return "<p>There was a problem</p>";
                    }
                }
            }
        }

?>