<?php
if(!isset($_SESSION['user_id'])) {
    echo "<script>window.location='index.php?page=login';</script>";
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nama = '';

if($id > 0) {
    $query = mysqli_query($conn, "SELECT * FROM level WHERE id=$id");
    if($row = mysqli_fetch_assoc($query)) {
        $nama = $row['nama'];
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    
    if($id > 0) {
        mysqli_query($conn, "UPDATE level SET nama='$nama' WHERE id=$id");
    } else {
        mysqli_query($conn, "INSERT INTO level (nama) VALUES ('$nama')");
    }
    echo "<script>window.location='index.php?page=level';</script>";
    exit;
}
?>

<h2><?php echo $id > 0 ? 'Edit' : 'Tambah'; ?> Level</h2>
<hr>

<form method="POST" action="">
    <div class="mb-3">
        <label class="form-label">Nama Level</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php?page=level" class="btn btn-secondary">Batal</a>
</form>
