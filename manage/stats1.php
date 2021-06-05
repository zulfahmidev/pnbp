<?php

require('functions.php');

stats1Page();

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
                <a class="nav-link" href="index.php">Dasar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="header.php">Header</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tentang.php">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="stats1.php">Statistik 1</a>
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
                <h4>Statistik 1</h4>
                <form action="" method="post" ref="form">
                    <input type="hidden" name="options" value="{}">
                    <div class="form-group mb-3">
                        <label for="st_title">Title: </label>
                        <input type="text" class="form-control" placeholder="Type here..." name="st_title" value="<?= getData()['st_title'] ?>" id="st_title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="st_subtitle">Subtitle: </label>
                        <input type="text" value="<?= getData()['st_subtitle'] ?>" class="form-control" placeholder="Type here..." name="st_subtitle" id="st_subtitle">
                    </div>
                    <button class="btn btn-primary" name="save">Simpan Perubahan</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6 h4">Table</div>
            <div class="col-6" style="text-align: right;">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fa fa-plus fa-fw"></i> Tambah</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Provinsi</th>
                    <th style="text-align: right;" scope="col">Realisasi (Rupiah)</th>
                    <th style="text-align: right;" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getData()['st_data'] as $i => $v) : ?>
                <tr>
                    <th><?= $v['provinsi']; ?></th>
                    <td style="text-align: right;">Rp. <?= $v['realisasi']; ?></td>
                    <td style="text-align: right;">
                        <form action="" class="d-inline-block" method="post">
                            <input type="hidden" name="hapus" value='{"index":"st_data", "number":<?= $i ?>}'>
                            <button onclick="return confirm('Apakah anda yakin ingin mengahpus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit-<?= $i ?>"><i class="fa fa-edit"></i></button>
                    </td>
                </tr>
                
                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit-<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modal Tambah" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" value="<?= $v['provinsi'] ?>" placeholder="Type here..." class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="realisasi">Realisasi</label>
                                    <input type="number" name="realisasi" id="realisasi" value="<?= $v['realisasi'] ?>" placeholder="Type here..." class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="number" value="<?= $i ?>">
                                <button name="ubah" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right;">Total: <?= total('st_data', 'realisasi') ?></td>
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
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" placeholder="Type here..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="realisasi">Realisasi</label>
                        <input type="number" id="realisasi" name="realisasi" placeholder="Type here..." class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  name="tambah" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
</body>
</html>