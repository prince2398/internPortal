<?php
    function loginAsEmployer($username,$password){
        global $db;
        $employerId = employerIdFromUsername($username);
        $username = sanitize($username);

        $query = mysqli_query($db,"SELECT `password` FROM `employer` WHERE `email` = '$username'");
        $hash = mysqli_fetch_array($query);

        return (password_verify($password,$hash[0])) ? $employerId : False;
    }
    function employerExist($username){
        global $db;
        $username = sanitize($username);
        $query = mysqli_query($db, "SELECT COUNT(`employerId`) FROM `employer` WHERE `email` = '$username'");
        $count = mysqli_fetch_array($query);
        return ($count[0])?true:false;
    }
    function employerIdFromUsername($username){
        global $db;
        $username = sanitize($username);
        $query = mysqli_query($db, "SELECT `employerId` FROM `employer` WHERE `email` = '$username'");
        $employerId = mysqli_fetch_array($query);
        return $employerId[0];
    }
?>
