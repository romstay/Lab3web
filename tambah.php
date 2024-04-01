<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $harga_jual = $_POST['harga_jual'];
  $harga_beli = $_POST['harga_beli'];
  $stok = $_POST['stok'];
  $kategori = $_POST['kategori'];
  $file_gambar = $_FILES['file_gambar'];
  $gambar = null;
  if ($file_gambar['error'] == 0) {
    $filename = str_replace(' ', '_', $file_gambar['name']);
    $destination = dirname(__FILE__) . '/gambar/' . $filename;
    if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
      $gambar = 'gambar/' . $filename;
    }
  }

  $sql = 'INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar)';
  $sql .= "VALUE ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";

  $result = mysqli_query($conn, $sql);
  header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Tambah Barang</title>
</head>

<body>
  <div class="container">
    <h1>Tambah Barang</h1>
    <div class="form">
      <form action="tambah.php" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-6">
          <label for="nama">Nama Barang :</label>
          <input type="text" name="nama" id="nama" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="kategori">Kategori :</label>
          <select name="kategori" id="kategori" class="form-control ">
            <option value="Komputer">Komputer </option>
            <option value="Elektronik">Elektronik </option>
            <option value="Hand Phone">Hand Phone </option>
          </select>
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="harga_jual mt-2 ">Harga Jual:</label>
          <input type="text" name="harga_jual" id="harga_jual" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="harga_beli">Harga Beli:</label>
          <input type="text" name="harga_beli" id="harga_beli" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="stok">Stok :</label>
          <input type="number" name="stok" id="stok" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="file_gambar">File Gambar :</label>
          <input type="file" name="file_gambar" id="file_gambar" class="form-control">
        </div>

        <div class="form-group mt-4 col-md-6">
          <input type="submit" name="submit" value="Simpan" id="" class="btn btn-primary w-100">
        </div>
      </form>
    </div>
  </div>
</body>

</html>