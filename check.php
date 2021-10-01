<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>CRUD</title>
</head>
<body>

</body>
</html>

<?php
$connect = mysqli_connect('localhost', 'root','','crud');


if(isset($_POST['submit'])) {

    $name = filter_var(trim($_POST['name']),
        FILTER_SANITIZE_STRING);
    $surname = filter_var(trim($_POST['surname']),
        FILTER_SANITIZE_STRING);
    $lastname = filter_var(trim($_POST['lastname']),
        FILTER_SANITIZE_STRING);


//$mysql = new mysqli('localhost','root','','crud');
    $connect->query("INSERT INTO `firstproj` (`name`,`surname`,`lastname`)
    VALUES ('$name','$surname','$lastname')");


//        $connect->close();
};
if(isset($_POST['readRecords'])){

    $result = mysqli_query($connect ,"SELECT * FROM `firstproj`");


    $data =  "<table>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Lastname</th>
              <th>Edit</th>
              <th>Edit2</th>
              <th>Delete</th>
          </tr>" ;


//toDo button is being add here
    while($res = mysqli_fetch_array($result)){
        $id = $res['id'];
        $data .= '<tr class="editTD" id="'.$id.'">
           <td><input type="text" name="id"   value="'.$res['id'].'" disabled style="width: 40px;"></td>  
           <td><input type="text" name="name"   value="'.$res['name'].'" disabled style="width: 100px;"></td>  
           <td><input type="text" name="surname"   value="'.$res['surname'].'" disabled style="width: 100px;"></td>  
           <td><input type="text" name="lastname"   value="'.$res['lastname'].'" disabled style="width: 130px;"></td>  
           
           <td><button class="btn btn-info" data-toggle="modal" id="'.$res['id'].'">Edit</button></td>
           <td><button class="btn btn-success newEdit" name="submit" id="'.$res['id'].'" >Edit2</button></td>
           <td><button class="btn btn-danger delete" data-toggle="modal" id="'.$res['id'].'">Delete</button></td>
            <input type="text" name="text" class="addName" id="'.$res['id'].'" style="display:none">
           </tr>';

    }


    $data .= ' </table>';
    echo $data;
}


// validacia
// edit delete
// upload nkar



//           <td><a style="color:red;" href="delete.php?id='.$res['id'].'">Delete</a> </td>

