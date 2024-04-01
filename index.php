<?php
include("koneksi.php");

$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Data Barang</title>
</head>

<body>
  <div class="container mt-4">
    <div class="d-flex justify-content-between">

      <h1>Data Barang Konter Indo</h1>
      <a href="tambah.php" class="btn btn-primary mb-4">+ Tambah Barang</a>
    </div>
    <div class="main">
      <table class="table table-bordered table-striped">
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Harga Jual</th>
          <th>Harga Beli</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
        <?php if ($result) : ?>
        <?php $no = 1; ?>
        <?php while ($row = mysqli_fetch_array($result)) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><img width="100px" src="<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>"></td>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['kategori']; ?></td>
          <td><?= $row['harga_beli']; ?></td>
          <td><?= $row['harga_jual']; ?></td>
          <td><?= $row['stok']; ?></td>
          <td><a type="button" class="btn btn-sm btn-secondary mr-2" href="ubah.php?id=<?= $row['id']; ?>">Edit</a>
            <a type="button" class="btn btn-sm btn-danger" href="hapus.php?id=<?= $row['id']; ?>">Hapus</a>
          </td>
        </tr>
        <?php endwhile;
        else : ?>
        <tr>
          <td colspan="7"> Belum ada data</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>
  </div>
  <script>
  function hapus() {
    alert("Anda bukan admin!")
  }

  function edit() {
    alert("Anda bukan admin!")
  }
  </script>
</body>

</html>