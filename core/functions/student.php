<?php
    function getStudentIds($internId){
        global $db;
        $internId = sanitize($internId);
        $ids = array();
        $res = mysqli_query($db,"SELECT `studentId` FROM `applications` WHERE `internId` = $internId ORDER BY `time` ASC");
        while($row = mysqli_fetch_assoc($res)){
            $ids[] = $row['studentId'];
        }
        return $ids;
    }
    function getAppliedInternIds($id){
        global $db;
        $id = sanitize($id);

        $ids = array();

        $res = mysqli_query($db,"SELECT `internId` FROM `applications` WHERE `studentId` = $id ORDER BY `time` DESC");
        while($row = mysqli_fetch_assoc($res)){
            $ids[] = $row['internId'];
        }
        return $ids;
    }
    function incrementAppliedCount($id){
        global $db;
        $id = sanitize($id);

        $query = "UPDATE `student` SET `appliedCount` = `appliedCount`+1 WHERE `studentId`=$id";
        if (!mysqli_query($db,$query)) {
            echo 'applied count: ',mysqli_error($db);
        }
    }
    function alreadyApplied($studentId,$internId){
        global $db;
        $studentId = (int)sanitize($studentId);
        $internId = (int)sanitize($internId);
        $query = "SELECT COUNT(`applicationId`) FROM `applications` WHERE `studentId` = $studentId && `internId` = $internId";
        $res = mysqli_query($db,$query);
        $count = mysqli_fetch_array($res);
        return $count[0]?true:false;
    }
    function applyIntern($studentId,$internId){
        global $db;
        $studentId = (int)sanitize($studentId);
        $internId = (int)sanitize($internId);
        $query = "INSERT INTO `applications` (`studentId`,`internId`) VALUES ($studentId,$internId)";
        if (mysqli_query($db,$query)) {
            incrementApplicationCount($internId);
            incrementAppliedCount($studentId);
            return true;
        }else{
            echo mysqli_error($db);
            return false;
        }
    }
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
