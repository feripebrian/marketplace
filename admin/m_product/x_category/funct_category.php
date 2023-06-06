<?php

function cek_category_code($id)
{
    global $conn;

    $category_code = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

    $cek_category_code = mysqli_query($conn, "SELECT category_code FROM md_category WHERE category_code='$category_code'");
    $hasil_cek        = mysqli_num_rows($cek_category_code);

    if ($hasil_cek > 0) {
        return 1;
    } else {
        return 0;
    }
}

function save_category($data)
{
    global $conn;

    $category_code  = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['category_code'])));
    $category       = mysqli_real_escape_string($conn, htmlspecialchars($data['category']));

    // SIMPAN DATA DIREKTORI
    $query = mysqli_query($conn, "INSERT INTO md_category VALUES('$category_code', '$category')");

    return mysqli_affected_rows($conn);
}

function edit_category($data)
{
    global $conn;

    $id_direktori_lama = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_direktori_lama'])));
    $id_direktori_baru = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_direktori_baru'])));
    $nama_direktori    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_direktori']));

    // UPDATE DATA DIREKTORI
    $query = mysqli_query($conn, "UPDATE tb_direktori SET 
											id_direktori='$id_direktori_baru', nama_direktori='$nama_direktori'
									WHERE id_direktori='$id_direktori_lama'
		");

    return mysqli_affected_rows($conn);
}

function hapus_direktori($id)
{
    global $conn;

    $id_direktori = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

    // HAPUS DATA DIREKTORI
    $query = mysqli_query($conn, "DELETE FROM tb_direktori WHERE id_direktori='$id_direktori'");

    return mysqli_affected_rows($conn);
}
