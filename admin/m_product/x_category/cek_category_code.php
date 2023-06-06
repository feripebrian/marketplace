<?php

require '../admin/config/koneksi.php';
require 'funct_direktori.php';

if (!empty($_POST['id'])) {
    $id = $_POST['id'];

    // HASIL CEK ID DIREKTORI
    if (cek_category_code($id) === 1) {
        echo "ada";
    } else {
        echo "tidak ada";
    }
} else {
    echo "gagal";
}
