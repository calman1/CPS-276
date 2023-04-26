<?php
    require_once 'classes/StickyForm.php';
    $stickyForm = new StickyForm(); $stickyForm->security();

    function init(){
        return ["", "Welcome ".$_SESSION['name']];
    }
?> 