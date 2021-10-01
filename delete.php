<?php

$connect = mysqli_connect('localhost', 'root','','crud');
if(isset($_POST['id'])) {

    $id = $_POST['id'];

    $del = mysqli_query($connect, "DELETE FROM `firstproj` WHERE `firstproj`.`id` = '$id'");



    echo $del;


}
