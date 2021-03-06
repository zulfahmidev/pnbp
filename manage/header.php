<?php

require('functions.php');

headerPage();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="bg-primary">

    <div id="app">
        <div class="container my-5 p-5 bg-white rounded shadow-lg">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dasar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="header.php">Header</a>
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
                    <h4>Header</h4>
                    <form action="" method="post" ref="form" enctype="multipart/form-data">
                        <input type="hidden" name="data" ref="data">
                        <div class="form-group mb-3">
                            <label for="h_image">Gambar: </label>
                            <input type="file" name="h_image" class="form-control" id="h_image">
                        </div>
                        <div class="form-group mb-3">
                            <label for="h_title">Title: </label>
                            <input type="text" value="<?= getData()['h_title'] ?>" name="h_title" class="form-control" placeholder="Type here..." id="h_title">
                        </div>
                        <div class="form-group mb-3">
                            <label for="h_subtitle">Subitle: </label>
                            <input type="text" value="<?= getData()['h_subtitle'] ?>" name="h_subtitle" class="form-control" placeholder="Type here..." id="h_subtitle">
                        </div>
                        <button class="btn btn-primary" name="save">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>