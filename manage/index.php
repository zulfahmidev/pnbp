<?php

require('functions.php');

dasarPage();

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
</head>
<body class="bg-primary">

    <div class="container my-5 p-5 bg-white rounded shadow-lg">

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Dasar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="header.php">Header</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tentang.php">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stats1.php">Statistik 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stats2.php">Statistik 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stats3.php">Statistik 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="produk.php">Produk</a>
            </li>
            <li class="nav-item">
                <form action="" method="post" id="logout">
                    <input type="hidden" name="logout">
                </form>
                <a class="nav-link" onclick="event.preventDefault();document.querySelector('#logout').submit()" href="produk.php">Logout</a>
            </li>
        </ul>

        <div class="row" id="header">
            <div class="col-lg-6">
                <h4>Dasar</h4>
                <form action="" method="post" ref="form">
                    <input type="hidden" name="options" value="{}">
                    <div class="form-group mb-3">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" value="<?= getData()['email'] ?>" name="email" placeholder="Type here..." id="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat: </label>
                        <input type="text" class="form-control" name="address" value="<?= getData()['address'] ?>" placeholder="Type here..." id="alamat">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone: </label>
                        <input type="text" class="form-control" value="<?= getData()['phone'] ?>" name="phone" placeholder="Type here..." id="phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ft_sloag">Slogan: </label>
                        <input type="text" class="form-control" value="<?= getData()['ft_slogan'] ?>" name="ft_slogan" placeholder="Type here..." id="ft_sloag">
                    </div>
                    <button class="btn btn-primary" name="save">Simpan Perubahan</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>