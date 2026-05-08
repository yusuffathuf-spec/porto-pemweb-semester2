<?php
// Handle Delete
if(isset($_GET['delete'])) {
    if(!isset($_SESSION['user_id'])) {
        echo "<script>alert('Anda harus login terlebih dahulu!'); window.location='index.php?page=login';</script>";
        exit;
    }
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM level WHERE id=$id");
    echo "<script>window.location='index.php?page=level';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Level Pendidikan</h2>
    <?php if(isset($_SESSION['user_id'])): ?>
    <a href="index.php?page=level_form" class="btn btn-primary">Tambah Level</a>
    <?php endif; ?>
</div>
<hr>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="50">No</th>
                <th>Nama Level</th>
                <?php if(isset($_SESSION['user_id'])): ?>
                <th width="150">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM level ORDER BY id ASC");
            $no = 1;
            while($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <?php if(isset($_SESSION['user_id'])): ?>
                <td>
                    <a href="index.php?page=level_form&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="index.php?page=level&delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($query) == 0): ?>
            <tr><td colspan="<?php echo isset($_SESSION['user_id']) ? '3' : '2'; ?>" class="text-center">Belum ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
