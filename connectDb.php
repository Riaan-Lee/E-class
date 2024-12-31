<?php
    // connect to db server
    $server="localhost";
    $serveruser="root";
    $serverpassword="";
    $db="Eclass";

    // establish the connection
    $connect=mysqli_connect($server,$serveruser,$serverpassword,$db);

    // confirm connection
    if(!$connect){
        die(mysqli_connect_error($connect));
    }



?>