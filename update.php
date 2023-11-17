<?php
require_once "config.php";
$successMsg= false;
$errorMsg = false;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM data WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $username = $row['username'];
        $password = $row['password'];
        $role = $row['role'];
        $user_image = $row['user_image'];
    }
}
if(isset($_POST['update'])){
    $name= $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if(move_uploaded_file($tmp_name,'uploads/'.$filename)){
        $successMsg =  "Image successfully uploaded";
    }else{
        $errorMsg = "Got some issue in uploading image";
    }

    $updateSql = "UPDATE data SET name = '$name', username = '$username', password = '$password', user_image = '$filename', role = '$role' WHERE id = '$id'";
    $result = mysqli_query($conn, $updateSql);

    if($result){
        header("location:dashboard.php");
    }else{
        $errorMsg = "Got some issue in updating data";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register | multiuser application</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap');

    .header {
        background-color: rgb(175, 228, 243);
        padding: 10px;
        text-align: center;
        box-shadow: 1px 1px 5px 0px rgba(0, 0, 0, 0.125);
    }

    .header h1 {
        font-size: 2.3rem;
        font-family: 'Kanit', sans-serif;
    }

    form .reg-heading {
        margin-bottom: 20px;
        font-size: 2rem;
        font-family: 'Kanit', sans-serif;
        font-weight: 300;
        border-bottom: 1px solid rgba(0, 0, 0, 0.112);
    }

    .container form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .flex-align-left {
        align-self: self-start;
        border: 2px solid green;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Multiuser Login Application in Php</h1>
    </div>
    <div class="container mt-4">
        <form method="post" enctype="multipart/form-data">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <?php
            if($errorMsg){
                echo '<div class="alert alert-danger d-flex align-items-center col-md-5" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                  '. $errorMsg .'
                </div>
              </div>';
            }
                ?>
            <div class="col-md-5">
                <h3 class="reg-heading">Updating Data:</h3>
            </div>
            <div class="mb-3 col-md-5">
                <label for="name" class="form-label">Name: </label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name?>" aria-describedby="emailHelp" required>

            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">Username:</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="username" value="<?php echo $username?>" required>
            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">password:</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $password?>" required>
            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">Your Image</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="image" value="<?php echo $user_image?>" required>
            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">Role: </label>
                <select class="form-select" aria-label="Default select example" name="role" value="<?php echo $role?>" required>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3 col-md-1" name="update">Update</button>
            <div class="form-text div_down col-md-5">Get Back to the dashboard <a href="dashboard.php">Dashboard</a></div>
        </form>
    </div>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>

<?php

?>