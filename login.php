<?php
require_once "config.php";
$successMsg= false;
$errorMsg = false;

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginSql = "SELECT * FROM data WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $loginSql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $username = $row['username'];
        $role = $row['role'];
        session_start();
        $_SESSION['loggin'] = true;
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        header("location:dashboard.php");
        
    }else{
        $errorMsg = "No such record found. Kindly enter valid credentials !!";
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
        <form method="post">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            <?php
            if($successMsg){
               echo '<div class="alert alert-success d-flex align-items-center col-md-5" role="alert">
               <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
               <div>
                 ' .$successMsg . '
               </div>
             </div>';
            }
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
                <h3 class="reg-heading">LogIn Form:</h3>
            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">Username:</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="username" required>
            </div>
            <div class="mb-3 col-md-5">
                <label for="exampleInputPassword1" class="form-label">password:</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 col-md-1" name="login">Log In</button>
            <div class="form-text div_down col-md-5">Don't have an account? <a href="register.php">Signup</a></div>
        </form>
    </div>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
