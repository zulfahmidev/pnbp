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
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
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
                    <a class="nav-link active" href="stats2.php">Statistik 2</a>
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
                    <h4>Statistik 2</h4>
                    <form action="" method="post" ref="form">
                        <input type="hidden" name="data" ref="data">
                    </form>
                    <div class="form-group mb-3">
                        <label for="c1_title">Title: </label>
                        <input type="text" class="form-control" v-model="webData.c1_title" placeholder="Type here..." id="c1_title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="c1_subtitle">Deskripsi: </label>
                        <input type="text" class="form-control" v-model="webData.c1_subtitle" placeholder="Type here..." id="c1_subtitle">
                    </div>
                    <button class="btn btn-primary" @click="save">Simpan Perubahan</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 h4">Table</div>
                <div class="col-6" style="text-align: right;"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fa fa-plus fa-fw"></i> Tambah</button></div>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">JENIS PNBP</th>
                        <th style="text-align: right;" scope="col">Target (Rupiah)</th>
                        <th style="text-align: right;" scope="col">Realisasi (Rupiah)</th>
                        <th style="text-align: right;" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(d,i) in reverse(webData.c1_data)" :key="i">
                        <th>{{ d.label }}</th>
                        <td style="text-align: right;">{{ d.target }}</td>
                        <td style="text-align: right;">{{ d.realisasi }}</td>
                        <td style="text-align: right;">
                            <button type="button" @click="hapus(webData.c1_data.length-i-1)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            <button @click="edit(webData.c1_data.length-i-1)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right;">Total: {{ total(webData.c1_data, 'target') }}</td>
                        <td style="text-align: right;">Total: {{ total(webData.c1_data, 'realisasi') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modal Tambah" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="label">Jenis PNPB</label>
                        <input type="text" id="label" v-model="label" placeholder="Type here..." class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="target">Target</label>
                        <input type="number" id="target" v-model="target" placeholder="Type here..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="realisasi">Realisasi</label>
                        <input type="number" id="realisasi" v-model="realisasi" placeholder="Type here..." class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="tambah" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modal Tambah" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="label">Jenis PNPB</label>
                        <input type="text" id="label" v-model="label" placeholder="Type here..." class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="target">Target</label>
                        <input type="number" id="target" v-model="target" placeholder="Type here..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="realisasi">Realisasi</label>
                        <input type="number" id="realisasi" v-model="realisasi" placeholder="Type here..." class="form-control">
                    </div>
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
                label: '',
                target: '',
                realisasi: '',
                webData: {},
            },
            methods: {
                save() {
                    let data = JSON.stringify(this.webData);
                    this.$refs.data.value = data;
                    this.$refs.form.submit();
                },
                total(arr, index) {
                    let total = 0;
                    arr.forEach(el => {
                        total += el[index];
                    });
                    return total;
                },
                tambah() {
                    console.log('a');
                    this.webData.c1_data.push({
                        label: this.label,
                        target: parseInt(this.target),
                        realisasi: parseInt(this.realisasi),
                    })
                    this.label = '';
                    this.target = '';
                    this.realisasi = '';
                    this.save();
                },
                edit(index) {
                    this.indexEdit = index;
                    var modal = new bootstrap.Modal(document.getElementById('modalEdit'), {
                        keyboard: false
                    })
                    let data = this.webData.c1_data[index];

                    this.label = data.label;
                    this.target = data.target;
                    this.realisasi = data.realisasi;

                    modal.show()
                },
                ubah() {
                    let conf = confirm('Apakah anda yakin, ingin mengubah?');
                    if (conf) {
                        this.webData.c1_data[this.indexEdit].label = this.label;
                        this.webData.c1_data[this.indexEdit].target = parseInt(this.target);
                        this.webData.c1_data[this.indexEdit].realisasi = parseInt(this.realisasi);
                        this.label = '';
                        this.target = '';
                        this.realisasi = 0;
                        this.save();
                    }
                },
                hapus(index) {
                    let conf = confirm('Apakah anda yakin, ingin menghapus?');
                    if (conf) {
                        this.webData.c1_data.splice(index,1);
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