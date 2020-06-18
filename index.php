<?php
include 'db.php';

if(isset($_POST['btn-add'])){
    $form = "
    <form action='' method='post'>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='name' placeholder='Enter interns name' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='username' placeholder='Enter interns username' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='amount' placeholder='Enter amount you wish to send' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='submit' value='submit' name='btn-add2' class='btn btn-success'>
    </div>
</form>";
}

if(isset($_POST['btn-add2'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $amount = $_POST['amount'];

    $sql =  $conn->query("INSERT INTO interns(name,username,amount) VALUES('$name','$username','$amount')");

    if($sql){
        $error = "<div class='container'>
        <div class='alert alert-success bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>Intern Added</strong>
        </div>
      </div>";
    }
    else{
        $error = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>An error occurred</strong>
        </div>
      </div>";
    }
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = $conn->query("SELECT * FROM interns WHERE id = '$id'");
    while($data = $sql->fetch_object()){
    $form_edit = "
    <form action='' method='post'>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='name' placeholder='Enter interns name' value= '$data->name' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='username' placeholder='Enter interns username' value= '$data->username' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='text' name='amount' placeholder='Enter amount you wish to send' value= '$data->amount' class='form-control'>
    </div><br>
    <div class='form-group' style='width:60%;margin:auto;'>
        <input type='submit' value='EDIT' name='btn-edit' class='btn btn-success'>
    </div>
</form>";
    }
}

if(isset($_POST['btn-edit'])){
    $id = $_GET['edit'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $amount = $_POST['amount'];

    $sql =  $conn->query("UPDATE interns SET name='$name',username='$username',amount='$amount' WHERE id='$id'");

    if($sql){
        $error = "<div class='container'>
        <div class='alert alert-success bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>Edited Successfully</strong>
        </div>
      </div>";
    }
    else{
        $error = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>An error occurred</strong>
        </div>
      </div>";
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE  FROM interns WHERE id = '$id'");
    if($sql){
        $error = "<div class='container'>
        <div class='alert alert-success bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>Deleted</strong>
        </div>
      </div>";
    }
    else{
        $error = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>An error occurred</strong>
        </div>
      </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HNG Top Up App</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap-theme.min.css'>
    <link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap.min.css'>
</head>
<body style='background-color:cadetblue;'>
    <nav>
        <div class="container">
        <img src='images/hng-logo.png' style='height:100px;margin-top:20px;'>
        <span class='h3' style="font-family:'Georgia', 'Times New Roman', 'Times', 'serif'">HNG TECH</span>
        </div>
    </nav>
    <div class="container">
        <h2>Send airtime topup</h2>
    
    <?php if(isset($error)){
        echo $error;
    } ?>

    <table class='table table-bordered'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Amount</th>
            <th>SELECT</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>
        <?php 
        $sql = $conn->query("SELECT * FROM interns");  
                  while($data = $sql->fetch_object()){
                   echo " 
                    <tr>
                      <td>$data->id</td>
                      <td>$data->name</td>
                      <td>$data->username</td>
                      <td>$data->amount</td>
                      <td><input type='checkbox'></td>
                      <td><a href='index.php?edit=$data->id' class='btn btn-primary' name='btn-edit'>EDIT</a></td>
                      <td><a href='index.php?delete=$data->id' class='btn btn-danger' name='btn-delete'>DELETE</a></td>
                    </tr>";
                  }
            ?>
    </table>

    <form action="" method="post">
        <input type='submit' name='btn-add' class='btn btn-primary' value='ADD INTERN'>
    </form><br>
    <button class='btn btn-success'>SEND AIRTIME TO ALL SELECTED INTERNS</button><hr>
    <?php if(isset($form)){
        echo $form;
    } ?>
     <?php if(isset($form_edit)){
        echo $form_edit;
    } ?>

    

</div>
    
</body>
</html>