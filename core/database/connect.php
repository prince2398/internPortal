<?php
    if(!($db = mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME))){
       die("Error in Connection : ");
    }else{
        //echo "Success";
    }
?>
