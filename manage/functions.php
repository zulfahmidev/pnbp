<?php

require_once '../vendor/autoload.php';
$filename = '../data.json';

function getData() {
    global $filename;
    return json_decode(file_get_contents($filename), true);
}

function saveData($data) {
    global $filename;
    file_put_contents($filename, json_encode($data));
}

function dasarPage() {
    if (isset($_POST['save'])) {

        $data = getData();
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['address'] = $_POST['address'];
        $data['ft_slogan'] = $_POST['ft_slogan'];
        saveData($data);

    }
}

function getImgUploader() {
    $image = new Bulletproof\Image($_FILES);
    $image->setMime(array('png', 'jpg', 'jpeg'))
        ->setLocation('../assets/img')
        ->setSize(5000, 8388608)
        ->setDimension(10000,10000);                

    return $image;
}

function headerPage() {
    if (isset($_POST['save'])) {

        $data = getData();
        if (isset($_FILES['h_image'])) {
            if ($_FILES['h_image']['name'] != '') {

                $uploader = getImgUploader();
                $image_name = '';
                if ($uploader['h_image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        if (file_exists(__DIR__.'/../'.$data['h_image'])) {
                            unlink(__DIR__.'/../'.$data['h_image']);
                        }
                        $data['h_image'] = 'assets/img/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }
        $data['h_title'] = $_POST['h_title'];
        $data['h_subtitle'] = $_POST['h_subtitle'];
        saveData($data);

    }
}

function tentangPage() {
    if (isset($_POST['save'])) {

        $data = getData();
        if (isset($_FILES['tk_image'])) {
            if ($_FILES['tk_image']['name'] != '') {

                $uploader = getImgUploader();
                $image_name = '';
                if ($uploader['tk_image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        if (file_exists(__DIR__.'/../'.$data['tk_image'])) {
                            unlink(__DIR__.'/../'.$data['tk_image']);
                        }
                        $data['tk_image'] = 'assets/img/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }
        $data['tk_title'] = $_POST['tk_title'];
        $data['tk_description'] = $_POST['tk_description'];
        saveData($data);

    }
}

function stats1Page() {
    if (isset($_POST['save'])) {

        $data = getData();
        $data['st_title'] = $_POST['st_title'];
        $data['st_subtitle'] = $_POST['st_subtitle'];
        saveData($data);
    }

    ubah('st_data', ['provinsi', 'realisasi']);
    tambah('st_data', ['provinsi', 'realisasi']);
    hapus();
}

function stats2Page() {
    if (isset($_POST['save'])) {

        $data = getData();
        $data['c1_title'] = $_POST['c1_title'];
        $data['c1_subtitle'] = $_POST['c1_subtitle'];
        saveData($data);

    }
    ubah('c1_data', ['label', 'target', 'realisasi']);
    tambah('c1_data', ['label', 'target', 'realisasi']);
    hapus();
}

function stats3Page() {
    if (isset($_POST['save'])) {

        $data = getData();
        $data['c2_title'] = $_POST['c2_title'];
        $data['c2_subtitle'] = $_POST['c2_subtitle'];
        saveData($data);

    }
    ubah('c2_data', ['label', 'target', 'realisasi']);
    tambah('c2_data', ['label', 'target', 'realisasi']);
    hapus();
}


function productPage() {
    if (isset($_POST['save'])) {

        $data = getData();
        $data['ap_title'] = $_POST['ap_title'];
        $data['ap_subtitle'] = $_POST['ap_subtitle'];
        saveData($data);
    }
    tambahProduct();
    ubahProduct();
    hapus();
}

function hapus() {
    if (isset($_POST['hapus'])) {
        $data = getData();
        $data2 = json_decode($_POST['hapus'], true);
        unset($data[$data2['index']][$data2['number']]);
        saveData($data);
    }
}

function tambah($index, $fields = []) {
    if (isset($_POST['tambah'])) {
        $data = getData();
        $data2 = [];
        foreach ($fields as $field) {
            $data2[$field] = $_POST[$field];
        }
        $data[$index][] = $data2;
        saveData($data);
    }
}

function tambahProduct() {
    if (isset($_POST['tambah'])) {
        $data = getData();
        $data2 = [];
        $fields = ['name', 'url'];
        foreach ($fields as $field) {
            $data2[$field] = $_POST[$field];
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != '') {

                $uploader = getImgUploader();
                if ($uploader['image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        $data2['image'] = 'assets/img/logo/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }

        $data['ap_items'][] = $data2;
        saveData($data);
    }
}

function ubahProduct() {
    if (isset($_POST['ubah'])) {
        $data = getData();
        $data2 = [];
        $fields = ['name', 'url'];
        foreach ($fields as $field) {
            $data2[$field] = $_POST[$field];
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != '') {

                $uploader = getImgUploader();
                if ($uploader['image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        $data2['image'] = 'assets/img/logo/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }

        $data['ap_items'][$_POST['number']] = $data2;
        saveData($data);
    }
}

function ubah($index, $fields = []) {
    if (isset($_POST['ubah'])) {
        $data = getData();
        $data2 = [];
        foreach ($fields as $field) {
            $data2[$field] = $_POST[$field];
        }
        $data[$index][$_POST['number']] = $data2;
        saveData($data);
    }
}

function total($index, $field) {
    $total = 0;
    foreach (getData()[$index] as $d) {
        $total += $d[$field];
    }
    return $total;
}