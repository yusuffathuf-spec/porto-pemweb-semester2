<?php
if(!isset($_SESSION['user_id'])) {
    echo "<script>window.location='index.php?page=login';</script>";
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nama = '';
$idlevel = '';
$keterangan = '';
$tahun_lulus = '';
$foto_sekolah_lama = '';

if($id > 0) {
    $query = mysqli_query($conn, "SELECT * FROM studies WHERE id=$id");
    if($row = mysqli_fetch_assoc($query)) {
        $nama = $row['nama'];
        $idlevel = $row['idlevel'];
        $keterangan = $row['keterangan'];
        $tahun_lulus = $row['tahun_lulus'];
        $foto_sekolah_lama = $row['foto_sekolah'];
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $idlevel = (int)$_POST['idlevel'];
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $tahun_lulus = mysqli_real_escape_string($conn, $_POST['tahun_lulus']);
    
    $foto_sekolah = $foto_sekolah_lama;
    
    // Handle File Upload
    if(isset($_FILES['foto_sekolah']) && $_FILES['foto_sekolah']['error'] == 0) {
        $upload_dir = 'assets/uploads/';
        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = time() . '_' . $_FILES['foto_sekolah']['name'];
        $tmp_name = $_FILES['foto_sekolah']['tmp_name'];
        
        if(move_uploaded_file($tmp_name, $upload_dir . $file_name)) {
            // Delete old file if exists
            if(!empty($foto_sekolah_lama) && file_exists($upload_dir . $foto_sekolah_lama)) {
                unlink($upload_dir . $foto_sekolah_lama);
            }
            $foto_sekolah = $file_name;
        }
    }
    
    if($id > 0) {
        mysqli_query($conn, "UPDATE studies SET nama='$nama', idlevel=$idlevel, keterangan='$keterangan', tahun_lulus='$tahun_lulus', foto_sekolah='$foto_sekolah' WHERE id=$id");
    } else {
        mysqli_query($conn, "INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES ('$nama', $idlevel, '$keterangan', '$tahun_lulus', '$foto_sekolah')");
    }
    
    echo "<script>window.location='index.php?page=studies';</script>";
    exit;
}
?>

<h2><?php echo $id > 0 ? 'Edit' : 'Tambah'; ?> Studies</h2>
<hr>

<form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Nama Sekolah / Instansi</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Level</label>
        <select name="idlevel" class="form-select" required>
            <option value="">-- Pilih Level --</option>
            <?php
            $q_level = mysqli_query($conn, "SELECT * FROM level ORDER BY id ASC");
            while($lvl = mysqli_fetch_assoc($q_level)):
            ?>
                <option value="<?php echo $lvl['id']; ?>" <?php echo $idlevel == $lvl['id'] ? 'selected' : ''; ?>><?php echo $lvl['nama']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"><?php echo $keterangan; ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun Lulus</label>
        <input type="number" name="tahun_lulus" class="form-control" value="<?php echo $tahun_lulus; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto Sekolah</label>
        <input type="file" name="foto_sekolah" class="form-control" accept="image/*">
        <?php if(!empty($foto_sekolah_lama)): ?>
            <div class="mt-2">
                <img src="assets/uploads/<?php echo $foto_sekolah_lama; ?>" alt="Foto Lama" width="100" class="img-thumbnail">
                <small class="text-muted d-block">Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php?page=studies" class="btn btn-secondary">Batal</a>
</form>
