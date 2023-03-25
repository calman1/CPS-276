<?php
require_once 'PdoMethods.php';

class listFile {
    public function getFile() {
        $pdo = new PdoMethods();
    
        $sql = "SELECT * FROM files";
    
        $records = $pdo->selectNotBinded($sql);
    
        if($records == 'error') {
            return '<p>An error has occured</p>';
        }else {
            if(count($records) != 0) {
                return $this->createList($records);
            }else {
                return '<p>No files found</p>';
            }
        }
    }
    
    private function createList($records) {
        $output = "<ul>";
        foreach ($records as $row) {
            $output .= "<li><a target='_blank' href={$row['file_path']}>{$row['file_name']}</a></li>";
        }
    
        $output .= "</ul>";
        return $output;
    }
}
?>