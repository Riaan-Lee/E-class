<?php
    // connect to db server
    $server="localhost";
    $serveruser="root";
    $serverpassword="";

    // establish the connection
    $connect=mysqli_connect($server,$serveruser,$serverpassword);

    // confirm connection
    if($connect){
        echo "Connection successful";
    } else{
        // echo "Not successful";
        die(mysqli_connect_error($connect));
    }



?>