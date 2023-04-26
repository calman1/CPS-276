<?php
    require_once 'classes/StickyForm.php';
    $stickyForm = new StickyForm(); $stickyForm->security();

    function init(){
        require_once 'classes/Pdo_methods.php';
        if(isset($_POST['delete'])){
            if(isset($_POST['chkbx'])){
                $error = false;
                foreach($_POST['chkbx'] as $id){
                    $pdo = new PdoMethods();
                    $sql = "DELETE FROM admins WHERE admin_id=:id";
                    $bindings = [[':id', $id, 'int'],];
    
                    $result = $pdo->otherBinded($sql, $bindings);
                    if($result === 'error'){$error = true; break;}
                }
            }else{
                $msg = "<p class='errorMsg'> Error, Please select an admin to delete.</p>";
            }
        }    
        $pdo = new PdoMethods(); 
        $output = ""; 
        $sql = "SELECT * FROM admins";
        $records = $pdo->selectNotBinded($sql);

        if(count($records) === 0){
            $output = "<p>Error, There are no records to display</p>";
            return [$output,""];
        }else{
            $output = "<form method='post' action='index.php?page=deleteAdmins'>";
            $output .= "<input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br>
            <table class='table table-striped table-bordered'>
                <thead><tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Delete</th>
            </tr></thead><tbody>";

            foreach($records as $row){
                $output .= "<tr>
                <td>{$row['admin_name']}</td>
                <td>{$row['admin_email']}</td>
                <td>{$row['admin_password']}</td>
                <td>{$row['admin_status']}</td>
                <td><input type='checkbox' name='chkbx[]' value='{$row['admin_id']}' /></td></tr>";
            }

            $output .= "</tbody></table></form>";

            if(isset($error)){
                if($error){
                    $msg = "<p class='errorMsg'>Error, Could not delete the admin(s)</p>";
                }
                else {
                    $msg = "<p class='successMsg'>Admin(s) deleted</p>";
                }
            }
            else {
                $msg="";
            }
            return [$msg, $output];

        }        
    }
?> 