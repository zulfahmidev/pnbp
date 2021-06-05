<?php

require('functions.php');

if (auth()) {
    header('location: index.php');
}

$error = false;
if (isset($_POST['login'])) {
    if (login($_POST['username'], $_POST['password'])) {
        header('location: index.php');
    }else {
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .box {
        width: 400px;
        height: 400px;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    hr {
        border-bottom: 1px solid #aaa;
        margin: 0;
        width: 80%;
    }
    </style>
</head>
<body class="bg-primary">

    <div class="box rounded shadow-lg">
        <h4>Selamat Datang</h4>
        <p class="text-black-50">Silahkan login terlebih dahulu.</p>
        <hr>
        <form action="" method="post" style="width: 80%;">
            <?php if ($error) : ?>
            <div class="alert alert-danger mt-2">Username atau password salah.</div>
            <?php endif ?>
            <div class="form-group mt-2">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Type here..." class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Type here..." class="form-control">
            </div>
            <button class="btn btn-primary mt-2" name="login" style="display: block;width: 100%;">LOGIN</button>
        </form>
    </div>
    
</body>
</html>