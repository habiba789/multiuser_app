<?php
session_start();
require_once "config.php";
$viewSql = "SELECT * FROM data";
$result = mysqli_query($conn, $viewSql);

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

    a {
        text-decoration: none;
        color: #fff;
    }
    a:hover{
        color: #fff;
    }
    .greeting-user p {
        font-size: 1.7rem;
        font-family: 'kanit', sans-serif;
    }

    .greeting-user p .greeting-user-name {
        font-size: 2rem;
    }

    .border-green-per {
        width: 50%;
    }

    .logout-button a{
        color: gray;
    }
    .logout-button:hover a{
        color: #fff;
    }
 
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="greeting-user text-center m-2">
                <p>welcome "<span class="greeting-user-name">
                        <?php echo $_SESSION['name']; ?>
                    </span>"</p>
            </div>
            <div class="border-green-per d-flex justify-content-between">
                <div>
                <?php
                if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'){
                   echo '<button class="btn btn-outline-success me-2" type="button">Update Data</button>
                   <button class="btn btn-outline-success me-2" type="button">Alter Structure</button>';
                }
                ?>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-secondary logout-button" type="button"><a href="logout.php">Log out</a> </button>
                </div>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>User Image</th>
                    <th>Date</th>
                    <?php
                if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'){
                   echo '<th colspan="2" class="text-center">Actions</th>';
                }
                ?>
                </tr>
            </thead>
            <tbody>
                <?php
            if(mysqli_num_rows($result)>0){
                while($rows = mysqli_fetch_assoc($result)){
                    ?>

                <tr>
                    <td>
                        <?php echo $rows['id'] ;?>
                    </td>
                    <td>
                        <?php echo $rows['name'] ;?>
                    </td>
                    <td>
                        <?php echo $rows['username'] ;?>
                    </td>
                    <td>
                        <?php echo $rows['password'] ;?>
                    </td>
                    <td>
                        <?php echo $rows['role'] ;?>
                    </td>
                    <td class="text-center"><img src="uploads/<?php echo $rows['user_image'];?>" width="100px" alt="">
                    </td>
                    <td>
                        <?php echo date('d-M-Y', strtotime($rows['date']));?>
                    </td>
                    <?php
                   if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager'){
                    echo '<td class="text-center"><button type="button" class="btn btn-primary">
                    <a href="update.php?id='.$rows["id"].'"> Update </a>
                    </button></td>
                    <td class="text-center"><button type="button" class="btn btn-primary"><a href="delete.php?id='.$rows["id"].'"> Delete</a></button></td>';
                    
                 }
                ?>

                </tr>

                <?php
                }
            }else{
                echo "No record found";
            }
            ?>
            </tbody>
        </table>
    </div>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>