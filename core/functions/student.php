<?php
    function protectForStudent(){
        if (isset($_SESSION['type']) && $_SESSION['type'] !== 'student') {
            header('Location: protected.php?file='.$_SERVER['PHP_SELF']);
        }
    }
    function registerStudent($data){
        global $db;
        array_walk($data, 'arraySanitize');
        $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);
        $fields = '`'.implode('`,`', array_keys($data)).'`';
        $values = '\''.implode('\',\'',$data).'\'';

        $query = "INSERT INTO `student` ($fields) VALUES ($values)";

        if(mysqli_query($db, $query)){
            return true;
        }else{
            echo mysqli_error($db);
            return false;
        }
    }
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
    function getStudentData($studentId){
        global $db;
        $data = array();
        $studentId = (int)$studentId;

        $argsNum = func_num_args();
        $argsVal = func_get_args();

        if($argsNum > 1){
            unset($argsVal[0]);
            $fields = '`'.implode('`,`',$argsVal).'`';
            $query = "SELECT $fields FROM `student` WHERE `studentId`=$studentId";
            $result = mysqli_query($db,$query);
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }
?>
