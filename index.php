<?php
require_once 'classes/mahasiswa.php';
require_once 'classes/User.php';

$mhs = new Mahasiswa();
$user = new User();


// ====================== MAHASISWA ======================

// TAMBAH
if (isset($_POST['tambah_mhs'])) {
    $mhs->create(
        $_POST['nim'],
        $_POST['nama'],
        $_POST['jurusan'],
        $_POST['alamat'],
        $_POST['email'],
        $_POST['no_hp']
    );
    header("Location: index.php");
    exit;
}

// HAPUS
if (isset($_GET['hapus_mhs'])) {
    $mhs->delete($_GET['hapus_mhs']);
    header("Location: index.php");
    exit;
}

// AMBIL DATA
$dataMhs = $mhs->read();


// ====================== USER ======================

// TAMBAH USER
if (isset($_POST['tambah_user'])) {
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user->create(
        $_POST['nama'],
        $_POST['email'],
        $passwordHash
    );

    header("Location: index.php");
    exit;
}

// HAPUS USER
if (isset($_GET['hapus_user'])) {
    $user->delete($_GET['hapus_user']);
    header("Location: index.php");
    exit;
}

// AMBIL DATA USER
$dataUser = $user->read();

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa & User</title>
</head>
<body>

<!-- ====================== MAHASISWA ====================== -->
<h2>Tambah Mahasiswa</h2>
<form method="POST">
    NIM: <input type="text" name="nim" required><br><br>
    Nama: <input type="text" name="nama" required><br><br>
    Jurusan: <input type="text" name="jurusan" required><br><br>
    Alamat: <input type="text" name="alamat" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    No HP: <input type="text" name="no_hp" required><br><br>
    <button type="submit" name="tambah_mhs">Simpan</button>
</form>

<h3>Data Mahasiswa</h3>
<table border="1" cellpadding="10">
<tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>Alamat</th>
    <th>Email</th>
    <th>No HP</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($dataMhs)): ?>
    <?php foreach ($dataMhs as $row): ?>
    <tr>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['jurusan'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['no_hp'] ?></td>
        <td>
            <a href="?hapus_mhs=<?= $row['nim'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="7">Data mahasiswa kosong</td></tr>
<?php endif; ?>

</table>

<hr>


<!-- ====================== USER ====================== -->
<h2>Tambah User</h2>
<form method="POST">
    Nama: <input type="text" name="nama" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="tambah_user">Simpan</button>
</form>

<h3>Data User</h3>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
   
    <th>Aksi</th>
</tr>

<?php if (!empty($dataUser)): ?>
    <?php foreach ($dataUser as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['email'] ?></td>
      
        <td>
            <a href="?hapus_user=<?= $row['id'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="5">Data user kosong</td></tr>
<?php endif; ?>

</table>

</body>
</html>