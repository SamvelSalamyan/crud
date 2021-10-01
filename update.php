<?php

$connect = mysqli_connect('localhost', 'root','','crud');

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $result  = mysqli_query($connect, "SELECT * FROM `firstproj` WHERE `id` = '$id'");
    $user = mysqli_fetch_array($result);

    echo   json_encode($user);

}

