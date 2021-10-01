<?php
die(123)
$connect = mysqli_connect('127.0.0.1', 'root','','crud');

$product_id = $_GET['id'];

$product = mysqli_query($connect, "SELECT * FROM `firstproj` WHERE `id` = '$product_id'");
$product = mysqli_fetch_assoc($product);
if(isset($_POST)){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $lastname  = $_POST['lastname'];
    $id = $_POST['id'];
}


?>

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

  <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mainForm">
    <form id="myForm" action="" class="main" method="post" >
      <h3>Mutqagreq Tvyalner@</h3>
      <input type="text" id="name" name="name" placeholder="Anun" class="form-control" required>
        <span id="errspan1"><div id="errorMessName"> </div></span><br>
      <input  type="text" id="surname" name="surname" placeholder="Azganun" class="form-control">
        <span id="errspan2"><div id="errorMessSur"> </div></span><br>
      <input  type="text" id="lastname" name="lastname" placeholder="Hayranun" class="form-control">
        <span id="errspan3"><div id="errorMessLast"> </div></span><br>
      <button class="btn btn-success" id="sendName" name="submit" type="submit">Avelacnel</button> <br>
    </form>
        </div>
        <div class="col-md-6">
          <div id ="recs"></div>
        </div>
        </div>
  </div>
    <div>
<!--  <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Modal</button>-->
  <div id="myModal" class="modal fade" >
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Popoxel Tvyalnery</h4>
              <button class="close" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
              <form id="modalForm" action="" class="main" method="post" >

                  <input type="hidden" id="modal_id" name="modal_id" value=""> <br>
                  <input type="text" id="modal_name" name="name"  placeholder="Anun" class="form-control"><br>
                  <input  type="text" id="modal_surname" name="surname" value="" placeholder="Azganun" class="form-control"><br>
                  <input  type="text" id="modal_lastname" name="lastname" value="" placeholder="Hayranun" class="form-control"><br>
                  <button class="btn btn-success" data-toggle="modal" data-target="#myModal" id="sendModal" name="submit" type="submit">Poxel</button>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn btn-success" data-dismiss="modal">Pakel</button>
          </div>
          </div>
      </div>
  </div>
    </div>

  <div id="sureModal" class="modal fade" >
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Uzum es jnjel?</h4>
                  <button class="close" data-dismiss="modal">x</button>
              </div>
              <div class="modal-body">
                  <form  action="delete.php" class="main" method="POST"> <br>
                      <input type="hidden" id="del_id" name="del_id" >
                      <button id="delName" class="btn btn-success" name="deleteBut" type="submit">AYO</button>
                      <button  class="btn btn-danger" data-dismiss="modal">VOCH</button>
                  </form>
              </div>
              <div class="modal-footer">

              </div>
          </div>
      </div>

  <script>

$(document).ready(function (){

    readRecords();

});
     function readRecords(){
         let readRecords = "readRecords"

         $.ajax({
             url:'check.php',
             type: 'POST',
             cache: false,
             data: {
                 readRecords:readRecords
             },

             success: function (data,status) {
                $('#recs').html(data);
             }
         });


     }
      $("#sendName").on("click", function () {

          let name = $("#name").val().trim();
          let surname = $("#surname").val().trim();
          let lastname = $("#lastname").val().trim();
          let submit = $("#sendName").val().trim();


          if(name == "" ) {
              $("#errorMessName").text("Mutqagreq Anun");
              return false;
          }
          else {
                  $("#errorMessName").text("");
              }
          if(surname == "") {
              $("#errorMessSur").text("Mutqagreq Azganun");
              return false;
          }
              else {
                  $("#errorMessSur").text("");
              }
           if(lastname == "") {
              $("#errorMessLast").text("Mutqagreq Hayranun");
              return false;
          }
          else {
              $("#errorMessLast").text("");
          }


          $.ajax({
              url:'check.php',
              type: 'POST',
              cache: false,
              data: {
                  name: name,
                  surname: surname,
                  lastname: lastname,
                  submit: submit
              },
              dataType: 'html',
              beforeSend: function () {
                  $("#sendName").prop("disabled",true);
              },
              success: function () {
                  readRecords();
                  $("#sendName").prop("disabled",false);
                  $("#myForm").trigger("reset")
              }

          });


      });

$("#sendName").on("click", function () {
    let name = $("#name").val().trim();
    let surname = $("#surname").val().trim();
    let lastname = $("#lastname").val().trim();

});



