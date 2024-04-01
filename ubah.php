<?php
// error_reporting(E_ALL);
include_once 'koneksi.php';
$id = $_GET['id'];

if (isset($_POST['submit'])) {
  $id_barang = $_POST['id'];
  var_dump($id_barang);
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

  $sql = 'UPDATE data_barang SET ';
  $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
  $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
  if (!empty($gambar))
    $sql .= ", gambar = '{$gambar}' ";
  $sql .= "WHERE id='{$id_barang}' ";
  $result = mysqli_query($conn, $sql);
  header('location: index.php');


  // $result = mysqli_query($conn, $sql);
  // header('location: index.php');
}

$sql = "SELECT * FROM data_barang WHERE id='{$id}' ";
$result = mysqli_query($conn, $sql);
if (!$result) die("Error : Data tidak tersedia");
$data = mysqli_fetch_array($result);

function is_select($var, $val)
{
  if ($var == $val) return 'selected="selected"';
  return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Ubah Barang</title>
</head>

<body>
  <div class="container">
    <h1>Ubah Barang <?= $_GET['id'] ?></h1>
    <div class="form">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-6">
          <label for="nama">Nama Barang :</label>
          <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="kategori">Kategori :</label>
          <select name="kategori" id="kategori" class="form-control ">
            <option value="Komputer" <?php echo is_select("Komputer", $data["kategori"]); ?>>Komputer </option>
            <option <?php echo is_select("Elektronik", $data["kategori"]); ?> value="Elektronik">Elektronik </option>
            <option <?php echo is_select("Hand Phone", $data["kategori"]); ?> value="Hand Phone">Hand Phone </option>
          </select>
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="harga_jual mt-2 ">Harga Jual:</label>
          <input type="text" name="harga_jual" value="<?= $data['harga_jual'] ?>" id="harga_jual" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="harga_beli">Harga Beli:</label>
          <input type="text" value="<?= $data['harga_beli'] ?>" name="harga_beli" id="harga_beli" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="stok">Stok :</label>
          <input type="number" value="<?= $data['stok'] ?>" name="stok" id="stok" class="form-control">
        </div>
        <div class="form-group mt-2 col-md-6">
          <label for="file_gambar">File Gambar :</label>
          <input type="file" name="file_gambar" id="file_gambar" class="form-control">
        </div>
        <input type="hidden" value="<?= $data['id'] ?>" name="id">
        <div class="form-group mt-4 col-md-6">
          <input type="submit" name="submit" value="Simpan" id="" class="btn btn-primary w-100">
        </div>
      </form>
    </div>
  </div>
</body>

</html>