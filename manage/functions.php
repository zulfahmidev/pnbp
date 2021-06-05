<?php

require_once '../vendor/autoload.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
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
    if (!auth()) {
        header('location: login.php');
    }
    if (isset($_POST['save'])) {

        $data = getData();
        $data['email'] = $_POST['email'];
        $data['phone'] = $_POST['phone'];
        $data['address'] = $_POST['address'];
        $data['ft_slogan'] = $_POST['ft_slogan'];
        saveData($data);
    }
}

function getImgUploader($dir = 'assets/img') {
    $image = new Bulletproof\Image($_FILES);
    $image->setMime(array('png', 'jpg', 'jpeg'))
        ->setLocation('../'.$dir)
        ->setSize(5000, 8388608)
        ->setDimension(10000,10000);                

    return $image;
}

function headerPage() {
    if (!auth()) {
        header('location: login.php');
    }
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
    if (!auth()) {
        header('location: login.php');
    }
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
    tambahAvatars();
    ubahAvatars();
    hapus();
}

function stats1Page() {
    if (!auth()) {
        header('location: login.php');
    }
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
    if (!auth()) {
        header('location: login.php');
    }
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
    if (!auth()) {
        header('location: login.php');
    }
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
    if (!auth()) {
        header('location: login.php');
    }
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

                $uploader = getImgUploader('assets/img/logo');
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
function tambahAvatars() {
    if (isset($_POST['tambah'])) {
        $data = getData();
        $data2 = [];
        $fields = ['name', 'desc'];
        foreach ($fields as $field) {
            $data2[$field] = $_POST[$field];
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != '') {

                $uploader = getImgUploader('assets/img/avatars');
                if ($uploader['image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        $data2['image'] = 'assets/img/avatars/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }

        $data['tk_avatars'][] = $data2;
        saveData($data);
    }
}

function ubahProduct() {
    if (isset($_POST['ubah'])) {
        $data = getData();
        $data2 = [];
        $fields = ['name', 'url'];
        foreach ($fields as $field) {
            $data['ap_items'][$_POST['number']][$field] = $_POST[$field];
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != '') {

                $uploader = getImgUploader('assets/img/logo');
                if ($uploader['image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        if (file_exists(__DIR__.'/../'.$data['ap_items'][$_POST['number']]['image'])) {
                            unlink(__DIR__.'/../'.$data['ap_items'][$_POST['number']]['image']);
                        }
                        $data['ap_items'][$_POST['number']]['image'] = 'assets/img/logo/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }

        saveData($data);
    }
}


function ubahAvatars() {
    if (isset($_POST['ubah'])) {
        $data = getData();
        $fields = ['name', 'desc'];
        foreach ($fields as $field) {
            $data['tk_avatars'][$_POST['number']][$field] = $_POST[$field];
        }

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != '') {

                // var_dump($_FILES['image']['name']);
                // die;

                $uploader = getImgUploader('assets/img/avatars');
                if ($uploader['image']) {
                    $upload = $uploader->upload();
                    if ($upload) {
                        if (file_exists(__DIR__.'/../'.$data['tk_avatars'][$_POST['number']]['image'])) {
                            unlink(__DIR__.'/../'.$data['tk_avatars'][$_POST['number']]['image']);
                        }
                        $data['tk_avatars'][$_POST['number']]['image'] = 'assets/img/avatars/'.$uploader->getName().'.'.$uploader->getMime();
                    }else {

                    }
                }
            }   
    
        }

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

function login($username, $password) {
    if (($token = attempt($username, $password))) {
        $_SESSION['login_token'] = $token;
        return true;
    }
    return false;
}

function logout() {
    if (isset($_SESSION['login_token'])) {
        unset($_SESSION['login_token']);
        return true;
    }
    return false;
}

function auth() {
    if (isset($_SESSION['login_token'])) {
        $time = dencToken($_SESSION['login_token']);

        return (int)$time >= time();
    }
    return false;
}

function attempt($username, $password) {

    // Algorithm
    $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    $months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
    $user = password_hash($days[date('N')-1],2);
    $pass = password_hash('@_Z1&'.date('j').$months[date('n')-1].date('y').'%TD', 1);
    $password = '@_Z1&'.$password.'%TD';
    if (password_verify($username, $user) && password_verify($password, $pass)) {
        return encToken(time()+(60*60));
    }
    return false;
}

function encToken($number) {
    $arr = str_split($number);
    if ((int)end($arr)%2==0) $arr = array_reverse($arr);
    $keys = ['Z','1','L','0','A','D','M','C','%','@'];
    $token = '';
    foreach ($arr as $t) {
        $token .= $keys[$t];
    }
    return $token;
}

function dencToken($token) {
    $arr = str_split($token);
    $keys = ['Z','1','L','0','A','D','M','C','%','@'];
    $normal = '';
    foreach ($arr as $t) {
        foreach ($keys as $i => $k) {
            // echo $k . ' ' . (string)$t .'<br>';
            // echo $k = $t;
            if ($k == $t) $normal .= "$i";
        }
    }
    $n = str_split($normal);
    if ((int)end($n)%2==0) $arr = array_reverse($arr);
    return $normal;
}

if (isset($_POST['logout'])) {
    logout();
}