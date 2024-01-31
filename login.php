<?php
session_start();
include 'config.php';

// Redirect to index.php if the user is already logged in
if (isset($_SESSION['status'])) {
    header('location:index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM login WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables on successful login
        $_SESSION['id_login'] = $user['id_login'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_toko'] = $user['nama_toko'];
        $_SESSION['alamat'] = $user['alamat'];
        $_SESSION['telepon'] = $user['telepon'];
        $_SESSION['status'] = "login";

        echo '<script>alert("Login successful");window.location="index.php"</script>';
        exit;
    } else {
        echo '<script>alert("Invalid username or password");history.go(-1);</script>';
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="assets/img/logo55.png">
    <link rel="icon" href="icon.ico" type="image/ico">
    <title>TOKOKU - Kasir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#42403C;">
    <br>
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="card-body shadow-sm" style="border-radius: 19px; background-color:#FFCF00; ">
                    <center>
                        <img src="assets/img/logo1.png" alt="" height="70" weight="280">
                    </center>
                    <hr>
                    <center>
                        <h4><b>LOGIN PAGE</b></h4>
                    </center>
                    <br>
                    <form method="POST">
                        <div class="form-group">
                            <label for="user">Username</label>
                            <input type="text" class="form-control" id="user" name="username" placeholder="Username" required>
                        </div>

                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
                        </div>


                        <div class="col-12 pl-1 mt-2">
                            <button class="btn btn-block" name="login" type="submit" style="background-color:#42403C; color:white;">
                                <i class="fa fa-sign-in-alt mr-1"></i> LOGIN
                            </button>
                        </div>
                        <!-- <hr>
                        <center>
                            <a href="login.php" style="color:brown;">
                                <i class="fa fa-user-plus mr-1"></i> REGISTER ADMIN/KASIR</a>
                        </center> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>