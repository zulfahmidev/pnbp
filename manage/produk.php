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
                    <a class="nav-link" href="index.php">Dasar</a>
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
                    <a class="nav-link active" href="produk.php">Produk</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-6">
                    <h4>Pruduk</h4>
                    <div class="form-group mb-3">
                        <label for="ap_title">Title: </label>
                        <input type="text" class="form-control" v-model="webData.ap_title" placeholder="Type here..." id="ap_title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ap_subtitle">Deskripsi: </label>
                        <input type="text" class="form-control" v-model="webData.ap_subtitle" placeholder="Type here..." id="ap_subtitle">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6"><h4>Aplikasi</h4></div>
                <div class="col-6" style="text-align: right;">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-sm btn-primary"><i class="fa fa-plus fa-fw"></i> Tambah Aplikasi</button>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Url Website</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(d,i) in reverse(webData.ap_items)" :key="i">
                        <th scope="row">{{ i+1 }}</th>
                        <td>{{ d.name }}</td>
                        <td>{{ d.url }}</td>
                        <td>
                            <button type="button" @click="hapus(webData.ap_items.length-i-1)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            <button @click="edit(webData.ap_items.length-i-1)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" @click="save">Simpan Perubahan</button>
        </div>
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" v-model="name" placeholder="Type here..." class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="url">Url</label>
                            <input type="text" id="url" v-model="url" placeholder="Type here..." class="form-control">
                        </div>
                        <form action="" method="post" ref="form" enctype="multipart/form-data">
                            <input type="hidden" name="data" ref="data">
                            <input type="hidden" ref="image_name" name="image_name">
                            <div class="form-group mb-3">
                                <label for="image">Logo</label>
                                <input type="file" name="image" id="image" ref="image" placeholder="Type here..." class="form-control">
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" @click="tambah" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ubah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" v-model="name" placeholder="Type here..." class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="url">Url</label>
                            <input type="text" id="url" v-model="url" placeholder="Type here..." class="form-control">
                        </div>
                        <form action="" method="post" ref="form2" enctype="multipart/form-data">
                            <input type="hidden" name="data" ref="data">
                            <input type="hidden" ref="image_name" name="image_name">
                            <input type="hidden" ref="index" name="edit">
                            <div class="form-group mb-3">
                                <label for="image">Logo</label>
                                <input type="file" name="image" id="image" ref="image" placeholder="Type here..." class="form-control">
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" @click="ubah" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: "#app",
            data: {
                indexEdit: null,
                name: '',
                url: '',
                webData: {},
            },
            methods: {
                save() {
                    this.$refs.image_name.value = 'ap_items';
                    let data = JSON.stringify(this.webData);
                    this.$refs.data.value = data;
                    this.$refs.form.submit();
                },
                tambah() {
                    if (this.name != '' && this.url != '') {
                        this.webData.ap_items.push({
                            name: this.name,
                            url: this.url
                        })
                        this.save();
                        this.name = '';
                        this.url = '';
                    }
                },
                edit(index) {
                    this.indexEdit = index;
                    var modal = new bootstrap.Modal(document.getElementById('modalEdit'), {
                        keyboard: false
                    })
                    let data = this.webData.ap_items[index];

                    this.name = data.name;
                    this.url = data.url;

                    modal.show()
                },
                ubah() {
                    if (this.name != '' && this.url != '') {
                        this.webData.ap_items[this.indexEdit].name = this.name;
                        this.webData.ap_items[this.indexEdit].url = this.url;
                        this.$refs.index.value = this.indexEdit;

                        this.$refs.image_name.value = 'ap_items';
                        let data = JSON.stringify(this.webData);
                        // console.log(data)
                        this.$refs.data.value = data;
                        this.$refs.form2.submit();

                        this.name = '';
                        this.url = '';
                    }
                },
                hapus(index) {
                    let conf = confirm('Apakah anda yakin, ingin menghapus?');
                    if (conf) {
                        this.webData.ap_items.splice(index,1);
                        this.save();
                    }
                },
                reverse(arr) {
                    let arr2 = [];
                    for (let i=1; i<=arr.length;i++) {
                        arr2.push(arr[arr.length-i]);
                    }
                    return arr2;
                },
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