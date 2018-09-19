<?php
    function getPostedInternIds($id){
        global $db;
        $id =(int)sanitize($id);
        $ids = array();
        $res = mysqli_query($db,"SELECT `internId` FROM `internships` WHERE `employerId`= $id ORDER BY `time` DESC");
        while($row = mysqli_fetch_assoc($res)){
            $ids[] = $row['internId'];
        }
        return $ids;
    }
    function incrementPostedCount($id){
        global $db;
        $id = sanitize($id);

        $query = "UPDATE `employer` SET `postedCount` = `postedCount`+1 WHERE `employerId`=$id";
        if (!mysqli_query($db,$query)) {
            echo 'posted count: ',mysqli_error($db);
        }
    }
   function internExist($title){
        global $db;
        $title = sanitize($title);

        $query = "SELECT COUNT(`internId`) FROM `internships` WHERE `title` ='$title'";
        $res = mysqli_query($db,$query);
        $count = mysqli_fetch_array($res);
        return $count[0]?true:false;
    }
    function postIntern($internData){
        global $db;
        array_walk($internData, 'arraySanitize');
        $fields = '`'.implode('`,`', array_keys($internData)).'`';
        $values = '\''.implode('\',\'',$internData).'\'';

        $query = "INSERT INTO `internships` ($fields) VALUES ($values)";

        if (mysqli_query($db,$query)) {
            $id = mysqli_insert_id($db);
            incrementPostedCount($internData['employerId']);
            return $id;
        }else{
            echo mysqli_error($db);
            return false;
        }
        return true;
    }
    function protectForEmployer(){
        if (isset($_SESSION['type']) && $_SESSION['type'] !== 'employer') {
            header('Location: protected.php?file='.$_SERVER['PHP_SELF']);
        }
    }
    function registerEmployer($data){
        global $db;
        array_walk($data, 'arraySanitize');
        $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);
        $fields = '`'.implode('`,`', array_keys($data)).'`';
        $values = '\''.implode('\',\'',$data).'\'';

        $query = "INSERT INTO `employer` ($fields) VALUES ($values)";

        if(mysqli_query($db, $query)){
            return true;
        }else{
            echo mysqli_error($db);
            return false;
        }
    }
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
    function getEmployerData($employerId){
        global $db;
        $data = array();
        $employerId = (int)$employerId;

        $argsNum = func_num_args();
        $argsVal = func_get_args();

        if($argsNum > 1){
            unset($argsVal[0]);
            $fields = '`'.implode('`,`',$argsVal).'`';
            $query = "SELECT $fields FROM `employer` WHERE `employerId`=$employerId";
            $result = mysqli_query($db,$query);
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }
?>
