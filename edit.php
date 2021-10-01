<?php

$connect = mysqli_connect('localhost', 'root','','crud');


if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $lastname = $_POST['lastname'];
    $id = $_POST['id'];

//    print_r($id);
//
//    die();
//    $connect = mysqli_connect('localhost', 'root','','crud');

    $done = mysqli_query($connect, "UPDATE `firstproj` SET `name` = '$name', `surname` = '$surname', `lastname` = '$lastname' WHERE `firstproj`.`id` = '$id'");

        print_r($done);

//    if($done == 1){
//        echo 'everything is ok and yor data is updated successfully';
//    }

}
