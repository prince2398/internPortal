<?php
    function loggedIn(){
        return (isset($_SESSION['userId']))? true:false;
    }
    function outputErrors($errors){
        $output = "<ul>";
        foreach ($errors as $error) {
            $output = $output."<li>$error</li>";
        }
        return $output."<ul>";
    }
    function sanitize($data){
        global $db;
        $data = mysqli_real_escape_string($db,$data);
        return $data;
    }
?>
