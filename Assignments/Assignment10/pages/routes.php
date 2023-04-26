<?php
require_once 'classes/StickyForm.php';
$stickyForm = new StickyForm(); 

$path = "index.php?page=login";

$css=<<<css
<style>
.nav-header {
	display: flex;
	padding: 10px;
    list-style: none;
}

.nav-header ul {
	display: flex;
	margin: 0;
	padding: 0;
}

.nav-header li {
	margin-right: 20px;
}
</style>
<style>.errorMsg span{color: red; margin-left: 15px;} .errorMsg{color: red;}</style>
<style>.successMsg{color: black;}</style>
<style>.padtop {padding-top: 10px;}</style>
css;

$nav = $css;
$pageTitle = $_GET['page'];
session_start();
if(isset($_SESSION['access'])){
    if($_SESSION['access'] == "accessGranted"){
        if($_SESSION['status'] == "admin"){
            $nav=<<<HTML
            $css
            <nav>
                <ul class="nav-header">
                    <li><a href="index.php?page=addContact">Add Contact</a></li>
                    <li><a href="index.php?page=deleteContacts">Delete Contact(s)</a></li>    
                    <li><a href="index.php?page=addAdmin">Add Admin</a></li>
                    <li><a href="index.php?page=deleteAdmins">Delete Admin(s)</a></li> 
                    <li><a href="logout.php">Logout</a></li>    
                </ul>
            </nav>
            HTML;
        }else if($_SESSION['status'] == "staff"){
            $nav=<<<HTML
            $css
            <nav>
                <ul class="nav-header">
                    <li><a href="index.php?page=addContact">Add Contact</a></li>
                    <li><a href="index.php?page=deleteContacts">Delete Contact(s)</a></li>  
                    <li><a href="logout.php">Logout</a></li>   
                </ul>
            </nav>
            HTML;
        }
    }
}
session_abort();

if(isset($_GET)){
    if($_GET['page'] === "welcome"){
        require_once('pages/welcome.php');
        $nav .= "<h1>Welcome</h1>";
        $result = init();
    }
    else if($_GET['page'] === "login"){
        require_once('pages/login.php');
        $nav .= "<h1>Login</h1>";
        $result = init();
    }
    else if($_GET['page'] === "addAdmin"){
        require_once('pages/addAdmin.php');
        $nav .= "<h1>Add Admin</h1>";
        $result = init();
    }
    else if($_GET['page'] === "addContact"){
        require_once('pages/addContact.php');
        $nav .= "<h1>Add Contact</h1>";
        $result = init();
    }
    else if($_GET['page'] === "deleteAdmins"){
        require_once('pages/deleteAdmin.php');
        $nav .= "<h1>Delete Admin(s)</h1>";
        $result = init();
    }
    else if($_GET['page'] === "deleteContacts"){
        require_once('pages/deleteContacts.php');
        $nav .= "<h1>Delete Contact(s)</h1>";
        $result = init();
    }
    else {
        header('location: '.$path);
    }
}

else {
    header('location: '.$path);
}



?>