$(document).on('click', '.btn-info', function(){
    let employee_id = $(this).attr("id");
    $.ajax({
        url:"update.php",
        method:"POST",
        data:{id:employee_id},
        dataType:"json",
        success:function(data){
            if ($(".className")[0]){
                console.log(13254);
            }
            // console.log(data.name,"}{}{}{}{}{}{");
            $('#myModal').modal('show');
            $('#modal_name').val(data.name);
            $('#modal_surname').val(data.surname);
            $('#modal_lastname').val(data.lastname);
            $('#modal_id').val(data.id);

        }
    });
});

$(document).on("click", '.delete' ,function (){
    let user_id = $(this).attr("id");

    $('#sureModal').modal('show');

    $('#del_id').val(user_id);
});

$("#delName").on("click", function () {
    let id = $(".delete").attr("id");

    //$("#delName").val().trim();
    $.ajax({
        url:'delete.php',
        type: 'POST',
        cache: false,
        data: {
            id: id
        },
        dataType: 'json',
        beforeSend: function () {
            $("#delName").prop("disabled",true);
        },
        success: function () {
            readRecords();
            $("#delName").prop("disabled",false);
            // $("#modalForm").trigger("reset")
            $('#sureModal').modal("hide");
        }
    });
});
$("#sendModal").on("click", function () {

    let name = $("#modal_name").val().trim();
    let surname = $("#modal_surname").val().trim();
    let lastname = $("#modal_lastname").val().trim();
    let id = $("#modal_id").val().trim();
    let submit = $("#sendModal").val();

    $.ajax({
        url:'edit.php',
        type: 'POST',
        cache: false,
        data: {
            name: name,
            surname: surname,
            lastname: lastname,
            submit: submit,
            id: id
        },
        dataType: 'json',
        beforeSend: function () {
            $("#sendModal").prop("disabled",true);
        },
        success: function () {
             readRecords();
            $("#sendModal").prop("disabled",false);
             $("#modalForm").trigger("reset");
            $('#myModal').modal("hide");
        }

    });
});
  </script>
      <script>

          // $(document).ready(function (){
          //   $('.newEdit').on('click',function () {
          //       console.log(132456);
          //       $('#hideId').show();
          //       });

          $(document).on('click', '.newEdit', function(){

              let id = $(this).attr("id");
              let n = $(".editTD[id="+id+"]");

              const [,first, second, third] = n[0].children;
              const name = first.children;
              const surname = second.children;
              const lastname = third.children;

              $(name).removeAttr("disabled");
              $(surname).removeAttr("disabled");
              $(lastname).removeAttr("disabled");

              $(this).toggleClass('newUpdate');
              $(this).html('Update');

              $(".delete[id="+id+"]").toggleClass('newCancel');
              $(".newCancel[id="+id+"]").removeClass('delete');
              $(".newCancel[id="+id+"]").html('Cancel');

          });

          $(document).on('click', '.newUpdate', function(){
              let id = $(this).attr("id");
              let submit = $(this).attr("name");
              let n = $(".editTD[id="+id+"]");
              console.log(n[0]);
              const [,first, second, third] = n[0].children;
              const name = first.children;
              const surname = second.children;
              const lastname = third.children;

             let DataName = $(name).prop("value");
             let DataSurname = $(surname).prop("value");
             let DataLastname = $(lastname).prop("value");

              $.ajax({
                  url:'edit.php',
                  type: 'POST',
                  cache: false,
                  data: {
                      id: id,
                      name: DataName,
                      surname: DataSurname,
                      lastname: DataLastname,
                      submit : submit
                  },
                  beforeSend: function () {
                      $(this).prop("disabled",true);
                  },
                  success: function () {
                      readRecords();
                  }
              });
          });

          $(document).on('click', '.newCancel', function(){

              let id = $(this).attr("id");
              let n = $(".editTD[id="+id+"]");

              const [,first, second, third] = n[0].children;
              const name = first.children;
              const surname = second.children;
              const lastname = third.children;

              $(name).prop("disabled", true);
              $(surname).prop("disabled", true);
              $(lastname).prop("disabled", true);


              $(this).toggleClass('delete');
              $(this).html('Delete');
              $(".newEdit[id="+id+"]").removeClass('newUpdate');
              $(".newEdit[id="+id+"]").html('Edit2');
              $(this).removeClass('newCancel');

          })


      </script>

</body>
</html>
