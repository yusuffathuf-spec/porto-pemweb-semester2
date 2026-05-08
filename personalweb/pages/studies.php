<?php
// Handle Delete
if(isset($_GET['delete'])) {
    if(!isset($_SESSION['user_id'])) {
        echo "<script>window.location='index.php?page=login';</script>";
        exit;
    }

    $id = (int)$_GET['delete'];
    
    // Get image path to delete file
    $query_img = mysqli_query($conn, "SELECT foto_sekolah FROM studies WHERE id=$id");
    if($row_img = mysqli_fetch_assoc($query_img)) {
        if(!empty($row_img['foto_sekolah']) && file_exists("assets/uploads/" . $row_img['foto_sekolah'])) {
            unlink("assets/uploads/" . $row_img['foto_sekolah']);
        }
    }
    
    mysqli_query($conn, "DELETE FROM studies WHERE id=$id");
    echo "<script>window.location='index.php?page=studies';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Studies</h2>
    <?php if(isset($_SESSION['user_id'])): ?>
    <a href="index.php?page=studies_form" class="btn btn-primary">Tambah Studies</a>
    <?php endif; ?>
</div>
<hr>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Nama Sekolah</th>
                <th>Level</th>
                <th>Keterangan</th>
                <th>Tahun Lulus</th>
                <th>Foto</th>
                <?php if(isset($_SESSION['user_id'])): ?>
                <th width="150">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT s.*, l.nama as nama_level FROM studies s LEFT JOIN level l ON s.idlevel = l.id ORDER BY s.id ASC");
            $no = 1;
            while($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['nama_level']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td><?php echo $row['tahun_lulus']; ?></td>
                <td>
                    <?php if(!empty($row['foto_sekolah'])): ?>
                        <img src="assets/uploads/<?php echo $row['foto_sekolah']; ?>" alt="Foto" width="50" class="img-thumbnail">
                    <?php else: ?>
                        <span class="text-muted">Tidak ada</span>
                    <?php endif; ?>
                </td>
                <?php if(isset($_SESSION['user_id'])): ?>
                <td>
                    <a href="index.php?page=studies_form&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="index.php?page=studies&delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($query) == 0): ?>
            <tr><td colspan="<?php echo isset($_SESSION['user_id']) ? '7' : '6'; ?>" class="text-center">Belum ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
