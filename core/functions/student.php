<?php
    function loginAsStudent($username,$password){
        global $db;
        $studentId = studentIdFromUsername($username);
        $username = sanitize($username);

        $query = mysqli_query($db,"SELECT `password` FROM `student` WHERE `email` = '$username'");
        $hash = mysqli_fetch_array($query);

        return (password_verify($password,$hash[0])) ? $studentId : False;
    }
    function studentExist($username){
        global $db;
        $username = sanitize($username);
        $query = mysqli_query($db, "SELECT COUNT(`studentId`) FROM `student` WHERE `email` = '$username'");
        $count = mysqli_fetch_array($query);
        return ($count[0])?true:false;
    }
    function studentIdFromUsername($username){
        global $db;
        $username = sanitize($username);
        $query = mysqli_query($db, "SELECT `studentId` FROM `student` WHERE `email` = '$username'");
        $studentId = mysqli_fetch_array($query);
        return $studentId[0];
    }
?>
