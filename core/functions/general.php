<?php
    function allInternIds(){
        global $db;
        $ids = array();

        $res = mysqli_query($db,"SELECT `internId` FROM `internships` WHERE `deadline`>NOW() ORDER BY `deadline` ASC");
        while($row = mysqli_fetch_assoc($res)){
            $ids[] = $row['internId'];
        }
        return $ids;
    }
    function incrementApplicationCount($id){
        global $db;
        $id = sanitize($id);

        $query = "UPDATE `internships` SET `applicationCount` = `applicationCount`+1 WHERE `internId`=$id";
        if (!mysqli_query($db,$query)) {
            echo 'applicatiocount: ',mysqli_error($db);
        }
    }
    function getInternData($id){
        global $db;
        $id = sanitize($id);

        $argsNum = func_num_args();
        $argsVal = func_get_args();

        if($argsNum >1){
            unset($argsVal[0]);
            $fields = '`'.implode('`,`',$argsVal).'`';
            $query = "SELECT $fields FROM `internships` WHERE `internId`= $id";
            if($res = mysqli_query($db,$query)){
                $data = mysqli_fetch_assoc($res);
                return $data;
            }else{
                return false;
            }
        }
    }
    function loggedIn(){
        return (isset($_SESSION['userId']))? true:false;
    }
    function loggedInRedirect(){
        if(loggedIn()){
            header('Location: '.HOME);
        }
    }
    function protectPage(){
        if(!loggedIn()){
            header('Location : login.php');
        }
    }
    function outputErrors($errors){
        $output = "<ul>";
        foreach ($errors as $error) {
            $output = $output."<li>$error</li>";
        }
        return $output."<ul>";
    }
    function arraySanitize(&$data){
        global $db;
        $data = mysqli_real_escape_string($db,$data);
    }
    function sanitize($data){
        global $db;
        $data = mysqli_real_escape_string($db,$data);
        return $data;
    }
?>
