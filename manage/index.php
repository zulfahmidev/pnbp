<?php

require('functions.php');

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
            </ul>

            <div class="row" id="header">
                <div class="col-lg-6">
                    <h4>Dasar</h4>
                    <form action="" method="post" ref="form">
                        <input type="hidden" name="data" ref="data">
                    </form>
                    <div class="form-group mb-3">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" v-model="webData.email" placeholder="Type here..." id="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat: </label>
                        <input type="text" class="form-control" v-model="webData.address" placeholder="Type here..." id="alamat">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone: </label>
                        <input type="text" class="form-control" v-model="webData.phone" placeholder="Type here..." id="phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ft_sloag">Slogan: </label>
                        <input type="text" class="form-control" v-model="webData.ft_slogan" placeholder="Type here..." id="ft_sloag">
                    </div>
                    <button class="btn btn-primary" @click="save">Simpan Perubahan</button>
                </div>
            </div>
            
        </div>
    </div>
    
    <script>
        new Vue({
            el: "#app",
            data: {
                webData: {},
            },
            methods: {
                save() {
                    let data = JSON.stringify(this.webData);
                    this.$refs.data.value = data;
                    this.$refs.form.submit();
                }
            },
            mounted() {
                $.getJSON('../data.json', (data) => {
                    this.webData = data;
                });
            }
        })
    </script>
</body>
</html>