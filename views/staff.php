<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/ashesisupportcenter/views/header.php');

    $id = $_SESSION["user_id"];
    $role = $_SESSION["role"];
    if($role!= "staff"){
        require('logout.php');
        header("Location: login.php");
    }


    include('viewComplaints.php');
    // echo $id;
        staffView($id);

?>
